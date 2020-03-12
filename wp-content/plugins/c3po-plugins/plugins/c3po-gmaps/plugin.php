<?php
 
function c3po_gmaps_shortcode( $atts = [], $content = null, $tag = '' ) 
{
     
    // Get API KEY from settings/general
    $gmaps_api_key = getAPIkey(); 
 
    // If declared oncontent, then render map here
    if( $atts['oncontent'] === '1' )
        c3poGmaps_getMap( $atts['id'] );

    // Add js scripts on footer
    add_action( 'wp_footer', function() use ($atts){
      
        $_options_values = get_option( '_c3po_gmaps_' );  
    
        $json = $_options_values['c3po_gmaps_json_value'];
       
        // This action only works for the first time in the shortcode call,
        // creating a define in php for that.
        if( !defined ('gmaps_on_footer') ){
                    
            // Get API KEY from settings/general
            $gmaps_api_key = getAPIkey(); 
 
            // Include Google maps API with key
            echo "<script src='https://maps.googleapis.com/maps/api/js?key={$gmaps_api_key}'></script>";

            // Inyect once js function to handler map
            ?>
                             
                <script> 
                   
                    function runGmapInit( mapID, lat, lng, zoom, m_lat, m_lng, icon, title ) {
                                                    
                        var map, marker,json;
                      
                        map = new google.maps.Map( document.getElementById( mapID ),                        
                            {
                                center              : new google.maps.LatLng( lat, lng ),
                                zoom                : zoom,         
                                mapTypeId           : google.maps.MapTypeId.ROADMAP,
                                styles              : <?php echo $json; ?>,
                                disableDefaultUI    : true,
                                zoomControl         : <?php echo ( isset( $atts['control'] ) && $atts['control'] === 'zoom') ? 1 : 0; ?>,
                            }
                        );

                        var image = icon;

                        marker = new google.maps.Marker({
                            position                : new google.maps.LatLng( m_lat, m_lng ), 
                            map                     : map, 
                            title                   : title,
                            icon                    : icon
                        });
                                              
                    }
  
                </script>
            
            <?php 
            
            define ( 'gmaps_on_footer', 1 );
     
        }

        // Draw js callable function
        echo "<script>runGmapInit( '{$atts['id']}', {$atts['lat']}, {$atts['lng']}, {$atts['zoom']}, {$atts['m-lat']}, {$atts['m-lng']}, '{$atts['m-icon']}', '{$atts['title']}' );</script>";
       
    });
 
} add_shortcode('c3po-gmaps', 'c3po_gmaps_shortcode');

// Include maps on callable function
function c3poGmaps_getMap( $id_map ) 
{  
  
    $_options_values = get_option( '_c3po_gmaps_' );  

    echo "<div id='{$id_map}'></div>";

}

// Return exceptions to console browser
function handleExceptions( $data_message )
{ 

    printf("<script>console.log('%s');</script>" , 'Droid GMaps Error: ' . $data_message );
    
}

// Return API key setup from backend.
function getApiKey()
{

    // Valor de las opciones recogidas
    $_options_values = get_option( '_c3po_gmaps_' );  
  
    if( !isset ( $_options_values['c3po_gmaps_api_key'] ) || $_options_values['c3po_gmaps_api_key'] === '' ) 
        return handleExceptions( 'API-KEY is not defined. Please go to settings/generals to establish one'); 
        
    return $_options_values['c3po_gmaps_api_key'];

}