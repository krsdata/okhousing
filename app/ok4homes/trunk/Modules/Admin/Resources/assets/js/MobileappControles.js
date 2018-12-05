$(function() {
	
    if($('.touchspin-empty').length){$(".touchspin-empty").TouchSpin();}

    //initialize selectbox
    if($('.bootstrap-select').length){$('.bootstrap-select').selectpicker();}


    /*
     * edit form 
     * params : Name,Status,Slug  
     */
 $("#Mobileapp_list_update").submit(function(e)
    {

       e.preventDefault(); 
       
        var appstore_status=$("#appstore_status").val().trim();
        var googleplay_status=$("#googleplay_status").val().trim();
        var a=b=c=d=e=f=g=h=0;

        

        //link
        if(appstore_status.length > 0){
            a=1;  
            $( "#appstore_statusbox" ).removeClass( "has-error" );
            $("#appstore_statusbox .help-block").html(' ');

                if(appstore_status == 1 )
                {
                    var appstore_image=$("#appstore_image").val().trim();
                    var appstore_link=$("#appstore_link").val().trim();

                    //appstore_link
                    if(appstore_link.length > 0){
                       e=1;  
                        $( "#appstore_linkbox" ).removeClass( "has-error" );
                        $("#appstore_linkbox .help-block").html(' ');
                    }
                    else{
                        e=0; 
                        $( "#appstore_linkbox" ).addClass( "has-error" ); 
                        $("#appstore_linkbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }

            }
            else
            {
                e=f=1;
                $( "#appstore_imagebox" ).removeClass( "has-error" );
                $("#appstore_imagebox .help-block").html(' ');
                $( "#appstore_linkbox" ).removeClass( "has-error" );
                $("#appstore_linkbox .help-block").html(' ');
            }
        }
        else{
            a=0; 
            $( "#appstore_statusbox" ).addClass( "has-error" ); 
            $("#appstore_statusbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //status
        if(googleplay_status.length > 0){
           b=1;  
            $( "#googleplay_statusbox" ).removeClass( "has-error" );
            $("#googleplay_statusbox .help-block").html(' ');

             if(googleplay_status == 1 )
                {
                    var googleplay_image=$("#googleplay_image").val().trim();
                    var googleplay_link=$("#googleplay_link").val().trim();

                    //googleplay_link
                    if(googleplay_link.length > 0){
                       g=1;  
                        $( "#googleplay_linkbox" ).removeClass( "has-error" );
                        $("#googleplay_linkbox .help-block").html(' ');
                    }
                    else{
                        g=0; 
                        $( "#googleplay_linkbox" ).addClass( "has-error" ); 
                        $("#googleplay_linkbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                    }

                    

            }
            else
            {
                g=h=1;
                $( "#googleplay_imagebox" ).removeClass( "has-error" );
                $("#googleplay_imagebox .help-block").html(' ');
                $( "#googleplay_linkbox" ).removeClass( "has-error" );
                $("#googleplay_linkbox .help-block").html(' ');
            }
        }
        else{
            b=0; 
            $( "#googleplay_statusbox" ).addClass( "has-error" ); 
            $("#googleplay_statusbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

       

        //Slug
        var VName = [];
        var VSlug = [];

        $( ".perm_text" ).each(function( index ) {
          var valueName=$( this ).val().trim();
          var Oid=$(this).attr('id');
          var id=Oid.split('_');  
          var valueSlug=$("#sub_title_"+id[1]).val().trim(); 
                
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
                     $( "#sub_titlebox_"+id[1] ).removeClass( "has-error" );
                        $("#sub_titlebox_"+id[1]+" .help-block").html(' ');
                     
                }
                else
                {
                        VSlug.push(id[1]);
                        $( "#sub_titlebox_"+id[1] ).addClass( "has-error" ); 
                        $("#sub_titlebox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
                }
                 
        });
        
        if(VName.length === 0){c=1;}
        if(VSlug.length === 0){d=1;}
         

//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1 &&  d==1 && e==1 &&  g==1 )
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
                    url: base_url+"/o4k/mobileapp/update/"+$("#Mobileapp_list_update").attr('data-id'), 
                    data: new FormData($('#Mobileapp_list_update')[0]),
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

