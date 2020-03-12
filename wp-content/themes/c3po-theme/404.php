<?php

/**
 * C3PO Theme base
 * 
 * 404 page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

get_header(); 

?>
    
    <!-- main -->
    <main role="main" aria-label="Content" class="site-404">

        <!-- section -->
        <section>
 
            <!-- article -->
            <article id="post-404" <?php post_class(); ?>>

                <div class="card404">

                    <h2 class="tit404"><?php echo C3POCore\Translate::get_term('404-title'); ?></h2>

                    <p class="desc404"><?php echo C3POCore\Translate::get_term('404-text'); ?></p>

                    <form action="<?php echo _C3PO_BASE_URI_ ; ?>" method="GET">

                        <input type="text" id="s" name="s" />

                        <input type="submit" value="Buscar" />

                    </form>

                    <a class="home_link" href="<?php echo _C3PO_BASE_URI_ ; ?>"><?php echo C3POCore\Translate::get_term('go-home'); ?></a>
                    
                </div>
                
            </article>
            <!-- /article -->

        </section>
        <!-- /section -->

    </main>
    <!-- /main -->

<?php

get_footer();

// EOF