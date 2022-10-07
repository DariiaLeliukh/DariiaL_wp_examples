<?php
	$section_title = get_field( 'section_title' );
	$section_subhead = get_field( 'section_subhead' );
	$number_of_columns_max = get_field( 'number_of_columns_max' );
	
	if($number_of_columns_max == '4'){$cols=3;} 
	if($number_of_columns_max == '3') {$cols=4;}
	if($number_of_columns_max == '2') {$cols=6;}
	if($number_of_columns_max == '1') {$cols=12;}
	
?>

<?php if ( $section_title || have_rows( 'tiles' ) ): ?>
	<section class="full-section icons-section <?php if(is_page('home')): echo 'home-page'; endif;?>">
		<div class="container py-5 py-md-7 py-lg-10 ">
			<?php if ( $section_title ): ?>
				<p class="text-center title"><?php echo $section_title; ?></p>
			<?php endif; ?>
			<?php if ( $section_subhead ): ?>
				<p class="text-center subhead"><?php echo $section_subhead; ?></p>
			<?php endif; ?>

			<?php if ( have_rows( 'tiles' ) ): ?>
				<div class="row text-center mb-5 mt-1 mt-md-2 mt-lg-5">
					<?php while ( have_rows( 'tiles' ) ): the_row();
							$icon_image = get_sub_field( 'icon_image' );
							$title = get_sub_field('title');
							$text = get_sub_field('text');
							$link = get_sub_field('link');

						?>
						
						<div class="col-xs-12 col-sm-6 col-md-<?php echo $cols ; ?> mt-3 mx-auto">
							<div class="card card-block h-100 <?php if(!is_page('rhc-foundation')): echo 'shadow-border tile'; endif;?>">
							    <?php if ( $link): ?>
							     	<a href="<?php echo $link; ?>">
							    <?php endif; ?>
							    	<div class="tile-inner">
							    		<img src=" <?php echo $icon_image?> "/>
							    		<?php if ($title): ?>
							    			<p> <?php echo $title; ?></p>
							    		<?php endif; ?>
							    		<?php if ($text): ?>
							    			<div class="text"> <?php echo $text; ?></div>
							    		<?php endif; ?>
							    	</div>
								<?php if ( $link): ?>
								    </a>
								<?php endif; ?> 
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif ?>
		</div>
	</section>
<?php endif; ?>