<?php

namespace Modules\Agents\Http\Controllers;

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

class AdminAgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('agents::admin.index');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function allAgentsList()
    {
        $agentId=Modules::select('id')->where('slug','agent')->first();
        if($agentId)
        {
            $resultArray = array();
            $agents = UserModules::with('created_users')->where('module_id',$agentId->id)->get();
     
                foreach ($agents as $key => $agent) {
                    if( Arr::exists($agent, 'created_users') ){
                        $userCountry = UserCountry::with('user_details')->where('user_id', $agent->created_users->id)->first();
                        /* fetch user name in english */
                        $countrylang = Countrylangs::where(array('created_country_id' => $userCountry->country_id, 'language_id'=>1))->first();
                        if($userCountry && $countrylang){
                            $countryId = $userCountry->id;
                            $langId =  $countrylang->id;
                            $resultData = UserCountry::with(['created_users','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id',$langId);}])->where('user_id',$agent->created_users->id)->first();

                            if($resultData){
                                $resultArray[$key]['id'] = $resultData->created_users->id;
                                $resultArray[$key]['name'] = $resultData->created_userdetails[0]->name;
                                $resultArray[$key]['email'] = $resultData->created_users->email;
                                $resultArray[$key]['status'] = $resultData->created_users->status;
                                $resultArray[$key]['created_at'] = $resultData->created_users->created_at;
                            }
                        
                        }
                    }
            
                }           
                return Datatables::of($resultArray)->make(true); 
        }  
    }

    /**
     * Show the form for creating a new agents.
     * @return Response
     */
    public function create()
    {
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        return view('agents::admin.create',compact('countries'));
    }

    /**
     * Getting all lang for specified country 
     * @param  Request $request
     * @return Response
     */
    public function getlanguage($countryid,Request $request)
    { 
        if($request->ajax())
        {
            $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->get()->toArray();
            if(!empty($languages))
            {  
                $returnHTML = (String) view('agents::admin.sections.dynamic',compact('languages'));
                return response()->json(['status'=>true, 'html'=>$returnHTML,'csrf' => csrf_token()]);
            }else{return response()->json(['status'=>false, 'message'=>'Oops something went wrong','csrf' => csrf_token()]);}
        }else{return redirect('/404');}
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
            
//       use rules for validation
       
        /* check country with slug is exist with our created countries and its active*/
       
        /* check email is exist with this country*/    
       
        /* check mobile number is exist */   
       
        /* check status value is 0 or 1*/   
       
       /* check the file format is png/PNG/jpg/JPG/gif/GIF/jpeg/JPEG */ 
       
        /*check the name language is exist with  created country (lang_name means created laguage id) */ 
       
        /*check the about language is exist with  created country (lang_about means created laguage id) */

        $error=array();
        $created_country=$request->country;
            
                if($request->country){
    
                    $created_country_slug=$request->country_flag;

                    $country = Countries::with(['created_countries' => function($query) use ($created_country_slug){ 
                        $query->where('flag',$created_country_slug);
                        $query->where('status',1);
                    }])->where(array('id'=> $created_country, 'status'=> 1))->first();
                    if($country){
                       if( Arr::exists($country, 'created_countries') ){
                        if($country->created_countries->flag != $created_country_slug){
                            $error['country'] = 'Country  not found';
                        }
                       }else{
                            $error['country'] = 'Country  is not active';
                       }
                        
                    }else{
                        $error['country'] = 'Country  is not active';
                    }
                }else{
                    $error['country'] = 'This field is required';
                }

                /* check email is exist with this country*/    

                if($request->email){
                    $country=$request->country;
                    $emailUnique = Users::with(['created_usercountries' => function($query) use ($country){$query->where('country_id',$country);}])->where('email',$request->email)->first();
                    
                    if($emailUnique){
                         if( Arr::exists($emailUnique, 'created_usercountries') ){
                            $error['email'] = 'Email ID already exist';
                         }
                    }

                }else{
                    $error['email'] = 'This field is required';
                }

                /* check mobile number is exist */   

                if($request->mobile){
                    $mobile=$request->mobile;
                    $mobileUnique = UserCountry::where(array('mobile_number'=>$mobile))->first();

                    if($mobileUnique){
                        $error['mobile'] = 'Mobile number already exist';
                    }

                }else{
                    $error['mobile'] = 'This field is required';
                }

                /* check status value is 0 or 1*/ 

                if($request->status){
                    if($request->status == 0 || $request->status == 1){

                    }else{
                        $error['status'] = 'Invalid Status';
                    }
                }

                /* check the file format is png/PNG/jpg/JPG/gif/GIF/jpeg/JPEG */ 

                if($request->file('image')){
                    $supported_image = array('png','PNG','jpg','JPG','gif','GIF','jpeg','JPEG');
                    $ext = $request->file('image')->getClientOriginalExtension();
                    if (!in_array($ext, $supported_image)) {
                        $error['image'] = 'File format not support.';
                    } 
                }

                 /*check the name language is exist with  created country (lang_name means created laguage id) */ 

                if($request->name){

                    foreach (array_combine($request->name_lang_slug , $request->name_lang_id ) as $slug => $langId){
                        $checklang =  Countrylangs::with(['languages' => function ($query) use ($slug){$query->where('lang_code',$slug);$query->where('status',1);}])->where(array('id'=>$langId,'created_country_id'=>$created_country,'is_active'=>1))->first();
                        if($checklang == null){                       
                            $error['name_lang'] = 'Language not found.';                          
                        }
                    }

                }

                /*check the about language is exist with  created country (lang_about means created laguage id) */

                if($request->about){

                    foreach (array_combine($request->about_lang_slug , $request->about_lang_id ) as $slug => $langId){
                        $checklang =  Countrylangs::with(['languages' => function ($query) use ($slug){$query->where('lang_code',$slug);$query->where('status',1);}])->where(array('id'=>$langId,'created_country_id'=>$created_country,'is_active'=>1))->first();
                        if($checklang == null){                       
                            $error['about_lang'] = 'Language not found.';                          
                        }
                    }

                }


                if(!empty($error)){
                    return response()->json(['status'=>0,'errArr'=>$error]);
                }else{
                    /* save the user as a agent and send mail to the user with login details */
                    
                    $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."users'");
                    if (empty($tableStatus)) {
                        $request->session()->flash('val', 0);
                        $request->session()->flash('msg', "User not created successfully.Table not found"); 
                        return response()->json(['status'=>false,'csrf' => csrf_token()]);
                    }else{

                        $agentId=Modules::select('id')->where('slug','agent')->first();
                        if(empty($agentId)){
                            $request->session()->flash('val', 0);
                            $request->session()->flash('msg', "User not created successfully.Agent module not found");
                            return response()->json(['status'=>false,'csrf' => csrf_token()]);
                        }else{

                            $user                      = new Users;
                            $user->email               = $request->email;
                            $user->account_created_ip  = $request->ip();
                            $user->status              = $request->status;
                            $nextId                    = $tableStatus[0]->Auto_increment;  
                            $user->unique_code         = (1000+$nextId);
                            if($request->file('image')){
                                $extension       = $request->file('image')->getClientOriginalExtension();
                                $userimagename   = time().'.'.$extension;
                                $destinationPath = public_path() . "/images/user_pics/";
                                $request->file('image')->move($destinationPath, $userimagename);
                                $user->image     = $userimagename;
                            }
                            $random_password = $this->generateRandomPassword(6);
                            $user->password  = bcrypt($random_password);  
                            try{
                                $user->save();
                                /* Save user module */
                                $user->types()->attach($agentId->id);

                                $usercountry                 = new UserCountry;
                                $usercountry->user_id        = $user->id;
                                $usercountry->country_id     = $request->countries;
                                $usercountry->mobile_number  = $request->mobile;
                                $usercountry->location       = $request->location;
                                $usercountry->latitude       = $request->lat;
                                $usercountry->longitude      = $request->lng;
                                $usercountry->created_ip     = $request->ip();
                                $usercountry->save();
                                $usercreatedcountryid        = $usercountry->id;

                                if($request->name_lang_id &&  $request->name && $request->about){
                                    /* Save name, about and language id to table user details */
                                    foreach($request->name_lang_id as $key=> $value){
                                        $usercountry->user_details()->attach($request->name_lang_id[$key], ['name' => $request->name[$key],'about_us' =>  $request->about[$key],'created_ip'=>$request->ip()]);
                                    }
                                }

                                /* Send mail */
                                $toEmail=$request->email;
                                $data=array('password' => $random_password,'name'=>$request->name[0]);
                                $contactName='';
                                Mail::send('agents::emails.admin_success',  $data, function($message) use ($toEmail, $contactName){
                                    $message->from(Config::get('constants.from'), Config::get('constants.mail_header_agent'));
                                    $message->to($toEmail);
                                    $message->subject(Config::get('constants.subject_agent_reg_admin'));
                                });
                                if( count(Mail::failures()) > 0 ) {
                                    $request->session()->flash('val', 1);
                                    $request->session()->flash('msg', "Agent created successfully.<span style='color:#fe3d3d'>Unable to connect the email </span>"); 
                                    return response()->json(['status'=>true,'csrf' => csrf_token()]);
                                }else{
                                    $request->session()->flash('val', 1);
                                    $request->session()->flash('msg', "Agent created successfully !");
                                    return response()->json(['status'=>true,'url'=>URL('/o4k/agents/'),'csrf' => csrf_token()]);
                                }

                                /* End mail */

                            }catch (Exception $ex){

                                $request->session()->flash('val', 0);
                                $request->session()->flash('msg', "User not created successfully.".$ex->getMessage()); 
                                return response()->json(['status'=>false,'csrf' => csrf_token()]);

                            }
                        }
                    }
  
                }    
 
    }

    /**
     * Generate Random Password.
     * @return Response
     */

    public function generateRandomPassword($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
     }


    /**
     * Show the form for editing the specified resource.
     * @return Response
     */

    public function edit($id)
    {
	    $user = Users::with('created_usercountries')->find($id);
        if($user==null){return redirect('/o4k/404');}
        else{
            $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
            return view('agents::admin.edit',compact('user','countries'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */

    public function getName($countryid,$userId,Request $request){

        if($request->ajax())
        {
            $userCountry = UserCountry::with('user_details')->where(array('country_id'=>$countryid,'user_id'=>$userId))->first();
            $nameArray = array();
            foreach ($userCountry->user_details as $key => $names) {
                $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->where('id',$names->pivot->language_id)->get()->toArray();
               
                $nameArray[$key]['country_lang_id'] = $languages[0]['id'];
                $nameArray[$key]['lang_id'] = $languages[0]['languages']['id'];
                $nameArray[$key]['lang_name'] = $languages[0]['languages']['name'];
                $nameArray[$key]['lang_code'] = $languages[0]['languages']['lang_code'];
                $nameArray[$key]['user_name'] = $names->pivot->name;
                $nameArray[$key]['user_about'] = $names->pivot->about_us;
            }
            

            if(!empty($nameArray))
            {  
                $returnHTML = (String) view('agents::admin.sections.dynamic_edit',compact('nameArray'));
                return response()->json(['status'=>true, 'html'=>$returnHTML,'csrf' => csrf_token()]);
            }else{return response()->json(['status'=>false, 'message'=>'Oops something went wrong','csrf' => csrf_token()]);}
        }else{return redirect('/404');}

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

        //dd($request->all());
        $error=array();
        $created_country=$request->country;
            
                if($request->country){
    
                    $created_country_slug=$request->country_flag;

                    $country = Countries::with(['created_countries' => function($query) use ($created_country_slug){ 
                        $query->where('flag',$created_country_slug);
                        $query->where('status',1);
                    }])->where(array('id'=> $created_country, 'status'=> 1))->first();
                    if($country){
                       if( Arr::exists($country, 'created_countries') ){
                        if($country->created_countries->flag != $created_country_slug){
                            $error['country'] = 'Country  not found';
                        }
                       }else{
                            $error['country'] = 'Country  is not active';
                       }
                        
                    }else{
                        $error['country'] = 'Country  is not active';
                    }
                }else{
                    $error['country'] = 'This field is required';
                }

                /* check status value is 0 or 1*/ 

                if($request->status){
                    if($request->status == 0 || $request->status == 1){

                    }else{
                        $error['status'] = 'Invalid Status';
                    }
                }

                /* check the file format is png/PNG/jpg/JPG/gif/GIF/jpeg/JPEG */ 

                if($request->file('image')){
                    $supported_image = array('png','PNG','jpg','JPG','gif','GIF','jpeg','JPEG');
                    $ext = $request->file('image')->getClientOriginalExtension();
                    if (!in_array($ext, $supported_image)) {
                        $error['image'] = 'File format not support.';
                    } 
                }

                 /*check the name language is exist with  created country (lang_name means created laguage id) */ 

                if($request->name){

                    foreach (array_combine($request->name_lang_slug , $request->name_lang_id ) as $slug => $langId){
                        $checklang =  Countrylangs::with(['languages' => function ($query) use ($slug){$query->where('lang_code',$slug);$query->where('status',1);}])->where(array('id'=>$langId,'created_country_id'=>$created_country,'is_active'=>1))->first();
                        if($checklang == null){                       
                            $error['name_lang'] = 'Language not found.';                          
                        }
                    }

                }

                /*check the about language is exist with  created country (lang_about means created laguage id) */

                if($request->about){

                    foreach (array_combine($request->about_lang_slug , $request->about_lang_id ) as $slug => $langId){
                        $checklang =  Countrylangs::with(['languages' => function ($query) use ($slug){$query->where('lang_code',$slug);$query->where('status',1);}])->where(array('id'=>$langId,'created_country_id'=>$created_country,'is_active'=>1))->first();
                        if($checklang == null){                       
                            $error['about_lang'] = 'Language not found.';                          
                        }
                    }

                }


                if(!empty($error)){
                    return response()->json(['status'=>0,'errArr'=>$error]);
                }else{
                    /* save the user as a agent and send mail to the user with login details */
                   $user      = Users::find($id);
                    if($user==null){ 
                        $request->session()->flash('val', 0);
                        $request->session()->flash('msg', "Agent not updated successfully.".$e->getMessage()); 
                        return response()->json(['status'=>false,'csrf' => csrf_token()]);
                    }else{

                            $user->email               = $request->email;
                            $user->account_created_ip  = $request->ip();

                            if($request->file('image')){
                                $extension       = $request->file('image')->getClientOriginalExtension();
                                $userimagename   = time().'.'.$extension;
                                $destinationPath = public_path() . "/images/user_pics/";
                                $request->file('image')->move($destinationPath, $userimagename);
                                $user->image     = $userimagename;
                            }
                            $random_password = $this->generateRandomPassword(6);
                            $user->password  = bcrypt($random_password);
                            try{
                                $user->save();

                                $userCountry = UserCountry::where('user_id',$id)->first();

                                $usercountry                 = UserCountry::find($userCountry->id);

                                $usercountry->country_id     = $request->countries;
                                $usercountry->mobile_number  = $request->mobile;
                                $usercountry->location       = $request->location;
                                $usercountry->latitude       = $request->lat;
                                $usercountry->longitude      = $request->lng;
                                $usercountry->created_ip     = $request->ip();
                                $usercountry->save();
                                $usercreatedcountryid        = $usercountry->id;

                                if($request->name_lang_id &&  $request->name && $request->about){
                                    /* Save name, about and language id to table user details */
                                    UserDetails::where('user_countries_id',$userCountry->id)->forceDelete();
                                    foreach($request->name_lang_id as $key=> $value){
                                        $usercountry->user_details()->attach($request->name_lang_id[$key], ['name' => $request->name[$key],'about_us' =>  $request->about[$key],'created_ip'=>$request->ip()]);
                                    }
                                }
                                $request->session()->flash('val', 1);
                                $request->session()->flash('msg', "Agent created successfully !");
                                return response()->json(['status'=>true,'url'=>URL('/o4k/agents/'),'csrf' => csrf_token()]);

                            } catch (Exception $ex){

                                $request->session()->flash('val', 0);
                                $request->session()->flash('msg', "Agent not updated successfully.".$ex->getMessage()); 
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
		$user=Users::find($id);

        if($user==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $user->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Agent deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/agents');
        }
    }

/**
    * activate user.
    * @return Response
*/

    public function activate($id)
    {
        $user = Users::find($id);
        if($user==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
            
                $user->status=1;
                $user->save();
                Session::flash('val', 1);
                Session::flash('msg', "Agent activated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/agents');
        }
            
    }
        
/**
    * deactivate user.
    * @return Response
*/
        
    public function deactivate($id)
    {
        $user = Users::find($id);
        if($user==null){return redirect('/o4k/404');}
        else
        { 
            try
            
            { 
                $user->status=0;
                $user->save();
                Session::flash('val', 1);
                Session::flash('msg', "Agent deactivated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/agents');
        }
    }
}
