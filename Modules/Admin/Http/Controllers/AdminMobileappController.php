<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Mobileapp;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Countries\Entities\Countrylangs;

class AdminMobileappController extends Controller
{
    

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function index()
    {
        
        $Mobileapp = Mobileapp::with('types')->first();
        if($Mobileapp==null){return redirect('/o4k/404');}
        else{
            $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
           return view('admin::admin.Mobileapp.index', compact('Mobileapp','languages'));
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        
        $Mobileapp = Mobileapp::with('types')->first();
        if($Mobileapp==null){return redirect('/o4k/404');}
        else{
            $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
           return view('admin::admin.Mobileapp.edit', compact('Mobileapp','languages'));
        }

        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

        $googleplay_image = $image =  $appstore_image = '';
        $Mobileapplists = Mobileapp::find($id);
        if($Mobileapplists==null){ 
        $request->session()->flash('val', 0);
        $request->session()->flash('msg', "Mobile app not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            $Mobileapplists->title = $request->title_en; 
            $Mobileapplists->sub_title      = $request->sub_title_en; 
            $Mobileapplists->language_id = $request->language_en;

            if($request->file('mobileapp_image')){
                $extension = $request->file('mobileapp_image')->getClientOriginalExtension();
                $iconname = time().'.'.$extension;
                $destinationPath = public_path() . "/images/Mobileapp/";
                $request->file('mobileapp_image')->move($destinationPath, $iconname);
                $image = $Mobileapplists->image      = $iconname;
             
            } 
            $Mobileapplists->appstore_status = $request->appstore_status;
            if($request->appstore_status == 1 )
            {
                $Mobileapplists->appstore_link = $request->appstore_link;
                if($request->file('appstore_image')){
                    $extension = $request->file('appstore_image')->getClientOriginalExtension();
                    $iconname = time().'appstore.'.$extension;
                    $destinationPath = public_path() . "/images/Mobileapp/";
                    $request->file('appstore_image')->move($destinationPath, $iconname);
                    $appstore_image = $Mobileapplists->appstore_image      = $iconname;
                } 

            }
            $Mobileapplists->googleplay_status   = $request->googleplay_status;
            if($request->googleplay_status   == 1 )
            {
                $Mobileapplists->googleplay_link = $request->googleplay_link;
                if($request->file('googleplay_image')){
                    $extension = $request->file('googleplay_image')->getClientOriginalExtension();
                    $iconname = time().'googleplay.'.$extension;
                    $destinationPath = public_path() . "/images/Mobileapp/";
                    $request->file('googleplay_image')->move($destinationPath, $iconname);
                    $googleplay_image = $Mobileapplists->googleplay_image      = $iconname;
                 
                } 
            
            }


            try{
                $Mobileapplists->save();
                $ids = $request->ids;

                Mobileapp::where('parent_id',$id)->get()->each->delete();
                

                $names = $request->title;

                if(!empty($names) && $names!=''){
                    $languages = $request->language;
                    $sub_title = $request->sub_title;
                    if($ids){
                        foreach($ids as $key => $value):
                            $Mobileapplists1 = new Mobileapp;
                            $Mobileapplists1->parent_id = $id;
                            $Mobileapplists1->language_id = $languages[$key];
                            $Mobileapplists1->title = $names[$key];
                            $Mobileapplists1->sub_title      =  $sub_title[$key];
                            $Mobileapplists1->googleplay_link = $request->googleplay_link;
                            $Mobileapplists1->googleplay_status   = $request->googleplay_status;
                            $Mobileapplists1->appstore_link = $request->appstore_link;
                            $Mobileapplists1->appstore_status = $request->appstore_status;
                            if($googleplay_image !=='')
                            {
                                $Mobileapplists1->googleplay_image = $googleplay_image;
                            }
                            else
                            {
                                 $Mobileapplists1->googleplay_image = $Mobileapplists->googleplay_image;
                            }
                            if($appstore_image !=='')
                            {
                                $Mobileapplists->appstore_image = $appstore_image;
                            }
                            else
                            {
                                 $Mobileapplists1->appstore_image = $Mobileapplists->appstore_image;
                            }
                            if($image !=='')
                            {
                                $Mobileapplists->image = $image;
                            }
                            else
                            {
                                 $Mobileapplists1->image = $Mobileapplists->image;
                            }
                            

                            $Mobileapplists1->save();
                        endforeach;
                    }
                    
                }


                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Mobile app updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/mobileapp/'),'csrf' => csrf_token()]);
            }
            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Mobileapp not updated successfully.".$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
            }
        }
    }

    
}
