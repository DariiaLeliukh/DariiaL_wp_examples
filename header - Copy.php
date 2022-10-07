<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package INFINITETE
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'infinitete' ); ?></a>

	<header id="masthead" class="site-header">
        <?php
        $header_section = get_field('header_section', 'option');
        $header_button = $header_section['header_button'];
        $header_dark_logo = $header_section['header_dark_logo'];
        $header_light_logo = $header_section['header_light_logo'];
        ?>
        <div class="site-branding">
            <div class="container">
                <div class="row">
                    <nav id="site-navigation" class="navbar navbar-expand-lg navbar-light main-nav">
                        <div class="logo navbar-brand">
                            <?php if (is_front_page()): ?>
                                <?php if( !empty( $header_light_logo ) ): ?>
                                    <a href="<?php echo get_home_url() ;?>">
                                        <img src="<?php echo esc_url($header_light_logo['url']); ?>" alt="<?php echo esc_attr($header_light_logo['alt']); ?>" />
                                    </a>
                                <?php else : ?>
                                <?php the_custom_logo() ;?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if( !empty( $header_dark_logo ) ): ?>
                                    <a href="<?php echo get_home_url() ;?>">
                                        <img src="<?php echo esc_url($header_dark_logo['url']); ?>" alt="<?php echo esc_attr($header_dark_logo['alt']); ?>" />
                                    </a>
                                <?php endif; ?>
                            <?php endif ;?>
                        </div>
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <div id="primary-menu" class="navbar-collapse collapse">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'primary',
                                    'container'=> false,
                                    'menu_class'     => 'navbar-nav ml-auto',
                                    'items_wrap'     => '<ul id="%1$s" class="%2$s navbar-nav">%3$s</ul>',
                                    'add_li_class'  => 'nav-item',
                                )
                            );
                            ?>
                            <div class="start-btn">
                                <?php if($header_button) :

                                    $link_url = $header_button['url'];
                                    $link_title = $header_button['title'];
                                    $link_target = $header_button['target'] ? $header_button['target'] : '_self';
                                    ?>
                                    <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="<?php echo is_front_page() ? 'dark-btn' : 'light-btn' ;?> btn" id="start-btn"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif ;?>
                            </div>
                        </div>

                    </nav>
                </div>
            </div>
            <?php if(is_front_page() ):?>
                <?php
                $image = get_field('image');
                $heading = get_field( 'heading' );
                $subhead = get_field( 'subhead' );
                ?>

                <section class="home-banner" style="<?php if ( $image ): ?>background-image: url('<?php echo $image['url'] ?>')"<?php endif; ?>>
                    <div class="inner-holder">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-6 text">
                                    <h1><?php echo $heading ;?></h1>
                                    <p><?php echo $subhead ;?></p>
                                    <?php
                                    $link = get_field('cta');
                                    if( $link ):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="btn light-btn" ><?php echo esc_html( $link_title ); ?></a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>


            <?php endif ;?>
        </div>


	</header><!-- #masthead -->
