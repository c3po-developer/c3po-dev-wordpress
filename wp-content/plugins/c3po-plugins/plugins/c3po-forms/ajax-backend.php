<?php 

// Include required libs
include( preg_replace('/wp-content.*$/','',__DIR__) . 'wp-load.php');
 
global $wpdb;
   
$table_name = 'c3po_forms_log';

$query = $wpdb->query( 'DELETE FROM `c3po_forms_log`' );


// Response
echo json_encode( $_POST );
 
