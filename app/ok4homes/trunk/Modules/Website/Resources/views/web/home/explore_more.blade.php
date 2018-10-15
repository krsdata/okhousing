@php
$fcountry_lang=Session::get('fcountry_lang');
$fcountry_language=Session::get('fcountry_language');


$fcountry=Session::get('fcountry');
$fcountry=Session::get('fcountry');


 $countryId=$fcountry['id'];
$langId=$fcountry_language['id'];

@endphp

<?php 
$Sections = Modules\Admin\Entities\Sections::where('title','Listing of service')->first();

if($Sections->status == 1) 
{


       $agentId=Modules\Module\Entities\Modules::select('id')->where('slug','agent')->first();
        if($agentId)
        {
            $resultArray = array();

            $agents = Modules\Users\Entities\UserModules::with(['created_users','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id',$langId);}])->where('module_id',$agentId->id)->count();
                
                //return Datatables::of($resultArray)->make(true); 
         
                $Agentscount="";
                $Agentscount = $agents;
                if($Agentscount > 99 && $Agentscount <= 1000)
                {
                     $Agentscount= '1000'."<sup>+</sup>";
                }elseif ($Agentscount>1000 && $Agentscount<2000 ) {
                   $Agentscount='2000'."<sup>+</sup>";
                }elseif ($Agentscount>2000 && $Agentscount<3000) {
                    $Agentscount='3000'."<sup>+</sup>";
                }      
             
        }


        $Utilitycount="";
        $utilityId=Modules\Module\Entities\Modules::select('id')->where('slug','utility')->first();
        if($utilityId){
            $resultArray = array();
            $utilitys = Modules\Users\Entities\UserModules::with('created_users')->where('module_id',$utilityId->id)->get();
            
             $Utilitycount = Modules\Users\Entities\UserModules::with(['created_users','created_userdetails' => function ($query) use ($countryId,$langId){$query->where('user_countries_id',$countryId);$query->where('language_id',$langId);}])->where('module_id',$agentId->id)->count();


              
               //echo  $Utilitycount=count($resultArrayutility);die;
                  //$Agentscount=2500;
               if($Utilitycount > 99 && $Utilitycount <= 1000)
                {
                     $Utilitycount= '1000'."<sup>+</sup>";
                }elseif ($Utilitycount>1000 && $Utilitycount<2000 ) {
                   $Utilitycount='2000'."<sup>+</sup>";
                }elseif ($Utilitycount>2000 && $Utilitycount<3000) {
                    $Utilitycount='3000'."<sup>+</sup>";
                }              
        } 






?>







<!--our directories-->
<section class="our-dir">
     <div class="container width75 directiory-box">
    <div class="dir-main">
    <div class="dir-items one">
    <div class="contant">
    <img src="{{asset('public/web/images/builder.png')}}">
    <span class="spn-1">{{trans('countries::home/home.builder_directory_listings')}}</span>
    <span class="spn-2">1000<sup>+</sup> {{trans('countries::home/home.listing')}}</span>
    </div>
    <div class="bg"></div>
    </div>
    </div>
    <div class="dir-main">
    <div class="dir-items two">
    <div class="contant">
    <a href="ok4/agents_lsting">
    <img src="{{asset('public/web/images/agent.png')}}">
    <span class="spn-1">{{trans('countries::home/home.agent_directory_listings')}}</span>
    <span class="spn-2">{{ $Agentscount }} {{trans('countries::home/home.listing')}}</span>
    </a>
    </div>
    <div class="bg"></div>
    </div>
    </div>
    <div class="dir-main">
    <div class="dir-items two">
    <div class="contant">
    <img src="{{asset('public/web/images/utility.png')}}">
    <span class="spn-1">{{trans('countries::home/home.utility_directory_listings')}}</span>
    <span class="spn-2">{{ $Utilitycount }} {{trans('countries::home/home.listing')}}</span>
    </div>
    <div class="bg"></div>
    </div>
    </div>
    <div class="dir-main">
    <div class="dir-items three">
    <div class="contant">
    <img src="{{asset('public/web/images/home.png')}}">
    <span class="spn-1">{{trans('countries::home/home.home_interiors_listings')}}</span>
    <span class="spn-2">1000<sup>+</sup> {{trans('countries::home/home.listing')}}</span>
    </div>
    <div class="bg"></div>
    </div>
    </div>
    <div class="dir-main">
    <div class="dir-items one">
    <div class="contant">
    <img src="{{asset('public/web/images/home.png')}}">
    <span class="spn-1">{{trans('countries::home/home.home_stay_listings')}}</span>
    <span class="spn-2">1000<sup>+</sup>{{trans('countries::home/home.listing')}}</span>
    </div>
    <div class="bg"></div>
    </div>
    </div>
    </div>
   
    
</section>

<?php } ?>
<!--/our directories-->
