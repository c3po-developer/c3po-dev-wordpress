<?php

/**
 * C3PO Theme base
 * 
 * Index page
 * Template Name: Parent | Default | Blank page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

get_header();

$page = C3POCore\Query::get_page();
 
?>
    <style>
    
        #map1{
            width: 100%;
            height: 200px;
        }

    </style>
    
    <!-- page -->
    <main role="main" aria-label="Content" class="site-page-template default">

        <!-- section -->
        <section> 

            <h1><?php echo $page['title']; ?></h1>
           
            <!-- article -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <div class="test-slider-01">

                    <?php foreach( c3po_slider_get_slider( 1807 ) as $slide ) { ?>
                         
                        <img src="<?php echo $slide['mobile_background']; ?>" alt="">

                    <?php } ?>

                </div>

                <?php echo $page['content']; ?> 

                <?php do_shortcode( '[c3po-gmaps oncontent="0" title="Test" id="map1" control="zoom" lat="39.721542" lng="2.9019924" zoom="16" m-icon="https://maps.google.com/mapfiles/kml/shapes/parking_lot_maps.png" m-lat="39.721542" m-lng="2.9019924"]' ); ?>
            
                <?php c3poGmaps_getMap('map1'); ?>
               
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