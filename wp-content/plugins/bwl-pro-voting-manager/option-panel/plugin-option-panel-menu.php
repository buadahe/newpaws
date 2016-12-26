<?php

  //include the main class file

  add_action('admin_menu', 'bwl_pvm_options_page');
  
  function bwl_pvm_options_page() {
  
   add_menu_page(            
            __( 'Voting Manager Option Panel', 'bwl-pro-voting-manager'), // The Text to be display in bte browser bar.
            __( 'Voting Manager', 'bwl-pro-voting-manager'), // The Text to be display in bte browser bar.
            'manage_options', // Permission.
            'bwl-pvm', // unique slug for plugin settings menu.
            'bwl_pvm_display_home_page', // Settings Page        ,
            BWL_PVM_PLUGIN_DIR . 'images/bpvm_menu_icon.png'
            );
   
  }
  
  /***********************************************************************************************/
/* Home Settings Section */
/***********************************************************************************************/

function bwl_pvm_display_home_page() {
    
    require_once 'welcome-page.php';
    
}