<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\whyWe;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Countries\Entities\Countrylangs;

class AdminwhyWeController extends Controller
{
    

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function index()
    {
        
        return view('admin::admin.whyWe.index');
        
    }

    public function whyWeList()
    {

        return Datatables::of(whyWe::where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        
        $whyWe = whyWe::with('types')->find($id);
        if($whyWe==null){return redirect('/o4k/404');}
        else{
            $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
           return view('admin::admin.whyWe.edit', compact('whyWe','languages'));
        }

        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

        $image = '';

        $whyWelists = whyWe::find($id);
        if($whyWelists==null){ 
        $request->session()->flash('val', 0);
        $request->session()->flash('msg', "Category Type not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            $whyWelists->title = $request->title_en; 
            $whyWelists->sub_title = $request->subtitle_en;
            $whyWelists->language_id = $request->language_en;
            if($request->file('whyWe_image')){
                $extension = $request->file('whyWe_image')->getClientOriginalExtension();
                $iconname = time().'.'.$extension;
                $destinationPath = public_path() . "/images/whyWe/";
                $request->file('whyWe_image')->move($destinationPath, $iconname);
                $image = $whyWelists->image      = $iconname;
             
            } 

            try{
                $whyWelists->save();
                $ids = $request->ids;

                whyWe::where('parent_id',$id)->get()->each->delete();
                
                $names = $request->title;
                $subtitles = $request->subtitle;
                if(!empty($names) && $names!=''){
                    $languages = $request->language;
                    if($ids){
                        foreach($ids as $key => $value):
                            $whyWelists1 = new whyWe;
                            $whyWelists1->parent_id = $id;
                            $whyWelists1->language_id = $languages[$key];
                            $whyWelists1->title = $names[$key];
                            $whyWelists1->sub_title = $subtitles[$key];
                            if($image !=='')
                            {
                                $whyWelists1->image = $image;
                            }
                            else
                            {
                                $whyWelists1->image = $whyWelists->image;
                            }
                            $whyWelists1->save();
                        endforeach;
                    }
                    
                }


                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/whyWe/'),'csrf' => csrf_token()]);
            }
            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', " not updated successfully.".$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
            }
        }
    }

    
}
