<?php

  //include the main class file
  if ( ! class_exists( 'BF_Admin_Page_Class') ) :
    
    require_once("admin-page-class/admin-page-class.php");

 endif;
  
  
  /**
   * configure your admin page
   */
  $config = array(    
    'menu'           => 'bwl-pvm',             //sub page to settings page
    'page_title'     => __('Option Panel','bwl-pro-voting-manager'),       //The name of this page 
    'capability'     => 'edit_themes',         // The capability needed to view the page 
    'option_group'   => 'bwl_pvm_options',       //the name of the option to create in the database [do change]
    'id'             => 'bwl_pvm_admin_page',            // meta box id, unique per page[do change]
    'fields'         => array(),            // list of fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );  
  
  /**
   * instantiate your admin page
   */
  $options_panel = new BF_Admin_Page_Class($config);
  $options_panel->OpenTabs_container('');
  
  /**
   * define your admin page tabs listing
   */
  $options_panel->TabsListing(array(
    'links' => array(
      'options_1' =>  __('General','bwl-pro-voting-manager'),
      'options_2' =>  __('Theme Options','bwl-pro-voting-manager'),
      'options_4' =>  __('Tipsy Options','bwl-pro-voting-manager'),
      'options_3' =>  __('Advanced Options','bwl-pro-voting-manager'),
    )
  ));
  
  /**
   * Open admin page for General Settings
   */
  $options_panel->OpenTab('options_1');

  //title
  $options_panel->Title(__("General Options",'bwl-pro-voting-manager'));

    //Required Login To Submit Vote
    $options_panel->addCheckbox('pvm_login_status',array('name'=> __('Login Required? ','bwl-pro-voting-manager'), 'std' => FALSE, 'desc' => 'You can allow voting only for registered users.'));
  
   //Enable Font Awesome
  $options_panel->addCheckbox('pvm_fontawesome_status',array('name'=> __('Load Font Awesome ','bwl-pro-voting-manager'), 'std' => true, 'desc' => 'If your theme already load Font Awesome icons then you can disable this option.'));
  
  //Title Of Feedback From
  $options_panel->addText('pvm_feedback_form_title', array('name'=> __('Feedback Form Title','bwl-pro-voting-manager'), 'std'=> __('Tell us how can we improve this post?', 'bwl-pro-voting-manager') , 'desc' => ''));
  
  //Feedback Email to Admin
  $options_panel->addCheckbox('pvm_feedback_email_status',array('name'=> __('Send Feedback Message To Admin','bwl-pro-voting-manager'), 'std' => true, 'desc' => ''));
  
  //Admin Email Address
  $options_panel->addText('pvm_feedback_admin_email', array('name'=> __('Admin Email ','bwl-pro-voting-manager'), 'std'=> get_bloginfo( 'admin_email' ), 'desc' => ''));
  
  //is_numeric
  $options_panel->addText('pvm_vote_interval',
    array(
      'name'     => __('Voting Interval ','bwl-pro-voting-manager'),
      'std'      => '120',
      'desc'     => __("e.g: we set 120 min(2 hours) interval between repeated votes in a same post",'bwl-pro-voting-manager'),
      'validate' => array(
          'numeric' => array('param' => '','message' => __("must be number. e.g: 120",'bwl-pro-voting-manager'))
      )
    )
  );
  
  /**
   * Close first tab
   */   
  $options_panel->CloseTab();


  /**
   * Open admin page Second tab
   */
  $options_panel->OpenTab('options_2');
  /**
   * Add fields to your admin page 2nd tab

   */
  //title
  $options_panel->Title(__('Theme Settings','bwl-pro-voting-manager'));
  
  //Enable/Disable Like/Dislike Bar
//  $options_panel->addCheckbox('pvm_like_dislike_bar_status',array('name'=> __('Enable Like/Dislike Bar ','bwl-pro-voting-manager'), 'std' => true, 'desc' => '' ));

  //Like Thumb Icon.

  $options_panel->addSelect('pvm_like_thumb_icon',array('fa-thumbs-o-up'=>'Transparent Thumbs Up', 
                                                                             'fa-thumbs-up'=>'Filled Thumbs Up',
                                                                             'fa-heart-o'=>'Transparent Heart',
                                                                             'fa-heart'=>'Filled Heart',
                                                                             'fa-smile-o'=>'Smile Face',
                                                                             'fa-level-up'=>'Level up',
                                                                             'fa-arrow-circle-up'=>'Circle up',
                                                                             'fa-arrow-up'=>'Arrow up',
                                                                             'fa-angle-up'=>'Angle up',
                                                                             'fa-angle-double-up'=>'Double Angle up'),
          
                                array('name'=> __('Like Thumb Icon','bwl-pro-voting-manager'), 'std'=> array('fa-thumbs-o-up')));
 
  
  //Like Thumb Color
  $options_panel->addColor('pvm_like_thumb_color',array('name'=> __('Like Thumb Color','bwl-pro-voting-manager'), 'std' => '#559900',  'desc' => ''));

  //Like Custom Icon.
  $pvm_like_conditinal_fields[] = $options_panel->addImage('pvm_custom_like_icon',array('name'=> __('Upload Like Icon ','bwl-pro-voting-manager')),true);
  
 
  //conditinal block
  $options_panel->addCondition('pvm_like_conditinal_fields',
      array(
        'name' => __('Upload Custom Like Icon? ','bwl-pro-voting-manager'),
        'desc' => __('<small>You can upload custom icon for like button. Best size 16x16 PX</small>','bwl-pro-voting-manager'),
        'fields' => $pvm_like_conditinal_fields,
        'std' => false
      ));
  
   //Disable Down Vote
   $options_panel->addCheckbox('pvm_disable_feedback_status',array('name'=> __('Disable Feedback From? ','bwl-pro-voting-manager'), 'std' => FALSE, 'desc' => 'You can disable feedback from for down vote.'));
  
   //Disable Down Vote
   $options_panel->addCheckbox('pvm_disable_down_vote_status',array('name'=> __('Disable Down Vote? ','bwl-pro-voting-manager'), 'std' => FALSE, 'desc' => 'You can disable down voting option.'));
   
  //dislike Thumb Icon.

  $options_panel->addSelect('pvm_dislike_thumb_icon',array('fa-thumbs-o-down'=>'Transparent Thumbs Down', 
                                                                                'fa-thumbs-down'=>'Filled Thumbs Down',
                                                                                'fa-frown-o'=>'Sad Face ',
                                                                                'fa-level-down'=>'Level Down',
                                                                                'fa-arrow-circle-down'=>'Circle Down',
                                                                                'fa-arrow-down'=>'Arrow Down',
                                                                                'fa-angle-down'=>'Angle Down',
                                                                                'fa-angle-double-down'=>'Double Angle Down'),
          
                                array('name'=> __('Dislike Thumb Icon','bwl-pro-voting-manager'), 'std'=> array('fa-thumbs-o-down')));
  
  
  
  //Dislike Thumb field
  $options_panel->addColor('pvm_dislike_thumb_color',array('name'=> __('Dislike Thumb Color ','bwl-pro-voting-manager'), 'std' => '#C9231A',  'desc' => ''));
  
  //Dislike Custom Icon.
  $pvm_dislike_conditinal_fields[] = $options_panel->addImage('pvm_custom_dislike_icon',array('name'=> __('Upload Dislike Icon ','bwl-pro-voting-manager')),true);

  //conditinal block
  $options_panel->addCondition('pvm_dislike_conditinal_fields',
      array(
        'name' => __('Upload Custom Dislike Icon? ','bwl-pro-voting-manager'),
        'desc' => __('<small>You can upload custom icon for dislike button. Best size 16x16 PX</small>','bwl-pro-voting-manager'),
        'fields' => $pvm_dislike_conditinal_fields,
        'std' => false
      ));
  
  //conditinal block
  $options_panel->addCheckbox('pvm_disable_voting_bar_status',array('name'=> __('Disable Voting Bar? ','bwl-pro-voting-manager'), 'std' => FALSE, 'desc' => __('<small>You can disable display voting bar.</small>','bwl-pro-voting-manager')));

  //Like Bar Color
  $options_panel->addColor('pvm_like_bar_color',array('name'=> __('Like Bar Color','bwl-pro-voting-manager'), 'std' => '#559900',  'desc' => ''));
  
 //Dislike Color field
  $options_panel->addColor('pvm_dislike_bar_color',array('name'=> __('Dislike Bar Color ','bwl-pro-voting-manager'), 'std' => '#C9231A',  'desc' => ''));
  
  /**
   * Close second tab
   */ 
  $options_panel->CloseTab();
  
   /**
   * Open admin page Advance TAB
   */
  $options_panel->OpenTab('options_3');

  
  //title
 
  $options_panel->Title(__("Advance Setting",'bwl-pro-voting-manager'));
  
  //Disable Tipsy
  $options_panel->addCheckbox('pvm_ip_filter_status',array('name'=> __('IP Filter Status: ','bwl-pro-voting-manager'), 'std' => TRUE, 'desc' => 'If you disable this option then your can submit multiple votes from single IP address.'));
  
  $options_panel->addParagraph(__("You can filter where you want to show automated voting interface.", 'bwl-pro-voting-manager'));

  $available_bpvm_post_types = bpvm_clean_custom_post_types();
 
 foreach( $available_bpvm_post_types as $bpvm_post_type_key=> $bpvm_post_type_value) :
    
    $bpvm_post_type_value = strtolower($bpvm_post_type_value);

    $bpvm_post_type_title = ucfirst ( str_replace('_', ' ', $bpvm_post_type_value) );

    $options_panel->addCheckbox('pvmpt_'.$bpvm_post_type_value,array('name'=> $bpvm_post_type_title, 'std' => true ));
 
 endforeach;
 
 $options_panel->addCode('pvm_custom_css',array('name'=> __('Custom CSS ','bwl-pro-voting-manager'), 'syntax' => 'css', 'desc' => __('You can write custom css code in here.','bwl-pro-voting-manager')));
 
 //Auto Update Notification
  $options_panel->addCheckbox('pvm_auto_update_status',array('name'=> __('Auto Update Notification: ','bwl-pro-voting-manager'), 'std' => FALSE, 'desc' => 'If you enable this option then you will get notification while we release new version. <b style="color: #e32e31;">We strongly recommend to take a backup of your language file/custom css code/custom scripts before applying updates.</b>'));
  
  /**
   * Close first tab
   */   
  $options_panel->CloseTab();
  
  
  /**
   * Open admin page for General Settings
   */
  $options_panel->OpenTab('options_4');

  //title
  $options_panel->Title(__("Tipsy Options",'bwl-pro-voting-manager'));
  
  //Disable Tipsy
  $options_panel->addCheckbox('pvm_tipsy_status',array('name'=> __('Show Tool Tip ','bwl-pro-voting-manager'), 'std' => TRUE, 'desc' => 'You can disable Like/Dislike tooltip text.'));

  //Tipsy Like Hover Title
  $options_panel->addText('pvm_tipsy_like_title', array('name'=> __('Like Hover Title','bwl-pro-voting-manager'), 'std'=> __('Like The Post', 'bwl-pro-voting-manager') , 'desc' => ''));
  
  //Tipsy Dislike Hover Title
  $options_panel->addText('pvm_tipsy_dislike_title', array('name'=> __('Dislike Hover Title','bwl-pro-voting-manager'), 'std'=> __('Dislike The Post', 'bwl-pro-voting-manager') , 'desc' => ''));
  
  //Tipsy Background
  $options_panel->addColor('pvm_tipsy_bg',array('name'=> __('Tipsy Background','bwl-pro-voting-manager'), 'std' => '#000000',  'desc' => ''));

   //Tipsy Background
   $options_panel->addColor('pvm_tipsy_text_color',array('name'=> __('Tipsy Text Color','bwl-pro-voting-manager'), 'std' => '#FFFFFF',  'desc' => ''));
  
  /**
   * Close first tab
   */   
  $options_panel->CloseTab();
  
  
  ?>