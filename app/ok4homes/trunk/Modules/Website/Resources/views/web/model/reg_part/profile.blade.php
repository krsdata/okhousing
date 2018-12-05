<style type="text/css">
    
.input-field label {
   top: -10px;
}
.input-field.Blogobox > label {
    top: 10px;
}
</style>

                                    <div class="imageup">
                                        <div class="imageupload">
                                            <div class="viewimg">
                                                <img src="" alt="" id="mypro" class="mypro"/>
                                            </div>
                                            <div class="uploadimg">
                                                <input type="file" name="image" id="image">
                                                
                                                <span>Profile Image</span>
                                                <label for="image">Choose image</label>
                                            </div>
                                        </div>
                                         @if(isset($slug))
                                        <div class="slug" data-slug='{{$slug}}'>
                                            @if($slug =='builders')
                                           
                                            <div class="col-md-6">
                                                <div class="input-field  Bnamebox">
                                                    <input   type="text" class="validate" id="bname" name="bname"> 
                                                    <label for="bname">Builder Name</label>
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
                                    <button class="signup-btn semi-finish" id="UploadProData">Next</button>
