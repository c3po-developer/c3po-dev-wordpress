<?php

/**
 * droid-theme
 * Template Name: Parent | Default | Legals
 * Muestra textos legales mediante la función y el parámetro.
 * Theme WordPress base de C3PO
 *
 * @package   droid-theme
 * @author    web@usalafuerza.com
 * @link      http://usalafuerza.com
 */

// Get WordPress hook
get_header();
 
?>
 
	<div class="site-page legal"> <!-- site-page -->

		<main> <!-- main -->
			
			<article> <!-- article -->
			 
				<section> <!-- section -->

                    <div class="entry-content"> <!-- entry-content -->
                     	
                        <h1 class="page-title"><?php the_title(); ?></h1>
					 
						<?php if ( function_exists( 'c3poLegal_getLegalDocs' ) ) { echo c3poLegal_getLegalDocs(); } else { echo 'Error: El plugin \'Legals\' no esta activado.'; } ?> 
						 
					</div> <!-- /entry-content -->

				</section> <!-- /section -->
				 
			</article> <!-- /article -->

		</main> <!-- /main -->

    </div> <!-- /site-page -->
    
<?php

// Get WordPress hook
get_footer();

// EOF
