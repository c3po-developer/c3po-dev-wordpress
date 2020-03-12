<?php

// Enqueue JS and Css files 
getPublicScriptEnqueue( 'forms_js_script', plugin_dir_url( __FILE__ ) . '/inc/js/c3po-forms.js' );
 
// Include required libs 
if( !class_exists ( 'PHPMailer' ) ) {
    
    include __DIR__ . '/inc/phpmailer/class.phpmailer.php';
    
    include __DIR__ . '/inc/phpmailer/class.smtp.php';
    
    include __DIR__ . '/inc/phpmailer/class.pop3.php';

}

// CPT C3PO Contact Forms 
C3POCore\CPT::build(
    'cpt_c3po_forms',
     array (
            'label'                 => 'Formularios',
            'description'           => 'Formularios',  
            'show_ui'               => true,
            'show_in_menu'          => false,
            'menu_position'         => 30,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'rewrite'				=> array( 'slug' => 'Formularios' ), 
            'capability_type'       => 'page',
            'menu_icon'           	=> 'dashicons-book',
            'labels' => array (
                'name'                  => 'Formularios',                      
                'singular_name'         => 'formulario',                       
                'menu_name'             => 'Formularios',                      
                'name_admin_bar'        => 'Formularios',                      
                'all_items'             => 'All Items',                  
                'add_new_item'          => 'Nuevo formulario',                 
                'add_new'               => 'Añadir',                     
                'new_item'              => 'Nuevo formulario' ,                
                'edit_item'             => 'Editar Item',                
                'update_item'           => 'Actualizar Item',            
                'view_item'             => 'Ver Item',                   
                'view_items'            => 'Ver Items',                  
                'search_items'          => 'Buscar Item',                
                'not_found'             => 'No encontrado',              
                'not_found_in_trash'    => 'No encontrado en papelera',  
                'featured_image'        => 'Imagen destacada',           
                'set_featured_image'    => 'Define la imagen destacada', 
                'remove_featured_image' => 'Borrar la imagen destacada', 
                'use_featured_image'    => 'Usar como imagen destacada', 
                'insert_into_item'      => 'Insertar en el item',        
                'uploaded_to_this_item' => 'Subir a este item',          
                'items_list'            => 'Lista',                      
                'items_list_navigation' => 'Navegación de lista',        
                'filter_items_list'     => 'Filtrar los items',          
        )
    )
);

// Hide single cpt
C3POCore\CPT::hide( 
    array (
        'name'  => 'cpt_c3po_forms',
        'url'   => get_home_url()
    )
);

// Delete the default WP editor in these custom entries.
add_action( 'init', function(){

    remove_post_type_support('cpt_c3po_forms', 'editor');
    
});

