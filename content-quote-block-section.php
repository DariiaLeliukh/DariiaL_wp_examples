<?php 
			$quote = get_field('quote', 'option'); ?>
		
		<?php if($quote) : ?>
		<section class="full-section quote-block-section text-white">
			<div class="container">
				<div class="row">
						<div class="col-12 col-md-4 offset-md-2 my-auto">
							<?php if($quote['heading']): ?>
								<h2> <?php echo $quote['heading'] ; ?></h2>
							<?php endif; ?>
						</div>
						
					<div class="col-12 col-md-6 my-auto">
						<img src=" <?php echo get_site_url() . '/wp-content/uploads/2020/12/quote.png'; ?>" alt=""  class="image"/>

						<?php if($quote['text']): ?>
							<div class="mt-md-4 text-justify text"><?php echo $quote['text']; ?></div>
						<?php endif; ?>
						<?php if($quote['signature']): ?>
							<small class="text-sign"><?php echo $quote['signature']; ?></small>
						<?php endif; ?>
						

					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>