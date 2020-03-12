<?php

/**
 * C3PO Core Class Nav
 *  
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

namespace C3POCore;

class Nav {
    
    /**
     * Register menu array collection to use navigation 
     * 
     * @param (array) $collection_menu  Array assoc. with definition of 'slug' => 'Public name'
     */
    public static function create_menu( $collection_menu )
    {
    
        add_action( 'init', function() use ( $collection_menu ) {

            register_nav_menus( $collection_menu );

        });
     
    }

    /**
     * Get nav menu declared with C3POCore\Nav::create_menu( array(...) );
     * 
     * @param (array)   $menu_option    WP array menu standar 
     * @param (string)  $menu_option    Menu theme-location name
     */
    public static function get_menu_nav( $menu_option )
    {

        if( is_array($menu_option) ){

            wp_nav_menu( $menu_option );

        }else{

            wp_nav_menu( array(
                'theme_location' => $menu_option,
                'menu_class'        => $menu_option . '-class'
            ) );
            
        }

    }

    /**
     * Get C3PO-WP constants to use in main scope
     */
    public static function get_header_defines() {

        ?>

            <script>
            
                const _C3PO_BASE_URI_   = '<?php echo _C3PO_BASE_URI_; ?>';

                const _C3PO_THEME_URI_  = '<?php echo get_stylesheet_directory_uri(); ?>';
 
                const _C3PO_DEBUG_MODE_ = <?php echo ( \C3POCore\Tools::get_mode_debug() ) ? 'true' : 'false' ?>;

            </script>

        <?php

    }
    
}

// EOF
