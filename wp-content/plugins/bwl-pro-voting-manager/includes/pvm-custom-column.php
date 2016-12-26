<?php

 /*------------------------------  Custom Column Section ---------------------------------*/

$bpvm_custom_post_types = bpvm_get_all_post_types();

foreach ($bpvm_custom_post_types as $bpvm_custom_post_types_key => $bpvm_custom_post_types_value ) {
    
    $post_types = 'posts';
    
    if ( $bpvm_custom_post_types_value == 'page'  ) {
        
        $post_types = 'pages';
        
    } else {
        
        $post_types = $bpvm_custom_post_types_value.'_posts';
        
    }
    
    // After manage text we need to add "custom_post_type" value.

    add_filter('manage_' . $post_types . '_columns', 'pvm_custom_column_header' );

     // After manage text we need to add "custom_post_type" value.

    add_action('manage_' . $post_types . '_custom_column', 'pvm_display_custom_column', 10, 1);
    
}

// After manage text we need to add "custom_post_type" value.

//add_filter('manage_posts_columns', 'pvm_custom_column_header' );

 // After manage text we need to add "custom_post_type" value.
 
//add_action('manage_posts_custom_column', 'pvm_display_custom_column', 10, 1);



function pvm_custom_column_header( $columns ) {
     
     return array_merge( $columns, 
              array(
                  
                  'pvm_like_votes_count' => __('Like', 'bwl-pro-voting-manager'),                   
                  'pvm_dislike_votes_count' => __('Dislike', 'bwl-pro-voting-manager'),
                  'pvm_feedback' => __('Feedback', 'bwl-pro-voting-manager'),
                  'bwl_pvm_display_status' => __('Voting <br /> Status', 'bwl-pro-voting-manager'),
                  
                  ) 
            );
     
 }


 
function pvm_display_custom_column( $column ) {

    // Add A Custom Image Size For Admin Panel.
    
    global $post;
    
    switch ( $column ) {
    
        case 'pvm_like_votes_count':

                $like_vote_counter = ( get_post_meta($post->ID, "pvm_like_votes_count", true ) == "" ) ? 0 : get_post_meta($post->ID, "pvm_like_votes_count", true);  
                echo '<div id="pvm_like_votes_count-' . $post->ID . '" >&nbsp;' . $like_vote_counter . '</div>';

        break;
    
        case 'pvm_dislike_votes_count':
        
                $dislike_vote_counter = ( get_post_meta($post->ID, "pvm_dislike_votes_count", true ) == "" ) ? 0 : get_post_meta($post->ID, "pvm_dislike_votes_count", true);  
                echo '<div id="pvm_dislike_votes_count-' . $post->ID . '">&nbsp;' . $dislike_vote_counter . '</div>';
            
        break;
    
        case 'bwl_pvm_display_status':
        
                $bwl_pvm_display_status = ( get_post_meta($post->ID, "bwl_pvm_display_status", true ) == "" ) ? 1 : get_post_meta($post->ID, "bwl_pvm_display_status", true);  
                
                if( $bwl_pvm_display_status == 2 ) {
                    
                    $bwl_pvm_display_status_text = __('Closed', 'bwl-pro-voting-manager');
                    
                } else if( $bwl_pvm_display_status == 1 ) {
                    
                    $bwl_pvm_display_status_text = __('Show', 'bwl-pro-voting-manager');
                    
                } else {
                    
                    $bwl_pvm_display_status_text = __('Hidden', 'bwl-pro-voting-manager');
                    
                }
            
                echo '<div id="bwl_pvm_display_status-' . $post->ID . '" data-status_code="'.$bwl_pvm_display_status.'">' . $bwl_pvm_display_status_text . '</div>';
            
        break;
    
        case 'pvm_feedback':
        
                $pvm_feedback_message_unique_id = 'pvm_feedback_list_'.$post->ID; // so idea is we are going to add post id after vairable name
         
                $prev_pvm_feedback_message = get_post_meta( $post->ID, $pvm_feedback_message_unique_id );
        
                
                if( isset($prev_pvm_feedback_message[0]) ) {
                
                   $prev_pvm_feedback_message_counter = sizeof($prev_pvm_feedback_message[0]);
                
                } else {
                    
                   $prev_pvm_feedback_message_counter = 0; 
                    
                }
//                
                echo '<div id="pvm_dislike_votes_count-' . $post->ID . '" class="pvm_alignment">' . $prev_pvm_feedback_message_counter . '</div>';
            
        break;
        
            
    }
    
}


/*------------------------------ CUSTOM STYLESHEET ---------------------------------*/

function pvm_custom_style() {

    $style = '<style type="text/css">
                                    .pvm_alignment{
                                            display: block; text-align: center; 
                                    }
                                </style>';


    echo $style;
}

add_action('admin_head', 'pvm_custom_style');

?>
