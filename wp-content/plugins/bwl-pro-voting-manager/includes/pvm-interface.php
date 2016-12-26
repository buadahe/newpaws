<?php

function display_pvm_interface( $content ) {

    $post_id = get_the_ID();
    
    $pvm_data = get_option('bwl_pvm_options'); // retrive all options from plugin option panel.
    
    $bwl_pvm_display_status = get_post_meta($post_id, "bwl_pvm_display_status", true);
    
    // retrive the status of display current 
    
    $status = 1;
    
    if ( isset( $pvm_data ["pvmpt_".get_post_type( $post_id )] ) && $pvm_data ["pvmpt_".get_post_type( $post_id )] == 0 ) {
        
        $status = 0;  
        
    }
     
     if ( ! is_singular( get_post_type( $post_id ) ) ) {
        
        return $content;
        
    }
    
    if ( $status == 0 ) {
        
        return $content;
        
    }
    
    $content .= do_shortcode('[bwl_pvm status=' . $bwl_pvm_display_status .' /]');
    
    return $content;
    
}


add_filter('the_content', 'display_pvm_interface');

 
?>