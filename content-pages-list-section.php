<?php 

if(have_rows('repeater')) :?>
	<section class="full-section pages-list">
		<div class="container">
			<div class="row">
				<?php while( have_rows('repeater') ) : the_row();

		        // Load sub field value.
		        $icon = get_sub_field('icon');
		        $top_page = get_sub_field('top_page');?>
		        <div class="col-12 col-sm-6 col-md-4 d-flex align-content-start flex-wrap list">
		        	<div class="container">
		        		<div class="row">
		        			<?php 
							if( !empty( $icon ) ): ?>
							    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
							<?php endif; ?>
		        		</div>
			        	
						<?php if($top_page) : 
							$link_url = $top_page['url'];
						    $link_title = $top_page['title'];
						    $link_target = $top_page['target'] ? $top_page['target'] : '_self';
						    ?>
						    <div class="top-level">
						    <a class="top-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
						    	<?php echo esc_html( $link_title ); ?>
						    </a>
							</div>
						<?php endif; ?>
			        

				        <?php 
				        if( have_rows('sub_links') ): ?>
				        	<ul class="sub-pages">
				        	<?php
				        	while( have_rows('sub_links') ) : the_row();

				                
				                $link = get_sub_field('link');
				                if( $link ): 
								    $link_url = $link['url'];
								    $link_title = $link['title'];
								    $link_target = $link['target'] ? $link['target'] : '_self';
								    ?>
								    <li><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></li>
								<?php endif; ?>

				            <?php endwhile;?>
				            </ul>
				        
				        <?php endif;?>		
		        	</div>
		        	
			    </div>
			    <?php endwhile;?>
			</div>
		</div>
	</section>
<?php endif; ?>