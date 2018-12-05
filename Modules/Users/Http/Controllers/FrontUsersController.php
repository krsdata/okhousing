<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Module\Entities\Modules;
use Modules\Module\Entities\ModuleCountry;
use Modules\Countries\Entities\Countrylangs;
use Modules\Users\Entities\Users;
use Modules\Users\Entities\UserCountry;
use Modules\Users\Entities\UserDetails;
use Session;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Modules\Users\Entities\UserOTPDetails;
use Validator, Input, Redirect; 
use DB;
use Mail;
use Config; 
use Auth;
use Modules\Website\Entities\Enquiry;
use Modules\Properties\Entities\PropertyList;
use Yajra\DataTables\DataTables;
use Modules\Users\Entities\UserModules;
use Intervention\Image\ImageManagerStatic as Image;

class FrontUsersController extends Controller
{ 
    /**
     * validating the general information
     * @return Response html for second step.
     */
    public function validate_general(Request $request)
    {
        
        if(Session::has('fcountry')){
        	$country = Session::get('fcountry');
        	$countryId=$country['created_country_id'];
            $this->validate($request, 
                    [
                         'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
                            'Gcode' => 'required|unique:users,mobile,NULL,id,deleted_at,NULL' ], ['Gcode.unique' =>  trans('countries::home/home.mobilealreadyexist')]
                    );

                
         
	         /* return second step view */ 
	        $mainCategories =   ModuleCountry::with(['created_modules' => function ($query) 
                                    {
                                        $query->where('module_type','0');
                                        $query->where('status','1');
                                    }])->where('country_id',$countryId)->get(); 
                                        
	        $otherCategories =  ModuleCountry::with(['created_modules' => function ($query) 
                                    {
                                        $query->where('module_type','1');
                                        $query->where('status','1');
                                    }])->where('country_id',$countryId)->get(); 
                
	        if( ($mainCategories->isNotEmpty()) || ($otherCategories->isNotEmpty()) )
                {
                    $returnHTML = (String) view('website::web.model.reg_part.categorys',compact('mainCategories','otherCategories'));
                    return response()->json(['status'=>1,'html'=>$returnHTML]);
	        }else{ return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]);}
    	}else{ return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]);}
    }
    /**
     * validating the users categories
     * @return Response html for second step.
     */
    public function validate_categories(Request $request)
    {
        if($request->val)
        {
            if($request->cat_type)
            {
                if( ($request->cat_type=='main') || ($request->cat_type=='other') )
                {
                    /* validate the other category is exist or not */
                    if($request->cat_type=='other')
                    {
                        if(count($request->val) == 1)
                        {
                            $other = Modules::where('module_type',1)->where('status',1)->where('id',$request->val)->first(); 
                            if($other != null)
                            {
                                /* pass view return */
                                $slug=$other->slug;
                                $returnHTML = (String) view('website::web.model.reg_part.profile',compact('slug'));
                                return response()->json(['status'=>1,'html'=>$returnHTML]);

                            }else{return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]);}     	
                        }else{ return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]); } 
                    }
                    /* validate the main category is exist or not */
                    else
                    {
                        if(count($request->val) > 0)
                        {
                            $mainCategoryArr=array(); 
                            foreach ($request->val as $key => $id) 
                            {
                                $main= Modules::where('module_type',0)->where('status',1)->where('id',$id)->first();
                                if($main !=null){ $mainCategoryArr[$key]['id']=$main->id;}
                            }
                            if(count($mainCategoryArr) == count($request->val))
                            {
                                $returnHTML = (String) view('website::web.model.reg_part.profile');
                                return response()->json(['status'=>1,'html'=>$returnHTML]);     
                            }else{ return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]);}
                        }else{ return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]);}
                    }         
                } else { return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]); }
            } else { return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]); }
        }else{ return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]);}
        
    }
    /**
     * validating the users  
     * creating a valid user
     * @return Response html.
     */
    public function create_users(Request $request)
    {

      
        $created_ip                    =   \Request::ip(); 
        if($created_ip =="::1")
        {
            $created_ip='112.133.248.102';
        }
        if(Session::has('fcountry')){
            $country = Session::get('fcountry');
            $countryId=$country['created_country_id'];
             /* step 1 validation */
            $validator= Validator::make($request->all(),
                    [
                        'Gemail' => 'required|unique:users,email,NULL,id,deleted_at,NULL,country_id,'.$countryId.'',
                        'Gcode' => 'required|unique:users,mobile,NULL,id,deleted_at,NULL,country_id,'.$countryId.'' ], ['mnumber.unique' => trans('countries::home/home.mobilealreadyexist') ]
                    );


            if($validator->fails()){return response()->json(['status'=>0,'errstep'=>1,'errArr'=>$validator->errors()]);}
            else{
                /* step 2 validation */
                if($request->cat_type)
                {
                    if( ($request->cat_type=='main') || ($request->cat_type=='other') )
                    {
                    	$tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."users'");
                        if (empty($tableStatus)) {
							$msg=array('Other'=>array('User not created successfully.Table not found.'));
							return response()->json(['status'=>0,'errstep'=>2,'errArr'=>$msg]);
						}else{

                            $email_token = unique_random('users', 'email_token', 6);
                            $user = new Users;
	                        $user->email        = $request->Gemail;
							$user->mobile       = $request->Gcode;  
							$user->email_token   = $email_token;
                            $user->country_id   = $countryId;
							$user->status       = 1;
							$nextId             = $tableStatus[0]->Auto_increment;  
							$user->unique_code  = (1000+$nextId);  
                            $user->cat_type       = $request->cat_type;  
							if($request->file('image'))
							{
							    $extension = $request->file('image')->getClientOriginalExtension();
							    $userimagename = time().'.'.$extension;
							    $destinationPath = public_path() . "/images/user_pics/";
							    $request->file('image')->move($destinationPath, $userimagename);
							    $user->image=$userimagename;

                                $image_resize = Image::make(public_path() ."/images/user_pics/" .$userimagename);              
                                $image_resize->resize(400, 400);
                                $image_resize->save(public_path() ."/images/user_pics/" .$userimagename);


							}
							$random_password='';
                            if(trim($request->Gpassword))
							{
                                $user->password = bcrypt(trim($request->Gpassword)); 
							    $random_password=$request->Gpassword;
							}
							else
							{
							    $random_password = str_random(6);
							    $user->password =  bcrypt($random_password);  
							}
						}

                        
                        if($request->cat_type=='other')
                        {
                            if($request->val){
                                if(count($request->val) == 1)
                                {
                                    $other = Modules::where('module_type',1)->where('status',1)->where('id',$request->val)->first(); 
                                    if($other != null)
                                    {
                                    	
							            try{
							                $user->save();
                    						$user->types()->attach($request->otherCat[0]);
                    						if($other->slug == 'builders'){
                    							if($request->file('blogo'))
							                    {
							                        $extension = $request->file('blogo')->getClientOriginalExtension();
							                        $logoname = time().'.'.$extension;
							                        $destinationPath = public_path() . "/images/builders/";
							                        $request->file('blogo')->move($destinationPath, $logoname);
							                    }

                                               // dd(Session::has('fcountry_language'));
							                    if(Session::has('fcountry_language'))
                                                {

                                                    $language=Session::get('fcountry_language');

                                                    $UserCountry = new UserCountry;
                                                    $UserCountry->user_id       = $nextId;  
                                                    $UserCountry->mobile_number   =$request->Gcode;
                                                    $UserCountry->created_ip       = $created_ip;
                                                    $UserCountry->country_id = $countryId;
                                                    $UserCountry->save();

                                                    $UserCountry_id = $UserCountry->id;


                                                    if($request->name_language){
                                                        foreach($request->name_language as $desc_language)
                                                        {
                                                            $name_entry = 'name_'.$desc_language;
                                                            $aboutus_entry = 'aboutus_'.$desc_language;

                                                            $user_details = new UserDetails;
                                                            $user_details->language_id        = $desc_language;
                                                            $user_details->name       = $_POST[$name_entry];  
                                                            $user_details->about_us   = $_POST[$aboutus_entry];
                                                            $user_details->created_ip       = $created_ip;
                                                            $user_details->user_countries_id       = $UserCountry_id;
                                                            $user_details->save();


                                                        }
                                                        
                                                    }

                                                
                                                    //$user->user_details()->attach($language['created_language_id'], ['name' => $request->Gname,'about_us' => '']);
                                                }
                    							$user->create_builder()->attach($request->bname, ['mobile' => $request->Gcode,'established_year' => $request->est_year,'builder_logo'=>$logoname,'street_name'=> $request->street,'post_code'=>$request->pinno, 'location'=> $request->location]);

	                                    	}
                                		$toEmail=$request->Gemail;
            							/* start email */
            							$data=array('password' => $random_password,'name'=>$request->Gname ,'email_token' =>$email_token);
					                    $contactName='';
					                    Mail::send('agents::emails.admin_success',  $data, function($message) use ($toEmail, $contactName)
					                    {
					                       $message->from(Config::get('constants.from'), Config::get('constants.mail_header_reg'));
                                            $message->to($toEmail);
                                            $message->subject(Config::get('constants.subject_reg_user'));

					                    });

							                    $returnHTML = (String) view('website::web.model.reg_part.success');
                                				return response()->json(['status'=>1,'html'=>$returnHTML]); 

                    							/* end email */   

							            }catch (Exception $ex)
							            {
							                return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]);
							            }
	
								        
 
                                    }else{ $msg=array('Other'=>array('Module not found.'));return response()->json(['status'=>0,'errstep'=>2,'errArr'=>$msg]); }    
                                }
                            }else{$msg=array('Other'=>array('Module not found.'));return response()->json(['status'=>0,'errstep'=>2,'errArr'=>$msg]);}
                            
                        }
                        else
                        {
                            if($request->val){

                                if(count($request->val) > 0)
                                {
                                    $mainCategoryArr=array(); 
                                    foreach ($request->val as $key => $id) 
                                    {
                                        $main= Modules::where('module_type',0)->where('status',1)->where('id',$id)->first();
                                        if($main !=null){ $mainCategoryArr[$key]['id']=$main->id;}
                                    }
                                    if(count($mainCategoryArr) == count($request->val))
                                    {                                	
							            try{
							                $user->save();
                    						$user->types()->attach($request->val);

                                            if(Session::has('fcountry_language')){



                                                $language=Session::get('fcountry_language');
                    							

                                                $UserCountry = new UserCountry;
                                                $UserCountry->user_id       = $nextId;  
                                                $UserCountry->mobile_number   =$request->Gcode;
                                                $UserCountry->created_ip       = $created_ip;
                                                $UserCountry->country_id = $countryId;
                                                   $UserCountry->save();

                                                $UserCountry_id = $UserCountry->id;

                                                if($request->name_language){
                                                        foreach($request->name_language as $desc_language)
                                                        {
                                                            $name_entry = 'name_'.$desc_language;
                                                            $aboutus_entry = 'aboutus_'.$desc_language;

                                                            $user_details = new UserDetails;
                                                            $user_details->language_id        = $desc_language;
                                                            $user_details->name       = $_POST[$name_entry];  
                                                            $user_details->about_us   = $_POST[$aboutus_entry];
                                                            $user_details->created_ip       = $created_ip;
                                                            $user_details->user_countries_id       = $UserCountry_id;
                                                            $user_details->save();


                                                        }
                                                        
                                                    }

                                              //  $user->user_details()->attach($language['created_language_id'], ['name' => $request->Gname,'about_us' => $request->about]);
                                            }

                                				$toEmail=$request->Gemail;
                    							/* start email */
                                                $otp = rand(1000, 9999);
                    							$data=array('otp' => $otp);
                                                $contactName='';
            				                    Mail::send('users::email.otpNotification',  $data, function($message) use ($toEmail, $contactName)
            				                    {
            				                        $message->from(Config::get('constants.from'), Config::get('constants.mail_header_reg'));
            				                        $message->to($toEmail);
            				                        $message->subject(Config::get('constants.subject_reg_user'));

            				                    });

                                                $otpdetails = new UserOTPDetails();
                                                $otpdetails->email_token       = $email_token;
                                                $otpdetails->email_sent_for_email_verification  = 1;
                                                $otpdetails->otp   = $otp;
                                                $otpdetails->save();

                                                $Gemail=$request->Gemail;
                                                $validate =  $random_password;

                                				$returnHTML = (String) view('website::web.model.reg_part.success',compact('Gemail','otp','validate','email_token'));
                                				return response()->json(['status'=>1,'html'=>$returnHTML ]);

							   
                    							/* end email */   
							            }catch (Exception $ex)
							            {
							                return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]);
							            }
  
                                    }else{$msg=array('Main'=>array('Module not found.'));return response()->json(['status'=>0,'errstep'=>2,'errArr'=>$msg]);}
                                }
                            }else{$msg=array('Main'=>array('Module not found.'));return response()->json(['status'=>0,'errstep'=>2,'errArr'=>$msg]);}
                            
                        }         
                    } 
                }   

            }
           
        }


        
    }

     /**
     * Getting all lang for specified country 
     * @param  Request $request
     * @return Response
     */
    public function getlanguage()
    { 
        if(Session::has('fcountry')){
            $fcountry = Session::get('fcountry');
        }
        $languages=Countrylangs::with('languages')->where('created_country_id',$fcountry['created_country_id'])->get()->toArray();
        if(!empty($languages))
        {
            $returnHTML = (String) view('website::web.sections.dynamic_language_name',compact('languages'));
            $returnHTML2 = (String) view('website::web.sections.dynamic_about_us',compact('languages'));
            return response()->json(['status'=>true, 'html'=>$returnHTML,'about_html'=>$returnHTML2,'csrf' => csrf_token(),'languages'=>$languages]);
        }else{return response()->json(['status'=>false, 'message'=>'Oops something went wrong','csrf' => csrf_token()]);}
    }
    
    /**
     * validating the users  
     * creating a valid user
     * @return Response html.
     */
    public function update_password(Request $request)
    {
        
         $user = Users::where('email_token',base64_decode($request->token))->first();
        if($user){

            $user->email_resetpass_send_date_time = NULL;
            $user->password = bcrypt(trim($request->password));
            $user->save();
            return response()->json(['status'=>1, 'html'=> trans('countries::home/home.changepassword')]);
        }
        else
        {
           return response()->json(['status'=>0,'html'=> trans('countries::home/home.wentwrong')]);
        }

    }


     /**
     * validating the users  
     * updating a valid user
     * @return Response html.
     */
    public function UpdateProfile(Request $request)
    {
        $created_ip                    =   \Request::ip(); 
        if($created_ip =="::1")
        {
            $created_ip='112.133.248.102';
        }
        if(Session::has('fcountry')){
            $country = Session::get('fcountry');
            $countryId=$request->user_countries_id;
            $id= Auth::guard('front_user')->user()->id;
            
            $validator= Validator::make($request->all(),
                    [
                        'name'=>'required'
                    ]
                    );


            if($validator->fails()){return response()->json(['status'=>0,'errstep'=>1,'errArr'=>$validator->errors()]);}
            else{

                $checkExist = Users::where('mobile',$request->phone)->where('id','!=',$id)->count();
                if($checkExist > 0){
                    return response()->json(['status'=>0,'errstep'=>2,'errArr'=>trans('countries::home/home.mobilealreadyexist')]);
                }
                else
                {
                   
                    $user =Users::find(Auth::guard('front_user')->user()->id);
                    $user->mobile       = $request->phone; 
                    $user->save();


                     if(trim($request->cat_type)=='other')
                            {
                                if($request->val){
                                    if(count($request->val) == 1)
                                    {
                                        $other = Modules::where('module_type',1)->where('status',1)->where('id',$request->val)->first(); 
                                        if($other != null)
                                        {
                                            
                                            try{
                                                $user->save();
                                                $user->types()->attach($request->otherCat[0]);
                                                if($other->slug == 'builders'){
                                                    if($request->file('blogo'))
                                                    {
                                                        $extension = $request->file('blogo')->getClientOriginalExtension();
                                                        $logoname = time().'.'.$extension;
                                                        $destinationPath = public_path() . "/images/builders/";
                                                        $request->file('blogo')->move($destinationPath, $logoname);
                                                    }

                                                   // dd(Session::has('fcountry_language'));
                                                    if(Session::has('fcountry_language'))
                                                    {

                                                        $language=Session::get('fcountry_language');

                                                        $UserCountry = new UserCountry;
                                                        $UserCountry->user_id       = $nextId;  
                                                        $UserCountry->mobile_number   =$request->Gcode;
                                                        $UserCountry->created_ip       = $created_ip;
                                                        $UserCountry->country_id = $countryId;
                                                        $UserCountry->save();

                                                        $UserCountry_id = $UserCountry->id;


                                                         $user_details = UserDetails::find($request->UserDetailsId);
                                                        $user_details->name       = $request->name;  
                                                        $user_details->about_us   = $request->about_me;
                                                        $user_details->created_ip       = $created_ip;
                                                       $user_details->save();
                                                    
                                                        //$user->user_details()->attach($language['created_language_id'], ['name' => $request->Gname,'about_us' => '']);
                                                    }
                                                    $user->create_builder()->attach($request->bname, ['mobile' => $request->Gcode,'established_year' => $request->est_year,'builder_logo'=>$logoname,'street_name'=> $request->street,'post_code'=>$request->pinno, 'location'=> $request->location]);

                                                }
                                            $toEmail=$request->Gemail;
                                            /* start email */
                                            $data=array('password' => $random_password,'name'=>$request->Gname ,'email_token' =>$email_token);
                                            $contactName='';
                                            Mail::send('agents::emails.admin_success',  $data, function($message) use ($toEmail, $contactName)
                                            {
                                               $message->from(Config::get('constants.from'), Config::get('constants.mail_header_reg'));
                                                $message->to($toEmail);
                                                $message->subject(Config::get('constants.subject_reg_user'));

                                            });

                                                    $returnHTML = (String) view('website::web.model.reg_part.success');
                                                    return response()->json(['status'=>1,'html'=>$returnHTML]); 

                                                    /* end email */   

                                            }catch (Exception $ex)
                                            {
                                                return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]);
                                            }
        
                                            
     
                                        }else{ $msg=array('Other'=>array('Module not found.'));return response()->json(['status'=>0,'errstep'=>2,'errArr'=>$msg]); }    
                                    }
                                }else{$msg=array('Other'=>array('Module not found.'));return response()->json(['status'=>0,'errstep'=>2,'errArr'=>$msg]);}
                                
                            }
                            else
                            {
                                if($request->val){

                                    if(count($request->val) > 0)
                                    {
                                        
                                            
                                            UserModules::where('user_id',Auth::guard('front_user')->user()->id)->get()->each->delete();

                                            foreach($request->val as $row)
                                            {

                                                $UserModules = new UserModules;
                                                $UserModules->user_id = Auth::guard('front_user')->user()->id;
                                                $UserModules->module_id = $row;
                                                $UserModules->save();

                                            }

                                    }
                                    }
                            }

                    $country = Session::get('fcountry');
                    $countryId=$country['created_country_id'];
                    if(Session::has('fcountry_language')){
                        $language=Session::get('fcountry_language');        
                        
                        UserDetails::where('language_id',$language['created_language_id'])->where('user_countries_id',$request->user_countries_id)->get()->each->delete();;
                        

                         $user_details = UserDetails::find($request->UserDetailsId);
                        $user_details->name       = $request->name;  
                        $user_details->about_us   = $request->about_me;
                        $user_details->created_ip       = $created_ip;
                       $user_details->save();
                    }

                    return response()->json(['status'=>1,'message' =>trans('countries::home/home.profileupdate')]);

                }
            }
           
        }
    }

    /**
     * validating the users  
     * updating a profile image of user
     * @return Response html.
     */
    public function UploadProfileImage(Request $request)
    {

        $user =Users::find(Auth::guard('front_user')->user()->id);
        if($user){
            if($request->file('ProfileImage'))
            {

                $image       = $request->file('ProfileImage');
                $extension = $request->file('ProfileImage')->getClientOriginalExtension();
                $userimagename = time().'.'.$extension;
                $destinationPath = public_path() . "/images/user_pics/";
                $request->file('ProfileImage')->move($destinationPath, $userimagename);
                $user->image=$userimagename;
                $user->save();

                $image_resize = Image::make(public_path() ."/images/user_pics/" .$userimagename);              
                $image_resize->resize(400, 400);
                $image_resize->save(public_path() ."/images/user_pics/" .$userimagename);

                return response()->json(['status'=>1,'message' =>trans('countries::home/home.proImgupdate')]);
            }

            
        }
        else
        {
           return response()->json(['status'=>0,'message' =>trans('countries::home/home.tryagain')]);
        }

    }


     /**
     * validating the users  
     * updating a cover image of user
     * @return Response html.
     */
    public function UploadCoverImage(Request $request)
    {


        
        $user =Users::find(Auth::guard('front_user')->user()->id);
        if($user){


            $data = $request->UploadCoverImageSource;

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $userimagename = time().'.png';
            $CropImg = public_path() . "/images/user_cover_pics/".$userimagename;
            $myfile = fopen($CropImg, "a+");
            if(fwrite($myfile, $data))
            {
                $user->cover_image=$userimagename;
                $user->save();
                return response()->json(['status'=>1,'message' =>trans('countries::home/home.coverImgupdate')]);
            }
            fclose($myfile);
          
           

           /* if($request->file('CoverImage'))
            {

                $extension = $request->file('CoverImage')->getClientOriginalExtension();
                $userimagename = time().'.'.$extension;
                $destinationPath = public_path() . "/images/user_cover_pics/";
                $request->file('CoverImage')->move($destinationPath, $userimagename);
                $user->cover_image=$userimagename;
                $user->save();
                return response()->json(['status'=>1,'message' =>trans('countries::home/home.coverImgupdate')]);
            }
*/
            
        }
        else
        {
           return response()->json(['status'=>0,'message' =>trans('countries::home/home.tryagain')]);
        }

    }

     public function allenquirylists()
    {
        return Datatables::of(Enquiry::where('owner_id',Auth::guard('front_user')->user()->id)->orderBy('id', 'DESC')->get())->make(true);
    }

    public function verify($id)
    {
            $user = Users::where('unique_code',$id)->first();
            $user->email_verified = '1';
            $user->account_verified = '1';
            $user->email_verified_ip = \Request::ip(); 
            $user->email_verified_date_time  = date("Y-m-d H:i:s") ;
            $user->save();

            return redirect("/");

    }
}
