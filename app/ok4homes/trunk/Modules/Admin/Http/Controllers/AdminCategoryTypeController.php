<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\CategoryType;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Countries\Entities\Countrylangs;

class AdminCategoryTypeController extends Controller
{
    

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function index()
    {
        
        return view('admin::admin.CategoryType.index');
        
    }

    public function CategoryTypeList()
    {

        return Datatables::of(CategoryType::where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        
        $CategoryType = CategoryType::with('types')->find($id);
        if($CategoryType==null){return redirect('/o4k/404');}
        else{
            $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
           return view('admin::admin.CategoryType.edit', compact('CategoryType','languages'));
        }

        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

        $CategoryTypelists = CategoryType::find($id);
        if($CategoryTypelists==null){ 
        $request->session()->flash('val', 0);
        $request->session()->flash('msg', "Category Type not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            $CategoryTypelists->title = $request->title_en; 
            $CategoryTypelists->status = $request->status; 
            $CategoryTypelists->language_id = $request->language_en;

            try{
               
                $CategoryTypelists->save();
                $ids = $request->ids;
                
                CategoryType::where('parent_id',$id)->get()->each->delete();

                $names = $request->title;

                if(!empty($names) && $names!=''){
                    $languages = $request->language;
                    if($ids){
                        foreach($ids as $key => $value):
                            $CategoryTypelists = new CategoryType;
                            $CategoryTypelists->parent_id = $id;
                            $CategoryTypelists->language_id = $languages[$key];
                            $CategoryTypelists->title = $names[$key];
                            $CategoryTypelists->status = $request->status; 
                            $CategoryTypelists->save();
                        endforeach;
                    }
                    
                }


                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Category Type updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/CategoryType/'),'csrf' => csrf_token()]);
            }
            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Category Type not updated successfully.".$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
            }
        }
    }

    
}
