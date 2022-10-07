<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package riverviewhc
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css">
	
	<?php wp_head(); ?>

	<?php if(is_page('how-to-apply')) : ?>
	 	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/onSubmitForm.js"></script>
	<?php endif;  ?>
	<?php if(is_page('faq')) : ?>
	 	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/faqs.js"></script>
	<?php endif;  ?>
</head>

<body <?php body_class(); ?>>
		<noscript><div><?php _e( 'Javascript must be enabled for the correct page display', 'riverviewhc' ); ?></div></noscript>
		<div class="page-holder">
			<div id="wrapper">
				<header id="header" class="header site-header">

					<div class="header-top">
						<div class="container">
							<div class="row">
								<div class="col-9">
									<?php if( has_nav_menu( 'top-nav' ) )
									wp_nav_menu( array(
										'container' => false,
										'theme_location' => 'top-nav',
										'menu_id'        => 'top-nav',
										'menu_class'     => 'top-nav',
										'depth'          => 1,
										'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>'
										)
									); ?>
										
								</div>
								<div class="col-3"><?php get_search_form(); ?></div>
							</div>
							
							
						</div>
					</div>

					<div class="header-body">
						<div class="container">
							<?php if ( has_custom_logo() ) : ?>
								<div class="logo" itemscope itemtype="http://schema.org/Brand">
									<?php the_custom_logo(); ?>
								</div>
							<?php endif; ?>


							<?php if( has_nav_menu( 'primary' ) ) : ?>
								

								<div class="nav-holder">
									<?php wp_nav_menu( array(
											'container' 	 => false,
											'theme_location' => 'primary',
											'menu_id'        => 'primary-navigation',
											'menu_class'     => 'primary-navigation accordion-nav',
											'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
											'depth'          => 2,
											'walker'         => new Custom_Walker_Nav_Menu
											)
										); ?>
									
								</div>
								<button class="btn btn-custom" id="donate-button">
									<a href="http://rhc.dev.metricmarketing.ca/foundation/how-to-give/donate/">
										<p class="white-text">Donate</p>
									</a>
								</button>
								<button class="hamburger hamburger--collapse" type="button">
									<span class="hamburger-box">
										<span class="hamburger-inner"></span>
									</span>
								</button>
							<?php endif; ?>
						</div>
					</div>
				</header>



