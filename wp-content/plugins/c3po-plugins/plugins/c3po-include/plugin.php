<?php

function c3po_include_shortcode($atts = [], $content = null, $tag = '')
    {
        
        // No se puede ejecutar el shortcode sino tiene atributo o está vacio
        if( !isset ( $atts['file'] ) || $atts['file'] === '' ) {

            echo 'C3PO Include shortcode : Debe insertar el parámetro <b>file</b>'; 

            return false;

        }

        // Fichero a incluir
        $file = getcwd() . '/' . $atts['file'];

        // Si no existe el fichero, lanza un aviso y sale de la ejecución actual.
        if( !is_file( $file ) ){

            echo 'C3PO Include shortcode : El fichero que desea incluir no existe<br>';

            echo $file; 

            return false;

        }

        // Iniciamos el buffer  
        ob_start();

            include ( getcwd() . '/' . $atts['file'] );
        
            $return_include = ob_get_contents();
        
        ob_end_clean(); 
        
        return $return_include;

    } add_shortcode('c3po-include', 'c3po_include_shortcode');
 