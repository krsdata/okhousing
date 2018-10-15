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
        ajax: base_url+"/o4k/FeaturedProperties/propertylist",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'property_data.name', name: 'property_data.name','orderable': false, },
                 {
                data: "null",
                sortable: false,
                render: function (data, type, full) { 

                var  u = full.start+' - '+ full.end;                     
                return u;
                }
                },
                { data: 'amount', name: 'amount'},
                { data: 'payment', name: 'payment'},
                {
                data: "null",
                sortable: false,
                render: function (data, type, full) { 

                var  u = '<ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                '<i class="icon-menu9"></i></a><ul class="dropdown-menu dropdown-menu-right">'+
                '<li><a href="'+base_url+'/o4k/FeaturedProperties/edit/'+full.id+'"><i class=" icon-pen"></i> Edit Featured Properties </a></li>';
                  u+='<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/FeaturedProperties/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Featured Properties</a></li>';
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
    $("#property_list_create").submit(function(e)
    {

        e.preventDefault(); 
        var property_id=$("#property_id").val().trim();
        var Datetime=$("#Datetime").val().trim();
        var amount=$("#amount").val().trim();
        var payment=$("#Payment").val().trim();
       
        var a=b=c=d=e=f=g=h=i=j=k=l=m=n=o=0;

        //proerty name
        if(property_id.length > 0){
           a=1;  
            $( "#propertybox" ).removeClass( "has-error" );
            $("#propertybox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#propertybox" ).addClass( "has-error" ); 
            $("#propertybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //date time 
        if(Datetime.length > 0){
           b=1;  
            $( "#Datetimebox" ).removeClass( "has-error" );
            $("#Datetimebox .help-block").html(' ');
        }
        else{
            b=0; 
            $( "#Datetimebox" ).addClass( "has-error" ); 
            $("#Datetimebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //amount
        if(amount.length > 0){
           c=1;  
            $( "#amountbox" ).removeClass( "has-error" );
            $("#amountbox .help-block").html(' ');
        }
        else{
            c=0; 
            $( "#amountbox" ).addClass( "has-error" ); 
            $("#amountbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //payment
        if(payment.length > 0){
          d=1;  
            $( "#paymentbox" ).removeClass( "has-error" );
            $("#paymentbox .help-block").html(' ');
        }
        else{
            d=0; 
            $( "#paymentbox" ).addClass( "has-error" ); 
            $("#paymentbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }


  


//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1 && d==1 )
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
                    url: base_url+"/o4k/FeaturedProperties/store", 
                    data: new FormData($('#property_list_create')[0]),
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
                        if(obj.hasOwnProperty("property_id") )
                        {
                           $( "#propertybox" ).addClass( "has-error" );
                           $("#propertybox .help-block").html("<div class='mad'>"+request.responseJSON.errors.slider_element_id[0]+"</div>");   
                        } 
                        if(obj.hasOwnProperty("Datetime") )
                        {
                           $( "#Datetimebox" ).addClass( "has-error" );
                           $("#Datetimebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.Datetime[0]+"</div>");   
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
 $("#property_list_update").submit(function(e)
    {

        e.preventDefault(); 
        var property_id=$("#property_id").val().trim();
        var Datetime=$("#Datetime").val().trim();
        var amount=$("#amount").val().trim();
        var payment=$("#Payment").val().trim();
        
        var a=b=c=d=e=f=g=h=i=j=k=l=m=n=o=0;

        //proerty name
        if(property_id.length > 0){
           a=1;  
            $( "#propertybox" ).removeClass( "has-error" );
            $("#propertybox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#propertybox" ).addClass( "has-error" ); 
            $("#propertybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //date time 
        if(Datetime.length > 0){
           b=1;  
            $( "#Datetimebox" ).removeClass( "has-error" );
            $("#Datetimebox .help-block").html(' ');
        }
        else{
            b=0; 
            $( "#Datetimebox" ).addClass( "has-error" ); 
            $("#Datetimebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //amount
        if(amount.length > 0){
           c=1;  
            $( "#amountbox" ).removeClass( "has-error" );
            $("#amountbox .help-block").html(' ');
        }
        else{
            c=0; 
            $( "#amountbox" ).addClass( "has-error" ); 
            $("#amountbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //payment
        if(payment.length > 0){
          d=1;  
            $( "#paymentbox" ).removeClass( "has-error" );
            $("#paymentbox .help-block").html(' ');
        }
        else{
            d=0; 
            $( "#paymentbox" ).addClass( "has-error" ); 
            $("#paymentbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }


       


//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1 && d==1)
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
                    url: base_url+"/o4k/FeaturedProperties/update/"+$("#property_list_update").attr('data-id'), 
                    data: new FormData($('#property_list_update')[0]),
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
                        if(obj.hasOwnProperty("property_id") )
                        {
                           $( "#propertybox" ).addClass( "has-error" );
                           $("#propertybox .help-block").html("<div class='mad'>"+request.responseJSON.errors.slider_element_id[0]+"</div>");   
                        }      
                        if(obj.hasOwnProperty("Datetime") )
                        {
                           $( "#Datetimebox" ).addClass( "has-error" );
                           $("#Datetimebox .help-block").html("<div class='mad'>"+request.responseJSON.message+"</div>");   
                        }
                    }
                   
                });


        }
        return false;

    });

/* ************************************************************************* */  
/* *************************** property search by id ********************** */  
/* ************************************************************************* */ 

 
    $("#Search_by_id").click(function(e)
    {
        e.preventDefault();
        var property_id=$("#unique_property_id").val().trim();
       // var short_code=$("#short_code").val().trim();
       // property_id = property_id.replace(short_code+"-", "");
        $.ajax({
                    type: "GET",
                    url: base_url+"/o4k/FeaturedProperties/getproperty/"+property_id, 
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                        if(response.status==true)
                        {

                            
                            $("#property_id").val(response.data.property.id);
                            $("#category_id").val(response.data.property.category_id);
                            $("#property_title").html(response.data.property.name);
                            $("#property_prize").html('<strong>Amount :</strong> '+response.data.property.prize);
                            $("#property_user").html('<strong>User :</strong> '+response.data.property.users.email);
                            $("#property_img").attr('src',base_url+'/public/images/properties/'+response.data.image.image);
                            $("#property_empty_msg").html('');
                            $("#propertyDetails").addClass('propertyDetails');
                      
                        }else
                        {
                            $("#property_id").val('');
                            $("#category_id").val('');
                            $("#property_title").html('');
                            $("#property_prize").html('');
                            $("#property_user").html('');
                            $("#property_img").attr('src','');
                            $("#property_empty_msg").html('No Records Found');
                            $("#propertyDetails").removeClass('propertyDetails');
                        }
                       
                    },
                    error: function (request, textStatus, errorThrown) {
                             var obj = request.responseJSON.errors ;
                        $('.content-wrapper').unblock();
                        if(obj.hasOwnProperty("slider_element_id") )
                        {
                           $( "#propertybox" ).addClass( "has-error" );
                           $("#propertybox .help-block").html("<div class='mad'>"+request.responseJSON.errors.slider_element_id[0]+"</div>");   
                        }         

                    }
                    
            });
    });



});


