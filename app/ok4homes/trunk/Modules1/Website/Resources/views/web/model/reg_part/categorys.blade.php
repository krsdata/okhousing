<h4>User Category</h4>  
<div class="boxes">
    <!--mainCategories-->
    @if($mainCategories->isNotEmpty())

    @php
        $m=0;
    @endphp
    
        @foreach ($mainCategories as $key => $main )   

           @if(\Illuminate\Support\Arr::exists($mainCategories[$key], 'created_modules'))

            @php 
                $m++;
            @endphp

            @if($m==1)
            <div class="left-item"> 
                <span>Main Category</span> 
                <ul class="fmain-fcategory"> 
            @endif

           @endif
        @endforeach  
        
        
        @foreach ($mainCategories as $key => $main)   
        @if(\Illuminate\Support\Arr::exists($mainCategories[$key], 'created_modules'))
            <li>
            <input type="checkbox" class="filled-in chk-main-cat" name="mainCat[]" id="filled-in-box{{$key}}" value="{{$mainCategories[$key]['created_modules']->id}}"/>
            <label for="filled-in-box{{$key}}">{{$mainCategories[$key]['created_modules']->module_name}}</label>
            </li>  
        @endif  
        @endforeach  
                                            
                                            
        @php
            $n=0;
        @endphp
    
        @foreach ($mainCategories as $key => $main )   

           @if(\Illuminate\Support\Arr::exists($mainCategories[$key], 'created_modules'))

            @php 
            $n++;
            @endphp

            @if($n==1)
                </ul> 
            </div>
            @endif

           @endif
        @endforeach                                     
                                                          
    @endif
    <!--/mainCategories-->                                   
       
    
    <!--otherCategories-->
    @if($otherCategories->isNotEmpty())
        @php
            $o=0;
        @endphp
        
        @foreach ($otherCategories as $key => $other ) 
            @if(\Illuminate\Support\Arr::exists($otherCategories[$key], 'created_modules'))
                @php 
                    $o++;
                @endphp
                
                @if($o==1)
                <div class="right-item">
                    <span>Other category</span>
                    <ul class="fother-fcategory">
                @endif

            @endif
        @endforeach 
        
        
        
        @foreach ($otherCategories as $key => $other ) 
            @if(\Illuminate\Support\Arr::exists($otherCategories[$key], 'created_modules'))
            <li>
                <input type="checkbox" class="filled-in chk-other-cat" name="otherCat[]" id="filled-in-box-{{$key}}" value="{{$otherCategories[$key]['created_modules']->id}}"/>
                <label for="filled-in-box-{{$key}}">{{$otherCategories[$key]['created_modules']->module_name}}</label>
            </li> 
            @endif
        @endforeach 
        
        
        
        @php
            $p=0;
        @endphp
        
        @foreach ($otherCategories as $key => $other ) 
            @if(\Illuminate\Support\Arr::exists($otherCategories[$key], 'created_modules'))
                @php 
                    $p++;
                @endphp
                
                @if($p==1)
                    </ul>
                </div>
                @endif

            @endif
        @endforeach
        
        
        
        
    @endif
    <!--/otherCategories-->
                                       
                                        
    
                                         
<!--                                        <div class="right-item">
                                            <span>Other category</span>
                                            <ul class="fother-fcategory"> 
                                                    <li>
                                                        <input type="checkbox" class="filled-in chk-other-cat" name="otherCat[]" id="filled-in-box-1" value="1"/>
                                                        <label for="filled-in-box-1">123</label>
                                                    </li>
                                                   
                                            </ul>
                                        </div> -->
                                         
                                    </div> 
                                    <div class="val-error caterror" style="margin-top: -6px !important;margin-left: 18px;"> </div>
                                    <div class="clearfix"></div>
                                    <button class="signup-btn Rnext2">Next</button>
