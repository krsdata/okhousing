<?php

namespace Modules\Countries\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Countries\Entities\Countries;
use Modules\Countries\Entities\Allcountries;
use Modules\Countries\Entities\Alllanguages;
use Modules\Countries\Entities\Countrylangs;
use Yajra\DataTables\DataTables;
use File;
use \Validator;
use \Illuminate\Support\Facades\Session;
 
class AdminCountriesController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function index()
    { 
        return view('countries::admin.index');
    }

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function AllCountries()
    {
        return Datatables::of(Countries::with('created_countries')->orderBy('id', 'DESC')->get())->make(true);
    }
/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
        $languages = Alllanguages::where('lang_code','!=','en')->orderBy('name')->get();
        return view('countries::admin.create',compact('languages'));
    }

/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function store(Request $request)
    {
        
        $checkCountry=Allcountries::find($request->country_id);
        
        if($checkCountry=null)
        {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Country not created successfully.We are unable to find the requested country"); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }else
        {
            $country                = new Countries;
            $country->country_id    = $request->country_id;
            $country->status        = $request->status;
            $code                   = $request->code;
           
            /*Generate country folder*/

            if(!file_exists(public_path()."/site/font/". $code))
            {
                File::makeDirectory(public_path()."/site/font/". $code, 0775, true);
            }
            
            if(isset($request->setlangs))
            {
                $country->save();
                $id = $country->id;
                /* 
                 * inserting language for country
                 */
                foreach($request->setlangs as $lang)
                {
                    $resultArray=array();
 
                    for($i=0;$i<count($request->input('languages'));$i++)
                    {
                        if( (isset($request->input('languages')[$i])) && (isset($request->file('fonts')[$i])) )
                        {
                            /* languages name*/
                            $resultArray[$i]['languages']=$request->input('languages')[$i]; 
                            /* languages font*/
                            $extension = $request->file('fonts')[$i]->getClientOriginalExtension();
                            $fontname[$i] = time().'_' . rand(100, 999).'.'.$extension;
                            $destinationPath = public_path()."/site/font/". $code;
                            $request->file('fonts')[$i]->move($destinationPath, $fontname[$i]);
                            $resultArray[$i]['fonts']=$fontname[$i];

                           /* languages Is default or not*/
                            $resultArray[$i]['isDefault']=$request->input('is_default')[$i];

                             /* languages is active or not*/
                            $resultArray[$i]['lang_status']=$request->input('is_active')[$i];  
                        }      
                    }

                    if($lang==1)
                    {
                        $englArray=array('0'=> array('languages'=>'1','fonts'=>'','isDefault'=>'1','lang_status'=>'1'));
                        $resultArray = array_merge($englArray,$resultArray);
                    }
                    else if($lang==0)
                    {
                        $englArray=array('0'=>array('languages'=>'1','fonts'=>'','isDefault'=>'0','lang_status'=>'1'));
                        $resultArray = array_merge($resultArray,$englArray);
                    }

                    if(!empty($resultArray))
                    {
                        $i=0;
                        $count= count($resultArray);
                        $msg='';
                        foreach ($resultArray as  $value) 
                        {
                            $language=Alllanguages::select('lang_code')->where('id',$value['languages'])->first();
                            /* Generate language folder */
                            if(!file_exists(base_path()."/Modules/Countries/Resources/lang/".$language->lang_code))
                            {
                                File::makeDirectory(base_path()."/Modules/Countries/Resources/lang/".$language->lang_code, 0775, true);
                            }

                            $countrylang= new Countrylangs;
                            $countrylang->font_path=$value['fonts'];
                            $countrylang->created_country_id=$id;
                            $countrylang->language_id=$value['languages'];
                            $countrylang->isDefault =$value['isDefault'];
                            $countrylang->is_active=$value['lang_status'];
                            try{
                                $countrylang->save();
                                $i++;
                            } catch (Exception $ex) {
                                $msg=$ex->getMessage();
                            }
                        }
                        if($count==$i)
                        {
                            $request->session()->flash('val', 1);
                            $request->session()->flash('msg', "Country created successfully."); 
                            return response()->json(['status'=>true,'url'=>URL('o4k/countries/'),'csrf' => csrf_token()]); 
                        }

                        else
                        {
                            $request->session()->flash('val', 0);
                            $request->session()->flash('msg', "Country not created successfully.".$msg); 
                            return response()->json(['status'=>false,'csrf' => csrf_token()]);

                        }
                    }
                    else
                    {
                        $request->session()->flash('val', 0);
                        $request->session()->flash('msg', "Country not created successfully."); 
                        return response()->json(['status'=>false,'csrf' => csrf_token()]);
                    }   
                }
 
                /* 
                 * ending language for country
                 */

            }
            else
            {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Country not created successfully."); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
            }
        
        }
        
    }

/**
    * Show the specified resource.
    * @return Response
*/

    public function show()
    {
        return view('countries::show');
    }

/**
    * Show the form for editing the specified resource.
    * @return Response
*/

    public function edit($id)
    {
        $country = Countries::with('created_countries')->where('status',1)->where('id',$id)->first();

        if($country==null) { return redirect('/o4k/404'); }
        else
        {
            $defaultlang = Countrylangs::where(array('created_country_id'=>$id,'language_id'=>1))->first();
            $countrylang=Countrylangs::with('languages')->where('created_country_id', '=', $id)->whereNotIn( 'language_id', [1])->get();
            $languages = Alllanguages::orderBy('name')->get();
            return view('countries::admin.edit',compact('country','languages','defaultlang','countrylang'));
        }
    }

/**
    * Update the specified resource in storage.
    * @param  Request $request
    * @return Response
*/
    public function update($id,Request $request)
    {
       
        $country                = Countries::find($id);
        if($country==null)
        {    $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Country not created successfully."); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else{
            $country->country_id    = $request->hidcountryId;
            $country->status        = $request->status;
            $code                   = $request->code;
            if(isset($request->setlangs)){

                try{

                    $country->save();
                    foreach($request->setlangs as $lang)
                    {
                        $resultArray=array();
     
                        for($i=0;$i<count($request->input('languages'));$i++)
                        {

                            if( (isset($request->input('languages')[$i])) )
                            {
                                /* languages name*/
                                $resultArray[$i]['languages']=$request->input('languages')[$i]; 

                                /* languages font*/
                                
                                if(!empty($request->file('fonts')[$i])){
                                    $extension = $request->file('fonts')[$i]->getClientOriginalExtension();
                                    $fontname[$i] = time().'_' . rand(100, 999).'.'.$extension;
                                    $destinationPath = public_path()."/site/font/". $code;
                                    $request->file('fonts')[$i]->move($destinationPath, $fontname[$i]);
                                    $resultArray[$i]['fonts']=$fontname[$i];
                                }else{
                                    $resultArray[$i]['fonts']=$request->fonts[$i];
                                }
                                
                               /* languages Is default or not*/
                                $resultArray[$i]['isDefault']=$request->input('is_default')[$i];

                                 /* languages is active or not*/
                                $resultArray[$i]['lang_status']=$request->input('is_active')[$i];  
                            }      
                        }
                        if($lang==1)
                        {
                            $englArray=array('0'=> array('languages'=>'1','fonts'=>'','isDefault'=>'1','lang_status'=>'1'));
                            $resultArray = array_merge($englArray,$resultArray);
                        }
                        else if($lang==0)
                        {
                            $englArray=array('0'=>array('languages'=>'1','fonts'=>'','isDefault'=>'0','lang_status'=>'1'));
                            $resultArray = array_merge($resultArray,$englArray);
                        }
                        if(!empty($resultArray)){ 
                            Countrylangs::where('created_country_id',$id)->forceDelete();
                            foreach ($resultArray as  $value) {
                                $country->countrylangs()->attach($value['languages'], ['isDefault' => $value['isDefault'],'font_path' =>  $value['fonts'],'is_active'=>$value['lang_status']]);
                                
                            }
                        }
                        
                    }
                    $request->session()->flash('val', 1);
                    $request->session()->flash('msg', "Country updated successfully."); 
                    return response()->json(['status'=>true,'url'=>URL('o4k/countries/'),'csrf' => csrf_token()]); 

                }
                catch (Exception $ex) {  
                    $request->session()->flash('val', 0);
                    $request->session()->flash('msg', "Country not updated successfully."); 
                    return response()->json(['status'=>false,'csrf' => csrf_token()]);
                } 
                
            }

        }
        

    }

/**
    * Remove the specified resource from storage.
    * @return Response
*/

    public function destroy($id)
    {
		$countries = Countries::find($id);
		if($countries==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $countries->delete();

                Countrylangs::where('created_country_id',$id)->get()->each->delete();
                
                Session::flash('val', 1);
                Session::flash('msg', "Country deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/countries');
        }
    }
 /**   
   *fetch all countries
 */

    public function list_allcountries(Request $request)
    {
        $countries = Allcountries::doesntHave('countries')->select('id','name as text','flag','code','currency','currency_code','symbol')->where('name', 'like', $request->key . '%')->get();
        return response()->json(['results'=>$countries]);

    }
}
