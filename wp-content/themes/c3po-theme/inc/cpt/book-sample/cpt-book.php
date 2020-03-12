<?php
/**
 * droid-theme
 * Carga de CPT
 * Theme WordPress base de C3PO
 *
 * @package   droid-theme
 * @author    web@usalafuerza.com
 * @link      http://usalafuerza.com
 */
  
/**
 * Custom post type -> Book
 */
function custom_post_type_book() {

	$labels = array(
		'name'                  => _x( 'Books', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'book', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Books', 'text_domain' ),
		'name_admin_bar'        => __( 'Books', 'text_domain' ),  
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Nuevo book', 'text_domain' ),
		'add_new'               => __( 'Añadir', 'text_domain' ),
		'new_item'              => __( 'Nuevo book', 'text_domain' ),
		'edit_item'             => __( 'Editar Item', 'text_domain' ),
		'update_item'           => __( 'Actualizar Item', 'text_domain' ),
		'view_item'             => __( 'Ver Item', 'text_domain' ),
		'view_items'            => __( 'Ver Items', 'text_domain' ),
		'search_items'          => __( 'Buscar Item', 'text_domain' ),
		'not_found'             => __( 'No encontrado', 'text_domain' ),
		'not_found_in_trash'    => __( 'No encontrado en papelera', 'text_domain' ),
		'featured_image'        => __( 'Imagen destacada', 'text_domain' ),
		'set_featured_image'    => __( 'Define la imagen destacada', 'text_domain' ),
		'remove_featured_image' => __( 'Borrar la imagen destacada', 'text_domain' ),
		'use_featured_image'    => __( 'Usar como imagen destacada', 'text_domain' ),
		'insert_into_item'      => __( 'Insertar en el item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Subir a este item', 'text_domain' ),
		'items_list'            => __( 'Lista', 'text_domain' ),
		'items_list_navigation' => __( 'Navegación de lista', 'text_domain' ),
		'filter_items_list'     => __( 'Filtrar los items', 'text_domain' ),
    );
    
	$args = array(
		'label'                 => __( 'Books', 'text_domain' ),
		'description'           => __( 'Books', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title','editor', 'thumbnail' ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 30,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'rewrite'				=> array( 'slug' => 'books'),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'menu_icon'           	=> 'dashicons-book',
    );
    
	register_post_type( 'cpt_book', $args );

} add_action( 'init', 'custom_post_type_book', 0 );

/**
* Register categories for CPT
**/

function register_book_taxonomies() {
	$labels = array(
	  'name'              => _x( 'Categoria', 'taxonomy general name' ),
	  'singular_name'     => _x( 'Categoría', 'taxonomy singular name' ),
	  'search_items'      => __( 'Buscar categoría' ),
	  'all_items'         => __( 'Todas las categorías' ),
	  'parent_item'       => __( 'Categoría padre' ),
	  'parent_item_colon' => __( 'Categoría padre' ),
	  'edit_item'         => __( 'Editar categoría' ), 
	  'update_item'       => __( 'Actualizar' ),
	  'add_new_item'      => __( 'Añadir nueva categoría' ),
	  'new_item_name'     => __( 'Nueva categoría' ),
	  'menu_name'         => __( 'Categorias' ),
	);
	$args = array(
	  'labels' => $labels,
	  'hierarchical' => true,
	);
	register_taxonomy( 'cat_book', 'cpt_book', $args );
  }
  add_action( 'init', 'register_book_taxonomies', 0 );