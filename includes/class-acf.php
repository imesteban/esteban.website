<?php

/**
 * ACF
 */

namespace EDA;

class ACF {

    public static function bootstrap() {

        /**
         * Creates an Options page
         */
        add_action( 'after_setup_theme', [ __CLASS__, 'register_option_pages' ], 20 );

        /**
         * Populate these fields with the menus
         */ 
        add_filter( 'acf/load_field/name=footer_menu', [ __CLASS__, 'acf_populate_menu' ] );
        add_filter( 'acf/load_field/name=website_menu', [ __CLASS__, 'acf_populate_menu' ] );

    }


    /**
     *  Register an ACF Options Page
     */
    public static function register_option_pages() {

        // creates an options page
        if( function_exists( 'acf_add_options_page' ) ) {
            
            // add parent
            $parent = acf_add_options_page(array(
                'menu_title'    => 'Options',
                'redirect'      => true
            ));

            acf_add_options_sub_page(array(
                'page_title'    => 'Template Settings',
                'menu_title'    => 'Templates',
                'parent_slug'   => $parent[ 'menu_slug' ],
            ));

            acf_add_options_sub_page(array(
                'page_title'    => 'Footer Settings',
                'menu_title'    => 'Footer',
                'parent_slug'   => $parent[ 'menu_slug' ],
            ));            

            acf_add_options_sub_page(array(
                'page_title'    => 'Contact Settings',
                'menu_title'    => 'Contact info',
                'parent_slug'   => $parent[ 'menu_slug' ],
            ));

            acf_add_options_sub_page(array(
                'page_title'    => 'Social Network Settings',
                'menu_title'    => 'Social',
                'parent_slug'   => $parent[ 'menu_slug' ],
            ));

            acf_add_options_sub_page(array(
                'page_title'    => 'SEO Settings',
                'menu_title'    => 'SEO',
                'parent_slug'   => $parent[ 'menu_slug' ],
            ));
        
        }

    }


    /**
     * Populate ACF menu <select> with wp menus ids
     */
    public static function acf_populate_menu( $field ) {
        
        $field[ 'choices' ]   = array();
        $menus                = get_terms( 'nav_menu' );
        $field[ 'choices' ][ "-1" ] = "No menu";
        foreach( $menus as $m ){
            $field[ 'choices' ][ $m->name ] = $m->name;
        }
        
        return $field;
        
    }

}