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
        ajax: base_url+"/o4k/menu/menulist",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title'},
                { data: 'link', name: 'link'},
                {
                data: "null",
                sortable: false,
                render: function (data, type, full) { 

                var  u = '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">'+
                '<li><a href="'+base_url+'/o4k/menu/edit/'+full.id+'"><i class=" icon-pen"></i> Edit menu </a></li>';
                  u+='<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/menu/destroy/'+full.id+'"><i class="icon-trash"></i> Delete menu</a></li>';
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
    $("#menu_list_create").submit(function(e)
    {

        e.preventDefault(); 
       
        var link=$("#link").val().trim();
        var status=$("#status").val().trim();
        var a=b=c=0;

        

        //link
        if(link.length > 0){
           a=1;  
            $( "#linkbox" ).removeClass( "has-error" );
            $("#linkbox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#linkbox" ).addClass( "has-error" ); 
            $("#linkbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //status
        if(status.length > 0){
           b=1;  
            $( "#statusbox" ).removeClass( "has-error" );
            $("#statusbox .help-block").html(' ');
        }
        else{
            b=0; 
            $( "#statusbox" ).addClass( "has-error" ); 
            $("#statusbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

       

        //Slug
        var VName = [];
        var VSlug = [];

        $( ".perm_text" ).each(function( index ) {
          var valueName=$( this ).val().trim();
          var Oid=$(this).attr('id');
          var id=Oid.split('_');  
          var valueSlug=$("#slug_"+id[1]).val().trim(); 
                
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
                 
                //slug validation
                if(valueSlug.length > 0)
                {
                    var gnsg= generate_slug($("#title_"+id[1]).val());
                    if(gnsg != valueSlug)
                    { 
                        VSlug.push(id[1]);
                        $( "#slugbox_"+id[1] ).addClass( "has-error" ); 
                        $("#slugbox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">The generated slug is not matching.</label>');
                    }
                    else{
                        $( "#slugbox_"+id[1] ).removeClass( "has-error" );
                        $("#slugbox_"+id[1]+" .help-block").html(' ');
                    }
                     
                }
                else
                {
                        VSlug.push(id[1]);
                        $( "#slugbox_"+id[1] ).addClass( "has-error" ); 
                        $("#slugbox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                }
                 
        });
        
        if(VName.length === 0){c=1;}
        if(VSlug.length === 0){d=1;}
         

//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1 &&  d==1)
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
                    url: base_url+"/o4k/menu/store", 
                    data: new FormData($('#menu_list_create')[0]),
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
 $("#menu_list_update").submit(function(e)
    {

       e.preventDefault(); 
       
        var link=$("#link").val().trim();
        var status=$("#status").val().trim();
        var a=b=c=0;

        

        //link
        if(link.length > 0){
           a=1;  
            $( "#linkbox" ).removeClass( "has-error" );
            $("#linkbox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#linkbox" ).addClass( "has-error" ); 
            $("#linkbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //status
        if(status.length > 0){
           b=1;  
            $( "#statusbox" ).removeClass( "has-error" );
            $("#statusbox .help-block").html(' ');
        }
        else{
            b=0; 
            $( "#statusbox" ).addClass( "has-error" ); 
            $("#statusbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

       

        //Slug
        var VName = [];
        var VSlug = [];

        $( ".perm_text" ).each(function( index ) {
          var valueName=$( this ).val().trim();
          var Oid=$(this).attr('id');
          var id=Oid.split('_');  
          var valueSlug=$("#slug_"+id[1]).val().trim(); 
                
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
                 
                //slug validation
                if(valueSlug.length > 0)
                {
                    var gnsg= generate_slug($("#title_"+id[1]).val());
                    if(gnsg != valueSlug)
                    { 
                        VSlug.push(id[1]);
                        $( "#slugbox_"+id[1] ).addClass( "has-error" ); 
                        $("#slugbox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">The generated slug is not matching.</label>');
                    }
                    else{
                        $( "#slugbox_"+id[1] ).removeClass( "has-error" );
                        $("#slugbox_"+id[1]+" .help-block").html(' ');
                    }
                     
                }
                else
                {
                        VSlug.push(id[1]);
                        $( "#slugbox_"+id[1] ).addClass( "has-error" ); 
                        $("#slugbox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                }
                 
        });
        
        if(VName.length === 0){c=1;}
        if(VSlug.length === 0){d=1;}
         

//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1 &&  d==1)
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
                    url: base_url+"/o4k/menu/update/"+$("#menu_list_update").attr('data-id'), 
                    data: new FormData($('#menu_list_update')[0]),
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


 if($('#Advertise_list').length){
        $('#Advertise_list').DataTable({
        processing: true,
        serverSide: true, 
        ordering: false ,
        ajax: base_url+"/o4k/AdevertiseList",
            columns: [ 
                 { data: 'name', name: 'name'},
                { data: 'email', name: 'email'},
                { data: 'phone', name: 'phone'},
                { data: 'message', name: 'message'}
                
            ]
       
        });
    }

});


$(".perm_text").keyup(function() {
        var Oid=$(this).attr('id');
        var id=Oid.split('_');  
        $("#slug_"+id[1]).val(generate_slug($("#title_"+id[1]).val()));
    });
