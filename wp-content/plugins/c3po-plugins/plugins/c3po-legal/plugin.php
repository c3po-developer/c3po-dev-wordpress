<?php

/**
 *  C3PO Legals :: Functions
 * 
 * @package   c3po-plugins-legals
 * @author    web@usalafuerza.com
 * @link      http://usalafuerza.com
 */
 
// Añade los campos personalizados necesarios para la representación del contenido
add_action( 'cmb2_admin_init',function(){
 
    $prefix = 'legal_';

    $cmb_box = new_cmb2_box( 
        array(
            'id'            => $prefix . 'metabox',
            'title'         => esc_html__( 'Plantillas de Políticas de privacidad, cookies, aviso legal.', 'cmb2' ),
            'object_types'  => array( 'page' ),
            'show_on'       => array( 'key' => 'page-template', 'value' => 'templates/legals.php' ),
        ) 
    );

    $cmb_box->add_field( array(
        'name'    => 'Documentos',
        'desc'    => 'Lista de documentos que se mostraran en la plantilla.',
        'id'      => $prefix . 'legal_docs',
        'type'    => 'multicheck',
        'options' => array(
            'cookies'       => 'Política de cookies',
            'legal'         => 'Política de aviso legal',
            'privacity'     => 'Política de privacidad',
        ),
    ) );
    
}); 

add_action( 'admin_init', function(){

    $post_get = ( isset ($_GET['post']) ) ? $_GET['post'] : 0;

    $post_ID_get = ( isset ($_GET['post_ID']) ) ? $_GET['post_ID'] : 0;

    $post_id = ( $post_get != 0 ) ? $_GET['post'] : $post_ID_get ;
      
    $post_template = get_post_meta( $post_id, '_wp_page_template', true );
    
    if( $post_template === "templates/legals.php" ) {
        
        remove_post_type_support('page', 'editor');

    }

});
  
// Añade al pie de página el html/js para mostrar el aviso.
add_action('wp_footer', function(){
 
    // Pagina de opciones de C3PO Legals
    $options_values = get_option( '_c3po_legal_' ); 
  
    $lang = ( function_exists( 'pll_current_language') ) ? 'pll_' . pll_current_language() : 'pll_es';
 
    $duration = $options_values['c3po_legal_cookies_content_duration'];

    $theme = $options_values['c3po_legal_cookies_content_theme'];
   
    ?>

        <script>var duration = <?php echo $duration; ?></script>

        <script src="<?php echo plugin_dir_url(__FILE__);?>inc/js/c3po-legal.js"></script>  

        <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__);?>themes/<?php echo $theme; ?>/c3po-cookies-style.css">

        <div class="c3po-cookies-advice">

            <div class="viewport">

                <div class="title"><?php echo $options_values['c3po_legal_cookies_content_title_' . $lang]; ?></div>

                <div class="content">

                    <?php echo $options_values['c3po_legal_cookies_content_advice_' . $lang]; ?>

                    <a id="c3po-cookies-accept-btn" href="#"><?php echo $options_values['c3po_legal_cookies_content_accept_' . $lang]; ?></a>
                
                </div>

            </div>

        </div>

    <?php

}, 30 );

// Devuelve el aviso para los formularios.
function c3poLegal_getFormAdvice( $lang = NULL ) {
 
    // Pagina de opciones de C3PO Legals
    $options_values = get_option( '_c3po_legal_' ); 
    
    // Si existen opciones definidas para la sustitución, se aplican
    if( $options_values['c3po_contents_json_value'] ) {
        
        $literals = replace( 
            json_decode( $options_values['c3po_contents_json_value'] ), 
            $options_values[ 'c3po_legal_cookies_content_forms_pll_' . ( ( $lang !== NULL ) ? $lang : pll_current_language() ) ]
        );
        
    }
    
    return $literals;
 
}

// Devuelve los documentos legales en función de las opciones seleccionadas en el backend.
function c3poLegal_getLegalDocs( $lang = NULL ){

    // Recoge el tipo de documentos a mostrar en la plantilla
    $post_meta_docs = get_post_meta( get_the_ID(), 'legal_legal_docs', true );
 
    // Pagina de opciones de C3PO Legals
    $options_values = get_option( '_c3po_legal_' ); 

    // Opciones seleccionadas
    $option_selected = '';
 
    // Retorno
    $return = '';

    // Si existen opciones seleccionadas
    if( $post_meta_docs !== '' ) {
        
        // Iteramos por cada opción seleccionada
        foreach( $post_meta_docs as $post_meta_doc ) {

            // Elige el literal adecuado por cada iteración.
            switch( $post_meta_doc ){
                
                case 'cookies':
                
                    $option_selected = 'c3po_legal_cookies_content_page_pll_';
                 
                    break;

                case 'legal':

                    $option_selected = 'c3po_legal_legal_condition_content_page_pll_';
                 
                    break;
                
                case 'privacity':

                    $option_selected = 'c3po_legal_privaticy_policy_content_page_pll_';
                
                    break;
                    
            }
      
            // Si existen opciones definidas para la sustitución, se aplican
            if( $options_values['c3po_contents_json_value'] ) {

                $return .= replace( 
                    json_decode( $options_values['c3po_contents_json_value'] ), 
                    $options_values[ $option_selected . ( ( $lang !== NULL ) ? $lang : pll_current_language() ) ]
                );

            }

        }
  
    }

    return $return;

}

// Función auxiliar para la transformación y remplazo de keywords en un string
function replace( $needles, $string ){
   
    return strtr( $string, (array ) $needles );

}

// EOF
