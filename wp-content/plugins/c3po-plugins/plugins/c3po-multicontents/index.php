<?php 

// Prefijo del plugin
$plugin_prefix = 'c3po_multicontents';

// Prefijo del campo de opciones
$plugin_option_prefix =  '_' . $plugin_prefix . '_';

// Registra los campos de configuración 
settings_fields( '__c3po_plugins_options_' . $plugin_prefix ); 

// Valor de las opciones recogidas
$_options_values = get_option( $plugin_option_prefix );  
    
$args = array(
    'post_type' => 'page',
    'post_parent' => 0, 
    'posts_per_page' => -1,
    'post__not_in' => array('3','5','11'),
);
  
$qry = new WP_Query($args); 
   
$result_default_lang = pll_default_language('slug'); 

?>

<script>

  jQuery(function($){  

      $('.select-all').click ( function(event){

          event.preventDefault();
          
          if ( !$(this).hasClass('already-selected') ){

            $(this).addClass('already-selected');
            
            $('.pages-fields input').each(function(){

                $(this).prop('checked', true );

            });

          } else {

            $(this).removeClass('already-selected');
            
            $('.pages-fields input').each(function(){

                $(this).prop('checked', false );

            });
 
          }
         
          
      });

      $('.cb_page_selector').click( function(){

        if( !$(this).hasClass('clicked') ) {

            $(this).parent().next( 'ul.pages_ids_related' ).each( function (){
                console.log( $(this).children().children().prop( 'checked', true) );
            });
            $(this).addClass('clicked');

        } else {

            $(this).parent().next( 'ul.pages_ids_related' ).each( function (){
                console.log( $(this).children().children().prop( 'checked', false) );
            });
            $(this).removeClass('clicked');

        }
         
      });

  });

</script>

<style>

    .cb_page_selector{
        display: inline-block;
        transform: translateY(3px);
    }
    span.id{
        font-size: 11px;
        letter-spacing: 1px;
        display: inline-block;
        transform: translateY(1px);
    }
    .p_title{
        display: inline-block;
        transform: translateY(2px);
    }

    ul.pages_ids_related{
        margin: 5px 0 15px 40px;
        padding: 0;
        list-style: square;
    }
    ul.pages_ids_related li{ 
        color:#8a8a8a;
    }
</style>

<h1> <img class="c3po-title-icon" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/004-cinema.png" width="16px" alt="">  C3PO Multicontents - <small>Crea campos personalizados en bucle para su multiple uso en el frontend</small></h1>
  
<h2>Opciones:</h2>

<p>Selecciona la página/s donde quieras activar el plugin:</p>

<div class="pages-fields">

    <?php 

        $actived_langs = pll_languages_list( array  ('fields' => 'slug' ) );

        $checked = ''; 

        foreach( $qry->posts as $pages ){ 
    
        $name_main = $plugin_option_prefix .'[c3po_multicontent_selector_pages_' . $pages->{'ID'} . ']'; 
 
        if( isset ( $_options_values['c3po_multicontent_selector_pages_' .$pages->{'ID'}  ] ) ) {
 
            $checked = 'checked';

        } else {
            $checked = '';
        }
 
        ?>

            <label for="c3po_multicontent_selector_page_id_<?php echo $pages->{'ID'}; ?>">

                <input type="checkbox" 
                       value="<?php echo $pages->{'ID'}; ?>"  
                       name="<?php echo $name_main; ?>"
                       class="cb_page_selector  <?php echo ( $checked != '' ) ? 'clicked' : ''; ?>"
                       <?php echo $checked; ?>
                       id="c3po_multicontent_selector_page_id_<?php echo $pages->{'ID'}; ?>" >
                        
                    <?php echo '<span class="id">[id: '. $pages->{'ID'} . ']</span>  <b class="p_title"> | ' . $pages->{'post_title'}; ?></b>
                    
                </input>

            </label>

            <ul class="pages_ids_related">

                <?php

                    foreach( $actived_langs as $lang_children ) {
                     
                        $id_children  = pll_get_post( (int) $pages->{'ID'}, $lang_children );  

                        $name_children = $plugin_option_prefix .'[c3po_multicontent_selector_pages_' . $id_children . ']';
 
                        if( isset ( $_options_values['c3po_multicontent_selector_pages_' . $id_children ] ) ) {
 
                            $checkeds = 'checked';

                        } else {
                            $checkeds = '';
                        }

                        if( $id_children != '' && $id_children !== $pages->{'ID'} ){
                            
                            $id_parent[$lang_children] = $id_children;

                            ?>

                            <label for="c3po_multicontent_selector_page_id_<?php echo $id_children; ?>">

                                <input type="checkbox" 
                                       value="<?php echo $id_children; ?>"  
                                       name="<?php echo $name_children; ?>"
                                       class="cb_page_selector_children"
                                       <?php echo $checkeds; ?>
                                       id="c3po_multicontent_selector_page_id_<?php echo $id_children; ?>" >
                                        
                                    <?php echo '<span class="id"><span style="text-transform:uppercase">[ ' . $lang_children . ' ] | </span>[id: '. $id_children . ']</span>  <b class="p_title"> | ' . get_the_title( $id_children ); ?></b>
                                    
                                </input>

                            </label>

                            <?php
                          
                            $id_parent = '';

                        }

                    }

                ?>

            </ul>

        </label> 

    <?php } ?>

</div>

<br>

<small><a href="" class="select-all">Seleccionar \ Deseleccionar todos los campos</small></a>

<h2>Uso:</h2>

<pre style="background:#fff;padding:10px;display:inline-block">...<br>// Recoge el valor de un campo definido desde el backend usando la key para localizarlo.<br><b>c3po_get_mc</b>( $key, $format = '', $id = '' );<br>...</pre>

<h2>Parametros:</h2>

<table class="table-c3po-plugins">
            
    <thead>

    <td><b>Párametro</b></td>

    <td><b>Descripción</b></td>

    </thead>
        
    <tr>
        
        <td style="width:200px">
            
            $key
            
        </td>

        <td>

            Llave usada como nombre del campo generado desde la edición de la página.

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        $format
            
        </td>

        <td>

        (Opcional) El formato que se desea de salida: <br> <br> <b>NULL</b> - Salida estandar con marcado HTML <br> <b>'raw'</b> - Salida en crudo, sin marcado HTML.

        </td>

    </tr>

    <tr>
        
        <td style="width:200px">
            
        $id
            
        </td>

        <td>

        (Opcional) El <b>ID</b> de la página a recoger el contenido.

        </td>

    </tr>

</table>

 