<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package riverviewhc
 */

?>
</main>
			</div>
			
			<footer id="footer" class="footer">
				<div class="container">

						<div class="row">
							<!--Footer Logo Image-->							
							<div class="col-sm-12 col-md-4 col-lg-2">
								<?php if ( get_field('footer_logo_image', 'option') ) : ?>
									<div class="logo" itemscope itemtype="http://schema.org/Brand">
										<img src="<?php the_field('footer_logo_image', 'option'); ?>"/>
									</div>
								<?php endif; ?>
							</div><!-- end Footer Logo Image-->

							<!--Footer Address-->
							<div class="col-sm-12 col-md-4 col-lg-3">
								<?php if ( get_field('address', 'option') ) : ?>
									<div class="footer-address">
										<p><?php bloginfo('name'); ?></p>
										
										<?php the_field('address', 'option'); ?>
									</div>
								<?php endif; ?>

								<?php if ( get_field('privacy_policy_link', 'option') ) : ?>
									<a href="<?php the_field('privacy_policy_link', 'option'); ?>" class="colorc1effa">Privacy Policy</a>
								<?php endif; ?>

								<?php if ( get_field('copyright', 'option') ) : ?>
									<p class="copyright">&copy; <?php bloginfo('name'); ?> <?php echo Date('Y'); ?></p>
								<?php endif; ?>


							</div><!--end Footer Address-->


							<!--Footer Cell/Email-->
							<div class="col-sm-12 col-md-4 col-lg-3">
								<?php if ( get_field('call', 'option') ) : ?>
										<p>Call <?php the_field('call', 'option'); ?></p>
								<?php endif; ?>

								<?php if ( get_field('email', 'option') ) : ?>
									<a href="mailto:<?php the_field('email', 'option'); ?>" id="footer-email" class="colorc1effa">
										Email <?php the_field('email', 'option'); ?>
									</a>
								<?php endif; ?>

								<?php if ( get_field('footer_text', 'option') ) : ?>
									<p class="footer-text"><?php the_field('footer_text', 'option'); ?></p>
								<?php endif; ?>


							</div><!--end Cell/Email-->

							<!--Footer Menus-->
							<div class="footer-menus col-sm-12 col-md-12 col-lg-4">
								<div class="row">
									<div class="col-sm-12 col-md-6 col-lg-6">
										<?php if( has_nav_menu( 'footer-1' ) )
											wp_nav_menu( array(
												'container' => false,
												'theme_location' => 'footer-1',
												'menu_id'        => 'footer-1-nav',
												'menu_class'     => 'footer-nav',
												'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>'
												)
											); ?>
									</div>
									<div class="col-sm-12 col-md-6 col-lg-6">
										<?php if( has_nav_menu( 'footer-2' ) )
											wp_nav_menu( array(
												'container' => false,
												'theme_location' => 'footer-2',
												'menu_id'        => 'footer-2-nav',
												'menu_class'     => 'footer-nav',
												'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>'
												)
											); ?>
									</div>
								</div>

								<!-- Social Icons-->
								<?php if ( have_rows( 'socials', 'option' ) ): ?>
									<div class="row">
										<div class="socials">
											<?php while ( have_rows( 'socials', 'option' ) ): the_row();
													$image = get_sub_field( 'social_icon' );
													$link = get_sub_field( 'social_url' );
												?>
												<?php if ( $image && $link ): ?>
													<div class="icon">
														<a href="<?php echo esc_url( $link ); ?>">
															<img src="<?php echo $image; ?>">
														</a>	
													</div>
												<?php endif; ?>
											<?php endwhile; ?>
										</div>
									</div>
								<?php endif; ?>
								<!-- end Social Icons-->
								
							</div> <!-- end Footer Menus-->

							

						</div>
				</div>
			</footer>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
