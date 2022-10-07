<?php if ( have_rows( 'events' ) ): $counter=true; ?>
	<section class="events-selection">
		<?php while ( have_rows( 'events' ) ): the_row();
			$image = get_sub_field( 'image' );
			$title = get_sub_field( 'title' );
			$short_info = get_sub_field( 'short_info' );
			$link = get_sub_field( 'link' );
			?>
			<div class="row event mb-7 pb-7">
				<!-- Image on the left-->
				<?php if($counter) : ?>
					<div class="col-sm-12 col-lg-6 my-auto image-center">
						<img src="<?php echo $image;?>">
					</div>
				<?php endif;?>

				<div class="col-sm-12 col-lg-6 my-auto">
					<p class="title"> <?php echo $title; ?> </p>
					<p class="short-info"> <?php echo $short_info; ?> </p>
					<div class="button">
						<button class="btn btn-custom">
							<a href="<?php echo $link; ?>">
								<p class="white-text">Read More</p>
							</a>
						</button>
					</div>
				</div>

				<!-- Image on the right-->
				<?php if(!$counter) : ?>
					<div class="col-sm-12 col-lg-6 my-auto image-center">
						<img src="<?php echo $image;?>">
					</div>
				<?php endif;?>
			</div>
			<?php ($counter)? $counter=false : $counter=true; ?>

		<?php endwhile; ?>
	</section>
<?php endif; ?>