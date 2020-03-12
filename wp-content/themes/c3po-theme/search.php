<?php

/**
 * C3PO Theme base
 * 
 * Search page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

get_header();

$searchs = C3POCore\Query::get_search(); 
 
?>

    <!-- index -->
    <main role="main" aria-label="Content" class="site-search">
    
        <?php if( count ( $searchs ) !== 0 ) { ?>
 
            <!-- section -->
            <section>
          
                <?php foreach( $searchs as $search ) { ?> 
                   
                    <article <?php post_class(); ?>>
                        
                        <a href="<?php echo $search['permalink']; ?>">

                <?php if ( $search['thumbnail'] ) { ?> <img src="<?php echo $search['thumbnail']; ?>" alt="<?php echo $search['title']; ?>" /> <?php } ?>

                            <h1><?php echo $search['title']; ?></h1> 

                        </a> 

                        <?php echo $search['excerpt']; ?>

                        <?php echo $search['date']; ?>
                        
                        <?php echo $search['author']; ?>

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
