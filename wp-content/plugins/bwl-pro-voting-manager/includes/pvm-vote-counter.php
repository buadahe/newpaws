<?php

function bwl_pvm_set_ajax_url() {
    
     $pvm_data = get_option('bwl_pvm_options');
     
     $pvm_tipsy_status =  1;
     $pvm_disable_feedback_status =  0;
     
     if ( isset($pvm_data['pvm_tipsy_status']) && $pvm_data['pvm_tipsy_status'] == 0 ) {
         
         $pvm_tipsy_status =  0;
         
     }
     
     if ( isset($pvm_data['pvm_disable_feedback_status']) && $pvm_data['pvm_disable_feedback_status'] == 1 ) {
         
         $pvm_disable_feedback_status =  1;
         
     }
    
?>
    <script type="text/javascript">
        
         var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>',                
              err_feedback_msg = '<?php _e(' Please Write Your Feedback Message', 'bwl-pro-voting-manager'); ?>',
              pvm_feedback_thanks_msg = '<?php _e('Thanks for your feedback!', 'bwl-pro-voting-manager'); ?>',
              pvm_unable_feedback_msg = '<?php _e('Unable to receive your feedback. Please try again !', 'bwl-pro-voting-manager'); ?>',
              err_pvm_captcha = '<?php _e(' Incorrect Captcha Value!', 'bwl-pro-voting-manager'); ?>',
              pvm_tipsy_status = '<?php echo $pvm_tipsy_status; ?>',
              pvm_wait_msg = '<?php _e('Please Wait .....', 'bwl-pro-voting-manager'); ?>',
              pvm_disable_feedback_status = '<?php echo $pvm_disable_feedback_status; ?>';
       
    </script>

<?php

}

add_action('wp_head', 'bwl_pvm_set_ajax_url');


function bwl_pvm_check_already_voted( $post_id )  {
    
    /*------------------------------ IP Filter Status ---------------------------------*/
    
    $bwl_pvm_options = get_option('bwl_pvm_options');
     
     if ( isset($bwl_pvm_options['pvm_ip_filter_status']) && $bwl_pvm_options['pvm_ip_filter_status'] == 0 ) {
         
         return FALSE; // remove this !
         
     }
    
    $timebeforerevote = 120; // = 2 hours  
    
    if ( isset($bwl_pvm_options['pvm_vote_interval'] ) && is_numeric( $bwl_pvm_options['pvm_vote_interval'] ) ) { 
            
       $timebeforerevote = $bwl_pvm_options['pvm_vote_interval'];

    }
  
    // Retrieve post votes IPs  
    $meta_IP = get_post_meta($post_id, "pvm_voted_ip");
    
    $like_vote_counter = get_post_meta($post_id, "pvm_like_votes_count", true);  
    $dislike_vote_counter = get_post_meta($post_id, "pvm_dislike_votes_count", true);  
    
    
    if( ( $like_vote_counter == "" || $like_vote_counter == 0 ) && ($dislike_vote_counter == "" || $dislike_vote_counter == 0 ) ) {
        
        return false;
        
    }
    
    
    if( !empty($meta_IP)) {
        
        $voted_IP = $meta_IP[0];  
        
    } else {
        
         $voted_IP = array();  
         
    } 
          
    // Retrieve current user IP  
    $ip = $_SERVER['REMOTE_ADDR'];  
  
    // If user has already voted  
    if ( in_array($ip, array_keys($voted_IP)) ) {
        
        $time = $voted_IP[$ip];
        
        $now = time();  
          
        // Compare between current time and vote time 
        
        if( round(($now - $time) / 60 ) > $timebeforerevote ) {
            
            return false;
            
        }
              
        return true;  
        
    }  
      
    return false;  
    
}


