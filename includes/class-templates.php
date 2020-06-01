<?php

/**
 * Templates customisation
 */

namespace EDA;

class Templates {

	public static function bootstrap() {

		$template_types = array(
			'front-page', 	// homepage
			'home', 		// posts page
			'single',
			'page',
			'search',
			'archive',
			'category',
			'404',
			'index',
			'taxonomy',
		);

		foreach ( $template_types as $template_type ) {
			add_filter( "{$template_type}_template_hierarchy", array( __CLASS__, 'migrate_template_paths' ) );
		}

	}


	/**
	 * Return the path of the Controller that matches the Wordpress Template file
	 * @param array $templates
	 *
	 * @return array
	 */
	public static function migrate_template_paths( $templates = [] ) {

		if ( ! is_page_template() ) {
			foreach ( $templates as &$template ) {
				$template = "controllers/{$template}";
			}
		}
		
		return $templates;
	
	}

}