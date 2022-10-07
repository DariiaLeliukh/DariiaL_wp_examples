<?php 
	$section_title = get_field( 'section_title' );
	$link_under_section = get_field( 'link_under_section' );
?>

<section class="py-10 full-section news-selection-section">
	<div class="container">
			<?php if ( $section_title ): ?>
				<h2 class="text-center"><?php echo $section_title; ?></h2>
			<?php endif; ?>

			<?php if ( have_rows( 'news_categories' ) ): ?>
				<div class="row py-5">
					<?php while ( have_rows( 'news_categories' ) ): the_row();
							$category = get_sub_field( 'category' );
							$image = get_sub_field('image');
						?>
						<?php if ($category) : ?>
							<?php
								$the_query = new WP_Query(
									array(
										'cat' => $category->term_id, 
										'posts_per_page' => '1', 
									));
								 ?>

							<div class="col-12 col-sm-6 col-lg-4 mx-auto py-2">
								<div class="news-category mx-auto">
									<?php if ($image) :?>
										<img src="<?php echo $image?>"/>
									<?php endif;?>
									<p class="category">
										<a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
											<?php echo esc_html( $category->name ); ?>
										</a>
									</p>
									<?php if ( $the_query->have_posts() ) : ?>
									  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
									  	<p class="title"><?php the_title(); ?></p>
									  	<p class="date"><?php the_date(); ?></p>
									    <p class="excerpt"><?php echo excerpt(35); ?></p>
									    <button class="btn btn-custom color0082c6">
									    	<a href="<?php the_permalink(); ?>">
									    		<p class="white-text">Read More</p>
										    </a>
										</button>
									  <?php endwhile; ?>
									  <?php wp_reset_postdata(); ?>
									<?php endif; ?>
																		
								</div>
							</div>

						<?php endif;?>
					<?php endwhile; ?>
				</div>
				<?php if($link_under_section) : 
					$link_url = $link_under_section['url'];
				    $link_title = $link_under_section['title'];
				    ?>
					<div class="row">
						<div class="text-center mx-auto"><a href="<?php echo esc_url($link_url)?>"><?php echo esc_html($link_title); ?></a></div>
						
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
</section>