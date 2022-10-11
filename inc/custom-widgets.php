<?php

/**
 * Custom Layout for Recent_Posts widget class
 *
 * @since 2.8.0
 */
class custom_recent_posts extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'widget_recent_vm_news', 
            'description' => __( "The most recent posts on your site") 
        );
        parent::__construct('recent-vm-news', __('Latest Insights'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest Insights' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
        if ( ! $number )
            $number = 10;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) :
?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <ul>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            
            <!-- custom layout -->

            <div class='tile'>

                <?php $virtus_monthly = get_field('virtus_monthly', 'option'); ?>
                                <?php if(!has_post_thumbnail() ): ?>
                                    <img src='<?php echo esc_url($virtus_monthly['image']['url']); ?>' alt='<?php echo esc_attr($virtus_monthly['image']['alt']); ?>'  class='image'/>
                                <?php else: ?>
                                    <?php echo get_the_post_thumbnail(); ?>
                                <?php endif; ?>
                          <?php 
                                $link_url = get_permalink();
                                $link_title = get_the_title();
                                ?>
                            <a href='<?php echo get_permalink( get_the_ID() ) ?>'>
                            <div class='overlay'>
                            
                                <div class='text'>
                                    <div class='row icon-label'>
                                        <div class='label container'>
                                            <div class='row'>
                                                <div class='col-8 title my-auto'><?php echo $link_title; ?></div>
                                                <div class='col-4 read-more'>
                                                        
                                                        <span>Read More</span>
                                                        <img src=' <?php echo get_site_url() . '/wp-content/uploads/2020/12/arrow-icon-hover.png'; ?>' alt=''>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class='hidden'>
                                        <div class='row hover-text'>
                                            <?php echo get_the_excerpt() ;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>


            <!-- custom layout -->
        <?php endwhile; ?>
        </ul>
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = (bool) $new_instance['show_date'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_recent_posts', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
    }
}


/**
 * Custom Author widget class
 *
 * @since 2.8.0
 */
class custom_author extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'widget_custom_author', 
            'description' => __( "The author from Team Members") 
        );
        parent::__construct('custom-author', __('Custom Author'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_custom_author', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Author' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        

        /*$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) : $r->the_post();*/

        global $wp_query;
        $postid = $wp_query->post->ID;
        $custom_author = get_post_meta($postid, "custom_author", true);
        $image = get_field('image', $custom_author);
        $virtus_monthly = get_field('virtus_monthly', 'option');
        if(!empty($custom_author)) :
?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        
        
            
            <!-- custom layout -->
        <div class="container">
            <div class="row">
                <div class='tile'>

                    <?php 
                        
                    ?>
                        <?php if(!empty($image) ): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php else: ?>
                            <img src='<?php echo esc_url($virtus_monthly['image']['url']); ?>' alt='<?php echo esc_attr($virtus_monthly['image']['alt']); ?>'  class='image'/>
                        <?php endif; ?>
                  <?php 
                        $link_url = get_permalink();
                        $link_title = get_the_title();
                        ?>
                    <a href='<?php echo get_permalink( $custom_author ) ?>'>
                        <div class="overlay card-group">
                            <div class="text card">
                                <div class="row icon-label card-body">
                                    <div class="label">
                                        <p class="name"><?php echo get_field('full_name', $custom_author) ;?></p>
                                        <p class="position"><?php echo get_field('position', $custom_author) ;?>, <?php echo get_field('region', $custom_author) ;?></p>
                                    </div>
                                </div>
                                <div class="hidden card-footer">
                                    <div class="button">
                                            <img src=" <?php echo get_site_url() . '/wp-content/uploads/2020/12/arrow-icon-hover.png'; ?>" alt="">
                                            <span>View Bio</span>
                                    </div>      
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php echo $after_widget; ?>

            <!-- custom layout -->
        <?php endif; /*endwhile;*/ ?>
        
        
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_custom_author', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_custom_author', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        
<?php
    }
}


/**
 * Custom CTA widget class
 *
 * @since 2.8.0
 */
