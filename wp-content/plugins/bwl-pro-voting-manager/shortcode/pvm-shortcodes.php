<?php 

add_shortcode('bwl_pvm', 'bwl_pvm'); 
        
function bwl_pvm($atts){
 
     global $post;
     
     $post_id = get_the_ID();
     
     extract(shortcode_atts(array(
        'id' => $post_id,
        'status' => 1,
        'post_type' => get_post_type( $post_id ),
        'animation' => 0,
        'like_theme' => '',
        'dislike_theme' => ''
         
    ), $atts));
     
     
     if ( isset($id) && $id !="" ) {
         
         $post_id = $id;
         $post_type = get_post_type( $post_id );
         
     }
     
    /**
    * @Description: Parameter Definition
    * @Status: Display voting manager or not. 0. Hide 1. Show, 2. Voting Close. 
    * @Post Type: You can add custom post type to display voting manager any where of your blog.
    * @Post ID: Current Post, page, custom post ID.
    **/
     
    $output = bwl_pvm_shortcode_html( $status, $post_type, $post_id, $animation, $like_theme, $dislike_theme );
    
    return $output;
    
}


function bwl_pvm_shortcode_html( $bwl_pvm_display_status, $post_type, $post_id, $animation, $like_theme, $dislike_theme ) {

    $content = "";
    
    if( $bwl_pvm_display_status!="" && $bwl_pvm_display_status == 0 ) {
        
        return $content;
        
    }
    
    if( $bwl_pvm_display_status!="" && $bwl_pvm_display_status == 2 ) {
        
        
        /*------------------------------ BUILD INTERFACE ---------------------------------*/ 
    
        $pvm_interface = '<section class="bwl_pvm_container pvm_clearfix">
                                  <p class="voting-closed-message"><i class="fa fa-info-circle"></i> ' . __('Voting Closed !', 'bwl-pro-voting-manager') . '</p>
                            </section><!-- end .bwl_pvm_container -->';
        
        $content .= $pvm_interface;
        
        return $content;
        
    }
    
    // Display Voting Closed Message.
    
    $like_vote_counter = get_post_meta($post_id, "pvm_like_votes_count", true);  
    
    if ( $like_vote_counter == "" ) {
        $like_vote_counter = 0;
    }
    
    $dislike_vote_counter = get_post_meta($post_id, "pvm_dislike_votes_count", true);  
    
    if ( $dislike_vote_counter == "" ) {
        $dislike_vote_counter = 0;
    }
    
     $pvm_feedback_message_unique_id = 'pvm_feedback_list_'.$post_id; // so idea is we are going to add post id after vairable name
     
     $prev_pvm_feedback_message = get_post_meta($post_id, $pvm_feedback_message_unique_id);  
    
     $total_vote_counter = $like_vote_counter+$dislike_vote_counter;
     
     $like_percentage = pvm_calculate_percentage( $total_vote_counter, $like_vote_counter);
     $dislike_percentage = pvm_calculate_percentage($total_vote_counter, $dislike_vote_counter);
 
     $pvm_data = get_option('bwl_pvm_options');
     
     /*------------------------------ Feedback Title ---------------------------------*/
     
     if( isset($pvm_data ['pvm_feedback_form_title']) && $pvm_data ['pvm_feedback_form_title'] != "" ) {
        
         $pvm_feedback_form_title = $pvm_data ['pvm_feedback_form_title'];
         
     } else {
         
         $pvm_feedback_form_title = "Tell us how can we improve this post?";
         
     }
     
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
     
     
      /*------------------------------ Add Custom Icon For Dislike Button  ---------------------------------*/
     
     $pvm_disable_voting_bar_status = 0;
     
     if( isset( $pvm_data['pvm_disable_voting_bar_status'] ) && $pvm_data['pvm_disable_voting_bar_status'] == 1 ) {
            
         $pvm_disable_voting_bar_status = 1;
            
    }
     
     
     
     /*------------------------------ Custom Image For Like Button ---------------------------------*/
   
         if( isset( $pvm_data ['pvm_like_conditinal_fields']['enabled']) && $pvm_data['pvm_like_conditinal_fields']['enabled'] == 'on' ){
             
             $pvm_custom_like_icon = $pvm_data['pvm_like_conditinal_fields']['pvm_custom_like_icon'];
             
             if( isset( $pvm_custom_like_icon ['src'] ) && $pvm_custom_like_icon['src'] != "" ){
                 
                 $pvm_like_thumb_html = '<img src="' . $pvm_custom_like_icon['src'] . '" class="pvm-custom-icon"/>';
                 
            }
         
        }
        
        
      /*------------------------------ Custom Image For Dislike Button ---------------------------------*/
   
         if( isset( $pvm_data ['pvm_dislike_conditinal_fields']['enabled']) && $pvm_data['pvm_dislike_conditinal_fields']['enabled'] == 'on' ){
             
             $pvm_custom_dislike_icon = $pvm_data['pvm_dislike_conditinal_fields']['pvm_custom_dislike_icon'];
             
             if( isset( $pvm_custom_dislike_icon ['src'] ) && $pvm_custom_dislike_icon['src'] != "" ){
                 
                 $pvm_dislike_thumb_html = '<img src="' . $pvm_custom_dislike_icon['src'] . '" class="pvm-custom-icon"/>';
                 
            }
         
        }  
     
     
     /*------------------------------ Down Vote Status ---------------------------------*/
     
     $pvm_disable_down_vote_status = 0;
     
     if( isset( $pvm_data['pvm_disable_down_vote_status'] ) && $pvm_data['pvm_disable_down_vote_status'] == 1 ) {
            
            $pvm_disable_down_vote_status = 1;
            
    }
     
     /*------------------------------ ADD VOTE STATUS ---------------------------------*/
     
     $vote_given_status = 0;
     
     $pvm_tipsy_like_title = "Like The Post";
     
     // Like Bar Color.
        
     if( isset( $pvm_data['pvm_tipsy_like_title'] ) && $pvm_data['pvm_tipsy_like_title']!="" ) {

        $pvm_tipsy_like_title = $pvm_data['pvm_tipsy_like_title']; 

     }
     
     $pvm_tipsy_dislike_title = "Dislike The Post";
     
     // Dislike Bar Color.
        
     if( isset( $pvm_data['pvm_tipsy_dislike_title'] ) && $pvm_data['pvm_tipsy_dislike_title']!="" ) {

        $pvm_tipsy_dislike_title = $pvm_data['pvm_tipsy_dislike_title']; 

     }
     
     
     if( $vote_given_status == 1) {
 
         $pvm_btn_container_html = '<div class="msg_container" id="msg_container_'.$post_id.'"> ' . __('Loading .....', 'bwl-pro-voting-manager') . '</div>';
         
     } else {
         
         if ( $pvm_disable_down_vote_status == 1 ) {
             
             $pvm_btn_container_html = '<div class="btn_like" title="' . $pvm_tipsy_like_title . '" vote_status="1" post_id="' . $post_id .'">' . $pvm_like_thumb_html . '</div>';
             
         } else {
         
         $pvm_btn_container_html = '<div class="btn_like" title="' . $pvm_tipsy_like_title . '" vote_status="1" post_id="' . $post_id .'">' . $pvm_like_thumb_html . '</div>
                                               <div class="btn_dislike" title="' . $pvm_tipsy_dislike_title . '" vote_status="0" post_id="' . $post_id .'">' . $pvm_dislike_thumb_html . '</div>';
         
         }
     }
    
     
    /*------------------------------ BUILD INTERFACE ---------------------------------*/
     
    $bwl_pvm_voting_bar_type = ( get_post_meta($post_id, "bwl_pvm_voting_bar_type", true ) == "" ) ? 0 : get_post_meta($post_id, "bwl_pvm_voting_bar_type", true);  
    
    if ( $bwl_pvm_voting_bar_type == 1 || $animation == 1 ) {
        
        // Custom Like Theme
        
        if( $like_theme !="" ) {
            
            $bwl_pvm_like_bar_theme = $like_theme;  

        } else {
            
            $bwl_pvm_like_bar_theme = ( get_post_meta($post_id, "bwl_pvm_like_bar_theme", true ) == "" ) ?  'animated_green_theme' : get_post_meta($post_id, "bwl_pvm_like_bar_theme", true);  

        }
        
       
        // Custom Dislike Theme
        
        if( $dislike_theme !="" ) {
            
            $bwl_pvm_dislike_bar_theme = $dislike_theme;  

        } else {
            
            $bwl_pvm_dislike_bar_theme = ( get_post_meta($post_id, "bwl_pvm_dislike_bar_theme", true ) == "" ) ? 'animated_red_theme' : get_post_meta($post_id, "bwl_pvm_dislike_bar_theme", true);  

        }

        
        $pvm_bar_html = '<div class="stat-bar">
                                    <div class="bpvm_animated_bar">
                                        <div class="bar like_percentage ' . $bwl_pvm_like_bar_theme .'" style="width:' . $like_percentage  .'%;">
                                            <div class="barFill"></div>
                                        </div>
                                        <div class="bar dislike_percentage ' . $bwl_pvm_dislike_bar_theme .'" style="width:' . $dislike_percentage  .'%;">
                                            <div class="barFill"></div>
                                        </div>
                                    </div>
                                </div><!-- end .stat-bar -->';
   
    } else {
   
        $pvm_bar_html = '<div class="stat-bar">'
                                    . '<div class="bg-green like_percentage" style="width:' . $like_percentage  .'%;"></div>
                                    <div class="bg-red dislike_percentage" style="width:' . $dislike_percentage  .'%;"></div>'
                               . '</div><!-- end .stat-bar -->';
         
     
    }
    
    if ( $pvm_disable_voting_bar_status == 1 ) {
         
        $pvm_bar_html = '<div class="stat-bar-blank"></div><!-- end .stat-bar-blank -->';
        
    }
    
    $pvm_interface = '<section class="bwl_pvm_container pvm_clearfix">
        
                                 <div class="pvm_btn_container pvm_clearfix" id="pvm_btn_container_' . $post_id . '"> 
                                 
                                    ' . $pvm_btn_container_html . '

                                 </div> <!-- end .pvm_btn_container -->

                                <div class="stat-cnt" id="stat-cnt-' . $post_id . '">
                                    <div class="total-vote-counter">' . __("Total", "bwl-pro-voting-manager") . ' <span>' . $total_vote_counter .'</span> ' . __("Votes", "bwl-pro-voting-manager") . '</div>
                                    
                                        ' . $pvm_bar_html . '
                                    
                                    <div class="dislike-count-container">' . $pvm_dislike_thumb_html . ' <span>' . $dislike_vote_counter . '</span></div>
                                    <div class="like-count-container">' . $pvm_like_thumb_html . ' <span>' . $like_vote_counter . '</span></div>
                                </div><!-- /stat-cnt -->
                            </section><!-- end .bwl_pvm_container -->';
    
    $content .= $pvm_interface;
    
    $pvm_form_id = "pvm_feedback_form_".$post_id;
    
    $captcha_status = 1;
    
    $pvm_captcha_generator = '<p>
                                                <label for="captcha">' . __('Captcha:', 'bwl-pro-voting-manager') . '</label>
                                                    <input id="num1" class="sum" type="text" name="num1" value="' . rand(1,4) . '" readonly="readonly" /> +
                                                    <input id="num2" class="sum" type="text" name="num2" value="' . rand(5,9) . '" readonly="readonly" /> =
                                                    <input id="captcha" class="captcha" type="text" name="captcha" maxlength="2" />
                                                    <input id="captcha_status" type="hidden" name="captcha_status" value="' . $captcha_status . '" />
                                                <span id="spambot"> '. __('Verify Human or Spambot ?', 'bwl-pro-voting-manager') .'</span>
                                            </p>';   
    
    $pvm_form_body = '<section class="bwl-pro-voting-feedback-form-container pvm_clearfix" id="' . $pvm_form_id . '">
                    
                                        <h2>' . $pvm_feedback_form_title . ' </h2>

                                        <div class="bwl_pro_form_error_message_box"></div>
                                            
                                        <form id="bwl_pvm_feedback_form" class="bwl_pvm_feedback_form" name="bwl_pvm_feedback_form" method="post" action="#"> 
                                        
                                                <p>        
                                                    <textarea id="feedback_message" class="feedback_message_box" placeholder="'.__('Write feedback message ..... ', 'bwl-pro-voting-manager').'"/></textarea>

                                                ' . $pvm_captcha_generator . '

                                                <p align="left">
                                                    <input type="submit" value="' . __('Submit', 'bwl-pro-voting-manager') . '" tabindex="6" id="submit" name="submit" bwl_pvm_feedback_form_id= "' . $pvm_form_id . '" post_id="' . $post_id .'"/>
                                                </p>

                                                <input type="hidden" name="post_type" id="post_type" value="bwl_pro_voting_manager" />

                                                <input type="hidden" name="action" value="bwl_pro_voting_manager" />'

                                                . wp_nonce_field( 'name_of_my_action','name_of_nonce_field' ) .
            
                                           '</form>

                                        </section>';
    
    $content .= $pvm_form_body;
    
    return $content;

}

