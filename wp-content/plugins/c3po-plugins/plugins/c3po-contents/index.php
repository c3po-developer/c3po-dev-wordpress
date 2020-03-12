<?php 

 // Prefijo del plugin
$plugin_subfix = 'c3po_contents';

// Prefijo del campo de opciones
$plugin_option_subfix =  '_' . $plugin_subfix . '_';

// Registra los campos de configuración 
settings_fields( '__c3po_plugins_options_' . $plugin_subfix ); 

// Valor de las opciones recogidas
$options_values = get_option( $plugin_option_subfix ); 
 
if( function_exists('_c3po_contents_get_post_types') ) {

    $response_post_types = _c3po_contents_get_post_types();

}

?> 

<script>
function copyToClipboard(elementId) {
  
  // Create a "hidden" input
  var aux = document.createElement("input");

  // Assign it the value of the specified element
  aux.setAttribute("value", document.getElementById(elementId).innerHTML);

  // Append it to the body
  document.body.appendChild(aux);

  // Highlight its content
  aux.select();

  // Copy the highlighted text
  document.execCommand("copy");

  // Remove it from the body
  document.body.removeChild(aux);

  alert( 'Documento copiado' );

}
</script>

<h1> <img class="c3po-title-icon" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/001-star-wars.png" width="16px" alt="">  C3PO Contents - <small>Estilos personalizados en el classic editor de WP</small></h1>

<p>Este plug-in modifica la barra de herramientas del editor de textos TinyMCE que vienen con WordPress. Se han eliminado las opciones repetidas, ordenado por preferencia de uso y reducido su tamaño para aumentar el tamaño por defecto de la caja de texto.</p>

<hr>

<?php $file_example = file_get_contents (  plugins_url( 'c3po-plugins/plugins/c3po-contents/assets/' ) . 'plantilla_contenidos_c3po_editor.html' );  ?> 
 
<h3 class="pdf-manual">  Manual: <a href="<?php echo plugins_url( 'c3po-plugins/plugins/c3po-contents/assets/' );?>c3po-contents.pdf" target="_blank" ><span class="pdf-link"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAvVBMVEVHcEzHQ0P/2dn7z8/JSkrQWVn////KS0vQXFzJSUnswMD+/f302dnOW1v//v724eH9+vrRZWX89vbUbm713d3PXl7VcXHZfn7z2NjJSkrSaGj67u7QYmLlp6fUbW3ahITmqanQY2PMUlLZf3/OWlr45+f24ODptbX24uLKTU356urRZGTekJDJSUnPX1/QYGDy0tLrvb3KTEzIRUX029vdjY3MVVXosrLrurrXenrinp7gl5fLUFD239/89fWWtdquAAAACnRSTlMA////yv7/zf7MlnrKUQAAAJZJREFUKM9jYKAcMKIATgxpNiTAyMqCV5qZgx2fNBO6PJo0ujy6NJo8qjQE4JKGKiJdmktUBJ+0vKICPmkdXXV80haMPPikTRi18ElbGVnjkebmNTCzxS1taGlnqs3FJcGNVVpD38ZYU4VRSlwYi7S0MqOeuRofn6wkoyAWaTleJVWwIUL8AlikxWR4KIwS2khjAVTIXQDfcRBGt9SuiAAAAABJRU5ErkJggg=="></span>PDF</a></h3>
 
<br/>

<h3 class="pdf-manual">
 
  Ejemplo de contenido: <a href="<?php echo plugins_url( 'c3po-plugins/plugins/c3po-contents/assets/' );?>plantilla_contenidos_c3po_editor.html" target="_blank" ><span class="pdf-link"><img src="data:image/png;base64,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"> </span>HTML</a></h3>
  
  <div style="display:none" id="p1"><?php echo $file_example; ?></div> 

  <div style="cursor:pointer;display:inline-block;transform: translate(2px, -8px);color: #0073aa;font-weight: 600;font-size:11px;text-decoration: underline;" onclick="copyToClipboard('p1')">Copiar al portapapeles</div>
  
<hr>

<h3>Utilización \ Añadir opciones</h3>
  
<p>Puedes añadir en formaton <b>json</b> los grupos de elementos que sean necesarios para el editor de textos.</p>
<?php

  $text = '{
    "title": "Estilos del tema 3",
    "items": [
      {
        "title": "Color corporativo 3",
        "inline": "span",
        "classes": "c3po-content-color-corporation-primary"
      },
      {
        "title": "Entrevista 3",
        "items": [
          {
            "title": "Pregunta",
            "block": "p",
            "classes": "c3po-content-interview-question"
          },
          {
            "title": "Respuesta 3",
            "block": "p",
            "classes": "c3po-content-interview-answer"
          }
        ]
      }
    ]
  }';

  $text_content = (  $options_values['c3po_contents_json_value'] ) ?  $options_values['c3po_contents_json_value'] : $text;


?>
<textarea name="<?php echo $plugin_option_subfix; ?>[c3po_contents_json_value]" 
          class="c3po_plugins_json_contents_textarea"
          autocorrect="off" 
          autocapitalize="off" 
          spellcheck="false"
          id="<?php echo $plugin_option_subfix; ?>id" 
          cols="30" 
          rows="10"><?php echo $text_content; ?></textarea>
  
<small><a href="<?php echo plugins_url( 'c3po-plugins/plugins/c3po-contents/assets/' );?>json_default.json" target="_blank" >Descarga</a> un ejemplo</small>
 
<hr>
 
<h1>C3PO Contents - <small>Multi-image</small></h1>
  
<p>Selecciona aquí en que tipo de entrada deseas que se muestre el añadido:</p>
 
<?php foreach( $response_post_types as $post_type ) { ?>
   
    <?php $checked = ( isset( $options_values['post_type'][ $post_type ] ) && $options_values['post_type'][ $post_type ] == 'on' ) ? 'checked' : '';  ?>

    <input type="checkbox" name="<?php echo $plugin_option_subfix; ?>[post_type][<?php echo $post_type;?>]" id="_c3po_contents_multi_" <?php echo $checked; ?>>

    <label for="<?php echo $plugin_option_subfix; ?>[post_type][<?php echo $post_type;?>]"><?php echo $post_type;?></label> <br>

<?php }  ?>

<hr>

<h2>Multi-image - <small>Funciones</small></h2>

<p>Para poder extraer desde la plantilla el contenido de las multi imágenes se ha de llamar de la siguiente manera:</p>

<code style="display: block;  white-space: pre-wrap "> 
  $banner_images = c3po_contents_get_multi_image( <b>get_the_ID()</b> ); 

</code>
  
<p>Devuelve:</p>

<code style=" display: block;
  white-space: pre-wrap  "> 
    Array ( 
        [thumbnail] => http://www.c3po-dev-wordpress.local/wp-content/uploads/2011/07/dscn3316.jpg 
        [desktop]   => http://www.c3po-dev-wordpress.local/wp-content/uploads/2014/01/dsc20050315_145007_132.jpg 
        [mobile]    => http://www.c3po-dev-wordpress.local/wp-content/uploads/2012/07/manhattansummer.jpg 
    ) 

</code>