<?php

/**
 * C3PO Theme base
 * 
 * Header page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

?>

<!doctype html>

<html <?php language_attributes(); ?> class="no-js">
	
    <head>
	
    	<meta charset="<?php bloginfo( 'charset' ); ?>">
	
    	<title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) { echo ' | '; } ?><?php bloginfo( 'name' ); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
	
    	<link href="<?php echo esc_url( get_stylesheet_directory() ); ?>/assets/favicon/favicon.ico" rel="shortcut icon">
	
    	<link href="<?php echo esc_url( get_stylesheet_directory() ); ?>/assets/favicon/favicon_touch.png" rel="apple-touch-icon-precomposed">
	 
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    	<meta name="description" content="<?php bloginfo( 'description' ); ?>">

		<?php wp_head(); ?>
	
    	<?php \C3POCore\Nav::get_header_defines( 'main-nav-menu' ); ?>
 
	</head>

	<body <?php body_class(); ?>>

        <!-- header -->
        <header class="site-header viewport" role="banner">

            <!-- logo -->
            <h2 class="site-logo">

                <a href="<?php echo _C3PO_BASE_URI_; ?>">
                        
                    <img src="<?php echo _C3PO_THEME_URI_; ?>/assets/C3PO_logo.png" alt="<?php bloginfo( 'name' ); ?>" class="site-logo-img">

                </a>

            </h2>
            <!-- /logo -->

            <!-- nav -->
            <nav class="nav" role="navigation">

                <?php C3POCore\Nav::get_menu_nav( 'main-nav-menu' ); ?>

            </nav>
            <!-- /nav -->

        </header>
        <!-- /header -->

        <!-- site-wrapper -->
        <div class="site-wrapper viewport">