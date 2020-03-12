<?php
 
/*! 
 * Plugin Name: C3PO Plugins
 * Plugin URI: https://usalafuerza.com/
 * Description: Colección de plugins a medida listos para su activación y uso
 * Version: 0.2
 * Author: web@usalafuerza.com
 * Author URI: https://usalafuerza.com/
 * License: C3-PO Usalafuerza
 * Text Domain: c3po-plugins
 */
 
/*! Registra el arreglo con las opciones del plugin */
function __c3po_plugins_register_settings(){
 
    $registered_plugins =  __c3po_plugins_register_plugins();
  
    foreach ( $registered_plugins as $registered_plugin ) {
     
        register_setting( $registered_plugin [ 'register_name' ], 
                          $registered_plugin [ 'register_slug' ] 
        );

    }
 
} add_action( 
    'admin_init', 
    '__c3po_plugins_register_settings' 
);
 
/*! Registra una nueva pagina de opciones para el plugin */
function __c3po_plugins_register_options_page(){
 
    add_menu_page(
        'C3PO Plugins', 
        'C3PO Plugins',
        'manage_options',
        '__c3po_plugins__',
        '__c3po_plugins_register_views_page',
        plugins_url( 'c3po-plugins/assets/icon18x18.png' ),
        69
    );
 

} add_action(
    'admin_menu', 
    '__c3po_plugins_register_options_page'
);

function oaf_options_function(){}

/*! Inicialización de los plugins y carga de los ficheros incluidos en el */
function __c3po_plugins_register_options_init()
{
   
    // Obtiene todos los plugins instalados en el directorio.
    $registered_plugins = __c3po_plugins_register_plugins(false);
    
    // Valor de las opciones recogidas
    $_options_values = get_option( '_c3po_index_' );  

    // Carga el fichero del plugin
    if ( is_array ( $_options_values ) && $_options_values !== '' ) {
        
        foreach ( $registered_plugins as $registered_plugin ) {
           
            foreach ($_options_values as $key => $_options_value ) {
            
                if( $key === $registered_plugin['register_slug'] ) {
                 
                    // Registra los submenus
                    register_sub_menu( $registered_plugin );
 
                    require_once ( $registered_plugin['plugin_file'] );

                    break;

                }

            }

        }

    } 

} __c3po_plugins_register_options_init();

/*
 * Registra los submenus de los plugins activados
 */
function register_sub_menu( $submenu ){

    add_action( 'admin_menu', function () use( $submenu ){
         
        $icons = array ( 
           '__c3po_plugins_options_c3po_contents' => '001-star-wars.png',
           '__c3po_plugins_options_c3po_forms' => '002-villain.png',
           '__c3po_plugins_options_c3po_gmaps' => '003-r2d2.png',
           '__c3po_plugins_options_c3po_include' => '004-cinema.png',
           '__c3po_plugins_options_c3po_legal' => '005-droid.png',
           '__c3po_plugins_options_c3po_video' => '006-sith.png', 
           '__c3po_plugins_options_c3po_slider' => 'monitor.png', 
           '__c3po_plugins_options_c3po_cmb2' => '003-startup.png', 
           '__c3po_plugins_options_c3po_multicontents' => '003-startup.png', 
        );
        
        $link = "__c3po_plugins__&tab=" . $submenu['register_name'];

        $i = '<img style="margin: 0px 8px -3px 0;" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/'.$icons[ $submenu['register_name'] ].'" width="14px" alt="">';

        add_submenu_page ( '__c3po_plugins__', $submenu['name'], $i . $submenu['name'], 'manage_options', $link, 'oaf_options_function' );

    });

}



/*! Enqueue JS and Css files  */
function __c3po_plugins_register_enqueue_rsc()
{
     
    // Load stylesheet for UI backend
    wp_register_style( 
        'main-css', 
        plugin_dir_url( __FILE__ )  . 'inc/css/style.css', 
        false, 
        '1' 
    ); wp_enqueue_style( 'main-css' );
 
} add_action( 
    'admin_enqueue_scripts',
    '__c3po_plugins_register_enqueue_rsc'
); 

