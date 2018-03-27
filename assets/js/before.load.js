var $ = jQuery.noConflict();
var navigationStyle;
$(document).ready(function($) {    
    "use strict";

    var $body = $('body');

    if( $body.hasClass('navigation-top-header') ) {
        $( ".main-navigation.navigation-top-header" ).load( "assets/external/_navigation.html" );

		navigationStyle = "topHeader";
    }
    else if( $body.hasClass('navigation-off-canvas') ) {
        $( ".main-navigation.navigation-off-canvas" ).load( "assets/external/_navigation.html" );
		navigationStyle = "offCanvas";
    }
    mobileNavigation();
});

$(window).resize(function(){
    mobileNavigation();
});

// Navigation on small screen ------------------------------------------------------------------------------------------

function mobileNavigation(){
    if( $(window).width() < 979 ){
        //$(".main-navigation.navigation-top-header").remove();
        $(".main-navigation.navigation-top-header").css("display","block");
        $(".toggle-navigation").css("display","inline-block");
        $(".main-navigation.navigation-off-canvas").load("assets/external/_navigation.html");
        $("body").removeClass("navigation-top-header");
        $("body").addClass("navigation-off-canvas");
    }
	else {
		if( navigationStyle == "topHeader" ){
			$( ".main-navigation.navigation-top-header" ).load( "assets/external/_navigation.html" );
			$("body").removeClass("navigation-off-canvas");
			$("body").addClass("navigation-top-header");
			$(".main-navigation.navigation-top-header").css("display","inline-block");
			$(".toggle-navigation").css("display","none");
		}else {
			$( ".main-navigation.navigation-off-canvas" ).load( "assets/external/_navigation.html" );
		}
	}
}

// Toggle off canvas navigation ----------------------------------------------------------------------------------------

$('.toggle-navigation-wixplor').on( "click", function() {

    var width = $( window ).width();
    console.log(width);
    if(width <= 500){
        $('#outer-wrapper').toggleClass('show-nav');
        $(".main-header").toggleClass('hide');
        $(".off-canvas-navigation").toggleClass('left-wing');
        $("#page-content").toggleClass('margin-on-wing');

        var toggler = $('body').find('div#toggle-navigation-wixplor-dynamic').attr('toggler');
        if(toggler != 'dynamic'){
            $('body').find('div#toggle-navigation-wixplor-dynamic').on( "click", function() {
                $(this).attr('toggler',"dynamic");
                $('#outer-wrapper').toggleClass('show-nav');
                $(".main-header").toggleClass('hide');
                $(".off-canvas-navigation").toggleClass('left-wing');
                $("#page-content").toggleClass('margin-on-wing');
            });
        }
    }


});



$('#page-content').on( "click", function() {
	if( $('body').hasClass('navigation-off-canvas') ){
		$('#outer-wrapper').removeClass('show-nav');
	}
});
