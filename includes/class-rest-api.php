<?php

/**
 * Rest API
 */

namespace EDA;

class RestAPI {

    public static function bootstrap() {

        // registering an API route
        add_action( 'rest_api_init', [ __CLASS__, 'register_route' ] ); 

    }

        
    /**
     * Register a custom API route
     *
     * @return void
     */
    static function register_route() {

        register_rest_route( 'restapi', '/contact-esteban', array(
                        'methods' => 'GET',
                        'callback' => [ __CLASS__, "contact_details" ]
                    )
                );
    }

        
    /**
     * Retrieve developer's contact details to be used on client websites
     *
     * @return void
     */
    static function contact_details() {

        $output = [
            "href"  => "mailto:contact@esteban.website",
            "title" => "EwD",
        ];

        return rest_ensure_response( $output );

    }

}