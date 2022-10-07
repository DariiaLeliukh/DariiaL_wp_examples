<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package virtusgroup
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		global $wp_query;
		$postid = $wp_query->post->ID;
		/*$city = get_post_meta($postid, "city", true);*/
		$city = get_field('city');
		$province = get_field('province');
		$type_of_the_event = get_field('type_of_the_event');
		

		if($city && $province) $location = get_term( $city )->name . ', ' . get_term( $province )->name;
		elseif($city && !$province) $location = get_term( $city )->name;
		elseif(!$city && $province) $location = get_term( $province )->name;

	?>
	<div class="row">
		<div class="col-12 col-md-8">
			<h1 class="entry-title"><?php echo the_title(); ?></h1>	
		</div>
	</div>
	

	<div class="row">
		<div class="col-12 col-md-8 pr-5">
			<div class="entry-content">
				<?php
				the_content()
					
				?>
			</div><!-- .entry-content -->
		</div>
		<div class="col-12 col-md-4 sidebar">

			<?php if($location) :?>
				<div class="set">
					<div class="row">
						<h3>Location</h3>
					</div>
					<div class="row info">
						<?php echo $location; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if($type_of_the_event) :?>
				<div class="set">
					<div class="row">
						<h3>Event Type</h3>
					</div>
					<div class="row info">
						<?php echo $type_of_the_event; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php $dates = get_field('dates');

			if( have_rows('dates') ): ?>
				<div class="set">
					<div class="row">
						<h3>Dates</h3>
					</div>
				    <?php while( have_rows('dates') ) : the_row();
				        $date = get_sub_field('date');?>
				        <div class="info date">
				        	<div class="row day"><?php echo $date . ' '; ?></div>
				        	<?php 
				        		if( have_rows('start_end_times') ):
						            while( have_rows('start_end_times') ) : the_row();
						                $start_time = get_sub_field('start_time');
						                $end_time = get_sub_field('end_time');?>

						                <div class="row times">
						                	<?php if($start_time) echo ' from ' . $start_time; ?>
						                	<?php if($end_time) echo ' to ' . $end_time; ?>
						                </div>
						            <?php endwhile;
						        endif;

				        	 ?>	
				        </div>
				    <?php endwhile;?>
			    </div>
			<?php endif;?>

		</div>

</article><!-- #post-<?php the_ID(); ?> -->
