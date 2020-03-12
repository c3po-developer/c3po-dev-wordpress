<?php

/**
 * C3PO Theme base
 * 
 * Pages page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */
 
get_header();

$page = C3POCore\Query::get_page();
 
?>

    <!-- page -->
    <main role="main" aria-label="Content" class="site-page">

        <!-- section -->
        <section>

            <h1><?php echo $page['title']; ?></h1>

            <!-- article -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php echo $page['content']; ?>

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

