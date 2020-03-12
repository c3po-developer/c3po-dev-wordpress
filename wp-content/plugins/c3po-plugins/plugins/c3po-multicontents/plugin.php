<?php
 
 function ter(){
    // Prefijo del plugin
    $plugin_prefix = 'c3po_multicontents';

    // Prefijo del campo de opciones
    $plugin_option_prefix =  '_' . $plugin_prefix . '_';

    $_options_values = get_option( $plugin_option_prefix );  
  
    $get_actual_edit_post = isset ( $_GET['post'] ) ? $_GET['post'] : false;

    if ( $_options_values ) {
    $ia =  array_values ( $_options_values );
           
    if ( in_array( $get_actual_edit_post, $ia ) )
        remove_post_type_support('page', 'editor');

    foreach( $_options_values as $option ) {

        $cmb = new_cmb2_box( array(
            'id'            => 'test_metabox',
            'title'         => __( 'C3PO Multicontent', 'cmb2' ),
            'object_types'  => array( 'page', ), 
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true, 
            'show_on' => array( 'id' => $ia ) 
        ) );

        $group_field_id = $cmb->add_field( array(
            'id'          => 'wiki_test_repeat_group',
            'type'        => 'group', 
            'options'     => array(
                'group_title'       => __( 'Contenido {#}', 'cmb2' ), 
                'add_button'        => __( 'Add Another Entry', 'cmb2' ),
                'remove_button'     => __( 'Remove Entry', 'cmb2' ),
                'sortable'          => true    
            ),
        ) );
    
        $cmb->add_group_field( $group_field_id, array(
            'name' => 'ID',
            'id'   => 'c3po_multicontent_id',
            'type' => 'text'
        ) );

        $cmb->add_group_field( $group_field_id, array(
            'name' => 'Contenido',
            'id'   => 'c3po_multicontent_content',
            'type' => 'wysiwyg'
        ) );
        
        if( $option == $get_actual_edit_post ) break; 
    
    }
    }
}  add_action( 'cmb2_admin_init','ter');


function c3po_get_mc( $key, $format = '', $id = '' ){
    
    $id = ( $id != '' ) ? $id : get_the_ID();

    $_options_values = get_post_meta( $id, 'wiki_test_repeat_group', true );
    
    foreach( $_options_values as $option ){

        if( $option['c3po_multicontent_id'] === $key ) {
 
            $return_value = $option['c3po_multicontent_content'];

            return ( $format == 'raw' ) ? strip_tags( $return_value ) : $return_value;

        }

    }

    return false;

}