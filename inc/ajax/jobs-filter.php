<?php

function job_filter_locations() {

    $location = $_POST['location'];

    if(!($location == -1)){
        $args = array(
            'post_type'         => 'job-posting',
            'posts_per_page'    => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'joblocations',
                    'terms' => array($location),
                ),

            ),
        );
    }
    if($location == -1){
        $args = array(
            'post_type'         => 'job-posting',
            'posts_per_page'    => -1,
        );
    }


    $posts = get_posts($args);

    if( $posts ) :?>
        <div id="loading">
            <p><img src="<?php echo get_site_url() . '/wp-content/uploads/2021/01/ajax-loader.gif'; ?>" /> Please Wait</p>
        </div>
        <?php $count=1; foreach( $posts as $p) :

            $title = get_the_title($p->ID);
            $short_info = get_field('short_info', $p->ID);
            $location = get_field('job_location', $p->ID)->name;
            $link = get_permalink( $p->ID);

            ?>
            <?php if(($count%2) == 1) : ?>
            <div class="row card-group">
        <?php endif; ?>

            <div class="col-12 col-lg-6 card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $title; ?></h5>
                    <p class="subhead">
                        <?php if($location) echo $location ?>
                    </p>
                    <p class="card-text"><?php echo $short_info; ?></p>
                </div>
                <div class="card-footer">
                    <a class="btn button primary-button btn-lg" href="<?php echo esc_url( $link); ?>" target="_self">Job Details</a>
                </div>
            </div>
            <?php if(($count%2) == 0) : ?>
            </div>
        <?php endif;?><?php $count++;?>
        <?php endforeach; ?>

    <?php endif;

    die();
}
