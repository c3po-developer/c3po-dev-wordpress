<?php

/**
 * C3PO - C3POCore\Query::get_posts_paginated 
 * 
 * Post
 * 
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

use \C3POCore\Translate;

$post_query = array (
    'post_type'             => 'post',
    'orderby'               => 'date',
    'order'                 => 'DESC',
    'paged'                 => 1,
    'posts_per_page'        => 10,
    'ignore_sticky_posts'   => 1,
);

$post_attrs = array (  
    'num_pages' => 3, 
    'method'	=> 'ajax', 
    // Show numeric counter index
    'type'      => 'numeric',    
    // Show Next-Prev labels    
    'next_prev' => array (
        'next_text' => Translate::get_term('blog_next'),
        'prev_text' => Translate::get_term('blog_prev'),
    )
);

?> 