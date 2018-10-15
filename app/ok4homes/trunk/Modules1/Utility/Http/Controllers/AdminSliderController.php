<?php

namespace Modules\Utility\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Users\Entities\Users;
use Modules\Users\Entities\UserCountry;
use Modules\Users\Entities\UserDetails;
use Modules\Module\Entities\Modules;
use Modules\Countries\Entities\Countries;
use Modules\Users\Entities\UserModules;
use Modules\Countries\Entities\Countrylangs;
use Modules\Countries\Entities\Alllanguages;
use \Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use \Validator;
use DB;
use Mail;
use Config;
use Modules\Properties\Entities\SliderList;

class AdminSliderController extends Controller
{
    
    public function utility()
    {
        return view('utility::admin.slider.utility.index');
    }

    public function allutilitylists()
    {

        $utilityId=Modules::select('id')->where('slug','utility')->first();
        if($utilityId){
        $resultArray = array();
        $utilitys = SliderList::with('utility_data')->where('slider_element_type','Utility')->get();

       
                foreach ($utilitys as $key => $utility) {
                    if( Arr::exists($utility, 'utility_data') ){
                        $userCountry = UserCountry::with('user_details')->where('user_id', $utility->utility_data->id)->first();
                        /* fetch user name in english */
                        $countrylang = Countrylangs::where(array('created_country_id' => $userCountry->country_id, 'language_id'=>1))->first();
                        if($userCountry && $countrylang){
                            $countryId = $userCountry->id;
                            $langId =  $countrylang->id;
                            $resultData = UserCountry::with(['created_users','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id',$langId);}])->where('user_id',$utility->utility_data->id)->first();

                            if($resultData){
                                $resultArray[$key]['id'] = $utility->id;
                                $resultArray[$key]['name'] = $resultData->created_userdetails[0]->name;
                                $resultArray[$key]['page_type'] = $utility->page_type;
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
       $utilityId=Modules::select('id')->where('slug','utility')->first();
        if($utilityId){
            $resultArray = array();
            $utilitys = UserModules::with('created_users')->where('module_id',$utilityId->id)->get();
            
                foreach ($utilitys as $key => $utility) {
                    if( Arr::exists($utility, 'created_users') ){
                        $userCountry = UserCountry::with('user_details')->where('user_id', $utility->created_users->id)->first();
                        /* fetch user name in english */
                        $countrylang = Countrylangs::where(array('created_country_id' => $userCountry->country_id, 'language_id'=>1))->first();
                        if($userCountry && $countrylang){
                            $countryId = $userCountry->id;
                            $langId =  $countrylang->id;
                            $resultData = UserCountry::with(['created_users','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id',$langId);}])->where('user_id',$utility->created_users->id)->first();

                            if($resultData){
                                $resultArray[$key]['id'] = $utility->id;
                                $resultArray[$key]['name'] = $resultData->created_userdetails[0]->name;
                            }
                        
                        }
                    }
            
                }           
        }
        $UtilityList = $resultArray;
        return view('utility::admin.slider.utility.create', compact('UtilityList'));
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
        $propertylists->slider_element_type ='Utility'; 
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
            $request->session()->flash('msg', "Slider utility created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/sliderutility/'),'csrf' => csrf_token()]);
        }
        catch (Exception $ex) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Slider utility not added successfully.".$e->getMessage()); 
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
        $Utility = SliderList::find($id);
        if($Utility==null) { return redirect('/o4k/404'); }
        else
        {
            $utilityId=Modules::select('id')->where('slug','utility')->first();
            if($utilityId){
                $resultArray = array();
                $utilitys = UserModules::with('created_users')->where('module_id',$utilityId->id)->get();
                
                    foreach ($utilitys as $key => $utility) {
                        if( Arr::exists($utility, 'created_users') ){
                            $userCountry = UserCountry::with('user_details')->where('user_id', $utility->created_users->id)->first();
                            /* fetch user name in english */
                            $countrylang = Countrylangs::where(array('created_country_id' => $userCountry->country_id, 'language_id'=>1))->first();
                            if($userCountry && $countrylang){
                                $countryId = $userCountry->id;
                                $langId =  $countrylang->id;
                                $resultData = UserCountry::with(['created_users','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id',$langId);}])->where('user_id',$utility->created_users->id)->first();

                                if($resultData){
                                    $resultArray[$key]['id'] = $utility->id;
                                    $resultArray[$key]['name'] = $resultData->created_userdetails[0]->name;
                                }
                            
                            }
                        }
                
                    }           
            }
            $UtilityList = $resultArray;
            //dd($UtilityList);
            return view('utility::admin.slider.utility.edit', compact('Utility','UtilityList'));
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
        $propertylists->slider_element_type ='Utility'; 
        $propertylists->page_type = implode(",",$request->page);
        try{
            $propertylists->save();
            
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Slider utility updated successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/sliderutility/'),'csrf' => csrf_token()]);
        }
        catch (Exception $ex) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Slider utility not updated successfully.".$e->getMessage()); 
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
                Session::flash('msg', "Property List deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/sliderutility');
        }
    }

}
