 <?php for($loop = 1; $loop <= 6; $loop++) { ?>
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
        <div class="mesh" id="{{$row}}_{{$loop}}">
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
            <div class="mesh_footer">{{$Slide['prize']}}/-</div>
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
        <a href="#" data-title="{{trans('countries::home/home.notification')}}"></a><br>
        <a href="#" data-title="{{trans('countries::home/home.favorites')}}"></a>
</div>
