<?php 
	$team = get_field('team', 'option'); ?>
 ?>
	<section class="featured-section full-section">
		<div class="container">
			<h2 class="text-center"> <?php echo $team['heading']; /*?> </h2>
			<div class="row align-content-center">
				<?php while ( have_rows( 'pages' ) ): the_row();
					$image = get_sub_field( 'image' );
					$icon = get_sub_field( 'icon' );
					$label = get_sub_field( 'label' );
					$text_on_hover = get_sub_field( 'text_on_hover' );
					$link = get_sub_field('link');
				?>
				<?php if (!empty( $image ) && $label && $link) ?>
				<div class="tile col-12 col-sm-6 col-md-4">
				  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"  class="image"/>
				  <?php 
			    		$link_url = $link['url'];
					    $link_title = $link['title'];
					    $link_target = $link['target'] ? $link['target'] : '_self';
					    ?>
					<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
					<div class="overlay">
				  	
					    <div class="text">
					    	<div class="row icon-label">
					    		<?php if( !empty( $icon ) ): ?>
						    		<img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" class="icon my-auto"/>
								<?php endif; ?>

					    		<div class="label"><?php echo $label; ?></div>
					    	</div>
					    	<div class="hidden">
						    	<?php if($text_on_hover) : ?>
						    		<div class="row hover-text">
						    			<?php echo $text_on_hover; ?>
						    		</div>
						    	<?php endif; ?>
						    	<div class="button">
		    							<img src=" <?php echo get_site_url() . '/wp-content/uploads/2020/12/arrow.png'; ?>" alt="">
		    							<?php echo esc_html( $link_title ); ?>
		    					</div>		
		    						
		    				</div>
					    </div>
				    </div>
					</a>
				</div>

			<?php endwhile; */?>
			</div>
		</div>
		
	</section>
<?php endif; ?>