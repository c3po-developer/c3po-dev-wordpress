<?php

/**
 * C3PO Theme base
 * 
 * Defines
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */
 
/*! Full base url from site */
define( '_C3PO_BASE_URI_', esc_url( get_site_url() ) );

/*! Full base path from site */
define( '_C3PO_BASE_PATH_', ABSPATH );

/*! Full directory url from plugins */
define( '_C3PO_PLUGINS_DIR_URI_', esc_url ( plugins_url() ) );

/*! Full directory path from plugins */
define( '_C3PO_PLUGINS_DIR_PATH_', plugin_dir_path( __DIR__ ) );

/*! Template path */
define ( '_C3PO_THEME_PATH_', get_theme_file_path() );

/*! Template uri */
define ( '_C3PO_THEME_URI_', esc_url ( get_template_directory_uri() ) );

/*! Template child uri */
define ( '_C3PO_THEME_CHILD_URI_', esc_url ( get_stylesheet_directory_uri() ) );

/*! Template child path */
define ( '_C3PO_THEME_CHILD_PATH_', get_stylesheet_directory() );