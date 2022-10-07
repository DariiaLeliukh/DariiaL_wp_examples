<?php 
	$virtus_monthly = get_field('virtus_monthly', 'option'); ?>

<?php if(get_field('show_vm_block')) :?>
	<section class="full-section vm-section">
		<div class="container">
			
			<div class="row">
				<div class="col-12 col-md-5">
					<p class="h2"><?php echo $virtus_monthly['heading'] ;?></p>
					<p class="content">
						<?php echo $virtus_monthly['text'] ;?>
					</p>
					<?php  
						$var = do_shortcode( '[contact-form-7 id="253" title="Virtus Monthly"]' );
						echo $var;
					?>
				</div>
				<div class="col-12 col-md-6 offset-md-1">

					<?php
					    $recent_posts = wp_get_recent_posts(array(
					        'numberposts' => 1, // Number of recent posts thumbnails to display
					        'post_status' => 'publish' // Show only the published posts
					    ));
					    foreach($recent_posts as $post) : ?>
							<div class="tile">
								<?php if(!has_post_thumbnail( $post['ID'] )): ?>
						  			<img src="<?php echo esc_url($virtus_monthly['image']['url']); ?>" alt="<?php echo esc_attr($virtus_monthly['image']['alt']); ?>"  class="image"/>
					  			<?php else: ?>
					  				<?php echo get_the_post_thumbnail($post['ID']); ?>
					  			<?php endif; ?>
						  <?php 
					    		$link_url = get_permalink($post['ID']);
							    $link_title = $post['post_title'];
							    ?>
							<a href="<?php echo get_permalink($post['ID']) ?>">
							<div class="overlay">
						  	
							    <div class="text">
							    	<div class="row icon-label">
							    		<div class="label">
							    			<div class="row">
								    			<div class="col title"><?php echo $link_title; ?></div>
								    			<div class="col read-more">
								    					
					    								<span>Read More</span>
					    								<img style="vertical-align:middle" src=" <?php echo get_site_url() . '/wp-content/uploads/2020/12/arrow-icon-hover.png'; ?>" alt="">
								    			</div>
							    			</div>
							    		
							    		</div>
							    	</div>
							    	<div class="hidden">
								    	<div class="row hover-text">
							    			<?php echo get_the_excerpt($post['ID']) ; ?>
							    		</div>
				    				</div>
							    </div>
						    </div>
							</a>
						</div>
				<?php endforeach; wp_reset_query(); ?>
					<?php 
						/*
						if( !empty( $virtus_monthly['image']) ): ?>
						    <img src="<?php echo esc_url( $virtus_monthly['image']['url'] ); ?>" alt="<?php echo esc_attr( $virtus_monthly['image']['alt'] ); ?>" />
						<?php endif; */?>
				</div>
			</div>
			
		</div>
		
	</section>
<?php endif; ?> 