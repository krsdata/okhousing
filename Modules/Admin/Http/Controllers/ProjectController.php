<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;
 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Modules\Countries\Entities\Countries;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\Project;
use Modules\Admin\Entities\Neighborhood;
use Modules\Admin\Entities\Area; 
use Modules\Admin\Entities\Grade; 
use Modules\Admin\Entities\Finishes as ProjectFinishes; 
use Modules\Projects\Entities\BuildingUnits as ProjectUnit;
use Modules\Projects\Entities\Landarea;
use Modules\Projects\Entities\LandUnits;
use Modules\Projects\Entities\Amenities as ProjectAmineties;
use Modules\Projects\Entities\PropertyCategory as ProjectCategory;
use Modules\Projects\Entities\PropertyCountryLangs as ProjectCountryLangs;
use Modules\Projects\Entities\PropertyList as ProjectList;
use Modules\Projects\Entities\PropertyType as ProjectType; 
use Modules\Admin\Entities\ProjectStatus as Status;
use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Modules\Admin\Entities\Plan;
use Yajra\DataTables\DataTables;
use \Validator,Storage;
use Input,Route,View,DB;
use \Illuminate\Support\Facades\Session;

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


    public function prepareChart(Request $request){

        header('Content-Type:text/html');

        $flats = $request->get('flats');
        $floors = $request->get('floors'); 

        $bhk =  explode(',',$request->get('bhk')); 
        $unit = ProjectUnit::pluck('unit','id');
        
        $bhks = view::make('admin::project.bhkChart',compact('bhk','unit'));
        
        $prepareChart   = view::make('admin::project.prepareChart',compact('flats','floors','bhk','unit'));
       
        echo $prepareChart.$bhks;
         
        exit(); 
    }

    /*
     * create plan method
     * */

    public function create(Request $request,  Project $project)
    {
        $page_title  =  str_replace(['.'],' ', ucfirst(Route::currentRouteName()));
        $page_action =  str_replace('.',' ', ucfirst(Route::currentRouteName()));
        $url = null;


        $plans = Plan::pluck('name','id');
        $category = ProjectCategory::where('parent_id',null)->get();
        $type = ProjectType::where('parent_id',null)->get();
        $area = Area::all();
        $unit = ProjectUnit::pluck('unit','id');
 
        $project_status =  Status::pluck('name','id');

        $status_image = "";
        $image_video = "";
        $extra_feature = "";
        $amenities = ProjectAmineties::where('parent_id',null)->get();
        $neighbourhood = Neighborhood::all();
        $finishes = ProjectFinishes::all();
        $grade = Grade::all();


        $flats = 0;
        $floors = 0;

        $prepareChart   = ""; // view::make('admin::project.prepareChart',compact('flats','floors'));

        $bhkChart = view::make('admin::project.bhkChart',compact('flats','floors'));
       
        return view($this->createUrl, compact('project','url', 'page_title', 'page_action','finishes','neighbourhood','amenities','plans','category','type','unit','project_status','area','grade','flats','floors','prepareChart','bhkChart'));
    }

    /*
     * Save project method
     * */

    public function store(Request $request,Project $project)
    {
        $messages = [
            'builder_code.required' => 'Please enter builder code!',
            'builder_code.exists' => 'Please enter valid builder code!',
            'plan.required' => 'Please select project plan!',
            'name.required' => 'Please enter project name!',
            'location.required' => 'Please enter project location!',
            //'status_date.*.required' => 'Please enter project status!',
        ];

        $request->validate([
            'builder_code' => 'required', 
            'plan'=>'required',
            'name' => 'required',
            'location' => 'required',
            'about_project' => 'required',
            'builder_code' => 'required|exists:builders,builder_code'
           // 'status_date.*' => 'required',
        ],$messages);


       // dd($request->all());

        $table_cname = \Schema::getColumnListing('projects');
        $except = ['id','created_at','updated_at','deleted_at'];
        
        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           } 
           if($request->file($value) && is_array($request->file($value))){
                $img_url = [];
                foreach ($request->file($value) as $key => $result) {
                    $img_url[] = Admin::uploadImage($request, 'project' ,$result);
                }

                $project->$value = json_encode($img_url);

           }else if(is_array($request->get($value))){
                $project->$value = json_encode($request->get($value));
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


        $plans = Plan::pluck('name','id');
        $category = ProjectCategory::where('parent_id',null)->get();
        $type = ProjectType::where('parent_id',null)->get();
        $area = Area::all();
        $unit = ProjectUnit::pluck('unit','id');
        $project_status =  Status::pluck('name','id');

        $status_image = "";
        $image_video = "";
        $extra_feature = "";
        $amenities = ProjectAmineties::where('parent_id',null)->get();
        $neighbourhood = Neighborhood::all();
        $finishes = ProjectFinishes::all();
        $grade = Grade::all();

        $builder = \Modules\Admin\Entities\Builder::where('builder_code',$project->builder_code)->first();
       
        $advantage_request  = json_decode($project->advantage)->request;
        $finishes_request   = json_decode($project->finishes)->request;

         $flats = 0;
        $floors = 0;

        $prepareChart   = ""; // view::make('admin::project.prepareChart',compact('flats','floors'));

        $bhkChart = view::make('admin::project.bhkChart',compact('flats','floors'));

        return view($this->editUrl, compact('project','url', 'page_title', 'page_action','finishes','neighbourhood','amenities','plans','category','type','unit','project_status','unit','grade','builder','advantage_request','finishes_request','bhkChart','prepareChart'));  
    }

    public function update(Request $request, $project)
    {
        $messages = [
            'builder_code.required' => 'Please enter builder code!',
            'builder_code.exists' => 'Please enter valid builder code!',
            'plan.required' => 'Please select project plan!',
            'name.required' => 'Please enter project name!',
            'location.required' => 'Please enter project location!',
            //'status_date.*.required' => 'Please enter project status!',
        ];

        $request->validate([
            'builder_code' => 'required', 
            'plan'=>'required',
            'name' => 'required',
            'location' => 'required',
            'about_project' => 'required',
            'builder_code' => 'required|exists:builders,builder_code'
           // 'status_date.*' => 'required',
        ],$messages);


       // dd($request->all());

        $table_cname = \Schema::getColumnListing('projects');
        $except = ['id','created_at','updated_at','deleted_at'];
        
        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           } 
           if($request->file($value) && is_array($request->file($value))){
                $img_url = [];
                foreach ($request->file($value) as $key => $result) {
                    $img_url[] = Admin::uploadImage($request, 'project' ,$result);
                }

                $project->$value = json_encode($img_url);

           }else if(is_array($request->get($value))){
                $project->$value = json_encode($request->get($value));
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
