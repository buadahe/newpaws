<?php

function ajax_register_init()
{
    wp_register_script('ajax-register-script', get_template_directory_uri() . '/js/ajax-register-script.js', array('jquery'));
    wp_enqueue_script('ajax-register-script');

    wp_localize_script('ajax-register-script', 'ajax_login_object', array(
        'ajaxurl'        => admin_url('admin-ajax.php'),
        'redirecturl'    => home_url(),
        'loadingmessage' => __('Sending user info, please wait...'),
    ));

    // Enable the user with no privileges to run ajax_register() in AJAX
    add_action('wp_ajax_nopriv_ajaxregister', 'ajax_register');
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_register_init');
}

function ajax_register()
{
    // Nonce is checked, get the POST data and sign user on
    $info                   = array();
    $info['user_login']     = $_POST['signup_username'];
    $info['user_pass']      = $_POST['signup_password'];
    $info['user_nicename']  = $_POST['signup_username'];
    $info['user_email']     = $_POST['signup_email'];
    $info['display_name'] 	= $_POST['signup_username'];
    $info['user_category'] 	= $_POST['signup_category'];

    // First check the nonce, if it fails the function will be break
	check_ajax_referer('ajax-login-nonce', 'security');

	if ( ! is_email( $info['user_email'] ) ) {
        echo json_encode(array('loggedin' => false, 'message' => __('The email address you entered is not valid.')));
	    die();
    }
 
    if (email_exists( $info['user_email'] ) ) {
        echo json_encode(array('loggedin' => false, 'message' => __('An account exists with this email address.')));
	    die();
    }

    if ( username_exists( $info['user_login'] )) {
        echo json_encode(array('loggedin' => false, 'message' => __('An account exists with this email username.')));
	    die();
    }

    $user_signup = wp_insert_user($info);
    if (is_wp_error($user_signup)) {
        echo json_encode(array('loggedin' => false, 'message' => __('Register Failed!')));
    } else {
        do_action('user_register', $user_signup);
        add_user_meta( $user_signup, 'user_category', $info['user_category']);
        $data = array(
        	'user_login' 	=> $info['user_login'],
        	'user_password' => $info['user_pass'],
        	'remember' 		=> TRUE,
        );
        wp_signon( $data, false );
        echo json_encode(array('loggedin' => true, 'message' => __('Register Successful!')));
    }

    die();
}
