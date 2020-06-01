<?php

/**
 * Three column titles Block
 */

namespace EDA\Blocks;

use Timber;

class ThreeColTitlesBlock {

    /**
     *  Initialization
     */
    public static function bootstrap() {
        add_action( 'acf/init', [ __CLASS__, 'acf_three_col_titles_init' ] );
    }

    public static function acf_three_col_titles_init(){
    
        // check function exists
        if( function_exists( 'acf_register_block' ) ) {
            
            // register a testimonial block
            acf_register_block( array(
                'name'				=> 'three-col-titles',
                'title'				=> __( 'Three column titles' ),
                'description'		=> __( 'Three column titles.' ),
                'render_callback'	=> [ __CLASS__, 'three_col_titles_acf_block_render_callback' ],
                'category'			=> 'formatting',
                'keywords'			=> [ 'item' ],
                'mode'              => 'edit',
            ) );
            
        }

    }

    /**
     *  This is the callback that displays the block.
     *
     * @param   array  $block      The block settings and attributes.
     * @param   string $content    The block content (emtpy string).
     * @param   bool   $is_preview True during AJAX preview.
     */
    public static function three_col_titles_acf_block_render_callback( $block, $content = '', $is_preview = false ) {
        
        $context                = Timber::context();
        $context[ 'block' ]     = $block;
        $context[ 'fields' ]    = get_fields();        
    
        // Render the block.
        Timber::render( 'blocks/three-col-titles-block.twig', $context );

    }

}