<?php 
	$title = get_field( 'title' );
	$text = get_field( 'text' );
	$image = get_field( 'image' );
	$image_position = get_field( 'image_position' );
	$cta = get_field( 'cta' );
?>
<?php if($title || $text || $image || $cta) : ?>
<section class="full-section text-w-image-section">
	<?php if($image) : ?>
	<div class="container">
		<div class="row">
			<?php if($image_position == 'left') : ?>
				<div class="col-sm-12 col-lg-6 my-auto image-center">
					<img src=' <?php echo $image; ?>'/>
				</div>
			<?php endif; ?>
				
			<div class="col-sm-12 col-lg-5 my-auto <?php echo ($image_position == 'left') ? 'offset-lg-1' : '' ?>">
				<?php if($title): ?>
					<h2> <?php echo $title; ?></h2>
				<?php endif; ?>
				<?php if($text): ?>
					<div class="mt-md-4 text-justify"><?php echo $text; ?></div>
				<?php endif; ?>
				<?php if($cta): ?>
					<?php 
						$link_url = $cta['url'];
						$link_title = $cta['title'];
						$link_target = $cta['target'] ? $cta['target'] : '_self'; ?>
						<a class="btn button primary-button btn-lg" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>

			</div>

			<?php if($image_position == 'right') : ?>
				<div class="col-sm-12 col-lg-6 my-auto image-center <?php echo ($image_position == 'left') ? '' : 'offset-lg-1' ?>">
					<img src=' <?php echo $image; ?>'/>
				</div>
			<?php endif; ?>
			
			
		</div>
	</div>
<?php endif; ?>
</section>
<?php endif; ?>