<?php

/**
 * Yoast
 */

namespace EDA;


class Yoast {

    public static function bootstrap() {

        add_filter( 'wpseo_breadcrumb_single_link', [ __CLASS__, 'remove_last_item' ] );

    }

    /**
     * Remove last item from breadcrumb
     *
     * @param  string $link_output
     *
     * @return string Output
     */
    public static function remove_last_item( $link_output ) {

        if ( strpos( $link_output, 'breadcrumb_last' ) !== false ) {
            $link_output = '';
        }
        
        return $link_output;
    }


    /**
     * Get Yoast breadcrumb
     *
     * @return string Breadcrumb output
     */
    public static function get_breadcrumb(){

        if ( function_exists( 'yoast_breadcrumb' ) ) {
            return yoast_breadcrumb( '<div class="c-breadcrumb">','</div>', false );
        }
    }

}