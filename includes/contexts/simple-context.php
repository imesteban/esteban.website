<?php

/**
 * Simple Context
 */

namespace EDA\Contexts;

use Timber;

class SimpleContext {

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