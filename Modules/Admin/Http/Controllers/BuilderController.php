<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Controllers;

 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Modules\Countries\Entities\Countries;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\Builder;
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
class BuilderController extends Controller
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
        View::share('viewPage', 'Builders'); 
        View::share('heading', 'Builders');
        View::share('route_url', route('builder'));
        View::share('date_format',date('m-d-Y'));

        $this->record_per_page = Config::get('app.record_per_page');
        $this->indexUrl     = 'admin::builder.index';
        $this->createUrl    = 'admin::builder.create';
        $this->editUrl      = 'admin::builder.edit';
        $this->defaultUrl   = route('builder');
        $this->createMessage = 'Record created successfully.';
        $this->updateMessage = 'Record updated successfully.';
        $this->deleteMessage=  'Record deleted successfully.';
    }

    protected $users;

    /*
     * buliders list
     * */

    public function index(Request $request,Builder $builder)
    {
        $page_title  = ucfirst(Route::currentRouteName());
        $page_action = 'View '.ucfirst(Route::currentRouteName());


         if ($request->ajax() || 1) {
            $code           = $request->get('code');
            $builder_code =  Builder::where('builder_code',trim($code))->first();
             
            if($builder_code){
                echo json_encode(['status'=>true,'url'=>URL('/o4k/builder?code='.$code),'csrf' => csrf_token(),'data'=>$builder_code,'profile'=>url($builder_code->builder_cover_picture)]); 
            } else{
                 echo json_encode(['status'=>false,'url'=>URL('/o4k/builder?code='.$code),'csrf' => csrf_token(),'data'=>$builder_code,'profile'=>null]); 
            }
           
            
            exit();
        }
        
        // Search by name ,email and group
        $search    = $request->get('search');
        $status    = $request->get('status'); 

        if ((isset($search) && !empty($search)) or  (isset($status) && !empty($status))) {
           
            $builders = Builder::where(function ($query) use ($search,$status) {
                if (!empty($search)) {
                    $query->Where('builder_name', 'LIKE', "%$search%");
                }

                if (!empty($status)) {
                    
                    $status =  ($status == 'active')?1:0;
                    $query->Where('status', $status);
                }

                 
            })->Paginate($this->record_per_page);
        } else {
            $builders = Builder::orderBy('id', 'desc')->Paginate($this->record_per_page);
        }

        return view($this->indexUrl, compact( 'status', 'builders', 'page_title', 'page_action'));
    }

    /*
     * create plan method
     * */

    public function create(Request $request,Builder $builder)
    {
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        $page_title  =  str_replace(['.'],' ', ucfirst(Route::currentRouteName()));
        $page_action =  str_replace('.',' ', ucfirst(Route::currentRouteName()));
        $url = null;
        $num = 1000;
        $code = Builder::orderBy('id','desc')->first();
        
        $builder->builder_code = "BLD-".($num+1+($code->id));
        
        return view($this->createUrl, compact('builder','url', 'page_title', 'page_action','countries'));  
    }

    /*
     * Save plan method
     * */

    public function store(Request $request,Builder $builder)
    {
        $request->validate([
            'builder_name' => 'required', 
            'mobile' => 'required', 
            'location' => 'required', 
            'email' => 'required|email',
            'country' => 'required'
        ]);


        $table_cname = \Schema::getColumnListing('builders');
        $except = ['id','created_at','updated_at','deleted_at'];
        
        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           } 
           if($request->file($value)){
                $builder->$value = Admin::uploadImage($request, 'builder' ,$value);

           }else if($request->get($value)){
                $builder->$value = $request->get($value);
           }
           
        }

         $builder->save(); 
         
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->createMessage);


    }

    /*
     * Edit plan method
     * @param
     * object : $user
     * */

    public function edit(Builder $builder)
    {    
        $page_title  =  str_replace(['.'],' ', ucfirst(Route::currentRouteName()));
        $page_action =  str_replace('.',' ', ucfirst(Route::currentRouteName()));
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();

        $num = 1000;
        if(empty($builder->builder_code)){
            $builder->builder_code = "BLD-".($num+($builder->id));
        }
        
         
        return view($this->editUrl, compact('builder','url', 'page_title', 'page_action','countries'));
    }

    public function update(Request $request, $builder)
    {
       $table_cname = \Schema::getColumnListing('builders');
        $except = ['id','created_at','updated_at','deleted_at'];
        
        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           } 
           if($request->file($value)){
                $builder->$value = Admin::uploadImage($request, 'builder' ,$value);

           }else if($request->get($value)){
                $builder->$value = $request->get($value);
           }
           
        }

         $builder->save(); 
         
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->createMessage);
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request,$builder)
    {
        $builder->delete();
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->deleteMessage);
    }

    public function show()
    {
    }
}
