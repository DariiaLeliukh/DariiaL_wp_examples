<?php 
	$questions_section_title = get_field( 'questions_section_title' );
	$questions_list = get_field( 'questions_list' );
	$counter = 1;
?>

<?php if ( $questions_section_title || $questions_list ): ?>
	<section class="questions-section my-5" id="accordion">
		<div class="container">
			<?php if ( $questions_section_title ): ?>
				<p class="h2"><?php echo $questions_section_title; ?></p>
			<?php endif; ?>

			<?php if ( $questions_list ): ?>
				<div class="faqs">
					
					<?php foreach( $questions_list as $p ): ?>
						<?php $count = $counter++;?>

						    <div class='container'>
							    <div class='item-heading'>
							      
							      <a data-toggle='collapse' data-parent='#accordion' href='#collapse<?php echo $count;?>'>
							        <div class='row'>
							            <div class='item-title'>
							               <p><?php echo get_the_title( $p->ID ); ?></p>
                                    
							            </div>
							            <div><span class='dashicons dashicons-arrow-down-alt2'></span></div>
							        </div>
    								</a>
	    							<div id='collapse<?php echo $count;?>' class='panel-collapse collapse'>
									    <div class='item-body'>
									      <?php echo the_field('answer', $p->ID); ?>
									    </div>
									</div>
								</div>
							</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>