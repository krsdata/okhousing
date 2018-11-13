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
use Modules\Admin\Entities\Grade;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;  
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;



/**
 * Class GradeController
 */
class GradeController extends Controller
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
        View::share('viewPage', 'Grade'); 
        View::share('heading', 'Grades');
        View::share('route_url', route('grade'));
        View::share('date_format',date('m-d-Y'));

        $this->record_per_page = Config::get('app.record_per_page');
        $this->indexUrl     = 'admin::grade.index';
        $this->createUrl    = 'admin::grade.create';
        $this->editUrl      = 'admin::grade.edit';
        $this->defaultUrl   = route('grade');
        $this->createMessage = 'Record created successfully.';
        $this->updateMessage = 'Record updated successfully.';
        $this->deleteMessage=  'Record deleted successfully.';
    }

    /*
     * Dashboard
     * */

    public function index(Grade $grade, Request $request)
    {
        $page_title  = ucfirst(Route::currentRouteName());
        $page_action = 'View '.ucfirst(Route::currentRouteName());
        
        // Search by name ,email and group
        $search    = $request->get('search');
        $status    = $request->get('status'); 

        if ((isset($search) && !empty($search)) or  (isset($status) && !empty($status))) {
           
            $grade = Grade::where(function ($query) use ($search,$status) {
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
            $grade = Grade::orderBy('id', 'desc')->where('status', '=', 1)->Paginate($this->record_per_page);
        }
        
        return view($this->indexUrl, compact( 'status', 'grade', 'page_title', 'page_action'));
    }

    /*
     * create Neighborhood method
     * */

    public function create(Grade $grade)
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
        $thai_html   = view::make('admin::grade.form_thai',compact('th','grade'));
 
         
        return view($this->createUrl, compact('th','thai_html','grade','country','url', 'page_title', 'page_action'));  
    }

    /*
     * Save grade method
     * */

    public function store(Request $request, Grade $grade)
    {

        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'name'       => 'required|unique:project_grades,name|min:1',
        ]);
 

        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
         
        $grade->fill($request->all()); 

        $grade->contents = json_encode($request->all());  
        $grade->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->createMessage);
    }

    /*
     * Edit grade method
     * @param
     * object : $grade
     * */

    public function edit(Grade $grade)
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
        $thai_html   = view::make('admin::grade.form_thai',compact('th','grade','url_th'));
       
        return view($this->editUrl, compact('th','thai_html','grade','country','url', 'page_title', 'page_action','url_th'));  

    }

    public function update(Request $request, Grade $grade)
    {
        $grade->fill($request->all());

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
        $grade->contents = json_encode($request->all());   
        $grade->save(); 

        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->updateMessage);
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request, Grade $grade)
    {
        $grade_id = \DB::table('projects')->where('grade_id',$grade->id)->get();
        if($grade_id->count()){
           return Redirect::to($this->defaultUrl)
                    ->with('flash_alert_notice', 'This grade already associated with project so this Can not be deleted.'); 
        }

        $grade_id->delete();
        return Redirect::to($this->defaultUrl)
            ->with('flash_alert_notice', $this->deleteMessage);
    }

    public function show(Grade $grade)
    {
    }
}
