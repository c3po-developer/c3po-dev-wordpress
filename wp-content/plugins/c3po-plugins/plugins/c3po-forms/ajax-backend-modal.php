<?php 

// Include required libs
include( preg_replace('/wp-content.*$/','',__DIR__) . 'wp-load.php');
 
  
global $wpdb;

$query = $wpdb->get_results( 'SELECT * FROM `c3po_forms_log` WHERE id = ' . $_POST['id'] );

// Response
echo json_encode( base64_decode ( $query[0]->{'message_send'} ) );
 
