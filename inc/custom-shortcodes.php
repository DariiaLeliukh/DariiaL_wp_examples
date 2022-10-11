<?php 
function newsletter_custom_shortcode() { 
 
ob_start();
	?>
	<?php
	
	$virtus_monthly = get_field('virtus_monthly', 'option'); ?>


	<section class='full-section vm-section'>
		<div class='container'>
			
			<div class='row'>
				<div class='col-12 col-lg-5'>
                    <p class="h2"><?php echo $virtus_monthly['heading'] ;?></p>
					<p class='content'>
						<?php echo $virtus_monthly['text'] ;?>
					</p>
					<?php  
						/*$var = do_shortcode( '[contact-form-7 id="253" title="Virtus Monthly"]' );
						echo $var;*/
					?>
                    <!-- Begin Constant Contact Inline Form Code -->
                    <div class="ctct-inline-form" data-form-id="cc0b85a1-fb3e-43d0-b9cf-a65bd0fbb936"></div>
                    <!-- End Constant Contact Inline Form Code -->
				</div>
				<div class='col-12 col-lg-6 offset-lg-1'>

					<?php
					    $recent_posts = wp_get_recent_posts(array(
					        'numberposts' => 1, // Number of recent posts thumbnails to display
					        'post_status' => 'publish' // Show only the published posts
					    ));
					    foreach($recent_posts as $post) : ?>
							<div class='tile'>
								<?php if(!has_post_thumbnail( $post['ID'] )): ?>
						  			<img src='<?php echo esc_url($virtus_monthly['image']['url']); ?>' alt='<?php echo esc_attr($virtus_monthly['image']['alt']); ?>'  class='image'/>
					  			<?php else: ?>
					  				<?php echo get_the_post_thumbnail($post['ID']); ?>
					  			<?php endif; ?>
						  <?php 
					    		$link_url = get_permalink($post['ID']);
							    $link_title = get_the_title($post['ID']);/*$post['post_title'];*/
							    ?>
							<a href='<?php echo get_permalink($post['ID']) ?>'>
							<div class='overlay'>
						  	
							    <div class='text'>
							    	<div class='row icon-label'>
							    		<div class='label'>
							    			<div class='row'>
								    			<div class='col col-7 title'>
								    				<?php echo mb_strimwidth($link_title, 0, 50, '...');;?> 
								    			</div>
								    			<div class='col read-more'>
								    					
					    								<span>Read More</span>
					    								<img style='vertical-align:middle' src=' <?php echo get_site_url() . '/wp-content/uploads/2020/12/arrow-icon-hover.png'; ?>' alt=''>
								    			</div>
							    			</div>
							    		
							    		</div>
							    	</div>
							    	<div class='hidden'>
								    	<div class='row hover-text'>
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
						    <img src='<?php echo esc_url( $virtus_monthly['image']['url'] ); ?>' alt='<?php echo esc_attr( $virtus_monthly['image']['alt'] ); ?>' />
						<?php endif; */?>
				</div>
			</div>
			
		</div>
		
	</section>

	<?php
	return ob_get_clean();

} 
// register shortcode
add_shortcode('virtusmonthly', 'newsletter_custom_shortcode'); 

function showQuote_custom_shortcode() {
ob_start();
	?>
	<?php
        $include_testimonial = get_field('include_testimonial');
        $testimonial_heading = get_field('testimonial_heading');
        $testimonial_text = get_field('testimonial_text');
        $testimonial_signature = get_field('testimonial_signature');
        ?>

		<?php if($include_testimonial) : ?>
		<section class="full-section quote-block-section text-white">
			<div class="container">
				<div class="row">
						<div class="col-12 col-md-4 offset-md-2 my-auto">
							<?php if($testimonial_heading): ?>
								<h2> <?php echo $testimonial_heading ; ?></h2>
							<?php endif; ?>
						</div>
						
					<div class="col-12 col-md-6 my-auto">
						<img src=" <?php echo get_site_url() . '/wp-content/uploads/2020/12/quote.png'; ?>" alt=""  class="image"/>

						<?php if($testimonial_text): ?>
							<div class="mt-md-4 text-justify text"><?php echo $testimonial_text; ?>"</div>
						<?php endif; ?>
						<?php if($testimonial_signature): ?>
							<small class="text-sign"><?php echo $testimonial_signature; ?></small>
						<?php endif; ?>
						

					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>
	<?php
	return ob_get_clean();
}
add_shortcode('showquote', 'showQuote_custom_shortcode'); 

function requestQuote_custom_shortcode() {
ob_start();
	?>
	<?php 
			$quote = get_field('request_a_quote', 'option'); ?>
		
		<?php if($quote) : ?>
		<section class="full-section request-section">
			<div class="container">
				<div class="row">
						<div class="col-12 col-md-5  my-auto pb-4 pb-md-0">
							<?php if($quote['heading']): ?>
								<h2> <?php echo $quote['heading'] ; ?></h2>
							<?php endif; ?>
							<?php if($quote['text']): ?>
							<div class="mt-md-4 text-justify text"><?php echo $quote['text']; ?></div>
						<?php endif; ?>
						</div>
						
					<div class="col-12 col-md-6 offset-md-1 my-auto">
					<?php echo do_shortcode( '[contact-form-7 id="351" title="Request a Quote"]', $ignore_html = false ) ?>

					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>
	<?php
	return ob_get_clean();
}
add_shortcode('requestquote', 'requestQuote_custom_shortcode'); 


