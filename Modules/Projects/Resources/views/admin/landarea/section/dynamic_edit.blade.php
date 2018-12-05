  @if(isset($languages))
                            @foreach ($languages as $key => $value)
                               @if(\Illuminate\Support\Arr::exists($value, 'languages'))
                                
                                @php

                               $BuildingUnitsEach = Modules\Projects\Entities\Landarea::where('language_id' ,$value['languages']['id'])->where('country_id',$value['created_country_id'])->whereNull('deleted_at')->where(function ($query) use ($parent_id) {
                                $query->where('parent_id',$parent_id)->orWhere('id',$parent_id);
                                })->first();

                               
                                    @endphp
                                <div class="row">
                                    <div class="langrow">
                                        

                                        <input type="hidden" name="desc_language[]" value="{{$value['language_id']}}">
                                            
                                        <input type="hidden" name="created_language_{{$value['language_id']}}" value="{{$value['language_id']}}">

                                        <input type="hidden" name="record[]" value="{{@$BuildingUnitsEach->id}}">

                                            
                                        <input type="hidden" name="created_country_{{$value['language_id']}}" value="{{$value['created_country_id']}}">

                                        <!---Property Name-->
                                        <div class="form-group col-md-6" id="areabox_{{$value['languages']['id']}}">
                                            <label>Name in {{$value['languages']['name']}}</label>
                                            
                                            <input id="area_{{$value['languages']['id']}}" name="area_{{$value['languages']['id']}}" type="text" class="form-control perm_text" placeholder="Enter Area" value="{{@$BuildingUnitsEach->land_area}}" >
                                            
                                            <input   name="short_name[]" type="hidden" value="{{$value['languages']['lang_code']}}" class="form-control" >
                                            <span  class="help-block "></span> 

                                        </div>
                                        <!----/* Property Name---->

                                        <div class="form-group col-md-6 " id="slugbox_{{$value['languages']['id']}}">
                                            <label>slug in {{$value['languages']['name']}}</label>
                                            
                                            <input  type="text" id="slug_{{$value['languages']['id']}}" name="slug_{{$value['languages']['id']}}" readonly class="form-control perm_slug" placeholder="Project Area Slug" value="{{@$BuildingUnitsEach->slug}}" >
                                            <span  class="help-block "></span> 

                                        </div>

                                       
                                    </div>
                                </div>
                               
                               
                               @endif
                           @endforeach
                         @endif 
