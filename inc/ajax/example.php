<?php 

    add_action('wp_ajax_nopriv_filter', 'filter_ajax');
    add_action('wp_ajax_filter', 'filter_ajax');

    function filter_ajax(){

        $area = $_POST['area']; 
        $industries = $_POST['industries']; 
        $locations = $_POST['locations']; 
        

        // 0 0 0
        if(empty($area) && empty($industries) && empty($locations) ){
           $args = array(
            'post_type' => 'team-member',
            'posts_per_page' => -1,
            );
        }

        // 1 0 0
        if(!empty($area) && empty($industries) && empty($locations) ){
           $args = array(
            'post_type' => 'team-member',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'areas_of_excellence',
                    'terms' => array($area),
                ),
               
            ),

            );
        }
        // 1 1 1
        if(!empty($area) && !empty($industries) && !empty($locations) ){
           $args = array(
            'post_type' => 'team-member',
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'areas_of_excellence',
                    'terms' => array($area),
                ),
                array(
                    'taxonomy' => 'industry_expertise',
                    'terms' => array($industries),
                ),
                array(
                    'taxonomy' => 'locations',
                    'terms' => array($locations),
                ),
            ),

            );
        }
        // 1 1 0
        if(!empty($area) && !empty($industries) && empty($locations) ){
           $args = array(
            'post_type' => 'team-member',
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'areas_of_excellence',
                    'terms' => array($area),
                ),
                array(
                    'taxonomy' => 'industry_expertise',
                    'terms' => array($industries),
                ),
            ),

            );
        }

        // 1 0 1
        if(!empty($area) && empty($industries) && !empty($locations) ){
           $args = array(
            'post_type' => 'team-member',
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'areas_of_excellence',
                    'terms' => array($area),
                ),
                array(
                    'taxonomy' => 'locations',
                    'terms' => array($locations),
                ),
            ),

            );
        }
        // 0 1 1
        if(empty($area) && !empty($industries) && !empty($locations) ){
           $args = array(
            'post_type' => 'team-member',
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'industry_expertise',
                    'terms' => array($industries),
                ),
                array(
                    'taxonomy' => 'locations',
                    'terms' => array($locations),
                ),
            ),

            );
        }
        // 0 1 0
        if(empty($area) && !empty($industries) && empty($locations) ){
           $args = array(
            'post_type' => 'team-member',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'industry_expertise',
                    'terms' => array($industries),
                ),
            ),

            );
        }
        // 0 0 1
        if(empty($area) && empty($industries) && !empty($locations) ){
           $args = array(
            'post_type' => 'team-member',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'locations',
                    'terms' => array($locations),
                ),
            ),

            );
        }
       
            
       $posts = get_posts($args);

        
        if( $posts ) :?>
        <div id="loading">
            <p><img src="<?php echo get_site_url() . '/wp-content/uploads/2021/01/ajax-loader.gif'; ?>" /> Please Wait</p>
        </div>
        <div class="row">
            <?php foreach( $posts as $p): // variable must NOT be called $post (IMPORTANT) 
                $image = get_field('image', $p->ID);
                $url = get_permalink( $p->ID );
                $name = get_field('full_name', $p->ID);
            ?>

            <div class="tile col-12 col-sm-6 col-md-4 mx-auto">
                <?php 
                    $image = get_field('image', $p->ID);
                    if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="image"/>
                    <?php else: ?>
                        <img src='<?php echo esc_url($virtus_monthly['image']['url']); ?>' alt='<?php echo esc_attr($virtus_monthly['image']['alt']); ?>'  class='image'/>
                    <?php endif; ?>
            
                <a href="<?php echo esc_url($url);?>" target="_self">
                    <div class="overlay card-group">
                    
                        <div class="text card">
                            <div class="row icon-label card-body">
                                <div class="label container">
                                    <p class="name"><?php echo get_field('full_name', $p->ID) ;?></p>
                                    <p class="position"><?php echo get_field('position', $p->ID) ;?></p>
                                    <?php if (get_field('phone-number', $p->ID)): ?>
                                        <div class="phone row"><i class="fa fa-phone my-auto"></i>
                                            <span class="my-auto">
                                                <?php echo get_field('phone-number', $p->ID) ;?>
                                            </span>
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
        
            
        <?php else: echo 'No team members were found. Try applying different filters';    
        endif;
        wp_reset_postdata();
        
        
        
        die();

    }

    

