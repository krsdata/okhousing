<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Menu;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Countries\Entities\Countrylangs;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::admin.menu.index');
    }

    public function allmenulists()
    {

        return Datatables::of(Menu::where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $Menu=Menu::get();
        $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        return view('admin::admin.menu.create', compact('Menu','languages'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, ['title_en' => 'required|unique:menu,title,NULL,id','slug_en' => 'required|unique:menu,slug,NULL,id']);
        $menulists = new menu;
        $menulists->title = $request->title_en; 
        $menulists->link =$request->link; 
        $menulists->slug      = $request->slug_en; 
        $menulists->status =$request->status; 
        $menulists->language_id = $request->language_en;
                
        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."menu'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {
                    $nextId = $tableStatus[0]->Auto_increment; 
                    $menulists->id=(1+$nextId);


                    try{
                    $menulists->save();
                    $id = $menulists->id;

                    $names = $request->title;
                    if(!empty($names) && $names!=''){
                        $languages = $request->language;
                        $slugs = $request->slug;
                        foreach($names as $key => $value):
                            $menulists = new Menu;
                            $menulists->parent_id = $id;
                            $menulists->language_id = $languages[$key];
                            $menulists->title = $names[$key];
                            $menulists->slug = $slugs[$key];
                            $menulists->status = $request->status;
                            $menulists->link = $request->link;
                            $menulists->save();
                        endforeach;
                    }

                    $request->session()->flash('val', 1);
                    $request->session()->flash('msg', "Menu created successfully !");
                    return response()->json(['status'=>true,'url'=>URL('/o4k/menu/'),'csrf' => csrf_token()]);
                }
                catch (Exception $ex) {
                    $request->session()->flash('val', 0);
                    $request->session()->flash('msg', "Menu not added successfully.".$e->getMessage()); 
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
        
        $menu = Menu::with('types')->find($id);
        if($menu==null){return redirect('/o4k/404');}
        else{
            $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
           return view('admin::admin.menu.edit', compact('menu','languages'));
        }

        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

        $this->validate($request, ['title_en' => 'required|unique_record:menu,title,$id,id','slug_en' => 'required|unique_record:menu,slug,$id,id']);
        
        $menulists = Menu::find($id);
        if($menulists==null){ 
        $request->session()->flash('val', 0);
        $request->session()->flash('msg', "Menu not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            $menulists->title = $request->title_en; 
            $menulists->link =$request->link; 
            $menulists->slug      = $request->slug_en; 
            $menulists->status =$request->status; 
            $menulists->language_id = $request->language_en;
            try{
                $menulists->save();
                $ids = $request->ids;
                Menu::where('parent_id',$id)->get()->each->delete();
                
                $names = $request->title;
                if(!empty($names) && $names!=''){
                    $languages = $request->language;
                    $slugs = $request->slug;
                    if($ids){
                        foreach($ids as $key => $value):
                            $menulists = new Menu;
                            $menulists->parent_id = $id;
                            $menulists->language_id = $languages[$key];
                            $menulists->title = $names[$key];
                            $menulists->slug = $slugs[$key];
                            $menulists->link = $request->link;
                            $menulists->status = $request->status;
                            $menulists->save();

                        endforeach;
                    }
                    
                }


                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Menu updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/menu/'),'csrf' => csrf_token()]);
            }
            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Menu not updated successfully.".$e->getMessage()); 
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
        $menulists = Menu::find($id);
        if($menulists==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $menulists->delete();

                Menu::where('parent_id',$id)->get()->each->delete();
                
                Session::flash('val', 1);
                Session::flash('msg', "Menu deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/menu');
        }
    }

}
