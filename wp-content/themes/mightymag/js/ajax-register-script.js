/**
 * Created by Adi Umbas Primadarma on 1/7/2017.
 */

jQuery(document).ready(function($) {
    // Function to set checked radio button
    jQuery('#signup_form #signup_category').change(function(event) {
        
    });


    // Show the login dialog box on click
    //$('a#show_login').on('click', function(e){
    //    $('body').prepend('<div class="login_overlay"></div>');
    //    $('form#login').fadeIn(500);
    //    $('div.login_overlay, form#login a.close').on('click', function(){
    //        $('div.login_overlay').remove();
    //        $('form#login').hide();
    //    });
    //    e.preventDefault();
    //});

    // Perform AJAX login on form submit
    // jQuery('#loginform').on('submit', function(e){
    //     jQuery('#loginform p.status').show().text(ajax_login_object.loadingmessage);
    //     $.ajax({
    //         type: 'POST',
    //         url: 'http://localhost/newpaws/wp-login.php',
    //         cache: false,
    //         data: {
    //             'log'    : jQuery('#loginform #user_login').val(),
    //             'pwd'    : jQuery('#loginform #user_pass').val()
    //         },
    //         success: function(data){
    //             $('#loginform p.status').text(data.message);
    //             if (data.loggedin == true){
    //                 document.location.href = ajax_login_object.redirecturl;
    //             }
    //         },
    //         error: function (xhr) {
    //             alert('error');
    //             // $('p:first', form[0]).before(
    //             //     $(document.createElement('div'))
    //             //         .html('<strong>ERROR</strong>: ' + xhr.statusText)
    //             //         .attr('id', 'login_error')
    //             // );
    //             // activity.hide(); fields.show();
    //         }
    //     });
    //     e.preventDefault();
    // });

    // Perform AJAX register on form submit
    jQuery('#signup_form').on('submit', function(e){
        jQuery('#signup_form p.status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: {
                'action'            : 'ajaxregister', //calls wp_ajax_nopriv_ajaxlogin
                'signup_email'      : jQuery('#signup_form #signup_email').val(),
                'signup_username'   : jQuery('#signup_form #signup_username').val(),
                'signup_password'   : jQuery('#signup_form #signup_password').val(),
                'signup_category'   : jQuery('#signup_form input[name=signup_category]:checked').val(),
                'security'          : jQuery('#signup_form #security').val() 
            },
            success: function(data){
                if (data.loggedin == true){
                    // console.log('sukses');
                    window.location.href = ajax_login_object.redirecturl;
                }else{
                    // console.log('gagal');
                    alert(data.message);
                }
            }
        });
        e.preventDefault();
    });

    

});