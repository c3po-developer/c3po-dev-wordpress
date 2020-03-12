<?php

/**
 * C3PO Theme base
 * 
 * Functions
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

// Set datazone
date_default_timezone_set('Europe/Madrid');

/**
 *  *********************************************************************************
 *  THEME CHECK PLUGIN DEPENDECIES
 *  *********************************************************************************
 * 
 *  To works properly this theme needed from installation almost C3PO Core plugin
 *  and is needed install Polylang and CMB2 plugins to extract max performance.
 */
try { 
  
    if( !in_array('c3po-core/index.php', apply_filters('active_plugins', get_option('active_plugins') ) ) )
        throw new Exception( 'Error, INSTALL/ACTIVATE C3PO Core plugin', 1 );
  
    if( !in_array('polylang/polylang.php', apply_filters('active_plugins', get_option('active_plugins') ) ) )
        throw new Exception( 'Warning, INSTALL/ACTIVATE POLYLANG plugin', 1 );
         
    if ( ! class_exists( 'CMB2_Bootstrap_270', false ) ) 
        throw new Exception( 'Warning, ACTIVATE CMB2 from C3PO Plugins menu', 2 );
   
} catch ( Exception $e ) {
   
    if( is_admin() ) {

        switch ( $e->getCode() ){

            case 1:

                echo '<p style="font-weight: 900;text-align: left;z-index: 9999;background: rgba(232, 49, 49, 0.87);padding: 5px;position: fixed;bottom:0px;width: 100%;color: #fff">';

            break;

            case 2:

                echo '<p style="font-weight: 900;text-align: left;z-index: 9999;background: rgba(228, 142, 81, 0.82);padding: 5px;position: fixed;bottom:0px;width: 100%;color: #fff">';

            break;

        }
     
        echo '<b>C3PO Theme base Exception </b></br>';

        echo $e->getMessage();
  
        echo '</p>';

    }
  
    return;
     
}


/**
 *  *********************************************************************************
 *  THEME FUNCTIONS
 *  *********************************************************************************
 * 
 *  This file make and define loaders, translate constanst, extra stuff... 
 *  The classes and functions of this file to be ONLY affect the theme settings
 *  without affect WordPress comportament.
 */ 
try {

    // Include once C3PO functions collection
    if( !@include_once( __DIR__ . '/inc/php/theme-functions.php' ) )
        throw new Exception("Error " . __DIR__ . '/inc/c3po-theme-functions.php' . " not found" );
        

} catch ( Exception $e ) {

    echo '<p style="font-weight: 900;text-align: left;z-index: 9999;background: rgba(232, 49, 49, 0.87);padding: 5px;position: fixed;bottom:0px;width: 100%;color: #fff">';
    
    echo '<b>C3PO Exception</b></br>';

    echo $e->getMessage();

    echo '</div>';

}
 
/**
 *  *********************************************************************************
 *  WORDPRESS HOOKS
 *  *********************************************************************************
 * 
 *  Add here all add_filters and add_actions to modify WordPress comportament.
 */ 
 
/**
 * Optimization
 */
define ("WP_HEAD_HOOK" , 'wp_head');

remove_action( WP_HEAD_HOOK, 'rsd_link');

remove_action( WP_HEAD_HOOK, 'wp_generator');

remove_action( WP_HEAD_HOOK, 'feed_links', 2);

remove_action( WP_HEAD_HOOK, 'index_rel_link');

remove_action( WP_HEAD_HOOK, 'wlwmanifest_link');

remove_action( WP_HEAD_HOOK, 'feed_links_extra', 3);

remove_action( WP_HEAD_HOOK, 'start_post_rel_link', 10, 0);

remove_action( WP_HEAD_HOOK, 'parent_post_rel_link', 10, 0);

remove_action( WP_HEAD_HOOK, 'adjacent_posts_rel_link', 10, 0);

remove_action( WP_HEAD_HOOK, 'print_emoji_detection_script', 7 );

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );

remove_action( 'wp_print_styles', 'print_emoji_styles' );

remove_action( 'admin_print_styles', 'print_emoji_styles' );


 
/**
 * Redirects the attachments to the parent post, or home if not exist
 */ 
function _wp_action_c3po_attachment_redirect()
{

    if ( is_attachment() ){
        global $post;
    
        ( $post->post_parent ) ?
            wp_redirect( get_permalink( $post->post_parent ), 301 ) :
            wp_redirect( home_url(), 301 );

    }

} add_action( 'template_redirect', '_wp_action_c3po_attachment_redirect', 1 );

/**
 * Add the 'custom-post' to the WordPress search
 *
 * @param $__strQuery
 * Search query as a parameter
 *
 * @return mixed
 * Result of the search query
 */
function _wp_filter_c3po_add_custom_post_search_in( $__strQuery )
{
    
    if ( $__strQuery->is_search ) {
    
        $__strQuery->set(
            'post_type',
            array(
                'site',
                'plugin',
                'theme',
                'person'
            )
        );
    
    }
    
    return $__strQuery;

} add_filter( 'the_search_query', '_wp_filter_c3po_add_custom_post_search_in' );

/**
 * Add a class to the body with the top page where it is located
 */ 
function _wp_filter_c3po_functions_body_class_section( $classes )
{
    global $wpdb, $post;

    if ( is_page() ) {
        
        $end_ancestors = get_post_ancestors( get_the_ID() ) ;

        $parent = ( $post->post_parent ) ?
                    end ( $end_ancestors ) :
                    $parent = $post->ID;

        $post_data = get_post( $parent, ARRAY_A );

        $classes[] = 'section-' . $post_data['post_name'];

    }

    return $classes;

} add_filter('body_class','_wp_filter_c3po_functions_body_class_section');
 
/**
 * Remove the WordPress version from the website header
 *
 * @return string
 */
function _wp_filter_c3po_functions_version_removal() {
    return '';
} add_filter('the_generator', '_wp_filter_c3po_functions_version_removal');
 
/**
 * Add menu support
 */
add_theme_support( 'menus' );

/**
 * Add thumbnail support
 */
add_theme_support( 'post-thumbnails' );

/**
 * Add support for HTML5 tags
 */
add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
 
// EOF
