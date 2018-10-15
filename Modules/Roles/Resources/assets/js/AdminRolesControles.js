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

    //fetch permissions based on selected country
        $("select#country_id").change(function(){
            $('.permrow').remove();
            $('.permupdatesectn').remove();
            $("#permission_section").show('slow');
            var countryId = $("#country_id option:selected").val();
            $.ajax({
                type: 'GET',
                url: base_url+"/o4k/roles/getpermissions/"+countryId, 
                dataType: 'json',
                success: function (data) {
                    for(var j=0;j<data.length;j++){
                        $("#permisonname").append('<span class="permrow"><label style="padding-top: 22px;" class="display-block text-semibold">'+data[j].module_name+'</label></span>'); 
                        for(var k=0;k<data[j].permissions.length;k++){
                            $("#permisonname").append('<span class="permrow" style="padding-left: 0px;"><label style="padding-top: 8px;padding-left: 30px;padding-right: 10px;" class="checkbox-inline"><input type="checkbox" class="checker border-success text-success-600  CheckboxStyle modperm" name="permissions[]" value="'+data[j].permissions[k].id+'">'+data[j].permissions[k].name+'</label></span>');
                             $.uniform.update('.CheckboxStyle');
                        }
                        $("#permisonname").append('<hr>');
                        
                    }
                     
                    
                },
               
            });
        });
    

    
