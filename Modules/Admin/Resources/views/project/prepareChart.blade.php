 
 <div class="col-md-12 ">        
        <h5 class="panel-title">Availability Chart </h5>
        <br/>
    <div class="table-responsive">
        <table class="table" cellpadding="10">
                <thead>
                    <tr border="1">
                        <th>Floor</th>
                        @for($i = 65 ; $i<65+$flats??1; $i++) 

                            <th>
                            Type {{ chr($i) }} <br>
                            <label class="checkbox-inline">  Select All  
                                            <input type="checkbox" class="checker border-success  bhk text-success-600 modulecountry   CheckboxStyleChart type_{{ chr($i) }}" name="select_{{ chr($i) }}" value="{{ chr($i) }}" id="select_{{chr($i)}}" onchange="checkAll(this)">
                            </label> <br>
                            <a href="javascript:void(0)" style="margin-top: 5px; display: inline-block; " onclick="editEnable('{{chr($i)}}')"> <i class=" icon-pen"></i> Edit</a>
                            <br>

                            <p>
                                Code <br><input type="text" name="code" class="form-control code_{{chr($i)}}">
                                <i class="fas fa-paper-plane" ></i>
                            </p> <span class="code_error_{{chr($i)}}"></span>
                            <button class="btn btn-success" type="button" onclick="getCode('{{chr($i)}}')"><i style="font-size:21px" class="icon-paperplane">Ok</i></button>
                            

                        </th>
                            
                        @endfor
                    </tr>
                </thead>
                <tbody>
                        <tr>
                                <td>Ground</td>
                                 @for($i = 65 ; $i<65+$flats??1; $i++) 
                                 <td style="padding-bottom: 20px;padding-top: 0px">
                                    <div> 
                                         <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success  bhk text-success-600 modulecountry {{ chr($i) }} check_code CheckboxStyleChart type_{{chr($i)}}" name="floor_flat[{{ chr($i) }}]" value="{{ chr($i) }}_G">
                                        </label>



                                    </div>
                                </td>
                                
                                @endfor   
                        </tr>

                    @for($i=1; $i<=$floors??1; $i++)
                        <tr>
                                <td>{{$i}}<sup>{{date("S", mktime(0, 0, 0, 0, $i, 0))}}</sup> Floor</td>
                                @for($c = 65 ; $c<65+$flats??1; $c++) 
                                 <td style="padding-bottom: 20px; padding-top: 0px">
                                    <div>  

                                         <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success  bhk text-success-600 modulecountry {{ chr($c) }} check_code CheckboxStyleChart type_{{chr($c)}}" name="floor_flat[{{ chr($c) }}]" value="{{ chr($c)}}_{{$i}}">
                                        </label>

                                    </div>
                                </td>
                                @endfor
                                  

                        </tr>
                    @endfor


                </tbody>
        </table>
    </div> 
</div>  
<script type="text/javascript">
     if($('.CheckboxStyleChart').length){ 
        $(".CheckboxStyleChart").uniform({
            radioClass: 'choice',
            wrapperClass: "border-success text-success-600"
        });
    }
</script>