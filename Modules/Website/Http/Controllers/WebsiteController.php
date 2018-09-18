<?php
   
namespace Modules\Website\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Countries\Entities\Allcountries;
use Modules\Countries\Entities\Alllanguages;
use Modules\Countries\Entities\Countrylangs;
use Modules\Countries\Entities\Countries;
use Modules\Properties\Entities\SliderList;
use Modules\Users\Entities\Users;
use Modules\Users\Entities\UserCountry;
use Modules\Users\Entities\UserDetails;
use Modules\Module\Entities\Modules;
use Modules\Users\Entities\UserModules;
use Modules\Admin\Entities\BackgroundImage;
use Session;
use Illuminate\Support\Arr;
use \Illuminate\Support\Facades\Input;
use Modules\Admin\Entities\Menu;
use App;
use Modules\Properties\Entities\PropertyList;
use Modules\Properties\Entities\PropertyCountryLangs;

use  Modules\Properties\Entities\PropertyCategory;


class WebsiteController extends Controller
{
     
    /**
     * Display a listing of the resource.
     * @return Response  hi
     */
     public function index()
    { 
        
        //dd($resultArray);
        $get=Input::all();
        if( Arr::exists($get, 'loc') && Arr::exists($get, 'lan') )
        {
            /* check the country has lang */
            $flag       =   $get['loc'];
            $langCode   =   $get['lan'];
            $Country=Allcountries::with(['countries' => function ($query) {$query->where('status','1');}])->where('flag',$flag)->first();
             
            if($Country != null )
            { 
                /* getting the language */
                if( Arr::exists($Country, 'countries') )
                {
                    $id=$Country['countries']->id;
                    $Language=Alllanguages::with(['created_language' => function ($query) use ($id)
                    {
                        $query->where('is_active','1');
                        $query->where('created_country_id',$id); 
                    }])->where('lang_code',$langCode)->first();
                  
                    if($Language !=null )
                    { 
                        if(Arr::exists($Language, 'created_language'))
                        {

                            $CountryArr=array();
                            $CountryArr['id']=$Country->id;
                            $CountryArr['name']=$Country->name;
                            $CountryArr['flag']=$Country->flag;
                            $CountryArr['code']=$Country->code;
                            $CountryArr['created_country_id']=$Country['countries']->id;
                            $CountryArr['callingCodes']=$Country->callingCodes;
                            
                            $LanguageArr=array();
                            $LanguageArr['id']=$Language->id;
                            $LanguageArr['name']=$Language->name;
                            $LanguageArr['lang_code']=$Language->lang_code;
                            $LanguageArr['created_country_id']=$Language['created_language']->created_country_id;
                            $LanguageArr['created_language_id']=$Language['created_language']->id;
                             
                            Session::put('fcountry',$CountryArr);
                            Session::put('fcountry_language',$LanguageArr);
                            App::setLocale($Language->lang_code);
                            Session::put('locale',$Language->lang_code);

                            return view('website::web.home.home');
                            
                        }else{/* redirect to 404 */return redirect('/404'); } 
                    }else{/* redirect to 404 */return redirect('/404'); }  
                }else{/* redirect to 404 */ return redirect('/404');  }    
            }else {/* redirect to 404 */ return redirect('/404'); } 
        }
        else
        {
            if(empty($get))
            {
                /* check country and defult lang if session not set */
                if(!Session::has('fcountry'))
                { 
                    $ip                    =   \Request::ip(); 

            
                    $data                  =   \Location::get($ip);
                    
                   
                    if($data)
                    {
                        if(Arr::exists($data, 'countryCode'))
                        {
                            $countryArray           =   array();
                            $countryLanguageArray   =   array();
                            $flag                   =   $data->countryCode;
                            $userCountry            =   Allcountries::with(['countries' => function ($query) 
                                                        {
                                                            $query->where('status','1');
                                                        }])->where('flag',$flag)->first();
                            if($userCountry != null)
                            {
                                if(Arr::exists($userCountry, 'countries'))
                                {
                                    /* getting country language  */ 
                                    $countryLanguage=Countrylangs::with('languages')->where('created_country_id',$userCountry['countries']->id)->where(array('is_active'=>'1','isDefault'=>1))->first();
                                    if($countryLanguage != null)
                                    {
                                        if(Arr::exists($countryLanguage, 'languages'))
                                        { 

                                            
                                            $CountryArr=array();
                                            $CountryArr['id']=$userCountry->id;
                                            $CountryArr['name']=$userCountry->name;
                                            $CountryArr['flag']=$userCountry->flag;
                                            $CountryArr['code']=$userCountry->code;
                                            $CountryArr['callingCodes']=$userCountry->callingCodes;
                                            $CountryArr['created_country_id']=$userCountry['countries']->id;
                                            $CountryArr['symbol']=$userCountry->symbol;
 
                                            $LanguageArr=array();
                                            $LanguageArr['id']=$countryLanguage['languages']->id;
                                            $LanguageArr['name']=$countryLanguage['languages']->name;
                                            $LanguageArr['lang_code']=$countryLanguage['languages']->lang_code;
                                            $LanguageArr['created_country_id']=$countryLanguage->created_country_id;
                                            $LanguageArr['created_language_id']=$countryLanguage->id;
 
                                            Session::put('fcountry',$CountryArr); 
                                            Session::put('fcountry_language',$LanguageArr);
                                            App::setLocale($countryLanguage['languages']->lang_code);
                                            Session::put('locale',$countryLanguage['languages']->lang_code);
                                            
                                            return view('website::web.home.home');

                                        }else{ return redirect('/500'); }   
                                    }else { return redirect('/500'); }  
                                }  else {  return redirect('/not-avilabile'); }   
                            }else { return redirect('/404');  }    
                        }else { return redirect('/500'); } 
                        
                    }else { return redirect('/500'); }
                }
                else  {  /* session is set */    return view('website::web.home.home'); }   
            }else {/* redirect to 404 */ return redirect('/404'); }       
        } 
        
//        echo App::getLocale();
//        return view('website::web.home.home');
    }

    
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function get_country(Request $request)
    {

       // dd(Session::has('fcountry'));
//        if($request->ajax())
//        { 
                /* check on-load*/
                if(!Session::has('fcountry'))
                {
                    $ip                    =   \Request::ip(); 
                    $data                  =   \Location::get($ip);
                    if($data)
                    {  
                        if(Arr::exists($data, 'countryCode'))
                        {
                            $countryArray           =   array();
                            $countryLanguageArray   =   array();
                            $flag                   =   $data->countryCode;
                            $userCountry            =   Allcountries::with(['countries' => function ($query) 
                                                        {
                                                            $query->where('status','1');
                                                        }])->where('flag',$flag)->first();                          
                            if($userCountry != null)
                            {
                                if(Arr::exists($userCountry, 'countries'))
                                {   
                                    
                                    $id         =   $userCountry['countries']->country_id;
                                    $AllCountry =   Countries::with(array('created_countries' => function($query) use ($id) 
                                                    { $query->where('status','1');}))->where('country_id','!=',$id)
                                                    ->where('status','1')->get();
                                        
                                   
                                    /* getting country Defualt language  */ 
                                    $countryDefualtLanguage=Countrylangs::with('languages')->where('created_country_id',$userCountry['countries']->id)->where(array('is_active'=>'1','isDefault'=>1))->first();
                                    if($countryDefualtLanguage != null)
                                    {
                                        if(Arr::exists($countryDefualtLanguage, 'languages'))
                                        {
                                           
                                            /* getting country all remaing language with out Defualt language */ 
                                             $countryLanguages  =   Countrylangs::with('languages')
                                                                    ->where('created_country_id',$userCountry['countries']->id)
                                                                    ->where('id','!=',$countryDefualtLanguage->id)
                                                                    ->where(array('is_active'=>'1')) 
                                                                    ->get();
                                           
                                            if($countryLanguages->isNotEmpty())  { $returnlangHTML = (String) view( 'website::web.sections.header_countrylanguage_dropdown_menu',compact('countryDefualtLanguage','countryLanguages'));     }
                                            else { $returnlangHTML = (String) view( 'website::web.sections.header_countrylanguage_dropdown_menu',compact('countryDefualtLanguage'));       }
                                            $returnCountryHTML = (String) view( 'website::web.sections.header_country_dropdown_menu',compact('userCountry','AllCountry') );   
                                        
                                            $CountryArr=array();
                                            $CountryArr['id']=$userCountry->id;
                                            $CountryArr['name']=$userCountry->name;
                                            $CountryArr['flag']=$userCountry->flag;
                                            $CountryArr['code']=$userCountry->code;
                                            $CountryArr['symbol']=$userCountry->symbol;
 
                                            $CountryArr['created_country_id']=$userCountry['countries']->id;
                                            $CountryArr['callingCodes']=$userCountry->callingCodes;
                                            
                                            $LanguageArr=array();
                                            $LanguageArr['id']=$countryDefualtLanguage['languages']->id;
                                            $LanguageArr['name']=$countryDefualtLanguage['languages']->name;
                                            $LanguageArr['lang_code']=$countryDefualtLanguage['languages']->lang_code;
                                            $LanguageArr['created_country_id']=$countryDefualtLanguage->created_country_id;
                                            $LanguageArr['created_language_id']=$countryDefualtLanguage->id;
  
                                            Session::put('fcountry',$CountryArr); 
                                            Session::put('fcountry_language',$LanguageArr); 
                                            Session::put('locale',$countryDefualtLanguage['languages']->lang_code);
                                            App::setLocale($countryDefualtLanguage['languages']->lang_code); 
                                            return response()->json(['response'=>true,'CountryHtml'=>$returnCountryHTML,'LanguageHtml'=>$returnlangHTML]);
                                            
                                        }else { return response()->json(['status'=>false,'url'=>URL('/500')]);} 
                                    }else { return response()->json(['status'=>false,'url'=>URL('/500')]);}      
                                }else { return response()->json(['status'=>false,'url'=>URL('/not-avilabile')]);}  
                            }else { return response()->json(['status'=>false,'url'=>URL('/not-avilabile')]);}      
                        
                            
                        }else { return response()->json(['status'=>false,'url'=>URL('/500')]);}   
                    }else { return response()->json(['status'=>false,'url'=>URL('/500')]);}        
                }
                else
                {
                    $fcountry           = Session::get('fcountry'); 
                    $fcountry_language  = Session::get('fcountry_language'); 
                     
                    $userCountry            =   Allcountries::with(['countries' => function ($query) 
                                                        {
                                                            $query->where('status','1');
                                                        }])->where('flag',$fcountry['flag'])->first();
                                                      
                    if($userCountry != null)
                    {
                        if(Arr::exists($userCountry, 'countries'))
                        {
                           
                            $id         =   $userCountry['countries']->country_id;
                            $AllCountry =   Countries::with(array('created_countries' => function($query) use ($id) 
                                            { $query->where('status','1');}))->where('country_id','!=',$id)
                                            ->where('status','1')->get();
                            
                            /* getting country Defualt language  */  
                            $flid=$fcountry_language['id'];
                            $countryDefualtLanguage  =   Countrylangs::with(['languages' => function ($query) use ($flid)
                                                        {
                                                            $query->where('status','1');
                                                            $query->where('id',$flid); 
                                                        }])->where('id',$fcountry_language['created_language_id'])->first();  
                       
                            if($countryDefualtLanguage != null)
                            {
                                if(Arr::exists($countryDefualtLanguage, 'languages'))
                                {

                                    /* getting country all remaing language with out Defualt language */ 
                                    $countryLanguages   =   Countrylangs::with('languages')
                                                            ->where('created_country_id',$fcountry['created_country_id'])
                                                            ->where('id','!=',$countryDefualtLanguage->id)
                                                            ->where(array('is_active'=>'1')) 
                                                            ->get(); 
                                    if($countryLanguages->isNotEmpty())  { $returnlangHTML = (String) view( 'website::web.sections.header_countrylanguage_dropdown_menu',compact('countryDefualtLanguage','countryLanguages'));     }
                                    else { $returnlangHTML = (String) view( 'website::web.sections.header_countrylanguage_dropdown_menu',compact('countryDefualtLanguage'));       }
                                    $returnCountryHTML = (String) view( 'website::web.sections.header_country_dropdown_menu',compact('userCountry','AllCountry') );   
                                    return response()->json(['response'=>true,'CountryHtml'=>$returnCountryHTML,'LanguageHtml'=>$returnlangHTML]);

                                }else { return response()->json(['status'=>false,'url'=>URL('/500')]);} 
                            }else { return response()->json(['status'=>false,'url'=>URL('/500')]);}  
//                                            
                                            
                                            
                        }else { return response()->json(['status'=>false,'url'=>URL('/not-avilabile')]);}
                    }else { return response()->json(['status'=>false,'url'=>URL('/not-avilabile')]);} 
                                                        
                                                 
                                   
                } 
//        } else {/* redirect to 404 */ return redirect('/404'); } 
 
    }

