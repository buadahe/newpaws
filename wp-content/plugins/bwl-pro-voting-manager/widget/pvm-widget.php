<?php

/***********************************************************
* @Description: PVM Widget
* @Created At: 25-04-2014
* @Last Edited AT: 25-04-2014
* @Created By: Mahbub
***********************************************************/

function bwl_pvm_widget_init() {
   
    register_widget('Bwl_Pvm_Widget');
     
}

add_action( 'widgets_init', 'bwl_pvm_widget_init' ); 


class Bwl_Pvm_Widget extends WP_Widget {

    public function __construct() {     
 
            parent::__construct(
                    'bwl_pvm_widget',
                    __('BWL Voting Manager' , 'bwl-pro-voting-manager'),
                    array(
                            'classname'     =>  'Bwl_Pvm_Widget',
                            'description'    =>   __('Display Top Voted Posts In sidebar area' , 'bwl-pro-voting-manager')
                    )
            );
        
    }
    
    public function form($instance) {
 
        $defaults = array(
            'title'                              =>  __('Top Liked Posts' , 'bwl-pro-voting-manager'),
            'bwl_pvm_post_type'     => 'post',
            'bwl_pvm_order_type'     => 'liked',
            'bwl_pvm_no_of_post'    =>  '5'
        );
        
        $instance = wp_parse_args((array) $instance, $defaults);
        
        extract($instance);
        
        ?>
 
        
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Title' , 'bwl-pro-voting-manager'); ?></label>
            <input type="text" 
                       class="widefat" 
                       id="<?php echo $this->get_field_id('title') ?>" 
                       name="<?php echo $this->get_field_name('title') ?>"
                       value="<?php echo esc_attr($title) ?>"/>
        </p>
        
        <!-- Post Type -->   
        
         <p>
                <label for="<?php echo $this->get_field_id('bwl_pvm_post_type'); ?>"><?php _e('Post Type:', 'bwl-pro-voting-manager') ?></label> 
                <select id="<?php echo $this->get_field_id('bwl_pvm_post_type'); ?>" name="<?php echo $this->get_field_name('bwl_pvm_post_type'); ?>" class="widefat" style="width:100%;">
                    
                    <?php 
                    
                        $available_bpvm_post_types = bpvm_get_widget_custom_post_types();
 
                        foreach( $available_bpvm_post_types as $bpvm_post_type_key=> $bpvm_post_type_value) :

                           $bpvm_post_type_value = strtolower($bpvm_post_type_value);

                           $bpvm_post_type_title = ucfirst ( str_replace('_', ' ', $bpvm_post_type_value) );
                           
                    ?>
                    
                        <option value="<?php echo $bpvm_post_type_value; ?>" <?php if ( $instance['bwl_pvm_post_type'] == $bpvm_post_type_value ) echo 'selected="selected"'; ?>><?php echo $bpvm_post_type_title; ?></option>
                    
                    <?php

                        endforeach;
                    
                    ?>
                       <option value="post-format-gallery" <?php if ( $instance['bwl_pvm_post_type'] == 'post-format-gallery' ) echo 'selected="selected"'; ?>><?php _e('Gallery posts', 'bwl-pro-voting-manager'); ?></option>
                    
                </select>
        </p>
        
        <!-- Order Type -->   
        
         <p>
                <label for="<?php echo $this->get_field_id('bwl_pvm_order_type'); ?>"><?php _e('Order Type:', 'bwl-pro-voting-manager') ?></label> 
                <select id="<?php echo $this->get_field_id('bwl_pvm_order_type'); ?>" name="<?php echo $this->get_field_name('bwl_pvm_order_type'); ?>" class="widefat" style="width:100%;">
                    <option value="liked" <?php if ( $instance['bwl_pvm_order_type'] == 'liked' ) echo 'selected="selected"'; ?>><?php _e('Liked', 'bwl-pro-voting-manager'); ?></option>                        
                    <option value="disliked" <?php if ( $instance['bwl_pvm_order_type'] == 'disliked' ) echo 'selected="selected"'; ?>><?php _e('Disliked', 'bwl-pro-voting-manager'); ?></option>                        
                </select>
        </p>
        
        <!-- Display No of Posts  -->
        <p>
            <label for="<?php echo $this->get_field_id('bwl_pvm_no_of_post') ?>"><?php _e('No Of Posts' , 'bwl-pro-voting-manager'); ?></label>
            <input type="text" 
                       class="widefat" 
                       id="<?php echo $this->get_field_id('bwl_pvm_no_of_post') ?>" 
                       name="<?php echo $this->get_field_name('bwl_pvm_no_of_post') ?>"
                       value="<?php echo esc_attr($bwl_pvm_no_of_post) ?>"/>
        </p>
        
        <?php
        
    }
    
    public function update($new_instance, $old_instance) {
        
        $instance                                    = $old_instance;
        
        $instance['title']                           = strip_tags( stripslashes( $new_instance['title'] ) );
        
        $instance['bwl_pvm_post_type']  =  strip_tags( stripslashes( $new_instance['bwl_pvm_post_type'] ) );
        
        $instance['bwl_pvm_order_type']  =  strip_tags( stripslashes( $new_instance['bwl_pvm_order_type'] ) );
        
        $instance['bwl_pvm_no_of_post']  =  strip_tags( stripslashes( $new_instance['bwl_pvm_no_of_post'] ) );
        
        return $instance;
        
    }
    
