// declaring strict mode
//"use strict";

var $ = jQuery;

var APP = {

	isTablet : false,


	/*-- Functions called when a new instance is created --*/
	init : function() 
	{

		APP.detect_device_type();
		APP.on_window_resize();
		APP.svgs();
        APP.main_menu();
		
    },

    
    /**
     * Main menu
     */
    main_menu : function(){
		
		$( ".js-menu-open" ).on( "click", function( e ){

			e.preventDefault();

			var $menu = $( ".js-menu" );
			$menu.addClass( "open" );
		} );

		$( ".js-menu-close" ).on( "click", function( e ){

			e.preventDefault();

			var $menu = $( ".js-menu" );
			$menu.removeClass( "open" );
		} );

		$( window ).resize( function(){
			if ( ! APP.isTablet ){
				var $menu = $( ".js-menu" );
				$menu.removeClass( "open" );				
			}
		});

	},
	
	sticky_header : function(){

		
		$( window ).scroll( function(){
			if ( $( window ).scrollTop() > 10 ){
				$( ".js-header" ).addClass( "c-header--open" );
				$( ".js-header-nav" ).addClass( "c-nav--shrink" );
				$( ".js-logo" ).addClass( "c-logo--shrink" );
			}
			else {
				$( ".js-header" ).removeClass( "c-header--open" );
				$( ".js-header-nav" ).removeClass( "c-nav--shrink" );
				$( ".js-logo" ).removeClass( "c-logo--shrink" );
			}
		} );

	},
   


	/*-- Scroll page to the selected section --*/
	scroll_to_section : function( $offset ){

		$( document ).on( "click", "a[href*='#']", function( e ){

			e.preventDefault();

			var $this 	= $( this ),
				$hash 	= $this.attr( "href" );

			if ( !$( $hash ).length )
				return;

			var $section_position = $( $hash ).offset().top,
				$header_offset 	  = $offset; // ie fix - $( ".page-header" ).outerHeight( true ) - 20;

			$( "html, body" ).stop().animate( {
					scrollTop : ( $section_position - $header_offset ) + "px"
				}, 800 );

		});

	},




	/*-- Replace images with inline SVG --*/
	svgs : function() {

		$( "img.svg" ).each( function() {

		    var $img 		= jQuery( this );
		    var imgID 		= $img.attr( "id" );
		    var imgClass 	= $img.attr( "class" );
		    var imgURL 		= $img.attr( "src" );
		    var style 		= $img.attr( "style" );

		    jQuery.get( imgURL , function( data )
		    {
		    	// get the SVG tag, ignore the rest
		        var $svg = jQuery( data ).find( "svg" );

		        // add replaced image's ID to the new SVG
		        if( typeof imgID !== "undefined" )
		        {
		            $svg = $svg.attr( "id" , imgID );
		        }

		        // add replaced image's classes to the new SVG
		        if( typeof imgClass !== "undefined" )
		        {
		            $svg = $svg.attr( "class" , imgClass + " replaced-svg" );
		        }

		        if( typeof style !== "undefined" )
		        {
		            $svg.find( "path" ).attr( "style" , style);
		        }

		        // remove any invalid XML tags as per http://validator.w3.org
		        $svg = $svg.removeAttr( "xmlns:a" );

		        // replace image with new SVG
		        $img.replaceWith( $svg );

		    } , "xml" );

		} );

	},





	/**
     * Call functions when browser window is resized
     */
    on_window_resize: function(){
    
        $( window ).on( 'resize' , function(){
            
            APP.detect_device_type();
        
        } );

    },


    /**
     * Detect device type by user agent or browser window width
     * 
     * @returns {bool} true|false
     */
    detect_device_type: function () {
        
        //if user on mobile or small browser width
        if ( $( window ).innerWidth() <= 720 ){ 
           	APP.isTablet = true;
        }
        else{
			APP.isTablet = false;
		}

    },


};



/**
 * Start Main class
 */
$( document ).ready( function() {	

	// Handler for .ready() called.
	APP.init();

} );