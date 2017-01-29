<?php

add_action('init', 'ajax_register_init');

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
    add_action('wp_ajax_ajaxprofile', 'ajax_profile');
    add_action('wp_ajax_ajaxdashboard', 'ajax_dashboard');
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

function ajax_profile()
{
    // print_r($_POST);

 //    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['profile_jenis']          = $_POST['jenis'];
    $info['profile_date-of-born']   = $_POST['date-of-born'];
    $info['profile_jenis_kelamin']  = $_POST['jenis_kelamin'];
    $info['profile_warna']          = $_POST['warna'];
    $info['profile_berat']          = $_POST['berat'];
    $info['profile_stambum'] 	    = $_POST['stambum'];

    echo $info['profile_date-of-birth'];

 //    // First check the nonce, if it fails the function will be break
	check_ajax_referer('ajax-login-nonce', 'security');

    $current_user   = wp_get_current_user();
    $user_id        = $current_user->ID;

    if (!get_user_meta($user_id, 'profile_jenis')) {
        add_user_meta( $user_id, 'profile_jenis', $info['profile_jenis'] );
    }else{
        update_user_meta( $user_id, 'profile_jenis', $info['profile_jenis'] );
    }

    if (!get_user_meta($user_id, 'profile_date-of-born')) {
        add_user_meta( $user_id, 'profile_date-of-born', $info['profile_date-of-born'] );
    }else{
        update_user_meta( $user_id, 'profile_date-of-born', $info['profile_date-of-born'] );
    }

    if (!get_user_meta($user_id, 'profile_jenis_kelamin')) {
        add_user_meta( $user_id, 'profile_jenis_kelamin', $info['profile_jenis_kelamin'] );
    }else{
        update_user_meta( $user_id, 'profile_jenis_kelamin', $info['profile_jenis_kelamin'] );
    }

    if (!get_user_meta($user_id, 'profile_warna')) {
        add_user_meta( $user_id, 'profile_warna', $info['profile_warna'] );
    }else{
        update_user_meta( $user_id, 'profile_warna', $info['profile_warna'] );
    }

    if (!get_user_meta($user_id, 'profile_berat')) {
        add_user_meta( $user_id, 'profile_berat', $info['profile_berat'] );
    }else{
        update_user_meta( $user_id, 'profile_berat', $info['profile_berat'] );
    }

    if (!get_user_meta($user_id, 'profile_stambum')) {
        add_user_meta( $user_id, 'profile_stambum', $info['profile_stambum'] );
    }else{
        update_user_meta( $user_id, 'profile_stambum', $info['profile_stambum'] );
    }

    echo json_encode(array('status' => 'success', 'message' => __('Profile updated!')));
    die();
}

function ajax_dashboard()
{
    // print_r($_POST);
    // print_r($_FILES);
    // die();

    // First check the nonce, if it fails the function will be break
    // check_ajax_referer('ajax-login-nonce', 'security');

    $current_user   = wp_get_current_user();
    $user_id        = $current_user->ID;

    $post_data = array(
        'post_title'    => $_POST['caption'],
        'post_excerpt'  => $_POST['caption'],
    );
    media_handle_upload( 'foto', 0, $post_data);

    echo json_encode(array('status' => 'success', 'message' => __('Image uploaded!')));
    die();
}