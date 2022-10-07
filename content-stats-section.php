<?php
	$section_title = get_field( 'section_title' );
	$section_subhead = get_field( 'section_subhead' );
	$centered_text = get_field( 'centered_text' );

?>

<?php if ( have_rows( 'tiles_text' ) ||  have_rows( 'tiles_images' )): ?>
	<section class="full-section foundation-stats-section py-5">
		<div class="container">
			<?php if($section_title) :?>
				<div class="col-sm-12 col-lg-6 mx-auto"><h2 class="title text-center"> <?php echo $section_title; ?> </h2></div>
			<?php endif; ?>

			<?php if($section_subhead) :?>
				<div class="subhead text-center"> <?php echo $section_subhead; ?> </div>
			<?php endif; ?>

			<div class="row">
				<?php while ( have_rows( 'tiles_text' ) ): the_row();
						$text = get_sub_field('text');
						$description = get_sub_field('description');

					?>

					<div class="col-sm-12 col-md-6 mx-auto">
						<div class="card card-block h-100  align-items-center mx-auto">
							<?php if($text) : ?> 
								<div class="tile-inner text"> <?php echo $text; ?> </div>
							<?php endif; ?>
							<?php if($image) : ?> 
								<div class="tile-inner"> <img src="<?php echo $image; ?>"></div>
							<?php endif; ?>
							<?php if($description) : ?> 
								<div class="tile-inner desc text-center"> <?php echo $description; ?> </div>
							<?php endif; ?>
						</div> 	
						
					</div>


				<?php endwhile; ?>
			</div>
			<div class="row">
				<?php while ( have_rows( 'tiles_images' ) ): the_row();
						$image = get_sub_field('image');
						$description = get_sub_field('description');

					?>
					<div class="col-sm-12 col-md-6 mx-auto">
						<div class="card card-block h-100  align-items-center mx-auto">
							<?php if($image) : ?> 
								<div class="tile-inner"> <img src="<?php echo $image; ?>"></div>
							<?php endif; ?>
							<?php if($description) : ?> 
								<div class="tile-inner desc text-center"> <?php echo $description; ?> </div>
							<?php endif; ?>
						</div> 	
						
					</div>
				<?php endwhile; ?>
			</div>
			<div class="text-center mt-10 mb-6 intro"> <?php  echo $centered_text;?></div>
		</div>
	</section>
<?php endif; ?>