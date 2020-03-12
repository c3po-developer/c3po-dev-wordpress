<?php

/**
 * C3PO Child Theme
 * 
 * Contacto
 * Template Name: child Contacto
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/26
 */

get_header();

$page = C3POCore\Query::get_page();
 
?>

    <!-- page -->
    <main class="site-template contact"  role="main" aria-label="Content">

        <!-- section -->
        <section>

            <h1><?php echo $page['title']; ?></h1>

            <!-- article -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php echo $page['content']; ?>
 
                <div class="contact-form">
   
                    <?php 
                         
                        // Si el plugin forms está cargada y activo, se carga el formulario con el ID
                        if( function_exists( 'get_forms_template' ) ){ 
                            
                            get_forms_template ( get_stylesheet_directory() .'/inc/views/forms/regular-form.php', "1785" );

                        } else {

                            echo 'Error: El plugin \'Forms\' no esta activado.';
                            
                        }

                    ?>

                </div>

                <!-- Añadir estilos según tema para que se muestre el mapa -->
                <div class="contact-map">

                    <?php 
                    
                        if( function_exists ( 'c3poGmaps_getMap' ) ) {

                            echo do_shortcode( '[c3po-gmaps oncontent="1" title="Test" id="map1" class="igetec-map-class" lat="39.721542" lng="2.9019924" zoom="16" m-icon="https://maps.google.com/mapfiles/kml/shapes/parking_lot_maps.png" m-lat="39.721542" m-lng="2.9019924" ]' );

                        } else {

                            echo 'Error: El plugin \'Gmaps\' no esta activado.';

                        }

                    ?>

                </div>


            </article> 
            <!-- /article -->

        </section>
        <!-- /section -->

        <?php edit_post_link(); ?>

    </main>
    <!-- /page -->

<?php

get_footer();

// EOF