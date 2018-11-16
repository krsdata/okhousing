 
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
                                            <input type="checkbox" class="checker border-success  bhk text-success-600 modulecountry  CheckboxStyleChart" name="{{ chr($i) }}" value="{{ chr($i) }}">
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
                                            <input type="checkbox" class="checker border-success  bhk text-success-600 modulecountry  CheckboxStyleChart" name="{{ chr($c) }}" value="{{ chr($c) }}">
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