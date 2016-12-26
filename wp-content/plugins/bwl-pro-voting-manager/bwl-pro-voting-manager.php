<?php

/*
Plugin Name: BWL Pro Voting Manager
Plugin URI: http://www.bluewindlab.net
Description: BWL Pro Voting Manager provide you a great option to add automatically a custom voting system in single post. Feedback option gives you a nice way to collect user feedback and improve your post.
Author: Md Mahbub Alam Khan
Version: 1.0.6
WP Requires at least: 3.5+
Author URI: http://www.bluewindlab.net
*/
 
Class BWL_Pro_Voting_Manager{
    
    function __construct() {
        
         /*------------------------------ PLUGIN COMMON CONSTANTS ---------------------------------*/
        define( "BWL_PVM_PLUGIN_TITLE", 'BWL Pro Voting Manager');
        define( "BWL_PVM_PLUGIN_DIR", plugins_url() .'/bwl-pro-voting-manager/' );
        define( "BWL_PVM_PLUGIN_VERSION", '1.0.6');
        
        // Call Immediatly Initialized.        
        $this->included_files();
        $this->enqueue_plugin_scripts();
        $this->bpvm_cau();
    }
    
    function included_files() {
        //delete_option('bwl_pvm_options'); // remove options.
       
       add_image_size( 'pvm-post-thumb', 32, 32, true );
       include_once dirname(__FILE__) . '/includes/pvm-helper-functions.php';  
       include_once dirname(__FILE__) . '/includes/pvm-interface.php';  
       include_once dirname(__FILE__) . '/includes/pvm-vote-counter.php';        
       include_once dirname(__FILE__) . '/includes/pvm-custom-theme.php';
        
        if( is_admin() ) {
            
            /* ------------------------------ INTEGRATE FAQ TINY MCE BUTTON --------------------------------- */
            
            include_once dirname(__FILE__) . '/tinymce/bpvm_tiny_mce_config.php';

            include_once dirname(__FILE__) . '/includes/pvm-custom-column.php';  
            include_once dirname(__FILE__) . '/includes/pvm-custom-meta-box.php';  
            include_once dirname(__FILE__) . '/includes/pvm-quick-edit.php';
            
            include_once dirname(__FILE__) . '/option-panel/plugin-option-panel-menu.php';  
            include_once dirname(__FILE__) . '/option-panel/plugin-option-panel-settings.php';  
        }
        
    }
    
    function bpvm_cau(){
        
        $pvm_data = get_option('bwl_pvm_options');
        
        if( isset( $pvm_data['pvm_auto_update_status'] ) && $pvm_data['pvm_auto_update_status'] == 1 && is_admin() ) {
            
            include_once dirname(__FILE__) . '/includes/pvm-update-notifier.php';
        
        }
        
    }
    
    function enqueue_plugin_scripts(){
        
        $pvm_data = get_option('bwl_pvm_options');
        
         /*------------------------------ Load Custom Styles ---------------------------------*/
        
        if( ! is_admin() ){
        
            wp_enqueue_style( 'bwl-pro-voting-manager-styles' , plugins_url( 'css/voting-style.css' , __FILE__ ) );
            wp_enqueue_style( 'bwl-pro-voting-manager-animated-styles' , plugins_url( 'css/animated_styles.css' , __FILE__ ) );
            wp_enqueue_style( 'bwl-pro-voting-manager-tipsy-styles' , plugins_url( 'css/tipsy.css' , __FILE__ ) );

           if( ! isset( $pvm_data['pvm_fontawesome_status'] ) || $pvm_data['pvm_fontawesome_status'] == 1 ) {

                wp_enqueue_style( 'bwl-pro-font-awesome-styles' , plugins_url( 'css/font-awesome.min.css' , __FILE__ ) );

            }

        }
        
        if( is_admin() ){
        
            wp_enqueue_style( 'bwl-pvm-editor-styles' , plugins_url( 'tinymce/css/bwl_pvm_editor.css' , __FILE__ ) );
            wp_enqueue_style( 'bwl-pvm-multiple-select-styles' , plugins_url( 'tinymce/css/multiple-select.css' , __FILE__ ) );
            
        }
        
        /*------------------------------ Load Custom Scripts ---------------------------------*/
        
        if( ! is_admin() ){
            
            wp_register_script( 'bwl-pro-voting-manager-tipsy-script', plugins_url( 'js/jquery.tipsy.js' , __FILE__ ) , array( 'jquery'), '', FALSE );
            wp_enqueue_script( 'bwl-pro-voting-manager-tipsy-script' );
            wp_register_script( 'bwl-pro-voting-manager-custom-script', plugins_url( 'js/pvm-custom.js' , __FILE__ ) , array( 'jquery'), '', FALSE );
            wp_enqueue_script( 'bwl-pro-voting-manager-custom-script' );
        
        }
        
        if( is_admin() ){
            wp_register_script( 'bwl-pro-voting-manager-multiselect-script', plugins_url( 'tinymce/js/jquery.multiple.select.js' , __FILE__ ) , array( 'jquery'), '', TRUE );
            wp_enqueue_script( 'bwl-pro-voting-manager-multiselect-script' );
            wp_register_script( 'bwl-pro-voting-manager-admin-script', plugins_url( 'js/pvm-admin-custom.js' , __FILE__ ) , array( 'jquery'), '', TRUE );
            wp_enqueue_script( 'bwl-pro-voting-manager-admin-script' );
        }
        
    }
    
}

/*------------------------------ Initialization ---------------------------------*/

function init_bwl_pro_voting_manager() {
    new BWL_Pro_Voting_Manager();
}

add_action('init', 'init_bwl_pro_voting_manager');

include_once dirname(__FILE__) . '/widget/pvm-widget.php';  

/*------------------------------  TRANSLATION FILE ---------------------------------*/

load_plugin_textdomain('bwl-pro-voting-manager', FALSE, dirname(plugin_basename(__FILE__)) . '/lang/');

/*------------------------------ INTEGRATE SHORTCODE   ---------------------------------*/

include_once dirname(__FILE__) . '/shortcode/pvm-shortcodes.php';  