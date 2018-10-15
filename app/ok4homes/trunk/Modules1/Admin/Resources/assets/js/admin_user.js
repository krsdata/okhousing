$(function() {
    

    /* ************************************************************************* */  
    /* *************************** Initialize form components ********************** */  
    /* ************************************************************************* */ 

    
        if($('#admin_users_list').length){
      
            $('#admin_users_list').DataTable({
                processing: true,
                serverSide: true,  
                ajax: base_url+"/o4k/allList",
                    columns: [ 
                        { data: 'id', name: 'id' },
                        {
                            data: "name", sortable: true 
                        },
                        {
                            data: "email", sortable: true,
                            
                        },
                        {
                            data: "created_at", sortable: true,
                            render: function (data, type, full) {  return  moment(full.created_date).format('DD/MM/YYYY'); } 
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
                        var  u;
                        if(full.id=="1"){u='';}
                        else{
                          var u= '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                            '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">'+
                           '<li><a href="'+base_url+'/o4k/edit/'+full.id+'"><i class=" icon-pen"></i> Edit Admin User</a></li>';
						   if(full.status=="1")
                          u+= '<li><a class="change_status" href="'+base_url+'/o4k/deactivate/'+full.id+'"><i class="  icon-eye-blocked"></i> Deactivate Admin User</a></li>';
						else
							u+= '<li><a class="change_status" href="'+base_url+'/o4k/activate/'+full.id+'"><i class="  icon-eye-blocked"></i> Activate Admin User</a></li>';
							u+= '<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Admin User</a></li>';
                            '</ul></li></ul>';    
                        }
                        return u;
                        }

                        }
                    ]
           
            });
        }


    /* ************************************************************************* */  
    /* *************************** data table listing end ********************** */  
    /* ************************************************************************* */  

    //initialize selectbox
    if($('.bootstrap-select').length){$('.bootstrap-select').selectpicker();}
	   
    //initialize checkbox   
    if($('.CheckboxStyle').length){  $(".CheckboxStyle").uniform({radioClass: 'choice',wrapperClass: "border-success text-success-600"});}
    if($("#image").length){$("#image").uniform({fileButtonClass: 'action btn bg-blue',fileBtnText: "Choose image"});}

    /* ************************************************************************* */  
    /* ************************************************************************* */
    /* ************************************************************************* */
    /*
     * create form 
     */
      
    $("#admin_create").submit(function(e)
    {
        e.preventDefault(); 
        
        var name       =   $("[name='admin_name']").val().trim();
        var email      =   $("[name='email']").val().trim();
        var password   =   $("[name='password']").val().trim();
        var status     =   $("[name='status']").val().trim();
        var country    =   $('input[name="countries[]"]:checked').length;

        var a=0;
        var b=0;
        var c=0;
        var d=0;
        var e=0;
        
        
        //Name
        if(name.length > 0)
        {
            a=1; 
            $( "#nameBox" ).removeClass( "has-error" );
            $("#nameBox .help-block").html(' ');
        }
        else
        {
            a=0; 
            $( "#nameBox" ).addClass( "has-error" ); 
            $("#nameBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        
        
        
        
        //email
        if(email.length > 0)
        {
             if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) {
                b=1;  
                $("#emailBox").removeClass("has-error");
                $("#emailBox .help-block").html(' ');
            }
            else{
                b=0; 
                $("#emailBox").addClass("has-error");
                $("#emailBox .help-block").css('color','F44336');
                 $("#emailBox .help-block").attr('style',  'color:#F44336 !important');
                $("#emailBox .help-block").html('Please enter a valid enail id ');
            }
        }
        else
        {
            b=0; 
            $( "#emailBox" ).addClass( "has-error" ); 
            $("#emailBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        
        
        //password
        if(password.length > 0)
        {
            if( /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/.test(password) ) 
            {
                c=1; 
                $( "#passwordBox" ).removeClass( "has-error" );
                $("#passwordBox .help-block").html(' ');
            }else
            {
                c=0; 
                $( "#passwordBox" ).addClass( "has-error" ); 
                $("#passwordBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Minimum 4 characters, at least one letter and one number.</label>');
            }   
            
        }
        else
        {
            c=0; 
            $( "#passwordBox" ).addClass( "has-error" ); 
            $("#passwordBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        
        
        //Status
        if(status=='0' || status=='1')
        {
            d=1;  
            $( "#statusBox" ).removeClass( "has-error" );
            $("#statusBox .help-block").html(' ');
        }
        else
        {
            
            d=0; 
            $( "#statusBox" ).addClass( "has-error" ); 
            $("#statusBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid status selected.</label>');
        }

        //country, role validation
        if(country > 0){
            
            $( ".countryrole" ).each(function() {
                var dataId = $(this).attr('data-id');
                if($('#country_'+dataId).is(':checked')==true){
                    var role=$("#role_"+dataId).val().trim();
                    if(role.length > 0){
                        e=1; 
                        $( "#rolebox_"+dataId).removeClass( "has-error" );
                        $("#rolebox_"+dataId+".help-block").html(' ');
                        $("#countryBox .help-block").html(' ');
                    }else{
                        e=0; 
                        $( "#rolebox_"+dataId).addClass( "has-error" ); 
                        $("#rolebox_"+dataId+".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select role.</label>');
                    }

                }else{
                    e=1; 
                    $( "#rolebox" ).removeClass( "has-error" );
                    $("#rolebox .help-block").html(' ');
                }

            });
           
        }else{
            e=0; 
            $( "#countryBox" ).addClass( "has-error" ); 
            $("#countryBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select country and role.</label>');
        }


        /* ------------------------------------------------------------------ */
        /* ----------------- form submitting -------------------------------- */
        /* ------------------------------------------------------------------ */
 //alert(a+"/"+b+"/"+c+"/"+d+"/"+e);
        if(a==1 && b==1 && c==1 && d==1 && e==1)
        {
            $( "#nameBox" ).removeClass( "has-error" );
            $("#nameBox .help-block").html(" "); 
            $( "#emailBox" ).removeClass( "has-error" );
            $("#emailBox .help-block").html(" ");
          
            $.ajax({
                    type: "POST",
                    url:base_url+"/o4k/store",
                    dataType: "json",
                    async: false, 
                    data: new FormData($('#admin_create')[0]),
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {     
                        if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
   
                        
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                            var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("email") )
                            {
                               $( "#emailBox" ).addClass( "has-error" );
                               $("#emailBox .help-block").html("<div class='mad'>"+request.responseJSON.errors.email[0]+"</div>");   
                            }                       

                    }
                });

        }

        
        return false; 
       
    });



/* ************************************************************************* */  
/* ************************************************************************* */
/* ************************************************************************* */
/*
edit  form 
     */
      
    $("#admin_edit").submit(function(e)
    {
        e.preventDefault(); 
        
        var name       =   $("[name='admin_name']").val().trim();
        var email      =   $("[name='email']").val().trim();
        var status     =   $("[name='status']").val().trim();
        var country    =   $('input[name="countries[]"]:checked').length;
		
        var a=0;
        var b=0;
       // var c=0;
        var d=0;
        var e=0;
        
        
        //Name
        if(name.length > 0)
        {
            a=1; 
            $( "#nameBox" ).removeClass( "has-error" );
            $("#nameBox .help-block").html(' ');
        }
        else
        {
            a=0; 
            $( "#nameBox" ).addClass( "has-error" ); 
            $("#nameBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        
        
        
        
        //email
        if(email.length > 0)
        {
             if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) {
                b=1;  
                $("#emailBox").removeClass("has-error");
                $("#emailBox .help-block").html(' ');
            }
            else{
                b=0; 
                $("#emailBox").addClass("has-error");
                $("#emailBox .help-block").css('color','F44336');
                 $("#emailBox .help-block").attr('style',  'color:#F44336 !important');
                $("#emailBox .help-block").html('Please enter a valid enail id ');
            }
        }
        else
        {
            b=0; 
            $( "#emailBox" ).addClass( "has-error" ); 
            $("#emailBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        
        
        //password
       /* if(password.length > 0)
        {
            if( /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/.test(password) ) 
            {
                c=1; 
                $( "#passwordBox" ).removeClass( "has-error" );
                $("#passwordBox .help-block").html(' ');
            }else
            {
                c=0; 
                $( "#passwordBox" ).addClass( "has-error" ); 
                $("#passwordBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Minimum 4 characters, at least one letter and one number.</label>');
            }   
            
        }
        else
        {
            c=0; 
            $( "#passwordBox" ).addClass( "has-error" ); 
            $("#passwordBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        */
        
        //Status
        if(status=='0' || status=='1')
        {
            d=1;  
            $( "#statusBox" ).removeClass( "has-error" );
            $("#statusBox .help-block").html(' ');
        }
        else
        {
            //alert("s");
            d=0; 
            $( "#statusBox" ).addClass( "has-error" ); 
            $("#statusBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid status selected.</label>');
        }

        //country, role validation
        if(country > 0){
            
            $( ".countryrole" ).each(function() {
                var dataId = $(this).attr('data-id');
                if($('#country_'+dataId).is(':checked')==true){
                    var role=$("#role_"+dataId).val().trim();
                    if(role.length > 0){
                        e=1; 
                        $( "#rolebox_"+dataId).removeClass( "has-error" );
                        $("#rolebox_"+dataId+".help-block").html(' ');
                        $("#countryBox .help-block").html(' ');
                    }else{
                        e=0; 
                        $( "#rolebox_"+dataId).addClass( "has-error" ); 
                        $("#rolebox_"+dataId+".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select role.</label>');
                    }

                }else{
                    e=1; 
                    $( "#rolebox" ).removeClass( "has-error" );
                    $("#rolebox .help-block").html(' ');
                }

            });
           
        }else{
            e=0; 
            $( "#countryBox" ).addClass( "has-error" ); 
            $("#countryBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select country and role.</label>');
        }


        /* ------------------------------------------------------------------ */
        /* ----------------- form submitting -------------------------------- */
        /* ------------------------------------------------------------------ */
 //alert(a+"/"+b+"/"+c+"/"+d+"/"+e);
        if(a==1 && b==1  && d==1 && e==1)
        {
            $( "#nameBox" ).removeClass( "has-error" );
            $("#nameBox .help-block").html(" "); 
            $( "#emailBox" ).removeClass( "has-error" );
            $("#emailBox .help-block").html(" ");
          
            $.ajax({
                    type: "POST",
                    url:base_url+"/o4k/update/"+$("#admin_edit").attr('data-id'),
                    dataType: "json",
                    async: false, 
                    data: new FormData($('#admin_edit')[0]),
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {     
                        if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
   
                        
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                            var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("email") )
                            {
							 $( "#emailBox" ).addClass( "has-error" );
                             $("#emailBox .help-block").html("<div class='mad'>"+request.responseJSON.errors.email[0]+"</div>");   
                            }                       

                    }
                });

        }

        
        return false; 
       
    });



/* ************************************************************************* */  
/* ************************************************************************* */
/* ************************************************************************* */

    });




    /* ************************************************************************* */  
    /* ************************************************************************* */
    /* ************************************************************************* */
    /*
     * create form 
    */
      
    $("#backround_img_form").submit(function(e)
    {
        e.preventDefault(); 
        
        $.ajax({
                    type: "POST",
                    url:base_url+"/o4k/storebackgroundimg",
                    dataType: "json",
                    async: false, 
                    data: new FormData($('#backround_img_form')[0]),
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {     
                        if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                            var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("image") )
                            {
                               $( "#imagebox" ).addClass( "has-error" );
                               $("#imagebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.image[0]+"</div>");   
                            }                       

                    }
                });

        
    });
