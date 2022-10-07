<?php 
	$files_section_title = get_field( 'files_section_title' );
	$list_of_files = get_field( 'list_of_files' );
	$picture_for_files = get_field( 'picture_for_files' );
?>

<?php if ( $list_of_files ): ?>
	<section class="list-of-files">
		<?php if($files_section_title) : ?>
			<div class="files-section-title text-center"> <?php echo $files_section_title; ?> </div>
		<?php endif; ?>
			<div class="row">
				<?php if ( have_rows( 'list_of_files' ) ): ?>
						<?php while ( have_rows( 'list_of_files' ) ): the_row();
								$file = get_sub_field('file');
							?>
							<div class="file col-sm-12 col-lg-6">
								<?php if ( $file): ?>
                                    <a href="<?php echo $file['url']; ?>" target="_blank" title="<?php echo $file['title'];?>">
                                    	<div class="row">
                                    		<div class="file-image col-2">
                                    			<img src="<?php echo $picture_for_files;?>" alt="file-icon"/>
                                    		</div>
                                    		<div class="col-10 my-auto">
                                    			<?php echo $file['title']; ?>
                                    		</div>

                                    	</div>
                                        

                                    </a>                                
								<?php endif; ?>
							</div>
							
						<?php endwhile; ?>
				<?php endif ?>
			</div>
		
	</section>
<?php endif; ?>