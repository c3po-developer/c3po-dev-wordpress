<?php

/*!
    \brief     <H1>Clase principal, nucleo de la librería de C3POContents para WP.</H1>
    \details
    \author    C3PO
    \version   0.2.0
    \date      2019
	\copyright C3PO Usalafuerza.
    \pre       Incluir plugin C3POCore para incorporar la librería a WordPress.
    \bug       No existen *bugs* actualmente.
    \warning   No existen *warnings* actualmente.
*/ 

// Añade los campos personalizados necesarios para la representación del contenido
add_action( 'cmb2_admin_init',function(){
  
    // Valor de las opciones recogidas
    $options_values = get_option( '_c3po_contents_' );

    // Sino hay opciones seleccionadas, sale de la ejecución.
    if( !$options_values['post_type']) 
        return;

    // Frontend 
    $prefix_mi = 'c3po_multi_image_';
 
    $cmb_box_mi = new_cmb2_box( 
        array(
            'id'            => $prefix_mi . 'metabox',
            'title'         => esc_html__( 'Imagen destacada C3PO', 'cmb2' ),
            'object_types'  => array_keys( $options_values['post_type'] ),
            'context'       => 'side',
            'priority'      => 'low'
        ) 
    );
  
    $cmb_box_mi->add_field( 
        array( 
            'name'       => esc_html__( 'DESKTOP', 'cmb2' ), 
            'id'         => $prefix_mi . 'desktop_image',
            'type'       => 'file',
            'options' => array(
                'url' => false
            ),
            'text'    => array(
                'add_upload_file_text' => 'Establecer imagen destacada'  
            ),
            'preview_size' => 'default'
        ) 
    );

    $cmb_box_mi->add_field( 
        array( 
            'name'       => esc_html__( 'MOBILE', 'cmb2' ), 
            'id'         => $prefix_mi . 'mobile_image',
            'type'       => 'file',
            'options' => array(
                'url' => false
            ),
            'text'    => array(
                'add_upload_file_text' => 'Establecer imagen destacada'  
            ),
            'preview_size' => 'small'
        ) 
    );
    
}); 

// Examina el directorio del tema actual para ver si existe el fichero
// con las clases. Si no existe lo copia desde la ubicación por defecto.     
if( is_file( get_stylesheet_directory() . '/custom-editor-style.css')===false)
    copy( dirname( __DIR__  ) .'/c3po-contents/assets/' . 'custom-editor-style.css' , get_stylesheet_directory() . '/custom-editor-style.css' );
  
// Inicializa el sistema del editor
if ( @!C3POContents::activeEditor() ){
    die('Existe un error con la carga del modulo C3PO Contents');
}

/*
/*! Clase C3POContents 
/*/
class C3POContents {

    // Activa el editor llamando al resto de métodos estaticos.  
    public static function activeEditor(){ 
        self::editorLoadStyle();
        self::removeButtons();
        self::addButtons();
        self::enhancedButtons();
        return TRUE;
    }

    // Elimina de la barra del editor los botones innecesarios.  
    public static function removeButtons(){                
        add_filter( 'mce_buttons', function( $arg )  {
            unset( $arg[0] );
            unset( $arg[5] );
            unset( $arg[11] );
            unset( $arg[14] ); 
            return $arg;
        }); 
    }

    // Añade los botones necesarios en la barra del editor.  
    public static function addButtons(){
        add_filter( 'mce_buttons', function( $arg ){
            $arg[] = 'justify';
            $arg[] = 'outdent';
            $arg[] = 'indent';
            $arg[] = 'styleselect';
            return $arg;
        });
    }

