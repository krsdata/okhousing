<?php 
$fcountry=Session::get('fcountry');
$currency_symbol = $fcountry['symbol'];
$country_flag = $fcountry['flag'];

?> <?php for($loop = 1; $loop <= 6; $loop++) { ?>
    <div class="mesh" id="1_{{$loop}}">
        <div class="mesh_content mesh_disabled">
       
        </div>
    </div>
    <?php } 
for($row= 2; $row<= 3; $row++)
{
    for($loop = 1; $loop <= 6; $loop++) {
        $id= $row.'_'.$loop;
        if(@$SliderList[$id])
        {
            $Slide = $SliderList[$id];
        ?>
        <div class="mesh" id="{{$row}}_{{$loop}}"   onclick="ShowProperty({{$Slide['id']}})" >
            <div class="mesh_content" id="{{$Slide['id']}}">
            @if($Slide['type']=='Property')
            <img src="{{asset('public/images/properties/'.$Slide['image'])}}" alt="" class="img-responsive">
            @else
             <img src="{{asset('public/images/user_pics/'.$Slide['image'])}}" alt="" class="img-responsive">
            @endif
            <div class="mesh_tittle">
            <h6>{{$Slide['title']}} <span class="location">{{ $Slide['location']}}</span></h6>
            </div>
            @if($Slide['prize'] !=='')
            <div class="mesh_footer"> <?php if($country_flag == 'in'){ ?>
                                                    <span class="WebRupee">Rs.</span>
                                                <?php } else { ?>
                                                     <span>{{@$currency_symbol}}</span>
                                                <?php } ?>
                                            {{$Slide['prize']}}/-</div>
            @endif
            </div>
        </div>
<?php } else { ?>
        <div class="mesh" id="{{$row}}_{{$loop}}">
        <div class="mesh_content mesh_disabled">
        
        </div>
    </div>
  <?php  
 } }
 } ?>

<div class="side_btns">
    @if(Auth::guard('front_user')->user() )
@php 
$EnquerytPropertyCount = Modules\Website\Entities\Enquiry::where('owner_id',Auth::guard('front_user')->user()->id)->orderBy('id', 'DESC')->count();
@endphp
        <a href="{{($EnquerytPropertyCount > 0 )?URL('/dashboard?Tab=Enquiry'):'#'}}" class="{{($EnquerytPropertyCount > 0 )?'enqactive':''}}" data-title="{{trans('countries::home/home.notification')}}({{$EnquerytPropertyCount}})"></a><br>
@endif
@if(Auth::guard('front_user')->user() )
@php 
$FvrtPropertyCount = Modules\Website\Entities\Wishlist::where('user_id', Auth::guard('front_user')->user()->id)->count();
@endphp
        <a href="{{($FvrtPropertyCount > 0 )?URL('/dashboard?Tab=Favorites'):'#'}}" class="{{($FvrtPropertyCount > 0 )?'fvractive':''}}" data-title="{{trans('countries::home/home.favorites')}}({{$FvrtPropertyCount}})"></a>

@endif
</div>
  <input type="hidden" id="hidden_active_div">
