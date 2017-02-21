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
        jQuery('#signup_form').hide();
        jQuery('#signup_form').parent('.modal-content-custom').css({
            height: '50px',
            width: '50px'
        });
        jQuery('#signup_form').siblings('.loader').show();

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
                alert(data.message);
                if (data.loggedin == true){
                    window.location.href = ajax_login_object.redirecturl;
                }else{
                    jQuery('#signup_form').show();
                    jQuery('#signup_form').parent('.modal-content-custom-profile').css('height', 'auto');
                    jQuery('#signup_form').siblings('.loader').hide();
                }
            }
        });
        e.preventDefault();
    });

    // Perform AJAX profile on form submit
    jQuery('#profile_form').on('submit', function(e){
        jQuery('#profile_form').hide();
        jQuery('#profile_form').parent('.modal-content-custom-profile').css('height', '50px');
        jQuery('#profile_form').siblings('.loader').show();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: {
                'action'            : 'ajaxprofile', //calls wp_ajax_nopriv_ajaxlogin
                'jenis'             : jQuery('#profile_form #jenis').val(),
                'date-of-born'      : jQuery('#profile_form #date-of-born').val(),
                'jenis_kelamin'     : jQuery('#profile_form #jenis_kelamin').val(),
                'warna'             : jQuery('#profile_form #warna').val(),
                'berat'             : jQuery('#profile_form #berat').val(),
                'stambum'           : jQuery('#profile_form input[name=stambum]:checked').val(),
                'security'          : jQuery('#profile_form #security').val() 
            },
            success: function(data){
                if (data.status == 'success'){
                    alert(data.message);
                }else{
                    alert('Refresh page and update profile again.');
                }
                jQuery('#profile_form').show();
                jQuery('#profile_form').parent('.modal-content-custom-profile').css('height', 'auto');
                jQuery('#profile_form').siblings('.loader').hide();
            }
        });
        e.preventDefault();
    });

    // Perform AJAX profile on form submit
    jQuery('#addpet_form').on('submit', function(e){
        jQuery('#addpet_form').hide();
        jQuery('#addpet_form').parent('.modal-content-custom-profile').css('height', '50px');
        jQuery('#addpet_form').siblings('.loader').show();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: {
                'action'            : 'ajaxaddpet', //calls wp_ajax_nopriv_ajaxlogin
                'pet_nama'              : jQuery('#addpet_form #pet_nama').val(),
                'pet_alamat'            : jQuery('#addpet_form #pet_alamat').val(),
                'pet_jenis'             : jQuery('#addpet_form #pet_jenis').val(),
                'pet_tanggal_lahir'      : jQuery('#addpet_form #pet_tanggal_lahir').val(),
                'pet_jenis_kelamin'     : jQuery('#addpet_form #pet_jenis_kelamin').val(),
                'pet_warna'             : jQuery('#addpet_form #pet_warna').val(),
                'pet_berat_badan'             : jQuery('#addpet_form #pet_berat_badan').val(),
                'pet_stambum'           : jQuery('#addpet_form input[name=stambum]:checked').val(),
                'security'          : jQuery('#addpet_form #security').val()
            },
            success: function(data){
                if (data.status == 'success'){
                    alert(data.message);
                }else{
                    alert('Refresh page and add pet again.');
                }
                jQuery('#addpet_form').show();
                jQuery('#addpet_form').parent('.modal-content-custom-profile').css('height', 'auto');
                jQuery('#addpet_form').siblings('.loader').hide();
            }
        });
        e.preventDefault();
    });

    jQuery('#dashboard_form').on('submit', function(e){
        jQuery('#dashboard_form').hide();
        jQuery('#dashboard_form').parent('.modal-content-custom-dashboard').css('height', '50px');
        jQuery('#dashboard_form').siblings('.loader').show();

        var formData = new FormData();
        formData.append('action', 'ajaxdashboard');
        formData.append("foto", $('#dashboard_form #file-input-dashboard')[0].files[0]);
        formData.append('caption', jQuery('#dashboard_form #caption').val());
        // formData.append('caption', jQuery('#dashboard_form #security').val());

        $.ajax({
            type: 'POST',
            url: ajax_login_object.ajaxurl,
            // dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(data){
                data = JSON.parse(data);
                if (data.status == 'success'){
                    alert(data.message);
                }else{
                    alert('Refresh page and add image again.');
                }
                jQuery('#dashboard_form #caption').val('');
                jQuery('#dashboard_form').show();
                jQuery('#dashboard_form').parent('.modal-content-custom-dashboard').css('height', '281px');
                jQuery('#dashboard_form').siblings('.loader').hide();
            }
        });
        e.preventDefault();
    });

    /**
     * Function for gallery
     */
    
    jQuery('#gallery .thumbnail').on('click', function(e){
        var src     = $(this).children('.img-responsive').attr('src');
        var caption = $(this).children('.caption').children('p').text();
        
        $('#popup .img-responsive').attr('src', src);
        $('#popup .modal-footer p').text(caption)
        e.preventDefault();
    });
    

});