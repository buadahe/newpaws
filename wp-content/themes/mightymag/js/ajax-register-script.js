/**
 * Created by Adi Umbas Primadarma on 1/7/2017.
 */

$(document).ready(function($) {

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
    $('#registerss').on('submit', function(e){
        $('#registerss p.status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: {
                'action': 'ajaxregister', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('#registerss #name').val(),
                'password': $('#registerss #password').val(),
                'category': $('#registerss #category').val(),
                'security': $('#registerss #security').val() },
            success: function(data){
                $('#registerss p.status').text(data.message);
                if (data.loggedin == true){
                    document.location.href = ajax_login_object.redirecturl;
                }
            }
        });
        e.preventDefault();
    });

});