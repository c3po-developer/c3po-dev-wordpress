<?php

// Enqueue JS and Css files 

getPublicScriptEnqueue( 'slick_js_script', plugin_dir_url( __FILE__ ) . 'inc/js/slick.min.js', 1 );
 
getPublicCSSEnqueue( 'slick_css', plugin_dir_url( __FILE__ ) . 'inc/js/slick.css' );

// CPT C3PO Contact Forms 
C3POCore\CPT::build(
    'cpt_c3po_sliders',
     array (
            'label'                 => 'Sliders',
            'description'           => 'Sliders',  
            'show_ui'               => true,
            'show_in_menu'          => false,
            'menu_position'         => 30,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'rewrite'				=> array( 'slug' => 'Formularios' ), 
            'capability_type'       => 'page',
            'menu_icon'           	=> 'dashicons-images-alt2',
            'labels' => array (
                'name'                  => 'Sliders',                      
                'singular_name'         => 'Sliders',                       
                'menu_name'             => 'Sliders',                      
                'name_admin_bar'        => 'Sliders',                      
                'all_items'             => 'All Items',                  
                'add_new_item'          => 'Nuevo slider',                 
                'add_new'               => 'Añadir',                     
                'new_item'              => 'Nuevo slider' ,                
                'edit_item'             => 'Editar Item',                
                'update_item'           => 'Actualizar Item',            
                'view_item'             => 'Ver Item',                   
                'view_items'            => 'Ver Items',                  
                'search_items'          => 'Buscar Item',                
                'not_found'             => 'No encontrado',              
                'not_found_in_trash'    => 'No encontrado en papelera',  
                'featured_image'        => 'Imagen destacada',           
                'set_featured_image'    => 'Define la imagen destacada', 
                'remove_featured_image' => 'Borrar la imagen destacada', 
                'use_featured_image'    => 'Usar como imagen destacada', 
                'insert_into_item'      => 'Insertar en el item',        
                'uploaded_to_this_item' => 'Subir a este item',          
                'items_list'            => 'Lista',                      
                'items_list_navigation' => 'Navegación de lista',        
                'filter_items_list'     => 'Filtrar los items',          
        )
    )
);
 
// Delete the default WP editor in these custom entries.
add_action( 'init', function(){

    remove_post_type_support('cpt_c3po_sliders', 'editor');
        
});

// Add the necessary fields for the plugin configuration
add_action( 'cmb2_admin_init', function() {
 
    // Mail host config
    $cmb_c3po_slider_config_prefix = 'c3po_slider_';

        // Metabox config
        $cmb_c3po_slider_config = new_cmb2_box( array(
            'id'            => $cmb_c3po_slider_config_prefix . 'slider_main',
            'title'         => 'Sliders',
            'object_types'  => array( 'cpt_c3po_sliders' ), 
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true,  
        ) ); 
        
        $id_text = 'Slider ID [ <b style="display:inline-block">' .( isset( $_GET['post'] ) ? $_GET['post'] : '' ) . ' ]</b>';

        $cmb_c3po_slider_config->add_field( array(
            'name' => $id_text, 
            'type' => 'title',
            'id'   => $cmb_c3po_slider_config_prefix . 'intro_id_title'
        ) );

        // Group
        $group_field_id = $cmb_c3po_slider_config->add_field( array(
            'id'          => $cmb_c3po_slider_config_prefix . 'repeat_group',
            'type'        => 'group',
            'description' => 'Genera diapositivas para este slider', 
            'options'     => array(
                'group_title'       => 'Diapositiva {#}', 
                'add_button'        => 'Añadir diapositiva', 
                'remove_button'     => 'Eliminar diapositiva', 
                'sortable'          => true,
                'closed'         => true, // true to have the groups closed by default
                'remove_confirm'    => '¿Estas seguro de querer eliminar esta diapositiva?'
            ),
        ) );

            // Date start
            $cmb_c3po_slider_config->add_group_field( $group_field_id, array(
                'name' => 'Fecha de inicio',
                'desc' => 'Indica aquí la fecha desde la cual se mostrara la diapositiva.',
                'id'   => $cmb_c3po_slider_config_prefix . 'data_from',
                'type' => 'text_date',
            ) );

            // Date end
            $cmb_c3po_slider_config->add_group_field( $group_field_id, array(
                'name' => 'Fecha de fin',
                'desc' => 'Indica aquí la fecha desde la cual se mostrara la diapositiva.',
                'id'   => $cmb_c3po_slider_config_prefix . 'data_to',
                'type' => 'text_date',
            ) );

            // URL
            $cmb_c3po_slider_config->add_group_field( $group_field_id, array(
                'name' => 'URL',
                'desc' => 'Indica aquí el enlace al cual conduce esta diapositiva.',
                'id'   => $cmb_c3po_slider_config_prefix . 'link',
                'type' => 'text_url',
            ) );

            // Mobile
            $cmb_c3po_slider_config->add_group_field( $group_field_id, array(
                'name' => 'Versión MÓVIL', 
                'type' => 'title',
                'id'   => $cmb_c3po_slider_config_prefix . 'intro_mobile_title' 
            ) );

                $cmb_c3po_slider_config->add_group_field( $group_field_id, array(
                    'name'    => 'Fondo',
                    'desc'    => 'Esta imagen puede ser usada como fondo de la diapositiva',
                    'id'      => $cmb_c3po_slider_config_prefix . 'mobile_background_image',
                    'type'    => 'file', 
                    'options' => array(
                        'url' => false, 
                    ),
                    'text'    => array(
                        'add_upload_file_text' => 'Añadir imagen' 
                    ), 
                    'preview_size' => 'large',  
                ) );

                $cmb_c3po_slider_config->add_group_field( $group_field_id, array(
                    'name'    => 'Superficie',
                    'desc'    => 'Esta imagen puede ser usada como superficie de la diapositiva',
                    'id'      => $cmb_c3po_slider_config_prefix . 'mobile_surface_image',
                    'type'    => 'file', 
                    'options' => array(
                        'url' => false, 
                    ),
                    'text'    => array(
                        'add_upload_file_text' => 'Añadir imagen' 
                    ), 
                    'preview_size' => 'large',  
                ) );

            // Desktop
            $cmb_c3po_slider_config->add_group_field( $group_field_id, array(
                'name' => 'Versión ESCRITORIO', 
                'type' => 'title',
                'id'   => $cmb_c3po_slider_config_prefix . 'intro_desktop_title' 
            ) );

                $cmb_c3po_slider_config->add_group_field( $group_field_id, array(
                    'name'    => 'Fondo',
                    'desc'    => 'Esta imagen puede ser usada como fondo de la diapositiva',
                    'id'      => $cmb_c3po_slider_config_prefix . 'desktop_background_image',
                    'type'    => 'file', 
                    'options' => array(
                        'url' => false, 
                    ),
                    'text'    => array(
                        'add_upload_file_text' => 'Añadir imagen' 
                    ), 
                    'preview_size' => 'large',  
                ) );

                $cmb_c3po_slider_config->add_group_field( $group_field_id, array(
                    'name'    => 'Superficie',
                    'desc'    => 'Esta imagen puede ser usada como superficie de la diapositiva',
                    'id'      => $cmb_c3po_slider_config_prefix . 'desktop_surface_image',
                    'type'    => 'file', 
                    'options' => array(
                        'url' => false, 
                    ),
                    'text'    => array(
                        'add_upload_file_text' => 'Añadir imagen' 
                    ), 
                    'preview_size' => 'large',  
                ) );

});

