<?php
/**
 * droid-theme
 * Carga de CF con CMB2
 * Theme WordPress base de C3PO
 *
 * @package   droid-theme
 * @author    web@usalafuerza.com
 * @link      http://usalafuerza.com
 */

/**
 * 
 */
function CF_book_metabox() {
    // Frontend 
    $prefix = 'book_';
 
    $cmb_box = new_cmb2_box( 
        array(
            'id'            => $prefix . 'metabox',
            'title'         => esc_html__( 'Datos del libro', 'cmb2' ),
            'object_types'  => array( 'cpt_book' )
        ) 
    );
  
        $cmb_box->add_field( 
            array( 
                'name'       => esc_html__( 'Páginas', 'cmb2' ),
                'desc'       => esc_html__( 'Páginas del libro', 'cmb2' ),
                'id'         => $prefix . 'pages',
                'type'       => 'text',
            ) 
        );

        $cmb_box->add_field( 
            array(
                'name'       => esc_html__( 'Año', 'cmb2' ),
                'desc'       => esc_html__( 'Año de edición del libro', 'cmb2' ),
                'id'         => $prefix . 'year',
                'type'       => 'text',
            ) 
        );
        
        $cmb_box->add_field( 
            array(
                'name' => 'Galería',
                'desc' => '',
                'id'   => $prefix . 'gal',
                'type' => 'file_list',
                'text' => array(
                    'add_upload_files_text' => 'Añadir fotos',
                    'remove_image_text' => 'Eliminar',
                    'file_text' => 'Archivo:',
                    'file_download_text' => 'Descargar',
                    'remove_text' => 'Eliminar'
                ),
            )
        );


        $cmb_repeater_group = $cmb_box->add_field( array(
            'id'          => $prefix . 'repeater_test',
            'type'        => 'group',
            'description' => __( 'Test repeater', 'cmb2' ),
            'repeatable'  => true,
            'options'     => array(
                'group_title'       => __( 'repeater {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
                'add_button'        => __( 'Añadir item', 'cmb2' ),
                'remove_button'     => __( 'Eliminar', 'cmb2' ),
                'sortable'          => true,
            ),
        ) );

        
        $cmb_box->add_group_field( $cmb_repeater_group, array( 
                'name'       => esc_html__( 'Titulo', 'cmb2' ),
                'id'         => $prefix . 'repeat_title_test',
                'type'       => 'text',
            ) 
        );

        $cmb_box->add_group_field( $cmb_repeater_group, array(
            'id'      => $prefix . 'repeat_img_test',
            'name' => __( 'Imagen test', 'cmb2' ),
            'desc'    => 'Imagen de 1600x500',
            'id'      => $prefix . 'img',
            'type'    => 'file',
            // Optional:
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            // query_args are passed to wp.media's library query.
            'query_args' => array(
                'type' => array(
                    'image/gif',
                    'image/jpeg',
                    'image/png',
                ),
            ),
            'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
        ) );
}

add_action( 'cmb2_admin_init', 'CF_book_metabox' );