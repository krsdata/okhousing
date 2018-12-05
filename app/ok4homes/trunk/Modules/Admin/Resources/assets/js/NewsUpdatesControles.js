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
         ordering: false ,
        serverSide: true,  
        ajax: base_url+"/o4k/NewsUpdates/NewsUpdateslist",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title'},
                { data: 'content', name: 'content'},
                {
                data: "null",
                sortable: false,
                render: function (data, type, full) { 

                var  u = '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">'+
                '<li><a href="'+base_url+'/o4k/NewsUpdates/edit/'+full.id+'"><i class=" icon-pen"></i> Edit NewsUpdates </a></li>';
                  u+='<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/NewsUpdates/destroy/'+full.id+'"><i class="icon-trash"></i> Delete News & Updates</a></li>';
                '</ul></li></ul>';              
                return u;
                }

                }
                
            ]
       
        });
    }


  //fetch language and append based on selected country
     $("#country_id").change(function() {
        $('.langrow').remove();
        $('.langtitle').show('slow');
        var countryId=$( "#country_id" ).val(); 
         
        $.ajax({
            type: 'GET',
            url: base_url+"/o4k/NewsUpdates/getlanguage/"+countryId, 
            dataType: 'json',
            success: function (data) {
                $("#pac-input").val('');
                if(data.status==true) { $(".lang_section").html(data.html); }
                else { $("#error-common").html(data.message);  }
   
                /*for(var j=0;j<data.length;j++){
                    $(".lang_section").append('<div class="row"><div class="langrow"><div class="form-group col-md-6"><label>Language</label> <input id="language_id_'+ (j + 1) +' "name="languages[]" readonly value="'+data[j].languages.name+'" type="text" class="form-control" placeholder="Enter Property Prize"><input type="hidden" id="language_id_'+ (j + 1) +' "name="hidlang[]"  value="'+data[j].id+'" ></div><div class="form-group col-md-6 "><label>Description</label><textarea rows="5" cols="5" class="form-control" placeholder="Property Description" name="description[]" id= "description_'+ (j + 1) +'"></textarea></div></div></div>'); 
                }*/
                
            },
               
        });
        
    });


  //fetch language and append based on selected country
     $("#country_id_edit").change(function() {
        var countryId=$( "#country_id_edit" ).val(); 
        var parent_id=$( "#parent_id" ).val(); 
        $.ajax({
            type: 'GET',
            url: base_url+"/o4k/NewsUpdates/getlanguage_edit/"+countryId+"/"+parent_id, 
            dataType: 'json',
            success: function (data) {
                $("#pac-input").val('');
                if(data.status==true) { $(".lang_section").html(data.html); }
                else { $("#error-common").html(data.message);  }
   
                /*for(var j=0;j<data.length;j++){
                    $(".lang_section").append('<div class="row"><div class="langrow"><div class="form-group col-md-6"><label>Language</label> <input id="language_id_'+ (j + 1) +' "name="languages[]" readonly value="'+data[j].languages.name+'" type="text" class="form-control" placeholder="Enter Property Prize"><input type="hidden" id="language_id_'+ (j + 1) +' "name="hidlang[]"  value="'+data[j].id+'" ></div><div class="form-group col-md-6 "><label>Description</label><textarea rows="5" cols="5" class="form-control" placeholder="Property Description" name="description[]" id= "description_'+ (j + 1) +'"></textarea></div></div></div>'); 
                }*/
                
            },
               
        });
        
    });


    /*
     * edit form 
     * params : Name,Status,content  
     */
 $("#NewsUpdates_list_create").submit(function(e)
    {

     //  e.preventDefault(); 
       
        var image=$("#image").val().trim();
         var countries=$("#country_id").val().trim();
        var a=b=c=0;
         var isValid = ['true'];
        //status
        if(countries.length > 0){
           isValid.push('true');  
            $( "#countrybox" ).removeClass( "has-error" );
            $("#countrybox .help-block").html(' ');
        }
        else{
             isValid.push('false');  
            $( "#countrybox" ).addClass( "has-error" ); 
            $("#countrybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }


         //status
        if(image.length > 0){
           isValid.push('true');  
            $( "#imagebox" ).removeClass( "has-error" );
            $("#statusbox .help-block").html(' ');
        }
        else{
             isValid.push('false');  
            $( "#imagebox" ).addClass( "has-error" ); 
            $("#imagebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }


        $('input,textarea').each(function() {
          var inputtype=$(this).attr('type');
      
            if(inputtype =='text'  ||  inputtype =='textarea'){
              var inputname = $(this).attr("name");

              if ( $(this).val() .length >0 ){   
                isValid.push('true');  
                $( "#"+inputname ).removeClass( "has-error" );
                $("#"+inputname+" .help-block").html(' ');
                
              }else{
                isValid.push('false'); 
                $( "#"+inputname ).addClass( "has-error" ); 
                $("#"+inputname+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
              }
          }

        });

           if($.inArray('false', isValid) < 0){
                

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
                    url: base_url+"/o4k/NewsUpdates/store", 
                    data: new FormData($('#NewsUpdates_list_create')[0]),
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
                            if(obj.hasOwnProperty("content_en") )
                            {
                                $( "#contentbox_en" ).addClass( "has-error" );
                                $("#contentbox_en .help-block").html("<div class='mad'>"+request.responseJSON.errors.content_en[0]+"</div>");   
                            } 
                                 

                    }
                   
                });


        }
        return false;

    });


    
 $("#NewsUpdates_list_update").submit(function(e)
    {

       e.preventDefault(); 
       var countries=$("#country_id_edit").val();
        var isValid = ['true'];
        //status
        if(countries.length > 0){
           isValid.push('true');  
            $( "#countrybox" ).removeClass( "has-error" );
            $("#countrybox .help-block").html(' ');
        }
        else{
             isValid.push('false');  
            $( "#countrybox" ).addClass( "has-error" ); 
            $("#countrybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }




        $('input,textarea').each(function() {
          var inputtype=$(this).attr('type');
      
            if(inputtype =='text'  ||  inputtype =='textarea'){
              var inputname = $(this).attr("name");

              if ( $(this).val() .length >0 ){   
                isValid.push('true');  
                $( "#"+inputname ).removeClass( "has-error" );
                $("#"+inputname+" .help-block").html(' ');
                
              }else{
                isValid.push('false'); 
                $( "#"+inputname ).addClass( "has-error" ); 
                $("#"+inputname+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
              }
          }

        });
           if($.inArray('false', isValid) < 0){
             
                
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
                    url: base_url+"/o4k/NewsUpdates/update/"+$("#NewsUpdates_list_update").attr('data-id'), 
                    data: new FormData($('#NewsUpdates_list_update')[0]),
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
                            if(obj.hasOwnProperty("content_en") )
                            {
                                $( "#contentbox_en" ).addClass( "has-error" );
                                $("#contentbox_en .help-block").html("<div class='mad'>"+request.responseJSON.errors.content_en[0]+"</div>");   
                            } 
                               
                    }
                });


        }
        return false;

    });
});


