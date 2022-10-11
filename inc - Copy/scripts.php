<?php
// Theme css & js

function base_scripts_styles() {
	$in_footer = true;
	
		// Loads Bootstrap file with functionality specific.
		wp_enqueue_script( 'base-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array( 'jquery' ), '', $in_footer );
		wp_enqueue_script( 'base-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array( 'jquery' ), '', $in_footer );

	// Loads JavaScript file with functionality specific.
	wp_enqueue_script( 'base-script', get_template_directory_uri() . '/js/jquery.main.js', array( 'jquery' ), '', $in_footer );
	$path_info = array(
		
		'css' => 'css/',
		'js' => 'js/',
		
	);
	wp_localize_script( 'base-script', 'pathInfo', $path_info );

	
}
add_action( 'wp_enqueue_scripts', 'base_scripts_styles' );

/*
* Enquire faqs.js file if it exists
*/

function load_scripts(){
    wp_enqueue_script('ajax', get_template_directory_uri() . '/js/faqs.js', array('jquery'), NULL, true);
    
    wp_localize_script('ajax', 'wpAjax', 
        array('ajaxUrl' => admin_url('admin-ajax.php'))
    );
}
add_action('wp_enqueue_scripts', 'load_scripts');