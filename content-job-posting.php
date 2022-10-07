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
        $location = get_field('job_location', $postid)->name;
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




		</div>

</article><!-- #post-<?php the_ID(); ?> -->
<?php echo do_shortcode( '[requestquote]', $ignore_html = false ) ?>
