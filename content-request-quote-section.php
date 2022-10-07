<?php 
	$quote = get_field('request_a_quote', 'option'); ?>

<?php if($quote) : ?>
<section class="full-section request-section">
	<div class="container">
		<div class="row">
				<div class="col-12 col-md-5  my-auto">
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