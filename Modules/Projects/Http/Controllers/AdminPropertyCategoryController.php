<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Projects\Entities\PropertyCategory;
use Modules\Countries\Entities\Countrylangs;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;
use Modules\Admin\Entities\CategoryType;
use Modules\Projects\Entities\PropertyList;
use Modules\Website\Entities\Wishlist;
use DB;
use Modules\Projects\Entities\PropertyType;


class AdminPropertyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('projects::admin.project_category.index');
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
        $CategoryType = CategoryType::where('language_id',1)->where('status',1)->get();
        return view('projects::admin.project_category.create',compact('languages','CategoryType'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {  

        $this->validate($request, ['name_en' => 'required|unique:project_category,name']);
        

        $CategoryType = implode(",", $request->CategoryType);
        $property_categories = new PropertyCategory;
        $property_categories->language_id = $request->language_en;
        $property_categories->name = $request->name_en;
        $property_categories->slug = $request->slug_en;
        $property_categories->status = $request->status_en;
        $property_categories->master_category_id  = $CategoryType;
        

        $property_categories->bathroom_show  = $request->bathroom;
        $property_categories->bedroom_show  = $request->bedroom;
        $property_categories->bulding_area_show  = $request->buildingarea;
        $property_categories->landarea_show  = $request->landarea;


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
                    $property_categories->master_category_id  = $CategoryType;
                    
                    $property_categories->bathroom_show  = $request->bathroom;
                    $property_categories->bedroom_show  = $request->bedroom;
                    $property_categories->bulding_area_show  = $request->buildingarea;
                    $property_categories->landarea_show  = $request->landarea;

                    $property_categories->save();
                endforeach;
            }
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Project category created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/project_category/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Project category not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('projects::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        $project_category = PropertyCategory::with('types')->find($id);
        $CategoryType = CategoryType::where('language_id',1)->where('status',1)->get();
        return view('projects::admin.project_category.edit',compact('languages','project_category','CategoryType'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {


        $this->validate($request, [
            'name_en' => "required"
        ]);


        $CategoryType = implode(",", $request->CategoryType);
        $property_categories = PropertyCategory::find($id);
        $property_categories->language_id = $request->language_en;
        $property_categories->name = $request->name_en;
        $property_categories->slug = $request->slug_en;
        $property_categories->status = $request->status_en;
        $property_categories->master_category_id  =$CategoryType;
        $property_categories->bathroom_show  = $request->bathroom;
        $property_categories->bedroom_show  = $request->bedroom;
        $property_categories->bulding_area_show  = $request->buildingarea;
        $property_categories->landarea_show  = $request->landarea;

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
                    $property_categories->master_category_id  = $CategoryType;
                    $property_categories->bathroom_show  = $request->bathroom;
                    $property_categories->bedroom_show  = $request->bedroom;
                    $property_categories->bulding_area_show  = $request->buildingarea;
                    $property_categories->landarea_show  = $request->landarea;


                    $property_categories->save();
                endforeach;
            }
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Project category updated successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/project_category/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Project category not updated successfully.".$e->getMessage()); 
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
                

                $categoryList = PropertyCategory::where('parent_id',$id)->get();
                $catlist = $categoryList->pluck('id')->toArray();
                PropertyCategory::where('parent_id',$id)->get()->each->delete();
                //dd($catlist);
                $prolist = PropertyList::where('category_id',$id);
                foreach($catlist as $cat)
                {
                    $prolist->orWhere('category_id',$cat);

                }
                $prolistlist = $prolist->pluck('id')->toArray();
                $prolist->delete();

               

              /*  $prolist = PropertyType::where('category_id',$id);
                foreach($catlist as $cat)
                {
                    $prolist->orWhere('category_id',$cat);

                }
                $prolistlist = $prolist->pluck('id')->toArray();
                $prolist->delete();*/


                foreach($prolistlist as $pro)
                {
                   Wishlist::where('property_id',$pro)->delete();
                }

                Session::flash('msg', "Project category deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/project_category');
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


                $list = PropertyCategory::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = PropertyCategory::find($l->id);
                    $amenities->status=1;
                    $amenities->save();

                    $prolist = PropertyType::where('category_id',$l->id);
                    $prolist->status=1;
                    $prolist->save();


                }

                $prolist = PropertyType::where('category_id',$id);
                $prolist->status=1;
                $prolist->save();


				Session::flash('val', 1);



                Session::flash('msg', "Project category activated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/project_category');
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


                 $list = PropertyCategory::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = PropertyCategory::find($l->id);
                    $amenities->status=0;
                    $amenities->save();

                    $prolist = PropertyType::where('category_id',$l->id);
                    $prolist->status=0;
                    $prolist->save();


                }

                $prolist = PropertyType::where('category_id',$id);
                $prolist->status=1;
                $prolist->save();

				Session::flash('val', 1);
                Session::flash('msg', "Project category deactivated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/project_category');
        }
	}
}
