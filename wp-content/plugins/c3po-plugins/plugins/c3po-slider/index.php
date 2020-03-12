<?php 

// Plugin name
$plugin_subfix = 'c3po_slider';

// Prefix plugin
$plugin_option_subfix =  '_' . $plugin_subfix . '_';

// Register settings fields
settings_fields( '__c3po_plugins_options_' . $plugin_subfix ); 

// Options values
$_options_values = get_option( $plugin_option_subfix ); 
   
// Enqueue JS and Css files 
getAdminScriptEnqueue( $plugin_option_subfix . 'js_script', plugin_dir_url( __FILE__ ) . '/inc/js/c3po-slider.js' );


$posts = C3POCore\Query::get_posts( 'cpt_c3po_sliders' ); 

$link = get_site_url();
  
?> 
 
<h1> <img class="c3po-title-icon" src="http://www.c3po-dev-wordpress.local/wp-content/plugins/c3po-plugins/assets/monitor.png" width="16px" alt=""> C3PO Slider - <small>Instancia de Slick slider de C3PO</small></h1>

<small><b>Incluye en frontend la librería del plugin jQuery <i>Slick slider</i></b></small>

<br>

<br>

<a style="display:inline-block" href="<?php echo $link; ?>/wp-admin/post-new.php?post_type=cpt_c3po_sliders" class="c3po_forms_btn-link">Nuevo slider</a>

<hr>

<table class="table-c3po-plugins" style="margin-top: 15px;">
                
    <thead>
    
        <td><b>ID</b></td>

        <td><b>Nombre</b></td>
          
    </thead>
         
        <?php 
        
            if ( is_array ( $posts ) ) { 
                
                foreach ($posts as $post) { 
                
                    ?>

                        <tr>
                        
                            <td style="width:40px">
                        
                                <span><?php echo $post['id']; ?></span>
                            
                            </td>

                            <td>
                        
                                <span style="margin:0 0 0 5px"><a href="<?php echo $link; ?>/wp-admin/post.php?post=<?php echo  $post['id']; ?>&action=edit"><?php echo $post['title']; ?></a></span>
                                
                                <span><a class="c3po_forms_btn-trash" href=" <?php echo wp_nonce_url( $link . "/wp-admin/post.php?post=" .  $post['id'] ."&action=trash", 'trash-post_'. $post['id'] ); ?>">Delete</a></span>
                            
                            </td>
                
                        </tr>

                    <?php 
                
                } 
        
            } else {

                ?>
                    
                    <tr>
                        
                        <td style="width:40px">
                        
                            0
                            
                        </td>

                        <td>
                    
                            No existen resultados
                        
                        </td>
                        
                    </tr>

                <?php 

            }
            
        ?> 
  
</table>