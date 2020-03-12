<?php

function c3po_video_shortcode( $_c3po_attrs ) {

    if( $_c3po_attrs['url'] ) {

        // Make a object to pass a method how parameter
        $_c3po_video = array();

        $_c3po_video['url']         = filter_var( $_c3po_attrs['url'], FILTER_SANITIZE_URL );
        
        $_c3po_video['width']       = $_c3po_attrs['width']; 
        
        $_c3po_video['controls']    = isset( $_c3po_attrs['controls'] ) ? $_c3po_attrs['controls'] : '0';
        
        $_c3po_video['autoplay']    = isset( $_c3po_attrs['autoplay'] ) ? $_c3po_attrs['autoplay'] : '0';
        
        $_c3po_video['color']       = isset( $_c3po_attrs['color'] ) ? $_c3po_attrs['color'] : '00adef';
        
        $_c3po_video['start']       = isset( $_c3po_attrs['start'] ) ? $_c3po_attrs['start'] : '0';
        
        $_c3po_video['end']         = isset( $_c3po_attrs['end'] ) ? $_c3po_attrs['end'] : '0';
        
        $_c3po_video['loop']        = isset( $_c3po_attrs['loop'] ) ? $_c3po_attrs['loop'] : '0';
        
        $_c3po_video['branding']    = isset( $_c3po_attrs['branding'] ) ? $_c3po_attrs['branding'] : '0';
        
        $_c3po_video['showinfo']    = isset( $_c3po_attrs['showinfo'] ) ? $_c3po_attrs['showinfo'] : '0';
        
        $_c3po_video['align']       = isset( $_c3po_attrs['align'] ) ? $_c3po_attrs['align'] : 'none';

        $_c3po_video['ratio']       = isset( $_c3po_attrs['ratio'] ) ? $_c3po_attrs['ratio'] : 'none';
  
        // Check host for swicth to correct function
        switch ( parse_url( $_c3po_video['url'] )['host'] ){
        
            case 'vimeo.com':
        
                return c3po_video_vimeo( $_c3po_video );
        
            break;
        
            case 'www.youtube.com':
        
                return c3po_video_youtube( $_c3po_video );
        
            break;
        
            default:
        
                return FALSE;
        
            break;
        
        }
 
        return TRUE;

    }

    return FALSE;

} add_shortcode('c3po-video', 'c3po_video_shortcode');

/*!
    @brief      <H1>Return embed code to vimeo video</H1>
    @return     Video embed
    @param      array
    @bug
    @warning
    @return     Video embed code
*/
function c3po_video_vimeo( $_c3po_object_video_vm ) {
    // Get vimeo code video
    preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/",
        $_c3po_object_video_vm['url'],
        $c3po_video_id
    );
    
    // Setup attributes to render view
    $_c3po_attr = array (
        // In url parameters
        'in'         => 'autoplay='     . $_c3po_object_video_vm['autoplay'].
                        '&color='       . $_c3po_object_video_vm['color'] .
                        '&title='       . $_c3po_object_video_vm['controls'] .
                        '&byline='      . $_c3po_object_video_vm['controls'] .
                        '&portrait='    . $_c3po_object_video_vm['controls'] .
                        '&loop='        . $_c3po_object_video_vm['loop'],

        // Out of url parameters
        'out'       => 'frameborder="0"' .
                       'webkitallowfullscreen ' .
                       'mozallowfullscreen ' .
                       'allowfullscreen',

        // Sizes
        'width'     =>  $_c3po_object_video_vm['width'],
        'height'    => $_c3po_object_video_vm['height'],

        // Start video at ...
        'start'     =>  ( $_c3po_object_video_vm['start'] ) ? '#t=' . $_c3po_object_video_vm['start'] : '' ,
        'align'     => $_c3po_object_video_vm['align'],

        // Aspect ratio
        'ratio' => $_c3po_object_video_yt['ratio'],


    );

    // Render a view an return embed object
    return c3po_video_iframe( 
        'vimeo', 
        $c3po_video_id[5], 
        $_c3po_attr 
    );
}

