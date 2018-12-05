$(function() {
    
    //initialize selectbox
    if($('.bootstrap-select').length){$('.bootstrap-select').selectpicker();}

    //initialize checkbox   
    if($('.CheckboxStyle').length){ 
        $(".CheckboxStyle").uniform({
            radioClass: 'choice',
            wrapperClass: "border-success text-success-600"
        });
    }

    //initialize filebutton
	if($(".file-styled-primary").length){
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    }
/* ************************************************************************* */  
/* *************************** initialize filebutton *********************** */  
/* ************************************************************************* */
    // change user type
    if($("#user_type").length)
    {
        $('#user_type').on('change', function()
        {
            
            $("#type-div label.validation-error-label").remove();
            var selected = $(this).find("option:selected").val();
            $("#htmlform").html(' ');
            if(selected ==1)
            {
                selected="other";
                var select=$("input:radio[name='type']:checked").attr('data-slug'); 
                if(select!='undefined') { if($("#site_user_update").length){var userId=$("#site_user_update").attr('data-id');geteditform(select,userId);}else{getform(select); }} 
            }
            if(selected ==0){ selected="main";} 
            $(".type-list").hide('slow');
            $('.builders_section').remove();
            $("#"+selected+"_types").show('slow');

        });
    }

/* ************************************************************************* */  
/* *************************** change user type **************************** */  
/* ************************************************************************* */  
    // change other types
$(".other_module").click(function()
{ 	
    $('.builders_section').remove();
    var select=$("input:radio[name='type']:checked").attr('data-slug');
   
    getform(select);
});

    if($("#site_user_update").length)
    {
        $(".other_module").click(function()
        {   
            $('.builders_section').remove();
            var select=$("input:radio[name='type']:checked").attr('data-slug');
            var userId=$("#site_user_update").attr('data-id');   
            geteditform(select,userId);
        });
    }


/* ************************************************************************* */  
/* *************************** change other types **************************** */  
/* ************************************************************************* */  

    function getform(select)
    {
        $.ajax
        ({
            type: 'GET',
            url: base_url+"/o4k/users/getform/"+select, 
            dataType: 'json',
            success: function (data) 
            { 
                if(data.html != false && data.html != null) {  $("#htmlform").html(data.html); }
                else { $("#htmlform").html(' '); }
            } 
        });
    }

    function geteditform(select,userId)
    {
        $.ajax
        ({
            type: 'GET',
            url: base_url+"/o4k/users/geteditform/"+select+"/"+userId, 
            dataType: 'json',
            cache: false,
            success: function (data) 
            { 
                 if(data.html != false && data.html != null ) {  

                    $("#htmlform").html(data.html); 
                    if(data.builders !=null){
                    
                         $("#builder_name").val(data.builders.builder_name);
                         $("#mobile_number").val(data.builders.mobile);
                         $("#builder_year").val(data.builders.established_year);
                         $("#street_name").val(data.builders.street_name);
                         $("#pin_number").val(data.builders.post_code);
                         $("#location").val(data.builders.location);
                         if(data.builders.builder_logo !=null){$("#imageDiv").show(); $("#image").attr('src',base_url+"/public/images/builders/"+data.builders.builder_logo);}
                         
                    }
                     
                }
                else { $("#htmlform").html(' '); }
            } 
        });
    }

/* ************************************************************************* */  
/* *************************** get form according to change***************** */  
/* ************************************************************************* */  
	if($('#users_list').length){
        $('#users_list').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/o4k/users/AdminUsersList",
		
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                {
                data: "created_at", sortable: true,
                render: function (data, type, full) {  return full.created_at; } 
                },
                {
                data: "status", sortable: true, 'sWidth': '10%',
                render: function (data, type, full) { 
                if(full.status=="1")  { return '<span class="label label-success">Active</span>';  }
                else  { return '<span class="label label-default">Inactive</span>'; }

                }

                },
                {
                data: "null",
                sortable: false,
                render: function (data, type, full) {  
                    var  u = '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                    '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">'+
                    '<li><a href="'+base_url+'/o4k/users/edit/'+full.id+'"><i class=" icon-pen"></i> Edit User</a></li>';
                    if(full.status=="0")
                    {
                        u+= '<li ><a class="change_status"  href="'+base_url+'/o4k/users/activate/'+full.id+'"><i class=" icon-eye"></i> Activate User</a></li>';
                    }
                    else
                    {
                        u+='<li  ><a class="change_status" href="'+base_url+'/o4k/users/deactivate/'+full.id+'"><i class="  icon-eye-blocked"></i> Deactivate User</a></li>';
                    } 
                    u+='<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/users/destroy/'+full.id+'"><i class="icon-trash"></i> Delete User</a></li>';
                    '</ul></li></ul>';                     
                    return u;
                }

                }
            ]
       
        });
    }