// Add the necessary fields for the plugin configuration
add_action( 'cmb2_admin_init', function() {
 
    // Mail host config
    $cmb_c3po_contact_forms_config_prefix = 'c3po_contact_forms_config_';

        // Metabox config
        $cmb_c3po_contact_forms_config = new_cmb2_box( array(
            'id'            => 'cmb_c3po_contact_forms_config',
            'title'         => 'CCF - Configuración del servidor de correo',
            'object_types'  => array( 'cpt_c3po_forms' ), 
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true,  
        ) );

        // Host
        $cmb_c3po_contact_forms_config->add_field( array(
            'name'       => 'Servidor',
            'desc'       => 'Establece el servidor saliente para los correos. P. Ejm. : smtp.gmail.com',
            'id'         => $cmb_c3po_contact_forms_config_prefix . 'host_server',
            'type'       => 'text', 
            'default'       => 'smtp.gmail.com'
        ) );
    
        // Encryption
        $cmb_c3po_contact_forms_config->add_field( array(
            'name'       => 'Encriptación',
            'desc'       => 'Establece el tipo de encriptación para la salida de los correos. P. Ejm. : 465 (SSL) | 587 (TLS)',
            'id'         => $cmb_c3po_contact_forms_config_prefix . 'host_encryption',
            'type'       => 'select', 
            'options'    => array(
                'ssl'   => 'SSL',
                'tls'   => 'TLS' ),
            'default'       => 0
        ) );
        
        // Port
        $cmb_c3po_contact_forms_config->add_field( array(
            'name'       => 'Puerto',
            'desc'       => 'Establece el puerto para la salida de los correos. P. Ejm. : 465 (SSL) | 587 (TLS)',
            'id'         => $cmb_c3po_contact_forms_config_prefix . 'host_port',
            'type'       => 'text', 
            'default'    => '465'
        ) );
        
        // Username
        $cmb_c3po_contact_forms_config->add_field( array(
            'name'       => 'Usuario',
            'desc'       => 'Establece el usuario para la conexión con el servidor de correo establecido.',
            'id'         => $cmb_c3po_contact_forms_config_prefix . 'host_user',
            'type'       => 'text', 
            'default'    => 'c3po.webclients.sender@gmail.com'
        ) );

        // Password
        $cmb_c3po_contact_forms_config->add_field( array(
            'name'       => 'Contraseña',
            'desc'       => 'Establece la contraseña para la conexión con el servidor de correo establecido.',
            'id'         => $cmb_c3po_contact_forms_config_prefix . 'host_pwd',
            'type'       => 'text', 
            'default'    => 'usalajodidaFUERZAluke'
        ) );

    // Mail data values
    $cmb_c3po_contact_forms_email_prefix = 'c3po_contact_forms_email_';

        // Metabox config
        $cmb_c3po_contact_forms_email = new_cmb2_box( array(
            'id'            => 'cmb_c3po_contact_forms_email',
            'title'         => 'CCF - Configuración del correo saliente',
            'object_types'  => array( 'cpt_c3po_forms' ), 
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true,  
        ) );

        // From
        $cmb_c3po_contact_forms_email->add_field( array(
            'name'       => 'Desde (From)',
            'desc'       => 'Establece el nombre desde quién se envia el mensaje. P. Ejm. : CCF - C3PO Usalafuerza',
            'id'         => $cmb_c3po_contact_forms_email_prefix . 'email_from_name',
            'type'       => 'text_multiple', 
        ) );
    
        // To
        $cmb_c3po_contact_forms_email->add_field( array(
            'name'       => 'Para (To)',
            'desc'       => 'Establece el nombre que vera a quién se envia el mensaje desde el formulario. P. Ejm. : Formulario desde web',
            'id'         => $cmb_c3po_contact_forms_email_prefix . 'email_to_name',
            'type'       => 'text_multiple', 
        ) );
    
        // Subject
        $cmb_c3po_contact_forms_email->add_field( array(
            'name'       => 'Asunto (Subject)',
            'desc'       => 'Establece aquí el asunto del email recibido desde la web.',
            'id'         => $cmb_c3po_contact_forms_email_prefix . 'email_subject',
            'type'       => 'text', 
        ) );
    
        // Plantilla
        $cmb_c3po_contact_forms_email->add_field( array(
            'name'       => 'Plantilla',
            'desc'       => 'Establece aquí la plantilla a usar.',
            'id'         => $cmb_c3po_contact_forms_email_prefix . 'email_template',
            'type'       => 'select',
            'options'    => forms_get_files_templates() 
        ) );

        // Plantilla
        $cmb_c3po_contact_forms_email->add_field( array(
            'name'       => 'ID Reply To',
            'desc'       => 'Establece aquí el ID(#) del campo input definido como correo para responder.',
            'id'         => $cmb_c3po_contact_forms_email_prefix . 'email_reply_to_id',
            'type'       => 'text',
            'default'    => 'ccf-email'
        ) );
     
    // Mail data values
    $cmb_c3po_contact_forms_email_attachment_prefix = 'c3po_contact_forms_attachment_';

    // Metabox config
    $cmb_c3po_contact_forms_email_attachment = new_cmb2_box( array(
        'id'            => 'cmb_c3po_contact_forms_attachment',
        'title'         => 'CCF - Configuración de ficheros adjuntos',
        'object_types'  => array( 'cpt_c3po_forms' ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,  
    ) );
 
        // Extensions images
        $cmb_c3po_contact_forms_email_attachment->add_field( array(
            'name'      => 'Extensiones admitidas para imágenes',
            'desc'      => 'Selecciona las extensiones admitidas para poder subir ficheros desde el formulario.',
            'id'        => $cmb_c3po_contact_forms_email_attachment_prefix . 'images',
            'type'      => 'multicheck',
            'options'   => array( 
                'image/jpeg'  => 'jpg/jpeg',
                'image/png'   => 'png',
                'image/gif'   => 'gif',
            )
        ) );

        // Extensions docs
        $cmb_c3po_contact_forms_email_attachment->add_field( array(
            'name'      => 'Extensiones admitidas para documentos',
            'desc'      => 'Selecciona las extensiones admitidas para poder subir ficheros desde el formulario.',
            'id'        => $cmb_c3po_contact_forms_email_attachment_prefix . 'docs',
            'type'      => 'multicheck',
            'options'   => array(
                'application/doc'   => 'doc',
                'application/docx'  => 'docx',
                'application/xls'   => 'xls',
                'application/xlsx'  => 'xlsx',
                'application/pdf'   => 'pdf',
            )
        ) );
        
        // Extensions customize
        $cmb_c3po_contact_forms_email_attachment->add_field( array(
            'name'      => 'Extensiones personalizadas',
            'desc'      => 'Establece una serie de extensiones para que admita el formulario, separadas por coma (,). NO SE COMPRUEBA EL TIPO DE FICHERO EN ESTE CAMPO.',
            'id'        => $cmb_c3po_contact_forms_email_attachment_prefix . 'custom',
            'type'      => 'text'
        ) );

        // Max size
        $cmb_c3po_contact_forms_email_attachment->add_field( array(
            'name'      => 'Tamaño máximo de subida',
            'desc'      => 'Establece el tamaño máximo por fichero. Este valor esta expresado en Mb. P. Ejm. : 10 = 10Mb',
            'id'        => $cmb_c3po_contact_forms_email_attachment_prefix . 'size',
            'type'      => 'text', 
        ) );

    // Log values
    $cmb_c3po_contact_forms_email_log_prefix = 'c3po_contact_forms_log_';

    // Metabox config
    $cmb_c3po_contact_forms_email_log = new_cmb2_box( array(
        'id'            => 'cmb_c3po_contact_forms_log',
        'title'         => 'CCF - Registro de actividad',
        'object_types'  => array( 'cpt_c3po_forms' ), 
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,  
    ) );

        // Extensions images
        $cmb_c3po_contact_forms_email_log->add_field( array(
            'name'          => 'Log',
            'desc'          => '',
            'id'            => $cmb_c3po_contact_forms_email_log_prefix . 'images',
            'type'          => 'log',
            'show_names'    => false,
            'cmb_styles'    => false,
        ) );

});

// Get templates email directory
function forms_get_files_templates(){

    $directory_templates = get_stylesheet_directory() . '/templates/mails';

    if ( is_dir( $directory_templates ) ) {

        $directory_files = scandir($directory_templates);

        foreach ($directory_files as $directory_file) {
        
            if ($directory_file != '.' && $directory_file != '..')
                $template_files[ $directory_file ] = str_replace ( array('_', '.html' ), array( ' ', '' ), $directory_file ) ;
        
            }
        
            return $template_files;

    }

    return FALSE;

}

// Render text_multiple Field
function cmb2_render_text_multiple_field_callback( $field, $value, $object_id, $object_type, $field_type ) {

	// make sure we specify each part of the value we need.
	$value = wp_parse_args( $value, array(
		'text_multiple-1' => '',
		'text_multiple-2' => '', 
	) );

	?>
    
    <div>
        
        <p><label for="<?php echo $field_type->_id( '_text_multiple_1' ); ?>">Nombre</label></p>

		<?php echo $field_type->input( array(
			'name'  => $field_type->_name( '[text_multiple-1]' ),
			'id'    => $field_type->_id( '_text_multiple_1' ),
			'value' => $value['text_multiple-1'],
			'desc'  => '',
        ) ); ?>
        
    </div>
    
	<div>
        
        <p><label for="<?php echo $field_type->_id( '_text_multiple_2' ); ?>'">Email</label></p>

		<?php echo $field_type->input( array(
			'name'  => $field_type->_name( '[text_multiple-2]' ),
			'id'    => $field_type->_id( '_text_multiple_2' ),
			'value' => $value['text_multiple-2'],
			'desc'  => '',
        ) ); ?>
        
    </div> 
    
    <br class="clear">
    
    <?php
    
	echo $field_type->_desc( true );

} add_filter( 'cmb2_render_text_multiple', 'cmb2_render_text_multiple_field_callback', 10, 5 );

function cmb2_render_log_field_callback( $field, $value, $object_id, $object_type, $field_type ) {
 
    global $wpdb;

    $log_content =  $wpdb->get_results( "SELECT * FROM `c3po_forms_log`" );
 
    ?>

        <style>

            #delete_meta_log{
                border: 0; 
                font-size: .7rem; 
                color:red;background:transparent;
                padding:0;
                margin: 10px 0;
                opacity: .2;
                cursor:pointer;
                transition: all .333s ease;
                position:absolute;
                bottom: -30px;
                left: 10px;
            }#delete_meta_log:hover{
                opacity: 1;
            } 

            table#log_table  {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
            }
            table#log_table thead td{
                background:#f9f7f7 !important;
                font-weight: 600;
            }

            table#log_table tr td {
                background: #fdfdfd;
                vertical-align:top;
                border-bottom: 1px solid #f1f1f1;
                border-left: 1px solid #f1f1f1;
            }

            table#log_table tr td.scroll{
                overflow-y: scroll;
                font-size: .8rem;
                color: darkgrey; 
            }
          
            table#log_table tr td.scroll .log{
                transition: all .333s ease;
                height: 10px;
                overflow: hidden;
                opacity: 0;
            }
            table#log_table tr td.scroll .log:hover{
                min-height: 100px;
                height: auto;            
                opacity: 1;
            }
            .modal-log{
                display:none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 15px;
                background: #fff;
                box-shadow: 0 0 3px 1px #b7b7b7;
            }
        </style>

    <?php

    if( $log_content ) {

        ?>
           
            <table id="log_table" data-ajax-url="<?php echo WP_PLUGIN_URL; ?>/c3po-plugins/plugins/c3po-forms/ajax-backend-modal.php">
   
                    <thead>

                        <td>Estado</td>

                        <td>Fecha</td>

                        <td>Hora</td>

                        <td>Host</td> 

                        <td>Usuario</td>

                        <td>Adjuntos</td>  

                        <td>Mensaje</td> 

                    </thead>
 
                <?php 

                    $n_log = array_reverse($log_content);
 
                    foreach ($n_log as $value) { 
                         
                        ?>
                        
                            <tr>

                                <td><?php echo ( $value->{'success_send'} == 1 ) ? '✔' : $value->{'success_send'} ;  ?></td>

                                <td><?php echo $value->{'date_send'}; ?></td>

                                <td><?php echo $value->{'hour_send'}; ?></td>

                                <td><?php echo $value->{'host_send'}; ?></td> 

                                <td><?php echo $value->{'user_send'}; ?></td>  

                                <td><?php echo $value->{'attach_send'} ; ?></td>
  
                                <td><a class="view-log-msg" href="javascript:void(0)" data-id="<?php echo $value->{'id'}; ?>">Ver mensaje</a></td> 

                            </tr>
                                
                        <?php  
                    
                    }

                ?>
            
            </table>

            <div class="modal-log">
                    
                    <span class="close">X</span>

                    <h1>Mensaje recibido: </h1>

                    <div class="msg"></div>

            </div>

        <?php 
        
    } else {
        
        echo '<h4>Aún no se han recibido formularios.</h4>';

    }

    ?>

        <input type="submit" 
               value="Eliminar registro" 
               id="delete_meta_log" 
               data-post-id="<?php echo get_the_ID(); ?>"
               data-ajax-url="<?php echo WP_PLUGIN_URL; ?>/c3po-plugins/plugins/c3po-forms/ajax-backend.php">
   
    <?php

   
} add_filter( 'cmb2_render_log', 'cmb2_render_log_field_callback', 10, 5 );

// Get forms templates
function get_forms_template( $template, $id ){
    
    if( !is_numeric ( $id ) || $id == 0 ) {

        echo 'Error: No se ha encontrado el ID : ' . $id;        
        
        return;

    }

    if( @!include $template ) {

        echo 'Error: No se ha encontrado la vista : ' . $template;        
        
        return;

    }
 
}

// Returns full path from ajax file
function get_ajax_path() {

    return WP_PLUGIN_URL  . '/c3po-plugins/plugins/c3po-forms/ajax.php';

}

function strip_tag_css($text){
    str_replace('html', '', $text);
    return $text;
}