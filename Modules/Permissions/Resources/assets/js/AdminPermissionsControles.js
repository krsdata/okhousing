$(function() {

	
	//initialize selectbox
    if($('.bootstrap-select').length){$('.bootstrap-select').selectpicker();}


/* ************************************************************************* */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  

	if($('#permissions_list').length){
        $('#permissions_list').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/o4k/permissions/AdminPermissionsList/",
	        columns: [ 
	            { data: 'id', name: 'id' },
	            { data: 'name', name: 'name' },
	            { data: 'modules.module_name', name: 'modules.module_name','orderable': false, },
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
	            '<li><a href="'+base_url+'/o4k/permissions/edit/'+full.id+'"><i class=" icon-pen"></i> Edit Permission</a></li>'+
	//            '<li><a class="change_status" href="'+base_url+'/o4k/permissions/deactivate/'+full.id+'"><i class="  icon-eye-blocked"></i> Deactivate Permission</a></li>'+
	            '<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/permissions/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Permission</a></li>'+
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
      
   $("#permission_create").submit(function(e)
   {
        
       e.preventDefault(); 
         
        var Status       =   $("[name='status']").val().trim();
        var Name         =   $("[name='permission_name']").val().trim();
        var Slug         =   $("[name='permission_slug']").val().trim();
        var module       =   $("[name='module_id']").val().trim(); 
         
		
        var a=0;
        var b=0;
        var c=0; 
        var d=0; 
		      
    //Name
    if(Name.length > 0)
    {
        a=1; 
        $( "#permissionbox" ).removeClass( "has-error" );
        $("#permissionbox .help-block").html(' '); 
    }
    else
    {
        a=0; 
        $( "#permissionbox" ).addClass( "has-error" ); 
        $("#permissionbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
    }
        
    //Status
    if(Status=='0' || Status=='1')
    {
        b=1;  
        $( "#permission_status" ).removeClass( "has-error" );
        $("#permission_status .help-block").html(' ');
    }
    else{
        b=0; 
        $$( "#permission_status" ).addClass( "has-error" ); 
        $("#permission_status .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid status.</label>');
    }
        
    //Slug
    if(Slug.length > 0)
    {
        
        var gnsg= generate_slug($("#permission_name").val());
        if(gnsg != Slug) 
        { 
            
            c=0;
            $( "#slugbox" ).addClass( "has-error" ); 
            $("#slugbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">The generated slug is not matching.</label>');
        }
        else
        {
                
            c=1; 
            $( "#slugbox" ).removeClass( "has-error" );
            $("#slugbox .help-block").html(' ');
        }   
    }
    else
    {
            
        c=0; 
        $( "#slugbox" ).addClass( "has-error" );
        $("#slugbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This feild is required</label>');
    }
     
//	module	
    if(module.length > 0 && module != "select")
    {
        d=1;  
        $( "#permissionmodulebox" ).removeClass( "has-error" );
        $("#permissionmodulebox .help-block").html(' ');
    }else
    {
        d=0; 
        $( "#permissionmodulebox" ).addClass( "has-error" );
        $("#permissionmodulebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This feild is required</label>');
    }
    
   
//        
//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
//        
        if(a==1 && b==1 && c==1 && d==1 )
        {
             
            $( "#permissionbox" ).removeClass( "has-error" );
            $("#permissionbox .help-block").html(" "); 
            $( "#slugbox" ).removeClass( "has-error" );
            $("#slugbox .help-block").html(" ");
            $( "#permissionmodulebox" ).removeClass( "has-error" );
            $("#permissionmodulebox .help-block").html(' ');
			$( "#descriptionbox" ).removeClass( "has-error" );
            $("#descriptionbox .help-block").html(' ');
            
               $.ajax({
                    type: "POST",
                    url:base_url+"/o4k/permissions/store",
                    dataType: "json",
                    async: false, 
                    data: new FormData($('#permission_create')[0]),
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {       
                        if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                        
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                       
                            var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("permission_name") )
                            {
                               $( "#permissionbox" ).addClass( "has-error" );
                               $("#permissionbox .help-block").html("<div class='mad'>"+request.responseJSON.errors.permission_name[0]+"</div>");   
                            }
                            if(obj.hasOwnProperty("permission_slug") )
                            {
                                $( "#slugbox" ).addClass( "has-error" );
                                $("#slugbox .help-block").html("<div class='mad'>"+request.responseJSON.errors.permission_slug[0]+"</div>");   
                            } 
                            
                        

                    }
                });
        }
        
        return false;
        
    });
  
/* ************************************************************************* */  
/* *************************** module create end *********************** */  
/* ************************************************************************* */  

	$("#permission_name").keyup(function() {
	        $("#permission_slug").val(generate_slug($("#permission_name").val()));
	});
	    
/* ************************************************************************* */  
/* *************************** generate slug end *************************** */  
/* ************************************************************************* */  
/*
    * update form 
    * params : Name,Status,Slug  
*/
      
   $("#update_permission").submit(function(e)
   {
       e.preventDefault(); 
         
        var Status       =   $("[name='status']").val().trim();
        var Name         =   $("[name='permission_name']").val().trim();
        var Slug         =   $("[name='permission_slug']").val().trim();
        var module       =   $("[name='module_id']").val().trim(); 
		var description	 =	 $("[name='descriptions']").val();
		
        var a=0;
        var b=0;
        var c=0; 
        var d=0;
		var e=0;

        
        
//      //Name
        if(Name.length > 0){
		   a=1; 
		   $( "#permissionbox" ).removeClass( "has-error" );
           $("#permissionbox .help-block").html(' ');
		   
		}
        else{
			a=0; 
			$( "#permissionbox" ).addClass( "has-error" ); 
            $("#permissionbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
		}
        
        //Status
        if(Status=='0' || Status=='1'){
			b=1;  
			$( "#permission_status" ).removeClass( "has-error" );
            $("#permission_status .help-block").html(' ');
		}
        else{
			b=0; 
			$$( "#permission_status" ).addClass( "has-error" ); 
            $("#permission_status .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid status.</label>');
			}
        
        //Slug
        if(Slug.length > 0)
        {
			var gnsg= generate_slug($("#permission_name").val());
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
		//module
		if(module.length > 0){
			d=1;  
			$( "#permissionmodulebox" ).removeClass( "has-error" );
            $("#permissionmodulebox .help-block").html(' ');
		}else{
			d=0; 
			$( "#permissionmodulebox" ).addClass( "has-error" );
			 $("#permissionmodulebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This feild is required</label>');
		}
		//description
		if(description.length > 0){
		
			e=1;
			$( "#descriptionbox" ).removeClass( "has-error" );
            $("#descriptionbox .help-block").html(' ');
		}else{
			e=0; 
			$( "#descriptionbox" ).addClass( "has-error" );
			$("#descriptionbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This feild is required</label>');
        }

        

//        
//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
//        

        if(a==1 && b==1 && c==1 && d==1 && e==1)
        {
             
            $( "#permissionbox" ).removeClass( "has-error" );
            $("#permissionbox .help-block").html(" "); 
            $( "#slugbox" ).removeClass( "has-error" );
            $("#slugbox .help-block").html(" ");
            $( "#permissionmodulebox" ).removeClass( "has-error" );
            $("#permissionmodulebox .help-block").html(' ');
			$( "#descriptionbox" ).removeClass( "has-error" );
            $("#descriptionbox .help-block").html(' ');
            
               $.ajax({
                    type: "POST",
                    url:base_url+"/o4k/permissions/update/"+$("#update_permission").attr('data-id'),
                    dataType: "json",
                    async: false, 
                    data: new FormData($('#update_permission')[0]),
                    processData: false,
                    contentType: false, 
                    success: function(response)
					
                    {       
                        if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                        
                    },
                   error: function (request, textStatus, errorThrown) {

                        var obj = request.responseJSON.errors ;

                        if(obj.hasOwnProperty("permission_name") )
                        {
                           $("#permissionbox" ).addClass( "has-error" );
                           $("#permissionbox .help-block").html("<div class='mad'>"+request.responseJSON.errors.permission_name[0]+"</div>");   
						   
                        }

                        if(obj.hasOwnProperty("slug") )
                        {
                            $("#slugbox" ).addClass( "has-error" );
                            $("#slugbox .help-block").html("<div class='mad'>"+request.responseJSON.errors.slug[0]+"</div>");   
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