/* ************************************************************************* */  
/* *************************** data table listing end ********************** */  
/* ************************************************************************* */ 


   
    /*
     * create form 
     * params : Name,Status,Slug  
     */

    $("#site_user_create").submit(function(e)
    {
		
        e.preventDefault();
        var user_name=$("#admin_name").val().trim();
        var user_email=$("#admin_email").val().trim();
        var mobilnumber=$("#mnumber").val().trim();
        var location=$("#location").val().trim();
        var user_image=$("#image").val().trim();
        var user_type=$("#user_type").val().trim();
        var main_type=$("#main_types").val().trim();
        //var unique_code=$("#unique_code").val().trim(); 	
        var a=b=d=e=f=g=h=0;
		
        /*user name validation*/
        if(user_name.length > 0)
        {
            a=1;
            $( "#namebox" ).removeClass( "has-error" );
            $("#namebox .help-block").html(' ');
        }
        else
        {
            a=0;
            $( "#namebox" ).addClass( "has-error" ); 
            $("#namebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
		
        /*user user email validation*/
        if(user_email.length > 0)
        { 
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(user_email))
            {
                b=1;
                $( "#emailbox" ).removeClass( "has-error" );
                $("#emailbox .help-block").html(' ');
            }
            else
            {
                b=0;
                $( "#emailbox" ).addClass( "has-error" ); 
                $("#emailbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid email id.</label>');
            }
        }
        else
        {
            b=0;
            $( "#emailbox" ).addClass( "has-error" ); 
            $("#emailbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        /*user user mobile number validation*/ 
        if(mobilnumber.length > 9)
        { 
            var numbers = /^[0-9]+$/;
            if(mobilnumber.match(numbers))
            {
                d=1;
                $( "#mobilebox" ).removeClass( "has-error" );
                $("#mobilebox .help-block").html(' ');
            }
            else
            { 
                d=0;
                $( "#mobilebox" ).addClass( "has-error" ); 
                $("#mobilebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter valid number.</label>');
            }	
        }
        else
        {
            d=0;
            $( "#mobilebox" ).addClass( "has-error" ); 
            $("#mobilebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        /*location validation*/
        if(location.length > 0)
        {
            e=1;
            $( "#locationbox" ).removeClass( "has-error" );
            $("#locationbox .help-block").html(' ');
        }
        else
        {
            e=0;
            $( "#locationbox" ).addClass( "has-error" ); 
            $("#locationbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }


        /*user type validation*/
        if(user_type.length > 0)
        {
            $( "#usertypebox" ).removeClass( "has-error" );
            $("#usertypebox .help-block").html(' ');
            if(user_type==0)
            {
                if($("[name='types[]']:checked").length > 0 )
                {
                    f=1;
                    $( "#usertypebox" ).removeClass( "has-error" );
                    $("#usertypebox .help-block").html(' ');
                }
                else
                {
                    f=0;
                    $( "#usertypebox" ).addClass( "has-error" ); 
                    $("#usertypebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select at least one type.</label>');
                }	
            }
            else if(user_type==1)
            {
                if($("[name='type']:checked").length > 0 )
                {
                    f=1;
                    $( "#usertypebox" ).removeClass( "has-error" );
                    $("#usertypebox .help-block").html(' ');
                }
                else
                {
                    f=0;
                    $( "#usertypebox" ).addClass( "has-error" ); 
                    $("#usertypebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select at least one type.</label>');
                }
            }	
        }
        else
        {
            f=0;
            $( "#usertypebox" ).addClass( "has-error" ); 
            $("#usertypebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
		
		/*user code validation*/
		// if(unique_code.length > 0)
		// {
		// 	$.ajax({
  //           type: 'GET',
		// 	async: false,
		// 	cache: false,
  //           url: base_url+"/o4k/users/getuniquecode/"+unique_code, 
  //           dataType: 'json',
  //           success: function (data) {
				
		// 		if(data.status=='0'){
		// 			g=0;
		// 			$( "#uniquecodebox" ).addClass( "has-error" ); 
		// 	        $("#uniquecodebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Unique ID already taken.</label>');

		// 		}
		// 		else if(data.status=='1')
		// 			{
		// 			g=1;
		// 			$( "#uniquecodebox" ).removeClass( "has-error" );
  //                   $("#uniquecodebox .help-block").html(' ');
		// 		} 
		// 		else{
		// 			g=1;
		// 			$( "#uniquecodebox" ).removeClass( "has-error" );
  //                   $("#uniquecodebox .help-block").html(' ');
		// 		} 
  //           },
               
  //       });
			
			
		// }else{
		// 	g=1;
			
		// }
		 
        //dynamic form validation
        if(user_type==1)
        {
            if($("[name='type']:checked").length > 0 )
            {
                if($("[name='type']:checked").attr('data-slug') == 'builders')
                {
                    var builder_name =$("#builder_name").val().trim();
                    var mobile_number=$("#mobile_number").val().trim();
                    var builder_year=$("#builder_year").val().trim();
                    var builder_logo=$("#builder_logo").get(0).files.length	
                    var pin_number=$("#pin_number").val().trim();
                    
                    //builder_name
                    if(builder_name.length > 0)
                    {
                        h=1;
                        $( "#buildernamebox" ).removeClass( "has-error" );
                        $("#buildernamebox .help-block").html(' ');
                    }
                    else
                    {
                        h=0;
                        $( "#buildernamebox" ).addClass( "has-error" ); 
                        $("#buildernamebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }
                    
                    //mobile_number    
                    if(mobile_number.length > 9)
                    {
                        var numbers = /^[0-9]+$/;
                        if(mobile_number.match(numbers))
                        {
                            h=1;
                            $( "#buildermbox" ).removeClass( "has-error" );
                            $("#buildermbox .help-block").html(' ');
                        }
                        else
                        { 
                            h=0;
                            $( "#buildermbox" ).addClass( "has-error" ); 
                            $("#buildermbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter valid number.</label>');
                        }	
                    }
                    else
                    {
                        h=0;
                        $( "#buildermbox" ).addClass( "has-error" ); 
                        $("#buildermbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }
                    
                    //builder_year    
                    if(builder_year.length > 0)
                    {
                        h=1;
                        $( "#builderybox" ).removeClass( "has-error" );
                        $("#builderybox .help-block").html(' ');
                    }
                    else
                    {
                        h=0;
                        $( "#builderybox" ).addClass( "has-error" ); 
                        $("#builderybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }
                    
                    //builder_logo   
                    if(builder_logo > 0)
                    {
                        h=1;
                        $( "#builderlbox" ).removeClass( "has-error" );
                        $("#builderlbox .help-block").html(' ');
                    }
                    else
                    {
                        h=0;
                        $( "#builderlbox" ).addClass( "has-error" ); 
                        $("#builderlbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }
                    
                    //pin_number
                    if(pin_number.length > 0)
                    {
                        h=1;
                        $( "#builderpinbox" ).removeClass( "has-error" );
                        $("#builderpinbox .help-block").html(' ');
                    }
                    else
                    {
                        h=0;
                        $( "#builderpinbox" ).addClass( "has-error" ); 
                        $("#builderpinbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }

                }else{
                    h=1;
                }
            }
        }
        else
        {
            h=1;
        }
 	
        /*validation checking*/
        if(a==0 || b==0 || d==0 || e==0 ||  f==0  || h==0 )
        {
                return false;
        }
        else 
        {
            /* server checking */
            $.ajax({
            type: "POST",
            url: base_url+"/o4k/users/store", 
            data: new FormData($('#site_user_create')[0]),
            dataType: "json",  
            cache:false,
            contentType: false,                   
            processData:false,
            success: function(response){
                if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
            },
            error: function (request, textStatus, errorThrown) {
                var obj = request.responseJSON.errors ;

                if(obj.hasOwnProperty("email") )
                {
                   $( "#emailbox" ).addClass( "has-error" );
                   $("#emailbox .help-block").html("<div class='mad'>"+request.responseJSON.errors.email[0]+"</div>");   
                }                  
                if(obj.hasOwnProperty("mnumber") )
                {
                    $( "#mobilebox" ).addClass( "has-error" );
                    $("#mobilebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.mnumber[0]+"</div>");   
                }   
            }

        });


        }	
		
	});
	
/* ************************************************************************* */  
/* *************************** create end ********************************** */  
/* ************************************************************************* */ 

   
    /*
     * edit form 
     * params : Name,Status,Slug  
     */

    $("#site_user_update").submit(function(e)
    {
        e.preventDefault();
        var user_name=$("#admin_name").val().trim();
        var user_email=$("#admin_email").val().trim();
        var mobilnumber=$("#mnumber").val().trim();
        var location=$("#location").val().trim();
        var user_password=$("#password").val().trim();
        var user_type=$("#user_type").val().trim();
        var main_type=$("#main_types").val().trim();

        var a=b=d=e=f=g=h=0;

        /*user name validation*/
        if(user_name.length > 0)
        {
            a=1;
            $( "#namebox" ).removeClass( "has-error" );
            $("#namebox .help-block").html(' ');
        }
        else
        {
            a=0;
            $( "#namebox" ).addClass( "has-error" ); 
            $("#namebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        /*user user email validation*/
        if(user_email.length > 0)
        { 
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(user_email))
            {
                b=1;
                $( "#emailbox" ).removeClass( "has-error" );
                $("#emailbox .help-block").html(' ');
            }
            else
            {
                b=0;
                $( "#emailbox" ).addClass( "has-error" ); 
                $("#emailbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid email id.</label>');
            }
        }
        else
        {
            b=0;
            $( "#emailbox" ).addClass( "has-error" ); 
            $("#emailbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        /*user user mobile number validation*/ 
        if(mobilnumber.length > 9)
        { 
            var numbers = /^[0-9]+$/;
            if(mobilnumber.match(numbers))
            {
                d=1;
                $( "#mobilebox" ).removeClass( "has-error" );
                $("#mobilebox .help-block").html(' ');
            }
            else
            { 
                d=0;
                $( "#mobilebox" ).addClass( "has-error" ); 
                $("#mobilebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter valid number.</label>');
            }	
        }
        else
        {
            d=0;
            $( "#mobilebox" ).addClass( "has-error" ); 
            $("#mobilebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        /*location validation*/
        if(location.length > 0)
        {
            e=1;
            $( "#locationbox" ).removeClass( "has-error" );
            $("#locationbox .help-block").html(' ');
        }
        else
        {
            e=0;
            $( "#locationbox" ).addClass( "has-error" ); 
            $("#locationbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        /*user type validation*/
        if(user_type.length > 0)
        {
            $( "#usertypebox" ).removeClass( "has-error" );
            $("#usertypebox .help-block").html(' ');
            if(user_type==0)
            {
                if($("[name='types[]']:checked").length > 0 )
                {
                    f=1;
                    $( "#usertypebox" ).removeClass( "has-error" );
                    $("#usertypebox .help-block").html(' ');
                }
                else
                {
                    f=0;
                    $( "#usertypebox" ).addClass( "has-error" ); 
                    $("#usertypebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select at least one type.</label>');
                }	
            }
            else if(user_type==1)
            {
                if($("[name='type']:checked").length > 0 )
                {
                    f=1;
                    $( "#usertypebox" ).removeClass( "has-error" );
                    $("#usertypebox .help-block").html(' ');
                }
                else
                {
                f=0;
                $( "#usertypebox" ).addClass( "has-error" ); 
                $("#usertypebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                }
            }	
        }
        else
        {
            f=0;
            $( "#usertypebox" ).addClass( "has-error" ); 
            $("#usertypebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //dynamic form validation
        if(user_type==1)
        {
            if($("[name='type']:checked").length > 0 )
            {
                if($("[name='type']:checked").attr('data-slug') == 'builders')
                {
                    var builder_name =$("#builder_name").val().trim();
                    var mobile_number=$("#mobile_number").val().trim();
                    var builder_year=$("#builder_year").val().trim();
                    var pin_number=$("#pin_number").val().trim();
                    
                    //builder_name
                    if(builder_name.length > 0)
                    {
                        h=1;
                        $( "#buildernamebox" ).removeClass( "has-error" );
                        $("#buildernamebox .help-block").html(' ');
                    }
                    else
                    {
                        h=0;
                        $( "#buildernamebox" ).addClass( "has-error" ); 
                        $("#buildernamebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }
                    
                    //mobile_number
                    if(mobile_number.length > 9)
                    {
                        var numbers = /^[0-9]+$/;
                        if(mobile_number.match(numbers))
                        {
                            h=1;
                            $( "#buildermbox" ).removeClass( "has-error" );
                            $("#buildermbox .help-block").html(' ');
                        }
                        else
                        { 
                            h=0;
                            $( "#buildermbox" ).addClass( "has-error" ); 
                            $("#buildermbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter valid number.</label>');
                        }	
                    }
                    else
                    {
                        h=0;
                        $( "#buildermbox" ).addClass( "has-error" ); 
                        $("#buildermbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }
                    
                    //builder_year
                    if(builder_year.length > 0)
                    {
                        h=1;
                        $( "#builderybox" ).removeClass( "has-error" );
                        $("#builderybox .help-block").html(' ');
                    }
                    else
                    {
                        h=0;
                        $( "#builderybox" ).addClass( "has-error" ); 
                        $("#builderybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }
                    
                    //pin_number
                    if(pin_number.length > 0)
                    {
                        h=1;
                        $( "#builderpinbox" ).removeClass( "has-error" );
                        $("#builderpinbox .help-block").html(' ');
                    }
                    else
                    {
                        h=0;
                        $( "#builderpinbox" ).addClass( "has-error" ); 
                        $("#builderpinbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }
                }else{ h=1; }	
            }
        }
        else {  h=1; }


       
        /*validation checking*/
        if(a==0 || b==0  || d==0 || e==0 || f==0  || h==0)
        {
                return false;
        }
        else 
        {
             
            /* server checking */

            $.ajax
            ({
                type: "POST",
                url: base_url+"/o4k/users/update/"+$("#site_user_update").attr('data-id'), 
                data: new FormData($('#site_user_update')[0]),
                dataType: "json",  
                cache:false,
                contentType: false,                   
                processData:false,
                success: function(response){ 
                   if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                },
                error: function (request, textStatus, errorThrown) {
                    var obj = request.responseJSON.errors ;
                    if(obj.hasOwnProperty("email") )
                    {
                       $( "#emailbox" ).addClass( "has-error" );
                       $("#emailbox .help-block").html("<div class='mad'>"+request.responseJSON.errors.email[0]+"</div>");   
                    }

                    if(obj.hasOwnProperty("mnumber") )
                    {
                        $( "#emailbox" ).addClass( "has-error" );
                        $("#emailbox .help-block").html("<div class='mad'>"+request.responseJSON.errors.mnumber[0]+"</div>");   
                    }
                }
            });
        }	
    });
	
	
/* ************************************************************************* */  
/* *************************** update end ********************************** */  
/* ************************************************************************* */ 

	
	 

});

/* ************************************************************************* */  
/* *************************** Function to get google location ********************************** */  
/* ************************************************************************* */ 


    function initMap() {

        var input = document.getElementById('location');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {

        var place = autocomplete.getPlace();

        if (!place.geometry) {
           // User entered the name of a Place that was not suggested and
           // pressed the Enter key, or the Place Details request failed.
           window.alert("No details available for input: '" + place.name + "'");
           return;
        }

        var address = '';
        if (place.address_components) {
          address = [
            (place.address_components[0] && place.address_components[0].short_name || ''),
            (place.address_components[1] && place.address_components[1].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
          ].join(' ');
        }

        $('#lat').val(place.geometry.location.lat());
        $('#lng').val(place.geometry.location.lng());

      });

    }
