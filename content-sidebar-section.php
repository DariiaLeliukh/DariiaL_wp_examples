<?php 
	$title = get_field( 'title' );
	$intro_colored = get_field( 'intro_colored' );
	$intro = get_field( 'intro' );
	$sidebar_ON = get_field( 'sidebar' );
?>
<section class="py-3">
	<?php if($sidebar_ON) : ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-8 left-sidebar-text">
					<?php if($title): ?>
						<h2 class="left-sidebar-text-header"><?php echo $title; ?></h2>
					<?php endif; ?>
					<?php if($intro_colored): ?>
						<div class="intro-colored"><?php echo $intro_colored; ?></div>
					<?php endif; ?>
					<?php if($intro): ?>
						<div><?php echo $intro; ?></div>
					<?php endif; ?>

				</div>
				<div class="col-4 page-sidebar">
						<?php dynamic_sidebar('menu-pages-sidebar'); ?>
				</div>
				
			</div>
		</div>

	<?php endif; ?>
</section>