<?php  
	$heading = get_field('heading');
	$text = get_field('text');
	$image = get_field('image');
?>
<?php if($heading || $text) : ?>

<section class="full-section shifted-image-section text-white">
		<div class="container">
			
			<div class="row">
				
				<div class="col-12 col-md-6">
					<?php 
						
						if( !empty( $image) ): ?>
						    <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
						<?php endif; ?>
				</div>
				<div class="col-12 col-md-5 offset-md-1">
					<h2><?php echo $heading ;?></h2>
					<p class="content">
						<?php echo $text ;?>
					</p>
				</div>
			</div>
			
		</div>
		
	</section>
<?php endif; ?>