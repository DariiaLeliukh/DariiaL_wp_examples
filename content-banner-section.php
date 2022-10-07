<?php 
	$banner_image = get_field('banner_image');
	$banner_title = get_field('banner_title');
?>
	<div class="banner">
		<?php	if(get_field('banner_image')) : ?>
			<img src="<?php the_field('banner_image');  ?>">
		<?php endif;?>
		
		<?php	if($banner_title) : ?>
			<div class="banner-text">
				<h1><?php echo $banner_title; ?></h1>
			</div>
		<?php endif;?>
	</div>
	