    public function notAvilabile()
    {


        $countryArray           =   array();
        $countryLanguageArray   =   array();
        $flag                   =   'IN';
        $userCountry            =   Allcountries::with(['countries' => function ($query) 
                                    {
                                        $query->where('status','1');
                                    }])->where('flag',$flag)->first();
        if($userCountry != null)
        {
            if(Arr::exists($userCountry, 'countries'))
            {
                /* getting country language  */ 
                $countryLanguage=Countrylangs::with('languages')->where('created_country_id',$userCountry['countries']->id)->where(array('is_active'=>'1','isDefault'=>1))->first();
                if($countryLanguage != null)
                {
                    if(Arr::exists($countryLanguage, 'languages'))
                    { 

                        
                        $CountryArr=array();
                        $CountryArr['id']=$userCountry->id;
                        $CountryArr['name']=$userCountry->name;
                        $CountryArr['flag']=$userCountry->flag;
                        $CountryArr['code']=$userCountry->code;
                        $CountryArr['callingCodes']=$userCountry->callingCodes;
                        $CountryArr['created_country_id']=$userCountry['countries']->id;
                        $CountryArr['symbol']=$userCountry->symbol;

                        $LanguageArr=array();
                        $LanguageArr['id']=$countryLanguage['languages']->id;
                        $LanguageArr['name']=$countryLanguage['languages']->name;
                        $LanguageArr['lang_code']=$countryLanguage['languages']->lang_code;
                        $LanguageArr['created_country_id']=$countryLanguage->created_country_id;
                        $LanguageArr['created_language_id']=$countryLanguage->id;

                        Session::put('fcountry',$CountryArr); 
                        Session::put('fcountry_language',$LanguageArr);
                        App::setLocale($countryLanguage['languages']->lang_code);
                        Session::put('locale',$countryLanguage['languages']->lang_code);
                        
                        return view('website::web.home.home1');

                    }else{ return redirect('/500'); }   
                }else { return redirect('/500'); }  
            }  else {  return redirect('/not-avilabile'); }   
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    
    public function change_country($slug=null,$is_home=0,Request $request)
    {
        if($request->ajax())
        {
            if($slug)
            {
                $userCountry            =   Allcountries::with(['countries' => function ($query) 
                                                            {
                                                                $query->where('status','1');
                                                            }])->where('flag',$slug)->first();

                if($userCountry != null)
                {
                    if(Arr::exists($userCountry, 'countries'))
                    {   

                        $id         =   $userCountry['countries']->country_id;
                        $AllCountry =   Countries::with(array('created_countries' => function($query) use ($id) 
                                        { $query->where('status','1');}))->where('country_id','!=',$id)
                                        ->where('status','1')->get();


                        /* getting country Defualt language  */ 
                        $countryDefualtLanguage=Countrylangs::with('languages')->where('created_country_id',$userCountry['countries']->id)->where(array('is_active'=>'1','isDefault'=>1))->first();
                        if($countryDefualtLanguage != null)
                        {
                            if(Arr::exists($countryDefualtLanguage, 'languages'))
                            {

                                /* getting country all remaing language with out Defualt language */ 
                                 $countryLanguages  =   Countrylangs::with('languages')
                                                        ->where('created_country_id',$userCountry['countries']->id)
                                                        ->where(array('is_active'=>'1','isDefault'=>0)) 
                                                        ->get();

                                if($countryLanguages->isNotEmpty())  { $returnlangHTML = (String) view( 'website::web.sections.header_countrylanguage_dropdown_menu',compact('countryDefualtLanguage','countryLanguages'));     }
                                else { $returnlangHTML = (String) view( 'website::web.sections.header_countrylanguage_dropdown_menu',compact('countryDefualtLanguage'));       }
                                $returnCountryHTML = (String) view( 'website::web.sections.header_country_dropdown_menu',compact('userCountry','AllCountry') );   

                                $CountryArr=array();
                                $CountryArr['id']=$userCountry->id;
                                $CountryArr['name']=$userCountry->name;
                                $CountryArr['flag']=$userCountry->flag;
                                $CountryArr['code']=$userCountry->code;
                                $CountryArr['symbol']=$userCountry->symbol;
 
                                $CountryArr['created_country_id']=$userCountry['countries']->id;

                                $LanguageArr=array();
                                $LanguageArr['id']=$countryDefualtLanguage['languages']->id;
                                $LanguageArr['name']=$countryDefualtLanguage['languages']->name;
                                $LanguageArr['lang_code']=$countryDefualtLanguage['languages']->lang_code;
                                $LanguageArr['created_country_id']=$countryDefualtLanguage->created_country_id;
                                $LanguageArr['created_language_id']=$countryDefualtLanguage->id;

                                Session::put('fcountry',$CountryArr); 
                                Session::put('fcountry_language',$LanguageArr); 
                                Session::put('locale',$countryDefualtLanguage['languages']->lang_code); 
                                if($is_home==1)
                                {
                                    /* home pages */
                                    $urlAppend='/?loc='.$userCountry->flag.'&lan='.$countryDefualtLanguage['languages']->lang_code;
                                }
                                else
                                { 
                                    /* inner pages */
                                   // $urlAppend=URL('/500');
                                    //$urlAppend='/'.$userCountry->flag.'/'.$countryDefualtLanguage['languages']->lang_code;  
                                    $urlAppend='/?loc='.$userCountry->flag.'&lan='.$countryDefualtLanguage['languages']->lang_code; 
                                }

                                return response()->json(['response'=>true,'urlAppend'=>$urlAppend]);

                            }else { return response()->json(['status'=>false,'url'=>URL('/500')]);} 
                        }else { return response()->json(['status'=>false,'url'=>URL('/500')]);}      
                    }else { return response()->json(['status'=>false,'url'=>URL('/not-avilabile')]);}  
                }else { return response()->json(['status'=>false,'url'=>URL('/not-avilabile')]);}      




            }else { return response()->json(['status'=>false,'url'=>URL('/404')]); } 
        }else{ /* redirect to 404 */ return redirect('/404');  }
        
    }
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function change_language($slug=null,$is_home=0,Request $request)
    {
        if($request->ajax())
        {
            if(Session::has('fcountry'))
            {
                $fcountry           = Session::get('fcountry'); 
                $all_language=Alllanguages::where('lang_code',$slug)->first();
                if($all_language != null)
                {
                    /*check the country have the language*/
                    $countrylang    =   Countrylangs::with(['languages' => function ($query) 
                                    {
                                        $query->where('status','1'); 
                                    }])
                                    ->where(array('created_country_id'=>$fcountry['created_country_id'] , 'language_id'=>$all_language->id))
                                    ->first(); 
                                    if($countrylang != null)
                                    {
                                                $LanguageArr=array();
                                                $LanguageArr['id']=$countrylang['languages']->id;
                                                $LanguageArr['name']=$countrylang['languages']->name;
                                                $LanguageArr['lang_code']=$countrylang['languages']->lang_code;
                                                $LanguageArr['created_country_id']=$countrylang->created_country_id;
                                                $LanguageArr['created_language_id']=$countrylang->id;

                                                Session::put('fcountry_language',$LanguageArr); 
                                                Session::put('locale',$countrylang['languages']->lang_code);

                                                if($is_home==1)
                                                {
                                                    /* home pages */
                                                    $urlAppend=URL('/').'/?loc='.$fcountry['flag'].'&lan='.$countrylang['languages']->lang_code;
                                                }
                                                else
                                                { 
                                                    /* inner pages */
                                                    $urlAppend=URL('/500');
                    //                             $urlAppend=''.$userCountry->flag.'/'.$countryDefualtLanguage['languages']->lang_code;   
                                                }

                                                return response()->json(['response'=>true,'urlAppend'=>$urlAppend]);

                                    }else { return response()->json(['status'=>false,'url'=>URL('/404')]);    }

                }else  { return response()->json(['status'=>false,'url'=>URL('/404')]);   }
            }else  { return response()->json(['status'=>false,'url'=>URL('/404')]);   }

        }else{ /* redirect to 404 */ return redirect('/404');  }

    }

    // added by shweta 
    // for fetching slider data

    public function fetchSliderData()
    {

        $SliderList = SliderList::with('page_order')->whereRaw('FIND_IN_SET("Home",page_type)')->where('payment','!=','Pending')->where('start', '<=', date('Y-m-d H:i:s'))->where('end', '>=', date('Y-m-d H:i:s'))->get();
        $modules = array('Agents'=>'agent','Owners'=>'owner','Utility'=>'utility');
        $resultArray = array();
        
        $ffcountry_language = Session::get('fcountry_language');
        $Selected_lang = $ffcountry_language['id'];

        $fcountry=Session::get('fcountry');

        //echo"<br>".
       $countryId=$fcountry['created_country_id'];


        foreach($SliderList as $slide)
        {
            if($slide->slider_element_type == 'Property')
            {

               
                //echo"<br>".
                //$slide->slider_element_id;
                  DB::enableQueryLog();

                $FeaturedpropertyList = PropertyList::where('status','Active')->where('id',$slide->slider_element_id)->first();

               
                if($FeaturedpropertyList)
                {
                    
                    $property_details= PropertyCountryLangs::where('language_created_id',$Selected_lang)->where('country_id',$countryId)->where('property_id',$slide->slider_element_id)->first();

                   // echo"<pre>"; print_r($property_details);

                    if($property_details)
                    {
                        $result = SliderList::with(['property_image_data','page_order' => function ($query) {
                        $query->where('page','Home');
                        }])->where('id', $slide->id)->first();

                        $key = $result->page_order->row.'_'.$result->page_order->column;
                        $resultArray [$key] = array(
                            'id'=> $slide->slider_element_id,
                            'type'=> $slide->slider_element_type,
                            'image'=> (Arr::exists($result, 'property_image_data') ) ? @$result->property_image_data->image:'',
                            'title'=> @$property_details->title,
                            'prize'=> $this->money_format_slider_fe(@$FeaturedpropertyList->prize),
                            'location'=> @$FeaturedpropertyList->location,
                            'row'=>$result->page_order->row,
                            'column'=>$result->page_order->column
                        );
                    }
                    

                }
                
            }
            else
            {
                /*$utilitys = UserModules::with('created_users')->where('id',$slide->slider_element_id)->get();


                foreach ($utilitys as $key => $utility) {
                    if( Arr::exists($utility, 'created_users') ){
                        $userCountry = UserCountry::with('user_details')->where('user_id', $utility->created_users->id)->first();
                       
                        $countrylang = Countrylangs::where(array('created_country_id' => $userCountry->country_id, 'language_id'=>1))->first();
                        if($userCountry && $countrylang){
                            $countryId = $userCountry->id;
                            $langId =  $countrylang->id;
                            $resultData = UserCountry::with(['created_users','user_details','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id',$langId);}])->where('user_id',$utility->created_users->id)->first();

                            if($resultData){

                                
                                $resultArray [] =  array(
                                    'id'=> $slide->slider_element_id,
                                    'type'=> $slide->slider_element_type,
                                    'image'=> $utility->created_users->image,
                                    'title'=> $resultData->created_userdetails[0]->name,
                                    'prize'=> '',
                                    'location'=> $resultData->user_details[0]->name
                                );
                               
                            }
                        
                        }
                    }
            
                }*/
               
            }

        }
       // dd($resultArray);
        $SliderList = $resultArray;
        $returnsliderHTML = (String) view( 'website::web.sections.slider',compact('SliderList'));
        return response()->json(['response'=>true,'SliderHtml'=>$returnsliderHTML]);
    }

    public function sliderbackground()
    {

        $image=BackgroundImage::first();
        return response()->json(['response'=>true,'BackgroundImage'=> @$image->image]);
    }

    public function featuredProperty($id)
    {

        $catId = $id;

        $PropertyCategory= PropertyCategory::where('id',$catId)->first();

        $parent_id = $PropertyCategory->parent_id;

        $returnHTML = (String) view('website::web.model.featuredProperty',compact('catId','parent_id'));
        $MobilereturnHTML = (String) view('website::web.model.MobilefeaturedProperty',compact('catId','parent_id'));
        return response()->json(['status'=>true,'html'=>$returnHTML,'mobilehtml'=>$MobilereturnHTML]);
    }


    public function money_format_slider_fe($money){

            $fcountry=Session::get('fcountry');
            $country_flag = $fcountry['flag'];


            if($country_flag == 'in')
            {
                $len = strlen($money);
                $m = '';
                $money = strrev($money);
                for($i=0;$i<$len;$i++){
                    if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$len){
                        $m .=',';
                    }
                    $m .=$money[$i];
                }
                 return strrev($m);
            }
            else
            {
                return number_format($money);
            }
            
           
        }
}
