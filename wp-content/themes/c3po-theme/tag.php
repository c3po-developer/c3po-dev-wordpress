<?php

/**
 * C3PO Theme base
 * 
 * Tags page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

get_header();

$tags = C3POCore\Query::get_tag( single_tag_title( "", false ) ); 
  
?>

    <!-- index -->
    <main role="main" aria-label="Content" class="site-tag">
    
        <?php if( count ( $tags ) !== 0 ) { ?>
 
            <!-- section -->
            <section>

                <?php foreach( $tags as $tag ) { ?> 

                    <article id="post-<?php echo $tag['id']; ?>" <?php post_class(); ?>>
                        
                        <a href="<?php echo $tag['permalink']; ?>">

                            <img src="<?php echo $tag['thumbnail']; ?>" alt="<?php echo $tag['title']; ?>">

                            <h1><?php echo $tag['title']; ?></h1> 

                        </a> 

                        <?php echo $tag['excerpt']; ?>

                        <?php echo $tag['date']; ?>
                        
                        <?php echo $tag['author']; ?>

                    </article>
                
                <?php } ?>

            </section>
            <!-- /section -->

        <?php } else { ?>
            
            <!-- section -->
            <section>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <p>Sorry, no results for this query.</p>            
                    
                </article>

            </section>
            <!-- /section -->

        <?php } ?>

        <?php edit_post_link(); ?>

    </main>
    <!-- index -->

<?php

get_footer();

// EOF
