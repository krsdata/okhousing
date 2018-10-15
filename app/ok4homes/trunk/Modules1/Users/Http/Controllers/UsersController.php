<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Users\Entities\Users;
use Modules\Module\Entities\Modules;
use Modules\Countries\Entities\Countries;
use Modules\Countries\Entities\Allcountries;
use Modules\Users\Entities\Builders;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
Use Mail;
use DB;

class UsersController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function index()
    {
        return view('users::admin.index');
    }
/**
    * Display a listing of the resource.
    * @return Response
*/

     public function allUsers()
    {
        return Datatables::of(Users::orderBy('id', 'DESC')->get())->make(true);
    }

/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
        $main = Modules::where('module_type',0)->where('status',1)->get();
        $others = Modules::where(array('module_type'=>1,'status'=>1))->get();

        return view('users::admin.create',compact('main','others'));
    }

    
/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function getform($slug)
    { 
        if($slug==null) { return response()->json(['html'=>false]);}
        else
        {
            if (View::exists('users::admin.'.$slug.'_form')) 
            {
                $returnHTML = (String) view('users::admin.'.$slug.'_form');
                return response()->json(['html'=>$returnHTML]);
            }else { return response()->json(['html'=>false]); } 
        }        
    }

/**
    * Show the form for updating the resource.
    * @return Response
*/

    public function geteditform($slug,$id)
    { 
        if($slug==null || $id==null) { return response()->json(['html'=>false]);}
        else
        {
            $builderDetails=Builders::where('user_id',$id)->first();
            if($builderDetails){
                if (View::exists('users::admin.'.$slug.'_form')) 
                {$returnHTML = (String) view('users::admin.'.$slug.'_form');
                    return response()->json(['builders'=>$builderDetails,'html'=>$returnHTML]);
                }else { return response()->json(['html'=>false]); } 
            }else{
                if (View::exists('users::admin.'.$slug.'_form')) {
                    $returnHTML = (String) view('users::admin.'.$slug.'_form');
                    return response()->json(['html'=>$returnHTML]);
                }else { return response()->json(['html'=>false]); } 
                
            }        
        }
    }

/**
    * Get the unique code.
    * @return Response
*/

    public function getuniquecode($uniquecode)
    {
        $uniquecode=Users::where('unique_code',$uniquecode)->count(); 
        if($uniquecode!=0){ return response()->json(['status'=>0]);  }
        else{ return response()->json(['status'=>1]); }    
    }

/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function store(Request $request)
    {
        $this->validate($request, ['email' => 'required|unique:users,email,NULL,id,deleted_at,NULL', 'mnumber' => 'required|unique:users,mobile,NULL,id,deleted_at,NULL' ],['mnumber.unique' => 'The mobile no has already been taken.']);
       
        $user = new Users;
        $user->name = $request->adname;
        $user->email = $request->email;
        $user->mobile = $request->mnumber;   
        $user->created_ip = $request->ip(); 
        $user->location = $request->location;
        $user->latitude = $request->lat;
        $user->longitude = $request->lng;
        
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $userimagename = time().'.'.$extension;
            $destinationPath = public_path() . "/images/user_pics/";
            $request->file('image')->move($destinationPath, $userimagename);
            $user->image=$userimagename;
        }
        
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
         
        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."users'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {
            $nextId = $tableStatus[0]->Auto_increment; 
            $user->unique_code=(1000+$nextId);
            
            try{
                $user->save();
                $id = $user->id;
                $types = array();
                if($request->user_type=="1"): 
                    $types[] = $request->type;              
                else:
                    $types = $request->types;
                endif;
                $user->types()->attach($types);
                if($request->type)
                {
                    $type=Modules::where(array('id'=>$request->type,'status'=>1))->first();
                    if($type->slug == 'builders')
                    {
                        $builder = new Builders;
                        if($request->file('builder_logo'))
                        {
                            $extension = $request->file('builder_logo')->getClientOriginalExtension();
                            $logoname = time().'.'.$extension;
                            $destinationPath = public_path() . "/images/builders/";
                            $request->file('builder_logo')->move($destinationPath, $logoname);
                            $builder->builder_logo =$logoname;
                        }
                        $builder->user_id = $id;
                       
                        $builder->builder_name = $request->builder_name;
                        $builder->mobile = $request->mobile_number;
                        $builder->established_year = $request->builder_year;
                        $builder->street_name = $request->street_name;
                        $builder->post_code = $request->pin_number;
                        $builder->location = $request->location;
                        $builder->save();
                    }
                }
                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "User created successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/users/'),'csrf' => csrf_token()]);

            }
            catch (\Exception $e)
            {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "User not created successfully.".$e->getMessage()); 
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
        $user = Users::with('created_types','created_builders')->where('id',$id)->first();
       //dd($user);
        if($user==null) { return redirect('/o4k/404'); }
        else
        {
               	$mains = Modules::where(array('module_type'=>0,'status'=>1))->get();
                $others = Modules::where(array('module_type'=>1,'status'=>1))->get();
                return view('users::admin.edit',compact('mains','others','user'));
        }
  }

