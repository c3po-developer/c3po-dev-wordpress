<?php

/**
 * C3PO Theme base
 * 
 * Index page
 * Template Name: Parent | Default | List CPT Books
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

get_header();

$posts = C3POCore\Query::get_posts( 'cpt_book' ); 

?>

    <!-- index -->
    <main role="main" aria-label="Content" class="site-page-template default-blog-entries">
    
        <?php if( count ( $posts ) !== 0 ) { ?>
 
            <!-- section -->
            <section>

                <?php foreach( $posts as $post ) { ?> 

                    <!-- article -->
                    <article id="post-<?php echo $post['id']; ?>" <?php post_class(); ?>>
                        
                        <a href="<?php echo $post['permalink']; ?>">

                            <img src="<?php echo $post['thumbnail']; ?>" alt="<?php echo $post['title']; ?>">

                            <h1><?php echo $post['title']; ?></h1> 

                        </a> 

                        <?php echo $post['excerpt']; ?>

                        <?php echo $post['date']; ?>
                        
                        <?php echo $post['author']; ?>

                    </article>
                    <!-- article -->

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
