<?php

/**
 * Default Page Context
 */

namespace EDA\Contexts;

use Timber;

class PageContext {

	/**
	 *	@return array
	 */
	public static function get_context() {

		// context
        return wp_parse_args( [
            "post"                  => new Timber\Post(),
		], Timber::context() );

	}

}