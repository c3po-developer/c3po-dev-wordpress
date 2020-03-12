<?php

/**
 * C3PO Theme base
 * 
 * Category page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

get_header();

$categories = C3POCore\Query::get_category( get_cat_id( single_cat_title( "", false ) )  ); 
  
?>

    <!-- main -->
    <main role="main" aria-label="Content" class="site-categories">
    
        <?php if( count ( $categories ) !== 0 ) { ?>
 
            <!-- section -->
            <section>

                <?php foreach( $categories as $category ) { ?> 
                
                    <!-- article -->
                    <article id="post-<?php echo $category['id']; ?>" <?php post_class(); ?>>
                        
                        <a href="<?php echo $category['permalink']; ?>">

                            <img src="<?php echo $category['thumbnail']; ?>" alt="<?php echo $category['title']; ?>">

                            <h1><?php echo $category['title']; ?></h1> 

                        </a> 

                        <?php echo $category['excerpt']; ?>

                        <?php echo $category['date']; ?>
                        
                        <?php echo $category['author']; ?>

                    </article>
                    <!-- /article -->

                <?php } ?>

            </section>
            <!-- /section -->

        <?php } else { ?>
            
            <!-- section -->
            <section>

                <!-- article -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <p>Sorry, no results for this query.</p>            
                    
                </article>
                <!-- article -->

            </section>
            <!-- /section -->

        <?php } ?>

        <?php edit_post_link(); ?>

    </main>
    <!-- main -->

<?php

get_footer();

// EOF
