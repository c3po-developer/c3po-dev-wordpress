<?php

/**
 * C3PO Theme base
 * 
 * Index page
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

get_header(); 
 
?>

    <!-- index -->
    <main role="main" aria-label="Content" class="site-index c3po-paginator-main">
             
        <?php C3POCore\Query::get_posts_paginated( 'posts' ); ?>
     
    </main>
    <!-- index -->

<?php

get_footer();

// EOF
