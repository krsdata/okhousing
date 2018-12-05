var Demo = (function() {

	function output(node) {
		var existing = $('#result .croppie-result');
		if (existing.length > 0) {
			existing[0].parentNode.replaceChild(node, existing[0]);
		}
		else {
			$('#result')[0].appendChild(node);
		}
	}

	function popupResult(result) {
		var html;
		if (result.html) {
			html = result.html;
		}
		if (result.src) {
			html = '<img src="' + result.src + '" />';
		}
		swal({
			title: '',
			html: true,
			text: html,
			allowOutsideClick: true
		});
		setTimeout(function(){
			$('.sweet-alert').css('margin', function() {
				var top = -1 * ($(this).height() / 2),
					left = -1 * ($(this).width() / 2);

				return top + 'px 0 0 ' + left + 'px';
			});
		}, 1);
	}


	function demoUpload() {
		var $uploadCrop;

		/*function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
					$('.upload-demo').addClass('ready');
	            	$uploadCrop.croppie('bind', {
	            		url: e.target.result
	            	}).then(function(){
	            		console.log('jQuery bind complete');
	            	});
	            	
	            }	            
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
		        swal("Sorry - you're browser doesn't support the FileReader API");
		    }

		}*/

		function readFile(input) {
			if (input.files && input.files[0]) {

                var reader = new FileReader(); 

                reader.onload = function (e) {
                	$('.upload-demo').addClass('ready');
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
	            		console.log('jQuery bind complete');
	            	});                    
                }           
                reader.readAsDataURL(input.files[0]);
            }
                   
        }

        var widowWidth = "";

        if($(window).width() > 1200)        {

          var widowWidth = 600;
        } 
        else if(($(window).width() < 1199) && ($(window).width() > 992)){
          var widowWidth = 500;
        }
        else if(($(window).width() < 991) && ($(window).width() > 768)){
          var widowWidth = 3900;
        }
        else if(($(window).width() < 767) && ($(window).width() > 481)){
          var widowWidth = 480;
        }
        else if(($(window).width() < 480) && ($(window).width() > 0)){
          var widowWidth = 300;
        }

		$uploadCrop = $('#upload-demo').croppie({
			
			
			viewport: {
				width: widowWidth,
				height: 155,
				type: 'square'
			},
			enableExif: true,
			customClass:'customClass'
		});

		/*$uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                height: 300
            },
            customClass:'customClass'
        });*/

		$('#upload').on('change', function () { $("#OpenCropModal").trigger('click'); 
			 readFile(this); });
		$('.upload-result').on('click', function (ev) {

			$('.upload-result').html("saving...");

			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {

				$("#UploadCoverImageSource").val(resp);
				$(".currentCover").attr("src",resp);
				 
				var formdata=  new FormData($('#UploadCoverImageForm')[0]);
                formdata.append('UploadCoverImageSource', $('#UploadCoverImageSource').val());
              
             	
                $.ajax({
                    type: "POST",
                    url:base_url+"/users/UploadCoverImage",
                    dataType: "json",
                    async: false, 
                    data: formdata,
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {
                        
                      if(response.status==1)
                        { 
                           	$('.upload-result').html("SAVE");
                            $(".success-msg").html(response.message);
                            $("#success").addClass('success');
                            // $(".preLoad1").addClass( "Noloader" );
                           // setTimeout(function(){location.reload(); }, 3000);
                           $(".CloseModal").trigger('click'); 

                
                           setTimeout(function(){$("#success").removeClass('success'); $(".success-msg").html(''); }, 3000);
                        } else
                        {
                          // $(".preLoad1").addClass( "Noloader" );
                           $(".success-msg").html(response.message);
                           $("#success").addClass('error');
                           $(".CloseModal").trigger('click'); 

                
                           setTimeout(function(){$("#success").removeClass('error'); $(".success-msg").html(''); }, 3000);
                        }
                   
                    }
                }); 

				/*popupResult({
					src: resp
				});*/
			});
		});
		
		$(".CloseModal").on('click', function (ev) {
			location.reload();
		});

        /*$('#upload').on('change', function () {readFile(this);}); 
        $('.upload-result').on('click', function (ev) {
            $uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				popupResult({
					src: resp
				});
			});
        });*/
        
        
       /* $('.CropImgBtn').on('click', function (ev) {
            
            $("#ImgCropingMsg").html('<span class="red">Cropping...</span>');
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'original'
            }).then(function (resp) {
                $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>Home/ArtistImageCrop",
                        data:{imagebase64:resp,UserType:'AppUser'},
                        success: function(data) {
                            $("#ImgCropingMsg").html('');
                            var getImagePath = "<?php echo base_url(); ?>assets/CropImages/AppUser/"+data;
                            $('#prevProfileImgUpload').css('background-image', 'url(' + getImagePath + ')');
                            $('#CropedStatus').val(data);
                            $("#CropModal").modal('hide');
                        }
                    });
                        
            });
        });*/

	}

	function bindNavigation () {
		var $html = $('html');
		$('nav a').on('click', function (ev) {
			var lnk = $(ev.currentTarget),
				href = lnk.attr('href'),
				targetTop = $('a[name=' + href.substring(1) + ']').offset().top;

			$html.animate({ scrollTop: targetTop });
			ev.preventDefault();
		});
	}

	function init() {
		bindNavigation();
		demoUpload();
	}

	return {
		init: init
	};
})();


// Full version of `log` that:
//  * Prevents errors on console methods when no console present.
//  * Exposes a global 'log' function that preserves line numbering and formatting.
(function () {
  var method;
  var noop = function () { };
  var methods = [
      'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
      'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
      'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
      'timeStamp', 'trace', 'warn'
  ];
  var length = methods.length;
  var console = (window.console = window.console || {});
 
  while (length--) {
    method = methods[length];
 
    // Only stub undefined methods.
    if (!console[method]) {
        console[method] = noop;
    }
  }
 
 
  if (Function.prototype.bind) {
    window.log = Function.prototype.bind.call(console.log, console);
  }
  else {
    window.log = function() { 
      Function.prototype.apply.call(console.log, console, arguments);
    };
  }
})();
