<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Properties\Entities\PropertyList;
use Modules\Users\Entities\Users;
use Modules\Module\Entities\Modules;
use Modules\Properties\Entities\PropertyType;
use Modules\Properties\Entities\PropertyCategory;
use Modules\Properties\Entities\PropertyImages;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Admin\Entities\FeaturedProperties;
use Illuminate\Support\Arr;

class AdminFeaturedPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::admin.FeaturedProperties.index');
    }

    public function allpropertylists()
    {

        return Datatables::of(FeaturedProperties::with('property_data')->orderBy('id', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $short_code=Modules::select('short_code')->where('slug','property')->first();
        if($short_code)
        {
            $short_code = $short_code->short_code;
            return view('admin::admin.FeaturedProperties.create', compact('short_code'));
        }
        else
        {
            return redirect('/o4k/404');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, ['property_id' => "featured_composite_unique:featured_property"],
                                ['property_id.featured_composite_unique' => 'Duplicate entry']);
        
       
        $Datetime = explode("-",$request->Datetime);
        $start= date('Y-m-d H:i:s',strtotime(trim($Datetime[0])));
        $end=  date('Y-m-d H:i:s',strtotime(trim($Datetime[1])));
       

                //echo"<pre>"; print_r($propertylists); die;
        
                $propertylists = new FeaturedProperties;
                $propertylists->property_id = $request->property_id; 
                $propertylists->category_id = $request->category_id; 
                $propertylists->start = $start; 
                $propertylists->end = $end; 
                $propertylists->payment = $request->Payment; 
                $propertylists->amount = $request->amount;  
                
                $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."featured_property'");
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
                    $request->session()->flash('msg', "Featured Property created successfully !");
                    return response()->json(['status'=>true,'url'=>URL('/o4k/FeaturedProperties'),'csrf' => csrf_token()]);
                }
                catch (Exception $ex) {
                    $request->session()->flash('val', 0);
                    $request->session()->flash('msg', "Featured Property not added successfully.".$e->getMessage()); 
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
         $property = FeaturedProperties::find($id);
        if($property==null) { return redirect('/o4k/404'); }
        else
        {
            $short_code=Modules::select('short_code')->where('slug','property')->first();
           $short_code = $short_code->short_code;

            $PropertyDetails=PropertyList::with('users')->where('id',$property->property_id)->first();
            $image =PropertyImages::where('property_id',$property->property_id)->where('is_featured','1')->first();
           return view('admin::admin.FeaturedProperties.edit', compact('property','PropertyDetails','short_code','image'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

        $this->validate($request, ['property_id' => "featured_composite_unique:featured_property" ,'Datetime' =>"ProperDate:featured_property"],['property_id.featured_composite_unique' => 'Duplicate entry','Datetime.ProperDate' => 'Select valid date']);

        $Datetime = explode("-",$request->Datetime);
        $start= date('Y-m-d H:i:s',strtotime(trim($Datetime[0])));
        $end= date('Y-m-d H:i:s',strtotime(trim($Datetime[1])));
       
            $propertylists = FeaturedProperties::find($id);
            $propertylists->property_id = $request->property_id; 
            $propertylists->category_id = $request->category_id; 
            $propertylists->start = $start; 
            $propertylists->end = $end; 
            $propertylists->payment = $request->Payment; 
            $propertylists->amount = $request->amount;  
            try{
                $propertylists->save();
                $id = $propertylists->id;

                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Featured Property updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/FeaturedProperties'),'csrf' => csrf_token()]);
            }
            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Featured Property not updated successfully.".$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
            }
    
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
		$propertylists = FeaturedProperties::find($id);
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
            return redirect('o4k/FeaturedProperties');
        }
    }
	

    public function getproperty($id)
    {
       
        $result['property'] = PropertyList::with(['users' => function ($query) use ($id)
                    {
                        $query->where('status','1');
                    } ,'property_category' => function ($query) use ($id)
                    {
                        $query->where('is_featured','1');
                    }])->where('status','1')->where('uid',$id)->first();
        if(!empty($result['property']))
        {
            if($result['property']->property_category != NULL )
            {
                $result['category_id'] = $result['property']->property_category->id;
                $result['image']=PropertyImages::where('property_id',$result['property']->id)->where('is_featured','1')->first();
                return response()->json(['status'=>true,'data'=> $result]);
            }
            else
            {
                return response()->json(['status'=>false,'data'=> '']);
            }
            
        }
        else
        {
            return response()->json(['status'=>false,'data'=> '']);
        }
        
    }



    public function Subscription(Request $request)
    {
        DB::enableQueryLog();

        $response = FeaturedProperties::with('property_data')->where('end',">=" ,$request->FilterSubscriptionDateStart." 00:00:00")->where('end',"<=" ,$request->FilterSubscriptionDateEnd." 00:00:00")->orderBy('id', 'DESC')->get();

       
        if($response)
        {
            $returnHTML = (String) view('admin::admin.FeaturedProperties.filter',compact('response'));
            return response()->json(['status'=>true,'html'=>$returnHTML]);
       
        }

        /* return Datatables::of( FeaturedProperties::with('property_data')->whereBetween('end',[$request->FilterSubscriptionDateStart." 00:00:00" ,$request->FilterSubscriptionDateEnd." 00:00:00"])->orderBy('id', 'DESC')->get())->make(true);*/

        
    }

}
