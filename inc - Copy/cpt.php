<?php
// Custom Post Types


add_action( 'init', 'base_custom_init' );
function base_custom_init() {
	// FAQs
	$labels = array(
		'name' => __( 'FAQs', 'riverviewhsc' ),
		'singular_name' => __( 'FAQ', 'riverviewhsc' ),
		'add_new' => __( 'Add New', 'riverviewhsc' ),
		'add_new_item' => __( 'Add New FAQ', 'riverviewhsc' ),
		'edit_item' => __( 'Edit FAQ', 'riverviewhsc' ),
		'new_item' => __( 'New FAQ', 'riverviewhsc' ),
		'all_items' => __( 'All FAQs', 'riverviewhsc' ),
		'view_item' => __( 'View FAQ', 'riverviewhsc' ),
		'search_items' => __( 'Search FAQs', 'riverviewhsc' ),
		'not_found' => __( 'No FAQs found', 'riverviewhsc' ),
		'not_found_in_trash' => __( 'No FAQs in Trash', 'riverviewhsc' ),
		'parent_item_colon' => '',
		'menu_name' => __( 'FAQs', 'riverviewhsc' ),
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'faqs' ),
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'query_var' => true,
		'menu_icon'   => 'dashicons-format-chat',
		'show_in_rest' => false,
		'taxonomies'  => array( 'faq-category' ),

	);
	register_post_type( 'faqs', $args );
}

//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires
 
add_action( 'init', 'create_topics_nonhierarchical_taxonomy', 0 );
 
function create_topics_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'FAQ Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'FAQ Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search FAQ Categories' ),
    'popular_items' => __( 'Popular FAQ Categories' ),
    'all_items' => __( 'All FAQ Categories' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit FAQ Category' ), 
    'update_item' => __( 'Update FAQ Category' ),
    'add_new_item' => __( 'Add New FAQ Category' ),
    'new_item_name' => __( 'New FAQ Category Name' ),
    'separate_items_with_commas' => __( 'Separate FAQ Categories with commas' ),
    'add_or_remove_items' => __( 'Add or remove FAQ Category' ),
    'choose_from_most_used' => __( 'Choose from the most used FAQ Categories' ),
    'menu_name' => __( 'FAQ Categories' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('faqs-categories','faqs',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'faqs-categories' ),
  ));
}