function teamblock_custom_shortcode() {
ob_start();
	?>
	<?php 
		global $wp_query;
		$postid = $wp_query->post->ID;
		$show_team_block = get_post_meta($postid, "show_team_block", true);
		$terms1 = get_field('area_of_excellence', $postid);
		$terms2 = get_post_meta($postid, "industry", true);
		$heading = get_post_meta($postid, "heading", true);


		if($show_team_block) :
		
			$team = get_field('team', 'option'); ?>



			<?php 
                $posts = get_posts(array(
                	'post_type'			=> 'team-member',
                	'post_status'       => 'publish',
                	'orderby'           => 'menu_order',
                	'tax_query' => array(
                        'relation'		=> 'OR',
			            array(
			                'taxonomy' => 'areas_of_excellence',
			                'terms' => $terms1,
			            ),
                        array(
                            'taxonomy' => 'industry_expertise',
                            'terms' => $terms2,
                        ),
			        ),
                	'posts_per_page'	=> -1
                	
                ));
                if( $posts ): ?>
            <h2 class="text-center team-block-section"> <?php echo $heading; ?> </h2>
			<!-- <div class="row align-content-center"> -->
				<section class="team-block-section">
					<div class="container team-page">
						<div class="row">
					<?php foreach( $posts as $p) :?>
						<div class="tile col-12 col-sm-6 col-md-4 mx-auto">
							<?php 
								$image = get_field('image', $p->ID);
								if( !empty( $image ) ): ?>
								    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="image"/>
								<?php endif; ?>
							 <?php $link = get_permalink( $p->ID);?>
							<a href="<?php echo esc_url( $link ); ?>" target="_self">
								<div class="overlay card-group">
							  	
								    <div class="text card">
								    	<div class="row icon-label card-body">
								    		<div class="label">
								    			<p class="name"><?php echo get_field('full_name', $p->ID) ;?></p>
								    			<p class="position"><?php echo get_field('position', $p->ID) ;?></p>
								    			<?php if (get_field('phone-number', $p->ID)): ?>
								    				<div class="phone">
								    					
							    							<img src="<?php echo get_site_url() . '/wp-content/uploads/2021/01/phone.png'; ?>" alt="" class="phone-icon">
							    							<span><?php echo get_field('phone-number', $p->ID) ;?></span>
								    					
								    				</div>
								    			<?php endif ?>
								    		</div>
								    	</div>
								    	<div class="hidden">
									    	<div class="button card-footer">
					    							<img src=" <?php echo get_site_url() . '/wp-content/uploads/2020/12/arrow-icon-hover.png'; ?>" alt="">
					    							<span>View Bio</span>
					    					</div>		
					    						
					    				</div>
								    </div>
							    </div>
							</a>
						</div>
					<?php endforeach; ?>
						</div>
					</div>
				</section>
				<?php endif;?>



			<!-- </div> -->
		<?php endif; ?>
		
	<?php
	return ob_get_clean();
}
add_shortcode('showteam', 'teamblock_custom_shortcode'); 

function features_custom_shortcode() {
ob_start();
	?>
	<?php 
		global $wp_query;
		$postid = $wp_query->post->ID;
		$show_features_block = get_post_meta($postid, "show_features_block", true);
		$heading_for_features = get_post_meta($postid, "heading_for_features", true);
		$image = get_post_meta($postid, "image", true);
		$content = get_post_meta($postid, "content", true);

		if($show_features_block) : ?>

			<section class="features-content-section full-section" style="<?php echo 'background-image: url(' . get_site_url() . '/wp-content/uploads/2020/12/Line-Art-2.png'; ?>">
				<div class="inner-holder">
					<div class="container">
						<div class="row heading">
							<h2><?php echo $heading_for_features; ?></h2>
						</div>
						<div class="row">
							<div class="col-sm-12 col-lg-6 image-center my-auto">
								<?php 
									if( !empty( $image ) ): ?>
									    <?php echo wp_get_attachment_image( $image, 'full' ); ?> 
									<?php endif; ?>
							</div> 
							<div class="col-sm-12 col-lg-5 my-auto offset-lg-1 ">
								<div class="content">
									<?php echo $content; ?>
								</div>
							</div> 
						</div>
						
					</div>
				</div>
				
			</section>

		<?php endif;

	
	return ob_get_clean();
}
add_shortcode('showfeatures', 'features_custom_shortcode');

function custom_searchform( $form ) {
 
    $form = '<form class="popup-search" role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input type="text" value="'. get_search_query() . '" name="s" id="s" placeholder="Enter your search..."/>
    </div>
    </form>';
 
    return $form;
}
 
add_shortcode('searchform', 'custom_searchform');
