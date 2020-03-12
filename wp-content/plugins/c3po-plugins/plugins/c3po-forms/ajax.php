<?php 

// Include required libs
include( preg_replace('/wp-content.*$/','',__DIR__) . 'wp-load.php');
 
// Check if PHPMailer plugin is installed
if( !class_exists ('PHPMailer') ) {
    
    echo json_encode( 0 );

    return;

}

// Get params from serialize form
$params = array();

parse_str( $_POST['form'], $params ); 
 
// Instance PHPMailer 
$mail = new PHPMailer;

// CPT Values 
$host       = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_config_host_server' );

$encryption = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_config_host_encryption' );

$port       = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_config_host_port' );
 
$user       = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_config_host_user' );

$pwd        = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_config_host_pwd' );

$from       = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_email_email_from_name' );

$to         = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_email_email_to_name' );

$subject    = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_email_email_subject' );

$template   = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_email_email_template' );

$images     = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_attachment_images' );

$sizes      = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_attachment_size', 1);
 
$max_size   = ( $sizes * 1048576 );

$docs       = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_attachment_docs' );

$custom     = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_attachment_custom' );

$reply_to   = get_post_meta( $_POST['form_id'], 'c3po_contact_forms_email_email_reply_to_id' );

// PHPMailer configuration 
$mail               = new PHPMailer;

$mail->isSMTP();

$mail->SMTPDebug    = 0;

$mail->CharSet      = 'UTF-8';

$mail->Host         = $host[0];

$mail->Port         = $port[0];

$mail->SMTPSecure   = $encryption[0];

$mail->SMTPAuth     = true;

$mail->Username     = $user[0];

$mail->Password     = $pwd[0];

$mail->Subject      = $subject[0];
  
// Check if exist attach files
if( count ( $_FILES ) != 0 ) {
 
    // Iterating through all items
    for( $i = 0; $i <= ( count ( $_FILES ) - 1 ); $i ++ ) {
       
        $ext_foile = pathinfo( $_FILES[$i]['name'], PATHINFO_EXTENSION);
        
        $ext_foiles = 'application/'. $ext_foile; 
 
        // Check type extension 
        if( in_array ( $ext_foiles, $images[0] ) ||
            in_array ( $ext_foile, explode ( ',', $custom ) ) ||
            in_array ( $ext_foiles, $docs) ) {
             
            // Check size file
            if( $_FILES[$i]['size'] <= $max_size ) {

                // Add files to mail attachtment 
                $mail->AddAttachment(
                    $_FILES[$i]['tmp_name'],
                    $_FILES[$i]['name']
                );

            } else {
                
                // Return error if the size exceeds the set
                echo json_encode(2);

                die();

            }

        } else {

            // Return error if extensions is not exist defined on backend
            echo json_encode(3);

            die();

        }
                
    } 

}

// Load template selected
$template_load = get_stylesheet_directory() . '/templates/mails/' . $template[0]; 

// If template exist
if( is_file ( $template_load ) ) {

    // Get all keys params 
    $params_keys = array_keys( $params );
    
    // Add pre/sufix 
    foreach ($params_keys as $key => $value) {

        $params_prefixed[] = '{' . $value . '}';

    }

    // Include template
    ob_start();

        include $template_load;
        
        $content = ob_get_contents();
    
    ob_end_clean();
  
    $to_array_name = explode ( ',',  $to[0]['text_multiple-1'] );

    $to_array = explode( ',', $to[0]['text_multiple-2'] );
 
    // Add address to email
    foreach( $to_array as $key => $too ){

        $mail->addAddress(
            $too,
            ( isset ( $to_array_name[$key] ) ) ? $to_array_name[$key] : ''
        );
        
    }
 
    // Clear all reply to 
    $mail->ClearReplyTos();

    $name = ( $params['ccf-name']  ) ? $params['ccf-name']  : $params[$reply_to[0]];

    $surnames = ( $params['ccf-surname'] ) ? ' ' . $params['ccf-surname'] : '';
  
    // Add Reply get in from element input with ID defined in backend config.
    $mail->AddReplyTo( 
        $params[$reply_to[0]], 
        $name . $surnames
    ); 
     
    // Set from sending mail.
    $mail->setFrom(
        $from[0]['text_multiple-2'],
        $from[0]['text_multiple-1']
    );

    // Replace keys with params get in by form
    $content = str_replace( $params_prefixed, $params, $content );
     
    $content = replaceVariable( $content, '{', '}','Vacio' );
     
    $content = preg_replace("/\bon\b/", 'Si', $content);

    // Add message to email sender
    $mail->msgHTML( $content );
  
    // Return value
    $return_send = ( !$mail->send() ) ? "Mailer Error: " . $mail->ErrorInfo : 1;
 
    $date = getdate();
   
    // Log    
    if ( checkTableLog() ) {

        $wpdb->insert('c3po_forms_log', array( 
            'date_send'             => $date['year'].'/'.$date['mon'].'/'.$date['mday'],
            'hour_send'             => $date['hours'] . ':' . $date['minutes'],
            'host_send'             => $host[0],
            'port_send'             => $port[0],
            'encr_send'             => $encryption[0],
            'user_send'             => $user[0],
            'from_send'             => serialize ( $from[0] ),
            'reply_send'            => $params[$reply_to[0]],
            'subject_send'          => $subject[0],
            'message_send'          => base64_encode (  $content ),
            'attach_send'           => count ( $_FILES ),
            'success_send'          => $return_send
        ));

    }

    // Response
    echo json_encode( $return_send );

    die();
    
} else {

    // Return error if template is not exist 
    echo json_encode(4);

    die();

}
 
function replaceVariable($body,$needleStart,$needleEnd,$replacement){

    while( strpos( $body, $needleStart ) ) {

        $start  = strpos($body,$needleStart);

        $end    = strpos($body,$needleEnd);

        $body   = substr_replace($body,$replacement,$start,$end-$start+1);

    }

    return $body;

}
 
function checkTableLog() {
     
    global $wpdb;
   
    $table_name = 'c3po_forms_log';
 
    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );

    if ( $wpdb->get_var( $query ) == $table_name ) {

        return true;

    }
  
    $sql = 'CREATE TABLE '.$table_name.'(
        id INTEGER NOT NULL AUTO_INCREMENT,  
        date_send VARCHAR(255),
        hour_send VARCHAR(255),
        host_send VARCHAR(255),
        port_send VARCHAR(255),
        encr_send VARCHAR(255),
        user_send VARCHAR(255),
        from_send VARCHAR(255),
        reply_send VARCHAR(255),
        subject_send VARCHAR(255),
        message_send LONGTEXT,
        attach_send VARCHAR(255),
        success_send VARCHAR(255),
        PRIMARY KEY (id))';
 
    $wpdb->query( $sql );

    if ( $wpdb->get_var( $query ) == $table_name ) {

        return true;

    }

    return false;
  
}

// EOF
