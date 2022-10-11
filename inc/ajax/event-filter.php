<?php

function filter_locations() {

    $location = $_POST['location'];

    if(!($location == -1)){
    	$args = array(
	        'post_type'         => 'event',
	        'posts_per_page'    => -1,
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'cities',
	                'terms' => array($location),
	            ),
	           
	        ),
	    );
    }
    if($location == -1){
    	$args = array(
	        'post_type'         => 'event',
	        'posts_per_page'    => -1,
	    );
    }
    

    $posts = get_posts($args); 

    if( $posts ) :?>

    	<?php $count=1; foreach( $posts as $p) :

    		$title = get_the_title($p->ID);
    		$short_info = get_field('short_info', $p->ID);
    		$type_of_the_event = get_field('type_of_the_event', $p->ID);
    		$city = get_field('city', $p->ID);
    		$province = get_field('province', $p->ID);
    		$dates = get_field('dates', $p->ID);
    		$link = get_permalink( $p->ID);

    		if($city && $province) $location = get_term( $city )->name . ', ' . get_term( $province )->name;
    		elseif($city && !$province) $location = get_term( $city )->name;
    		elseif(!$city && $province) $location = get_term( $province )->name;
    		?>
    		<?php if(($count%2) == 1) : ?>
				<div class="row card-group">
			<?php endif; ?>

			<div class="col-12 col-lg-6 card">
			    <div class="card-body">
			      <h5 class="card-title"><?php echo $title; ?></h5>
			      <p class="subhead">
			      	<?php if($type_of_the_event) echo $type_of_the_event; ?>
			      	<?php if($type_of_the_event && $dates) echo ' - '; ?>
			      	<?php if($dates) :?>
			      		<?php $i = 1; foreach ($dates as $date) :?>
			      			<?php echo $date['date']; 
			      			echo ($i < count($dates))? "; " : "";
	        				$i++;?>
			      		<?php endforeach; ?>
			      	<?php endif; ?>
			      	<?php if($dates && $city) echo ' - '; ?>
			      	<?php if($location) echo $location ?>

			      </p>
			      <p class="card-text"><?php echo $short_info; ?></p>
			    </div>
			    <div class="card-footer">
					<a class="btn button primary-button btn-lg" href="<?php echo esc_url( $link); ?>" target="_self">Event Details</a>
				</div>
			  </div>
			  <?php if(($count%2) == 0) : ?>
				</div>
			<?php endif;?><?php $count++;?>
		<?php endforeach; ?>

	<?php endif; 

    die();
}