// This shortcode will display liked/ disliked posts with limit and date filter
// PARAMETER INFO: 
// order_type: liked/disliked
// limit: no of post you want to display.
// date_filter: Allow to run date filter query
// interval: any number like 30, means display last 30 days top/down voted posts
// SHORTCODE EXAMPLES: 
// Display 20 top liked post of last 30 days : [bpvm_filter order_type='liked' limit=20 date_filter=1 interval=30 /]
// Display 20 top disliked  post of last 30 days : [bpvm_filter order_type='disliked' limit=20 date_filter=1 interval=30 /]


add_shortcode('bpvm_filter', 'bpvm_filter');

function bpvm_filter($atts){
 
     global $post;
     
     $post_id = get_the_ID();
     
     extract(shortcode_atts(array(
        'class' => 'bpvm-posts',
        'order_type' => 'liked', // liked/disliked
        'post_type' => 'post',
        'date_filter' => 0,
        'interval' => 30, 
        'limit' => -1,
        'animation' => 0,
        'custom_header' => 1,
        'thumb' => 1,
        'te_cat' => ''
         
    ), $atts));
     
     $te_cat = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $te_cat);
     
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
     
     
     $pvm_voted_post_string ="";
     
     if( $order_type == "disliked") {
             
             $meta_key = 'pvm_dislike_votes_count';
             
         } else {
             
             $meta_key = 'pvm_like_votes_count';
             
         }
    
            $args = array(
                            'post_status'       => 'publish',
                            'post_type'         => $post_type,
                            'order'                => 'DESC',
                            'meta_key' => $meta_key,
                            'orderby' => 'meta_value_num',
                            'posts_per_page' => $limit,
                            'ignore_sticky_posts' => 1
                        );
            
            
            if( class_exists( 'TribeEvents' ) && $post_type == "tribe_events" && $te_cat != "" ){
                $args['tribe_events_cat'] = $te_cat;
            }
            
            if (isset($date_filter) && $date_filter == 1) {
                
                if( ! is_numeric( $interval) ) {
                   $interval = 30; 
                }

                $args ['meta_query'] = array(
                    array(
                        'key' => 'vote_date',
                        'value' => date('Y-m-d', strtotime('-' . $interval .' days')),
                        'compare' => '>='
                    )
                );
            }
        
            if ( $post_type == "post-format-gallery") {
                
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
            
            $counter = 1;
            
             if ( $loop->have_posts() ) :
                 
                     $pvm_voted_post_string .= get_pvm_custom_header( $custom_header );
                
                     while ( $loop->have_posts() ) :
                
                            $loop->the_post();

                            $post_thumb = '';
                     
                            if( has_post_thumbnail() && $thumb == 1 ) {
                                $post_thumb = get_the_post_thumbnail($post->ID, 'pvm-post-thumb');
                            }
                     
                            $pvm_voted_post_string .= '<div class="pvm-custom-info">';
                            
                            $pvm_voted_post_string .= '<div class="post-position">' . $counter . '</div><div class="post-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '" class="pvm-filtered-post">' . $post_thumb .'<span>' . get_the_title() . '</span></a></div>';
             
                            $pvm_voted_post_string .= '</div>';    
                            
                            $pvm_voted_post_string .= do_shortcode('[bwl_pvm id=' . $post->ID . ' animation=' . $animation . '/]');
                     
                            $counter++;
                
                    endwhile;
                    
                     wp_reset_query();
             
            else:
                
                $pvm_voted_post_string ="<p>" .__("No Post Found!", 'bwl-pro-voting-manager') . "</p>";
                
            endif;
            
     
    return $pvm_voted_post_string;
     
     
}

function get_pvm_custom_header( $pvm_custom_header_status = 0) {
    
    $pvm_custom_header_string = "";
    
    if ( $pvm_custom_header_status == 1 ) {
        $pvm_custom_header_string =  '<div class="pvm-custom-header">'
                . '<div class="post-position">'.__('Position', 'bwl-pro-voting-manager').'</div>'
                . '<div class="post-title">'.__('Title', 'bwl-pro-voting-manager').'</div>'
                . '<div class="post-votes">'.__('Votes', 'bwl-pro-voting-manager').'</div>'
                . '</div>';
    }
    
    return $pvm_custom_header_string;
    
    
}