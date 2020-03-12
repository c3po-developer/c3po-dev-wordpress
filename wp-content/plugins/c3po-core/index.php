<?php 

/**
 * C3PO Core
 *  
 * Plugin Name: C3PO Core
 * Plugin URI:  https://usalafuerza.com/
 * Description: Library of classes and methods for web development in WordPress
 * Version:     0.1.1
 * Author:      web@usalafuerza.com
 * Author URI:  https://usalafuerza.com/
 * License:     C3-PO Usalafuerza
 * Text Domain: c3po-core
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

// Avoid url direct access
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

try {

    // Include once C3PO autoload
    if( !@include_once( __DIR__ . '/autoload.php' ) )
        throw new Exception("Error " . __DIR__ . '/autoload.php' . " not found", 1);

    // Include once C3PO defines
    if( !@include_once( __DIR__ . '/defines.php' ) )
        throw new Exception("Error " . __DIR__ . '/defines.php' . " not found", 1);
 
    /*! Load and enqueue JS Core resource */
    C3POCore\Loader::load_enqueue_js( 
        array (
            array(
                'src'       => plugin_dir_url( __FILE__ ) . 'js/c3po-core.js',
                'handler'   => 'c3po-core',
                'version'   => mt_rand( 0, 999 ),
                'in_footer' => false    
            )
        )   
    );

} catch ( Exception $e ) {

    echo $e->getMessage();

}

add_filter('admin_init', 'my_general_settings_register_fields');
 
function my_general_settings_register_fields()
{
 
    // Get actual server from WP installation
    $mode = ( C3POCore\Tools::get_server_dev() ) ? '<span style="color:red">WEB_SERVER</span>' : '<span style="color:green">PRODUCTION</span>';
    
    $blog_public = ( !get_option( 'blog_public' ) ) ? 'Robots.txt: <span style="color:red">BLOQUEADO por WP.</span>' : 'Robots.txt: <span style="color:green"> desbloqueado</span>';

    // Register field
    register_setting(
        'general', 
        'c3po_core_debug_mode', 
        'esc_attr'
    );

    add_settings_field(
        'c3po_core_debug_mode', 
        '<label for="c3po_core_debug_mode">' . __('Modo debug' , 'c3po_core_debug_mode' ) . '</label><br><small style="opacity:.7">Servidor: '.$mode.'<br>'.$blog_public.'</small>' , 
        'c3po_core_debug_mode_settings_fields_html', 
        'general'
    );

    // Check if WP debug log is on, elsewhere active
    if( !defined( 'WP_DEBUG_LOG' ) ) 
        define('WP_DEBUG_LOG', true);
    
}
 
function c3po_core_debug_mode_settings_fields_html()
{ 

    $selected = ( get_option( 'c3po_core_debug_mode', '' ) ) ? 'checked' : '';

    echo '<input type="checkbox" id="c3po_core_debug_mode" name="c3po_core_debug_mode" ' . $selected . ' /> Si';

}

// EOF