function bwl_pvm_add_rating() {

     if( isset($_REQUEST['count_vote']) ) {

        // Retrieve user IP address  
         
        $ip          = $_SERVER['REMOTE_ADDR'];
        
        $post_id  = $_POST['post_id'];
        
        $vote_status  = $_POST['vote_status'];
        
        $meta_IP = get_post_meta($post_id, "pvm_voted_ip");  // Get voters'IPs for the current post  
        
        if (!empty($meta_IP)) {
            
            $pvm_voted_ip = $meta_IP[0];
            
        } else {
            
            $pvm_voted_ip = array();
            
        }
        
        // check if user logged in or not.
        
        $pvm_data = get_option('bwl_pvm_options');
        
        $pvm_login_status = FALSE;
        
        if( isset( $pvm_data['pvm_login_status'] ) && $pvm_data['pvm_login_status']==1 ) {
            
            $pvm_login_status = FALSE;        
            
            if ( is_user_logged_in() ) :
                $pvm_login_status = TRUE;        
            endif;
            
            if( $pvm_login_status == FALSE ) {
            
                $data = array (
                    'status'            => 0,
                    'msg'               => __(' LogIn Required To submit vote!', 'bwl-pro-voting-manager')
                );

                echo json_encode($data);
                
                die();
            
            }
            
        }
        
        

        if( ! bwl_pvm_check_already_voted( $post_id ) ) {
            
            $pvm_voted_ip[$ip] = time();  
            
            $like_vote_counter = get_post_meta($post_id, "pvm_like_votes_count", true);        
            
             if ( $like_vote_counter == "" ) {
                $like_vote_counter = 0;
            }
            
            $dislike_vote_counter = get_post_meta($post_id, "pvm_dislike_votes_count", true); 
            
            if ( $dislike_vote_counter == "" ) {
                $dislike_vote_counter = 0;
            }

                // Save IP and increase votes count

            if ( $vote_status == 1 ) {

                $total_vote_counter = $like_vote_counter+$dislike_vote_counter+1;

                // Like Vote Couter. 
                 update_post_meta($post_id, "pvm_voted_ip", $pvm_voted_ip);
                 update_post_meta($post_id, "pvm_like_votes_count", ++$like_vote_counter);
                 update_post_meta($post_id, "vote_date", date('Y-m-d'));


            } else {

                $total_vote_counter = $like_vote_counter+$dislike_vote_counter+1;

                // Dislike Vote Counter
                update_post_meta($post_id, "pvm_voted_ip", $pvm_voted_ip);
                update_post_meta($post_id, "pvm_dislike_votes_count", ++$dislike_vote_counter);
                update_post_meta($post_id, "vote_date", date('Y-m-d'));

            }
            
            
            
            $data = array (
                'status'           => 1,
                'like_vote_counter' => $like_vote_counter,
                'dislike_vote_counter' => $dislike_vote_counter,
                'like_percentage' => pvm_calculate_percentage($total_vote_counter, $like_vote_counter),
                'dislike_percentage' => pvm_calculate_percentage($total_vote_counter, $dislike_vote_counter),
                'total_vote_counter' => $total_vote_counter,
                'vote_status'   => $vote_status,
                'msg'              => __(' Thanks for your vote!', 'bwl-pro-voting-manager')
                
            );
            
        } else  {
            
             $data = array (
                'status'            => 0,
                'msg'               => __(' You have already submitted your vote!', 'bwl-pro-voting-manager')
            );
             
        }
        
        echo json_encode($data);
    }
    
    die();
    
}

add_action('wp_ajax_bwl_pvm_add_rating', 'bwl_pvm_add_rating');

add_action( 'wp_ajax_nopriv_bwl_pvm_add_rating', 'bwl_pvm_add_rating' );

/*------------------------------  ---------------------------------*/

function pvm_calculate_percentage( $num_total=0, $num_amount=0  ) {
    
    if($num_amount == 0) {
        
        return 0;
        
    }
 
    $count1 = $num_amount / $num_total;
    $count2 = $count1 * 100;
    $count = number_format($count2, 0);
    return $count;
    
}

