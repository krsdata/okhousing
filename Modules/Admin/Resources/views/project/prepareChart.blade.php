 
 <div class="col-md-12 ">        
        <h5 class="panel-title">Availability Chart </h5>
        <br/>
    <div class="table-responsive">
        <table class="table" cellpadding="10">
                <thead>
                    <tr>
                        <th>Floor</th>
                        @for($i = 65 ; $i<65+$flats??1; $i++) 

                            <th>{{ chr($i) }}</th>
                            
                        @endfor
                    </tr>
                </thead>
                <tbody>
                        <tr>
                                <td>Ground</td>
                                 @for($i = 65 ; $i<65+$flats??1; $i++) 
                                 <td>
                                    <div> 
                                        <label class="checkbox-inline">  
                                            <div class="checker border-success text-success-600" >
                                                <span>
                                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle"
                                                style=" position: absolute; top:-1 !important; left:-2 !important"
                                                name="{{ chr($i) }}">
                                                </span>
                                            </div>

                                        </label> 
                                    </div>
                                </td>
                                
                                @endfor  

                        </tr>

                    @for($i=1; $i<=$floors??1; $i++)
                        <tr>
                                <td>{{$i}}<sup>{{date("S", mktime(0, 0, 0, 0, $i, 0))}}</sup> Floor</td>
                                @for($c = 65 ; $c<65+$flats??1; $c++) 
                                 <td>
                                    <div> 
                                        <label class="checkbox-inline">  
                                            <div class="checker border-success text-success-600"><span><input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name="{{ chr($c) }}"></span></div>

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