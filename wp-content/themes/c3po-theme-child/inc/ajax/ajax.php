<?php

// Include WordPress scope 
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );

require_once( $parse_uri[0] . 'wp-load.php' );
  
ob_start();

    C3POCore\Query::get_posts_paginated( $_POST['template'], true ); 
    
    $html = ob_get_contents();

ob_end_clean(); 

// Response success
echo json_encode( array( 'html' =>$html ) ); 