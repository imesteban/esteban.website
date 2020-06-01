<?php

/**
 * Wordpress
 */

namespace EDA;


class Wordpress {

	public static function bootstrap(){

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		add_theme_support( 'menus' );        

		/**
         * Upload SVGs through the media uploader
         */
        add_filter( 'upload_mimes' , [ __CLASS__, 'cc_mime_types' ] );

        /**
         * Add Post Thumbnail theme support
         */
        add_theme_support( 'post-thumbnails' );

        /**
         * Disable admin bar on the front end 
         */
        add_filter( 'show_admin_bar', '__return_false' );  

        /**
         * Remove some menu items
         */        
        add_action( 'admin_menu', [ __CLASS__, 'remove_wordpress_items' ] );   


        /**
         * Disable Emojis
         */
        add_action( 'init', [ __CLASS__, 'disable_emojis' ] );     

        
        /**
         * Editor's settings
         */
        add_action( 'after_setup_theme', [ __CLASS__, 'eda_disable_gutenberg_colour_settings' ] );
        add_action( 'after_setup_theme', [ __CLASS__, 'eda_disable_gutenberg_text_settings' ] );
        add_filter( 'allowed_block_types', [ __CLASS__, 'eda_allowed_block_types' ], 10, 2 );
        
    }


    /**
     * Enable only these block types
     */ 
    public static function eda_allowed_block_types( $allowed_block_types, $post ) {

        return array( 
                'acf/big-text',
                'acf/three-col-content',
                'acf/three-col-titles',
                'acf/flag',
                'core/paragraph',
                'core/image',
                'core/list',
                'core/heading',
                'core/quote',
        );

    }    


    /**
     * Disable the editor's text settings
     */ 
    public static function eda_disable_gutenberg_text_settings(){

        add_theme_support( 'disable-custom-font-sizes' );

    }

    /**
     * Disable the Gutenberg's colour settings entirely
     */    
    public static function eda_disable_gutenberg_colour_settings() {
        
        add_theme_support( 'disable-custom-colors' );
        add_theme_support( 'editor-color-palette' );

    }


	/**
    * Allow SVG through WordPress Media Uploader
    */
    public static function cc_mime_types( $mimes )
    {

        // Vector/Image formats
        $mimes[ 'svg' ] = 'image/svg+xml';

        return $mimes;

    }


    /**
    * Remove some menu items
    */
    public static function remove_wordpress_items()
    {
        remove_menu_page( 'edit.php' );  // Posts
        remove_menu_page( 'edit-comments.php' );  // Comments

    }


    /**
     * Disable the emoji's
     */
    public static function disable_emojis() {

        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        
        add_filter( 'tiny_mce_plugins', [ __CLASS__, 'disable_emojis_tinymce' ] );
        add_filter( 'wp_resource_hints', [ __CLASS__, 'disable_emojis_remove_dns_prefetch' ], 10, 2 );
    
    }
   
   
   /**
    * Filter function used to remove the tinymce emoji plugin.
    * 
    * @param array $plugins 
    * @return array Difference betwen the two arrays
    */
    public static function disable_emojis_tinymce( $plugins ) {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
            return [];
        }
   }
   
   /**
    * Remove emoji CDN hostname from DNS prefetching hints.
    *
    * @param array $urls URLs to print for resource hints.
    * @param string $relation_type The relation type the URLs are printed for.
    * @return array Difference betwen the two arrays.
    */
    public static function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
        if ( 'dns-prefetch' == $relation_type ) {
            /** This filter is documented in wp-includes/formatting.php */
            $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
    
            $urls = array_diff( $urls, [ $emoji_svg_url ] );
        }
   
        return $urls;
   }

}