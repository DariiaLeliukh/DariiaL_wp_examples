<?php 
	$color = get_field( 'color' );
?>
<?php if ( have_rows( 'columns' ) ): ?>
	<section class="two-col-icon-section full-section" 
	style="background-color: <?php echo $color; ?>;" >
		<div class="inner-holder">
			<div class="container">
				<div class="row align-items-center">
					<?php if ( have_rows( 'columns' ) ): ?>
						<div class="card-deck">
							<?php while ( have_rows( 'columns' ) ): the_row();
									$icon = get_sub_field( 'icon' );
									$heading = get_sub_field('heading');
									$text = get_sub_field('text');
									$button = get_sub_field('button');
								?>
							<div class="card">
								<?php if( !empty( $icon ) ): ?>
									<img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" class="icon card-img-top" />
								<?php endif; ?>
								<div class="card-body">
									<?php if($heading) : ?>
										<h3 class="card-title"> <?php echo $heading; ?> </h3>
									<?php endif; ?>
									<?php if($text) : ?>
										<p class="card-text"> <?php echo $text; ?> </p>
									<?php endif; ?>
								</div>

								<?php if($button) : ?>
								<div class="card-footer">
									<?php 
									$link_url = $button['url'];
    								$link_title = $button['title'];
    								$link_target = $button['target'] ? $button['target'] : '_self'; ?>
									<a class="btn button primary-button btn-lg" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								</div>
								<?php endif; ?>
							</div>
							
							<?php endwhile; ?>
						</div>
					<?php endif ?>
					
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>