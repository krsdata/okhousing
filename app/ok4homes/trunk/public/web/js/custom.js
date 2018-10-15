$(document).ready(function () {
    $('select').material_select();
});
$(function () {


 $('.mesh_content').not(".mesh_disabled").hover(function () {
        var Hoverindex = $(this).attr('id');
        $("#hidden_active_div").val(Hoverindex);
        alert(Hoverindex);
    }, function () { });

});

 $('.mesh_content').not(".mesh_disabled").mouseleave(function() {
   $("#hidden_active_div").val('');
   cycle();
  });

$.get(base_url+"/sliderbackground", function(data, status)
    {
        if(data.response==true)
        { 
            $('#Background_banner_image').attr('src',base_url+'/public/images/Background/'+data.BackgroundImage);
            
        }
       
    });

 $.get(base_url+"/slider", function(data, status)
    {
        console.log(data.response);
        if(data.response==true)
        { 
            $('.mesh_wrapper').html(data.SliderHtml);
            var divs = $('.mesh_content').not(".mesh_disabled");
            (function cycle() {

                setTimeout(function () {
                    index = Math.floor(Math.random() * divs.length);
                   
                    Hoverindex = $("#hidden_active_div").val();
                    var Activaindex = $('.mesh_active').attr('id');
                    var Hoverindex = $("#hidden_active_div").val();
                    if(Hoverindex !== Activaindex)
                    {
                        divs.removeClass('mesh_active').eq(index).addClass('mesh_active');
                        cycle();
                    }
                    else
                    {
                        cycle();
                    }
                    
                }, 6000);

            })();
        }
       
    });




//sliders
    $('.featured_slider').slick({
        centerMode: true,
        centerPadding: '150px',
        slidesToShow: 1,
        prevArrow: $('.prev'),
        nextArrow: $('.next'),
        speed: 900
    });
    $('.featured_slider2').slick({
        centerMode: true,
        centerPadding: '50px',
        slidesToShow: 1

    });

    if ($(".featured_slider_item").hasClass("slick-active")) {

        $(".featured_container").addClass("container");

    };

    $('.builders-csp-slider').slick({
        centerMode: true,
        centerPadding: '180px',
        slidesToShow: 1,
        infinite: false,
        prevArrow: $('.prev-2'),
        nextArrow: $('.next-2'),
        speed: 900

    });
    /*if ($(".builders-csp-slider .item").hasClass("slick-active")) {
    	$(".item-contant").addClass("container");
    };*/

    $('.news-slide').slick({
        centerMode: true,
        centerPadding: '170px',
        slidesToShow: 1,
        infinite: false,
        prevArrow: $('.prev-3'),
        nextArrow: $('.next-3'),
        speed: 900

    });
    $('.slide-1').slick({
        infinite: true,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: false,
        prevArrow: $('.slide-1-prev'),
        nextArrow: $('.slide-1-next'),
        speed: 900

    });
    $('.slide-2').slick({
        infinite: true,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: false,
        prevArrow: $('.slide-2-prev'),
        nextArrow: $('.slide-2-next'),
        speed: 900

    });
    $('.slide-3').slick({
        infinite: true,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: false,
        prevArrow: $('.slide-3-prev'),
        nextArrow: $('.slide-3-next'),
        speed: 900
    });
    $('.slide-4').slick({
        infinite: true,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: false,
        prevArrow: $('.slide-4-prev'),
        nextArrow: $('.slide-4-next'),
        speed: 900

    });
    $('.tab-title-slide').slick({
        centerMode: true,
        infinite: false,
        slidesToShow: 4,
        infinite: true,
        prevArrow: $('.prev-tab-title'),
        nextArrow: $('.next-tab-title'),
        speed: 900,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    centerPadding: '80px',
                    centerMode: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
    }
   ]

    });
    if ($(window).width() <= 768) {
        $('.featurs-main').slick({
            centerMode: true,
            centerPadding: '10%',
            slidesToShow: 1,
            infinite: false,
            prevArrow: $('.prev-3'),
            nextArrow: $('.next-3'),
            speed: 900

        });
    }
    //sliders

//    $('selector').masonry()
//    $('.grid').masonry({
//        // options
//        itemSelector: '.grid-item',
//        columnWidth: 200
//    });

$('.popup-slide-1').slick({
    infinite: true,
    slidesToShow: 2,
    infinite: false,
    prevArrow: $('.slide-4-prev'),
    nextArrow: $('.slide-4-next'),
    speed: 900,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                centerMode: true,
                slidesToShow: 1
            }
    }
  ]
});
//drop down start

