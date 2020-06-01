<?php

/**
 * Image Manager
 */


namespace EDA;

class ImageManager {


    public static function bootstrap(){

        self::register_image_sizes();

    }

    /**
     *  Add Image Sizes
     */
    public static function register_image_sizes () {

        add_image_size( 'fullscreen', 2560, 9999 );
        add_image_size( 'halfscreen', 1280, 9999 );
        add_image_size( 'post-image', 800, 9999 );

    }

}