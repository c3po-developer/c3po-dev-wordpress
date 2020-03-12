<?php

/**
 * C3PO - C3POCore\Query::get_posts_paginated 
 * 
 * Template
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

?>

<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
    <a class="post-permalink" href="<?php the_permalink(); ?>">
        
        <figure class="post-thumbnail"><?php the_post_thumbnail(); ?></figure>
      
        <h2 class="post-title"><?php the_title(); ?></h2>

    </a>
 
    <span class="post-date">Date: <b><?php the_date(); ?></b></span> | <span class="post-author">Author: <b><?php the_author(); ?></b></span>
 
    <?php the_excerpt(); ?>
         
</article> 
<!-- /article -->