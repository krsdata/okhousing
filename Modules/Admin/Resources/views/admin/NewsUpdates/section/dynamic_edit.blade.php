  @if(isset($languages))
                            @foreach ($languages as $key => $value)
                               @if(\Illuminate\Support\Arr::exists($value, 'languages'))
                                
                                @php $NewsDetailsEach = Modules\Admin\Entities\NewsUpdates::where('language_id' ,$value['languages']['id'])->where('country_id',$value['created_country_id'])->where('parent_id',$parent_id)->orWhere('id',$parent_id)->first();

                                @endphp
                                <div class="row">
                                    <div class="langrow">
                                        

                                        <input type="hidden" name="desc_language[]" value="{{$value['language_id']}}">
                                            
                                        <input type="hidden" name="created_language_{{$value['language_id']}}" value="{{$value['language_id']}}">

                                        <input type="hidden" name="record[]" value="{{$NewsDetailsEach->id}}">

                                            
                                        <input type="hidden" name="created_country_{{$value['language_id']}}" value="{{$value['created_country_id']}}">

                                        <!---Property Name-->
                                        <div class="form-group col-md-6" id="title_{{$value['language_id']}}">
                                            <label>News title in {{$value['languages']['name']}}</label>
                                            <input id="title_{{$value['language_id']}}" name="title_{{$value['language_id']}}" type="text" class="form-control" placeholder="Enter Property Name in {{$value['languages']['name']}} " value="{{$NewsDetailsEach->title}}">
                                             <span  class="help-block"></span> 
                                        </div>
                                        <!----/* Property Name---->

                                        <div class="form-group col-md-6 " id="desc_{{$value['language_id']}}">
                                            <label>Description in {{$value['languages']['name']}}</label>
                                            <textarea rows="5" cols="5" class="form-control" placeholder="Property Description in {{$value['languages']['name']}}" name="desc_{{$value['language_id']}}" id= "description_{{$key+1}}" value="{{$NewsDetailsEach->content}}" >{{$NewsDetailsEach->content}}</textarea>
                                             <span  class="help-block"></span> 
                                        </div>
                                    </div>
                                </div>
                               
                               
                               @endif
                           @endforeach
                         @endif 
