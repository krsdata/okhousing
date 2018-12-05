<?php

namespace Modules\Properties\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Properties\Entities\PropertyType;
use Modules\Countries\Entities\Countrylangs;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;
use Modules\Properties\Entities\PropertyList;
use Modules\Website\Entities\Wishlist;
use Modules\Properties\Entities\PropertyCategory;

class AdminPropertytypesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('properties::admin.property_types.index');
    }

    public function allpropertytypes()
    {
        return Datatables::of(PropertyType::with('created_language')->where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        $Category=PropertyCategory::where('status',1)->where('language_id',1)->get();
        return view('properties::admin.property_types.create', compact('languages','Category'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name_en' => 'required|unique_neighbour:property_types,name,NULL,id']);
        $property_types = new PropertyType;
        $property_types->language_id = $request->language_en;
        $property_types->name = $request->name_en;
        $property_types->slug = $request->slug_en;
        $property_types->status = $request->status_en;
        $property_types->category_id = $request->CategoryType;
        try 
        {
            $property_types->save();
            $names = $request->name;
            $id = $property_types->id;
            if(!empty($names) && $names!='')
            {                
               
                $languages = $request->language;
                $slugs = $request->slug;
                foreach($names as $key => $value):
                    $property_types = new PropertyType;
                    $property_types->parent_id = $id;
                    $property_types->language_id = $languages[$key];
                    $property_types->name = $names[$key];
                    $property_types->slug = $slugs[$key];
                    $property_types->status = $request->status_en;
                    $property_types->category_id = $request->CategoryType;
                    $property_types->save();
                endforeach;
            }
            
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Property types created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/property_types/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Property types not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('properties::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
		$languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        $Category=PropertyCategory::where('status',1)->where('language_id',1)->get();
        $property_types = PropertyType::with('types')->find($id);
        return view('properties::admin.property_types.edit',compact('languages','property_types','Category'));
       
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {
		$this->validate($request, [
            'name_en' => "required|unique_neighbour:property_types,name,$id,id"
        ]);
		$property_types = PropertyType::find($id);
        $property_types->language_id = $request->language_en;
        $property_types->name = $request->name_en;
        $property_types->slug = $request->slug_en;
        $property_types->status = $request->status_en;
        $property_types->category_id = $request->CategoryType;
        try 
        {
            $property_types->save();
            $names = $request->name;
            $ids = $request->ids;
            
            if(!empty($names) && $names!='')
            { 
                $languages = $request->language;
                $slugs = $request->slug;
                foreach($ids as $key => $value):
                    $property_types = PropertyType::find($value);
                    $property_types->parent_id = $id;
                    $property_types->language_id = $languages[$key];
                    $property_types->name = $names[$key];
                    $property_types->slug = $slugs[$key];
                    $property_types->status = $request->status_en;
                    $property_types->category_id = $request->CategoryType;
                    $property_types->save();
                endforeach;
            }
			$request->session()->flash('val', 1);
            $request->session()->flash('msg', "Property types updated successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/property_types/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Property types not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }
			
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
   public function destroy($id)
    {
		$property_types = PropertyType::find($id);
		if($property_types==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $property_types->delete();

                $TypeList = PropertyType::where('parent_id',$id)->get();
                $typelist = $TypeList->pluck('id')->toArray();
              
                //dd($catlist);
                $prolist = PropertyList::where('type_id',$id);
                foreach($typelist as $type)
                {
                    $prolist->orWhere('type_id',$type);

                }
                $prolist->get();

                $prolistlist = $prolist->pluck('id')->toArray();
                $prolist->delete();

                PropertyType::where('parent_id',$id)->get()->each->delete();


               
                foreach($prolistlist as $pro)
                {
                   Wishlist::where('property_id',$pro)->delete();
                }
               

                PropertyType::where('parent_id',$id)->get()->each->delete();

                Session::flash('val', 1);
                Session::flash('msg', "Property Type deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_types');
        }
    }
	public function activate($id)
	{
		$property_types = PropertyType::find($id);
		if($property_types==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$property_types->status=1;
				$property_types->save();

                 $list = PropertyType::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = PropertyType::find($l->id);
                    $amenities->status=1;
                    $amenities->save();
                }

				Session::flash('val', 1);
                Session::flash('msg', "Property Type activated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_types');
        }
			
	}
	public function deactivate($id)
	{
		$property_types = PropertyType::find($id);
		if($property_types==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$property_types->status=0;
				$property_types->save();


                   $list = PropertyType::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = PropertyType::find($l->id);
                    $amenities->status=0;
                    $amenities->save();
                }


				Session::flash('val', 1);
                Session::flash('msg', "Property Type deactivated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_types');
        }
	}
}
