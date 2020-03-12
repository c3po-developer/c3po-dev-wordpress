<?php

/**
 * C3PO Core Class Loader
 *  
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

namespace C3POCore;

class Loader {
    
    /**
     * Register css stylesheet to WordPress enqueue
     *
     * Use:
     *
     * <!-- CSS -->
     * <?php
     *     \C3POCore\Loader::load_enqueue_css(
     *         array (
     *             array (
     *                 'handler'   => 'style',
     *                 'src'       => '/style.css',
     *                 'version'   => '1'
     *             ),
     *             array (...)
     *         )
     *     );
     * ?>
     *
     * @param (array) $collection_css  Array css files
     * 
     * (string) handler    (Required)  Name of the script. Should be unique.
     *
     * (string) src        (Required)  Full URL of the script, or path of the script relative to the WordPress root directory.
     *
     * (array) version     (Optional)  String specifying script version number, if it has one, which is added to the URL
     *                                 as a query string for cache busting purposes. If version is set to false,
     *                                 a version number is automatically added equal to current installed WordPress version.
     *                                 If set to null, no version is added.
     *
     */
    public static function load_enqueue_css( $collection_css, $level = 99 )
    {

        try {
           
          

            foreach ( $collection_css as $stylesheet ){

                // If empty, returns.
                if( count( $stylesheet ) === 0 )
                    return;
                
                // Check if handler of stylesheet is defined
                if ( !isset ( $stylesheet['handler'] ) )
                    throw new \Exception( 'Error: the <b>stylesheet handler</b> must be defined' );

                // Check if source of stylesheet is defined
                if ( !isset ( $stylesheet['src'] ) )
                    throw new \Exception( 'Error: the <b>stylesheet source</b> must be defined' );

                $stylesheet_version = ( isset ( $stylesheet['version'] ) && !empty ( $stylesheet['version'] ) ) ?
                        $stylesheet['version'] :
                        mt_rand( 0, 999 ) ;

                add_action( 'wp_enqueue_scripts', function() use ( $stylesheet, $stylesheet_version ) {

                    wp_enqueue_style(
                        $stylesheet['handler'],
                        $stylesheet['src'],
                        array (),
                        $stylesheet_version,
                        ''
                    );
                    
                }, $level );
               
            }

        } catch (\Exception $e ) {
            
            echo '<div style="padding: 5px 10px; background:#c1c1c1;font-family:monospace">';
            
            echo '<b>C3PO Exception</b></br>';

            echo $e->getMessage();

            echo '</div>';

        }
    }

    /**
     * Register js scripts to WordPress enqueue
     *
     * Use:
     *
     * <!-- JS -->
     * <?php
     *     \C3POCore\Loader::load_enqueue_js(
     *         array (
     *             array (
     *                 'handler'    => 'theme',
     *                 'src'        => '/js/theme.jquery.js',
     *                 'version'    => '1',
     *                 'in_footer'  => true
     *             ),
     *             array (...)
     *         )
     *     );
     * ?>
     *
     * @param (array) $collection_js 
     *
     * (string) handle      (Required)  Name of the script. Should be unique.
     *      
     * (string) source      (Required)  Full URL of the script, or path of the script relative to the WordPress root directory.
     *   
     * (array) version      (Optional)  String specifying script version number, if it has one, which is added to the URL
     *                                  as a query string for cache busting purposes. If version is set to false,
     *                                  a version number is automatically added equal to current installed WordPress version.
     *                                  If set to null, no version is added.
     * 
     * (string) in_footer   (Optional)  Whether to enqueue the script before </body> instead of in the <head>. Default 'false'.
     *
     */
    public static function load_enqueue_js( $collection_js, $level = 1 )
    {
       
        try {

            foreach ( $collection_js as $script ) {
                
                // Check if handler of stylesheet is defined
                if ( !isset ( $script['handler'] ) )
                    throw new \Exception( 'Error: the <b>Js handler</b> must be defined' );

                // Check if source of stylesheet is defined
                if ( !isset ( $script['src'] ) )
                    throw new \Exception( 'Error: the <b>Js source</b> must be defined' );

                $js_version = ( isset ( $script['version'] ) && !empty ( $script['version'] ) ) ?
                        $script['version'] :
                        mt_rand( 0, 999 );


                add_action('wp_enqueue_scripts', function( ) use ($script, $js_version){

                    if ( isset( $script['template'] ) && !is_page_template( $script['template'] ) ) {
 
                        return false;

                    }

                    wp_enqueue_script(
                        $script['handler'],
                        $script['src'],
                        array (),
                        $js_version,
                        $script['in_footer'] 
                    );

                });
                 
            }
            
        } catch (\Exception $__exErrorStylesheet ) {

            echo $__exErrorStylesheet->getMessage();

        }

    }

}

// EOF
