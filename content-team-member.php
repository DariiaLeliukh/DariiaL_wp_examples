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
		$designations = get_post_meta($postid, "designations", true);
		$position = get_post_meta($postid, "position", true);
		$region = get_post_meta($postid, "region", true);

	?>
	
	<h1 class="entry-title"><?php echo the_title(); if($designations) echo ', <span>' . $designations . '</span>'; ?></h1>	
	<p class="subhead">
		<?php if($position)  echo $position; ?>
		<?php if($position && $region)  echo ', '; ?>
		<?php if($region)  echo $region; ?>
	</p>

	<div class="row">
		<div class="col-12 col-md-8 pr-md-5">
			<div class="entry-content">
				<?php
				the_content()
					
				?>
			</div><!-- .entry-content -->
		</div>
		<div class="col-12 col-md-4 sidebar">

			<?php $area_of_excellence = get_post_meta($postid, "area_of_excellence", true); ?>
			<?php if($area_of_excellence) :?>
				<div class="set">
					<div class="row">
						<h3>Areas of Excellence</h3>
					</div>
					<div class="row info">
						<?php $i = 1;
							foreach ( $area_of_excellence as $term ) {
							        echo get_term( $term )->name;;
							        echo ($i < count($area_of_excellence))? ", " : "";
							        $i++;
							}?>
					</div>
				</div>
			<?php endif; ?>

			<?php $industries_specialized_in = get_post_meta($postid, "industries_specialized_in", true); ?>
			<?php if($industries_specialized_in) :?>
				<div class="set">
					<div class="row">
						<h3>Industries Specializing In</h3>
					</div>
					<div class="row info">
						<?php $i = 1;
							foreach ( $industries_specialized_in as $term ) {
							        echo get_term( $term )->name;
							        echo ($i < count($industries_specialized_in))? ", " : "";
							        $i++;
							}?>
					</div>
				</div>
			<?php endif; ?>

			<div class="contact-info">
				<?php  
					$email = get_post_meta($postid, "email", true);
					$linkedin = get_post_meta($postid, "linkedin", true);
					$phonenumber = get_post_meta($postid, "phone-number", true);
                    $vcard = get_field('vcard', $postid);
					if($email || $linkedin || $phonenumber || $vcard) :
				?>

				<div class="row">
					<h3>Contact</h3>
				</div>
				<?php if($phonenumber) echo '<div class="row info">Phone:&nbsp;<a href="tel:' .  $phonenumber . '">' . $phonenumber . '</a></div>'; ?>
				<?php if($linkedin) echo '<div class="row info"><a href="' .  esc_url($linkedin) . '">LinkedIn</a></div>'; ?>
				<?php if($vcard) echo '<div class="row info"><a href="' .  $vcard . '">Virtual Business Card</a></div>'; ?>

				<?php if($email) echo '<div class="row info"><a href="mailto:' .  $email . '">Email</a></div>'; ?>
				
				<?php endif; ?>
			</div>
		</div>

</article><!-- #post-<?php the_ID(); ?> -->
<?php echo do_shortcode( '[requestquote]', $ignore_html = false ) ?>
