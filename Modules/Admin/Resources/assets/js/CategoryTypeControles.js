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
        ajax: base_url+"/o4k/CategoryType/CategoryTypeList",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title'},
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
                '<li><a href="'+base_url+'/o4k/CategoryType/edit/'+full.id+'"><i class=" icon-pen"></i> Edit CategoryType </a></li>';
                  u+='</ul>';  

                                    
                return u;
                }

                }
                
            ]
       
        });
    }



    /*
     * edit form 
     * params : Name,Status,Slug  
     */
 $("#CategoryType_list_update").submit(function(e)
    {

       e.preventDefault(); 
       
        var status=$("#status").val().trim();
        var a=b=c=0;

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

       

        //Slug
        var VName = [];
        var VSlug = [];

        $( ".perm_text" ).each(function( index ) {
          var valueName=$( this ).val().trim();
          var Oid=$(this).attr('id');
          var id=Oid.split('_');  
             //name validation
                if(valueName.length > 0)
                {
                        $( "#namebox_"+id[1] ).removeClass( "has-error" );
                        $("#namebox_"+id[1]+" .help-block").html(' '); 
                }else
                {
                    VName.push(id[1]);
                    $( "#namebox_"+id[1] ).addClass( "has-error" ); 
                    $("#namebox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');   
                    
                }
                 
                 
        });
        
        if(VName.length === 0){b=1;}
        

//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 )
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
                    url: base_url+"/o4k/CategoryType/update/"+$("#CategoryType_list_update").attr('data-id'), 
                    data: new FormData($('#CategoryType_list_update')[0]),
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

});


$(".perm_text").keyup(function() {
        var Oid=$(this).attr('id');
        var id=Oid.split('_');  
        $("#slug_"+id[1]).val(generate_slug($("#title_"+id[1]).val()));
    });
