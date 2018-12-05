<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Projects\Entities\PropertyType;
use Modules\Countries\Entities\Countrylangs;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;
use Modules\Projects\Entities\PropertyList;
use Modules\Website\Entities\Wishlist;
use Modules\Projects\Entities\PropertyCategory;

class AdminPropertytypesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('projects::admin.project_types.index');
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
        return view('projects::admin.project_types.create', compact('languages','Category'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name_en' => 'required|unique:project_types,name,NULL,id']);
        $project_types = new PropertyType;
        $project_types->language_id = $request->language_en;
        $project_types->name = $request->name_en;
        $project_types->slug = $request->slug_en;
        $project_types->status = $request->status_en;
        $project_types->category_id = $request->CategoryType;
        try 
        {
            $project_types->save();
            $names = $request->name;
            $id = $project_types->id;
            if(!empty($names) && $names!='')
            {                
               
                $languages = $request->language;
                $slugs = $request->slug;
                foreach($names as $key => $value):
                    $project_types = new PropertyType;
                    $project_types->parent_id = $id;
                    $project_types->language_id = $languages[$key];
                    $project_types->name = $names[$key];
                    $project_types->slug = $slugs[$key];
                    $project_types->status = $request->status_en;
                    $project_types->category_id = $request->CategoryType;
                    $project_types->save();
                endforeach;
            }
            
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Property types created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/project_types/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Project types not created successfully.".$e->getMessage()); 
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
        $Category=PropertyCategory::where('status',1)->where('language_id',1)->get();
        $project_types = PropertyType::with('types')->find($id);
        return view('projects::admin.project_types.edit',compact('languages','project_types','Category'));
       
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {
		$this->validate($request, [
            'name_en' => "required|unique:project_types,name,$id,id"
        ]);
		$project_types = PropertyType::find($id);
        $project_types->language_id = $request->language_en;
        $project_types->name = $request->name_en;
        $project_types->slug = $request->slug_en;
        $project_types->status = $request->status_en;
        $project_types->category_id = $request->CategoryType;
        try 
        {
            $project_types->save();
            $names = $request->name;
            $ids = $request->ids;
            
            if(!empty($names) && $names!='')
            { 
                $languages = $request->language;
                $slugs = $request->slug;
                foreach($ids as $key => $value):
                    $project_types = PropertyType::find($value);
                    $project_types->parent_id = $id;
                    $project_types->language_id = $languages[$key];
                    $project_types->name = $names[$key];
                    $project_types->slug = $slugs[$key];
                    $project_types->status = $request->status_en;
                    $project_types->category_id = $request->CategoryType;
                    $project_types->save();
                endforeach;
            }
			$request->session()->flash('val', 1);
            $request->session()->flash('msg', "Project types updated successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/project_types/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Project types not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }
			
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
   public function destroy($id)
    {
		$project_types = PropertyType::find($id);
		if($project_types==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $project_types->delete();

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
                Session::flash('msg', "Project Type deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/project_types');
        }
    }
	public function activate($id)
	{
		$project_types = PropertyType::find($id);
		if($project_types==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$project_types->status=1;
				$project_types->save();

                 $list = PropertyType::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = PropertyType::find($l->id);
                    $amenities->status=1;
                    $amenities->save();
                }

				Session::flash('val', 1);
                Session::flash('msg', "Project Type activated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/project_types');
        }
			
	}
	public function deactivate($id)
	{
		$project_types = PropertyType::find($id);
		if($project_types==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$project_types->status=0;
				$project_types->save();


                   $list = PropertyType::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = PropertyType::find($l->id);
                    $amenities->status=0;
                    $amenities->save();
                }


				Session::flash('val', 1);
                Session::flash('msg', "Project Type deactivated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/project_types');
        }
	}
}
