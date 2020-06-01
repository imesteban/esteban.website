<?php

/**
 * Big text Block
 */

namespace EDA\Blocks;

use Timber;

class BigTextBlock {

    /**
     *  Initialization
     */
    public static function bootstrap() {
        add_action( 'acf/init', [ __CLASS__, 'acf_big_text_init' ] );
    }

    public static function acf_big_text_init(){
    
        // check function exists
        if( function_exists( 'acf_register_block' ) ) {
            
            // register a testimonial block
            acf_register_block( array(
                'name'				=> 'big-text',
                'title'				=> __( 'Big text' ),
                'description'		=> __( 'Paragraph of text with a big font size.' ),
                'render_callback'	=> [ __CLASS__,'big_text_acf_block_render_callback' ],
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
    public static function big_text_acf_block_render_callback( $block, $content = '', $is_preview = false ) {
        
        $context                = Timber::context();
        $context[ 'block' ]     = $block;
        $context[ 'fields' ]    = get_fields();
    
        // Render the block.
        Timber::render( 'blocks/big-text-block.twig', $context );

    }

}