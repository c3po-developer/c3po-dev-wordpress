<?php

/**
 * C3PO Core Class Loader
 *  
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

namespace C3POCore;

class Query {
     
    /**
     * @param   (int)    (Optional)  Page id
     * 
     * @return (array)  Collection with data content from page queried
     * 
     * (string) title 
     * (string) date 
     * (string) permalink 
     * (string) excerpt 
     * (string) content 
     * (string) thumbnail 
     * (string) author 
     * (int)    title 
     * 
     */
    public static function get_page( $id = null )
    {
        $id_queried = ( $id == null ) ? get_the_ID() : $id;

        return self::get( 
            array (
                'post_type' => 'page',
                'p' =>$id_queried
            ) 
        );

    }

    /**
     * @param   (string)    (Optional)  Post type 'post' | 'custom-post'
     * @param   (int)    (Optional)  Post id
     * 
     * @return  (array)     Collection with data content from post queried
     * 
     * (string) title 
     * (string) date 
     * (string) permalink 
     * (string) excerpt 
     * (string) content 
     * (string) thumbnail 
     * (string) author 
     * (int)    title 
     * (array)  category (if exist)
     *      (int)       id
     *      (string)    name
     * (array)  tag (if exist)
     *      (int)       id
     *      (string)    name
     * 
     */
    public static function get_single( $type = 'post', $id = null )
    {

        $id_queried = ( $id == null ) ? get_the_ID() : $id;

        $return_single = self::get( 
            array (
                'post_type' => $type,
                'p' => $id_queried
            ) 
        );

        if( isset( $return_single[0] ) ) 
            return $return_single[0];

        return false;

    }

    /**
     * @param   (string)    (Required)  Post type.
     * @param   (array)     (Optional)  WP_Query array statement.
     * 
     * @return  (array)(array)  Collection with data content from list post queried
     * 
     * (string) title 
     * (string) date 
     * (string) permalink 
     * (string) excerpt 
     * (string) content 
     * (string) thumbnail 
     * (string) author 
     * (int)    title 
     * (array)  category (if exist)
     *      (int)       id
     *      (string)    name
     * (array)  tag (if exist)
     *      (int)       id
     *      (string)    name
     * 
     */ 
    public static function get_posts( $query  )
    {
        
        if( is_string ( $query ) ){
 
            $query_response = array (
                'post_type'             => $query,
                'orderby'               => 'date',
                'order'                 => 'DESC',
                'pages'                 => 1,
                'offset'                => 0,
                'posts_per_page'        => -1,
                'ignore_sticky_posts'   => 1
            );

            return self::get( $query_response );

        } else {

            return self::get( $query );

        }
  
    }
      
    /**
     * Get post and paginator models views
     * 
     * Files required:
     * 
     * [theme_name] /inc/views/[template_name]/post.php
     * [theme_name] /inc/views/[template_name]/template.php 
     * [theme_name] /inc/ajax/ajax.php 
     */
    public static function get_posts_paginated( $template, $ajax_call = false )
    {
            
        // Current page pointer
        $position_page = ( isset ( $_GET['droid_page_actual'] ) ) ? $_GET['droid_page_actual'] : 1;
        
        // If the method IS NOT called from the AJAX
        if( !$ajax_call ) {

            // Set the WP query object in a JS object to use in scripts.
            ?><script>var js_template =  <?php echo json_encode( $template ); ?>;</script><?php

        // If the method IS called from the AJAX
        } else {
            
            $page = ( isset( $_POST['page'] ) ?  $_POST['page'] : 1 );

            $position_page = ( $ajax_call ) ? $page : 1;

        }
 
        // Check path for is a child theme
        $path_url = ( is_child_theme() ) ? _C3PO_THEME_CHILD_PATH_ : _C3PO_THEME_PATH_;
 
        // Post.php file, if it exists, it exits the execution
        $template_base_route = $path_url . '/inc/views/' . $template;
        
        if( !is_file( $template_base_route . '/post.php' ) ) {

            echo 'Sorry, this template <b>'.$template_base_route . '/post.php'.'</b> doest exist';

            return;

        }

        // Includes the post.php file
        include( $template_base_route . '/post.php' );

        // File template.php, if it exists, it exits execution
        $template_file_model = $path_url . '/inc/views/' . $template;

        if( !is_file( $template_file_model . '/template.php' ) ) {

            echo 'Sorry, this template <b>'.$template_base_route . '/template.php'.'</b> doest exist';

            return;

        }
         
        // Query de WP
        $include_post_query = $post_query;  

        // We set the current page in the query collected from the post.php 
        // file to update the content you will consult.
        $include_post_query['paged'] = $position_page;

        // Paginator attrs.
        $include_post_attrs = $post_attrs;  

        // Type of method used to manage the pager, add the class 'ajax-link' if the method 
        // chosen is AJAX for management from the JS.
        $typeMethodClass = ( isset( $post_attrs['method'] ) && $post_attrs['method'] == 'ajax' ) ? ' ajax-link' : '';

        // Make the query to WP with the parameters sets
        $query = new \WP_Query( $include_post_query );  
        
        // Total entries.
        $total_post = $query->found_posts;
         
        // Entries per page.
        $total_post_per_page = $query->max_num_pages;
        
        // Number of numerical elements that will appear maximum in the numerical pager.
        $num_pages_max = $include_post_attrs['num_pages'];

        if (  $query->have_posts() ) {

            ?>

                <!-- section -->
                <section class="c3po-paginator-post-entry-list">

            <?php
            
                while ( $query->have_posts() ) {
                    
                    $query->the_post(); 

                    include( $template_file_model . '/template.php' );
                
                }  

            ?>

                </section>
                <!-- /section -->

            <?php 
            
        }  

        // Paginator
        echo '<div class="c3po-paginator-main">';

            $iInit = ( $position_page - $num_pages_max ) >= 1 ? $position_page - $num_pages_max : 1;

            $iEnd  = ( $position_page + $num_pages_max ) <= $total_post_per_page ? $position_page + $num_pages_max : $total_post_per_page;
            
            if( isset( $include_post_attrs['next_prev'] ) ) {

                if( $position_page != 1 ) {
                
                    self::getPrev( $include_post_attrs, $position_page, $typeMethodClass );
                
                }

            } 

            if( isset( $post_attrs['type'] ) && $post_attrs['type'] == 'numeric' ) {

                for( $iterator =  $iInit;
                    $iterator <= $iEnd;
                    $iterator++ ){

                    $classActive = ( $position_page == $iterator ) ? ' actual-link-active' :  '';
                
                    echo '<a class="no-link'.$classActive.$typeMethodClass.'" href="?droid_page_actual='.$iterator.'" data-num-page="'.$iterator.'" >';

                    echo '<span>' . $iterator . '</span>';

                    echo '</a>';

                }
            }
            
            if( isset( $include_post_attrs['next_prev'] ) ) { 

                if( $position_page != $iEnd ) { 

                    self::getNext( $include_post_attrs, $position_page, $typeMethodClass ); 

                }

            } 

        echo '</div>';

        if( !$ajax_call ) { 
            
            echo '</div>'; 
        
        }

    }
 
    /**
     * @param   (string) (Required)  Category slug.
     * 
     * @return  (array)(array)  Collection with data content from list category queried
     * 
     * (string) title 
     * (string) date 
     * (string) permalink 
     * (string) excerpt  
     * (string) thumbnail 
     * (string) author 
     * (int)    title  
     * 
     */ 
    public static function get_category( $category )
    {

        $category_query = new \WP_Query( 'cat=' . $category . '&showposts=-1' );

        while ( $category_query->have_posts() )
        {
            $category_query->the_post();

            $__objReturn[] =
                array (
                    'title'     => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'excerpt'   => get_the_excerpt(),
                    'date'      => get_the_time( 'j/m/Y' ),
                    'author'    => get_the_author(),
                    'thumbnail' => get_the_post_thumbnail()
                );
        };

        return ( isset ( $__objReturn ) ) ? $__objReturn : array ();

    }

    /**
     * @param   (string) (Required)  Tag slug.
     * 
     * @return  (array)(array)  Collection with data content from list tag queried
     * 
     * (string) title 
     * (string) date 
     * (string) permalink 
     * (string) excerpt  
     * (string) thumbnail 
     * (string) author 
     * (int)    title  
     * 
     */ 
    public static function get_tag( $tag )
    {

        $tag_query = new \WP_Query( 'tag=' . $tag  );

        while ( $tag_query->have_posts() )
        {
            $tag_query->the_post();

            $__objReturn[] =
                array (
                    'title'     => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'excerpt'   => get_the_excerpt(),
                    'date'      => get_the_time( 'j/m/Y' ),
                    'author'    => get_the_author(),
                    'thumbnail' => get_the_post_thumbnail()
                );
        };

        return ( isset ( $__objReturn ) ) ? $__objReturn : array ();

    }

    /**
     * Get search results
     */
    public static function get_search()
    {
        $__objReturn = array();

        if ( have_posts() ){

            while ( have_posts() ) {

                the_post();
                
                $__objReturn[] =
                    array (
                        'title'     => get_the_title(),
                        'permalink' => get_the_permalink(),
                        'excerpt'   => get_the_excerpt(),
                        'date'      => get_the_time( 'j/m/Y' ),
                        'author'    => get_the_author(),
                        'thumbnail' => get_the_post_thumbnail_url()
                    );
            }

        }

        return $__objReturn;

    }

    public static function get_cmb2( $key, $id = '' )
    {
        
        $id = ($id) ? $id : get_the_ID();

        $post_meta_value = get_post_meta( $id, $key );

        return $post_meta_value[0];

    }
    
    /**
     *
     * @param $query
     *
     * @return array|bool|mixed
     */
    private static function get( $query )
    {

        if( is_array ( $query ) ) {
            // static temp vars
            static $buffer = array();
            
            static $counter = 0;
            
            static $category_counter = 0;

            static $tag_counter = 0;
 
            // wp query
            $query_wp = new \WP_Query( $query );

            // wp loop
            if( $query_wp->have_posts() ){

                while ( $query_wp->have_posts()) : $query_wp->the_post();

                    $buffer[ $counter ]['title'] = get_the_title();
                    $buffer[ $counter ]['date'] = get_the_date();
                    $buffer[ $counter ]['permalink'] = get_the_permalink();
                    $buffer[ $counter ]['excerpt'] = get_the_excerpt();
                    $buffer[ $counter ]['content'] = do_shortcode( apply_filters ( 'the_content', get_the_content() ) );
                    $buffer[ $counter ]['thumbnail'] = get_the_post_thumbnail_url();
                    $buffer[ $counter ]['author'] = get_the_author();
                    $buffer[ $counter ]['id'] = get_the_ID();
                
                    if( get_the_category() != '' ) {

                        foreach ( get_the_category() as $category ) {
                        
                            $buffer[ $counter ]['category'][ $category_counter ]['id']   = $category->cat_ID;
                        
                            $buffer[ $counter ]['category'][ $category_counter ]['name'] = $category->cat_name;
                        
                            $category_counter ++;
                            
                        }
                    }
                
                    if( get_the_tags() != '' ) {

                        foreach ( get_the_tags() as $_c3po_tag ) {

                            $buffer[ $counter ]['tag'][ $tag_counter ]['id']   = $_c3po_tag->term_id;

                            $buffer[ $counter ]['tag'][ $tag_counter ]['name'] = $_c3po_tag->name;

                            $tag_counter ++;

                        }
                    }
                
                    $counter++;
                
                endwhile;

            }

            // clean query and memory
            wp_reset_query();

            unset ( $counter );
            
            unset ( $category_counter );
            
            unset ( $tag_counter );

            // if page type, return -1 position of array tree
            if ( $query['post_type'] == 'page' ){

                $return_array = $buffer;

                $buffer = NULL;

                return $return_array[0];
            }

            $return_array = $buffer;

            $buffer = NULL;

            return $return_array;

        }

        return false;

    }

    /**
     * Get paginator
     */
    private static function getPaginator($position_page, $num_pages_max, $total_post_per_page ){
        
        // Paginator
        echo '<div class="c3po-paginator-main">';

            $iInit = ( $position_page - $num_pages_max ) >= 1 ? $position_page - $num_pages_max : 1;

            $iEnd  = ( $position_page + $num_pages_max ) <= $total_post_per_page ? $position_page + $num_pages_max : $total_post_per_page;
            
            if( isset( $include_post_attrs['next_prev'] ) ) {

                if( $position_page != 1 ) {
                
                    self::getPrev( $include_post_attrs, $position_page, $typeMethodClass );
                
                }

            } 
    
            if( isset( $post_attrs['type'] ) && $post_attrs['type'] == 'numeric' ) {

                for( $iterator =  $iInit;
                    $iterator <= $iEnd;
                    $iterator++ ){

                    $classActive = ( $position_page == $iterator ) ? ' actual-link-active' :  '';
                
                    echo '<a class="no-link'.$classActive.$typeMethodClass.'" href="?droid_page_actual='.$iterator.'" data-num-page="'.$iterator.'" >';

                    echo '<span>' . $iterator . '</span>';

                    echo '</a>';

                }
            }
            
            if( isset( $include_post_attrs['next_prev'] ) ) { 

                if( $position_page != $iEnd ) { 

                    self::getNext( $include_post_attrs, $position_page, $typeMethodClass ); 

                }

            } 

        echo '</div>';

    }

    /**
     * Get Prev link to paginator
     */
    private static function getPrev( $include_post_attrs, $position_page, $typeMethodClass ){
        $position_page--;
        echo '<a class="no-link-next-prev'.$typeMethodClass.'" href="?droid_page_actual='.$position_page.'" data-num-page="'.$position_page.'" >';
        echo '<span>' . $include_post_attrs['next_prev']['prev_text'] . '</span>';
        echo '</a>';
    }

    /**
     * Get Next link to paginator
     */
    private static function getNext($include_post_attrs, $position_page, $typeMethodClass){
        $position_page++;
        echo '<a class="no-link-next-prev'.$typeMethodClass.'" href="?droid_page_actual='.$position_page.'" data-num-page="'.$position_page.'" >';
        echo '<span>' . $include_post_attrs['next_prev']['next_text'] . '</span>';
        echo '</a>';
    }

}

// EOF
