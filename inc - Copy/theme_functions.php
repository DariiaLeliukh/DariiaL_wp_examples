<?php
// Theme functions

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a Sidebar Section
		acf_register_block(array(
			'name'				=> 'sidebar-section',
			'title'				=> __('Sidebar Section'),
			'description'		=> __('A custom Sidebar Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'align-left',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'sidebar-section', 'sidebar' ),
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

		// register a Text with Video Section
		acf_register_block(array(
			'name'				=> 'text-w-video-section',
			'title'				=> __('Text with Video Section'),
			'description'		=> __('A custom Text with Video Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'playlist-video',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'text', 'video', 'cta' ),
		));

		// register an Icons Section
		acf_register_block(array(
			'name'				=> 'icons-section',
			'title'				=> __('Icons Section'),
			'description'		=> __('A custom Icons Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'forms',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'icon' ),
		));

		// register an News Selection Section
		acf_register_block(array(
			'name'				=> 'news-selection-section',
			'title'				=> __('News Selection Section'),
			'description'		=> __('A custom News Selection Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'paperclip',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'post', 'news' ),
		));

		// register an Events Selection Section
		acf_register_block(array(
			'name'				=> 'events-selection-section',
			'title'				=> __('Events Selection Section'),
			'description'		=> __('A custom Events Selection Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'buddicons-groups',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'post', 'event' ),
		));

		// register an Executive Team Section
		acf_register_block(array(
			'name'				=> 'executive-team-section',
			'title'				=> __('Executive Team Section'),
			'description'		=> __('A custom Executive Team Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'groups',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'team', 'person' ),
		));

		// register an Hero Banner Section
		acf_register_block(array(
			'name'				=> 'banner-section',
			'title'				=> __('Hero Banner Section'),
			'description'		=> __('A custom Hero Banner Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'megaphone',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'banner', 'image' ),
		));

		// register an Files Section
		acf_register_block(array(
			'name'				=> 'files-section',
			'title'				=> __('Files Section'),
			'description'		=> __('A custom Files Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-links',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'file', 'attachment' ),
		));

		// register an Questions Section
		acf_register_block(array(
			'name'				=> 'questions-section',
			'title'				=> __('Questions Section'),
			'description'		=> __('A custom Questions Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'format-chat',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'faq', 'list' ),
		));

		// register an Tiles Section
		acf_register_block(array(
			'name'				=> 'tiles-section',
			'title'				=> __('Tiles Section'),
			'description'		=> __('A custom Tiles Section.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'screenoptions',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'tile', 'image', 'cta'),
		));

		// register an Foundation Stats Block (custom for foundation page)
		acf_register_block(array(
			'name'				=> 'stats-section',
			'title'				=> __('Foundation Stats Block'),
			'description'		=> __('A custom Foundation Stats Block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'chart-bar',
			'mode' 				=> 'edit',
			'keywords'			=> array( 'foundation', 'stats', 'cta'),
		));
		//register an Expandable List Section
		acf_register_block( array(
		'name'					=> 'expandable-list',
		'title'					=> __( 'Expandable List'),
		'description'			=> __('A custom Expandable List Section.'),
		'render_callback'		=> 'my_acf_block_render_callback',
		'category'				=> 'formatting',
		'icon'					=> 'list-view',
		'mode' 					=> 'edit',
		'keywords'				=> array( 'list', 'text-list' ),
		));

	}
}

function my_acf_block_render_callback( $block ) {

	$slug = str_replace('acf/', '', $block['name']);

	// include a template part from within the "blocks/template-parts" folder
	if( file_exists( get_theme_file_path("/blocks/content-{$slug}.php") ) ) {
		include( get_theme_file_path("/blocks/content-{$slug}.php") );
	}
}



// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
       global $post;
	return '...<br/><a class="moretag" href="'. get_permalink($post->ID) . '"> Read more-></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);

      if (count($excerpt) >= $limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . '...';
      } else {
          $excerpt = implode(" ", $excerpt);
      }

      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

      return $excerpt;
}


// Custom Post Types
include( get_template_directory() . '/inc/cpt.php' );