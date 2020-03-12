<?php 

// Prefijo del plugin
$plugin_prefix = 'c3po_video';

// Prefijo del campo de opciones
$plugin_option_prefix =  '_' . $plugin_prefix . '_';

// Registra los campos de configuración 
settings_fields( '__c3po_plugins_options_' . $plugin_prefix ); 

// Valor de las opciones recogidas
$_options_values = get_option( $plugin_option_prefix );  

?>

<h1> <img class="c3po-title-icon" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/006-sith.png" width="16px" alt=""> C3PO Video - <small>Shortcode para la inserción de videos en Páginas/Entradas</small></h1>

<p>Este plugin añade un shortcode para embeber videos de Youtube y Vimeo a las webs desde las paginas/entradas/entradas personalizadas.</p>

<h2>Utilización</h2>

<p>El shortcode puede ser llamado de la siguiente manera.</p>

<pre style="background:#fff;padding:10px;:display:inline-block">[c3po-video url="https://www.youtube.com/watch?v=mM5_T-F1Yn4" width="50%" controls="0" autoplay="0" color="ffff00" start="0" loop="0" align="left" ratio="16/9" ]</pre>

<h2>Párametros</h2>
 
<table class="table-c3po-plugins">
                
    <thead>
    
        <td><b>Párametro</b></td>

        <td><b>Descripción</b></td>

    </thead>
        
    <tr>
        
        <td style="width:200px">
            
            url
            
        </td>

        <td>

            <b>Youtube</b>: https://www.youtube.com/watch?v=mM5_T-F1Yn4 <br> <b>Vimeo</b>: https://vimeo.com/76979871

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        width
            
        </td>

        <td>

        Anchura del video, puede expresarse en % o px.

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        controls
            
        </td>

        <td>

        Oculta (0) o muestra (1) los controles de los videos.

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        autoplay
            
        </td>

        <td>

        Inicia el video al cargar la página (1) o no (0).

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        color
            
        </td>

        <td>

        Color en hexadecimal para el fondo del video.

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        start
            
        </td>

        <td>

        Segundo donde se iniciara el video.

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        loop
            
        </td>

        <td>

        Reproduce el video en bucle (1) o solamente una vez (0)

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        align
            
        </td>

        <td>

        Admite tres parametros: <b>left</b>,<b>center</b> y <b>right</b>.

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        ratio
            
        </td>

        <td>

        Define el aspect ratio afectando directamente a <b>padding-bottom</b>.

        </td>

    </tr> 

</table>
   