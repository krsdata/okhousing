     
$(function() {

//initialize selectbox

    if($("#lang_1").length){ $("#lang_1").select2();} 
    if($('.bootstrap-select').length){$('.bootstrap-select').selectpicker();}
    if($("#font_1").length){$("#font_1").uniform({fileButtonClass: 'action btn bg-blue',fileBtnText: "Choose Font",});}

//initialize Radio btn   

    if($('.CheckboxStyle').length){ $(".CheckboxStyle").uniform({radioClass: 'choice',wrapperClass: "border-success text-success-600" });}

//Initialize file button in update page.

if($("#country_update").length)
    { 
        var i=1;
        $('.language_sel').each(function(){
            i++;
            if($("#lang_"+i).length){
                $("#lang_"+i).select2();
            }
        });
        var f=1;
        $('.fonts_sel').each(function(){
            f++;
            if($("#font_"+f).length)
            {
                $("#font_"+f).uniform({
                    fileButtonClass: 'action btn bg-blue',
                    fileBtnText: "Choose Font",
                });
            }
        });

        $(".checkbox_sel").prop("disabled", false);
        $('input.checkbox_sel').on('change', function() {
            $('input.checkbox_sel').not(this).prop('checked', false);  
        });
       
    }

    
/* ************************************************************************* */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  

    //fetch all countries in autocomplete
    if($("#country_create").length){
        $("#country_id").select2({
            ajax: {
                url: base_url+"/o4k/countries/list_allcountries",
                dataType: 'json',
                method:'POST',
                data: function (params) {
                    return {
                        key: params.term, // search term
                    };
                },
                processResults: function (data) {

                    return {
                        results: data.results
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,

        });

        // show all data's based on country selection
        $('#country_id').on('select2:select', function (e) {
            var data = e.params.data;
            $("#country_code").val(data.code);
            $("#country_name").val(data.text);
            $("#currency").val(data.currency);
            $("#currency_code").val(data.currency_code);
            $("#symbol").val(data.symbol);
            $("#flag_code").val(data.flag);
            $("#flag_img").attr('src',base_url+"/public/admin/images/flags/"+data.flag+".png");
            
        });
     }

   
/* ************************************************************************* */  
/* *************************** autopopulate completed ********************** */  
/* ************************************************************************* */  

$("#country_create").on("click", "#add_language_row", function (e)
{
    e.preventDefault();
    $("#add_language_row").attr('disabled','disabled');
    setTimeout(function () {
        
        var did = $(".lang_section:last").attr('data-id');
        $(".lang_section:last").clone().hide().appendTo('.country_section').show('slow');
        $(".lang_section:last").attr('data-id',parseInt(did)+1);
        $(".lang_section:last").find('select').attr('id','lang_'+(parseInt(did)+1)).removeClass('select2-hidden-accessible');
        $(".lang_section:last").find('.select2').remove();
        $("#lang_"+(parseInt(did)+1)).select2();
        
        /*font*/
        $(".lang_section:last").find('.uploader').remove();
        $(".lang_section:first").find('.font-select').clone().insertAfter($(".lang_section:last").find('br'));
        $(".lang_section:last").find('.font-select').attr('id','font_'+(parseInt(did)+1)).val('');
        $(".lang_section:last").find('.is_default').attr('id','default_'+(parseInt(did)+1)).val('1');
         $(".lang_section:last").find('.is_active').attr('id','active_'+(parseInt(did)+1)).prop('1');
         $('.myCheckbox').prop('checked', true);
        $("#font_"+(parseInt(did)+1)).uniform({  fileButtonClass: 'action btn bg-blue', fileBtnText: "Choose Font"  });
        $(".lang_section:last").find('.Language_error').attr('id','Language_error_'+(parseInt(did)+1));
        $(".lang_section:last").find('.Language_Font_error').attr('id','LanguageFont_error_'+(parseInt(did)+1));

        $("#add_language_row").attr('disabled',false);
    }, 500);
    
});

    $("#country_update").on("click", "#add_language_row", function (e)
    {
        e.preventDefault();
        $("#add_language_row").attr('disabled','disabled');
        setTimeout(function () {
        
        var did = $(".lang_section:last").attr('data-id');
        $(".lang_section:last").clone().hide().appendTo('.country_section').show('slow');
        $(".lang_section:last").attr('data-id',parseInt(did)+1);
        $(".lang_section:last").attr('data-default',0);
        $(".lang_section:last").find('select').attr('id','lang_'+(parseInt(did)+1)).removeClass('select2-hidden-accessible');
        $(".lang_section:last").find('.select2').remove();
        $("#lang_"+(parseInt(did)+1)).select2();
        
        /*font*/
        $(".lang_section:last").find('.uploader').remove();
        $(".lang_section:first").find('.font-select').clone().insertAfter($(".lang_section:last").find('br'));
        $(".lang_section:last").find('.font-select').attr('id','font_'+(parseInt(did)+1)).val('');
        $(".lang_section:last").find('.is_default').attr('id','default_'+(parseInt(did)+1)).val('1');
         $(".lang_section:last").find('.is_active').attr('id','active_'+(parseInt(did)+1)).prop('1');
         $('.myCheckbox').prop('checked', true);
        $("#font_"+(parseInt(did)+1)).uniform({  fileButtonClass: 'action btn bg-blue', fileBtnText: "Choose Font"  });
        $(".lang_section:last").find('.Language_error').attr('id','Language_error_'+(parseInt(did)+1));
        $(".lang_section:last").find('.Language_Font_error').attr('id','LanguageFont_error_'+(parseInt(did)+1));

        $("#add_language_row").attr('disabled',false);
    }, 500);
    
});

// remove language section

$(document).on('click', '.remove_lang', function(e) { 
        if($(".lang_section").length>1){
            var target = $(this).parent().parent();
            target.hide('slow', function(){ target.remove(); });
        }
        else{
            $(".lang_section").hide();
        }
   });


 /* ************************************************************************* */  
/* *************************** remove lan end  ********************** */  
/* ************************************************************************* */  
    
   if($('#countries_list').length){
      
        $('#countries_list').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/o4k/countries/AdminCountriesList",
        columns: [ 
            { data: 'id', name: 'id' },
            {
                data: "name", sortable: true,
                render: function (data, type, full) {  return  full.created_countries.name; } 
            },
            {
                data: "code", sortable: true,
                render: function (data, type, full) {  return  full.created_countries.code; } 
            },
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
            '<li><a href="'+base_url+'/o4k/countries/edit/'+full.id+'"><i class=" icon-pen"></i> Edit Country</a></li>'+
            '<li><a Onclick="return ConfirmDelete();" class="delete_single" href="'+base_url+'/o4k/countries/destroy/'+full.id+'"><i class="icon-trash"></i> Delete Country</a></li>'+
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
     * params : Name,Country Code,Flag, Currency,Currency Code,Symbol,Status,default language,languages[]  
     */
      
    $("#country_create").submit(function(e)
    {
        e.preventDefault(); 
       
         
            var country        =   $("[name='country_id']").val().trim();
            var code           =   $("[name='code']").val().trim();
            var flag           =   $("[name='flag']").val().trim();
            var currency       =   $("[name='currency']").val().trim();
            var currencycode   =   $("[name='currency_code']").val().trim();
            var symbol         =   $("[name='symbol']").val().trim();
            var status         =   $("[name='status']").val().trim();
            var checkedsetlang =   $('input.setlang:checked');
 
            var a=b=c=d=e=f=g=h=i=0;
 
         
        //country
       
        if(country == 'select')
        {  
            a=0; 
            $( "#countryBox" ).addClass( "has-error" ); 
            $("#countryBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        else
        {   a=1; 
            $( "#countryBox" ).removeClass( "has-error" );
            $("#countryBox .help-block").html(' ');
        }
        //code
        if(code.length > 0){
            b=1; 
            $( "#CountryCodeBox" ).removeClass( "has-error" );
            $("#CountryCodeBox .help-block").html(' ');
            
        }else{
            b=0;
            $( "#CountryCodeBox" ).addClass( "has-error" ); 
            $("#CountryCodeBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        //flag
        if(flag.length > 0){
            c=1; 
            $( "#flagBox" ).removeClass( "has-error" );
            $("#flagBox .help-block").html(' ');
            
        }else{
            c=0;
            $( "#flagBox" ).addClass( "has-error" ); 
            $("#flagBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        //currency
        if(currency.length > 0){
            d=1; 
            $( "#CurrencyBox" ).removeClass( "has-error" );
            $("#CurrencyBox .help-block").html(' ');
            
        }else{
            d=0;
            $( "#CurrencyBox" ).addClass( "has-error" ); 
            $("#CurrencyBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        //currencycode
        if(currencycode.length > 0){
            d=1; 
            $( "#CurrencyCodeBox" ).removeClass( "has-error" );
            $("#CurrencyCodeBox .help-block").html(' ');
            
        }else{
            d=0;
            $( "#CurrencyCodeBox" ).addClass( "has-error" ); 
            $("#CurrencyCodeBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        //symbol
        if(symbol.length > 0){
            e=1; 
            $( "#SymbolBox" ).removeClass( "has-error" );
            $("#SymbolBox .help-block").html(' ');
            
        }else{
            e=0;
            $( "#SymbolBox" ).addClass( "has-error" ); 
            $("#SymbolBox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }
        //symbol
        if(status==0 || status==1){
            f=1; 
            $( "#Status" ).removeClass( "has-error" );
            $("#Status .help-block").html(' ');
            
        }else{
            f=0;
            $( "#Status" ).addClass( "has-error" ); 
            $("#Status .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid status.</label>');
        }
       // Set default language checkbox validation
        if(checkedsetlang.length > 0){
            g=1;
            $( "#setlanguage" ).removeClass( "has-error" );
            $("#setlanguage .help-block").html(' ');
        }else{
            g=0;
           $( "#setlanguage" ).addClass( "has-error" ); 
            $("#setlanguage .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select your default language.</label>');
        }

        // language validation
       
        if($("[name='setlangs[]']:checked").length > 0)
        {
                h=1;
                $( "#setlanguage" ).removeClass( "has-error" );
                $("#setlanguage .help-block").html(' ');
           
        }else{
                h=0;
                $( "#setlanguage" ).addClass( "has-error" ); 
                $("#setlanguage .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select your default language.</label>');
         
        }
        
        if(($("[name='setlangs[]']:checked").length > 0) && ($("[name='setlangs[]']:checked").val()==0))
        {
            if($("[name='isDefault[]']:checked").length > 0)
            {
                
                var fullid = $($("[name='isDefault[]']:checked")).attr('id');
                /* all other validatios go heare for the row*/
                id= fullid.split("_");
                var font     = $("#font_"+id[1]).get(0).files.length;
                var lang     = $("#lang_"+id[1]).val().trim();
                var isActive =  $("#active_"+id[1]).is(':checked');
                if(font >0 && lang.length > 0 && isActive == true){
                    i=1;
                    $(".langErr").html('');
                }else{

                    i=0;
                    $(".langErr").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select language and font for default one.</label>');

                }

                 
            }
            else
            {
                i=0;
                $(".langErr").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select your default language.</label>');
            }
          
        }else
        {
            $($("[name='isDefault[]']:checked")).prop('checked', false);
            $(".langErr").html('');
            i=1;
        }
        
 
 
//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
      
        if(a==1 && b==1 && c==1 && d==1 && e==1 && f==1 && g==1 && h==1 && i==1)
        {
              var data=  new FormData($('#country_create')[0]);
              
        $('.is_active').each(function( index, value)
        { 
            
              if(this.checked){
                  data.append('is_active[]', 1);
              }else{
                   data.append('is_active[]', 0);  
              }
            
        });
        
        
         $('.is_default').each(function( index, value)
        { 
            
               if(this.checked == true)
                {
                   data.append('is_default[]', 1);

                }else
                {
                     data.append('is_default[]', 0); 
                }
            
        });
   
 
               $.ajax({
                    type: "POST",
                    url:base_url+"/o4k/countries/add",
                    dataType: "json",
                    async: false, 
                    data: data,
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {     
                         if(response.status==true){window.location.href = response.url; }
                         else{location.reload();}
                    },

                });
        }
//        
        return false;
        
    });
  
/* ************************************************************************* */  
/* *************************** module create end *********************** */  
/* ************************************************************************* */  
 
 
 /*
     * edit form 
     * params : Name,Status,Slug  
     */
      
   $("#country_update").submit(function(e)
   {   e.preventDefault();
        
        var status         =   $("[name='status']").val().trim();
        var checkedsetlang =   $('input.setlang:checked');
       
       var a=b=c=d=e=f=g=h=i=0;
 
         
       
        //status
        if(status==0 || status==1){
            f=1; 
            $( "#Status" ).removeClass( "has-error" );
            $("#Status .help-block").html(' ');
            
        }else{
            f=0;
            $( "#Status" ).addClass( "has-error" ); 
            $("#Status .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalid status.</label>');
        }
       // Set default language checkbox validation
        if(checkedsetlang.length > 0){
            g=1;
            $( "#setlanguage" ).removeClass( "has-error" );
            $("#setlanguage .help-block").html(' ');
        }else{
            g=0;
           $( "#setlanguage" ).addClass( "has-error" ); 
            $("#setlanguage .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select your default language.</label>');
        }

        // language validation
       
        if($("[name='setlangs[]']:checked").length > 0)
        {
                h=1;
                $( "#setlanguage" ).removeClass( "has-error" );
                $("#setlanguage .help-block").html(' ');
           
        }else{
                h=0;
                $( "#setlanguage" ).addClass( "has-error" ); 
                $("#setlanguage .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select your default language.</label>');
         
        }
       var isDefaults=  $("[name='isDefault[]']:checked").length;
        if(($("[name='setlangs[]']:checked").length > 0) && ($("[name='setlangs[]']:checked").val()== 0))
        {
            
            if($("[name='isDefault[]']:checked").length > 0)
            {
                

                
                var fullid = $($("[name='isDefault[]']:checked")).attr('id');
                /* all other validatios go heare for the row*/
                id= fullid.split("_");
                var font     = $("#font_"+id[1]).get(0).files.length;
                var lang     = $("#lang_"+id[1]).val().trim();
                var isActive =  $("#active_"+id[1]).is(':checked');
               
                  
                if(font >0 && lang.length > 0 && isActive == true){
                  
                    i=1;
                    $(".langErr").html('');
                }else{

                    i=0;
                    $(".langErr").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select language and font for default one.</label>');

                }

                 
            }
            else
            {
                i=0;
                $(".langErr").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select your default language.</label>');
            }
          
        }else
        {
            $($("[name='isDefault[]']:checked")).prop('checked', false);
            $(".langErr").html('');
            i=1;
        }
        
              
 
       
       /* ------------------------------------------------------------------ */
       /* ----------------- form submitting -------------------------------- */
       /* ------------------------------------------------------------------ */

       if(f==1 && g==1 && h==1 && i==1)
        {
              var data=  new FormData($('#country_update')[0]);
              
        $('.is_active').each(function( index, value)
        { 
            
              if(this.checked){
                  data.append('is_active[]', 1);
              }else{
                   data.append('is_active[]', 0);  
              }
            
        });
        
        
         $('.is_default').each(function( index, value)
        { 
            
               if(this.checked == true)
                {
                   data.append('is_default[]', 1);

                }else
                {
                     data.append('is_default[]', 0); 
                }
            
        });
   
                $.ajax({
                    type: "POST",
                    url: base_url+"/o4k/countries/update/"+$("#country_update").attr('data-id'), 
                    data: data,
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                        if(response.status==true){window.location.href = response.url; }
                         else{
                            location.reload();

                        }
                    },

                });
        }
        
        return false;     
       
   });

/* ************************************************************************* */  
/* ****************************** function end ***************************** */  
/* ************************************************************************* */    
   
   
});
