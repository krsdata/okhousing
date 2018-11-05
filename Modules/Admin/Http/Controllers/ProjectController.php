<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Modules\Countries\Entities\Countries;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\Project;
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
class ProjectController extends Controller
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
        View::share('viewPage', 'Project'); 
        View::share('heading', 'Project');
        View::share('route_url', route('project'));
        View::share('date_format',date('m-d-Y'));

        $this->record_per_page = Config::get('app.record_per_page');
        $this->indexUrl     = 'admin::project.index';
        $this->createUrl    = 'admin::project.create';
        $this->editUrl      = 'admin::project.edit';
        $this->defaultUrl   = route('project');
        $this->createMessage = 'Record created successfully.';
        $this->updateMessage = 'Record updated successfully.';
        $this->deleteMessage=  'Record deleted successfully.';
    }

    protected $users;

    /*
     * buliders list
     * */

    public function index(Request $request,Project $project)
    {
        $page_title  = ucfirst(Route::currentRouteName());
        $page_action = 'View '.ucfirst(Route::currentRouteName());

        
        // Search by name ,email and group
        $search    = $request->get('search');
        $status    = $request->get('status'); 

        if ((isset($search) && !empty($search)) or  (isset($status) && !empty($status))) {
           
            $projects = Project::where(function ($query) use ($search,$status) {
                if (!empty($search)) {
                    $query->Where('project_name', 'LIKE', "%$search%");
                }

                if (!empty($status)) {
                    
                    $status =  ($status == 'active')?1:0;
                    $query->Where('status', $status);
                }

                 
            })->Paginate($this->record_per_page);
        } else {
            $projects = Project::orderBy('id', 'desc')->Paginate($this->record_per_page);
        }

        return view($this->indexUrl, compact( 'status', 'projects', 'page_title', 'page_action'));
    }

    /*
     * create plan method
     * */

    public function create(Project $project)
    {
        $page_title  =  str_replace(['.'],' ', ucfirst(Route::currentRouteName()));
        $page_action =  str_replace('.',' ', ucfirst(Route::currentRouteName()));
        $url = null;


        $plans = "";
        $category = "";
        $type = "";
        $area = "";
        $unit = "";
        $status = ["Vacant Land","Residential","Commercial"];

        $status_image = "";
        $image_video = "";
        $extra_feature = "";
        $amenities = [];
        $neighbourhood = [];
        $finishes = [];
        



       
        return view($this->createUrl, compact('project','url', 'page_title', 'page_action'));  
    }

    /*
     * Save project method
     * */

    public function store(Request $request,Project $project)
    {
        $request->validate([
            'project_name' => 'required', 
        ]);


        $table_cname = \Schema::getColumnListing('projects');
        $except = ['id','created_at','updated_at','deleted_at'];
        
        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           } 
           if($request->file($value)){
                $project->$value = Admin::uploadImage($request, 'project' ,$value);

           }else if($request->get($value)){
                $project->$value = $request->get($value);
           }
           
        }

         $project->save(); 
         
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->createMessage);


    }

    /*
     * Edit project method
     * @param
     * object : $user
     * */

    public function edit(Project $project)
    {    
        $page_title  =  str_replace(['.'],' ', ucfirst(Route::currentRouteName()));
        $page_action =  str_replace('.',' ', ucfirst(Route::currentRouteName()));
         
         
        return view($this->editUrl, compact('project','url', 'page_title', 'page_action'));
    }

    public function update(Request $request, $project)
    {
       $table_cname = \Schema::getColumnListing('projects');
        $except = ['id','created_at','updated_at','deleted_at'];
        
        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           } 
           if($request->file($value)){
                $project->$value = Admin::uploadImage($request, 'project' ,$value);

           }else if($request->get($value)){
                $project->$value = $request->get($value);
           }
           
        }

        $project->save(); 
         
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->createMessage);
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request,$project)
    {
        $project->delete();
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->deleteMessage);
    }

    public function show()
    {
    }
}
