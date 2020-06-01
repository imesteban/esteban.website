<?php

/**
 * Contact Context
 */

namespace EDA\Contexts;

use Timber;

class ContactContext extends BaseContext {

	/**
	 * @return array
	 */
	public static function get_context() {

        // context
        return wp_parse_args( [
			"post"  => new Timber\Post(),
        ], Timber::context() );

	}


}