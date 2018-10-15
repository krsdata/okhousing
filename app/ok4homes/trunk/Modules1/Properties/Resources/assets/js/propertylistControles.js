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

    //initialize filebutton
    if($(".file-styled-primary").length){
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    }

    //fetch language and append based on selected country
     $("#country_id").change(function() {
        $('.langrow').remove();
        $('.langtitle').show('slow');
        var countryId=$( "#country_id" ).val(); 
         
        $.ajax({
            type: 'GET',
            url: base_url+"/o4k/property_list/getlanguage/"+countryId, 
            dataType: 'json',
            success: function (data) {
				
				if(data.status==true) { $(".lang_section").html(data.html); }
				else { $("#error-common").html(data.message);  }
   
                /*for(var j=0;j<data.length;j++){
                    $(".lang_section").append('<div class="row"><div class="langrow"><div class="form-group col-md-6"><label>Language</label> <input id="language_id_'+ (j + 1) +' "name="languages[]" readonly value="'+data[j].languages.name+'" type="text" class="form-control" placeholder="Enter Property Prize"><input type="hidden" id="language_id_'+ (j + 1) +' "name="hidlang[]"  value="'+data[j].id+'" ></div><div class="form-group col-md-6 "><label>Description</label><textarea rows="5" cols="5" class="form-control" placeholder="Property Description" name="description[]" id= "description_'+ (j + 1) +'"></textarea></div></div></div>'); 
                }*/
                
            },
               
        });
        
    });

    // featured image preview
    $("#property_image").on("change", function(){
      var files = !!this.files ? this.files : [];

      if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        if (/^image/.test( files[0].type)){ // only image file
          var reader = new FileReader(); // instance of the FileReader
          reader.readAsDataURL(files[0]); // read the local file
 
          reader.onloadend = function(){ // set image data as background of div
            $("#featuredimage_preview").css("background-image", "url("+this.result+")");
            }
        }
    });


    // gallery image preview
    $("#gimage").on("change", function(){
      var total_file=document.getElementById("gimage").files.length;
      for(var i=0;i<total_file;i++){
        $('#image_preview').append("<div class='col-md-3' style='width: 18%;'><div class='popupgallery'><a class='fancybox' href='"+URL.createObjectURL(event.target.files[i])+"'><img  class='img-responsive' style='height: 99px!important;' src='"+URL.createObjectURL(event.target.files[i])+"'></a></div></div>");
      }
    });

    
