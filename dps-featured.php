<?php
/**
 * "Featured" layout for Display Posts Shortcode
 *
 * @package      StudyFinds2018
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/
?>
<div class="listing-item">
	<div class="row">
		<div class="col-md-3">
			<a href="<?php the_permalink(); ?>">
				<?php if (has_post_thumbnail()):?>
					<?php  the_post_thumbnail(); ?>
				<?php else: ?>
					<img src="<?php echo esc_url( home_url( '/' ) ) . '/wp-content/uploads/2020/12/logo.png'; ?> " alt="Defaul Image">
				<?php endif; ?>
			</a>
		</div>
		<div class="col-md-9">
			<a href="<?php the_permalink(); ?>">
				<h4 class="mega-block-title"> <?php the_title(); ?></h4>
			</a>
			<div class="excerpt"><?php the_excerpt(); ?> </div>
		</div>
	</div>
</div>

<?php
?>