/*! Vista del html con las opciones del plugin */
function __c3po_plugins_register_views_page(){
      
    // Obtiene todos los plugins instalados en el directorio.
    $registered_plugins = __c3po_plugins_register_plugins(true, 'register_views_page');
     
    // Valor de las opciones recogidas
    $_options_values = get_option( '_c3po_index_' );  
    
    // Pestaña activa
    $active_tab = ( isset( $_GET[ 'tab' ] ) ) ? $_GET[ 'tab' ] : '__c3po_plugins_options_c3po_index' ;
   
    ?>  
   
        <div class="wrap">

            <img class="brand-logo" src="<?php echo plugins_url( 'c3po-plugins/assets/logo-c3po-usalafuerza.png' );?>" alt="">

            <h2 class="nav-tab-wrapper">
            
                <a href="?page=__c3po_plugins__&tab=__c3po_plugins_options_c3po_index" class="nav-tab <?php if( $active_tab == '__c3po_plugins_options_c3po_index' ) echo 'active-tab-c3po'; ?>">Inicio</a>

                <?php
    
                    foreach ( $registered_plugins as $registered_plugin ) {
                    
                        $flag_values_active_tab = isset ( $_options_values [ $registered_plugin['register_slug'] ] ) ? $_options_values [ $registered_plugin['register_slug'] ] : '';
                       
                        if ( $flag_values_active_tab == 'on' && $registered_plugin['register_name'] != '__c3po_plugins_options_c3po_index' ) {
                           
                            ?> 
                            
                                <a href="?page=__c3po_plugins__&tab=<?php echo $registered_plugin['register_name']; ?>" class="nav-tab <?php if( $active_tab == $registered_plugin['register_name'] ) echo 'active-tab-c3po'; ?>"><?php echo $registered_plugin['name']; ?></a> 
                                
                            <?php

                        }
                        
                    }
                  
                ?>   
            
            </h2>
    
            <form method="post" action="options.php">
            
                <?php 
                     
                    foreach ( $registered_plugins as $registered_plugin ) {
                      
                        // Carga el contenido de la página de opciones
                        if( $active_tab == $registered_plugin['register_name'] ) {
                         
                            echo $registered_plugin [ 'content' ];
                         
                        }
                          
                    }  

                ?> 

                <? submit_button(); ?> 

            </form>

        </div>

    <?

}

/*! Registra los plugins internos desde el directorio definido
    como repositorio de los mismos. */
function __c3po_plugins_register_plugins( $returned = true, $section = '' ){
 
    $path = plugin_dir_path( __FILE__ ) . 'plugins/'; 
  
    $files = array_diff( scandir($path), array ( '.', '..' ) );
   
    $__c3po_plugins_register_plugins_list = array ();

    foreach ( $files as $file ) {
        
        $name = explode ( '-', $file );

        $name[0] = strtoupper ( $name[0] );

        $name = implode (' ', $name );
 
        $__c3po_plugins_register_plugins_list['__c3po_plugins_options_' . str_replace( '-', '_', $file )] = array (
            'name'          => $name,
            'register_name' => '__c3po_plugins_options_' . str_replace( '-', '_', $file ),
            'register_slug' => '_' . str_replace( '-', '_', $file ) . '_',
            'content'       => ($returned) ? getFile( $path . $file . '/index.php' ) : '',
            'plugin_file'   => $path . $file . '/plugin.php'
        );
       
    }
   
    return $__c3po_plugins_register_plugins_list;

}
 
