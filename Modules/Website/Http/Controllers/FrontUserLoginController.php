<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Auth;
use URL;
use Cache;
use Modules\Users\Entities\UserOTPDetails;
use Validator, Input, Redirect; 
use DB;
use Mail;
use Config; 
use \Illuminate\Support\Facades\Session;
use Modules\Users\Entities\Users;
use Modules\Users\Entities\UserModules;
use Modules\Website\Entities\Advertise;
use Modules\Website\Entities\Enquiry;
use Modules\Properties\Entities\PropertyList;
use Modules\Website\Entities\Wishlist;
use Modules\Users\Entities\UserDetails;
use Modules\Users\Entities\UserCountry;
class FrontUserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
    public function index()
    {
     return redirect('/404');
    }
    public function post_login(Request $request)
    {
        //$this->validate($request, [ 'email' => 'required|email', 'password' => 'required']);
      //  dd($request);

        if($request->otp_verified == 1)
        {
            $user = Users::where('email',$request->email)->first();
            $user->email_verified = '1';
            $user->account_verified = '1';
            $user->email_verified_ip = \Request::ip(); 
            $user->email_verified_date_time  = date("Y-m-d H:i:s") ;
            $user->save();

            $UserOTPDetails = UserOTPDetails::where('email_token',$user->email_token)->first();
            $UserOTPDetails->otp_verified = '1';
            $UserOTPDetails->otp_verified_at  = date("Y-m-d H:i:s") ;
            $UserOTPDetails->save();

        }

        $credentials = $request->only('email', 'password');
        $credentials['status']  =   1;
       if (Auth::guard('front_user')->attempt($credentials, $request->has('remember_me')))
        {


            $proEnqury = array();
            Session::put('proid', $proEnqury);

            /* getting user module type */
            $mainresultArray=array();
            $otherresultArray=array();
            $userTypeids = UserModules::with(['user_types','created_users'])->where('user_id',Auth::guard('front_user')->user()->id)->get();
          //  dd($userTypeids);
            if(!is_null($userTypeids[0]->created_users->account_verified))
            {
                foreach($userTypeids as $key => $userTypeid){
                    if($userTypeid->user_types->module_type==1){
                        $mainresultArray[$key]['slug']=$userTypeid->user_types->slug;
                    }
                    if($userTypeid->user_types->module_type==0){
                        $otherresultArray[$key]['slug']=$userTypeid->user_types->slug;
                    }
                }
                if(count($mainresultArray) == count($userTypeids)){

                    if($request->wishlistid)
                    {

                         Wishlist::where('user_id', Auth::guard('front_user')->user()->id)->where('property_id', $request->wishlistid)->delete();


                        $AddTowishlist = new Wishlist;
                        $AddTowishlist->user_id = Auth::guard('front_user')->user()->id; 
                        $AddTowishlist->property_id = $request->wishlistid; 
                        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."add_to_wishlist'");
                        if (empty($tableStatus)) {
                            throw new \Exception("Table not found");
                        }else
                        {
                            $nextId = $tableStatus[0]->Auto_increment; 
                            $AddTowishlist->id=$nextId;

                            try{
                                $AddTowishlist->save();
                            }
                            catch (Exception $ex) {
                               
                            }

                        }
                             return response()->json(['status'=>true,'csrf' => csrf_token(),'url'=>URL::to('/dashboard') ,'wishlist' =>1 ,'proid'=>$request->wishlistid]);

                    }
                    else
                    {
                         return response()->json(['status'=>true,'csrf' => csrf_token(),'url'=>URL::to('/dashboard'),'wishlist' =>0]);
                    }

                   
                }
                elseif(count($otherresultArray) == count($userTypeids) || count($otherresultArray) ==1){

                     if($request->wishlistid)
                    {

                        Wishlist::where('user_id', Auth::guard('front_user')->user()->id)->where('property_id', $request->wishlistid)->delete();


                        $AddTowishlist = new Wishlist;
                        $AddTowishlist->user_id = Auth::guard('front_user')->user()->id; 
                        $AddTowishlist->property_id = $request->wishlistid; 
                        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."add_to_wishlist'");
                        if (empty($tableStatus)) {
                            throw new \Exception("Table not found");
                        }else
                        {
                            $nextId = $tableStatus[0]->Auto_increment; 
                            $AddTowishlist->id=$nextId;

                            try{
                                $AddTowishlist->save();
                            }
                            catch (Exception $ex) {
                               
                            }

                        }
                         return response()->json(['status'=>true,'csrf' => csrf_token(),'url'=>URL::to('/dashboard') ,'wishlist' =>1 ,'proid'=>$request->wishlistid]);

                    }
                    else
                    {
                         return response()->json(['status'=>true,'csrf' => csrf_token(),'url'=>URL::to('/dashboard'),'wishlist' =>0]);
                    }

                    //return response()->json(['status'=>true,'csrf' => csrf_token(),'url'=>URL::to('/dashboard')]);
                }
                else{
                    return response()->json(['status'=>'not_exist','csrf' => csrf_token(),'url'=>URL::to('/')]);
                }
            }
            else
            {
                Auth::guard('front_user')->logout();
                Cache::flush();
                return response()->json(['status' => 'not_verified', 'message' => trans('countries::home/home.verifyacc')]); 
            }
            
        }
        else
        {
            return response()->json(['status' => false, 'message' => trans('auth.failed')]); 
        }
    }


    public function logout()
    {
        Auth::guard('front_user')->logout();
        Cache::flush();
        return redirect('/');
    }



    public function CheckLogin()
    {
        if(Auth::guard('front_user')->user()) 
        {
          return response()->json(['status'=>true,'csrf' => csrf_token()]);   
        }
        else 
        { 
         return response()->json(['status'=>false,'csrf' => csrf_token(),'url'=>URL::to('/')]);   
        }
    }

    public function dashboard()
    {
        $Tab= (@$_GET['Tab'])?@$_GET['Tab']:'Properties';
        if(Auth::guard('front_user')->user()) { 

            $Enquiry = Enquiry::where('owner_id',Auth::guard('front_user')->user()->id)->orderBy('id', 'DESC')->count();

            $user=Users::with('created_properties')->where('id',Auth::guard('front_user')->user()->id)->first();
            return view('website::web.profile.dashboard', compact('user','Enquiry','Tab')); 
        }
        else {   return redirect('/'); }
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('home::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('home::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
    public function not_found()
    {
       return view('website::web.home.404'); 
    }

    public function notfound()
    {
       return view('website::web.home.500'); 
    }

      /**
     * validating the users  
     * creating a valid user
     * @return Response html.
     */
    public function ResendOTP(Request $request)
    {
        $toEmail=$request->Gemail;
        /* start email */
        $otp = rand(1000, 9999);
        $data=array('otp' => $otp);
        $contactName='';
        $toEmail=$request->email;
        Mail::send('users::email.otpNotification',  $data, function($message) use ($toEmail, $contactName)
        {
            $message->from(Config::get('constants.from'), Config::get('constants.mail_header_reg'));
            $message->to($toEmail);
            $message->subject(Config::get('constants.otp_send'));

        });

        $otpdetails = UserOTPDetails::where('email_token',$request->email_token)->first();
        $otpdetails->otp   = $otp;
        $otpdetails->save();
        try{

            $otpdetails->save();
             return response()->json(['status'=>1,'html'=>$otp, 'message' => trans('auth.sendOTP')]);
        }catch (Exception $ex)
        {
            return response()->json(['status'=>0,'html'=>trans('countries::home/home.wentwrong')]);
        }
    }


    public function forgotpass(Request $request)
    {
        //dd($request->forgotemail);
        $user = Users::where('email',$request->forgotemail)->first();
        if($user){

            $user->email_resetpass_send_date_time = date('Y-m-d H:i:s');
            $user->save();
            $data=array('token' =>base64_encode($user->email_token));
            $toEmail=$user->email;
            Mail::send('users::email.reset_password',  $data, function($message) use ($toEmail)
            {
                $message->from(Config::get('constants.from'), Config::get('constants.reset_password'));
                $message->to($toEmail);
                $message->subject(Config::get('constants.reset_password'));

            });

            return response()->json(['status'=>1,'html'=> trans('countries::home/home.resetsuccess')]);

        }
        else
        {
            return response()->json(['status'=>0,'html'=>trans('countries::home/home.emailnotexist')]);
        }
    }

    public function resetpassword($token)
    {
        //dd($request->forgotemail);
        $user = Users::where('email_token',base64_decode($token))->first();
        if($user){

            $email_resetpass_send_date_time = $user->email_resetpass_send_date_time;
            $datetime1 = strtotime($email_resetpass_send_date_time);
            $datetime2 = strtotime(date("Y-m-d H:i:s"));
            $interval  = abs($datetime2 - $datetime1);
            $minutes   = round($interval / 60);
             
            if($minutes < 180  )
            {

                return view('website::web.profile.changepassword', compact('token')); 
            }
            else
            {
                /* redirect to 404 */return redirect('/404');
            }
        }
        else
        {
            /* redirect to 404 */return redirect('/404');
        }
    }


public function post_advertise(Request $request)
    {
        $Advertise = new Advertise;
        $Advertise->name     = $request->adv_name; 
        $Advertise->email    = $request->adv_email; 
        $Advertise->phone    = $request->adv_phoneno; 
        $Advertise->message  = $request->adv_message; 
                
        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."advertise'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {
                    $nextId = $tableStatus[0]->Auto_increment; 
                    $Advertise->id=(1+$nextId);


                    try{
                    $Advertise->save();
                      return response()->json(['status' => true ,'message' =>trans('countries::home/home.requestSentSuccess')]); 
                    }
                    catch (Exception $ex) {
                          return response()->json(['status' => false ,'message' =>trans('countries::home/home.tryagain')]); 
                    }

       
        }
    }
 public function updatepassword(Request $request)
    {
        $user = Users::where('id',Auth::guard('front_user')->user()->id)->first();
        if($user){

           $user->password = bcrypt($request->Rpassword);
           $user->save();
            return response()->json(['status' => true ,'message' =>trans('countries::home/home.changepassword')]); 
        }
        else{
              return response()->json(['status' => false,'message' =>trans('countries::home/home.tryagain')]); 
        }
    }


    public function post_enquiry(Request $request)
    {
        $Enquiry = new Enquiry;
        $Enquiry->name     = $request->enquiry_name; 
        $Enquiry->email    = $request->enquiry_email; 
        $Enquiry->phone    = $request->enquiry_phone; 
        $Enquiry->message  = $request->enquiry_message; 
        $Enquiry->subject    = $request->enquiry_subject; 
        $Enquiry->property_id  = $request->property_id; 
        $Enquiry->owner_id  = $request->owner_id;
        if(Auth::guard('front_user')->user())
        {
             $Enquiry->user_id  = Auth::guard('front_user')->user()->id;
        } 

         

        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."property_enquiry'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {
                    $nextId = $tableStatus[0]->Auto_increment; 
                    $Enquiry->id=(1+$nextId);

                    try{
                    $Enquiry->save();

                    $proEnqury = Session::get('proid');
                    if(!empty($proEnqury))
                    {
                        array_push($proEnqury,$request->property_id);
                    }
                    else
                    {
                        $proEnqury = array($request->property_id);
                    }
                    Session::put('proid', $proEnqury);


                    $AboutUs = $UserName ='User';
                    $Email= $mobile='';

                    $fcountry_lang=Session::get('fcountry_lang');
                    $ffcountry_language = Session::get('fcountry_language');
                    $Selected_lang = $ffcountry_language['id'];

                    $userCountry = UserCountry::where('user_id',$request->owner_id)->first();
                    $user_countries_id = $userCountry->id;

                    $resultData = UserDetails::where('user_countries_id',$user_countries_id)->where('language_id',$Selected_lang)->first();



                    $str ='';
                     if($resultData){
                            
                            $User = Users::where('id',$request->owner_id)->first();

                            $str .= "<p><b>".trans('countries::home/home.name')." :</b>".@$resultData->name;
                            $str .= "</p><p><b>".trans('countries::home/home.email')." :</b>".@$User->email;
                            $str .= "</p><p><b>".trans('countries::home/home.phone')." :</b>".@$User->mobile."</p>";
                            
                    }

                      return response()->json(['status' => true,'result'=>$str,'auth'=>Auth::guard('front_user')->check()]); 
                    }
                    catch (Exception $ex) {
                          return response()->json(['status' => false,'auth'=>Auth::guard('front_user')->check()]); 
                    }

       
        }
    }

   
}
