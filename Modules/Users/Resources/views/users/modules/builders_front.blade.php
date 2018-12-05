<form name="registerbuilder" novalidate ng-click="registerController.register_stepbuilder()" >
    <ul class="form-list">
        <li>
            <div class="input-field">
                <input id="builder_name" type="text" class="validate" name="builder_name" ng-model="builder_name" required>
                <label for="builder_name">Builder Name</label>
                <span ng-show="registerbuilder.builder_name.$error.required && !registerbuilder.builder_name.$pristine" >Builder name is required.</span>
            </div>
        </li>
        <li>
            <div class="input-field number">
                <!-- <div class="left"> -->
                    <input style="padding-left: 46px;" type="tel" id="builder_phone_sel" ng-model="builder_phone" name="builder_phone" required>
                    
                <!-- </div> -->
                <!-- <div class="right">
                    <input type="text" class="validate">
                </div> -->

            </div>
            <span ng-show="registerbuilder.builder_phone.$error.required && !registerbuilder.builder_phone.$pristine" >Builder Mobile is required.</span>
        </li>
        <li>
            <div class="input-field">
                <input id="builder_year" type="text" class="validate" name="builder_year" ng-model="builder_year" required>
                <label for="builder_year">Established Year</label>
                <span ng-show="registerbuilder.builder_year.$error.required && !registerbuilder.builder_year.$pristine" >Builder name is required.</span>
            </div>
        </li>
       <li>
	       	<div class="imageup">
	            <div class="imageupload">
	                <div class="viewimg"><span>+</span></div>
	                <div class="uploadimg">
	                    <input type="file" name="builder_logo" id="builder_logo">
	                    <span>Builder Logo</span>
	                    <label for="builder_logo">Choose image</label>
	                </div>
	            </div>
	        </div>
       </li>
       <li>
            <div class="input-field">
                <input id="builder_street_name" type="text" class="validate" name="builder_street_name" ng-model="builder_street_name" >
                <label for="builder_street_name">Street Name</label>
            </div>
        </li>
        <li>
            <div class="input-field">
                <input id="builder_pin_no" type="text" class="validate" name="builder_pin_no" ng-model="builder_pin_no" required>
                <label for="builder_pin_no">Pin No:</label>
                <span ng-show="registerbuilder.builder_pin_no.$error.required && !registerbuilder.builder_pin_no.$pristine" >Builder Pin No is required.</span>
            </div>
        </li>
        <li>
            <div class="input-field">
                <input id="builder_locatioon" type="text" class="validate" name="builder_locatioon" ng-model="builder_locatioon" >
                <label for="builder_locatioon">Builder Location</label>
            </div>
        </li>
    </ul>
    <button type="submit" class="signup-btn" ng-disabled="!registerbuilder.$valid" ng-click="register_stepbuilder()" >Next</button>
</form>