/* ************************************************************************ */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  

	if($('#roles_list').length){
        $('#roles_list').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/o4k/roles/AdminRolesList",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'slug', name: 'slug' },
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
                    var  u ='';
                    if(full.id !=1 )
                    {
                    u = '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                    '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">'+
                    '<li><a href="'+base_url+'/o4k/roles/edit/'+full.id+'"><i class=" icon-pen"></i> Edit Role</a></li>'+
                    '<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/roles/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Role</a></li>'+
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

/*
    * create form 
    * params : Name,Status,Slug  
*/

    $("#role_create").submit(function(e)
    {
       e.preventDefault(); 
         
        var Status         =   $("[name='status']").val().trim();
        var Name           =   $("[name='role_name']").val().trim();
        var Slug           =   $("[name='role_slug']").val().trim();
        var country        =   $("[name='country_id']").val().trim();
        
        var a=0;
        var b=0;
        var c=0; 
        var d=0;  


        //Name
        if(Name.length > 0){
           a=1; 
           $( "#rolebox" ).removeClass( "has-error" );
           $("#rolebox .help-block").html(' ');
           
        }
        else{
            a=0; 
            $( "#rolebox" ).addClass( "has-error" ); 
            $("#rolebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        
        //Status
        if(Status=='0' || Status=='1'){
            b=1;  
            $( "#role_status" ).removeClass( "has-error" );
            $("#role_status .help-block").html(' ');
        }
        else{
            b=0; 
            $( "#role_status" ).addClass( "has-error" ); 
            $("#role_status .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid status.</label>');
            }
        
        //Slug
        if(Slug.length > 0)
        {
            var gnsg= generate_slug($("#role_name").val());
            if(gnsg != Slug) { 
                c=0;
                $( "#slugbox" ).addClass( "has-error" ); 
                 $("#slugbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">The generated slug is not matching.</label>');
            }
            else{
                c=1; $( "#slugbox" ).removeClass( "has-error" );
            }   
        }
        else{
            c=0; 
            $( "#slugbox" ).addClass( "has-error" );
             $("#slugbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This feild is required</label>');
        }

        //Country
        if(country.length > 0)
        {

            if($('.modperm').is(':checked')==false)
            {
                d=0; 
                $( "#permBox" ).addClass( "has-error" ); 
                $("#permBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select atleast one.</label>');

            }else{
                d=1;  
                $( "#permBox" ).removeClass( "has-error" );
                $("#permBox .help-block").html(' ');
            } 
            $( "#countryBox" ).removeClass( "has-error" );
            $("#countryBox .help-block").html(' ');
            
        }else{
            d=0; 
            $( "#countryBox" ).addClass( "has-error" ); 
            $("#countryBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

    /* ------------------------------------------------------------------ */
    /* ----------------- form submitting -------------------------------- */
    /* ------------------------------------------------------------------ */


        if(a==1 && b==1 && c==1 && d==1)
        {
            $( "#rolebox" ).removeClass( "has-error" );
            $("#rolebox .help-block").html(" "); 
            $( "#slugbox" ).removeClass( "has-error" );
            $("#slugbox .help-block").html(" ");
            $( "#permBox" ).removeClass( "has-error" );
            $("#permBox .help-block").html(' ');
            $( "#countryBox" ).removeClass( "has-error" );
            $("#countryBox .help-block").html(' ');

            $.ajax({
                    type: "POST",
                    url: base_url+"/o4k/roles/store", 
                    data: new FormData($('#role_create')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){

                       if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                        
                    },
                    error: function (request, textStatus, errorThrown) {

                            var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("role_name") )
                            {
                               $( "#rolebox" ).addClass( "has-error" );
                               $("#rolebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.role_name[0]+"</div>");   
                            }
                            if(obj.hasOwnProperty("role_slug") )
                            {
                                $( "#slugbox" ).addClass( "has-error" );
                                $("#slugbox .help-block").html("<div class='mad'>"+request.responseJSON.errors.role_slug[0]+"</div>");   
                            } 

                    }

                });

        }
        
         return false;

    });
      
  
  
/* ************************************************************************* */  
/* *************************** module create end *********************** */  
/* ************************************************************************* */  

	$("#role_name").keyup(function() {
	        $("#role_slug").val(generate_slug($("#role_name").val()));
	    });

/* ************************************************************************* */  
/* *************************** generate slug end *************************** */  
/* ************************************************************************* */  
/*
     * update form 
     * params : Name,Status,Slug  
     */
      
    $("#role_update").submit(function(e)
    {
       e.preventDefault(); 

        var Status         =   $("[name='status']").val().trim();
        var Name           =   $("[name='role_name']").val().trim();
        var Slug           =   $("[name='role_slug']").val().trim();
        var country        =   $("[name='country_id']").val().trim();
        
        var a=0;
        var b=0;
        var c=0; 
        var d=0;  


        //Name
        if(Name.length > 0){
           a=1; 
           $( "#rolebox" ).removeClass( "has-error" );
           $("#rolebox .help-block").html(' ');
           
        }
        else{
            a=0; 
            $( "#rolebox" ).addClass( "has-error" ); 
            $("#rolebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        
        //Status
        if(Status=='0' || Status=='1'){
            b=1;  
            $( "#role_status" ).removeClass( "has-error" );
            $("#role_status .help-block").html(' ');
        }
        else{
            b=0; 
            $( "#role_status" ).addClass( "has-error" ); 
            $("#role_status .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid status.</label>');
            }
        
        //Slug
        if(Slug.length > 0)
        {
            var gnsg= generate_slug($("#role_name").val());
            if(gnsg != Slug) { 
                c=0;
                $( "#slugbox" ).addClass( "has-error" ); 
                 $("#slugbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">The generated slug is not matching.</label>');
            }
            else{
                c=1; $( "#slugbox" ).removeClass( "has-error" );
            }   
        }
        else{
            c=0; 
            $( "#slugbox" ).addClass( "has-error" );
             $("#slugbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This feild is required</label>');
        }

        //Country
        if(country.length > 0)
        {

            if($('.modperm').is(':checked')==false)
            {
                d=0; 
                $( "#permBox" ).addClass( "has-error" ); 
                $("#permBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select atleast one.</label>');

            }else{
                d=1;  
                $( "#permBox" ).removeClass( "has-error" );
                $("#permBox .help-block").html(' ');
            } 
            $( "#countryBox" ).removeClass( "has-error" );
            $("#countryBox .help-block").html(' ');
            
        }else{
            d=0; 
            $( "#countryBox" ).addClass( "has-error" ); 
            $("#countryBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

    /* ------------------------------------------------------------------ */
    /* ----------------- form submitting -------------------------------- */
    /* ------------------------------------------------------------------ */

        if(a==1 && b==1 && c==1 && d==1)
        {
            $( "#rolebox" ).removeClass( "has-error" );
            $("#rolebox .help-block").html(" "); 
            $( "#slugbox" ).removeClass( "has-error" );
            $("#slugbox .help-block").html(" ");
            $( "#permBox" ).removeClass( "has-error" );
            $("#permBox .help-block").html(' ');
            $( "#countryBox" ).removeClass( "has-error" );
            $("#countryBox .help-block").html(' ');

            $.ajax({
                    type: "POST",
                    url: base_url+"/o4k/roles/update/"+$("#role_update").attr('data-id'), 
                    data: new FormData($('#role_update')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){

                       if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                       
                            var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("role_name") )
                            {
                               $( "#rolebox" ).addClass( "has-error" );
                               $("#rolebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.role_name[0]+"</div>");   
                            }
                            if(obj.hasOwnProperty("role_slug") )
                            {
                                $( "#slugbox" ).addClass( "has-error" );
                                $("#slugbox .help-block").html("<div class='mad'>"+request.responseJSON.errors.role_slug[0]+"</div>");   
                            }   

                    }

                });

        }

        return false;

    });
  
  
/* ************************************************************************* */  
/* *************************** permission edit end *********************** */  
/* ************************************************************************* */ 

});
