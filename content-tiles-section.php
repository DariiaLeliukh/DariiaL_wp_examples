<?php
	$section_title = get_field( 'section_title' );
	$description = get_field('description');
?>

<?php if ( $section_title || have_rows( 'tiles' ) ): ?>
	<section class="tiles-section mt-5 mb-7">
		<div class="container">
			<?php if ( $section_title || $description ): ?>
				<p class="text-center title"><?php echo $section_title; ?></p>
				<div class="text-center"><?php echo $description; ?></div>
			<?php endif; ?>

			<?php if ( have_rows( 'tiles' ) ): ?>
				<div class="row text-center">
					<?php while ( have_rows( 'tiles' ) ): the_row();
							$title = get_sub_field('title');

							$link = get_sub_field('link');
						?>
						
						<div class="col-xs-12 col-sm-6 col-lg-4 mx-auto my-3">
							<div class="card card-block h-100 justify-content-center">
							    <?php if ( $link): ?>
							     	<a href="<?php echo $link; ?>">
							    <?php endif; ?>
							    	<div class="tile-inner ">
							    		<?php if ($title): ?>
							    			<p> <?php echo $title; ?></p>
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