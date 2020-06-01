<?php

/**
 * Assets
 */

namespace EDA;

class Assets {

    public static function bootstrap(){
        
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'add_scripts' ] );
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'add_stylesheets' ] );

    }


    /**
     * Add Stylesheets
     */
    public static function add_stylesheets()
    {
        // Debug
        $min = ( ! WP_DEBUG ) ? ".min" : "";

        // Main
        wp_register_style( 'main-stylesheet',  CSS_URL ."/main{$min}.css", false, THEME_VERSION );
        wp_enqueue_style( 'main-stylesheet' );
    }


   
    /**
     * Add Scripts
     */
    public static function add_scripts()
    {
        
        // Debug
        $min = ( ! WP_DEBUG ) ? ".min" : "";

        // Main
        wp_enqueue_script( 'main-script', JS_URL ."/main{$min}.js", array( 'jquery' ), THEME_VERSION, true );

    }


    /**
     * Add Magnific Popup Script
     */
    public static function load_magnific_popup_script(){

        // Magnific Popup
        wp_register_style( "magnificpopup-stylesheet",  CSS_URL ."/vendor/magnific-popup.css" );
        wp_enqueue_style( "magnificpopup-stylesheet" );

        // Magnific Popup
        wp_enqueue_script( 'magnificpopup-script', JS_URL ."/vendor/jquery.magnific-popup.min.js", array( 'jquery' ), null, true );
    
    }


    /**
     * Add MatchHeight Script
     */
    public static function load_match_height_script(){

        // Match Height
        wp_enqueue_script( 'matchheight-script', JS_URL ."/vendor/jquery.matchHeight.js", array( 'jquery' ), null, true );
    
    }


    /**
     * Add custom Script for Google Maps
     */
    public static function load_google_maps_script(){

        $min = ( ! WP_DEBUG ) ? ".min" : "";
        // Map
        wp_enqueue_script( 'map-script', JS_URL ."/map{$min}.js", array( 'jquery' ), THEME_VERSION, true );
    
    }


    /**
     * Add HC Sticky script
     */
    public static function load_hc_sticky_script(){

        // HC Sticky
        wp_enqueue_script( 'sticky-script', JS_URL ."/vendor/hc-sticky.js", array( 'jquery' ), null, true );

    }


    /**
     * Add calendar scripts
     */
    public static function load_calendar_scripts() {

        // Moment JS
        wp_enqueue_script( 'moment-script', JS_URL ."/vendor/moment.js", array( 'jquery' ), null, true );

        // Underscore JS
        wp_enqueue_script( 'underscore-script', JS_URL ."/vendor/underscore-min.js", array( 'jquery' ), null, true );

        // Calendar Clndr JS
        wp_enqueue_script( 'clndr-script', JS_URL ."/vendor/clndr.min.js", array( 'jquery', 'moment-script', 'underscore-script' ), null, true );
    
    }


    /**
     * Add Scroll Reveal script
     */
    public static function load_scroll_reveal_script(){

        wp_enqueue_script( 'scrollreveal-script', JS_URL ."/vendor/scrollreveal.min.js", array( 'jquery' ), null, true );
    }

    /**
     * Add FitVids script
     */
    public static function load_fitvids_script(){

        wp_enqueue_script( 'fitvids-script', JS_URL ."/vendor/jquery.fitvids.js", array( 'jquery' ), null, true );
    } 


    public static function load_aos_library(){

        // AOS stylesheet
        wp_register_style( "aos-stylesheet",  CSS_URL ."/vendor/aos.css" );
        wp_enqueue_style( "aos-stylesheet" );

        // AOS script
        wp_enqueue_script( 'aos-script', JS_URL ."/vendor/aos.js", array( 'jquery' ), null, true );

    }

}