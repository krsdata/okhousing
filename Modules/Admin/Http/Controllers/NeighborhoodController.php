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
use Modules\Admin\Entities\Neighborhood;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;  
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;



/**
 * Class NeighborhoodController
 */
class NeighborhoodController extends Controller
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
        View::share('viewPage', 'Neighborhood'); 
        View::share('heading', 'Neighborhoods');
        View::share('route_url', route('neighborhood'));
        View::share('date_format',date('m-d-Y'));

        $this->record_per_page = Config::get('app.record_per_page');
        $this->indexUrl     = 'admin::neighborhood.index';
        $this->createUrl    = 'admin::neighborhood.create';
        $this->editUrl      = 'admin::neighborhood.edit';
        $this->defaultUrl   = route('neighborhood');
        $this->createMessage = 'Record created successfully.';
        $this->updateMessage = 'Record updated successfully.';
        $this->deleteMessage=  'Record deleted successfully.';
    }

    protected $users;

    /*
     * Dashboard
     * */

    public function index(Neighborhood $neighborhood, Request $request)
    {
        $page_title  = ucfirst(Route::currentRouteName());
        $page_action = 'View '.ucfirst(Route::currentRouteName());

        
        // Search by name ,email and group
        $search    = $request->get('search');
        $status    = $request->get('status'); 

        if ((isset($search) && !empty($search)) or  (isset($status) && !empty($status))) {
           
            $neighborhood = Neighborhood::where(function ($query) use ($search,$status) {
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
            $neighborhood = Neighborhood::orderBy('id', 'desc')->where('status', '=', 1)->Paginate($this->record_per_page);
        }
        
        return view($this->indexUrl, compact( 'status', 'neighborhood', 'page_title', 'page_action'));
    }

    /*
     * create Neighborhood method
     * */

    public function create(Neighborhood $neighborhood)
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
        $thai_html   = view::make('admin::neighborhood.form_thai',compact('th','neighborhood'));
 
         
        return view($this->createUrl, compact('th','thai_html','neighborhood','country','url', 'page_title', 'page_action'));  
    }

    /*
     * Save neighborhood method
     * */

    public function store(Request $request, Neighborhood $neighborhood)
    {

        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'name'       => 'required|unique:project_neighborhoods,name|min:3',
            'distance'  => 'required|numeric'
        ]);
 

        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
         
        $neighborhood->fill($request->all()); 

        if($request->get('distance')){
            $neighborhood->distance = $request->get('distance');
        } 

        if($request->get('name_th')){
            $neighborhood->name_th = $request->get('name_th');
        } 

        if($request->get('distance_th')){
            $neighborhood->distance_th = $request->get('distance_th');
        }

        if($request->file('icon')){
            $neighborhood->icon = $request->file('icon')->store('neighborhood');
        } 

        if($request->file('icon_th')){
            $neighborhood->icon_th = $request->file('icon_th')->store('neighborhood');
        } 

        $neighborhood->contents = json_encode($request->all());  
        $neighborhood->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->createMessage);
    }

    /*
     * Edit neighborhood method
     * @param
     * object : $neighborhood
     * */

    public function edit(Neighborhood $neighborhood)
    {    
        $page_title  =  str_replace(['.'],' ', ucfirst(Route::currentRouteName()));
        $page_action =  str_replace('.',' ', ucfirst(Route::currentRouteName()));

        $url =  url(Storage::url('app/'.$neighborhood->icon));
        $url_th =  url(Storage::url('app/'.$neighborhood->icon_th));


         $showCountry = \DB::table('countries')
                        ->where('deleted_at',NULL)
                        ->pluck('country_id')
                        ->toArray();

        $country = \DB::table('all_countries')
                    ->whereIn('id',$showCountry)
                    ->get();

        $th = "th"; 
        $thai_html   = view::make('admin::neighborhood.form_thai',compact('th','neighborhood','url_th'));
       
        return view($this->editUrl, compact('th','thai_html','neighborhood','country','url', 'page_title', 'page_action','url_th'));  

    }

    public function update(Request $request, Neighborhood $neighborhood)
    {
        $neighborhood->fill($request->all());

        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validator = Validator::make($request->all(), [
            'country'  => 'required',
            'name'     => 'required|min:3',
            'distance' => 'required|numeric'
        ]);

        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        if($request->file('icon')){
            $neighborhood->icon = $request->file('icon')->store('neighborhood');
        } 

        if($request->file('icon_th')){
            $neighborhood->icon_th = $request->file('icon_th')->store('neighborhood');
        } 
        
        if($request->get('distance')){
            $neighborhood->distance = $request->get('distance');
        } 

        if($request->get('name_th')){
            $neighborhood->name_th = $request->get('name_th');
        } 

        if($request->get('distance_th')){
            $neighborhood->distance_th = $request->get('distance_th');
        }    
        $neighborhood->contents = json_encode($request->all());   
        $neighborhood->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->updateMessage);
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request, Neighborhood $neighborhood)
    {
        $neighborhood_id = \DB::table('projects')->where('neighborhood_id',$neighborhood->id)->get();
        if($neighborhood_id->count()){
           return Redirect::to($this->defaultUrl)
                    ->with('flash_alert_notice', 'This neighborhood already associated with project so this Can not be deleted.'); 
        }

        $neighborhood->delete();
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->deleteMessage);
    }

    public function show(Neighborhood $neighborhood)
    {
    }
}
