<?php

/**
 * C3PO Theme base
 * 
 * C3PO theme functions
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */
 
/**
 *  *********************************************************************************
 *  THEME LOADER (CSS&JS Dependencies)
 *  *********************************************************************************
 */
 
/*! Load and enqueue CSS resources */
C3POCore\Loader::load_enqueue_css( 
    array (
        // Main theme style
        array(
            'src'      => _C3PO_THEME_URI_ . '/style.css',
            'handler'  => 'theme-style',
            'version'  => mt_rand(0,999)
        ),
        
        // CSS Visual Debug only if get query string /?debug to end url
        ( isset ( $_GET['debug'] ) ) ? 
            array (
                'src'      => _C3PO_THEME_URI_ . '/inc/css/vendor/debug.css',
                'handler'  => 'debug',
                'version'  => mt_rand(0,999) 
            ) : 
            array()
    )
);
 
/*! Load and enqueue JS resources */ 
C3POCore\Loader::load_enqueue_js( 
    array (
        // jQuery library
        array(
            'src'       => _C3PO_THEME_URI_ . '/inc/js/vendor/jquery/jquery-3.4.1.min.js',
            'handler'   => 'jquery-js',
            'version'   => '',
            'in_footer' => 0
        ),

        // Theme js functions
        array(
           'src'        =>  _C3PO_THEME_URI_ . '/inc/js/theme-functions.js',
           'handler'    => 'theme-functions-js',
           'version'    => '',
           'in_footer'  => true
        ), 
   )   
);
  
/**
 *  *********************************************************************************
 *  THEME MENU 
 *  *********************************************************************************
 */

/*! Create menu nav */
C3POCore\Nav::create_menu( array() );

/**
 *  *********************************************************************************
 *  THEME TRANSLATE SLUGS 
 *  *********************************************************************************
 */
 
/*! Set automatic trasient for pages/post translate content */
C3POCore\Translate::set_automatic_translation();
 
$text_domain_name = 'c3po-theme';

/*! Global terms translate terms */
C3POCore\Translate::set_terms(
    $text_domain_name,
    array (
        'go-home',
        'search'
    ),
    'c3poTheme GLOBAL'
);

C3POCore\Translate::set_terms(
    $text_domain_name,
    array (
        '404-title',
        '404-text',
    ),
    'c3poTheme 404'
);