/*!
    @brief      <H1>Return embed code to youtube video</H1>
    @return     Video embed
    @param      array
    @bug
    @warning
    @return     Video embed code
*/
function c3po_video_youtube( $_c3po_object_video_yt ) {

    // Get vimeo code video
    preg_match("/(?<=(?:v|i)=)[a-zA-Z0-9-]+(?=&)|(?<=(?:v|i)\/)[^&\n]+|(?<=embed\/)[^\"&\n]+|(?<=(?:v|i)=)[^&\n]+|(?<=youtu.be\/)[^&\n]+/",
        $_c3po_object_video_yt['url'],
        $c3po_video_id
    );

    // Setup attributes to render view
    if($_c3po_object_video_yt['loop'] == 1 ) {

        $_c3po_id = $c3po_video_id[0];

    } else {

        $_c3po_id = '';

    }

    $_c3po_attr = array (
        // In url parameters
        'in'        => 'autoplay=' . $_c3po_object_video_yt['autoplay'] .
                       '&iv_load_policy=0' .
                       '&controls=' . $_c3po_object_video_yt['controls'] .
                       '&loop=' . $_c3po_object_video_yt['loop'] .
                       '&playlist=' . $_c3po_id .
                       '&modestbranding=' . $_c3po_object_video_yt['branding'].
                       '&showinfo=' . $_c3po_object_video_yt['showinfo'].
                       '&color=' . $_c3po_object_video_yt['color'],

        // Out of url parameters
        'out'       => 'frameborder="0"' .
                       'allowfullscreen',

        // Sizes
        'width'     =>  $_c3po_object_video_yt['width'],
        'height'    => $_c3po_object_video_yt['height'],

        // Start video at ...
        'start'     =>  ( $_c3po_object_video_yt['start'] ) ? '&start=' . $_c3po_object_video_yt['start'] : '' ,
        'end'       =>  ( $_c3po_object_video_yt['end'] ) ? '&end=' . $_c3po_object_video_yt['end'] : '' ,
        'align'     => $_c3po_object_video_yt['align'],

        // Aspect ratio
        'ratio'     => $_c3po_object_video_yt['ratio'],
    );

    // Render a view an return embed object
    return c3po_video_iframe( 'youtube', $c3po_video_id[0], $_c3po_attr );
    
}
 
function c3po_video_iframe ( $_c3po_provider, $_c3po_id, $_c3po_params ){
   
    // Get provider of video
    $_c3po_video_inter = '?';
 
    $_css_c3po_video_align = ( $_c3po_params['align'] == 'center' ) ? 'margin: 0 auto;' : 'float: ' . $_c3po_params['align'] . ';';

    $_css_c3po_video_padding_bottom = 57;

    if ( $_c3po_params['ratio'] != '' ){

        $_css_c3po_video_padding_bottom = ( $_c3po_params['ratio'] == '4/3' ) ? 27 : 57;

    }  

    if ( $_c3po_provider == 'vimeo' ) {

        $_c3po_video_provider = 'https://player.vimeo.com/video/';

        // This function is must necessary to send html code to content
        ob_start();
      
        ?> 

            <style>

                .c3po-video-resizable-iframe-<?php echo $_c3po_id; ?> {
                    width: <?php echo $_c3po_params['width']; ?>; 
                    <?php echo $_css_c3po_video_align; ?>
                }

                .c3po-video-resizable-iframe-<?php echo $_c3po_id; ?> > div {
                    position: relative;
                    padding-bottom: <?php echo $_css_c3po_video_padding_bottom; ?>%;
                    height: 0px;
                    height: 100%;
                }

                .c3po-video-resizable-iframe-<?php echo $_c3po_id; ?> iframe {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                }

            </style>
  
            <div class="c3po-video-resizable-iframe-<?php echo $_c3po_id; ?>">

                <div>

                    <iframe src="<?php echo $_c3po_video_provider .
                        $_c3po_id .
                        $_c3po_params['start'] .
                        $_c3po_video_inter .
                        $_c3po_params['in'] ?> " <?php echo $_c3po_params['out']; ?>></iframe>

                </div>

            </div>
 
        <?php

    } else {
     
        $_c3po_video_provider = 'https://www.youtube.com/embed/';

        // This function is must necessary to send html code to content
        ob_start();
 
        // Start output buffering
        ?>
      
         <style>

                .c3po-video-resizable-iframe-<?php echo $_c3po_id; ?> {
                    width: <?php echo $_c3po_params['width']; ?>; 
                    <?php echo $_css_c3po_video_align; ?>
                }

                .c3po-video-resizable-iframe-<?php echo $_c3po_id; ?> > div {
                    position: relative;
                    padding-bottom: <?php echo $_css_c3po_video_padding_bottom; ?>%;
                    height: 0px;
                    height: 100%;
                }

                .c3po-video-resizable-iframe-<?php echo $_c3po_id; ?> iframe {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                }

        </style>

         <div class="c3po-video-resizable-iframe-<?php echo $_c3po_id; ?>">

                <div>

                    <iframe src="<?php echo $_c3po_video_provider .
                        $_c3po_id .
                        $_c3po_params['start'] .
                        $_c3po_video_inter .
                        $_c3po_params['in'] .
                        $_c3po_params['end'] ?> " <?php echo $_c3po_params['out']; ?>></iframe>

                </div>

            </div>

        <?php

    }

    // Send buffer to return value
    return ob_get_clean();
}