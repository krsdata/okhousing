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
use Modules\Admin\Entities\Finishes as Finishes;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;  
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;



/**
 * Class FinishesController
 */
class FinishesController extends Controller
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
        View::share('viewPage', 'Finishes'); 
        View::share('heading', 'Finishes');
        View::share('route_url', route('finishes'));
        View::share('date_format',date('m-d-Y'));

        $this->record_per_page = Config::get('app.record_per_page');
        $this->indexUrl     = 'admin::finishes.index';
        $this->createUrl    = 'admin::finishes.create';
        $this->editUrl      = 'admin::finishes.edit';
        $this->defaultUrl   = route('finishes');
        $this->createMessage = 'Record created successfully.';
        $this->updateMessage = 'Record updated successfully.';
        $this->deleteMessage=  'Record deleted successfully.';
    }

    /*
     * Dashboard
     * */

    public function index(Finishes $finishes, Request $request)
    {
        $page_title  = ucfirst(Route::currentRouteName());
        $page_action = 'View '.ucfirst(Route::currentRouteName());
        
        // Search by name ,email and group
        $search    = $request->get('search');
        $status    = $request->get('status'); 

        if ((isset($search) && !empty($search)) or  (isset($status) && !empty($status))) {
           
            $finishes = Finishes::where(function ($query) use ($search,$status) {
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
            $finishes = Finishes::orderBy('id', 'desc')->where('status', '=', 1)->Paginate($this->record_per_page);
        }
        
        return view($this->indexUrl, compact( 'status', 'finishes', 'page_title', 'page_action'));
    }

    /*
     * create finishes method
     * */

    public function create(Finishes $finishes)
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

        
        $th = "th";
        $thai_html   = view::make('admin::finishes.form_thai',compact('th','finishes'));
         
        return view($this->createUrl, compact('th','thai_html','finishes','country','url', 'page_title', 'page_action'));  
    }

    /*
     * Save finishes method
     * */

    public function store(Request $request, Finishes $finishes)
    {

        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'name'       => 'required|unique:project_finishes,name|min:3',
        ]);
 

        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
         
        $finishes->fill($request->all()); 

        $finishes->contents = json_encode($request->all());  
        $finishes->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->createMessage);
    }

    /*
     * Edit finishes method
     * @param
     * object : $finishes
     * */

    public function edit(Request $request,  $finishes)
    {    
        $finishes = Finishes::find($finishes);

        $page_title  =  str_replace(['.'],' ', ucfirst(Route::currentRouteName()));
        $page_action =  str_replace('.',' ', ucfirst(Route::currentRouteName()));

         $showCountry = \DB::table('countries')
                        ->where('deleted_at',NULL)
                        ->pluck('country_id')
                        ->toArray();

        $country = \DB::table('all_countries')
                    ->whereIn('id',$showCountry)
                    ->get();
        
        $th = "th"; 
        $thai_html   = view::make('admin::finishes.form_thai',compact('th','finishes'));
       
        return view($this->editUrl, compact('th','thai_html','finishes','country','url', 'page_title', 'page_action'));  

    }

    public function update(Request $request,  $finishes)
    {
        $finishes = Finishes::find($finishes);

        $finishes->fill($request->all());

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
        $finishes->contents = json_encode($request->all());   
        $finishes->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->updateMessage);
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request, $finishes)
    {
        $finishes = Finishes::find($finishes);
        
        $finishes_id = \DB::table('projects')->where('finishes_id',$finishes->id)->get();
        if($finishes_id->count()){
           return Redirect::to($this->defaultUrl)
                    ->with('flash_alert_notice', 'This finishes already associated with project so this Can not be deleted.'); 
        }

        $finishes->delete();
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->deleteMessage);
    }

    public function show(Finishes $finishes)
    {
    }
}
