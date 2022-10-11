<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package virtusgroup
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function virtusgroup_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'virtusgroup_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function virtusgroup_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'virtusgroup_pingback_header' );

// ACF Functions
include( get_template_directory() . '/inc/acf-functions.php' );

//Shortcodes
include( get_template_directory() . '/inc/custom-shortcodes.php' );

//Recent Widget
include( get_template_directory() . '/inc/custom-widgets.php' );

function register_custom_widgets() {
    register_widget( 'custom_recent_posts' );
    register_widget('custom_author');
    register_widget('contact_cta');
    register_widget('custom_related_posts');
    register_sidebar( array(
        'name'          => __( 'Category Page Sidebar', 'virtusgroup' ),
        'id'            => 'category-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Blog Article Sidebar', 'virtusgroup' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'register_custom_widgets' );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}
// Our custom post type function
function create_posttype() {
 
    register_post_type( 'team-member',
        array(
            'labels' => array(
                'name' => __( 'Our Team' ),
                'singular_name' => __( 'Team Member' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'team-members'),
            'supports' => array( 'page-attributes', 'editor', 'title', 'custom-fields' ),
            'show_in_rest' => true
 
        )

    );
    register_post_type( 'event',
        array(
            'labels' => array(
                'name' => __( 'Events' ),
                'singular_name' => __( 'Event' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'events'),
            'show_in_rest' => true,
 
        )

    );
    register_post_type( 'job-posting',
        array(
            'labels' => array(
                'name' => __( 'Careers' ),
                'singular_name' => __( 'Job Posting' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'careers'),
            'show_in_rest' => true,

        )

    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

add_filter('manage_' . 'team-member_posts_columns', function ($columns) {
    $columns['menu_order'] = "Order"; //column key => title
    return $columns;
});
// display the column value
add_action( 'manage_' . 'team-member_posts_custom_column', function ($column_name, $post_id){
    if ($column_name == 'menu_order') {
        echo get_post($post_id)->menu_order;
    }
}, 10, 2); // priority, number of args - MANDATORY HERE!
// make it sortable
$menu_order_sortable_on_screen = 'edit-team-member' ; // screen name of LIST page of posts
add_filter('manage_' . $menu_order_sortable_on_screen . '_sortable_columns', function ($columns){
    // column key => Query variable
    // menu_order is in Query by default so we can just set it
    $columns['menu_order'] = 'menu_order';
    return $columns;
});
/*
 * Team member columns (position)
 * */
function add_acf_columns ( $columns ) {
    return array_merge ( $columns, array (
        'position' => __ ( 'Position' ),
    ) );
}
add_filter ( 'manage_team-member_posts_columns', 'add_acf_columns' );

function team_member_custom_column ( $column_name, $post_id ) {
    if ($column_name == 'position') {
        echo get_post_meta( $post_id, 'position', true );
    }
}
add_action ( 'manage_team-member_posts_custom_column', 'team_member_custom_column', 10, 2 );


//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires
 
add_action( 'init', 'create_topics_nonhierarchical_taxonomy', 0 );
 
function create_topics_nonhierarchical_taxonomy() {
 
// Team Members Taxonomy
 
  $labels = array(
    'name' => _x( 'Area of Excellence', 'taxonomy general name' ),
    'singular_name' => _x( 'Area of Excellence', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Area of Excellence' ),
    'popular_items' => __( 'Popular Areas of Excellence' ),
    'all_items' => __( 'All Areas of Excellence' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Area of Excellence' ), 
    'update_item' => __( 'Update Area of Excellence' ),
    'add_new_item' => __( 'Add New Area of Excellence' ),
    'new_item_name' => __( 'New Area of Excellence Name' ),
    'separate_items_with_commas' => __( 'Separate Areas of Excellence with commas' ),
    'add_or_remove_items' => __( 'Add or remove Areas of Excellence' ),
    'choose_from_most_used' => __( 'Choose from the most used Areas of Excellence' ),
    'menu_name' => __( 'Areas of Excellence' ),
  ); 
 
  register_taxonomy('areas_of_excellence','team-member',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'areas_of_excellence' ),
  ));

    $labels = array(
    'name' => _x( 'Industry Expertise', 'taxonomy general name' ),
    'singular_name' => _x( 'Industry Expertise', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Industry Expertise' ),
    'popular_items' => __( 'Popular Industry Expertise' ),
    'all_items' => __( 'All Industry Expertise' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Industry Expertise' ), 
    'update_item' => __( 'Update Industry Expertise' ),
    'add_new_item' => __( 'Add New Industry Expertise' ),
    'new_item_name' => __( 'New Industry Expertise Name' ),
    'separate_items_with_commas' => __( 'Separate Industry Expertise with commas' ),
    'add_or_remove_items' => __( 'Add or remove Industry Expertise' ),
    'choose_from_most_used' => __( 'Choose from the most used Industry Expertise' ),
    'menu_name' => __( 'Industry Expertise' ),
  ); 
 
  register_taxonomy('industry_expertise','team-member',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'industry_expertise' ),
  ));

  $labels = array(
    'name' => _x( 'Location', 'taxonomy general name' ),
    'singular_name' => _x( 'Location', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Location' ),
    'popular_items' => __( 'Popular Location' ),
    'all_items' => __( 'All Location' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Location' ), 
    'update_item' => __( 'Update Location' ),
    'add_new_item' => __( 'Add New Location' ),
    'new_item_name' => __( 'New Location Name' ),
    'separate_items_with_commas' => __( 'Separate Location with commas' ),
    'add_or_remove_items' => __( 'Add or remove Location' ),
    'choose_from_most_used' => __( 'Choose from the most used Location' ),
    'menu_name' => __( 'Location' ),
  ); 
 
  register_taxonomy('locations','team-member',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'locations' ),
  ));

  //Job locations
    $labels = array(
        'name' => _x( 'Job Location', 'taxonomy general name' ),
        'singular_name' => _x( 'Job Location', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Job Locations' ),
        'popular_items' => __( 'Popular Job Locations' ),
        'all_items' => __( 'All Job Location' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Job Location' ),
        'update_item' => __( 'Update Job Location' ),
        'add_new_item' => __( 'Add New Job Location' ),
        'new_item_name' => __( 'New Job Location Name' ),
        'separate_items_with_commas' => __( 'Separate Job Locations with commas' ),
        'add_or_remove_items' => __( 'Add or remove Job Location' ),
        'choose_from_most_used' => __( 'Choose from the most used Job Locations' ),
        'menu_name' => __( 'Job Locations' ),
    );

    register_taxonomy('joblocations','job-posting',array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'joblocations' ),
    ));

//Event taxonomies

    $labels = array(
    'name' => _x( 'City', 'taxonomy general name' ),
    'singular_name' => _x( 'City', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Cities' ),
    'popular_items' => __( 'Popular Cities' ),
    'all_items' => __( 'All Cities' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit City' ), 
    'update_item' => __( 'Update City' ),
    'add_new_item' => __( 'Add New City' ),
    'new_item_name' => __( 'New City' ),
    'separate_items_with_commas' => __( 'Separate cities with commas' ),
    'add_or_remove_items' => __( 'Add or remove cities' ),
    'choose_from_most_used' => __( 'Choose from the most used cities' ),
    'menu_name' => __( 'Cities' ),
  ); 
 
  register_taxonomy('cities','event',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cities' ),
  ));

  $labels = array(
    'name' => _x( 'Province', 'taxonomy general name' ),
    'singular_name' => _x( 'Province', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Provinces' ),
    'popular_items' => __( 'Popular Provinces' ),
    'all_items' => __( 'All Provinces' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Province' ), 
    'update_item' => __( 'Update Province' ),
    'add_new_item' => __( 'Add New Province' ),
    'new_item_name' => __( 'New Province' ),
    'separate_items_with_commas' => __( 'Separate provinces with commas' ),
    'add_or_remove_items' => __( 'Add or remove provinces' ),
    'choose_from_most_used' => __( 'Choose from the most used provinces' ),
    'menu_name' => __( 'Provinces' ),
  ); 
 
  register_taxonomy('provinces','event',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'provinces' ),
  ));


}
function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Return an alternate title, without prefix, for every type used in the get_the_archive_title().
add_filter('get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = _x( 'Asides', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = _x( 'Galleries', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = _x( 'Images', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = _x( 'Videos', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = _x( 'Quotes', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = _x( 'Links', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = _x( 'Statuses', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = _x( 'Audio', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = _x( 'Chats', 'post format archive title' );
        }
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = __( 'Archives' );
    }
    return $title;
});

function _thz_enable_vcard_upload( $mime_types ){
  	$mime_types['vcf'] = 'text/vcard';
	$mime_types['vcard'] = 'text/vcard';
  	return $mime_types;
}
add_filter('upload_mimes', '_thz_enable_vcard_upload' );

add_filter('widget_title', 'change_widget_title', 10, 3);
function change_widget_title($title, $instance, $wid){
    global $wp_query;
    $postid = $wp_query->post->ID;
    $new_title = get_post_meta($postid, "sidebar_title", true);
    return $title = str_replace('CustomTitleForFiltering/DoNotEdit/', $new_title, $title);
}

add_action('pre_get_posts', function( WP_Query $query ) {
    if($query->is_main_query() && $query->is_category( array( 92, 'resource-library', 'Resource Library' ) )) {
        $query->set('posts_per_page', -1);
    }
});
