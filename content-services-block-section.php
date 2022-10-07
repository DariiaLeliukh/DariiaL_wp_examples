<?php 
	$heading = get_field('heading');
	$text = get_field('text');
	$cta = get_field('cta');
 ?>
<?php if($heading || $text || $cta) : ?>
<section class="services-block-section col-12 col-md-9">
	<div class="">
		<?php if($heading): ?>
			<h2> <?php echo $heading; ?></h2>
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
</section>	
<?php endif; ?>