<?php

/**
 * Shortcodes
 */

namespace EDA;

use Timber;


class Shortcodes {

    /**
     * Initialization
     *
     * @return void
     */
    public static function bootstrap() {

        add_shortcode( 'shortcode_item', [ __CLASS__, 'shortcode_item_shortcode' ] );

    }


    /**
     * Get [shortcode_item] shortcode from editor and display it. 
     *
     * @param  mixed $atts
     *
     * @return void
     */
    public static function shortcode_item_shortcode( $atts ) {

        global $post;

        // gets an acf from the current page
        $shortcode_item = get_field( "shortcode_item", $post->ID );

        // display a block of html
        return Timber::compile( 'components/shortcode_item.twig', [ 'shortcode_item' => $shortcode_item ] );

    }
   
}