class contact_cta extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'widget_contact_cta', 
            'description' => __( "The CTA for the sidebar") 
        );
        parent::__construct('custom-cta', __('Contact Us CTA'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_contact_cta', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $heading = ( ! empty( $instance['heading'] ) ) ? $instance['heading'] : __( 'Get in Touch With Us' );
        $heading = apply_filters( 'widget_title', $heading, $instance, $this->id_base );

        $subhead = ( ! empty( $instance['subhead'] ) ) ? $instance['subhead'] : __( '' );
        $cta_text = ( ! empty( $instance['cta_text'] ) ) ? $instance['cta_text'] : __( 'Contact Us' );
        $cta_link = ( ! empty( $instance['cta_link'] ) ) ? $instance['cta_link'] : __( '/contact-us/' );
        
        if ($heading) :
?>
        <?php echo $before_widget; ?>
        <?php if ( $heading ) echo $before_title . $heading . $after_title; ?>
        <?php if ( $subhead ) echo '<div class="subhead">'. $subhead . '</div>'; ?>
        <?php if($cta_text || $cta_link) : ?>
            <!-- custom layout -->
            <a href="<?php echo home_url( '' ) . $cta_link ?>" class="btn button primary-button btn-lg">
                <?php echo $cta_text?>
            </a>



            <!-- custom layout -->
        <?php endif; ?>
        
       
            
            

        
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_contact_cta', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['heading'] = strip_tags($new_instance['heading']);
        $instance['subhead'] = strip_tags($new_instance['subhead']);
        $instance['cta_text'] = strip_tags($new_instance['cta_text']);
        $instance['cta_link'] = strip_tags($new_instance['cta_link']);
        
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_contact_cta', 'widget');
    }

    function form( $instance ) {
        $heading     = isset( $instance['heading'] ) ? esc_attr( $instance['heading'] ) : '';
        $subhead     = isset( $instance['subhead'] ) ? esc_attr( $instance['subhead'] ) : '';
        $cta_text     = isset( $instance['cta_text'] ) ? esc_attr( $instance['cta_text'] ) : '';
        $cta_link     = isset( $instance['cta_link'] ) ? esc_attr( $instance['cta_link'] ) : '';
        
?>
        <p><label for="<?php echo $this->get_field_id( 'heading' ); ?>"><?php _e( 'Heading:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'heading' ); ?>" name="<?php echo $this->get_field_name( 'heading' ); ?>" type="text" value="<?php echo $heading; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'subhead' ); ?>"><?php _e( 'Subhead:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'subhead' ); ?>" name="<?php echo $this->get_field_name( 'subhead' ); ?>" type="text" value="<?php echo $subhead; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'cta_text' ); ?>"><?php _e( 'Text for button:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'cta_text' ); ?>" name="<?php echo $this->get_field_name( 'cta_text' ); ?>" type="text" value="<?php echo $cta_text; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'cta_link' ); ?>"><?php _e( 'URL for button:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'cta_link' ); ?>" name="<?php echo $this->get_field_name( 'cta_link' ); ?>" type="text" value="<?php echo $cta_link; ?>" /></p>

        
<?php
    }
}
/**
 * Custom Layout for Related Posts by category widget class
 *
 * @since 2.8.0
 */
class custom_related_posts extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'widget_related_posts',
            'description' => __( "The most related posts for the blog article")
        );
        parent::__construct('custom-related-posts', __('Related Posts'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest Insights' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
        if ( ! $number )
            $number = 10;

        global $wp_query;
        $postid = $wp_query->post->ID;

        $r = new WP_Query(
                apply_filters(
                        'widget_posts_args',
                            array(
                                'posts_per_page' => $number,
                                'category__in' => wp_get_post_categories( $postid ),
                                'post__not_in' => array( $postid ),
                                'no_found_rows' => true,
                                'post_status' => 'publish',
                                'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) :
            ?>
            <?php echo $before_widget; ?>
            <?php if ( $title ) echo $before_title . $title . $after_title; ?>
            <ul>
                <?php while ( $r->have_posts() ) : $r->the_post(); ?>

                    <!-- custom layout -->

                    <li>
                        <a href="<?php  the_permalink();?>" title="<?php the_title(); ?>" >
                            <?php the_title() ;?>
                        </a>
                    </li>

                    <!-- custom layout -->
                <?php endwhile; ?>
            </ul>
            <?php echo $after_widget; ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_related_posts', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];

        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_related_posts']) )
            delete_option('widget_related_posts');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_related_posts', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

        <?php
    }
}

