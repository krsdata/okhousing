<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\CategoryType;
use Modules\Properties\Entities\PropertyCategory;
use Modules\Admin\Entities\Sections;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Countries\Entities\Countrylangs;

class AdminFeaturedCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::admin.FeaturedCategory.index');
    }

    public function allFeaturedCategorylists()
    {

        return Datatables::of(PropertyCategory::with('created_type')->where('is_featured',1)->where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $Category=PropertyCategory::where('status',1)->where('language_id',1)->get();
        return view('admin::admin.FeaturedCategory.create', compact('Category'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $FeaturedCategorylists = PropertyCategory::find($request->FeaturedCategoryType);
        $FeaturedCategorylists->is_featured = 1; 
                
        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."categories'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {
                    
                    try{
                    $FeaturedCategorylists->save();
                    
                    $FeaturedCategorylists = PropertyCategory::where('parent_id',$request->FeaturedCategoryType)->update(['is_featured' => "1"]);
                   
                    $request->session()->flash('val', 1);
                    $request->session()->flash('msg', "Featured Category added successfully !");
                    return response()->json(['status'=>true,'url'=>URL('/o4k/FeaturedCategory/'),'csrf' => csrf_token()]);
                }
                catch (Exception $ex) {
                    $request->session()->flash('val', 0);
                    $request->session()->flash('msg', "Featured Category not added successfully.".$e->getMessage()); 
                    return response()->json(['status'=>false,'csrf' => csrf_token()]);
                }
        }
       
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $FeaturedCategorylists = PropertyCategory::find($id);
        $FeaturedCategorylists->is_featured = '0'; 
        if($FeaturedCategorylists==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $FeaturedCategorylists->save();

                 $FeaturedCategorylists = PropertyCategory::where('parent_id',$id)->update(['is_featured' => "0"]);

                Session::flash('val', 1);
                Session::flash('msg', "Featured Category removed successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/FeaturedCategory');
        }
    }



    public function sectionlist()
    {
        return view('admin::admin.sectionlist.index');
    }

    public function allsectionlists()
    {

        return Datatables::of(Sections::get())->make(true);
    }

    /**
    * Activate resource.
    * @return Response
*/

    public function activate($id)
    {
        $Sections = Sections::find($id);
        if($Sections==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
            
                $Sections->status='1';
                $Sections->save();
                Session::flash('val', 1);
                Session::flash('msg', "Sections activated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/FeaturedCategory/sectionlist');
        }
            
    }

/**
    * Deactivate resource.
    * @return Response
*/

    public function deactivate($id)
    {
        $Sections = Sections::find($id);
        if($Sections==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
            
                $Sections->status='0';
                $Sections->save();
                Session::flash('val', 1);
                Session::flash('msg', "Sections deactivated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/FeaturedCategory/sectionlist');
        }
    }

}
