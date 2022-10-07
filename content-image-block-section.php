<?php 
	$heading = get_field( 'heading' );
if ( have_rows( 'images' ) && $heading): ?>
	<section class="image-block-section full-section" >
		<div class="container">
			<h2 class="text-center"><?php echo $heading; ?></h2>
			<div class="row">
				<?php while ( have_rows( 'images' ) ): the_row();
					$image = get_sub_field( 'image' );
					$link = get_sub_field('link');
				?>
				<div class="col text-center d-flex">
					<?php if($link) : 
						$link_url = $link['url'];
					    $link_title = $link['title'];
					    $link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?>
					<?php endif; ?>
					<?php if( !empty( $image ) ): ?>
			    		<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="mx-auto my-auto"/>
					<?php endif; ?>
					<?php if($link) : ?>
						</a>
					<?php endif; ?>
				</div>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; ?>