/**
    * Update the specified resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function update($id,Request $request)
    {
        
    	$this->validate($request, [
            'email' => "required|unique:users,email,$id,id", 
            'mnumber' => "required|unique:users,mobile,$id,id", 
        ],['mnumber.unique' => 'The mobile no has already been taken.']);
        
        $user = Users::find($id);
        if($user==null){
            return response()->json(['status'=>true,'url'=>URL('/o4k/404/'),'csrf' => csrf_token()]);
        }else
        {
            $type=null;
            if( $request->type )
            {
                $type=Modules::where(array('id'=>$request->type,'status'=>1))->first();
                if($type==null)
                    return response()->json(['status'=>true,'url'=>URL('/o4k/404/'),'csrf' => csrf_token()]); 
            }
          
            $user->name = $request->adname;
            $user->email = $request->email;
            $user->mobile = $request->mnumber;
            $user->created_ip = $request->ip(); 
            $user->location = $request->location;
            $user->latitude = $request->lat;
            $user->longitude = $request->lng;
            $user->status = $request->status;

            if($request->file('images')){
                $extension = $request->file('images')->getClientOriginalExtension();
                $userimagename = time().'.'.$extension;
                $destinationPath = public_path() . "/images/user_pics/";
                $request->file('images')->move($destinationPath, $userimagename);
                $user->image=$userimagename;
            }
                
            if($request->password!="")
                $user->password = bcrypt($request->password);
            
            try
            {
                $user->save();
	        $id = $user->id;
                $types = array();
                if($request->user_type=="1"): 
                    $types[] = $request->type;              
                else:
                    $types = $request->types;
                endif;
                $user->types()->sync($types); 
                
                $b=1;
               // dd($type);
                if(!empty($type) && $request->user_type==1)
                { 
                    if($type->slug == 'builders')
                    {
                        $builderdetails=Builders::where(array('user_id'=>$id))->first();
                        
                        if(!empty($builderdetails)) { $builder = Builders::find($builderdetails->id);  }
                        else{ $builder = new Builders;  }
                        if($request->file('builder_logo'))
                        {
                            $extension = $request->file('builder_logo')->getClientOriginalExtension();
                            $logoname = time().'.'.$extension;
                            $destinationPath = public_path() . "/images/builders/";
                            $request->file('builder_logo')->move($destinationPath, $logoname);
                            $builder->builder_logo =  $logoname;
                        }
                               
                        $builder->user_id = $id; 
                        $builder->builder_name = $request->builder_name;
                        $builder->mobile = $request->mobile_number;
                        $builder->established_year = $request->builder_year;
                        $builder->street_name = $request->street_name;
                        $builder->post_code = $request->pin_number;
                        $builder->location = $request->location;
                        
                        try
                        { 
                            $builder->save();
                            
                        } catch (Exception $ex) 
                        {
                            $b=0;
                            $request->session()->flash('val', 0);
                            $request->session()->flash('msg', "User not updated successfully.".$ex->getMessage()); 
                            return response()->json(['status'=>false,'csrf' => csrf_token()]);
                        }
                       
                        
                    }
                    else
                    {
                        $builders=Builders::where(array('user_id'=>$id))->first();
                        if($builders){
                                $builders=Builders::find($builders->id);
                                $builders->delete();
                        }
                    }
                }
                
                if($b != 0)
                {
                    $request->session()->flash('val', 1);
                    $request->session()->flash('msg', "User updated successfully !");
                    return response()->json(['status'=>true,'url'=>URL('/o4k/users/'),'csrf' => csrf_token()]);
                }
                
            } catch (Exception $ex) 
            {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "User not updated successfully.".$ex->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
            }
           
        }
    }

/**
    * Remove the specified resource from storage.
    * @return Response
*/

    public function destroy($id)
    {
		
		$user = Users::find($id);
		if($user==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $user->delete();
                Session::flash('val', 1);
                Session::flash('msg', "User deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/users/');
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
                Session::flash('msg', "User activated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/users');
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
                Session::flash('msg', "User deactivated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/users');
        }
	}
    
/**
    * store basic front-end.
    * @return Response
*/

    public function store_basic(Request $request)
    {
        $this->validate($request,['email' => 'required|unique:users,email,NULL,id',
            'phone' => 'required|unique:users,mobile,NULL,id'],
                ['email.unique' => 'Email Address already registered',
                'phone.unique' => 'Mobile No: already registered']
        );

        $user = new Users;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->phone;  
        if($request->session()->has('country')){
           $user->country_id = $request->session()->get('country');
        }
        else{
             $user->country_id = 43;
        } 
        $user->password = bcrypt($request->password);
        $user->status = 0;
        $user->unique_code = "hhhh";
        try
        {
            $user->save();
            $id = $user->id;
            return response()->json(['status'=>true,'message'=>'','csrf' => csrf_token(), 'id' => $id]);
        }
        catch (\Exception $e)
        {
            return response()->json(['status'=>false,'message'=>$e,'csrf' => csrf_token()]);
   
        }
        
       
    }

/**
    * store categories front-end.
    * @return Response
*/

    public function store_categories(Request $request)
    {
        $user = Users::find($request->id);
        if($request->type!=''): 
            $type=Modules::where(array('id'=>$request->type,'status'=>1))->first();
            $types[] = $request->type;                 
        else:
            $types = $request->types;
        endif;
        
        $user->types()->attach($types);
        if($request->type!=''):
            return response()->json(['status'=>true,'message'=>'html','csrf' => csrf_token(), 'body' => View::make('users::users.modules.'.$type->slug.'_front')->render()]);
        else:
            return response()->json(['status'=>true,'message'=>'','csrf' => csrf_token(), 'body' => '']);
        endif;
    }
/**
    * store about front-end.
    * @return Response
*/

     public function store_about(Request $request)
    {
        $user = Users::find($request->id);
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $userimagename = time().'.'.$extension;
            $destinationPath = public_path() . "/images/user_pics/";
            $request->file('image')->move($destinationPath, $userimagename);
            $user->image=$userimagename;
        }
        $user->about = $request->about;
        $user->sms_otp = str_random(4);
        $user->email_otp = str_random(4);
        try
        {
            $user->save();
            $id = $user->id;
            return response()->json(['status'=>true,'message'=>'','csrf' => csrf_token(), 'id' => $id]);
        }
        catch (\Exception $e)
        {
            return response()->json(['status'=>false,'message'=>$e,'csrf' => csrf_token()]);
   
        }
    } 
/**
    * send otp front-end.
    * @return Response
*/

    public function send_otp($id)
    {
        $user = Users::find($id);
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=ok4homes&password=632231234&sendername=BINUKV&mobileno=".substr($user->mobile,1)."&message=".$user->sms_otp."",
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        /*$mail['name'] = $user->name;
        $mail['email'] = $user->email;
        $mail['otp'] = $user->email_otp;
        Mail::send('users::email.otpNotification.blade', $mail, function ($m) use ($request) {
            $m->from('no-reply@ok4housing.com', 'Ok4Homes');
            $m->to($request->email)->subject('Verify your account');
        });  */
        echo json_encode($resp);
    }

    public function verify_otp(){
        
    }
}
