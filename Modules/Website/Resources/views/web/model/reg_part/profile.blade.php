<style type="text/css">
    
.input-field label {
   top: -10px;
}
.input-field.Blogobox > label {
    top: 10px;
}

.imageup .imageupload p{padding: 10px 20px;}

#ImageErrorValid
{
    color: red;
}
</style>

                                    <div class="imageup">
                                        <div class="imageupload">
                                            <div class="viewimg">
                                                <img src="" alt="" id="mypro" class="mypro"/>
                                            </div>
                                            <div class="uploadimg">
                                                <input type="file" name="image" id="image" accept="image/*">
                                                
                                                <span>{{trans('countries::home/home.profile_img')}}</span>
                                                <label for="image">{{trans('countries::home/home.choose_img')}}</label>
                                                <span class="has-error" id="ImageErrorValid"></span>
                                            </div>

                                            <p>{{trans('countries::home/home.proimgvalid')}}</p>

                                            

                                        </div>
                                         @if(isset($slug))
                                        <div class="slug" data-slug='{{$slug}}'>
                                            @if($slug =='builders')
                                           
                                            <div class="col-md-6">
                                                <div class="input-field  Bnamebox">
                                                    <input   type="text" class="validate" id="bname" name="bname"> 
                                                    <label for="bname">{{trans('countries::home/home.choose_img')}} </label>
                                                    <div class="val-error"></div> 
                                                </div>
												<div class="input-field YearBox">
                                                    <input   type="number" class="validate" id="est_year" name="est_year"> 
                                                    <label for="">Established Year</label>
                                                    <div class="val-error"></div> 
                                                </div>
												<div class="input-field Blogobox">
                                                  <div> <input   type="file"  id="blogo" name="blogo"></div>
                                                    
                                                    <label >Builder Logo</label>
                                                    <div class="val-error"></div> 
                                                    
                                                </div>
												
                                            </div>
                                            
                                            <div class="col-md-6">
                                                     <div class="input-field ">
                                                    <input   type="text" class="validate" id="street" name="street"> 
                                                    <label for="">Street</label>
                                                    <div class="val-error"></div> 
                                                </div>
												<div class="input-field PinBox">
                                                    <input   type="number" class="validate" id="pinno" name="pinno"> 
                                                    <label for="">Pin:no</label>
                                                    <div class="val-error"></div> 
                                                </div>
												<div class="input-field locationBox">
                                                    <input   type="text" class="validate" id="location" name="location"> 
                                                    <label for="">Location</label>
                                                    <div class="val-error"></div> 
                                                </div> 
                                            </div>
                                                
                                            <div class="clearfix" ></div>						
                                            
                                            @endif
                                        </div>
                                        @else
                                        <div class="about_section">
                                            
                                        </div>
                                        @endif
                                        
                                        
                                        
                                       
                                         
                                    </div>

                                    <a class="signup-btn" id="UploadProData">{{trans('countries::home/home.next_button')}}</a>

                                    <button class="signup-btn semi-finish" style="display:none;">{{trans('countries::home/home.next_button')}}</button>
