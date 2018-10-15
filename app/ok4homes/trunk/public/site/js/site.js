 $(function() 
 {
     
    $.get(base_url+"/country", function(data, status)
    {
        console.log(data);
        if(data.response==true)
        { 
            $('#mesh_wrapper').html(data.SliderHtml);
            $('#fcountry_lang').html(data.LanguageHtml); 
            $('#fcountry').html(data.CountryHtml);
        }
        else { window.location.href = data.url; } 
    });
    
   
    $("#fcountry").on("click",".dropdown-menu li",function() 
    {
        var is_home;  
        if (typeof ($("[name='is_home']").val()) === "undefined")  { is_home=0; }
        else{is_home=$("[name='is_home']").val().trim();}
        $.get(base_url+"/change_country/"+$(this).attr('data-lang')+"/"+is_home, function(data, status)
       {
            if(data.response==true)
            { 
                window.location.href = data.urlAppend;
            }
            else { window.location.href = data.url; } 
       });

          
    });

    $("#fcountry_lang").on("click",".dropdown-menu li",function() 
    {
        var is_home;  
        if (typeof ($("[name='is_home']").val()) === "undefined")  { is_home=0; }
        else{is_home=$("[name='is_home']").val().trim();}
        $.get(base_url+"/change_language/"+$(this).attr('data-lang')+"/"+is_home, function(data, status)
       {
            if(data.response==true)
            { 
                window.location.href = data.urlAppend;
            }
            else { window.location.href = data.url; } 
       });

          
    });
    

    
 
    
 });

