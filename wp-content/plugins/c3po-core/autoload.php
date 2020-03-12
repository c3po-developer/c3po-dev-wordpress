<?php 

/**
 * C3PO Core autoloader
 *   
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

// Autoloader PSR-4
spl_autoload_register( function ( $class ) 
{
    $file_class = dirname( __FILE__ ) . '/' . str_replace( '\\', '/', $class ) . '.php';

    if( file_exists( $file_class ) ){

        try {

            // Check file class
            if( @!include( $file_class ) )
                throw new Exception( $file_class . ' not found' );

        } catch (Exception $exception ) {

            echo $exception->getMessage();

        }

    }

});

// EOF