    // Añade un botón personalizado tipo 'select' a la barra del editor.  
    public static function enhancedButtons(){
        
        // Valor de las opciones recogidas 
        add_filter( 'tiny_mce_before_init', function( $arg ) {

            $style_formats = array(
                array(
                    'title'	=> 'Estilos del contenido',
                    'items'	=> array(
                        array(
                            'title'		=> 'Titulo 1',
                            'block'	    => 'h2'
                        ),
                        array(
                            'title'		=> 'Titulo 2',
                            'block'	    => 'h3'
                        ),
                        array(
                            'title'		=> 'Titulo 3',
                            'block'	    => 'h4'
                        ),
                        array(
                            'title'		=> 'Titulo 4',
                            'block'	    => 'h5'
                        ),
                        array(
                            'title'     => 'Parrafo',
                            'inline'    => 'p',
                            'classes'	=> 'p',
                        ),
                        array(
                            'title'		=> 'Preformateado',
                            'block'	    => 'pre',
                            'classes'	=> 'pre',
                        ),
                        array(
                            'title'		=> 'Codigo',
                            'inline'	=> 'code',
                            'classes'	=> 'code',
                        ),
                        array(
                            'title'     => 'Negrita',
                            'inline'    => 'b',
                            'classes'	=> 'b',
                        ),
                        array(
                            'title'		=> 'Negrita SEO',
                            'inline'    => 'strong',
                            'classes'	=> 'strong',
                        ),
                        array(
                            'title'		=> 'Cursiva',
                            'inline'	=> 'i',
                            'classes'	=> 'i',
                        ),
                        array(
                            'title'		=> 'enfasis',
                            'inline'	=> 'em',
                            'classes'	=> 'em',
                        ),
                        array(
                            'title'		=> 'Subrayado',
                            'inline'	=> 'u',
                            'classes'	=> 'u',
                        ),
                        array(
                            'title'		=> 'Tachado',
                            'inline'	=> 'strike',
                            'classes'	=> 'strike',
                        ),
                        array(
                            'title'		=> 'Typewriter',
                            'inline'	=> 'tt',
                            'classes'	=> 'tt',
                        ),
                        array(
                            'title'		=> 'Pequeña',
                            'inline'	=> 'small',
                            'classes'	=> 'small',
                        ),
                        array(
                            'title'		=> 'Grande',
                            'inline'	=> 'big',
                            'classes'	=> 'big',
                        ),
                        array(
                            'title'		=> 'Exponente',
                            'inline'	=> 'sup',
                            'classes'	=> 'sup',
                        ),
                        array(
                            'title'		=> 'Subindice',
                            'inline'	=> 'sub',
                            'classes'	=> 'sub',
                        )
                    )
                ),
                array(
                    'title'	=> 'Estilos del tema',
                    'items'	=> array(
                        array(
                            'title'		=> 'Color corporativo',
                            'inline'	=> 'span',
                            'classes'	=> 'c3po-content-color-corporation-primary',
                        ),
                        array(
                            'title'	=> 'Entrevista',
                            'items'	=> array(
                                array(
                                    'title'		=> 'Pregunta',
                                    'block'	=> 'p',
                                    'classes'	=> 'c3po-content-interview-question',
                                ),
                                array(
                                    'title'		=> 'Respuesta',
                                    'block'	=> 'p',
                                    'classes'	=> 'c3po-content-interview-answer',
                                )
                            ),
                        ),
                        array(
                            'title'	=> 'Texto destacado',
                            'items'	=> array(
                                array(
                                    'title'		=> 'Mediano',
                                    'block' 	=> 'div',
                                    'classes'	=> 'c3po-content-highlight-text-md',
                                ),
                                array(
                                    'title'		=> 'Grande',
                                    'block'	    => 'div',
                                    'classes'	=> 'c3po-content-highlight-text-gr',
                                )
                            ),
                        ),
                        array(
                            'title'	=> 'Roto',
                            'items'	=> array(
                                array(
                                    'title'		=> 'Derecha',
                                    'inline'	=> 'span',
                                    'classes'	=> 'c3po-content-roto-right',
                                ),
                                array(
                                    'title'		=> 'Izquierda',
                                    'inline'	=> 'span',
                                    'classes'	=> 'c3po-content-roto-left',
                                )
                            ),
                        ),
                        array(
                            'title'	=> 'Cita',
                            'items'	=> array(
                                array(
                                    'title'		=> 'Central',
                                    'block' 	=> 'blockquote',
                                    'classes'	=> 'c3po-content-quote c3po-content-central-quote',
                                ),
                                array(
                                    'title'		=> 'Derecha',
                                    'block' 	=> 'blockquote',
                                    'classes'	=> 'c3po-content-quote c3po-content-right-quote',
                                ),
                                array(
                                    'title'		=> 'Izquierda',
                                    'block' 	=> 'blockquote',
                                    'classes'	=> 'c3po-content-quote c3po-content-left-quote',
                                )
                            ),
                        ),
                        array(
                            'title'		=> 'Nota',
                            'block'	    => 'div',
                            'classes'	=> 'c3po-content-note',
                        ),
                        array(
                            'title'		=> 'Nota corporativa',
                            'block' 	=> 'div',
                            'classes'	=> 'c3po-content-corporation-note',
                        ),
                        array(
                            'title'		=> 'Listado de bloques',
                            'block'	    => 'div',
                            'classes'	=> 'c3po-content-block-list',
                        ),
                        array(
                            'title'		=> 'Botón corporativo',
                            'block'     => 'p',
                            'classes'	=> 'c3po-content-corporation-button',
                        ),
                    ),
                ),
            );

            // Recoge los valores del json creado desde las opciones del backend.
            $options_values = get_option( '_c3po_contents_' ); 
         
            // Añade dichas opciones al arreglo.
            if( $options_values['c3po_contents_json_value'] !== '' ) {

                array_push( $style_formats, 
                            json_decode( 
                                $options_values['c3po_contents_json_value'], 
                                true 
                            ) 
                );

            }

            // Añade los estilos a la cola para el editor.
            $arg['style_formats'] = json_encode( $style_formats );
         
            return $arg;

        });

    }

