<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Metropolian;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Countries\Entities\created_metropolian;
use Modules\Countries\Entities\Countries;


class AdminMetropoliancontroller extends Controller
{
    

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function index()
    {
         $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        return view('admin::admin.Metropolian.index', compact('countries'));

        
    }


    public function create($id)
    {
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->where('id',$id)->first();

        return view('admin::admin.Metropolian.create', compact('countries'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

       // dd( $request);

        Metropolian::where('country_id',$request->countries)->delete();

         $ImagesList=array();
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach($files as $file){
                $ImagesList[] = $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/images/Metropolian/';
                $file->move($destinationPath, $filename);
            }
        }


        $location = $request->location;
        $countries = $request->countries;
        if(!empty($location) && $location!=''){
            $images = $request->images;
            $position = $request->position;
            if($countries){
                foreach($location as $key => $value):
                    

                   $address = str_replace(" ", "+", $location[$key]);

                    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
                    $json = json_decode($json);

                    $lat = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                    $long = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                   

                    $Metropolianlists = new Metropolian;
                    $Metropolianlists->country_id = $countries;
                    $Metropolianlists->country_created_id = $countries;  
                    $Metropolianlists->cities =$location[$key]; 
                    $Metropolianlists->status =1;
                    $Metropolianlists->lat =$lat; 
                    $Metropolianlists->lang =$long ;

                    $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."propertys'");
                    if (empty($tableStatus)) {
                        throw new \Exception("Table not found");
                    }else
                    {
                       

                        try{
                      
                        $id = $Metropolianlists->id; 
                        $Metropolianlists->Images=$ImagesList[$key];

                        $Metropolianlists->save();
                     }
                    catch (Exception $ex) {
                    }
                    }
                endforeach;
            }
            
        }


            Session::flash('val', 1);
            Session::flash('msg', "added successfully !");
            return redirect('metropoloancity');
       
       
    }

 public function allcitylist()
    {
    return Datatables::of(Metropolian::with('created_metropolian')->orderBy('id', 'DESC')->get())->make(true);
    }

  public function activate($id)
    {
        $Metropolian = Metropolian::find($id);
        if($Metropolian==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
            
                $Metropolian->status=1;
                $Metropolian->save();
                Session::flash('val', 1);
                Session::flash('msg', "Property List activated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('metropoloancity');
        }
            
    }

    public function deactivate($id)
    {
        $Metropolian = Metropolian::find($id);
        if($Metropolian==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
            
                $Metropolian->status=0;
                $Metropolian->save();
                Session::flash('val', 1);
                Session::flash('msg', "Property List deactivated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('metropoloancity');
        }
    }



      public function edit($id)
    {
        $metropolian_lists = Metropolian::where('country_id',$id)->get();

        if($metropolian_lists==null) { return redirect('/o4k/404'); }
        else
        {
           
           $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->where('id',$id)->first();


            return view('admin::admin.Metropolian.edit', compact('countries','metropolian_lists'));
        }
        
    }


    public function update(Request $request)
    {
         

       

        


        $location = $request->location;
        $countries = $request->countries;
        if(!empty($location) && $location!=''){
            $images = $request->images;
            $position = $request->position;
            if($countries){
                foreach($location as $key => $value):
                    

                   $address = str_replace(" ", "+", $location[$key]);

                    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
                    $json = json_decode($json);

                    $lat = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                    $long = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                   
                    $UpdateId = 'metro_city_id'.($key);

                    $Metropolianlists = Metropolian::find($_POST[$UpdateId]);
                    $Metropolianlists->country_id = $countries;
                    $Metropolianlists->country_created_id = $countries;  
                    $Metropolianlists->cities =$location[$key]; 
                    $Metropolianlists->status =1;
                    $Metropolianlists->lat =$lat; 
                    $Metropolianlists->lang =$long ;

                   try{
                      
                       $images = 'images'.($key+1);

                        if ($request->hasFile($images)) {
                            $files = $request->file($images);
                               $filename = $files->getClientOriginalName();
                                $extension = $files->getClientOriginalExtension();
                                $destinationPath = public_path() . '/images/Metropolian/';
                                $files->move($destinationPath, $filename);
                                $Metropolianlists->Images=$filename;
                        }

                       

                        $Metropolianlists->save();
                     }
                    catch (Exception $ex) {
                    }
                endforeach;
            }
            
        }

            Session::flash('val', 1);
            Session::flash('msg', "Updated successfully !");
            return redirect('metropoloancity');
       

    }



    public function destroy($id)
    {
        $Metropolianlist = Metropolian::find($id);
        if($Metropolianlist==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $Metropolianlist->delete();
                Session::flash('val', 1);
                Session::flash('msg', "City List deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('metropoloancity');
        }
    }


    public function checkcity(Request $request)
    {
        $Cityid = Metropolian::select('id')->where('cities',$request->location);
        if($request->id)
        {
             $Cityid->where('id','!=',$request->id);
        }
        $list = $Cityid->first();
       
        if(!empty( $list))
        {
             echo  $list->id;
        }
       
          
    }




    


    
}
