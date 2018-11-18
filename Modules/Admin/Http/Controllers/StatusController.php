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
use Modules\Admin\Entities\ProjectStatus as Status;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;  
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;



/**
 * Class statusController
 */
class StatusController extends Controller
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
        View::share('viewPage', 'Status'); 
        View::share('heading', 'Status');
        View::share('route_url', route('status'));
        View::share('date_format',date('m-d-Y'));

        $this->record_per_page = Config::get('app.record_per_page');
        $this->indexUrl     = 'admin::status.index';
        $this->createUrl    = 'admin::status.create';
        $this->editUrl      = 'admin::status.edit';
        $this->defaultUrl   = route('status');
        $this->createMessage = 'Record created successfully.';
        $this->updateMessage = 'Record updated successfully.';
        $this->deleteMessage=  'Record deleted successfully.';
    }

    /*
     * Dashboard
     * */

    public function index(Status $status, Request $request)
    {

        $page_title  = ucfirst(Route::currentRouteName());
        $page_action = 'View '.ucfirst(Route::currentRouteName());
        
        // Search by name ,email and group
        $search    = $request->get('search'); 

        if (!empty($search)) {
           
            $status = Status::where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->Where('name', 'LIKE', "%$search%");
                    $query->orWhere('name_th', 'LIKE', "%$search%");
                }
 
                 
            })->Paginate($this->record_per_page);
        } else {
            $status = Status::orderBy('id', 'desc')->Paginate($this->record_per_page);
        }
        
        return view($this->indexUrl, compact( 'status', 'page_title', 'page_action'));
    }

    /*
     * create Status method
     * */

    public function create(Status $status)
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
        $thai_html   = view::make('admin::status.form_thai',compact('th','status'));
         
        return view($this->createUrl, compact('th','thai_html','status','country','url', 'page_title', 'page_action'));  
    }

    /*
     * Save status method
     * */

    public function store(Request $request, Status $status)
    {
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'name'       => 'required|unique:project_status,name|min:1',
        ]);
 

        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
         
        $status->fill($request->all()); 

        $status->contents = json_encode($request->all());  
        $status->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->createMessage);
    }

    /*
     * Edit status method
     * @param
     * object : $status
     * */

    public function edit(Status $status)
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
       
        
        $th = "th"; 
        $thai_html   = view::make('admin::status.form_thai',compact('th','status'));
       
        return view($this->editUrl, compact('th','thai_html','status','country','url', 'page_title', 'page_action'));  

    }

    public function update(Request $request, Status $status)
    {
        $status->fill($request->all());

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
        $status->contents = json_encode($request->all());   
        $status->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->updateMessage);
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Status $status)
    {
        $status_id = \DB::table('projects')->where('project_status',$status->id)->get();
        if($status_id->count()){
           return Redirect::to($this->defaultUrl)
                    ->with('flash_alert_notice', 'This status already associated with project so this Can not be deleted.'); 
        }

        $status->delete();
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->deleteMessage);
    }

    public function show(Status $status)
    {
    }
}
