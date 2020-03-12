<?php 

// Prefijo del plugin
$plugin_prefix = 'c3po_index';

// Prefijo del campo de opciones
$plugin_option_prefix =  '_' . $plugin_prefix . '_';

// Registra los campos de configuración 
settings_fields( '__c3po_plugins_options_' . $plugin_prefix ); 

// Valor de las opciones recogidas
$_options_values = get_option( $plugin_option_prefix ); 
  
// Carga el js necesario para la ejecución de la pagina
getAdminScriptEnqueue('c3po-index', plugin_dir_url( __FILE__ )  . 'inc/js/c3po-index.js' );

$wp_info = c3po_index_get_wp_info();
 
?>
 
<h1>Plugins <b>C3PO</b></h1>

<h2>Introducción</h2>

<p>Desde esta página se establece que plugins van a ser cargados en la ejecución de WordPress desde la colección instalada desde este propio plugin, así como las paginas de opciones necesarias para su correcta configuración.</p>

<h2>Listado de plugins</h2>

<table class="table-c3po-plugins">
            
    <thead>
    
        <td><b>Nombre</b></td>

        <td><b>Activo</b></td>

    </thead>
    
    <?php 
    
        $plugins_list = ( __c3po_plugs() ) ?: array();

        foreach ( $plugins_list as $c3po_registered_plugin ) {

            $checked = ( isset ( $_options_values [ $c3po_registered_plugin['register_slug'] ] ) ) ? $_options_values [ $c3po_registered_plugin['register_slug'] ] : '';
            
            ?> 
        
                <tr>
                    
                    <td style="width:200px">
                        
                        <label for="<?php echo $plugin_option_prefix; ?>[<?php echo $c3po_registered_plugin['register_slug']; ?>"><?php echo $c3po_registered_plugin['name']; ?></label> 
                        
                    </td>

                    <td>

                        <input type="checkbox" 
                            class="selectables-checkboxs"
                            name="<?php echo $plugin_option_prefix; ?>[<?php echo $c3po_registered_plugin['register_slug']; ?>]" 
                            id="<?php echo $plugin_option_prefix; ?>[<?php echo $c3po_registered_plugin['register_slug']; ?>"
                            <?php echo ( $checked == 'on' ) ? 'checked="checked"' : '' ; ?> >

                    </td>

                </tr>
            
                    
            <?php 

        }

    ?>

</table>

<small><a href="#" class="c3po-index-select-all">Seleccionar todos los campos</a> - <a href="#" class="c3po-index-unselect-all">Deseleccionar todos los campos</a></small>

<h2>Directorios</h2>

<p>Directorio de instalación de los plugins: </br><b><small><?php echo plugin_dir_path( __FILE__ ) . 'plugins/'; ?></small></b></p>

<h2>Estado de WordPress</h2>

<div>

<b>Modo debug:</b> <h3 class="sub-title" style="display:inline-block"><?php echo $wp_info['debug']; ?></h3> |

 <b>Servidor:</b> <h3 class="sub-title" style="display:inline-block"><?php echo $wp_info['server']; ?></h3> |

 <b>Robots:</b> <h3 class="sub-title" style="display:inline-block"><?php echo $wp_info['robots']; ?></h3></div>
 
 <div style="clear:both"></div>
 