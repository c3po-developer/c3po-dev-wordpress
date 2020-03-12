<?php

/**
 * C3PO Core Class Translate
 *  
 * @version 1.0.0
 * @author  web@usalafuerza.com
 * @date    2019/09/02
 */

namespace C3POCore;

class Translate {
 
    /**
     * @return  (bool)              Return TRUE if polylang plugin exist and is activated
     */
    public static function is_active_polylang()
    {
   
        return function_exists ( 'pll_register_string' );

    }

    /**
     * Get a translation
     *
     * @param   (string)    $term   Pre defined constant
     *
     * @return  (string)            Return a translation from pre defined constant
     */
    public static function get_term( $term )
    {

        if ( self::is_active_polylang() ) {

            return pll__( $term );

        }

        return $term;

    }

    /**
     * Set up constants strings for translation on backend
     *
     * @param   (string)    $name                   Base name
     * @param   (array)     $collection_translate   Array unique with terms defined constant
     * @param   (string)    $group_name             Group name 
     */
    public static function set_terms( $name, $collection_translate, $group_name)
    {

        foreach ( $collection_translate as $collection_translate_name ) {

            self::set_translation( 
                array(
                    'string' => $name,
                    'name'   => $collection_translate_name,
                    'group'  => $group_name
                ) 
            );

        }

    }

    /**
     * It allows to transfer the content of a post/page between the different established languages
     *
     * @return bool
     */
    public static function set_automatic_translation() 
    {
        
        if ( self::is_active_polylang() )
        {  
            self::get_editor_content();  
            self::get_editor_title(); 
            return true;
        }
        return false; 
    }

    /**
     * Return link
     *
     * @param $_c3po_intId
     *
     * @return bool|string
     */
    public static function get_link( $id )
    {

        if( self::is_active_polylang() ) {

            if ( $id ) {
                
                return get_page_link(
                    pll_get_post(
                        $id,
                        pll_current_language()
                    )
                );

            }

        }

        return false;

    }

    /**
     * Get a copy of editor content to move in a translation
     */
    private static function get_editor_content() 
    {

        add_filter( 'default_content', function()   {

            if ( isset( $_GET['from_post'] ) ) {

                $my_post = get_post( $_GET['from_post'] );

                if ( $my_post )

                    return $my_post->post_content;

            }

        });

    }

    /**
     * Get a copy of editor title to move in a translation
     */
    private static function get_editor_title() 
    {
    
        add_filter( 'default_title', function() {

            if ( isset( $_GET['from_post'] ) ) {

                $my_post = get_post( $_GET['from_post'] );

                if ( $my_post )

                    return $my_post->post_title;

            }

        });

    }

    /**
     * Set up a translate constant for use on backend
     *
     * @param $_c3po_toTranslate
     *
     * @return bool
     */
    private static function set_translation( $_c3po_toTranslate )
    {
     
        if( self::is_active_polylang() ) {
     
            if ( $_c3po_toTranslate ) {
     
                pll_register_string( 
                    ( isset( $_c3po_toTranslate['string'] ) ) ? $_c3po_toTranslate['string'] : null,
                    ( isset( $_c3po_toTranslate['name'] ) ) ? $_c3po_toTranslate['name'] : null,
                    ( isset( $_c3po_toTranslate['group'] ) ) ? $_c3po_toTranslate['group'] : null ,
                    true
                );

                return true;

            }

        }

        return false;

    }

}

// EOF
