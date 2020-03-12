<?php 

// Plugin name
$plugin_subfix = 'c3po_forms';

// Prefix plugin
$plugin_option_subfix =  '_' . $plugin_subfix . '_';

// Register settings fields
settings_fields( '__c3po_plugins_options_' . $plugin_subfix ); 

// Options values
$_options_values = get_option( $plugin_option_subfix ); 
   
// Enqueue JS and Css files 
getAdminScriptEnqueue( $plugin_option_subfix . 'js_script', plugin_dir_url( __FILE__ ) . '/inc/js/c3po-forms.js' );
getPublicScriptEnqueue( $plugin_option_subfix . 'js_script', plugin_dir_url( __FILE__ ) . '/inc/js/c3po-forms.js' );

$link = get_site_url();
 
$posts = array();

$posts = C3POCore\Query::get_posts( 'cpt_c3po_forms' ); 
 
$_PHPMailer_trigger = class_exists ( 'PHPMailer' );
 
?> 
 
<h1 style="display:block"> <img class="c3po-title-icon" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/002-villain.png" width="16px" alt=""> C3PO Forms - <small>Formularios de contacto</small></h1>
 
<p>Plugin para la creación y gestión de formularios de contacto</p>

<p>Al activar este plugin, se carga en el sistema y activa la libreria PHPMailer para el envío de los formularios. Actualmente la librería <b><?php echo ( $_PHPMailer_trigger ) ? 'esta activada.' : 'no ha podido ser activada debido a algún error desconocido.'; ?></b></p>

<a style="display:inline-block" href="<?php echo $link; ?>/wp-admin/post-new.php?post_type=cpt_c3po_forms" class="c3po_forms_btn-link">Nuevo formulario</a>
 
<table class="table-c3po-plugins" style="margin-top: 15px;">
                
    <thead>
    
        <td><b>ID</b></td>

        <td><b>Nombre</b></td>
          
    </thead>
         
        <?php if ( is_array ( $posts ) ) { foreach ($posts as $post) { ?>

            <tr>
            
                <td style="width:40px">
            
                    <span><?php echo $post['id']; ?></span>
                
                </td>

                <td>
            
                    <span style="margin:0 0 0 5px"><a href="<?php echo $link; ?>/wp-admin/post.php?post=<?php echo  $post['id']; ?>&action=edit"><?php echo $post['title']; ?></a></span>
                    
                    <span><a class="c3po_forms_btn-trash" href=" <?php echo wp_nonce_url( $link . "/wp-admin/post.php?post=" .  $post['id'] ."&action=trash", 'trash-post_'. $post['id'] ); ?>">Delete</a></span>
                   
                </td>
    
            </tr>

        <?php } } ?> 
  
</table>
 