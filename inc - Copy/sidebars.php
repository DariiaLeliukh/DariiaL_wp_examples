<?php
// Theme sidebars

function theme_widget_init() {
	register_sidebar( array(
		'id'            => 'menu-pages-sidebar',
		'name'          => __( 'Pages Menu Sidebar', 'riverviewhsc' ),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="sidebar-title">',
		'after_title'   => '</p>'
	) );

	register_sidebar( array(
		'id'            => 'default-sidebar',
		'name'          => __( 'Default Sidebar', 'riverviewhsc' ),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="sidebar-title">',
		'after_title'   => '</p>'
	) );

	register_sidebar( array(
		'id'            => 'footer-sidebar',
		'name'          => __( 'Footer Sidebar', 'riverviewhsc' ),
		'before_widget' => '<div class="footer-widget %2$s col-12 col-md" id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="footer-title">',
		'after_title'   => '</p>'
	) );

	
}
add_action( 'widgets_init', 'theme_widget_init' );