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

    
/* ************************************************************************* */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  

    if($('#property_list').length){
        $('#property_list').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/o4k/sliderutility/utilitylist",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name'},
                { data: 'page_type', name: 'page_type'},
                {
                data: "null",
                sortable: false,
                render: function (data, type, full) { 

                var  u = '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">'+
                '<li><a href="'+base_url+'/o4k/sliderutility/edit/'+full.id+'"><i class=" icon-pen"></i> Edit Slider Utility </a></li>';
                  u+='<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/sliderutility/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Slider Utility</a></li>';
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
    $("#slider_Utility_list_create").submit(function(e)
    {

        e.preventDefault(); 

        var utility_id=$("#Utility_id").val().trim();
        var page_id=$("#showpage_id").val();
        var a=b=0;
         //proerty name
        if(utility_id.length > 0){
           a=1;  
            $( "#Utilitybox" ).removeClass( "has-error" );
            $("#Utilitybox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#Utilitybox" ).addClass( "has-error" ); 
            $("#Utilitybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        // page
        if(page_id !== null){
           b=1;  
            $( "#pagebox" ).removeClass( "has-error" );
            $("#pagebox .help-block").html(' ');
        }
        else{
            b=0; 
            $( "#pagebox" ).addClass( "has-error" ); 
            $("#pagebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }


//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1)
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
                    url: base_url+"/o4k/sliderutility/store", 
                    data: new FormData($('#slider_Utility_list_create')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                       if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);$('.content-wrapper').unblock();}
                    },
                    error: function (request, textStatus, errorThrown) {

                         var obj = request.responseJSON.errors ;
                        $('.content-wrapper').unblock();
                        if(obj.hasOwnProperty("slider_element_id") )
                        {
                           $( "#Utilitybox" ).addClass( "has-error" );
                           $("#Utilitybox .help-block").html("<div class='mad'>"+request.responseJSON.errors.slider_element_id[0]+"</div>");   
                        }      

                    }
                   
                });


        }
        return false;

    });


    /*
     * edit form 
    
     */

    $("#slider_Utility_list_update").submit(function(e)
    {
        e.preventDefault(); 
         
         var utility_id=$("#Utility_id").val().trim();
        var page_id=$("#showpage_id").val();
        var a=b=0;

        //proerty name
        if(utility_id.length > 0){
           a=1;  
            $( "#Utilitybox" ).removeClass( "has-error" );
            $("#Utilitybox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#Utilitybox" ).addClass( "has-error" ); 
            $("#Utilitybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        // page
        if(page_id !== null){
           b=1;  
            $( "#pagebox" ).removeClass( "has-error" );
            $("#pagebox .help-block").html(' ');
        }
        else{
            b=0; 
            $( "#pagebox" ).addClass( "has-error" ); 
            $("#pagebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }


//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1)
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
                    url: base_url+"/o4k/sliderutility/update/"+$("#slider_Utility_list_update").attr('data-id'), 
                    data: new FormData($('#slider_Utility_list_update')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                       if(response.status==true){window.location.href = response.url;  }else{$('.content-wrapper').unblock();location.reload();$(".showalert").show(response.alert);}
                       
                    },
                    error: function (request, textStatus, errorThrown) {
                             var obj = request.responseJSON.errors ;
                        $('.content-wrapper').unblock();
                        if(obj.hasOwnProperty("slider_element_id") )
                        {
                           $( "#Utilitybox" ).addClass( "has-error" );
                           $("#Utilitybox .help-block").html("<div class='mad'>"+request.responseJSON.errors.slider_element_id[0]+"</div>");   
                        }         

                    }
                    
                });


        }
        return false;

    });

});

