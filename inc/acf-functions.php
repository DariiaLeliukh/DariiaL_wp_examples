<?php
// Theme functions

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register an Info Section
		acf_register_block(array(
			'name'				=> 'info-section',
			'title'				=> __('Info Section (Blue bg)'),
			'description'		=> __('A custom Info Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'info-outline',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'info-section', 'quote' ),
		));
		// register a Two Column with Icons Section
		acf_register_block(array(
			'name'				=> 'two-col-icon-section',
			'title'				=> __('Two Column with Icons Section'),
			'description'		=> __('A custom Two Column with Icons Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'columns',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'icon', 'cta', 'two' ),
		));
		// register a Image Block Section
		acf_register_block(array(
			'name'				=> 'image-block-section',
			'title'				=> __('Image Block Section'),
			'description'		=> __('A custom Image Block Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'networking',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'image', 'partner' ),
		));
		// register a Featured Pages Section
		acf_register_block(array(
			'name'				=> 'featured-tiles-section',
			'title'				=> __('Featured Pages Section'),
			'description'		=> __('A custom Featured Pages Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'megaphone',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'featured', 'tile', 'post' ),
		));
		// register a Text with Image Section
		acf_register_block(array(
			'name'				=> 'text-w-image-section',
			'title'				=> __('Text with Image Section'),
			'description'		=> __('A custom Text with Image Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'layout',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'text', 'image', 'cta' ),
		));
		// register a Virtus Monthly Section
		acf_register_block(array(
			'name'				=> 'virtus-monthly-section',
			'title'				=> __('Virtus Monthly Section'),
			'description'		=> __('A custom Virtus Monthly Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'email-alt',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'form', 'contact' ),
		));
		// register a Intro Section
		acf_register_block(array(
			'name'				=> 'intro-section',
			'title'				=> __('Intro Section(H1+white bg)'),
			'description'		=> __('A custom Intro Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'nametag',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'intro', 'info' ),
		));
		// register a Shifted Image Section
		acf_register_block(array(
			'name'				=> 'shifted-image-section',
			'title'				=> __('Shifted Image Section'),
			'description'		=> __('A custom Shifted Image Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'format-gallery',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'image', 'info' ),
		));
		// register a List of Pages Section
		acf_register_block(array(
			'name'				=> 'pages-list-section',
			'title'				=> __('List of Pages Section'),
			'description'		=> __('A custom List of Pages Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'welcome-widgets-menus',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'list', 'pages', 'menu' ),
		));

		// register a Services Block Section
		acf_register_block(array(
			'name'				=> 'services-block-section',
			'title'				=> __('Services Block Section'),
			'description'		=> __('A custom Services Block Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'info',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'cta', 'product', 'info' ),
		));
		// register a Quote Block Section
		acf_register_block(array(
			'name'				=> 'quote-block-section',
			'title'				=> __('Quote Block Section'),
			'description'		=> __('A custom Quote Block Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'format-quote',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'quote', 'info' ),
		));
		// register a Request a Quote Section
		acf_register_block(array(
			'name'				=> 'request-quote-section',
			'title'				=> __('Request a Quote Section'),
			'description'		=> __('A custom Request a Quote Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'forms',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'quote', 'form', 'request' ),
		));
	}
}

function my_acf_block_render_callback( $block ) {

	$slug = str_replace('acf/', '', $block['name']);

	// include a template part from within the "blocks/template-parts" folder
	if( file_exists( get_theme_file_path("/template-parts/blocks/content-{$slug}.php") ) ) {
		include( get_theme_file_path("/template-parts/blocks/content-{$slug}.php") );
	}
}
