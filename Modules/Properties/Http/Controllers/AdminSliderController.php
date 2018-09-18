<?php

namespace Modules\Properties\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Properties\Entities\PropertyList;
use Modules\Properties\Entities\SliderList;
use Modules\Users\Entities\Users;
use Modules\Module\Entities\Modules;
use Modules\Properties\Entities\PropertyType;
use Modules\Properties\Entities\PropertyCategory;
use Modules\Properties\Entities\PropertyImages;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Properties\Entities\SliderOrder;
use Modules\Properties\Entities\SliderPageOrder;

class AdminSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('properties::admin.slider.properties.index');
    }

    public function allpropertylists()
    {

        return Datatables::of(SliderList::with('property_data')->where('slider_element_type','Property')->orderBy('id', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $SliderOrder=SliderOrder::get();
        $short_code=Modules::select('short_code')->where('slug','property')->first();
        if($short_code)
        {
            $OrderList = array();
            foreach($SliderOrder as $Order)
            {
                $OrderList[$Order->page][$Order->row][]= $Order;
            }
            $short_code = $short_code->short_code;
            return view('properties::admin.slider.properties.create', compact('OrderList','short_code'));
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

        $this->validate($request, ['slider_element_id' => "composite_unique:slider"],
                                ['slider_element_id.composite_unique' => 'Duplicate entry']);
        
       
        $Datetime = explode("-",$request->Datetime);
        $start= date('Y-m-d H:i:s',strtotime(trim($Datetime[0])));
        $end=  date('Y-m-d H:i:s',strtotime(trim($Datetime[1])));
        $error=array();
        foreach($request->page as $page)
        {

            $Property = SliderPageOrder::where(array('page'=>$page ,'row'=>$request->row[$page] ,'column'=>$request->column[$page]))->count();

           if($Property > 0)
            {
               $error[$page]['msg']='dublicate entry';
            }
        }
        if(count($error)> 0)
        {
           
            return response()->json(['status'=>false,'data'=> $error]);
        }
        else
        {

                //echo"<pre>"; print_r($propertylists); die;
        
                $propertylists = new SliderList;
                $propertylists->slider_element_id = $request->slider_element_id; 
                $propertylists->slider_element_type ='Property'; 
                $propertylists->page_type = implode(",",$request->page);
                $propertylists->pro_unique_id = $request->unique_property_id;  
                $propertylists->start = $start; 
                $propertylists->end = $end; 
                $propertylists->payment = $request->Payment; 
                $propertylists->amount = $request->amount;  
                
                $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."slider'");
                if (empty($tableStatus)) {
                    throw new \Exception("Table not found");
                }else
                {
                    $nextId = $tableStatus[0]->Auto_increment; 
                    $propertylists->id=(1+$nextId);

                    try{
                    $propertylists->save();
                    $id = $propertylists->id;

                        foreach($request->page as $page)
                        {
                            $propertylists = new SliderPageOrder;
                            $propertylists->slider_id = $id; 
                            $propertylists->page =$page; 
                            $propertylists->row = $request->row[$page]; 
                            $propertylists->column = $request->column[$page]; 
                            $propertylists->save();  

                        }
                    $request->session()->flash('val', 1);
                    $request->session()->flash('msg', "Slider Property created successfully !");
                    return response()->json(['status'=>true,'url'=>URL('/o4k/sliderproperties/'),'csrf' => csrf_token()]);
                }
                catch (Exception $ex) {
                    $request->session()->flash('val', 0);
                    $request->session()->flash('msg', "Slider Property not added successfully.".$e->getMessage()); 
                    return response()->json(['status'=>false,'csrf' => csrf_token()]);
                }
                }

        }
        
       
       
    }


    

   

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $SelectedSliderPageOrder = $OrderList = array();
        $property = SliderList::find($id);
        if($property==null) { return redirect('/o4k/404'); }
        else
        {
            $short_code=Modules::select('short_code')->where('slug','property')->first();
            $SliderPageOrder=SliderPageOrder::where('slider_id',$property->id)->get();
            foreach($SliderPageOrder as $Order)
            {
                $SelectedSliderPageOrder[$Order->page][$Order->row][$Order->column]= $Order;
            }
            
            $SliderOrder=SliderOrder::get();
            foreach($SliderOrder as $Order)
            {
                $OrderList[$Order->page][$Order->row][]= $Order;
            }
            $short_code = $short_code->short_code;

            $PropertyDetails=PropertyList::with('users')->where('id',$property->slider_element_id)->first();
            $image =PropertyImages::where('property_id',$property->slider_element_id)->where('is_featured','1')->first();

           
           return view('properties::admin.slider.properties.edit', compact('property','PropertyDetails','short_code','OrderList','image','SelectedSliderPageOrder'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

        $this->validate($request, ['slider_element_id' => "composite_unique:slider" ,'Datetime' =>"ProperDate:slider"],['slider_element_id.composite_unique' => 'Duplicate entry','Datetime.ProperDate' => 'Select valid date']);

        $Datetime = explode("-",$request->Datetime);
        $start= date('Y-m-d H:i:s',strtotime(trim($Datetime[0])));
        $end= date('Y-m-d H:i:s',strtotime(trim($Datetime[1])));
        $error=array();
        foreach($request->page as $page)
        {

            $Property = SliderPageOrder::where(array('page'=>$page ,'row'=>$request->row[$page] ,'column'=>$request->column[$page] ))->where('slider_id','!=',$id )->count();

           if($Property > 0)
            {
               $error[$page]['msg']='dublicate entry';
            }
        }

        if(count($error)> 0)
        {
           
            return response()->json(['status'=>false,'data'=> $error]);
        }
        else
        {
            $propertylists = SliderList::find($id);
            $propertylists->slider_element_id = $request->slider_element_id; 
            $propertylists->slider_element_type ='Property'; 
            $propertylists->page_type = implode(",",$request->page);
            $propertylists->pro_unique_id = $request->unique_property_id;  
            $propertylists->start = $start; 
            $propertylists->end = $end; 
            $propertylists->payment = $request->Payment; 
            $propertylists->amount = $request->amount;  
            try{
                $propertylists->save();
                $id = $propertylists->id;

                $propertylists = SliderPageOrder::where('slider_id',$id)->get()->each->delete();

                foreach($request->page as $page)
                {
                    $propertylists = new SliderPageOrder;
                    $propertylists->slider_id = $id; 
                    $propertylists->page =$page; 
                    $propertylists->row = $request->row[$page]; 
                    $propertylists->column = $request->column[$page]; 
                    $propertylists->save();  

                }

                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Slider Property updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/sliderproperties/'),'csrf' => csrf_token()]);
            }
            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Slider Property not updated successfully.".$e->getMessage()); 
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
		$propertylists = SliderList::find($id);
		if($propertylists==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $propertylists->delete();

                $propertylists = SliderPageOrder::where('slider_id',$id)->get()->each->delete();;


                Session::flash('val', 1);
                Session::flash('msg', "Property List deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/sliderproperties');
        }
    }
	

    public function getproperty($id)
    {

        $result['property'] = PropertyList::with(['users' => function ($query) use ($id)
                    {
                        $query->where('status','1');
                    }])->where('status','Active')->where('uid',$id)->first();
        
                
        if(!empty($result['property']))
        {
            $result['image']=PropertyImages::where('property_id',$result['property']->id)->where('is_featured','1')->first();
            return response()->json(['status'=>true,'data'=> $result]);
        }
        else
        {
            return response()->json(['status'=>false,'data'=> '']);
        }
        
    }

    public function getrow($page)
    {

        $SliderOrder = SliderOrder::where('page',$page)->get();
        dd($SliderOrder);
                 
        if(!empty($result['property']))
        {
            $result['image']=PropertyImages::where('property_id',$id)->where('is_featured','1')->first();
            return response()->json(['status'=>true,'data'=> $result]);
        }
        else
        {
            return response()->json(['status'=>false,'data'=> '']);
        }
        
    }
}
