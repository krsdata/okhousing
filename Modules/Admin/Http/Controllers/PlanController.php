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
use Modules\Admin\Entities\Plan;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;  
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;



/**
 * Class PlanController
 */
class PlanController extends Controller
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
        View::share('viewPage', 'Plans'); 
        View::share('heading', 'Plans');
        View::share('route_url', route('plan'));
        View::share('date_format',date('m-d-Y'));

        $this->record_per_page = Config::get('app.record_per_page');
        $this->indexUrl     = 'admin::plan.index';
        $this->createUrl    = 'admin::plan.create';
        $this->editUrl      = 'admin::plan.edit';
        $this->defaultUrl   = route('plan');
        $this->createMessage = 'Record created successfully.';
        $this->updateMessage = 'Record updated successfully.';
        $this->deleteMessage=  'Record deleted successfully.';
    }

    protected $users;

    /*
     * Dashboard
     * */

    public function index(Plan $plan, Request $request)
    {
        $page_title  = ucfirst(Route::currentRouteName());
        $page_action = 'View '.ucfirst(Route::currentRouteName());

        
        // Search by name ,email and group
        $search    = $request->get('search');
        $status    = $request->get('status'); 

        if ((isset($search) && !empty($search)) or  (isset($status) && !empty($status))) {
           
            $plans = Plan::where(function ($query) use ($search,$status) {
                if (!empty($search)) {
                    $query->Where('name', 'LIKE', "%$search%");
                }

                if (!empty($status)) {
                    
                    $status =  ($status == 'active')?1:0;
                    $query->Where('status', $status);
                }

                 
            })->where('status', '=', 1)->Paginate($this->record_per_page);
        } else {
            $plans = Plan::orderBy('id', 'desc')->where('status', '=', 1)->Paginate($this->record_per_page);
        }
        

        return view($this->indexUrl, compact( 'status', 'plans', 'page_title', 'page_action', 'roles', 'role_type'));
    }

    /*
     * create plan method
     * */

    public function create(Plan $plan)
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
        $thai_html   = view::make('admin::plan.form_thai',compact('th'));
 
         
        return view($this->createUrl, compact('th','thai_html','plan','country','url', 'page_title', 'page_action'));  
    }

    /*
     * Save plan method
     * */

    public function store(Request $request, Plan $plan)
    {
        
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'name'       => 'required|unique:plans,name|min:3',
            'image_size'  => 'required|numeric',
            'features'  => 'required',
            'plan_image' => 'mimes:jpg,png,jpeg,svg,gif'
        ]);
 

        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
         
        $plan->fill($request->all()); 

        if($request->file('plan_image')){
            $plan->plan_image = $request->file('plan_image')->store('plans');
        } 

        if($request->file('plan_image_th')){
            $plan->plan_image_th = $request->file('plan_image_th')->store('plans');
        }    

        $plan->contents = json_encode($request->all());  
        $plan->save(); 


        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->createMessage);
    }

    /*
     * Edit plan method
     * @param
     * object : $user
     * */

    public function edit(Plan $plan)
    {    
        $page_title  =  str_replace(['.'],' ', ucfirst(Route::currentRouteName()));
        $page_action =  str_replace('.',' ', ucfirst(Route::currentRouteName()));

        $url =  url(Storage::url('app/'.$plan->plan_image));

         $showCountry = \DB::table('countries')
                        ->where('deleted_at',NULL)
                        ->pluck('country_id')
                        ->toArray();

        $country = \DB::table('all_countries')
                    ->whereIn('id',$showCountry)
                    ->get();

        $contents = json_decode($plan->contents); 
       

        $plan->country          =  $contents->country;
        $plan->price_in_india   =  $contents->price_in_india;
        $plan->price_in_thailand=  $contents->price_in_thailand;
        $plan->features_th      =  $contents->features_th;
        $plan->image_size_th    =  $contents->image_size_th;        
        
        $url_th = url(Storage::url('app/'.$plan->plan_image_th));

        $th = "th"; 
        $thai_html   = view::make('admin::plan.form_thai',compact('th','plan','url_th'));
         
        return view($this->editUrl, compact('th','thai_html','plan','country','url', 'page_title', 'page_action','url_th'));  

    }

    public function update(Request $request, Plan $plan)
    {
        $plan->fill($request->all());

        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'name'       => 'required|min:3',
            'image_size'  => 'required|numeric',
            'features'  => 'required',
            'plan_image' => 'mimes:jpg,png,jpeg,svg,gif'
        ]);

        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        
        if($request->file('plan_image')){
            $plan->plan_image = $request->file('plan_image')->store('plans');
        } 

        if($request->file('plan_image_th')){
            $plan->plan_image_th = $request->file('plan_image_th')->store('plans');
        }    

        $plan->contents = json_encode($request->all());   
        
        $plan->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->updateMessage);
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request, $plan)
    {
         $plan->delete();
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->deleteMessage);
    }

    public function show(User $user)
    {
    }
}
