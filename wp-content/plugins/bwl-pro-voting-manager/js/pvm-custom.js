jQuery(document).ready(function() {
    
    var pvm_container = jQuery(".bwl_pvm_container"),
          pvm_like_btn = pvm_container.find(".btn_like"),
          pvm_dislike_btn = pvm_container.find(".btn_dislike"),
          vote_status,
          stat_cnt,
          post_id;
          
        if ( typeof(pvm_tipsy_status) != 'undefined' && pvm_tipsy_status == 1 ) {   

          // Initalized Tipsy
           jQuery('.btn_like').tipsy({fade: true, gravity: 's'});
           jQuery('.btn_dislike').tipsy({fade: true, gravity: 'n'});           

        }
 
          pvm_like_btn.click(function(){     
               
                vote_status = jQuery(this).attr("vote_status");
                post_id = jQuery(this).attr("post_id");      
                stat_cnt = jQuery("#stat-cnt-"+post_id);
                
                if ( pvm_tipsy_status == 1 ) {   
                    // Hide Tipsy
                    jQuery( "#pvm_btn_container_"+post_id ).find('.btn_like').tipsy('hide');
                    jQuery( "#pvm_btn_container_"+post_id ).find('.btn_dislike').tipsy('hide');
                }
                
                jQuery( "#pvm_btn_container_"+post_id ).html('<div class="msg_container">'+pvm_wait_msg+'</div>');
                pvm_count_vote( vote_status, post_id );

          });
          
          pvm_dislike_btn.click(function(){
                
                vote_status = jQuery(this).attr("vote_status");
                post_id = jQuery(this).attr("post_id");
                stat_cnt = jQuery("#stat-cnt-"+post_id);
                
                if ( pvm_tipsy_status == 1 ) {   
                    // Hide Tipsy
                    jQuery( "#pvm_btn_container_"+post_id ).find('.btn_like').tipsy('hide');
                    jQuery( "#pvm_btn_container_"+post_id ).find('.btn_dislike').tipsy('hide');
                }
                
                jQuery( "#pvm_btn_container_"+post_id ).html('<div class="msg_container">'+pvm_wait_msg+'</div>');
                pvm_count_vote( vote_status, post_id );
               
                
          });
          
    
          function pvm_count_vote( vote_status, post_id ) {
              
              jQuery.ajax({
                    url: ajaxurl,
                    type: 'POST',            
                    dataType: 'JSON',
                    data: {
                        action      : 'bwl_pvm_add_rating', // action will be the function name
                        count_vote : true,
                        post_id    : post_id,
                        vote_status: vote_status
                    },
                    success: function(data) {
                        
                        var msg_icon = '<span class="fa fa-info-circle"></span>';
                        
                        if( data.status == 1 ) {
                            
                            stat_cnt.find(".total-vote-counter span").html(data.total_vote_counter);
                            stat_cnt.find(".like-count-container span").html(data.like_vote_counter);
                            stat_cnt.find(".dislike-count-container span").html(data.dislike_vote_counter);

                            stat_cnt.find(".like_percentage").attr("style", "width:"+data.like_percentage+"%");
                            stat_cnt.find(".dislike_percentage").attr("style", "width:"+data.dislike_percentage+"%");
                        
                        }
                        
                        if ( vote_status  == 0 && data.status == 1 && pvm_disable_feedback_status == 0 ) {
                            
                            jQuery("#pvm_feedback_form_"+post_id).slideDown("slow", function(){
                            
                                var form_field_container = jQuery("#pvm_feedback_form_" +post_id + " .bwl_pvm_feedback_form"),
                                     feedback_message_box = form_field_container.find('.feedback_message_box'),
                                     captcha = form_field_container.find('#captcha'),
                                     all_fields = jQuery( [] ).add( feedback_message_box ).add( captcha );   

                                     all_fields.removeAttr('disabled').removeClass('bwl_pvm_feedback_disabled_field').val("");
                                     
                                     form_field_container.find("input[type=submit]").removeAttr('disabled');
                                  
                            });
                            
                           
                        }
                        
                        jQuery( "#pvm_btn_container_"+post_id ).html('<div class="msg_container"> ' + msg_icon + ' ' + data.msg + '</div>');
                          
                    },
                    error: function(xhr, textStatus, e) {
                        alert('There was an error saving the update.');
                        return;
                    }

                });
          }
          
          
          /*------------------------------ Form Submission  ---------------------------------*/
    
    function randomNum( maxNum ){
        
        return Math.floor(Math.random()*maxNum+1);//return a number between 1 - 10
        
    }
    
     jQuery(".bwl_pvm_feedback_form").find("input[type=submit]").click(function() {
         
         var form_submit_button = jQuery(this),
               bwl_pvm_feedback_form_id = form_submit_button.attr('bwl_pvm_feedback_form_id'),
               form_box_container = jQuery("#" + bwl_pvm_feedback_form_id),
               form_field_container = jQuery("#" + bwl_pvm_feedback_form_id + " .bwl_pvm_feedback_form"); 
         
         var bwl_pro_form_error_message_box = form_box_container.find('.bwl_pro_form_error_message_box'),
               feedback_message_box = form_field_container.find('.feedback_message_box'),
               captcha_status = form_field_container.find('#captcha_status');
            
               if( captcha_status.val() == 1 ) {
                    
                   var num1 = form_field_container.find('#num1');
                   var num2 = form_field_container.find('#num2');
                   var  captcha = form_field_container.find('#captcha');
                   var all_fields = jQuery( [] ).add( feedback_message_box ).add( captcha );   
                    
               } else {
                   
                    var all_fields = jQuery( [] ).add( feedback_message_box );                
                    
               }
               
              
               
               var bValid = true,
                    required_field_msg = "",
                    ok_border = "border: 1px solid #EEEEEE",
                    error_border = "border: 1px solid #E63F37";
                    
                    
                if( jQuery.trim(feedback_message_box.val()).length <3 ) {
                   
                   feedback_message_bValid = false;
                   feedback_message_box.attr("style", error_border);
                   required_field_msg += " " + err_feedback_msg + "<br />";
                   
               } else {
                   
                   feedback_message_bValid = true;
                   feedback_message_box.attr("style", ok_border);                   
                   required_field_msg += "";                   
                   
               }
               
                bValid = bValid && feedback_message_bValid;
             
                
                if ( captcha_status.val() == 1 ) {
                
                    if( ( parseInt( jQuery.trim( num1.val() ) ) + parseInt( jQuery.trim( num2.val() ) ) != parseInt(  jQuery.trim( captcha.val() ) ) ) ) {

                       captcha_bValid = false;
                       captcha.attr("style",error_border);
                       required_field_msg += " " + err_pvm_captcha;

                   } else {

                       captcha_bValid = true;
                       captcha.attr("style",ok_border);
                       required_field_msg += "";

                   }

                   bValid = bValid && captcha_bValid;
               
               }
         
               //Alert Message Box For Required Fields.
               
               if ( bValid == false ) {
                   
                    bwl_pro_form_error_message_box.html("").addClass("bwl-form-error-box").html( required_field_msg ).slideDown("slow");
                
               }

               
               if ( bValid == true ) {
                    all_fields.attr("style",ok_border);
                    all_fields.addClass('bwl_pvm_feedback_disabled_field').attr('disabled', 'disabled');
                    form_submit_button.addClass('bwl_pvm_feedback_disabled_field').attr('disabled', 'disabled');               
                    bwl_pro_form_error_message_box.html("").removeClass("bwl-form-error-box").addClass("bwl-form-wait-box").html(pvm_wait_msg).slideDown("slow");

                     jQuery.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            action      : 'bwl_pvm_save_post_data', // action will be the function name,
                            feedback_message_box : feedback_message_box.val(),
                            post_id : form_submit_button.attr("post_id"),
                            post_type: form_field_container.find('#post_type').val(),
                            name_of_nonce_field: form_field_container.find('#name_of_nonce_field').val(),
                        },
                        success: function(data) {

                            if( data.pvm_feedback_status == 1 ) {
                                
                                //Reload For New Number.
                                
                                if ( captcha_status.val() == 1 ) {
                                
                                    num1.val(randomNum(5));
                                    num2.val(randomNum(9));
                                    
                                }                                
                                
                                bwl_pro_form_error_message_box.removeClass('bwl-form-wait-box').html("").html(pvm_feedback_thanks_msg).addClass("bwl-form-success-box").delay(3000).slideUp("slow", function(){
                                    
                                    jQuery("#pvm_feedback_form_"+post_id).slideUp("slow", function(){
                                        jQuery(this).remove();                                        
                                    });
                                    
                                });
                                

                            } else {

                                bwl_pro_form_error_message_box.removeClass('bwl-form-wait-box').html("").html(pvm_unable_feedback_msg).addClass("bwl-form-error-box").delay(3000).slideUp("slow");                                                                        
                                all_fields.removeAttr('disabled').removeClass('bwl_pvm_feedback_disabled_field');
                                form_submit_button.removeAttr('disabled').removeClass('bwl_pvm_feedback_disabled_field');
                            }

                        },
                        error: function(xhr, textStatus, e) {

                            bwl_pro_form_error_message_box.removeClass('bwl-form-wait-box').html("").html(pvm_unable_feedback_msg).addClass("bwl-form-error-box").delay(3000).slideUp("slow");                                        
                            all_fields.removeAttr('disabled').removeClass('bwl_pvm_feedback_disabled_field');
                            form_submit_button.removeAttr('disabled').removeClass('bwl_pvm_feedback_disabled_field');
                            return;
                        }

                    });
         
            }
         
            return false;
         
     });
    
});