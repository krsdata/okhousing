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

use Intervention\Image\ImageManagerStatic as Image;



class AdminOwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('owners::admin.index');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function allOwnerList()
    {
		
        $ownerId=Modules::select('id')->where('slug','owner')->first();
		
        if($ownerId){
           $resultArray = array();
            $owners = UserModules::with('created_users')->where('module_id',$ownerId->id)->orderby('id','DESC')->get();
    

                foreach ($owners as $key => $owner) {
                    if( Arr::exists($owner, 'created_users') ){


                    $userCountry = UserCountry::with('user_details')->where('user_id', $owner->created_users->id)->first();
					$countryId = $userCountry->id;
                    // echo $langId =  $countrylang->id;
                    $resultData = UserCountry::with(['created_users','created_userdetails' => function ($query) use ($countryId){$query->where('user_countries_id',$countryId);$query->where('language_id','1');}])->where('user_id',$owner->created_users->id)->first();

                      
                        if($resultData){
                            if( Arr::exists($resultData, 'created_userdetails') ){
                                $resultArray[$key]['id'] = $resultData->created_users->id;
                                $resultArray[$key]['name'] = @$resultData->created_userdetails[0]->name;
                                $resultArray[$key]['email'] = $resultData->created_users->email;
                                $resultArray[$key]['status'] = $resultData->created_users->status;
                                $resultArray[$key]['created_at'] = $resultData->created_users->created_at;
                            }
                        }

                        /*if($userCountry)
                        {

                           
                            $countrylang = Countrylangs::where(array('created_country_id' => $owner->country_id, 'language_id'=>1))->first();

                              dd($countrylang);

                            if($userCountry && $countrylang){
                                echo $countryId = $userCountry->id;
                                echo $langId =  $countrylang->id;
                                $resultData = UserCountry::with(['created_users','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id','1');}])->where('user_id',$owner->created_users->id)->first();

                               dd($resultData);

                                if($resultData){
                                    if( Arr::exists($resultData, 'created_userdetails') ){
                                        $resultArray[$key]['id'] = $resultData->created_users->id;
                                        $resultArray[$key]['name'] = @$resultData->created_userdetails[0]->name;
                                        $resultArray[$key]['email'] = $resultData->created_users->email;
                                        $resultArray[$key]['status'] = $resultData->created_users->status;
                                        $resultArray[$key]['created_at'] = $resultData->created_users->created_at;
                                    }
                                }
                            
                            }
                        }*/
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
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        return view('owners::admin.create',compact('countries'));
    }
	
	 public function getlanguage($countryid,Request $request)
    { 
        if($request->ajax())
        {
            $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->get()->toArray();
            if(!empty($languages))
            {  
                $returnHTML = (String) view('owners::admin.sections.dynamic',compact('languages'));
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

                if($request->mnumber){
                    $mobile=$request->mnumber;
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

               /* if($request->name){

                    foreach (array_combine($request->name_lang_slug , $request->name_lang_id ) as $slug => $langId){
                        $checklang =  Countrylangs::with(['languages' => function ($query) use ($slug){$query->where('lang_code',$slug);$query->where('status',1);}])->where(array('id'=>$langId,'created_country_id'=>$created_country,'is_active'=>1))->first();
                        if($checklang == null){                       
                            $error['name_lang'] = 'Language not found.';                          
                        }
                    }

                }*/

                /*check the about language is exist with  created country (lang_about means created laguage id) */

               /* if($request->about){

                    foreach (array_combine($request->about_lang_slug , $request->about_lang_id ) as $slug => $langId){
                        $checklang =  Countrylangs::with(['languages' => function ($query) use ($slug){$query->where('lang_code',$slug);$query->where('status',1);}])->where(array('id'=>$langId,'created_country_id'=>$created_country,'is_active'=>1))->first();
                        if($checklang == null){                       
                            $error['about_lang'] = 'Language not found.';                          
                        }
                    }

                }
*/

                if(!empty($error)){
                    return response()->json(['status'=>0,'errArr'=>$error]);
                }else{
                    /* save the user as a owner and send mail to the user with login details */

		
        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."users'");
        if (empty($tableStatus)) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "User not created successfully.Table not found"); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }else
        {
            $ownerId=Modules::select('*')->where('slug','owner')->first();
            if(empty($ownerId)){
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "User not created successfully.Owner module not found"); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);

            }else{
			 /* save the user as a owner and send mail to the user with login details */
			 
               $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."users'");
                    if (empty($tableStatus)) {
                        $request->session()->flash('val', 0);
                        $request->session()->flash('msg', "User not created successfully.Table not found"); 
                        return response()->json(['status'=>false,'csrf' => csrf_token()]);
                    }else{

                        $ownerId=Modules::select('*')->where('slug','owner')->first();
                        if(empty($ownerId)){
                            $request->session()->flash('val', 0);
                            $request->session()->flash('msg', "User not created successfully.Owner module not found");
                            return response()->json(['status'=>false,'csrf' => csrf_token()]);
                        }else{

                             $email_token = unique_random('users', 'email_token', 6);

                            $user                      = new Users;
                            $user->email               = $request->email;
                            $user->email_token   = $email_token;
                            $user->account_created_ip  = $request->ip();
                            $user->status              = $request->status;
                            $nextId                    = $tableStatus[0]->Auto_increment; 
                            $user->country_id     = $request->countries; 
                            $user->cat_type     = $ownerId->module_type; 
                            $user->unique_code         = (1000+$nextId);
                            $user->mobile  = $request->mnumber;

                            if($request->file('image')){
                                $extension       = $request->file('image')->getClientOriginalExtension();
                                $userimagename   = time().'.'.$extension;
                                $destinationPath = public_path() . "/images/user_pics/";
                                $request->file('image')->move($destinationPath, $userimagename);


                                 $image_resize = Image::make(public_path() ."/images/user_pics/" .$userimagename);              
                                $image_resize->resize(400, 400);
                                $image_resize->save(public_path() ."/images/user_pics/" .$userimagename);


                                $user->image     = $userimagename;
                            }
                            $random_password = $this->generateRandomPassword(6);
                            $user->password  = bcrypt($random_password);  
                            try{
                                $user->save();
                                /* Save user module */
                                $user->types()->attach($ownerId->id);

                                $usercountry                 = new UserCountry;
                                $usercountry->user_id        = $user->id;
                                $usercountry->country_id     = $request->countries;
                                $usercountry->mobile_number  = $request->mnumber;
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
                                $verificationLink = URL('/').'/users/verify/'.(1000+$nextId);
                                $data=array('password' => $random_password,'name'=>$request->name[0] ,'verificationLink' =>  $verificationLink);
                                $contactName='';
                                Mail::send('owners::emails.admin_success',  $data, function($message) use ($toEmail, $contactName){
                                    $message->from(Config::get('constants.from'), Config::get('constants.mail_header_owner'));
                                    $message->to($toEmail);
                                    $message->subject("ok4homes:profile created");
                                });
                                if( count(Mail::failures()) > 0 ) {
                                    $request->session()->flash('val', 1);
                                    $request->session()->flash('msg', "Owner created successfully.<span style='color:#fe3d3d'>Unable to connect the email </span>"); 
                                    return response()->json(['status'=>true,'csrf' => csrf_token()]);
                                }else{
                                    $request->session()->flash('val', 1);
                                    $request->session()->flash('msg', "Owner created successfully !");
                                    return response()->json(['status'=>true,'url'=>URL('/o4k/owners/'),'csrf' => csrf_token()]);
                                }

                                /* End mail */

                            }catch (Exception $ex){

                                $request->session()->flash('val', 0);
                                $request->session()->flash('msg', "User not created successfully.".$ex->getMessage()); 
                                return response()->json(['status'=>false,'csrf' => csrf_token()]);

                            }
                        }
                    }
  
			}   }    
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
            return view('owners::admin.edit',compact('user','countries'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */

    public function getName($countryid,$userId,Request $request){

       /* if($request->ajax())
        {*/

            $userCountry = UserCountry::with('user_details')->where('user_id',$userId)->first();
            $countryId = $userCountry->id;

            $languages = Countrylangs::with('languages')->where('created_country_id',$countryid)->get();
            
            
            $nameArray = array();

            foreach ($languages as $key => $names) {

                $userdata=UserDetails::where('user_countries_id',$countryId)->where('language_id',$names->languages->id)->first();
               

                $nameArray[$key]['country_lang_id'] = @$names['id'];
                $nameArray[$key]['id'] = @$userdata->id;
                $nameArray[$key]['lang_id'] = @$names['languages']['id'];
                $nameArray[$key]['lang_name'] = @$names['languages']['name'];
                $nameArray[$key]['lang_code'] = @$names['languages']['lang_code'];
                $nameArray[$key]['user_name'] = @$userdata->name;
                $nameArray[$key]['user_about'] = @$userdata->about_us;
            }
                     
            if(!empty($nameArray))
            {  
                $returnHTML = (String) view('owners::admin.sections.dynamic_edit',compact('nameArray'));
                return response()->json(['status'=>true, 'html'=>$returnHTML,'csrf' => csrf_token()]);
            }else{return response()->json(['status'=>false, 'message'=>'Oops something went wrong','csrf' => csrf_token()]);}
       /* }else{return redirect('/404');}*/

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

       // dd($request);
      
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

                if($request->ids){

                   /* foreach (array_combine($request->name_lang_slug , $request->name_lang_id ) as $slug => $langId){
                        $checklang =  Countrylangs::with(['languages' => function ($query) use ($slug){$query->where('lang_code',$slug);$query->where('status',1);}])->where(array('id'=>$langId,'created_country_id'=>$created_country,'is_active'=>1))->first();
                        if($checklang == null){                       
                            $error['name_lang'] = 'Language not found.';                          
                        }
                    }*/

                    $ids = $request->ids;
                    $i=0;
                    foreach($request->langages as $desc_language)
                    {
                        $name_entry = 'name_'.$desc_language;
                        $about_entry = 'about_'.$desc_language;
                        $user_details = UserDetails::find($ids[$i]);
                        $user_details->name       = $_POST[$name_entry];  
                        $user_details->about_us   = $_POST[$about_entry];  
                        $user_details->save();
                        $i++; 
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
                    /* save the user as a owner and send mail to the user with login details */
                   $user      = Users::find($id);
                    if($user==null){ 
                        $request->session()->flash('val', 0);
                        $request->session()->flash('msg', "Owner not updated successfully.".$e->getMessage()); 
                        return response()->json(['status'=>false,'csrf' => csrf_token()]);
                    }else{

                            $user->email               = $request->email;
                            $user->account_created_ip  = $request->ip();
                            $user->mobile  = $request->mnumber;
                            if($request->file('image')){
                                $extension       = $request->file('image')->getClientOriginalExtension();
                                $userimagename   = time().'.'.$extension;
                                $destinationPath = public_path() . "/images/user_pics/";
                                $request->file('image')->move($destinationPath, $userimagename);


                                 $image_resize = Image::make(public_path() ."/images/user_pics/" .$userimagename);              
                                $image_resize->resize(400, 400);
                                $image_resize->save(public_path() ."/images/user_pics/" .$userimagename);


                                $user->image     = $userimagename;
                            }
                            $random_password = $this->generateRandomPassword(6);
                            $user->password  = bcrypt($random_password);
                            try{

                                $user->country_id     = $request->countries;
                                $user->save();

                                $userCountry = UserCountry::where('user_id',$id)->first();

                                $usercountry                 = UserCountry::find($userCountry->id);

                                $usercountry->country_id     = $request->countries;
                                $usercountry->mobile_number  = $request->mnumber;
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
                                $request->session()->flash('msg', "Owner updated  successfully !");
                                return response()->json(['status'=>true,'url'=>URL('/o4k/owners/'),'csrf' => csrf_token()]);

                            } catch (Exception $ex){

                                $request->session()->flash('val', 0);
                                $request->session()->flash('msg', "Owner not updated successfully.".$ex->getMessage()); 
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
                Session::flash('msg', "Owner deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/owners');
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
                Session::flash('msg', "Owner activated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/owners');
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
                Session::flash('msg', "Owner deactivated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/owners');
        }
    }

}
