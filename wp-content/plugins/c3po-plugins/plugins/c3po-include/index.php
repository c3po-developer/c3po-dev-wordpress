<?php 

// Prefijo del plugin
$plugin_prefix = 'c3po_multicontents';

// Prefijo del campo de opciones
$plugin_option_prefix =  '_' . $plugin_prefix . '_';

// Registra los campos de configuración 
settings_fields( '__c3po_plugins_options_' . $plugin_prefix ); 

// Valor de las opciones recogidas
$_options_values = get_option( $plugin_option_prefix );  

?>

<h1> <img class="c3po-title-icon" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/004-cinema.png" width="16px" alt="">  C3PO Include - <small>Shortcode para la inserción ficheros en paginas/entradas/entradas personalizadas</small></h1>

<p>Este plugin añade un shortcode para incluir ficheros a las webs desde las paginas/entradas/entradas personalizadas.</p>

<h2>Utilización</h2>

<p>El shortcode puede ser llamado de la siguiente manera.</p>

<pre style="background:#fff;padding:10px;:display:inline-block">[c3po-include file="hello.txt"]</pre>
 
<h2>Párametros</h2>
 
<table class="table-c3po-plugins">
                
    <thead>
    
        <td><b>Párametro</b></td>

        <td><b>Descripción</b></td>

    </thead>
        
    <tr>
        
        <td style="width:200px">
            
            file
            
        </td>

        <td>

            Fichero a incluir desde el contenido. El camino de inicio es <b>la raíz del sitio web</b>

        </td>

    </tr>
  
</table>
 