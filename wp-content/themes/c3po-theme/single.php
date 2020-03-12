<?php

/**
 * C3PO Theme base
 * 
 * Single page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

get_header();

$post = C3POCore\Query::get_single();
 
?>

    <!-- single -->
    <main role="main" aria-label="Content" class="site-single">
        
        <!-- section -->
        <section>

            <h1><?php echo $post['title']; ?></h1>

            <!-- article -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <figure class="post-thumbnail">
                
                    <img src="<?php echo $post['thumbnail']; ?>" alt="<?php echo $post['title']; ?>">
                
                </figure>

                <?php echo $post['content']; ?>

            </article>
            <!-- /article -->

        </section>
        <!-- /section -->

        <?php edit_post_link(); ?>

    </main>
    <!-- /single -->

<?php

get_footer();

// EOF
