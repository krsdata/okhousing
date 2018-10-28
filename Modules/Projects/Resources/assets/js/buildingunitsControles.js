$(function() {
	

    //initialize selectbox
    if($('.bootstrap-select').length){$('.bootstrap-select').selectpicker();}

    
/* ************************************************************************* */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  

    if($('#building_unit_list').length){
        $('#building_unit_list').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/o4k/projects/building_unit/AdminBuildingUnitList",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'unit', name: 'unit' },
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
                '<li><a href="'+base_url+'/o4k/projects/building_unit/edit/'+full.id+'"><i class=" icon-pen"></i> Edit Building Unit</a></li>';
				 if(full.status=="0"){
                            u+= '<li ><a class="change_status"  href="'+base_url+'/o4k/projects/building_unit/activate/'+full.id+'"><i class=" icon-eye"></i> Activate </a></li>';
                        }
                  else{
                            u+='<li  ><a class="change_status" href="'+base_url+'/o4k/projects/building_unit/deactivate/'+full.id+'"><i class="  icon-eye-blocked"></i> Deactivate </a></li>';
                        } 
                u+='<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/projects/building_unit/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Building Unit</a></li>';
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
     $("#building_unit_create").submit(function(e)
    {
       e.preventDefault(); 
         
        var Status         =   $("[name='status_en']").val().trim();

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
                $( "#unitbox_"+id[1] ).removeClass( "has-error" );
                $("#unitbox_"+id[1]+" .help-block").html(' '); 
            }else
            {
                VName.push(id[1]);
                $( "#unitbox_"+id[1] ).addClass( "has-error" ); 
                $("#unitbox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');   
                    
            }

            //slug validation
                 if(valueSlug.length > 0)
                 {
                    var gnsg= generate_slug($("#unit_"+id[1]).val());
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
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1 )
        {

           $.ajax({
                    type: "POST",
                    url:base_url+"/o4k/projects/building_unit/store",
                    dataType: "json",
                    async: false, 
                    data: new FormData($('#building_unit_create')[0]),
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {       
                        if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                         
                    },
                    error: function (request, textStatus, errorThrown) {

                            var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("unit_en") )
                            {
                               $( "#unitbox_en" ).addClass( "has-error" );
                               $("#unitbox_en .help-block").html("<div class='mad'>"+request.responseJSON.errors.unit_en[0]+"</div>");   
                            }         

                    }
                });

        }
        return false;

    });

/* ************************************************************************* */  
/* *************************** create end ********************************** */  
/* ************************************************************************* */ 

    $('body').on('keyup', '.perm_text', function() {
     //$(".perm_text").keyup(function() {
        var Oid=$(this).attr('id');
        var id=Oid.split('_');  
        $("#slug_"+id[1]).val(generate_slug($("#unit_"+id[1]).val()));
    });


/* ************************************************************************* */  
/* *************************** generate slug end *************************** */  
/* ************************************************************************* */  


    /*
     * edit form 
     * params : Name,Status,Slug  
     */

    $("#building_unit_update").submit(function(e)
    {
        e.preventDefault(); 
         
        var Status         =   $("[name='status_en']").val().trim();

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
                $( "#unitbox_"+id[1] ).removeClass( "has-error" );
                $("#unitbox_"+id[1]+" .help-block").html(' '); 
            }else
            {
                VName.push(id[1]);
                $( "#unitbox_"+id[1] ).addClass( "has-error" ); 
                $("#unitbox_"+id[1]+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');   
                    
            }

            //slug validation
                 if(valueSlug.length > 0)
                 {
                    var gnsg= generate_slug($("#unit_"+id[1]).val());
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
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1)
        {

           $.ajax({
                    type: "POST",
                    url: base_url+"/o4k/projects/building_unit/update/"+$("#building_unit_update").attr('data-id'), 
                    data: new FormData($('#building_unit_update')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){

                       if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                    },
                    error: function (request, textStatus, errorThrown) {
                             var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("unit_en") )
                            {
                               $( "#unitbox_en" ).addClass( "has-error" );
                               $("#unitbox_en .help-block").html("<div class='mad'>"+request.responseJSON.errors.unit_en[0]+"</div>");   
                            }   
                    }
                });

        }
        return false;

    });

});



  //fetch language and append based on selected country
     $("#country_id").change(function() {
        $('.langrow').remove();
        $('.langtitle').show('slow');
        var countryId=$( "#country_id" ).val(); 
         
        $.ajax({
            type: 'GET',
            url: base_url+"/o4k/projects/building_unit/getlanguage/"+countryId, 
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
            url: base_url+"/o4k/projects/building_unit/getlanguage_edit/"+countryId+"/"+parent_id, 
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
