$(function() {

$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });



 $('.close-popup').unbind('click').click(function () {
     $(".val-error ,.help-block").html('');
     $("body").css("overflow","auto");
     });


  $("#Gcode ,#mobile").intlTelInput({
  initialCountry: "auto",
  allowDropdown: false,
  geoIpLookup: function(callback) {
     var countryCode = document.getElementById("hidcode").value;
     callback(countryCode);
    
  },
  utilsScript: base_url+"/public/site/js/plugin/utils.js" // just for formatting/placeholders etc
});


  //fetch language and append based on selected country

    $.ajax({
        type: 'GET',
        url: base_url+"/users/getlanguage", 
        dataType: 'json',
        success: function (data) {
        if(data.status==true) { 
            $(".namesection").html(data.html);
            $(".about_section").html(data.about_html); }
        else {   }
                  
        },              
    });


    /* Registration tabs   */
   

    $('.modal').on('hidden.bs.modal', function () {
        $("body").css("padding-right","0px");
    });
    
     /*$('.modal .close-popup').click(function () {
       $("body").css("padding-right","0px");
    });*/

    $('#categorys').attr('class', 'disabled');
    $('#profile').attr('class', 'disabled');
    $('#verification').attr('class', 'disabled');
    $('#myTab').on('show.bs.tab', 'a', function(event) {event.preventDefault();});
    $('#myTab').on('hide.bs.tab', 'a', function(event) {event.preventDefault();}); 
 


    /* Registration 2nd tab  */
    //Category change validate 
    $(document).on('click', '.chk-other-cat', function(e) {  
        if(this.checked) 
        { 
            $('.chk-other-cat').not(this).prop('checked', false);  
        }
        if($("[name='mainCat[]']:checked").length > 0)
        {
            $('.caterror').html("you can select only one main category or other category");
            $('.chk-main-cat').prop('checked', false);
        }else{$('.caterror').html(" ");} 
    });
 
    $(document).on('click', '.chk-main-cat', function(e) 
    {      
        if($("[name='otherCat[]']:checked").length > 0)
        { 
            $('.caterror').html("you can select only one main category or other category");
            $('.chk-other-cat').prop('checked', false);  
        }else{$('.caterror').html(" ");} 
    });   



    $(document).on('change', '#image', function(e){ 

        var fileType = this.files[0].type;
        var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
        if ($.inArray(fileType, ValidImageTypes) < 0) {
             alert("Please select valid image");
             $(this).val('');
        }
        else
        {
            readURL(this);
        }
      });
 
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#mypro').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