    public function widget($args, $instance) {
        
        extract($args);
        
        $title                      = apply_filters('widget-title' , $instance['title']);
        
        $bwl_pvm_post_type = $instance['bwl_pvm_post_type'];   
        
        $bwl_pvm_order_type = $instance['bwl_pvm_order_type'];       
        
        $bwl_pvm_no_of_post = $instance['bwl_pvm_no_of_post'];       
        
        echo $before_widget;
        
        $pvm_data = get_option('bwl_pvm_options');
        
        /*------------------------------ Add Custom Icon For Like Button  ---------------------------------*/

        if( isset($pvm_data ['pvm_like_thumb_icon']) && $pvm_data ['pvm_like_thumb_icon'] != "" ) {

           $pvm_like_thumb_icon = $pvm_data ['pvm_like_thumb_icon'];

           $pvm_like_thumb_html = '<i class="fa ' . $pvm_like_thumb_icon . ' icon_like_color"></i>';

       } else {

           $pvm_like_thumb_icon = "fa-thumbs-o-up";

           $pvm_like_thumb_html = '<i class="fa ' . $pvm_like_thumb_icon . ' icon_like_color"></i>';

       }

       /*------------------------------ Add Custom Icon For Dislike Button  ---------------------------------*/

       if( isset($pvm_data ['pvm_dislike_thumb_icon']) && $pvm_data ['pvm_dislike_thumb_icon'] != "" ) {

           $pvm_dislike_thumb_icon = $pvm_data ['pvm_dislike_thumb_icon'];

           $pvm_dislike_thumb_html = '<i class="fa ' . $pvm_dislike_thumb_icon . ' icon_dislike_color"></i>';

       } else {

           $pvm_dislike_thumb_icon = "fa-thumbs-o-down";

           $pvm_dislike_thumb_html = '<i class="fa ' . $pvm_dislike_thumb_icon . ' icon_dislike_color"></i>';

       }
        
        if($title) :
            
            echo $before_title . $title . $after_title;
        
        endif;       
        
        
         if( $bwl_pvm_order_type == "disliked") {
             
             $meta_key = 'pvm_dislike_votes_count';
             
         } else {
             
             $meta_key = 'pvm_like_votes_count';
             
         }
        
        if( $bwl_pvm_no_of_post ):
    
            $args = array(
                            'post_status'       => 'publish',
                            'post_type'         => $bwl_pvm_post_type,
                            'order'                => 'DESC',
                            'meta_key' => $meta_key,
                            'orderby' => 'meta_value_num',
                            'posts_per_page' => $bwl_pvm_no_of_post,
                            'ignore_sticky_posts' => 1
                        );
        
        
            if ( $bwl_pvm_post_type == "post-format-gallery") {
                
                unset($args['post_type']); // unset post type field
                
                $args['tax_query'] = array(
                                                array(
                                                'taxonomy' => 'post_format',
                                                'field' => 'slug',
                                                'terms' => 'post-format-gallery'
                                                )
                                            );
            }

            $loop = new WP_Query($args);
            
            global $post;
            
             $pvm_voted_post_string = "";
            
             if ( $loop->have_posts() ) :
                
                $pvm_voted_post_string .= '<ul class="bpvm-widget">';
                
                     while ( $loop->have_posts() ) :
                
                            $loop->the_post();
                     
                                $like_vote_counter = ( get_post_meta($post->ID, "pvm_like_votes_count", true ) == "" ) ? 0 : get_post_meta($post->ID, "pvm_like_votes_count", true);  
                                $dislike_vote_counter = ( get_post_meta($post->ID, "pvm_dislike_votes_count", true ) == "" ) ? 0 : get_post_meta($post->ID, "pvm_dislike_votes_count", true);  
            
                                
                                if( $bwl_pvm_order_type == 'disliked') {
                                    
                                    $pvm_voted_post_string.="<li><a href='" . get_permalink() . "'>" . get_the_title() . '</a><br /> ' . $pvm_dislike_thumb_html. ' ' . $dislike_vote_counter .' &nbsp;  ' . $pvm_like_thumb_html . ' ' . $like_vote_counter ."</li>";
                                    
                                } else {
                                
                                    $pvm_voted_post_string.="<li><a href='" . get_permalink() . "'>" . get_the_title() . '</a><br /> ' . $pvm_like_thumb_html. ' ' . $like_vote_counter .' &nbsp;  ' . $pvm_dislike_thumb_html. ' ' .  $dislike_vote_counter ."</li>";
                                
                                }
                
                    endwhile;
                    
                    wp_reset_query();

                    $pvm_voted_post_string .= '</ul>';
             
            else:
                
                $pvm_voted_post_string .="<p>" .__("No Post Found!", 'bwl-pro-voting-manager') . "</p>";
                
            endif;
            
            echo  $pvm_voted_post_string ;
       
        endif;
        
        echo $after_widget;
        
    }
 
    
}

 
?>