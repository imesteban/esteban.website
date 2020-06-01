<?php

/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
	
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	});

	add_filter('template_include', function( $template ) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

use Timber\Twig_Function;

/**
 * Add Constants
 */
require_once 'constants.php';


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class Website extends Timber\Site {
	
	/** Add timber support. */
	public function __construct() {

		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		parent::__construct();

	}
	

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		
		// acf option page
		$context[ "options" ] 	 	= get_fields( "options" );
		
		// urls
		$context[ "images_url" ] 	= IMAGES_URL;
		$context[ "ajax_url" ] 		= admin_url( 'admin-ajax.php' );

		// menus
		$context[ "main_menu" ] 	= new Timber\Menu( "Main menu" );
		$context[ "footer_menu" ] 	= new Timber\Menu( get_field( "footer_menu", "option" ) );
		$context[ "website_menu" ] 	= new Timber\Menu( get_field( "website_menu", "option" ) );

		// site
		$context[ "site" ] 			= $this;

		return $context;

	}


	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig_Extension_StringLoader() );

		// Get Timber Menu by name
		$twig->addFunction( new Timber\Twig_Function( 'get_menu', array( $this, 'get_menu' ) ) );
		// Add content to footer
		$twig->addFunction( new Timber\Twig_Function( 'add_to_footer', array( $this, 'add_to_footer' ) ) );

		return $twig;
	}


	/**
	 * Get Timber Menu by name
	 *
	 * @param  mixed $name
	 *
	 * @return void
	 */
	function get_menu( $name ) {
			
		return new Timber\Menu( $name );
	}


	/**
	 * Add content to footer, after wp_footer scripts
	 *
	 * @param  mixed $content
	 *
	 * @return void
	 */
	function add_to_footer( $content ){
		
		add_action( 'wp_footer', function() use ( $content ) {
            echo $content;
		}, 100 );
		
	}	

}

new Website();

require_once INCLUDES_DIR . '/namespace.php';