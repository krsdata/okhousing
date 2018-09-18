$(function() {
	
    if($('.touchspin-empty').length){$(".touchspin-empty").TouchSpin();}

    //initialize selectbox
    if($('.bootstrap-select').length){$('.bootstrap-select').selectpicker();}


    
/* ************************************************************************* */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  

    if($('#property_list').length){
        $('#property_list').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/o4k/FeaturedCategory/FeaturedCategorylist",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name'},
                {
                data: "null",
                sortable: false,
                render: function (data, type, full) { 

                var  u = '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">';
                u+='<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/FeaturedCategory/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Featured Category</a></li>';
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
    $("#FeaturedCategory_list_create").submit(function(e)
    {

        e.preventDefault(); 
       
        var FeaturedCategoryType=$("#FeaturedCategoryType").val().trim();
         var a=b=c=d=0;


        //Featured Category Type
        if(FeaturedCategoryType.length > 0){
           a=1;  
            $( "#FeaturedCategoryTypebox" ).removeClass( "has-error" );
            $("#FeaturedCategoryTypebox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#FeaturedCategoryTypebox" ).addClass( "has-error" ); 
            $("#FeaturedCategoryTypebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

       
        
//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 )
        {

                
                /* server checking */
                $('.content-wrapper').block({
                    message: '<i class="icon-spinner9 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
             $.ajax({
                    type: "POST",
                    url: base_url+"/o4k/FeaturedCategory/store", 
                    data: new FormData($('#FeaturedCategory_list_create')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                       if(response.status==true){window.location.href = response.url;  $("help-block").html(""); }else{
                       $('.content-wrapper').unblock();

                    }
                    },
                    error: function (request, textStatus, errorThrown) {

                        var obj = request.responseJSON.errors ;
                        if(obj.hasOwnProperty("title_en") )
                            {
                               $( "#titlebox_en" ).addClass( "has-error" );
                               $("#titlebox_en .help-block").html("<div class='mad'>"+request.responseJSON.errors.title_en[0]+"</div>");   
                            }
                            if(obj.hasOwnProperty("slug_en") )
                            {
                                $( "#slugbox_en" ).addClass( "has-error" );
                                $("#slugbox_en .help-block").html("<div class='mad'>"+request.responseJSON.errors.slug_en[0]+"</div>");   
                            } 
                                 

                    }
                   
                });


        }
        return false;

    });


    /*
     * edit form 
     * params : Name,Status,Slug  
     */
 $("#FeaturedCategory_list_update").submit(function(e)
    {

       e.preventDefault(); 
       
        var status=$("#status").val().trim();
        var FeaturedCategoryType=$("#FeaturedCategoryType").val().trim();
        var a=b=c=d=0;


        //status
        if(status.length > 0){
           a=1;  
            $( "#statusbox" ).removeClass( "has-error" );
            $("#statusbox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#statusbox" ).addClass( "has-error" ); 
            $("#statusbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //status
        if(FeaturedCategoryType.length > 0){
           d=1;  
            $( "#FeaturedCategoryTypebox" ).removeClass( "has-error" );
            $("#FeaturedCategoryTypebox .help-block").html(' ');
        }
        else{
            d=0; 
            $( "#FeaturedCategoryTypebox" ).addClass( "has-error" ); 
            $("#FeaturedCategoryTypebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Slug
        var VName = [];
       
        $( ".perm_text" ).each(function( index ) {
          var valueName=$( this ).val().trim();
          var Oid=$(this).attr('id');
          var id=Oid.split('_');  
              
                //name validation
                if(valueName.length > 0)
                {
                        $( "#titlebox_"+id[1] ).removeClass( "has-error" );
                        $("#titlebox_"+id[1]+" .help-block").html(' '); 
                }else
                {
                    VName.push(id[1]);
                    $( "#titlebox_"+id[1] ).addClass( "has-error" ); 
                    $("#titlebox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');   
                    
                }
                 
               
        });
        
        if(VName.length === 0){b=1;}
        
//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && d==1)
        {

                
                /* server checking */
                $('.content-wrapper').block({
                    message: '<i class="icon-spinner9 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });

            $.ajax({
                    type: "POST",
                    url: base_url+"/o4k/FeaturedCategory/update/"+$("#Featured Category_list_update").attr('data-id'), 
                    data: new FormData($('#FeaturedCategory_list_update')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                     success: function(response){
                       if(response.status==true){window.location.href = response.url;  $("help-block").html(""); }else{
                       $('.content-wrapper').unblock();
                            }
                    },
                    error: function (request, textStatus, errorThrown) {

                        $('.content-wrapper').unblock();
                         var obj = request.responseJSON.errors ;
                        if(obj.hasOwnProperty("title_en") )
                            {
                               $( "#titlebox_en" ).addClass( "has-error" );
                               $("#titlebox_en .help-block").html("<div class='mad'>"+request.responseJSON.errors.title_en[0]+"</div>");   
                            }
                            if(obj.hasOwnProperty("slug_en") )
                            {
                                $( "#slugbox_en" ).addClass( "has-error" );
                                $("#slugbox_en .help-block").html("<div class='mad'>"+request.responseJSON.errors.slug_en[0]+"</div>");   
                            } 
                               
                    }
                });


        }
        return false;

    });


if($('#session_list').length){
        $('#session_list').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/o4k/FeaturedCategory/list",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title'},
                {
                data: "master_Category_id", sortable: true, 'sWidth': '10%',
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
                '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">';
               if(full.status=="0"){
                            u+= '<li ><a class="change_status"  href="'+base_url+'/o4k/FeaturedCategory/activate/'+full.id+'"><i class=" icon-eye"></i> Activate </a></li>';
                        }
                  else{
                            u+='<li  ><a class="change_status" href="'+base_url+'/o4k/FeaturedCategory/deactivate/'+full.id+'"><i class="  icon-eye-blocked"></i> Deactivate </a></li>';
                        } 
                '</ul></li></ul>';                     
                return u;
                }

                }
                
            ]
       
        });
    }


});