//drop down end


// tab section select
$(".property-search ul li a, .property-search .drop-down").hover(function () {
    $(".dropdown-overlay, .dropdown-overlay-2").toggleClass("show");
});

// dropdown z-index
$(".property-search ul li.dd-1").hover(function () {
    $(".property-search ul li.dd-1").toggleClass("show-1");
});
$(".property-search ul li.dd-2").hover(function () {
    $(".property-search ul li.dd-2").toggleClass("show-1");
});
$(".property-search ul li.dd-3").hover(function () {
    $(".property-search ul li.dd-3").toggleClass("show-1");
});
$(".property-search ul li.dd-4").hover(function () {
    $(".property-search ul li.dd-4").toggleClass("show-1");
});
$(".property-search ul li.dd-5").hover(function () {
    $(".property-search ul li.dd-5").toggleClass("show-1");
});

//scroll
$(window).scroll(function () {
    var windowYmax = 100;
    var scrolledY = $(window).scrollTop();

    if (scrolledY > windowYmax) {

        $('header').addClass("blue-bg");
    } else {
        $('header').removeClass("blue-bg");
    }
});

//tab signup
! function ($) {

    "use strict";

    // TABCOLLAPSE CLASS DEFINITION
    // ======================

    var TabCollapse = function (el, options) {
        this.options = options;
        this.$tabs = $(el);

        this._accordionVisible = false; //content is attached to tabs at first
        this._initAccordion();
        this._checkStateOnResize();


        // checkState() has gone to setTimeout for making it possible to attach listeners to
        // shown-accordion.bs.tabcollapse event on page load.
        // See https://github.com/flatlogic/bootstrap-tabcollapse/issues/23
        var that = this;
        setTimeout(function () {
            that.checkState();
        }, 0);
    };

    TabCollapse.DEFAULTS = {
        accordionClass: 'visible-xs',
        tabsClass: 'hidden-xs',
        accordionTemplate: function (heading, groupId, parentId, active) {
            return '<div class="panel panel-default">' +
                '   <div class="panel-heading">' +
                '      <h4 class="panel-title">' +
                '      </h4>' +
                '   </div>' +
                '   <div id="' + groupId + '" class="panel-collapse collapse ' + (active ? 'in' : '') + '">' +
                '       <div class="panel-body js-tabcollapse-panel-body">' +
                '       </div>' +
                '   </div>' +
                '</div>'

        }
    };

    TabCollapse.prototype.checkState = function () {
        if (this.$tabs.is(':visible') && this._accordionVisible) {
            this.showTabs();
            this._accordionVisible = false;
        } else if (this.$accordion.is(':visible') && !this._accordionVisible) {
            this.showAccordion();
            this._accordionVisible = true;
        }
    };

    TabCollapse.prototype.showTabs = function () {
        var view = this;
        this.$tabs.trigger($.Event('show-tabs.bs.tabcollapse'));

        var $panelHeadings = this.$accordion.find('.js-tabcollapse-panel-heading').detach();

        $panelHeadings.each(function () {
            var $panelHeading = $(this),
                $parentLi = $panelHeading.data('bs.tabcollapse.parentLi');

            var $oldHeading = view._panelHeadingToTabHeading($panelHeading);

            $parentLi.removeClass('active');
            if ($parentLi.parent().hasClass('dropdown-menu') && !$parentLi.siblings('li').hasClass('active')) {
                $parentLi.parent().parent().removeClass('active');
            }

            if (!$oldHeading.hasClass('collapsed')) {
                $parentLi.addClass('active');
                if ($parentLi.parent().hasClass('dropdown-menu')) {
                    $parentLi.parent().parent().addClass('active');
                }
            } else {
                $oldHeading.removeClass('collapsed');
            }

            $parentLi.append($panelHeading);
        });

        if (!$('li').hasClass('active')) {
            $('li').first().addClass('active')
        }

        var $panelBodies = this.$accordion.find('.js-tabcollapse-panel-body');
        $panelBodies.each(function () {
            var $panelBody = $(this),
                $tabPane = $panelBody.data('bs.tabcollapse.tabpane');
            $tabPane.append($panelBody.contents().detach());
        });
        this.$accordion.html('');

        if (this.options.updateLinks) {
            var $tabContents = this.getTabContentElement();
            $tabContents.find('[data-toggle-was="tab"], [data-toggle-was="pill"]').each(function () {
                var $el = $(this);
                var href = $el.attr('href').replace(/-collapse$/g, '');
                $el.attr({
                    'data-toggle': $el.attr('data-toggle-was'),
                    'data-toggle-was': '',
                    'data-parent': '',
                    href: href
                });
            });
        }

        this.$tabs.trigger($.Event('shown-tabs.bs.tabcollapse'));
    };

    TabCollapse.prototype.getTabContentElement = function () {
        var $tabContents = $(this.options.tabContentSelector);
        if ($tabContents.length === 0) {
            $tabContents = this.$tabs.siblings('.tab-content');
        }
        return $tabContents;
    };

    TabCollapse.prototype.showAccordion = function () {
        this.$tabs.trigger($.Event('show-accordion.bs.tabcollapse'));

        var $headings = this.$tabs.find('li:not(.dropdown) [data-toggle="tab"], li:not(.dropdown) [data-toggle="pill"]'),
            view = this;
        $headings.each(function () {
            var $heading = $(this),
                $parentLi = $heading.parent();
            $heading.data('bs.tabcollapse.parentLi', $parentLi);
            view.$accordion.append(view._createAccordionGroup(view.$accordion.attr('id'), $heading.detach()));
        });

        if (this.options.updateLinks) {
            var parentId = this.$accordion.attr('id');
            var $selector = this.$accordion.find('.js-tabcollapse-panel-body');
            $selector.find('[data-toggle="tab"], [data-toggle="pill"]').each(function () {
                var $el = $(this);
                var href = $el.attr('href') + '-collapse';
                $el.attr({
                    'data-toggle-was': $el.attr('data-toggle'),
                    'data-toggle': 'collapse',
                    'data-parent': '#' + parentId,
                    href: href
                });
            });
        }

        this.$tabs.trigger($.Event('shown-accordion.bs.tabcollapse'));
    };

    TabCollapse.prototype._panelHeadingToTabHeading = function ($heading) {
        var href = $heading.attr('href').replace(/-collapse$/g, '');
        $heading.attr({
            'data-toggle': 'tab',
            'href': href,
            'data-parent': ''
        });
        return $heading;
    };

    TabCollapse.prototype._tabHeadingToPanelHeading = function ($heading, groupId, parentId, active) {
        $heading.addClass('js-tabcollapse-panel-heading ' + (active ? '' : 'collapsed'));
        $heading.attr({
            'data-toggle': 'collapse',
            'data-parent': '#' + parentId,
            'href': '#' + groupId
        });
        return $heading;
    };

    TabCollapse.prototype._checkStateOnResize = function () {
        var view = this;
        $(window).resize(function () {
            clearTimeout(view._resizeTimeout);
            view._resizeTimeout = setTimeout(function () {
                view.checkState();
            }, 100);
        });
    };


    TabCollapse.prototype._initAccordion = function () {
        var randomString = function () {
            var result = "",
                possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (var i = 0; i < 5; i++) {
                result += possible.charAt(Math.floor(Math.random() * possible.length));
            }
            return result;
        };

        var srcId = this.$tabs.attr('id'),
            accordionId = (srcId ? srcId : randomString()) + '-accordion';

        this.$accordion = $('<div class="panel-group ' + this.options.accordionClass + '" id="' + accordionId + '"></div>');
        this.$tabs.after(this.$accordion);
        this.$tabs.addClass(this.options.tabsClass);
        this.getTabContentElement().addClass(this.options.tabsClass);
    };

    TabCollapse.prototype._createAccordionGroup = function (parentId, $heading) {
        var tabSelector = $heading.attr('data-target'),
            active = $heading.data('bs.tabcollapse.parentLi').is('.active');

        if (!tabSelector) {
            tabSelector = $heading.attr('href');
            tabSelector = tabSelector && tabSelector.replace(/.*(?=#[^\s]*$)/, ''); //strip for ie7
        }

        var $tabPane = $(tabSelector),
            groupId = $tabPane.attr('id') + '-collapse',
            $panel = $(this.options.accordionTemplate($heading, groupId, parentId, active));
        $panel.find('.panel-heading > .panel-title').append(this._tabHeadingToPanelHeading($heading, groupId, parentId, active));
        $panel.find('.panel-body').append($tabPane.contents().detach())
            .data('bs.tabcollapse.tabpane', $tabPane);

        return $panel;
    };



    // TABCOLLAPSE PLUGIN DEFINITION
    // =======================

    $.fn.tabCollapse = function (option) {
        return this.each(function () {
            var $this = $(this);
            var data = $this.data('bs.tabcollapse');
            var options = $.extend({}, TabCollapse.DEFAULTS, $this.data(), typeof option === 'object' && option);

            if (!data) $this.data('bs.tabcollapse', new TabCollapse(this, options));
        });
    };

    $.fn.tabCollapse.Constructor = TabCollapse;


}(window.jQuery);


$('#myTab, .popup-tab').tabCollapse();


// File Upload
// 
function ekUpload() {
    function Init() {

        console.log("Upload Initialised");

        var fileSelect = document.getElementById('file-upload'),
            fileDrag = document.getElementById('file-drag'),
            submitButton = document.getElementById('submit-button');

        fileSelect.addEventListener('change', fileSelectHandler, false);

        // Is XHR2 available?
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {
            // File Drop
            fileDrag.addEventListener('dragover', fileDragHover, false);
            fileDrag.addEventListener('dragleave', fileDragHover, false);
            fileDrag.addEventListener('drop', fileSelectHandler, false);
        }
    }

    function fileDragHover(e) {
        var fileDrag = document.getElementById('file-drag');

        e.stopPropagation();
        e.preventDefault();

        fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
    }

    function fileSelectHandler(e) {
        // Fetch FileList object
        var files = e.target.files || e.dataTransfer.files;

        // Cancel event and hover styling
        fileDragHover(e);

        // Process all File objects
        for (var i = 0, f; f = files[i]; i++) {
            parseFile(f);
            uploadFile(f);
        }
    }

    // Output
    function output(msg) {
        // Response
        var m = document.getElementById('messages');
        m.innerHTML = msg;
    }

    function parseFile(file) {

        console.log(file.name);
        output(
            '<strong>' + encodeURI(file.name) + '</strong>'
        );

        // var fileType = file.type;
        // console.log(fileType);
        var imageName = file.name;

        var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
        if (isGood) {
            document.getElementById('start').classList.add("hidden");
            document.getElementById('response').classList.remove("hidden");
            document.getElementById('notimage').classList.add("hidden");
            // Thumbnail Preview
            document.getElementById('file-image').classList.remove("hidden");
            document.getElementById('file-image').src = URL.createObjectURL(file);
        } else {
            document.getElementById('file-image').classList.add("hidden");
            document.getElementById('notimage').classList.remove("hidden");
            document.getElementById('start').classList.remove("hidden");
            document.getElementById('response').classList.add("hidden");
            document.getElementById("file-upload-form").reset();
        }
    }

    function setProgressMaxValue(e) {
        var pBar = document.getElementById('file-progress');

        if (e.lengthComputable) {
            pBar.max = e.total;
        }
    }

    function updateFileProgress(e) {
        var pBar = document.getElementById('file-progress');

        if (e.lengthComputable) {
            pBar.value = e.loaded;
        }
    }

    function uploadFile(file) {

        var xhr = new XMLHttpRequest(),
            fileInput = document.getElementById('class-roster-file'),
            pBar = document.getElementById('file-progress'),
            fileSizeLimit = 1024; // In MB
        if (xhr.upload) {
            // Check if file is less than x MB
            if (file.size <= fileSizeLimit * 1024 * 1024) {
                // Progress bar
                pBar.style.display = 'inline';
                xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
                xhr.upload.addEventListener('progress', updateFileProgress, false);

                // File received / failed
                xhr.onreadystatechange = function (e) {
                    if (xhr.readyState == 4) {
                        // Everything is good!

                        // progress.className = (xhr.status == 200 ? "success" : "failure");
                        // document.location.reload(true);
                    }
                };

                // Start upload
                xhr.open('POST', document.getElementById('file-upload-form').action, true);
                xhr.setRequestHeader('X-File-Name', file.name);
                xhr.setRequestHeader('X-File-Size', file.size);
                xhr.setRequestHeader('Content-Type', 'multipart/form-data');
                xhr.send(file);
            } else {
                output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
            }
        }
    }

    // Check for the various File API support.
    if (window.File && window.FileList && window.FileReader) {
        Init();
    } else {
        document.getElementById('file-drag').style.display = 'none';
    }
}
//ekUpload();



/********* Preferred Slider for Mobile  *******************/

$('.PreferredSliderMob .slider-nav').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   dots: true,
   focusOnSelect: true
 });

$('.PreferredSliderMob a[data-slide]').click(function(e) {
   e.preventDefault();
   var slideno = $(this).data('slide');
   $('.slider-nav').slick('slickGoTo', slideno - 1);
});

/********* Ends Preferred Slider for Mobile  *******************/
