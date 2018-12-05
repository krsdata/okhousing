<?php

namespace Modules\Owners\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Users\Entities\Users;
use Modules\Users\Entities\UserCountry;
use Modules\Users\Entities\UserDetails;
use Modules\Module\Entities\Modules;
use Modules\Users\Entities\UserModules;
use Modules\Countries\Entities\Countries;
use Modules\Countries\Entities\Countrylangs;
use Modules\Countries\Entities\Alllanguages;
use \Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use DB;
use Mail;
use Config; 
use \Validator;
use Modules\Properties\Entities\SliderList;

class AdminSliderController extends Controller
{
    
    public function utility()
    {
        return view('owners::admin.slider.owners.index');
    }

    public function allownerslists()
    {

        $ownerId=Modules::select('id')->where('slug','owner')->first();
        if($ownerId){
        $resultArray = array();
        $Owners = SliderList::with('created_users')->where('slider_element_type','Owners')->get();
        foreach ($Owners as $key => $owner) {
                    if( Arr::exists($owner, 'created_users') ){
                        $userCountry = UserCountry::with('user_details')->where('user_id', $owner->created_users->id)->first();
                        /* fetch user name in english */
                        $countrylang = Countrylangs::where(array('created_country_id' => $userCountry->country_id, 'language_id'=>1))->first();
                        if($userCountry && $countrylang){
                            $countryId = $userCountry->id;
                            $langId =  $countrylang->id;
                            $resultData = UserCountry::with(['created_users','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id',$langId);}])->where('user_id',$owner->created_users->id)->first();

                            if($resultData){
                                $resultArray[$key]['id'] = $owner->id;
                                $resultArray[$key]['name'] = $resultData->created_userdetails[0]->name;
                                $resultArray[$key]['page_type'] = $owner->page_type;
                                
                            }
                        
                        }
                    }
            
                }           
                return Datatables::of($resultArray)->make(true); 
        } 
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
       $ownerId=Modules::select('id')->where('slug','owner')->first();
        if($ownerId){
        $resultArray = array();
        $Owners = UserModules::with('created_users')->where('module_id',$ownerId->id)->get();
       
        foreach ($Owners as $key => $owner) {
                    if( Arr::exists($owner, 'created_users') ){
                        $userCountry = UserCountry::with('user_details')->where('user_id', $owner->created_users->id)->first();
                        /* fetch user name in english */
                        $countrylang = Countrylangs::where(array('created_country_id' => $userCountry->country_id, 'language_id'=>1))->first();
                        if($userCountry && $countrylang){
                            $countryId = $userCountry->id;
                            $langId =  $countrylang->id;
                            $resultData = UserCountry::with(['created_users','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id',$langId);}])->where('user_id',$owner->created_users->id)->first();

                            if($resultData){
                                $resultArray[$key]['id'] = $owner->id;
                                $resultArray[$key]['name'] = $resultData->created_userdetails[0]->name;
                                $resultArray[$key]['page_type'] = $owner->page_type;
                                
                            }
                        
                        }
                    }
            
                }           
        } 
        $OwnerList = $resultArray;
        return view('owners::admin.slider.owners.create', compact('OwnerList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, ['slider_element_id' => "composite_unique:slider"],
                                ['slider_element_id.composite_unique' => 'Duplicate entry']);

        $propertylists = new SliderList;
        $propertylists->slider_element_id = $request->slider_element_id; 
        $propertylists->slider_element_type ='Owners'; 
        $propertylists->page_type = implode(",",$request->page); 
        
        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."slider'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {
            $nextId = $tableStatus[0]->Auto_increment; 
            $propertylists->id=(1+$nextId);

            try{
            $propertylists->save();
            $id = $propertylists->id;
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Slider owner created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/sliderowners/'),'csrf' => csrf_token()]);
        }
        catch (Exception $ex) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Slider owner not added successfully.".$e->getMessage()); 
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
        $Owners = SliderList::find($id);
        if($Owners==null) { return redirect('/o4k/404'); }
        else
        {
            $ownerId=Modules::select('id')->where('slug','owner')->first();
            if($ownerId){
            $resultArray = array();
            $OwnersLists = UserModules::with('created_users')->where('module_id',$ownerId->id)->get();

            foreach ($OwnersLists as $key => $owner) {
                    if( Arr::exists($owner, 'created_users') ){
                        $userCountry = UserCountry::with('user_details')->where('user_id', $owner->created_users->id)->first();
                        /* fetch user name in english */
                        $countrylang = Countrylangs::where(array('created_country_id' => $userCountry->country_id, 'language_id'=>1))->first();
                        if($userCountry && $countrylang){
                            $countryId = $userCountry->id;
                            $langId =  $countrylang->id;
                            $resultData = UserCountry::with(['created_users','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id',$langId);}])->where('user_id',$owner->created_users->id)->first();

                            if($resultData){
                                $resultArray[$key]['id'] = $owner->id;
                                $resultArray[$key]['name'] = $resultData->created_userdetails[0]->name;
                                $resultArray[$key]['page_type'] = $owner->page_type;
                                
                            }
                        
                        }
                    }
            
                }           
        } 
        $OwnerList = $resultArray;
        
            return view('owners::admin.slider.owners.edit', compact('Owners','OwnerList'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {
        $this->validate($request, ['slider_element_id' => "composite_unique:slider"],
                                ['slider_element_id.composite_unique' => 'Duplicate entry']);

        $propertylists = SliderList::find($id);
        $propertylists->slider_element_id = $request->slider_element_id; 
        $propertylists->slider_element_type ='Owners'; 
        $propertylists->page_type = implode(",",$request->page);
        try{
            $propertylists->save();
            
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Slider owner updated successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/sliderowners/'),'csrf' => csrf_token()]);
        }
        catch (Exception $ex) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Slider owner not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $propertylists = SliderList::find($id);
        if($propertylists==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $propertylists->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Slider owner deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/sliderowners');
        }
    }

}
