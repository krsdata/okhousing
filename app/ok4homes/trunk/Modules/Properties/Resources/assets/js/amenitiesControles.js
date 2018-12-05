$(function() {
	

    //initialize selectbox
    if($('.bootstrap-select').length){$('.bootstrap-select').selectpicker();}

    //initialize filebutton
    if($(".file-styled-primary").length){
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    }

    
/* ************************************************************************* */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  

    if($('#amenities_list').length){
        $('#amenities_list').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/o4k/amenities/AdminAmenitiesList",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'created_language.name', name: 'created_language.name','orderable': false, },
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
                '<li><a href="'+base_url+'/o4k/amenities/edit/'+full.id+'"><i class=" icon-pen"></i> Edit Amenity</a></li>';
				 if(full.status=="0"){
                            u+= '<li ><a class="change_status"  href="'+base_url+'/o4k/amenities/activate/'+full.id+'"><i class=" icon-eye"></i> Activate </a></li>';
                        }
                  else{
                            u+='<li  ><a class="change_status" href="'+base_url+'/o4k/amenities/deactivate/'+full.id+'"><i class="  icon-eye-blocked"></i> Deactivate </a></li>';
                        } 
                u+='<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/amenities/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Amenity</a></li>';
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
     $("#amenity_create").submit(function(e)
    {
       e.preventDefault(); 
         
        var Status         =   $("[name='status_en']").val().trim();
        var Name           =   $("[name='name_en']").val().trim();
        var Slug           =   $("[name='slug_en']").val().trim();
        var icon           =   $("#amenity_image").get(0).files.length 

        var a=0;
        var b=0;
        var c=0; 
        var d=0; 

        //Status
        if(Status=='0' || Status=='1'){
           a=1;  
            $( "#statusbox" ).removeClass( "has-error" );
            $("#statusbox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#statusbox" ).addClass( "has-error" ); 
            $("#statusbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid status.</label>');
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
                $( "#namebox_"+id[1] ).removeClass( "has-error" );
                $("#namebox_"+id[1]+" .help-block").html(' '); 
            }else
            {
                VName.push(id[1]);
                $( "#namebox_"+id[1] ).addClass( "has-error" ); 
                $("#namebox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');   
                    
            }

            //slug validation
                 if(valueSlug.length > 0)
                 {
                    var gnsg= generate_slug($("#name_"+id[1]).val());
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

        if(VName.length === 0){b=1;}
        if(VSlug.length === 0){c=1;}


        //image

        if(icon > 0){
            d=1;  
            $( "#iconbox" ).removeClass( "has-error" );
            $("#iconbox .help-block").html(' ');
        }else{
            d=0; 
            $( "#iconbox" ).addClass( "has-error" ); 
            $("#iconbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }


//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1 && d==1)
        {

           $.ajax({
                    type: "POST",
                    url:base_url+"/o4k/amenities/store",
                    dataType: "json",
                    async: false, 
                    data: new FormData($('#amenity_create')[0]),
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {       
                        if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                         
                    },
                    error: function (request, textStatus, errorThrown) {

                            var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("name_en") )
                            {
                               $( "#namebox" ).addClass( "has-error" );
                               $("#namebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.name_en[0]+"</div>");   
                            }         

                    }
                });

        }
        return false;

    });

/* ************************************************************************* */  
/* *************************** create end ********************************** */  
/* ************************************************************************* */ 


     $(".perm_text").keyup(function() {
        var Oid=$(this).attr('id');
        var id=Oid.split('_');  
        $("#slug_"+id[1]).val(generate_slug($("#name_"+id[1]).val()));
    });


/* ************************************************************************* */  
/* *************************** generate slug end *************************** */  
/* ************************************************************************* */  


    /*
     * edit form 
     * params : Name,Status,Slug  
     */

    $("#amenity_update").submit(function(e)
    {
        e.preventDefault(); 
         
        var Status         =   $("[name='status_en']").val().trim();
        var Name           =   $("[name='name_en']").val().trim();
        var Slug           =   $("[name='slug_en']").val().trim();

        var a=0;
        var b=0;
        var c=0; 

        //Status
        if(Status=='0' || Status=='1'){
           a=1;  
            $( "#statusbox" ).removeClass( "has-error" );
            $("#statusbox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#statusbox" ).addClass( "has-error" ); 
            $("#statusbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid status.</label>');
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
                $( "#namebox_"+id[1] ).removeClass( "has-error" );
                $("#namebox_"+id[1]+" .help-block").html(' '); 
            }else
            {
                VName.push(id[1]);
                $( "#namebox_"+id[1] ).addClass( "has-error" ); 
                $("#namebox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');   
                    
            }

            //slug validation
                 if(valueSlug.length > 0)
                 {
                    var gnsg= generate_slug($("#name_"+id[1]).val());
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

        if(VName.length === 0){b=1;}
        if(VSlug.length === 0){c=1;}


//        /* ------------------------------------------------------------------ */
//        /* ----------------- form updating -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1)
        {

           $.ajax({
                    type: "POST",
                    url: base_url+"/o4k/amenities/update/"+$("#amenity_update").attr('data-id'), 
                    data: new FormData($('#amenity_update')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){

                       if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                    },
                    error: function (request, textStatus, errorThrown) {
                             var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("name_en") )
                            {
                               $( "#namebox" ).addClass( "has-error" );
                               $("#namebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.name_en[0]+"</div>");   
                            }   
                    }
                });

        }
        return false;

    });

});
