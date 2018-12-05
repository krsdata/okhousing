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
        ajax: base_url+"/o4k/whyWe/whyWeList",
            columns: [ 
                { data: 'id', title: 'id' },
                { data: 'title', title: 'title'},
                 { data: 'sub_title', title: 'sub_title'},
                {
                data: "null",
                sortable: false,
                render: function (data, type, full) { 

                var  u = '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">'+
                '<li><a href="'+base_url+'/o4k/whyWe/edit/'+full.id+'"><i class=" icon-pen"></i> Edit whyWe </a></li>';
                  u+='</ul>';  

                                    
                return u;
                }

                }
                
            ]
       
        });
    }



    /*
     * edit form 
     * params : title,Status,subtitle  
     */
 $("#whyWe_list_update").submit(function(e)
    {

       e.preventDefault(); 
       var a=b=c=0;

       

        //subtitle
        var Vtitle = [];
        var Vsubtitle = [];

        $( ".perm_text" ).each(function( index ) {
          var valuetitle=$( this ).val().trim();
          var Oid=$(this).attr('id');
          var id=Oid.split('_');  
          var valuesubtitle=$("#subtitle_"+id[1]).val().trim(); 
             //title validation
                if(valuetitle.length > 0)
                {
                        $( "#titlebox_"+id[1] ).removeClass( "has-error" );
                        $("#titlebox_"+id[1]+" .help-block").html(' '); 
                }else
                {
                    Vtitle.push(id[1]);
                    $( "#titlebox_"+id[1] ).addClass( "has-error" ); 
                    $("#titlebox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');   
                    
                }
                //subtitle validation
                if(valuesubtitle.length > 0)
                {
                     $( "#subtitlebox_"+id[1] ).removeClass( "has-error" );
                        $("#subtitlebox_"+id[1]+" .help-block").html(' '); 
                }
                else
                {
                        Vsubtitle.push(id[1]);
                        $( "#subtitlebox_"+id[1] ).addClass( "has-error" ); 
                        $("#subtitlebox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                }
                 
                 
        });
        
        if(Vtitle.length === 0){b=1;}
        if(Vsubtitle.length === 0){a=1;}

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
                    url: base_url+"/o4k/whyWe/update/"+$("#whyWe_list_update").attr('data-id'), 
                    data: new FormData($('#whyWe_list_update')[0]),
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
                            if(obj.hasOwnProperty("subtitle_en") )
                            {
                                $( "#subtitlebox_en" ).addClass( "has-error" );
                                $("#subtitlebox_en .help-block").html("<div class='mad'>"+request.responseJSON.errors.subtitle_en[0]+"</div>");   
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
        $("#subtitle_"+id[1]).val(generate_subtitle($("#title_"+id[1]).val()));
    });
