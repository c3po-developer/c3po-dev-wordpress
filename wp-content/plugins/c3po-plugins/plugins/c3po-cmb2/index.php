<?php 

// Plugin name
$plugin_subfix = 'c3po_cmb2';

// Prefix plugin
$plugin_option_subfix =  '_' . $plugin_subfix . '_';

// Register settings fields
settings_fields( '__c3po_plugins_options_' . $plugin_subfix ); 

// Options values
$_options_values = get_option( $plugin_option_subfix ); 
 
?> 
 
<h1><img class="c3po-title-icon" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/003-startup.png" width="16px" alt="">  C3PO CMB2 - <small>Incluye la librería CMB2 en WordPress</small></h1>

<p>Este plugin no tiene actualmente configuración</p>

<hr>