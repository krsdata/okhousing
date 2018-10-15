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

class FrontUserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
    public function post_login(Request $request)
    {
        //$this->validate($request, [ 'email' => 'required|email', 'password' => 'required']);
 
        if($request->otp_verified == 1)
        {
            $user = Users::where('email',$request->email)->first();
            $user->email_verified = '1';
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
            /* getting user module type */
            $mainresultArray=array();
            $otherresultArray=array();
            $userTypeids = UserModules::with('user_types')->where('user_id',Auth::guard('front_user')->user()->id)->get();
            foreach($userTypeids as $key => $userTypeid){
                if($userTypeid->user_types->module_type==1){
                    $mainresultArray[$key]['slug']=$userTypeid->user_types->slug;
                }
                if($userTypeid->user_types->module_type==0){
                    $otherresultArray[$key]['slug']=$userTypeid->user_types->slug;
                }
            }
            if(count($mainresultArray) == count($userTypeids)){
                return response()->json(['status'=>true,'csrf' => csrf_token(),'url'=>URL::to('/dashboard')]);
            }
            elseif(count($otherresultArray) == count($userTypeids) && count($otherresultArray) ==1){
                return response()->json(['status'=>true,'csrf' => csrf_token(),'url'=>URL::to('/dashboard')]);
            }
            else{
                return response()->json(['status'=>'not_exist','csrf' => csrf_token(),'url'=>URL::to('/')]);
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
         if(Auth::guard('front_user')->user()) { 

            $user=Users::with('created_properties')->where('id',Auth::guard('front_user')->user()->id)->first();



            return view('website::web.profile.dashboard', compact('user')); 
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
       return view('home::404'); 
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
            return response()->json(['status'=>0,'html'=>'Sorry something went wrong please try again']);
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

            return response()->json(['status'=>1,'html'=>'Reset password link send on your email-id.']);

        }
        else
        {
            return response()->json(['status'=>0,'html'=>'Email-id does not exist in system']);
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

}
