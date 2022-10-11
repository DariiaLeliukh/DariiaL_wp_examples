<?php 

add_action('wp_ajax_nopriv_filter', 'filter_ajax');
add_action('wp_ajax_filter', 'filter_ajax');

function filter_ajax(){
    
    $category = $_POST['category'];    

    if(!empty($category)){
       $args = array(
        'post_type' => 'faqs',
        'tax_query' => array(
            array(
                'taxonomy' => 'faqs-categories',
                'terms' => array($category),
            ),
        ),
        'posts_per_page' => -1
        );
    }
    else $args = array(
        'post_type' => 'faqs',
        'posts_per_page' => -1
        );
        
    $query = new WP_Query($args);

    $counter = 1;
    
    if($query->have_posts()):
        while($query->have_posts()): $query->the_post(); ?>
            <?php $count = $counter++;?>

                            
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
        <?php endwhile;
    else: echo 'No files found for this size and brand';    
    endif;
    wp_reset_postdata();
    
    
    
    die();
}