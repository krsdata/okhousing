<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Category;
use Modules\Admin\Entities\CategoryType;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Countries\Entities\Countrylangs;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::admin.Category.index');
    }

    public function allCategorylists()
    {

        return Datatables::of(Category::with('created_type')->where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $Category=Category::get();
        $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        $CategoryType = CategoryType::where('language_id',1)->where('status',1)->get();
        return view('admin::admin.Category.create', compact('Category','languages','CategoryType'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, ['title_en' => 'required|unique_cateory:categories,title,NULL,id']);
        $Categorylists = new Category;
        $Categorylists->title = $request->title_en; 
        $Categorylists->status =$request->status; 
        $Categorylists->language_id = $request->language_en;
        $Categorylists->master_category_id  = $request->CategoryType;
                
        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."categories'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {
                    $nextId = $tableStatus[0]->Auto_increment; 
                    $Categorylists->id=(1+$nextId);


                    try{
                    $Categorylists->save();
                    $id = $Categorylists->id;

                    $names = $request->title;
                    if(!empty($names) && $names!=''){
                        $languages = $request->language;
                        foreach($names as $key => $value):
                            $Categorylists = new Category;
                            $Categorylists->master_category_id  = $request->CategoryType;
                            $Categorylists->parent_id = $id;
                            $Categorylists->language_id = $languages[$key];
                            $Categorylists->title = $names[$key];
                            $Categorylists->status = $request->status;
                            $Categorylists->save();
                        endforeach;
                    }

                    $request->session()->flash('val', 1);
                    $request->session()->flash('msg', "Category created successfully !");
                    return response()->json(['status'=>true,'url'=>URL('/o4k/Category/'),'csrf' => csrf_token()]);
                }
                catch (Exception $ex) {
                    $request->session()->flash('val', 0);
                    $request->session()->flash('msg', "Category not added successfully.".$e->getMessage()); 
                    return response()->json(['status'=>false,'csrf' => csrf_token()]);
                }
        }
       
    }


    

   

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        
        $Category = Category::with('types')->find($id);
        if($Category==null){return redirect('/o4k/404');}
        else{
             $CategoryType = CategoryType::where('language_id',1)->where('status',1)->get();
            $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
           return view('admin::admin.Category.edit', compact('Category','languages','CategoryType'));
        }

        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

        $this->validate($request, ['title_en' => 'required|unique_cateory:categories,title,$id,id']);
        
        $Categorylists = Category::find($id);
        if($Categorylists==null){ 
        $request->session()->flash('val', 0);
        $request->session()->flash('msg', "Category not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            $Categorylists->title = $request->title_en; 
            $Categorylists->status =$request->status; 
            $Categorylists->language_id = $request->language_en;
            $Categorylists->master_category_id  = $request->CategoryType;
            try{
                $Categorylists->save();
                $ids = $request->ids;

                Category::where('parent_id',$id)->get()->each->delete();

                $names = $request->title;
                if(!empty($names) && $names!=''){
                    $languages = $request->language;
                    $slugs = $request->slug;
                    if($ids){
                        foreach($ids as $key => $value):
                            $Categorylists = new Category;
                            $Categorylists->master_category_id  = $request->CategoryType;
                            $Categorylists->parent_id = $id;
                            $Categorylists->language_id = $languages[$key];
                            $Categorylists->title = $names[$key];
                            $Categorylists->status = $request->status;
                            $Categorylists->save();
                        endforeach;
                    }
                    
                }


                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Category updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/Category/'),'csrf' => csrf_token()]);
            }
            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Category not updated successfully.".$e->getMessage()); 
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
        $Categorylists = Category::find($id);
        if($Categorylists==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $Categorylists->delete();

                $Categorylists = Category::where('parent_id',$id)->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Category deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/Category');
        }
    }

}