/*------------------------------ Add Feedback Message ---------------------------------*/

function bwl_pvm_save_post_data() { 
    
    
    $post_id = $_REQUEST['post_id'];
    
     if (empty($_REQUEST) || !wp_verify_nonce($_REQUEST['name_of_nonce_field'], 'name_of_my_action')) {
         
        $status = array(
            'pvm_feedback_status' => 0
        );
         
     } else {
    
         // We are going to create an unique ID
         
         $pvm_feedback_message_unique_id = 'pvm_feedback_list_'.$post_id; // so idea is we are going to add post id after vairable name
         
        $prev_pvm_feedback_message = ( get_post_meta($post_id, $pvm_feedback_message_unique_id, true) == "" ) ?  array() : get_post_meta($post_id, $pvm_feedback_message_unique_id, true);  
        
        $prev = $prev_pvm_feedback_message;
         
        $prev_pvm_feedback_message[] = wp_strip_all_tags( $_REQUEST['feedback_message_box'] );
        
        update_post_meta($post_id, $pvm_feedback_message_unique_id, $prev_pvm_feedback_message, $prev);
        
        //Send Email to administrator.
        
        $pvm_feedback_email_status = TRUE; // Initally We send email when user post a new faq.
        
        $bwl_pvm_options = get_option('bwl_pvm_options');
    
        if ( isset($bwl_pvm_options['pvm_feedback_email_status'] ) && $bwl_pvm_options['pvm_feedback_email_status'] == 0) { 
            
            $pvm_feedback_email_status = FALSE;
            
        }
        
        if ( $pvm_feedback_email_status == TRUE ) {
            
            $to =  get_bloginfo( 'admin_email' );
            
            if ( isset($bwl_pvm_options['pvm_feedback_admin_email'] ) && $bwl_pvm_options['pvm_feedback_admin_email'] != "") { 
            
                $to =  $bwl_pvm_options['pvm_feedback_admin_email'];

            }
            
            $email = "user@email.com";
            $subject = __('New Feedback Submited!', 'bwl-pro-voting-manager');
            $edit_faq_url =  get_admin_url() . "post.php?post&#61;$post_id&#38;action&#61;edit";

            $body = "<p>". __("Hello Administrator", 'bwl-pro-voting-manager') . ",<br>" . __("A new Feedback has been submitted by a user.", 'bwl-pro-voting-manager') . "</p>";         
            $body .= "<h3>" . __("Submitted Feedback", 'bwl-pro-voting-manager') . "</h3><hr />";         
            $body .= "<p>" . wp_strip_all_tags( $_REQUEST['feedback_message_box'] ) . "</p>";
            $body .= "<p><strong>" . __("Review Feedback", 'bwl-pro-voting-manager') . ":</strong> " . $edit_faq_url . "</p>";
            $body .= "<p>" . __("Thank You!", 'bwl-pro-voting-manager') . "</p>"; 
            
            $headers[]= "From: New Feedback <$email>";
            
            add_filter( 'wp_mail_content_type', 'bwl_pvm_set_html_content_type' );
            
            wp_mail ( $to, $subject, $body, $headers );
            
            remove_filter ( 'wp_mail_content_type', 'bwl_pvm_set_html_content_type' );
            
        }
        
        $status = array(
            'pvm_feedback_status' => 1
        );

    }
    
    echo json_encode($status);
    
    die();
    
}

/**
* @Description: Add A filter for sending HTML email.
* @Created At: 08-04-2013
* @Last Edited AT: 30-06-2013
* @Created By: Mahbub
**/

 function bwl_pvm_set_html_content_type() {
   return 'text/html';
}
 
add_action('wp_ajax_bwl_pvm_save_post_data', 'bwl_pvm_save_post_data');

add_action( 'wp_ajax_nopriv_bwl_pvm_save_post_data', 'bwl_pvm_save_post_data' );


?>