/*! Recorre todo el directorio de plugins */
function __c3po_plugs(){
 
    $path = plugin_dir_path( __FILE__ ) . 'plugins/'; 
  
    $files = array_diff( scandir($path), array ( '.', '..' ) );
   
    $__c3po_plugins_register_plugins_list = array ();

    foreach ( $files as $file ) {
        
        $name = explode ( '-', $file );

        $name[0] = strtoupper ( $name[0] );

        $name = implode (' ', $name );
 
        if( '__c3po_plugins_options_' . str_replace( '-', '_', $file ) !== '__c3po_plugins_options_c3po_index' ){

            $__c3po_plugins_register_plugins_list['__c3po_plugins_options_' . str_replace( '-', '_', $file )] = array (
                'name'          => $name,
                'register_name' => '__c3po_plugins_options_' . str_replace( '-', '_', $file ),
                'register_slug' => '_' . str_replace( '-', '_', $file ) . '_', 
                'plugin_file'   => $path . $file . '/plugin.php'
            );
            
        }
       
    }
   
    return $__c3po_plugins_register_plugins_list;

}

function getPublicCSSEnqueue( $slug, $file ){

    add_action( 'wp_enqueue_scripts', function() use ( $slug, $file){
  
        wp_register_style( 
            $slug, 
            $file, 
            1, 
            '1' 
        ); wp_enqueue_style( $slug );

    });

}

function getAdminScriptEnqueue( $slug, $script_path )
{ 
    
    // Enqueue JS and Css files 
    add_action( 'admin_enqueue_scripts', function() use ( $slug, $script_path ) {
    
        wp_register_script( 
            $slug, 
            $script_path, 
            array(),
            '1', 
            true
        ); wp_enqueue_script( $slug );
    
    });

}

function getPublicScriptEnqueue( $slug, $script_path, $in_footer = false )
{ 
    
    // Enqueue JS and Css files 
    add_action( 'wp_enqueue_scripts', function() use ( $slug, $script_path ) {
 
        wp_register_script( 
            $slug, 
            $script_path, 
            array(), //array('jquery'),
            '1', 
            1
        ); wp_enqueue_script( $slug );
    
    });

}

function getPublicWarnScriptEnqueue( $slug, $script_path, $in_footer = false )
{ 
    
    // Enqueue JS and Css files 
    add_action( 'wp_init', function() use ( $slug, $script_path ) {
 
        wp_register_script( 
            $slug, 
            $script_path, 
            array(), //array('jquery'),
            '1', 
            0
        ); wp_enqueue_script( $slug );
    
    });

}

/*! Obtiene un fichero y lo carga desde el buffer */
function getFile( $file ){
    
    ob_start();
      
    include $file; 
  
    $output = ob_get_clean(); 
 
    return $output;

}

function getJodit(){

    $path = plugin_dir_url( __FILE__ ); 
    
    ?>
            
        <link rel="stylesheet" href="<?php echo $path; ?>vendor/jodit/css/jodit.min.css">

        <script src="<?php echo $path; ?>vendor/jodit/js/jodit.min.js"></script>

    <?php

}

function getJoditEditor( $name, $id, $content ){

    ?>

        <textarea name="<?php echo $name; ?>" id="<?php echo $id; ?>"><?php echo $content ?></textarea>

        <script>var editor = new Jodit('#<?php echo $id; ?>');</script>

    <?php

}

function scanDirs( $path ) {
  
    $files = array_diff( scandir($path), array ( '.', '..' ) );
   
    $__c3po_plugins_register_plugins_list = array ();
    
    return $files;

}

function c3po_index_get_wp_info(){

    return array ( 
        'debug'     => ( C3POCore\Tools::get_mode_debug() ) ? '<b style="color:red">ON</b>' : '<b style="color:green">OFF</b>',
        'server'    => ( C3POCore\Tools::get_server_dev() ) ? '<b style="color:red">WEB_SERVER</b>' : '<b style="color:green">PRODUCTION</b>',
        'robots'    => ( !get_option( 'blog_public' ) ) ? '<b style="color:red">BLOQUEADO por WP.</b>' : '<b style="color:green"> desbloqueado</b>',
    );

}
// EOF
