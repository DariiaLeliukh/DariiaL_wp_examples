<?php 
	$title = get_field( 'title' );
	$text = get_field( 'text' );
	$video = get_field( 'video' );
	$video_position = get_field( 'video_position' );
	$cta = get_field( 'cta' );
	$cta_text = get_field( 'cta_text' );
	$background_color = get_field( 'background_color' );
?>
<section class="py-10 full-section text-w-video-section" style="background-color: <?php echo $background_color;?>;">
	<?php if($video) : ?>
	<div class="container">
		<div class="row">
			<?php if($video_position == 'left') : ?>
				<div class="col-sm-12 col-lg-6 my-auto">
					<div class="embed-container">
						<?php the_field('video'); ?>
					</div>
				</div>
			<?php endif; ?>
				
			<div class="col-sm-12 col-lg-6 mb-5">
				<?php if($title): ?>
					<p class="h2"> <?php echo $title; ?></p>
				<?php endif; ?>
				<?php if($text): ?>
					<div class="my-md-5"><?php echo $text; ?></div>
				<?php endif; ?>
				<?php if($cta): ?>
					<div class="button">
						<button class="btn btn-custom color0082c6">
							<a href="<?php echo esc_url( $cta ); ?>">
								<p class="white-text"><?php echo $cta_text ?></p>
							</a>
						</button>
				</div>
					
				<?php endif; ?>

			</div>

			<?php if($video_position == 'right') : ?>
				<div class="col-sm-12 col-lg-6 my-auto">
					<div class="embed-container">
						<?php the_field('video'); ?>
					</div>
				</div>
			<?php endif; ?>
			
			
		</div>
	</div>
<?php endif; ?>
</section>
