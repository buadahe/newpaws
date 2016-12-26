<?php

/**
* @Description: Shortcode Editor Button
* @Created At: 08-04-2013
* @Last Edited AT: 26-06-2013
* @Created By: Mahbub
**/

add_action('admin_init', 'bpvm_tinymce_shortcode_button');

function bpvm_tinymce_shortcode_button() {
    
    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_external_plugins', 'add_bpvm_shortcode_plugin');
        add_filter('mce_buttons', 'register_bpvm_shortcode_button');
    }
}

function register_bpvm_shortcode_button( $buttons ) {
    array_push($buttons, "bwl_pvm");
    return $buttons;
}

function add_bpvm_shortcode_plugin( $plugin_array ) {
    $plugin_array['bwl_pvm'] = BWL_PVM_PLUGIN_DIR . 'tinymce/bpvm_tinymce_button.js';
    return $plugin_array;
}

 
?>