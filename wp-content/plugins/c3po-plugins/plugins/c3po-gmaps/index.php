<?php

/**
 *  C3PO Gmaps :: Backend page options
 * 
 * @package   c3po-plugins-legals
 * @author    web@usalafuerza.com
 * @link      http://usalafuerza.com
 */

// Prefijo del plugin
$plugin_subfix = 'c3po_gmaps';

// Prefijo del campo de opciones
$plugin_option_subfix =  '_' . $plugin_subfix . '_';

// Registra los campos de configuración 
settings_fields( '__c3po_plugins_options_' . $plugin_subfix ); 

// Valor de las opciones recogidas
$_options_values = get_option( $plugin_option_subfix );  
 
$_meta_textarea_json_content = $_options_values['c3po_gmaps_json_value'];

$_meta_textarea_json_content = ( $_meta_textarea_json_content != '' ) ? $_meta_textarea_json_content : '{}';

$_api_key = $_options_values['c3po_gmaps_api_key'];

$_api_key = ( $_api_key === '' ) ? 'AIzaSyDSgzOLsD2xiBAY3F_FVQhHqloUREmRud0' : $_options_values['c3po_gmaps_api_key'];

?>
  
<h1> <img class="c3po-title-icon" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/003-r2d2.png" width="16px" alt=""> C3PO gmaps - <small>Shortcode para la inserción de mapas desde Google Maps</small></h1>

<p>Este plugin añade un shortcode para la inserción de mapas desde Google Maps a las webs desde las paginas/entradas/entradas personalizadas.</p>

<h2>Instrucciones</h2>

<p>Una vez <u>insertado el shortcode en el contenido</u> del la entrada/entrada personalizada/página se puede llamar a su representación de dos maneras:</p>

<ul>
    
    <li>
        
        <b>Desde el propio contenido</b>
        
        <p style="margin:0 0 10px 20px">Hay que establecer el parametro <b>oncontent="1"</b>, de esta manera el/los mapa/s se dibujaran en el propio contenido de la misma.</p>

    </li>

    <li>
        
        <b>Desde la plantilla</b>

        <p style="margin:0 0 0 20px">Hay que establecer el parametro <b>oncontent=""</b> y usar la función <b>c3poGmaps_getMap( <i>[id]</i> );</b> para dibujar el/los mapa/s donde se llame a la función.</p>

    </li>
    
</ul>
  
<hr>
   
<h2>Utilización</h2>

<p>El shortcode puede ser llamado de la siguiente manera.</p>

<pre style="background:#fff;padding:10px;:display:inline-block">[c3po-gmaps </br> oncontent="1" <br> title="Test" <br> control="zoom" <br> id="map1" <br> lat="39.721542" <br> lng="2.9019924" <br> zoom="18" <br> m-icon="https://maps.google.com/mapfiles/kml/shapes/parking_lot_maps.png" <br> m-lat="39.721542" <br> m-lng="2.9019924"<br>]</pre>
 
<hr>

<h2>API</h2>

<table>
    
    <tr>
                
        <td style="width:200px;vertical-align:top">
            
            <b>Google API key</b>
            
        </td>

        <td>

            <input type="text" 
                   class="regular-text"
                   name="<?php echo $plugin_option_subfix; ?>[c3po_gmaps_api_key]"
                   id="c3po_gmaps_api_key_id" 
                   value="<?php echo $_api_key; ?>">  

            <small style="display:block">Introduce aquí una API KEY valida.</small>

            <small style="display:block">API Actual: <b>AIzaSyDSgzOLsD2xiBAY3F_FVQhHqloUREmRud0</b></small>

        </td>

    </tr>

</table>

 <hr>

<h2>Párametros</h2>
 
<table class="table-c3po-plugins">
                
    <thead>
    
        <td><b>Párametro</b></td>

        <td><b>Descripción</b></td>

    </thead>
        
    <tr>
        
        <td style="width:200px">
            
            oncontent
            
        </td>

        <td>

            Establece donde se va mostrar el div con el mapa. <br> <br>
            0 = Llamado desde la función <br>
            1 = Desde el propio content

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
            title
            
        </td>

        <td>

            Título del marcador

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
            control
            
        </td>

        <td>

            Activa los controles. 
            
            <br><br>
            
            Actualmente solamente soporta el control='zoom'

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
            id
            
        </td>

        <td>

            Identificador del mapa. Este valor es el que se utiliza para cuando se llama a la función para representarlo en una plantilla. 
            Además, es el identificador (#id) del elemento DIV que se crea para pintar el mapa dentro. 
            A este DIV hay que establecerle una altura y anchura para poder visualizar el mapa, p. ejm.: <br><br> 
            <i><b>#map1, #map2 { width:100%; height:200px; }</b></i> 

        </td>

    </tr>
 
    <tr>
        
        <td style="width:200px">
            
        lat
            
        </td>

        <td>

            Latitud del mapa

        </td>

    </tr>
  
    <tr>
        
        <td style="width:200px">
            
        lng
            
        </td>

        <td>

            Longitud del mapa

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        zoom
            
        </td>

        <td>

            Altura del mapa

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
            m-icon
            
        </td>

        <td>

            Url con la imagén para el icono usado como marcador

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
            m-lat
            
        </td>

        <td>

            Latitud del marcador.

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
            m-lng
            
        </td>

        <td>

            Longitud del marcador.

        </td>

    </tr>

</table>
 
<hr>

<h2>Temas</h2>
 
<p>Esta versión de C3PO Gmaps soporta poder modificar los estilos graficos de los mapas pasandole un JSON con la configuración de colores que deseemos.</p>
   
<textarea name="<?php echo $plugin_option_subfix; ?>[c3po_gmaps_json_value]" 
          class="_c3po_json_contents_textarea"
          autocorrect="off" 
          autocapitalize="off" 
          spellcheck="false"
          class="_c3po_gmaps_id"
          id="<?php echo $plugin_option_subfix; ?>id" cols="30" rows="10"
          onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"><?php echo $_meta_textarea_json_content; ?></textarea>

<small>Puede descargar <a href="https://mapstyle.withgoogle.com/" target="_blank">aquí</a> los diferentes estilos para los mapas.</small>
 