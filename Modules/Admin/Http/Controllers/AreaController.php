<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Input;
use Route;
use View; 
use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Modules\Admin\Entities\Area;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;  
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;



/**
 * Class AreaController
 */
class AreaController extends Controller
{
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    { 
        View::share('viewPage', 'Area'); 
        View::share('heading', 'Area');
        View::share('route_url', route('area'));
        View::share('date_format',date('m-d-Y'));

        $this->record_per_page = Config::get('app.record_per_page');
        $this->indexUrl     = 'admin::area.index';
        $this->createUrl    = 'admin::area.create';
        $this->editUrl      = 'admin::area.edit';
        $this->defaultUrl   = route('area');
        $this->createMessage = 'Record created successfully.';
        $this->updateMessage = 'Record updated successfully.';
        $this->deleteMessage=  'Record deleted successfully.';
    }

    /*
     * Dashboard
     * */

    public function index(Area $area, Request $request)
    {
        $page_title  = ucfirst(Route::currentRouteName());
        $page_action = 'View '.ucfirst(Route::currentRouteName());
        
        // Search by name ,email and group
        $search    = $request->get('search');
        $status    = $request->get('status'); 

        if ((isset($search) && !empty($search)) or  (isset($status) && !empty($status))) {
           
            $area = Area::with('units','unitTh')->where(function ($query) use ($search,$status) {
                if (!empty($search)) {
                    $query->Where('name', 'LIKE', "%$search%");
                    $query->orWhere('name_th', 'LIKE', "%$search%");
                }

                if (!empty($status)) {
                    
                    $status =  ($status == 'active')?1:0;
                    $query->Where('status', $status);
                }

                 
            })->where('status', '=', 1)->Paginate($this->record_per_page);
        } else {
            $area = Area::with('units','unitTh')->orderBy('id', 'desc')->where('status', '=', 1)->Paginate($this->record_per_page);
        }
        
        return view($this->indexUrl, compact( 'status', 'area', 'page_title', 'page_action'));
    }

    /*
     * create Area method
     * */

    public function create(Area $area)
    {
        $page_title  =  str_replace(['.'],' ', ucfirst(Route::currentRouteName()));
        $page_action =  str_replace('.',' ', ucfirst(Route::currentRouteName()));
        $url = null;

        $showCountry = \DB::table('countries')
                        ->where('deleted_at',NULL)
                        ->pluck('country_id')
                        ->toArray();

        $country = \DB::table('all_countries')
                    ->whereIn('id',$showCountry)
                    ->get();

        $project_units     = \DB::table('project_land_units')->pluck('land_unit','id')->toArray();
        
        $th = "th";
        $thai_html   = view::make('admin::area.form_thai',compact('th','area','project_units'));
         
        return view($this->createUrl, compact('th','thai_html','area','country','url', 'page_title', 'page_action','project_units'));  
    }

    /*
     * Save area method
     * */

    public function store(Request $request, Area $area)
    {

        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'name'       => 'required|unique:project_areas,name|min:1',
        ]);
 

        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
         
        $area->fill($request->all()); 

        $area->contents = json_encode($request->all());  
        $area->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->createMessage);
    }

    /*
     * Edit area method
     * @param
     * object : $area
     * */

    public function edit(Area $area)
    {    
        $page_title  =  str_replace(['.'],' ', ucfirst(Route::currentRouteName()));
        $page_action =  str_replace('.',' ', ucfirst(Route::currentRouteName()));

         $showCountry = \DB::table('countries')
                        ->where('deleted_at',NULL)
                        ->pluck('country_id')
                        ->toArray();

        $country = \DB::table('all_countries')
                    ->whereIn('id',$showCountry)
                    ->get();
        $project_units     = \DB::table('project_land_units')->pluck('land_unit','id')->toArray();
        
        $th = "th"; 
        $thai_html   = view::make('admin::area.form_thai',compact('th','area','url_th','project_units'));
       
        return view($this->editUrl, compact('th','thai_html','area','country','url', 'page_title', 'page_action','url_th','project_units'));  

    }

    public function update(Request $request, Area $area)
    {
        $area->fill($request->all());

        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validator = Validator::make($request->all(), [
            'country'  => 'required',
            'name'     => 'required|min:3',
        ]);

        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        $area->contents = json_encode($request->all());   
        $area->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->updateMessage);
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request, Area $area)
    {
        $area_id = \DB::table('projects')->where('area_id',$Area->id)->get();
        if($area_id->count()){
           return Redirect::to($this->defaultUrl)
                    ->with('flash_alert_notice', 'This area already associated with project so this Can not be deleted.'); 
        }

        $area_id->delete();
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->deleteMessage);
    }

    public function show(Area $area)
    {
    }
}
