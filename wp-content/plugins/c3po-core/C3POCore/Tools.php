<?php

/**
 * C3PO Core Class Tools
 *  
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

namespace C3POCore;

class Tools {
    
    /**
     * Write on document a pre print_r return only if debug mode is on.
     * 
     * @param   (mixed)    (Optional)  Value to represent on browser.
     * 
     * @return (array)  Print value parameter with html pre tags include
     *   
    */
    public static function print_r( $value )
    {
        
        if( self::get_mode_debug() ) {

            echo '<pre>';

            print_r( $value );

            echo '</pre>';

        }
        

    }

    public static function get_server_dev()
    {

        $my_ip = $_SERVER['SERVER_ADDR'];

        if( '192.168.1.254' === $my_ip ) {

                return true;

        }

        return false;

    }
 
    public static function get_mode_debug()
    {

        return ( get_option( 'c3po_core_debug_mode', '' ) ) ? true : false;

    }

}

// EOF