function c3po_slider_get_slider( $id ){

    $_post_slide = get_post( $id );

    $_post_meta = '<b><i>C3PO Slider Error: El ID seleccionado no existe</i></b>';

    if( $_post_slide ) {

        $_post_meta_response = array();

        $_post_meta = get_post_meta ( $id, 'c3po_slider_repeat_group' );

        $_actual_data = date("m-d-Y");

        foreach ( $_post_meta as $slides ) {
            
            foreach( $slides as $slide ) {
               
                $_slide_data_from = ( isset ( $slide['c3po_slider_data_from'] ) ) ? date('m-d-Y', strtotime( $slide['c3po_slider_data_from'] ) ) : '';
 
                $_slide_data_to = ( isset ( $slide['c3po_slider_data_to'] )  ) ? date('m-d-Y', strtotime( $slide['c3po_slider_data_to'] ) ) : '';
                
                if( ( $_actual_data > $_slide_data_from ) && ( $_actual_data < $_slide_data_to ) || 
                    ( $_actual_data > $_slide_data_from ) && $_slide_data_to == '01-01-1970' || 
                    ( $_actual_data < $_slide_data_to )   && $_slide_data_from == '01-01-1970' ) {
 
                    $_post_meta_response[] = array ( 
                        'date_from'             => ( isset ( $slide['c3po_slider_data_from'] ) ) ? $slide['c3po_slider_data_from'] : '',
                        'date_to'               => ( isset ( $slide['c3po_slider_data_to'] ) ) ? $slide['c3po_slider_data_to'] : '',
                        'link'                  => ( isset ( $slide['c3po_slider_link'] ) ) ? $slide['c3po_slider_link'] : '',
                        'link'                  => ( isset ( $slide['c3po_slider_link'] ) ) ? $slide['c3po_slider_link'] : '',
                        'mobile_background'     => ( isset ( $slide['c3po_slider_mobile_background_image'] ) ) ? $slide['c3po_slider_mobile_background_image'] : '',
                        'mobile_surface'        => ( isset ( $slide['c3po_slider_mobile_surface_image'] ) ) ? $slide['c3po_slider_mobile_surface_image'] : '',
                        'desktop_background'    => ( isset ( $slide['c3po_slider_desktop_background_image'] ) ) ? $slide['c3po_slider_desktop_background_image'] : '',
                        'desktop_surface'       => ( isset ( $slide['c3po_slider_desktop_surface_image'] ) ) ? $slide['c3po_slider_desktop_surface_image'] : '',
                    );
                
                }   

            }

        }
             
        return $_post_meta_response;

    }

    return $_post_meta;

}
