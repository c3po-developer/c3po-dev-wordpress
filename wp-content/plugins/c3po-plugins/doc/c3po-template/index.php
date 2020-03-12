<?php 

// Plugin name
$plugin_subfix = 'c3po_template';

// Prefix plugin
$plugin_option_subfix =  '_' . $plugin_subfix . '_';

// Register settings fields
settings_fields( '__c3po_plugins_options_' . $plugin_subfix ); 

// Options values
$_options_values = get_option( $plugin_option_subfix ); 
   
// Enqueue JS and Css files 
getAdminScriptEnqueue( 
    $plugin_option_subfix . 'js_script', 
    plugin_dir_url( __FILE__ ) . '/inc/js/c3po-template.js' 
);

?> 

<h1>C3PO {plugin_name} - <small>{short_desc}</small></h1>

<small><b>{advice}</b></small>

<p>{content}</p>

<hr>