    // Carga el fichero css con las clases definidas en enhanceButtons() 
    // y lo registra en en las partes de inicio del backend y el tema.  
    public static function editorLoadStyle(){

        // Carga el fichero css para el frontend
        add_action ( 'wp_head', function(){

            wp_register_style( 'c3po-contents', get_stylesheet_directory_uri() . '/custom-editor-style.css'  );

            wp_enqueue_style( 'c3po-contents' );
    
        });

        // Carga el fichero css para el backend
        add_action('after_setup_theme', function(){

            add_editor_style( 'custom-editor-style.css' );

        });

    }
    
}  

// Devuelve un arreglo con los tipos de entradas existentes declaradas en WP
// evitando una serie de ellos que no interesa representar.
function _c3po_contents_get_post_types(){

    // Valor de las opciones recogidas
    $options_values = get_option( '_c3po_contents_' ); 

    $actual_post_types = get_post_types(); 
     
    // Recoge el tipo de entradas y paginas que existen en la instalación de WP.
    // Tipos de post que no se han de mostrar.
    $avoided_post_types = array ( 
        'nav_menu_item',
        'custom_css',
        'customize_changeset',
        'oembed_cache',
        'user_request',
        'wp_block',
        'polylang_mo',
        'cpt_c3po_forms'
    );

    $response_post_types = array();

    foreach ( $actual_post_types as $actual_post_types_slug => $actual_post_type_name ) {
        
        if( !in_array( $actual_post_types_slug, $avoided_post_types ) ){
        
            $response_post_types[] = $actual_post_types_slug;
        
        }

    }  
    
    return $response_post_types;

}

// Devuelve un arreglo con las imagenes declaradas desde el backend.
function c3po_contents_get_multi_image( $post_id ){

    $desktop = get_post_meta($post_id,'c3po_multi_image_desktop_image' );

    $mobile = get_post_meta($post_id,'c3po_multi_image_mobile_image' );

    return array ( 
        'thumbnail'     => get_the_post_thumbnail_url( $post_id ),
        'desktop'       => $desktop[0],
        'mobile'        => $mobile[0],
    );
    
}
 
// EOF
