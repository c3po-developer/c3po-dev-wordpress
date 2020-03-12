<?php

/**
 * C3PO Core Class CPT
 *  
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

namespace C3POCore;

class CPT {

    // Añade un custom post type a WordPress
    public static function build( $name, $collection )
    {

        add_action( 'init', function() use ($name, $collection ){
            
            register_post_type( $name, $collection );

        }); 

    }

    public static function hide( $ctps )
    {
        
        add_action('wp', function () use ($ctps) {
    
            $disable_singles = array( $ctps['name'] );
            
            if( is_singular( $disable_singles ) ) {

                wp_redirect( $ctps['url']  , 301 );

            };
                

        });

    }

}
    