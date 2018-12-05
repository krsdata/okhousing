<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\NewsUpdates;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Countries\Entities\Countrylangs;
use Modules\Countries\Entities\Countries;

class AdminNewsUpdatesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::admin.NewsUpdates.index');
    }

    public function allNewsUpdateslists()
    {

        return Datatables::of(NewsUpdates::where('language_id',1)->orderBy('updated_at', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $NewsUpdates=NewsUpdates::get();
        $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        return view('admin::admin.NewsUpdates.create', compact('NewsUpdates','languages','countries'));
    }


     /**
     * Return ajax response based on country id.
     * @return Response
     */

    public function getlanguage($countryid,Request $request)
    {
        if($request->ajax())
        {
            $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->orderBy('language_id', 'ASC')->get()->toArray();
            if(!empty($languages))
            {  

                 $returnHTML = (String) view('admin::admin.NewsUpdates.section.dynamic',compact('languages'));
                return response()->json(['status'=>true, 'html'=>$returnHTML,'csrf' => csrf_token()]);
            }else{return response()->json(['status'=>false, 'message'=>'Oops something went wrong','csrf' => csrf_token()]);}
        }else{return redirect('/404');}
    }


    public function getlanguage_edit($countryid,$parent_id,Request $request)
    {
        if($request->ajax())
        {
            $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->orderBy('id', 'ASC')->get()->toArray();
            if(!empty($languages))
            {  

                 $returnHTML = (String) view('admin::admin.NewsUpdates.section.dynamic_edit',compact('languages','parent_id'));
                return response()->json(['status'=>true, 'html'=>$returnHTML,'csrf' => csrf_token()]);
            }else{return response()->json(['status'=>false, 'message'=>'Oops something went wrong','csrf' => csrf_token()]);}
        }else{return redirect('/404');}
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {


        $image='';
        $desc_language = $request->desc_language;
        $title_entrys= 'title_'.$request->desc_language[0];
        $desc_entrys= 'desc_'.$request->desc_language[0];
        $NewsUpdateslists = new NewsUpdates;
        $NewsUpdateslists->title = $_POST[$title_entrys];
        $NewsUpdateslists->content = $_POST[$desc_entrys];
        $NewsUpdateslists->language_id = $desc_language[0];
        $NewsUpdateslists->country_id = $request->countries;
        

        if($request->file('image')){
                $extension = $request->file('image')->getClientOriginalExtension();
            $iconname = time().'.'.$extension;
            $destinationPath = public_path() . "/images/NewsUpdates/";
            $request->file('image')->move($destinationPath, $iconname);
            $image = $iconname;
         
        }

        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."news_updates'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {
            $nextId = $tableStatus[0]->Auto_increment; 
            $NewsUpdateslists->id=(1+$nextId);

            try{
                    $NewsUpdateslists->save();
                    $id = $NewsUpdateslists->id;
                    $NewsUpdateslists->image = $image;
                    $NewsUpdateslists->save();

                    if($request->desc_language){
                       

                        for($i=1;$i< count($desc_language); $i++)
                        {
                            $desc_entry = 'desc_'.$desc_language[$i];
                            $title_entry = 'title_'.$desc_language[$i];
                            $created_language_id = 'created_language_'.$desc_language[$i];
                            

                            $NewsUpdateslists = new NewsUpdates;
                            $NewsUpdateslists->title = $_POST[$title_entry];
                            $NewsUpdateslists->content = $_POST[$desc_entry];
                            $NewsUpdateslists->language_id = $desc_language[$i];
                            $NewsUpdateslists->country_id = $request->countries;
                            $NewsUpdateslists->image = $image;
                            $NewsUpdateslists->parent_id = $id;
                            $NewsUpdateslists->save();

                        }
                                
                    }

            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "News & Updates created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/NewsUpdates/'),'csrf' => csrf_token()]);
            }
            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "News & Updates not added successfully.".$e->getMessage()); 
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
        
        $NewsUpdates = NewsUpdates::find($id);
        if($NewsUpdates==null){return redirect('/o4k/404');}
        else{
            $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();

            $NewsUpdatesList = NewsUpdates::where('parent_id',$id)->get();
            $Ids =  $NewsUpdatesList->pluck('id')->toArray(); 
            $Ids[] = $id;
            
            $languages=Countrylangs::with('languages')->where('created_country_id',$NewsUpdates->country_id)->get()->toArray();


           return view('admin::admin.NewsUpdates.edit', compact('NewsUpdates','languages','countries','Ids'));
        }

        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

       
        $image ='';
        $NewsUpdateslists = NewsUpdates::find($id);
        if($NewsUpdateslists==null){ 
        $request->session()->flash('val', 0);
        $request->session()->flash('msg', "NewsUpdates not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
                if($request->file('image')){
                        $extension = $request->file('image')->getClientOriginalExtension();
                        $iconname = time().'.'.$extension;
                        $destinationPath = public_path() . "/images/NewsUpdates/";
                        $request->file('image')->move($destinationPath, $iconname);
                        $image = $NewsUpdateslists->image      = $iconname;
                     
                }


            try{
               

                
                if($request->desc_language){
                       
                    $desc_language = $request->desc_language;
                    for($i=0;$i< count($desc_language); $i++)
                    {
                        $desc_entry = 'desc_'.$desc_language[$i];
                        $title_entry = 'title_'.$desc_language[$i];
                        $created_language_id = 'created_language_'.$desc_language[$i];
                        
                        $NewsUpdateslists = NewsUpdates::find($request->record[$i]);
                        $NewsUpdateslists->title = $_POST[$title_entry];
                        $NewsUpdateslists->content = $_POST[$desc_entry];
                        $NewsUpdateslists->language_id = $desc_language[$i];
                        $NewsUpdateslists->country_id = $request->countries;
                        if($image !=='')
                        {
                            $NewsUpdateslists->image = $image;
                        }
                        
                        $NewsUpdateslists->save();

                    }
                                
                }


                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "News & Updates updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/NewsUpdates/'),'csrf' => csrf_token()]);
            }
            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "News & Updates not updated successfully.".$e->getMessage()); 
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
        $NewsUpdateslists = NewsUpdates::find($id);
        if($NewsUpdateslists==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $NewsUpdateslists->delete();

                $NewsUpdateslists = NewsUpdates::where('parent_id',$id)->delete();
                Session::flash('val', 1);
                Session::flash('msg', "News & Updates deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/NewsUpdates');
        }
    }

}
