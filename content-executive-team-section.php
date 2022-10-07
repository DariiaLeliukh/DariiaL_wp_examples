<?php 
	$team = get_field( 'team' );
?>

<?php if ( $team ): ?>
	<section class="team">
		
			<div class="row">
				<?php if ( have_rows( 'team' ) ): ?>
						<?php while ( have_rows( 'team' ) ): the_row();
								$name = get_sub_field( 'name' );
								$title = get_sub_field('title');
								$image = get_sub_field('image');
							?>
							<div class="col-sm-6 col-md-4 col-lg-3">
								<?php if ( $name && $image): ?>
							    	<img src="<?php echo $image; ?>"/>
							    	<p class="name"><?php echo $name;?></p>
							    	<p class="title"><?php echo $title;?></p>
								<?php endif; ?>
							</div>
							
						<?php endwhile; ?>
				<?php endif ?>
			</div>
		
	</section>
<?php endif; ?>