/* ************************************************************************* */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  

    if($('#property_list').length){
        $('#property_list').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/o4k/property_list/UserpropertyList",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'property_category.name', name: 'property_category.name','orderable': false, },
                {
                data: "created_at", sortable: true,
                render: function (data, type, full) {  return  moment(full.created_date).format('DD/MM/YYYY'); } 
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
                '<li><a href="'+base_url+'/o4k/property_list/edit/'+full.id+'"><i class=" icon-pen"></i> Edit Property List</a></li>';
				 if(full.status=="0"){
                            u+= '<li ><a class="change_status"  href="'+base_url+'/o4k/property_list/activate/'+full.id+'"><i class=" icon-eye"></i> Activate </a></li>';
                        }
                  else{
                            u+='<li  ><a class="change_status" href="'+base_url+'/o4k/property_list/deactivate/'+full.id+'"><i class="  icon-eye-blocked"></i> Deactivate </a></li>';
                        } 
                u+='<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/property_list/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Property List</a></li>';
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

        var user_name=$("#user_name").val().trim();
       // alert(user_name);
        var property_name=$("#property_name").val().trim();
        var property_category=$("#property_category").val().trim();
        var property_type=$("#property_type").val().trim();
        var country=$("#country_id").val().trim();
        var property_prize=$("#property_prize").val().trim();
		var location=$("#pac-input").val().trim();
        var building_area=$("#building_area").val().trim();
        var building_unit=$("#building_unit").val().trim();
        var land_area=$("#land_area").val().trim();
        var land_unit=$("#land_unit").val().trim();
        var bed_room=$("#bed_room").val().trim();
        var bath_room=$("#bath_room").val().trim();
        var featured_image=$("#property_image").get(0).files.length 

        var a=b=c=d=e=f=g=h=i=j=k=l=m=n=p=0;

      //  alert(user_name.length);
        //User Name
        if(user_name.length > 0){
           a=1;  
            $( "#userbox" ).removeClass( "has-error" );
            $("#userbox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#userbox" ).addClass( "has-error" ); 
            $("#userbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Property Name
        if(property_name.length > 0){
           b=1;  
            $( "#namebox" ).removeClass( "has-error" );
            $("#namebox .help-block").html(' ');
        }
        else{
            b=0; 
            $( "#namebox" ).addClass( "has-error" ); 
            $("#namebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Property Category
        if(property_category.length > 0){
           c=1;  
            $( "#catbox" ).removeClass( "has-error" );
            $("#catbox .help-block").html(' ');
        }
        else{
            c=0; 
            $( "#catbox" ).addClass( "has-error" ); 
            $("#catbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Property Type
        if(property_type.length > 0){
           d=1;  
            $( "#typebox" ).removeClass( "has-error" );
            $("#typebox .help-block").html(' ');
        }
        else{
            d=0; 
            $( "#typebox" ).addClass( "has-error" ); 
            $("#typebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Prize
        if(property_prize.length > 0){
            var numbers = /^[0-9]+$/;
            if(property_prize.match(numbers))
            {
                e=1;
                $( "#prizebox" ).removeClass( "has-error" );
                $("#prizebox .help-block").html(' ');
            }
            else{
                e=0;
                $( "#prizebox" ).addClass( "has-error" ); 
                $("#prizebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
            }
        }
        else{
            e=0; 
            $( "#prizebox" ).addClass( "has-error" ); 
            $("#prizebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Country
        if(country.length > 0){
           f=1;  
            $( "#countrybox" ).removeClass( "has-error" );
            $("#countrybox .help-block").html(' ');
        }
        else{
            f=0; 
            $( "#countrybox" ).addClass( "has-error" ); 
            $("#countrybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

		//location
		if(location.length > 0){
           q=1;  
            $( "#locationbox" ).removeClass( "has-error" );
            $("#locationbox .help-block").html(' ');
        }
        else{
            q=0; 
            $( "#locationbox" ).addClass( "has-error" ); 
            $("#locationbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
		
		
		
        //Building Area
        if(building_area.length > 0){
            var numbers = /^[0-9]+$/;
            if(building_area.match(numbers))
            {
                g=1;
                $( "#buildingbox" ).removeClass( "has-error" );
                $("#buildingbox .help-block").html(' ');
            }
            else{
                g=0;
                $( "#buildingbox" ).addClass( "has-error" ); 
                $("#buildingbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
            }
        }
        else{
            g=0; 
            $( "#buildingbox" ).addClass( "has-error" ); 
            $("#buildingbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Building Unit
        if(building_unit.length > 0){
           h=1;  
            $( "#bunitbox" ).removeClass( "has-error" );
            $("#bunitbox .help-block").html(' ');
        }
        else{
            h=0; 
            $( "#bunitbox" ).addClass( "has-error" ); 
            $("#bunitbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Land Area
        if(land_area.length > 0){
            var numbers = /^[0-9]+$/;
            if(land_area.match(numbers))
            {
                i=1;
                $( "#landbox" ).removeClass( "has-error" );
                $("#landbox .help-block").html(' ');
            }
            else{
                i=0;
                $( "#landbox" ).addClass( "has-error" ); 
                $("#landbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
            }
        }
        else{
            i=0; 
            $( "#landbox" ).addClass( "has-error" ); 
            $("#landbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Land Unit
        if(land_unit.length > 0){
           j=1;  
            $( "#lunitbox" ).removeClass( "has-error" );
            $("#lunitbox .help-block").html(' ');
        }
        else{
            j=0; 
            $( "#lunitbox" ).addClass( "has-error" ); 
            $("#lunitbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Bed Room
        if(bed_room.length > 0){
            var numbers = /^[0-9]+$/;
            if(land_area.match(numbers))
            {
                k=1;
                $( "#bedbox" ).removeClass( "has-error" );
                $("#bedbox .help-block").html(' ');
            }
            else{
                k=0;
                $( "#bedbox" ).addClass( "has-error" ); 
                $("#bedbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
            }
        }
        else{
            k=0; 
            $( "#bedbox" ).addClass( "has-error" ); 
            $("#bedbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Bath Room
        if(bath_room.length > 0){
            var numbers = /^[0-9]+$/;
            if(land_area.match(numbers))
            {
                l=1;
                $( "#bathbox" ).removeClass( "has-error" );
                $("#bathbox .help-block").html(' ');
            }
            else{
                l=0;
                $( "#bathbox" ).addClass( "has-error" ); 
                $("#bathbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
            }
        }
        else{
            l=0; 
            $( "#bathbox" ).addClass( "has-error" ); 
            $("#bathbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        // amenities validation

        var numberofchecked=$('input.amenities:checkbox:checked').length
        if(numberofchecked > 0){
            m=1;
            $( "#amenitybox").removeClass( "has-error" );
            $("#amenitybox .help-block").html(' ');
        }else{
            $( "#amenitybox").addClass( "has-error" ); 
            $("#amenitybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select atleast one.</label>');
        }

        // neighbourhood validation

        var numberofchecked=$('input.neighbour:checkbox:checked').length
        if(numberofchecked > 0){
            $( ".neighbour" ).each(function() {
                var data_id=$(this).attr('data-id');
                if($("#neighbourhood_"+data_id).prop('checked') == true){
                    var km = $("#km_id_"+data_id).val().trim();
                    if(km.length > 0){
                        var numbers = /^[0-9]+\.?[0-9]*$/;
                        if(km.match(numbers))
                        {
                            n=1;
                            $( "#neighbourbox_"+data_id).removeClass( "has-error" );
                            $("#neighbourbox_"+data_id+" .help-block").html(' ');
                        }
                        else{
                            n=0;
                            $( "#neighbourbox_"+data_id).addClass( "has-error" ); 
                            $("#neighbourbox_"+data_id+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
                        }
                    }
                    else{
                        n=0;
                        $( "#neighbourbox_"+data_id).addClass( "has-error" ); 
                        $("#neighbourbox_"+data_id+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');

                    }
                }

            });
        }else{
            n=1;
            
        }

        //featured image
        if(featured_image > 0){
            p=1;
            $( "#fimagebox").removeClass( "has-error" );
            $("#fimagebox .help-block").html(' ');
        }else{
            p=0;
            $( "#fimagebox").addClass( "has-error" ); 
            $("#fimagebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select featured image.</label>');
        }


        


//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1 && d==1 && e==1 && f==1 && g==1 && h==1 && i==1 && j==1 && k==1 && l==1 && m==1 && n==1 && p==1 && q==1)
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
                    url: base_url+"/o4k/property_list/store", 
                    data: new FormData($('#property_list_create')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                       if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);$('.content-wrapper').unblock();}
                    },
                    error: function (request, textStatus, errorThrown) {
                        $('.content-wrapper').unblock();
                            var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("property_code") )
                            {
                               $( "#codebox" ).addClass( "has-error" );
                               $("#codebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.property_code[0]+"</div>");   
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

    $("#property_list_update").submit(function(e)
    {
        e.preventDefault(); 
         
        var user_name=$("#user_name").val().trim();
        var property_name=$("#property_name").val().trim();
        var property_category=$("#property_category").val().trim();
        var property_type=$("#property_type").val().trim();
        var country=$("#country_id").val().trim();
        var property_prize=$("#property_prize").val().trim();
		var property_location = $("#pac-input").val().trim();
        var building_area=$("#building_area").val().trim();
        var building_unit=$("#building_unit").val().trim();
        var land_area=$("#land_area").val().trim();
        var land_unit=$("#land_unit").val().trim();
        var bed_room=$("#bed_room").val().trim();
        var bath_room=$("#bath_room").val().trim();

        var a=b=c=d=e=f=g=h=i=j=k=l=m=n=0;


        //User Name
        if(user_name.length > 0){
           a=1;  
            $( "#userbox" ).removeClass( "has-error" );
            $("#userbox .help-block").html(' ');
        }
        else{
            a=0; 
            $( "#userbox" ).addClass( "has-error" ); 
            $("#userbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Property Name
        if(property_name.length > 0){
           b=1;  
            $( "#namebox" ).removeClass( "has-error" );
            $("#namebox .help-block").html(' ');
        }
        else{
            b=0; 
            $( "#namebox" ).addClass( "has-error" ); 
            $("#namebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Property Category
        if(property_category.length > 0){
           c=1;  
            $( "#catbox" ).removeClass( "has-error" );
            $("#catbox .help-block").html(' ');
        }
        else{
            c=0; 
            $( "#catbox" ).addClass( "has-error" ); 
            $("#catbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Property Type
        if(property_type.length > 0){
           d=1;  
            $( "#typebox" ).removeClass( "has-error" );
            $("#typebox .help-block").html(' ');
        }
        else{
            d=0; 
            $( "#typebox" ).addClass( "has-error" ); 
            $("#typebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Prize
        if(property_prize.length > 0){
            var numbers = /^[0-9]+$/;
            if(property_prize.match(numbers))
            {
                e=1;
                $( "#prizebox" ).removeClass( "has-error" );
                $("#prizebox .help-block").html(' ');
            }
            else{
                e=0;
                $( "#prizebox" ).addClass( "has-error" ); 
                $("#prizebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
            }
        }
        else{
            e=0; 
            $( "#prizebox" ).addClass( "has-error" ); 
            $("#prizebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Country
        if(country.length > 0){
           f=1;  
            $( "#countrybox" ).removeClass( "has-error" );
            $("#countrybox .help-block").html(' ');
        }
        else{
            f=0; 
            $( "#countrybox" ).addClass( "has-error" ); 
            $("#countrybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
			//location
		if(location.length > 0){
           q=1;  
            $( "#locationbox" ).removeClass( "has-error" );
            $("#locationbox .help-block").html(' ');
        }
        else{
            q=0; 
            $( "#locationbox" ).addClass( "has-error" ); 
            $("#locationbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
		

        //Building Area
        if(building_area.length > 0){
            var numbers = /^[0-9]+$/;
            if(building_area.match(numbers))
            {
                g=1;
                $( "#buildingbox" ).removeClass( "has-error" );
                $("#buildingbox .help-block").html(' ');
            }
            else{
                g=0;
                $( "#buildingbox" ).addClass( "has-error" ); 
                $("#buildingbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
            }
        }
        else{
            g=0; 
            $( "#buildingbox" ).addClass( "has-error" ); 
            $("#buildingbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Building Unit
        if(building_unit.length > 0){
           h=1;  
            $( "#bunitbox" ).removeClass( "has-error" );
            $("#bunitbox .help-block").html(' ');
        }
        else{
            h=0; 
            $( "#bunitbox" ).addClass( "has-error" ); 
            $("#bunitbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Land Area
        if(land_area.length > 0){
            var numbers = /^[0-9]+$/;
            if(land_area.match(numbers))
            {
                i=1;
                $( "#landbox" ).removeClass( "has-error" );
                $("#landbox .help-block").html(' ');
            }
            else{
                i=0;
                $( "#landbox" ).addClass( "has-error" ); 
                $("#landbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
            }
        }
        else{
            i=0; 
            $( "#landbox" ).addClass( "has-error" ); 
            $("#landbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Land Unit
        if(land_unit.length > 0){
           j=1;  
            $( "#lunitbox" ).removeClass( "has-error" );
            $("#lunitbox .help-block").html(' ');
        }
        else{
            j=0; 
            $( "#lunitbox" ).addClass( "has-error" ); 
            $("#lunitbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Bed Room
        if(bed_room.length > 0){
            var numbers = /^[0-9]+$/;
            if(land_area.match(numbers))
            {
                k=1;
                $( "#bedbox" ).removeClass( "has-error" );
                $("#bedbox .help-block").html(' ');
            }
            else{
                k=0;
                $( "#bedbox" ).addClass( "has-error" ); 
                $("#bedbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
            }
        }
        else{
            k=0; 
            $( "#bedbox" ).addClass( "has-error" ); 
            $("#bedbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //Bath Room
        if(bath_room.length > 0){
            var numbers = /^[0-9]+$/;
            if(land_area.match(numbers))
            {
                l=1;
                $( "#bathbox" ).removeClass( "has-error" );
                $("#bathbox .help-block").html(' ');
            }
            else{
                l=0;
                $( "#bathbox" ).addClass( "has-error" ); 
                $("#bathbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
            }
        }
        else{
            l=0; 
            $( "#bathbox" ).addClass( "has-error" ); 
            $("#bathbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        // amenities validation

        var numberofchecked=$('input.amenities:checkbox:checked').length
        if(numberofchecked > 0){
            m=1;
            $( "#amenitybox").removeClass( "has-error" );
            $("#amenitybox .help-block").html(' ');
        }else{
            $( "#amenitybox").addClass( "has-error" ); 
            $("#amenitybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select atleast one.</label>');
        }

        // neighbourhood validation

        var numberofchecked=$('input.neighbour:checkbox:checked').length
        if(numberofchecked > 0){
            $( ".neighbour" ).each(function() {
                var data_id=$(this).attr('data-id');
                if($("#neighbourhood_"+data_id).prop('checked') == true){
                    var km = $("#km_id_"+data_id).val().trim();
                    if(km.length > 0){
                        var numbers = /^[0-9]+\.?[0-9]*$/;
                        if(km.match(numbers))
                        {
                            n=1;
                            $( "#neighbourbox_"+data_id).removeClass( "has-error" );
                            $("#neighbourbox_"+data_id+" .help-block").html(' ');
                        }
                        else{
                            n=0;
                            $( "#neighbourbox_"+data_id).addClass( "has-error" ); 
                            $("#neighbourbox_"+data_id+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter a valid number.</label>');
                        }
                    }
                    else{
                        n=0;
                        $( "#neighbourbox_"+data_id).addClass( "has-error" ); 
                        $("#neighbourbox_"+data_id+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');

                    }
                }

            });
        }else{
            n=1;
            
        }


//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

        if(a==1 && b==1 && c==1 && d==1 && e==1 && f==1 && g==1 && h==1 && i==1 && j==1 && k==1 && l==1 && m==1 && n==1 && q==1)
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
                    url: base_url+"/o4k/property_list/update/"+$("#property_list_update").attr('data-id'), 
                    data: new FormData($('#property_list_update')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                       if(response.status==true){window.location.href = response.url;  }else{$('.content-wrapper').unblock();location.reload();$(".showalert").show(response.alert);}
                       
                    },
                    error: function (request, textStatus, errorThrown) {
                            $('.content-wrapper').unblock();
                            var obj = request.responseJSON.errors ;

                            if(obj.hasOwnProperty("property_code") )
                            {
                               $( "#codebox" ).addClass( "has-error" );
                               $("#codebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.property_code[0]+"</div>");   
                            }         

                    }
                    
                });


        }
        return false;

    });

});

function initMap() {
    var e = document.getElementById("country_id");
    var strCountry = $(e).find("option:selected").data('flag');
	if(strCountry){
		$("#mapsection").show('slow');
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 40.725332, lng: -73.997158},
			zoom: 13
		});
		var options = {
			types: ['(cities)'],
			componentRestrictions: {country: strCountry}

		};
		var card = document.getElementById('pac-card');
		var input = document.getElementById('pac-input');
		var types = document.getElementById('type-selector');


		map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

		var autocomplete = new google.maps.places.Autocomplete(input,options);

	   // Bind the map's bounds (viewport) property to the autocomplete object,
	   // so that the autocomplete requests use the current map bounds for the
	   // bounds option in the request.
	   autocomplete.bindTo('bounds', map);

	   var infowindow = new google.maps.InfoWindow();
	   
	   var marker = new google.maps.Marker({
		map: map,
		anchorPoint: new google.maps.Point(0, -29)
	   });

		autocomplete.addListener('place_changed', function() {
			infowindow.close();
			marker.setVisible(false);
			var place = autocomplete.getPlace();
			if (!place.geometry) {
			  // User entered the name of a Place that was not suggested and
			  // pressed the Enter key, or the Place Details request failed.
			  window.alert("No details available for input: '" + place.name + "'");
			  return;
			}

			// If the place has a geometry, then present it on a map.
			if (place.geometry.viewport) {
			  map.fitBounds(place.geometry.viewport);
			} else {
			  map.setCenter(place.geometry.location);
			  map.setZoom(17);  // Why 17? Because it looks good.
			}
			marker.setPosition(place.geometry.location);
			marker.setVisible(true);
				$('#lat').val(place.geometry.location.lat());
				$('#lng').val(place.geometry.location.lng());
			
			infowindow.open(map, marker);
		});
	}
}
