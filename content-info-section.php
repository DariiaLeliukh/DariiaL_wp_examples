<?php 
	$heading = get_field( 'heading' );
	$text = get_field( 'text' );
	$image = get_field('image');
	$color = get_field('color');
?>
<?php if ( $heading || $text ): ?>
	<section class="info-section full-section primary-color text-white" style="<?php if ( $image ): ?>background-image: url('<?php echo $image['url'] ?>')"<?php endif; ?>>
		<div class="inner-holder">
			<div class="container">
				<div class="row align-items-center">
					<?php if ( $heading || $text ): ?>
						<div class="col-12 offset-md-6 col-md-6 mb-5 mb-md-0">
							<?php if ( $heading ): ?>
                                <?php if (is_front_page()) : ?>
                                    <h1><?php echo $heading; ?></h1>
                                <?php else: ?>
								    <h2><?php echo $heading; ?></h2>
                                <?php endif;?>
							<?php endif; ?>
							<?php if ( $text ): ?>
								<p><?php echo $text; ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
