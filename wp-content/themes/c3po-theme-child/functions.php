<?php 

/**
 * C3PO - Child functions
 * 
 * Post
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

/**
 *  *********************************************************************************
 *  THEME CHILD FUNCTIONS
 *  *********************************************************************************
 * 
 *  This file make and define loaders, translate constanst, extra stuff... 
 *  The classes and functions of this file to be ONLY affect the theme settings
 *  without affect WordPress comportament.
 */ 
try {

    // Include once C3PO functions collection
    if( !@include_once( __DIR__ . '/inc/php/child-theme-functions.php' ) )
        throw new Exception("Error " . __DIR__ . '/inc/php/child-theme-functions.php' . " not found" );
        

} catch ( Exception $e ) {

    echo '<p style="font-weight: 900;text-align: left;z-index: 9999;background: rgba(232, 49, 49, 0.87);padding: 5px;position: fixed;bottom:0px;width: 100%;color: #fff">';
    
    echo '<b>C3PO Exception</b></br>';

    echo $e->getMessage();

    echo '</div>';

}