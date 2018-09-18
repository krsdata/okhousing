$(function() 
{ 	
    if (window.history && window.history.pushState) {
    window.history.pushState('', null, null);
    $(window).on('popstate', function() {
         $.ajax({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url:base_url+"/o4k/CheckLogin",
                dataType: "json",
                async: false, 
                data: {'check':'check'},
                processData: false,
                contentType: false, 
                success: function(response)
                {
                    
                    if(response.status==false) { window.location.href = response.url;  }
                    else {  parent.history.back(); }
                },
                error: function (request, textStatus, errorThrown) {
                }
                });
       
    });
}
    
    
  });


 
