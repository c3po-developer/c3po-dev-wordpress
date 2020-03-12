<?php
 
/**
 * C3PO Child theme base
 * 
 * C3PO Child theme functions
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

 /*! Prevent load resources after parent theme loaded. */
function _c3po_wp_action_prevent_after_load_resources() {    

   /*! Load and enqueue CSS resources */
    C3POCore\Loader::load_enqueue_css( 
        array (
            array(
                'src'      => _C3PO_THEME_CHILD_URI_ . '/style.css',
                'handler'  => 'theme-style-child',
                'version'  => mt_rand(0,999)
            )
        )
    );
  
    /*! Load and enqueue JS resources */ 
    C3POCore\Loader::load_enqueue_js( 
        array ( 
            array(
                'src'        =>  _C3PO_THEME_CHILD_URI_ . '/inc/js/theme-functions.js',
                'handler'    => 'theme-functions-js-child',
                'version'    => '',
                'in_footer'  => true
            )
        )
    );

} add_action( 'after_setup_theme', '_c3po_wp_action_prevent_after_load_resources', 9 );


/**
 *  *********************************************************************************
 *  THEME MENU 
 *  *********************************************************************************
 */

/*! Create menu nav */
C3POCore\Nav::create_menu(
    array(
        'child-main-nav-menu'  => __( 'Menu de navegación principal (hijo)' )
    )
);

/**
 *  *********************************************************************************
 *  THEME TRANSLATE SLUGS 
 *  *********************************************************************************
 */

/*! Global terms translate terms */
C3POCore\Translate::set_terms(
    'c3po-theme-child',
    array (
        'save'
    ),
    'GLOBAL'
);

C3POCore\Translate::set_terms(
    $text_domain_name,
    array ( 
        'name', 
        'name_placeholder', 
        'surname', 
        'surname_placeholder', 
        'phone', 
        'phone_placeholder', 
        'email', 
        'email_placeholder', 
        'message', 
        'message_placeholder',
        'privacy-accept-phrase', 
        'send_form',
        'email-send-success',
        'email-send-fail',
        'all-mandatory-fields',
        'email-mandatory',
        'accept-legals',
        'textarea-empty',
        'file-too-big',
        'filetype-not-allowed',
    ),
    'c3poTheme Contact'
);

