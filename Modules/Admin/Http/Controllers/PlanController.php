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
use Storage;


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
         
        return view($this->createUrl, compact('plan','url', 'page_title', 'page_action'));  
    }

    /*
     * Save plan method
     * */

    public function store(Request $request, Plan $plan)
    {
        
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validator = Validator::make($request->all(), [
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
         
        return view($this->editUrl, compact('plan','url', 'page_title', 'page_action'));
    }

    public function update(Request $request, Plan $plan)
    {
        $plan->fill($request->all());

        if($request->file('plan_image')){
            $plan->plan_image = $request->file('plan_image')->store('plans');
        }    
        
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
