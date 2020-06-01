<?php

/**
 * Posts
 */

namespace EDA\Models;

use Timber;


class PostsModel {

	const POST_TYPE     = "post";


	public static function bootstrap(){
    
    }



    /**
     *  Get post by ID
     */
    public static function get_by_id( $post_id )
    {
        $the_post = Timber::get_post( $post_id );

        return $the_post;

    }    



    /**
     *  Get all the post years in a array
     *
     */
    public static function get_years(){

        $years  = array();

        $args   = array( 
            "post_type"   => self::POST_TYPE,
            "post_status" => "publish",
            "orderby"     => "date",
            "order"       => "DESC",
            "posts_per_page" => -1, // all
        );
        $posts  = Timber::get_posts( $args );

        foreach( $posts as $post_item ) {
            $year = substr(  $post_item->post_date, 0, 4 );
            if ( ! in_array( $year , $years ) ) {
                $years[] = $year;
            }
        }

        return $years;

    }



    public static function get_featured(){

        $args = array(
            'posts_per_page'      => 1,
            'post__in'            => get_option( 'sticky_posts' ),
            'ignore_sticky_posts' => 1
        );

        $featured = Timber::get_posts( $args );

        return $featured;

    }  


    public static function get_all( $ppp = -1, $paged = 0, $custom_args = array() ) {

        $args = wp_parse_args( $custom_args , array(
            
            "post_type"      => self::POST_TYPE,
            "post_status"    => "publish",
            "posts_per_page" => $ppp,
            "paged"          => $paged,
            "orderby"        => "date",
            "order"          => "DESC",

        ) );

        $news = new Timber\PostQuery( $args );

        return $news;

    } 


    public static function get_categories(){
        
        return Timber::get_terms( array(

            'taxonomy'   => 'category',
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => true,

        ) );

    }

}