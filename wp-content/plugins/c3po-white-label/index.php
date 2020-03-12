<?php
 
/*! 
 * Plugin Name: C3PO White label
 * Plugin URI: https://usalafuerza.com/
 * Description: Plugin para modificar la parte de backend de WordPress
 * Version: 0.2
 * Author: web@usalafuerza.com
 * Author URI: https://usalafuerza.com/
 * License: C3-PO Usalafuerza
 * Text Domain: c3po-white-label
 */

  


function remove_dashboard_widgets() {
    global $wp_meta_boxes;
 
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_php']);
    remove_meta_box('dashboard_php_nag', 'dashboard', 'normal');

    wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');

} add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
 

function c3po_dashboard_index_get_wp_info(){

    return array ( 
        'debug'     => ( C3POCore\Tools::get_mode_debug() ) ? '<b style="color:red">ON</b>' : '<b style="color:green">OFF</b>',
        'server'    => ( C3POCore\Tools::get_server_dev() ) ? '<b style="color:red">WEB_SERVER</b>' : '<b style="color:green">PRODUCTION</b>',
        'robots'    => ( !get_option( 'blog_public' ) ) ? '<b style="color:red">BLOQUEADO por WP.</b>' : '<b style="color:green"> desbloqueado</b>',
    );

}

function c3po_dashboard_user_scripts() {

    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style',  $plugin_url . "/c3po-white-label.css");
    
} add_action( 'admin_print_styles', 'c3po_dashboard_user_scripts' );

function c3po_dashboard_get_db_name(){
    
    global $wpdb;
    
    return $wpdb->dbname;

}

 
function custom_dashboard_help() {
   
    $wp_info = c3po_dashboard_index_get_wp_info();

    ?>

    <div id="c3po-dashboard" class="c3po-white-label welcome-panel" style="display: none;">

		<div class="welcome-panel-content">
		
        	<h2><img class="brand-logo" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/logo-c3po-usalafuerza.png" alt=""></h2>
		 
        	<div class="welcome-panel-column-container">
		
        		<div class="welcome-panel-column">
		
        			<div class="image"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>/assets/claim-1.jpg" alt=""></div>
    
                    <h2>Base de datos</h2>
                    <ul>
                        <li><b>Nombre: </b><?php echo c3po_dashboard_get_db_name(); ?></li>
                        <li>2</li>
                        <li>3</li>
                    </ul>
                    <p></p>
                    
        		</div>

        		<div class="welcome-panel-column">
		
                    <div class="image"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>/assets/claim-2.jpg" alt=""></div>
    
                    <h2>Configuración</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid </p>
		  
        		</div>

        		<div class="welcome-panel-column">
		
                    <div class="image"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>/assets/claim-3.jpg" alt=""></div>
    
                    <h2>Estado</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid </p>
		  
        		</div>
        	 
        	</div>

            <div class="separator"></div>

            <div class="welcome-panel-column-container">
     
        	</div>
		
        </div>

	</div> 
 
	<script>
	
    	jQuery(document).ready(function($) {
			$('#welcome-panel').after($('#c3po-dashboard').show()); 
		});

	</script>

    <?php
}