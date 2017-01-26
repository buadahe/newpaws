<?php

add_action('init', 'ajax_profile_init');

function ajax_profile_init()
{
    wp_register_script('ajax-register-script', get_template_directory_uri() . '/js/ajax-register-script.js', array('jquery'));
    wp_enqueue_script('ajax-register-script');

    wp_localize_script('ajax-register-script', 'ajax_login_object', array(
        'ajaxurl'        => admin_url('admin-ajax.php'),
        'redirecturl'    => home_url(),
        'loadingmessage' => __('Sending user info, please wait...'),
    ));

    // Enable the user with no privileges to run ajax_register() in AJAX
    add_action('wp_ajax_ajaxprofile', 'ajax_profile');
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
