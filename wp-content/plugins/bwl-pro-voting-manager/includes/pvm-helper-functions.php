<?php
 
 function bpvm_clean_custom_post_types() {

    $available_bpvm_post_types = get_post_types();
    // Some unset function.
    
    if ( class_exists( 'TribeEvents' ) ) {
        
        $removed_items = array( 'post', 'attachment', 'revision', 'nav_menu_item', 'tribe_venue', 'tribe_organizer');
        
    } else {
        
        $removed_items = array( 'post', 'attachment', 'revision', 'nav_menu_item');
        
    }

    foreach ($removed_items as $rm_post_types_key => $rm_post_types_vlaue) {

        foreach (array_keys($available_bpvm_post_types, $rm_post_types_vlaue) as $key) {
            unset($available_bpvm_post_types[$key]);
        }
    }

    if ( class_exists( 'TribeEvents' ) ) {
        
        $available_bpvm_post_types = array_merge( array('tribe_events'=>'tribe_events'), $available_bpvm_post_types );
        
    }
    
    

    return $available_bpvm_post_types;
    
}


function bpvm_get_all_post_types() {
    
    if ( class_exists( 'TribeEvents' ) ) {
        
        $bpvm_default_post_types = array('post'=> 'post', 'tribe_events'=>'tribe_events');
        
    } else {
        
        $bpvm_default_post_types = array('post'=> 'post');
        
    }
    
    $bpvm_custom_post_types = array_merge( $bpvm_default_post_types, bpvm_clean_custom_post_types() );
    
    return $bpvm_custom_post_types;
    
}

function bpvm_get_custom_column_post_types() {
    
     if ( class_exists( 'TribeEvents' ) ) {
        
        $bpvm_default_post_types = array('posts'=> 'posts', 'tribe_events'=>'tribe_events');
        
    } else {
        
        $bpvm_default_post_types = array('post'=> 'post');
        
    }
    
    
    $bpvm_custom_post_types = array_merge( $bpvm_default_post_types, bpvm_clean_custom_post_types() );
    
    return $bpvm_custom_post_types;
    
}

function bpvm_get_widget_custom_post_types() {
    
    $bpvm_default_post_types = array('post'=> 'post');
    
    $bpvm_custom_post_types = array_merge( $bpvm_default_post_types, bpvm_clean_custom_post_types() );
    
    return $bpvm_custom_post_types;
    
}

?>
