$(function() {
	

    //initialize intlTelInput
    $("#mnumber").intlTelInput({
      initialCountry: "auto",
      allowDropdown: false,
      utilsScript: base_url+"/public/site/js/plugin/utils.js"  ,
      
    });
   //initialize selectbox
    if($('.bootstrap-select').length){$('.bootstrap-select').selectpicker();}
	
	//initialize filebutton
    if($(".file-styled-primary").length){
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    }

    //fetch language and append based on selected country
    $("#country_id").change(function() 
    {
        $(".name_row").remove();
        var countryId=$( "#country_id" ).val(); 
        var countryflag=$(this).find(':selected').attr("data-flag" );  
        $("#mnumber").intlTelInput("setCountry", countryflag);
        
        $.ajax({
            type: 'GET',
            url: base_url+"/o4k/utility/getlanguage/"+countryId, 
            dataType: 'json',
            success: function (data) {
            if(data.status==true) { $(".langsection").html(data.html); }
            else { $("#error-common").html(data.message);  }
           
            },
               
        });
        
    });

    //show added names based on language in edit

    if($("#utility_update").length)
    {
        var userId = $( "#utility_update" ).attr("data-id" );  
        var countryId=$( "#country_id" ).val();
        var countryflag=$(this).find(':selected').attr("data-flag" );  
        $("#mnumber").intlTelInput("setCountry", countryflag);
        $.ajax({
            type: 'GET',
            url: base_url+"/o4k/utility/getName/"+countryId+"/"+userId, 
            dataType: 'json',
            success: function (data) {
            if(data.status==true) { $(".langsection").html(data.html); }
            else { $("#error-common").html(data.message);  }
           
            },
               
        });
        

    } 


/* ************************************************************************* */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  
     
     
   if($('#utility_list').length){
      
        $('#utility_list').DataTable({
            processing: true,
            serverSide: true,  
            ajax: base_url+"/o4k/utility/AdminUtilityList",
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
                    '<li><a href="'+base_url+'/o4k/utility/edit/'+full.id+'"><i class=" icon-pen"></i> Edit Utility</a></li>';
                    if(full.status=="0")
                    {
                        u+= '<li ><a class="change_status"  href="'+base_url+'/o4k/utility/activate/'+full.id+'"><i class=" icon-eye"></i> Activate Utility</a></li>';
                    }
                    else
                    {
                        u+='<li  ><a class="change_status" href="'+base_url+'/o4k/utility/deactivate/'+full.id+'"><i class="  icon-eye-blocked"></i> Deactivate Utility</a></li>';
                    } 
                    u+='<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/utility/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Utility</a></li>';
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
    $("#utility_create").submit(function(e)
    {
        
        e.preventDefault();
        var formdata    = new FormData($('#utility_create')[0])
        var country     = $("[name='countries']").val().trim();
        var email       = $("[name='email']").val().trim();
        var mobile      = $("[name='mnumber']").intlTelInput("getNumber");
         
         var a=b=c=d=e=0;
      
        //country
        if(country != "select")
        {
           a=1; 
           $( "#countrybox" ).removeClass( "has-error" );
           $("#countrybox .help-block").html(' '); 
            var flag =$("[name='countries'] option:selected").attr('data-flag');
            
           formdata.append('country',country);
           formdata.append('country_flag',flag);
        }
        else
        {
            a=0; 
            $( "#countrybox" ).addClass( "has-error" ); 
            $("#countrybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        
        
        // email
        if(email.length > 0)
        {  
            if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) { b=1;   $("#emailbox .help-block").html(' '); formdata.append('email',email);  } 
            else {   b=0; $("#emailbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid email id.</label>');  }
        }
        else{   b=0;$("#emailbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');  }
        
        
        
         //        mobile number
        if(mobile.length > 0)
        { 
            var valid = $("#mnumber").intlTelInput("isValidNumber");
            if(valid == true){  c=1;  $("#mobilebox .help-block").html(' '); formdata.append('mobile',mobile);  }
            else{  c=0; $("#mobilebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid number.</label>');}
            
        } else{ c=0;   $("#mobilebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');}
        
        /* checking all name in all lang filled or not */
        if($('.chkname').length)
        {
            $("#error-common").html(" ");
            var tlength=$("[name='name[]']").length;
            var len = [];
            $("[name='name[]']").each(function(index,element)
            {
                var val=$(this).val().trim();
                var val_attr=$(this).attr('data-lagname');
                if(val.length > 0)
                {
                    len.push(index);
                    //formdata.append('name[]',val); 
                    formdata.append('name_lang_id[]',$(this).attr('data-namelan')); 
                    formdata.append('name_lang_slug[]',$(this).attr('data-name_langcode')); 
                    
                    $( ".name"+val_attr ).removeClass( "has-error" ); 
                    $(".name"+val_attr +" .help-block").html(' ');
                }else
                {
                    
                    $( ".name"+val_attr ).addClass( "has-error" ); 
                    $(".name"+val_attr +" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                }
            });
            
            if((len.length) == (tlength))   {   e=1;   }
            else{e=0;   }
             
        }
        else{e=0;$("#error-common").html('<label   class="validation-error-label" for="default_select">Sorry somthing went wrong. please try agian.</label>');}
          
          
          
         /* checking all aboutus in all lang filled or not */
        if($('.chkabout').length)
        {
            $("#error-common").html(" ");
            var tlength=$("[name='about[]']").length;
            var len = [];
            $("[name='about[]']").each(function(index,element)
            {
                var val=$(this).val().trim();
                var val_attr=$(this).attr('data-lagabout');
                if(val.length > 0)
                {
                    len.push(index);
                   // formdata.append('about[]',val); 
                    formdata.append('about_lang_id[]',$(this).attr('data-aboutlan'));
                    formdata.append('about_lang_slug[]',$(this).attr('data-about_langcode')); 
                    $( ".about"+val_attr ).removeClass( "has-error" ); 
                    $(".about"+val_attr +" .help-block").html(' ');
                }else
                {
                    
                    $( ".about"+val_attr ).addClass( "has-error" ); 
                    $(".about"+val_attr +" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                }
            });
            
            if((len.length) == (tlength))   {   d=1;   }
            else{d=0;   }
             
        }
        else{d=0;$("#error-common").html('<label   class="validation-error-label" for="default_select">Sorry somthing went wrong. please try agian.</label>');}
          
          
         
          /* ------------------------------------------------------------------ */
       /* ----------------- form submitting -------------------------------- */
       /* ------------------------------------------------------------------ */

        if(a===1 && b===1 && c===1 && d===1 && e===1)
        {
               $.ajax({
                    type: "POST",
                    url:base_url+"/o4k/utility/store",
                    dataType: "json",
                    async: false, 
                    data: formdata,
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {     

                        console.log(response);
                        
                        if(response.status==true){window.location.href = response.url; }
                        else if(response.status==0){
                            var obj = response.errArr ;
                            if(obj.hasOwnProperty("email") )
                            {
                                $("#emailbox .help-block").html("<label class='validation-error-label' for='default_select'>"+response.errArr.email+"</label>");
   
                            } 
                            if(obj.hasOwnProperty("mobile") )
                            {
                                $("#mobilebox .help-block").html("<label class='validation-error-label' for='default_select'>"+response.errArr.mobile+"</label>");
   
                            } 
                            if(obj.hasOwnProperty("status") )
                            {
                                $("#statusBox .help-block").html("<label class='validation-error-label' for='default_select'>"+response.errArr.status+"</label>");
   
                            }
                            if(obj.hasOwnProperty("country") )
                            {
                                $("#countrybox .help-block").html("<label class='validation-error-label' for='default_select'>"+response.errArr.country+"</label>");
   
                            }
                            if(obj.hasOwnProperty("image") )
                            {
                                $("#imgbox .help-block").html("<label class='validation-error-label' for='default_select'>"+response.errArr.image+"</label>");
   
                            }
                            if(obj.hasOwnProperty("name_lang") )
                            {
                                $("#error-common").html("<label class='validation-error-label' for='default_select'>"+response.errArr.name_lang+"</label>");
   
                            }
                            if(obj.hasOwnProperty("about_lang") )
                            {
                                $("#error-common").html("<label class='validation-error-label' for='default_select'>"+response.errArr.about_lang+"</label>");
   
                            }

                        }else{location.reload();}
                         
                    },
                    error: function (request, textStatus, errorThrown) {
                        
//                            var obj = request.responseJSON.errors ;
//
//                            if(obj.hasOwnProperty("email") )
//                            {
//                               $( "#emailBox" ).addClass( "has-error" );
//                               $("#emailBox .help-block").html("<div class='mad'>"+request.responseJSON.errors.email[0]+"</div>");   
//                            }                       

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
    $("#utility_update").submit(function(e)
    {
		e.preventDefault();
        var formdata    = new FormData($('#utility_update')[0])
        var country     = $("[name='countries']").val().trim();
        var email       = $("[name='email']").val().trim();
        var mobile      = $("[name='mnumber']").intlTelInput("getNumber");
         
         var a=b=c=d=e=0;
      
        //country
        if(country != "select")
        {
           a=1; 
           $( "#countrybox" ).removeClass( "has-error" );
           $("#countrybox .help-block").html(' '); 
            var flag =$("[name='countries'] option:selected").attr('data-flag');
            
           formdata.append('country',country);
           formdata.append('country_flag',flag);
        }
        else
        {
            a=0; 
            $( "#countrybox" ).addClass( "has-error" ); 
            $("#countrybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        
        
        // email
        if(email.length > 0)
        {  
            if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) { b=1;   $("#emailbox .help-block").html(' '); formdata.append('email',email);  } 
            else {   b=0; $("#emailbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid email id.</label>');  }
        }
        else{   b=0;$("#emailbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');  }
        
        
        
         //        mobile number
        if(mobile.length > 0)
        { 
            var valid = $("#mnumber").intlTelInput("isValidNumber");
            if(valid == true){  c=1;  $("#mobilebox .help-block").html(' '); formdata.append('mobile',mobile);  }
            else{  c=0; $("#mobilebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid number.</label>');}
            
        } else{ c=0;   $("#mobilebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');}
        
        /* checking all name in all lang filled or not */
        if($('.chkname').length)
        {
            $("#error-common").html(" ");
            var tlength=$("[name='name[]']").length;
            var len = [];
            $("[name='name[]']").each(function(index,element)
            {
                var val=$(this).val().trim();
                var val_attr=$(this).attr('data-lagname');
                if(val.length > 0)
                {
                    len.push(index);
                    //formdata.append('name[]',val); 
                    formdata.append('name_lang_id[]',$(this).attr('data-namelan')); 
                    formdata.append('name_lang_slug[]',$(this).attr('data-name_langcode')); 
                    
                    $( ".name"+val_attr ).removeClass( "has-error" ); 
                    $(".name"+val_attr +" .help-block").html(' ');
                }else
                {
                    
                    $( ".name"+val_attr ).addClass( "has-error" ); 
                    $(".name"+val_attr +" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                }
            });
            
            if((len.length) == (tlength))   {   e=1;   }
            else{e=0;   }
             
        }
        else{e=0;$("#error-common").html('<label   class="validation-error-label" for="default_select">Sorry somthing went wrong. please try agian.</label>');}
          
          
          
         /* checking all aboutus in all lang filled or not */
        if($('.chkabout').length)
        {
            $("#error-common").html(" ");
            var tlength=$("[name='about[]']").length;
            var len = [];
            $("[name='about[]']").each(function(index,element)
            {
                var val=$(this).val().trim();
                var val_attr=$(this).attr('data-lagabout');
                if(val.length > 0)
                {
                    len.push(index);
                   // formdata.append('about[]',val); 
                    formdata.append('about_lang_id[]',$(this).attr('data-aboutlan'));
                    formdata.append('about_lang_slug[]',$(this).attr('data-about_langcode')); 
                    $( ".about"+val_attr ).removeClass( "has-error" ); 
                    $(".about"+val_attr +" .help-block").html(' ');
                }else
                {
                    
                    $( ".about"+val_attr ).addClass( "has-error" ); 
                    $(".about"+val_attr +" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                }
            });
            
            if((len.length) == (tlength))   {   d=1;   }
            else{d=0;   }
             
        }
        else{d=0;$("#error-common").html('<label   class="validation-error-label" for="default_select">Sorry somthing went wrong. please try agian.</label>');}
          
          
         
    /* ------------------------------------------------------------------ */
    /* ----------------- form submitting -------------------------------- */
    /* ------------------------------------------------------------------ */
    
       if(a===1 && b===1 && c===1 && d===1 && e===1)
        {
               $.ajax({
                    type: "POST",
                    url: base_url+"/o4k/utility/update/"+$("#utility_update").attr('data-id'), 
                    dataType: "json",
                    async: false, 
                    data: formdata,
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {     
                        if(response.status==true){window.location.href = response.url; }
                        else if(response.status==0){
                            var obj = response.errArr ;
                            if(obj.hasOwnProperty("status") )
                            {
                                $("#statusBox .help-block").html("<label class='validation-error-label' for='default_select'>"+response.errArr.status+"</label>");
   
                            }
                            if(obj.hasOwnProperty("country") )
                            {
                                $("#countrybox .help-block").html("<label class='validation-error-label' for='default_select'>"+response.errArr.country+"</label>");
   
                            }
                            if(obj.hasOwnProperty("image") )
                            {
                                $("#imgbox .help-block").html("<label class='validation-error-label' for='default_select'>"+response.errArr.image+"</label>");
   
                            }
                            if(obj.hasOwnProperty("name_lang") )
                            {
                                $("#error-common").html("<label class='validation-error-label' for='default_select'>"+response.errArr.name_lang+"</label>");
   
                            }
                            if(obj.hasOwnProperty("about_lang") )
                            {
                                $("#error-common").html("<label class='validation-error-label' for='default_select'>"+response.errArr.about_lang+"</label>");
   
                            }

                        }else{location.reload();}

                         
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                        
//                            var obj = request.responseJSON.errors ;
//
//                            if(obj.hasOwnProperty("email") )
//                            {
//                               $( "#emailBox" ).addClass( "has-error" );
//                               $("#emailBox .help-block").html("<div class='mad'>"+request.responseJSON.errors.email[0]+"</div>");   
//                            }                       

                    }
                });
        } 
		
	});
	
    
/* ************************************************************************* */ 
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
