<?php

namespace Modules\Properties\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Properties\Entities\PropertyCategory;
use Modules\Countries\Entities\Countrylangs;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;

class AdminPropertyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('properties::admin.property_category.index');
    }

    public function allpropertycategories()
    {
        return Datatables::of(PropertyCategory::with('created_language')->where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        return view('properties::admin.property_category.create',compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name_en' => 'required|unique:property_category,name,NULL,id','slug_en' => 'required|unique:property_category,slug,NULL,id']);

        $property_categories = new PropertyCategory;
        $property_categories->language_id = $request->language_en;
        $property_categories->name = $request->name_en;
        $property_categories->slug = $request->slug_en;
        $property_categories->status = $request->status_en;
        try {
            $property_categories->save();
            $id = $property_categories->id;
            $names = $request->name;
            if(!empty($names) && $names!='')
            { 
                $languages = $request->language;
                $slugs = $request->slug;
                foreach($names as $key => $value):
                    $property_categories = new PropertyCategory;
                    $property_categories->parent_id = $id;
                    $property_categories->language_id = $languages[$key];
                    $property_categories->name = $names[$key];
                    $property_categories->slug = $slugs[$key];
                    $property_categories->status = $request->status_en;
                    $property_categories->save();
                endforeach;
            }
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Property category created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/property_category/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Property category not created successfully.".$e->getMessage()); 
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
        $property_category = PropertyCategory::with('types')->find($id);
        return view('properties::admin.property_category.edit',compact('languages','property_category'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name_en' => "required|unique:property_category,name,$id,id",'slug_en' => "required|unique:property_category,slug,$id,id", 
        ]);

        $property_categories = PropertyCategory::find($id);
        $property_categories->language_id = $request->language_en;
        $property_categories->name = $request->name_en;
        $property_categories->slug = $request->slug_en;
        $property_categories->status = $request->status_en;
        try 
        {
            $property_categories->save();
            $names = $request->name;
            $ids = $request->ids;
            
            if(!empty($names) && $names!='')
            { 
                $languages = $request->language;
                $slugs = $request->slug;
                foreach($ids as $key => $value):
                    $property_categories = PropertyCategory::find($value);
                    $property_categories->parent_id = $id;
                    $property_categories->language_id = $languages[$key];
                    $property_categories->name = $names[$key];
                    $property_categories->slug = $slugs[$key];
                    $property_categories->status = $request->status_en;
                    $property_categories->save();
                endforeach;
            }
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Property category updated successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/property_category/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Property category not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
		$property_categories = PropertyCategory::find($id);
		if($property_categories==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $property_categories->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Property category deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_category');
        }
    }
	public function activate($id)
	{
		$property_categories = PropertyCategory::find($id);
		if($property_categories==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$property_categories->status=1;
				$property_categories->save();
				Session::flash('val', 1);
                Session::flash('msg', "Property category activated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_category');
        }
			
	}
	public function deactivate($id)
	{
		$property_categories = PropertyCategory::find($id);
		if($property_categories==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$property_categories->status=0;
				$property_categories->save();
				Session::flash('val', 1);
                Session::flash('msg', "Property category deactivated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_category');
        }
	}
}
