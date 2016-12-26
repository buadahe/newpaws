<?php

require('../../../../wp-load.php');
 
?>

<style type="text/css">
    hr.bpvm-shortcode-seperator{
        border: 0px;
        border-top: 1px solid #D0D0D0;
        height: 1px;
    }
    
    .bpvm_dn{
        display: none;
    }

    input[type="checkbox"].bpvm_checkbox{
        
        margin-top: 5px;
        
    }
    
</style>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        
        var $bpvm_parent_container = $("#bwl_pvm_editor_popup_content");
        
        
        /*------------------------------  All Fields ---------------------------------*/
        var post_type_container = $bpvm_parent_container.find(".post_type_container"),
             thumbnail_container = $bpvm_parent_container.find(".thumbnail_container"),
             date_filter_container = $bpvm_parent_container.find(".date_filter_container"),
             interval_container = $bpvm_parent_container.find(".interval_container"),
             limit_container = $bpvm_parent_container.find(".limit_container"),
             orderby_container = $bpvm_parent_container.find(".orderby_container"),
             animation_container = $bpvm_parent_container.find(".animation_container"),
             like_theme_container = $bpvm_parent_container.find(".like_theme_container"),
             dislike_theme_container = $bpvm_parent_container.find(".dislike_theme_container");
           
           
         var voting_theme_panel = $([]).add(like_theme_container).add(dislike_theme_container);
         var voting_panel_items = $([]).add(animation_container).add(voting_theme_panel);
         var custom_filter_items = $([]).add(post_type_container).add(thumbnail_container).add(date_filter_container)
                                                  .add(interval_container).add(limit_container).add(orderby_container);
                
                
               // Animation Filter. 
                
               animation_container.find("input[type=checkbox]").change(function() {
                    if(this.checked) {
                        voting_theme_panel.find("select").removeAttr("disabled").val("");
                    } else {
                        voting_theme_panel.find("select").attr("disabled","disabled").val("");
                    }
               });
             
        var custom_selection = $("input[name=custom_selection]");

             custom_selection.change(function(){
                 
                 if ( $(this).val() == 2 ) {
                   
                     voting_panel_items.addClass('bpvm_dn');
                     custom_filter_items.removeClass('bpvm_dn');
                     
                 } else {
                   
                     custom_filter_items.addClass('bpvm_dn');
                     voting_panel_items.removeClass('bpvm_dn');
                     
                 }
                 
             })
        
        
        
        
        $('#addShortCodebtn').click(function(event) {
            
            // INITIALIZE ALL SHORTCODE TEXT
             
             var bpvm_shortcode = "[";
             
             if( $("input:radio[name=custom_selection]:checked").val() == 2 ) {
                 
                 // Insert Custom Filter Shortcode.
                 
                 // Insert Filter Panel.
                 
                 bpvm_shortcode+='bpvm_filter';
                 
                 // Post Type Filter
                
                if ( post_type_container.find("#bpvm_post_type").val().length !== 0) {
                
                    bpvm_shortcode += ' post_type="' + post_type_container.find("#bpvm_post_type").val() + '"';

                }
                 
                 
                 // Thumbnail Filter
                 
                if( thumbnail_container.find("#bpvm_thumbnail_filter").is(':checked') ) {
                
                    bpvm_shortcode += ' thumb="1" ';

                } else {
                    
                    bpvm_shortcode += ' thumb="0" ';
                    
                }
                 
                 // Day Filter Status.
                 
                if( animation_container.find("#bpvm_date_filter").is(':checked') ) {
                
                    bpvm_shortcode += ' date_filter="1" ';

                }
                
                // Interval Filter.
                 
                if ( interval_container.find("#bpvm_interval").val().length !== 0) {
                
                    bpvm_shortcode += ' interval="' + $('#bpvm_interval').val() + '" ';

                }
                
                // Orderby Filter.
                 
                if ( orderby_container.find("#bpvm_orderby").val().length !== 0) {
                
                    bpvm_shortcode += ' order_type="' + orderby_container.find("#bpvm_orderby").val() + '" ';

                }
                
                // Limit Filter.
                 
                if ( limit_container.find("#bpvm_limit").val().length !== 0) {
                
                    bpvm_shortcode += ' limit="' + limit_container.find("#bpvm_limit").val() + '" ';

                }
                 
                 
             } else {
                 
                 // Insert Voting Panel.
                 
                 bpvm_shortcode+='bwl_pvm';
                 
                 // Voitng Animation Bar Shortcode.
                 
                if( animation_container.find("#bpvm_animation").is(':checked') ) {
                
                    bpvm_shortcode += ' animation="1" ';

                }
                
                // Like Theme.
                
                if ( voting_theme_panel.find("#bpvm_like_theme").val().length !== 0) {
                
                    bpvm_shortcode += ' like_theme="' + voting_theme_panel.find("select#bpvm_like_theme").val() + '"';

                }
                
                // Dislike Theme.
                
                if ( voting_theme_panel.find("#bpvm_dislike_theme").val().length !== 0) {
                
                    bpvm_shortcode += ' dislike_theme="' + voting_theme_panel.find("select#bpvm_dislike_theme").val() + '"';

                }
                 
             }
             
              bpvm_shortcode += " /]";
              
              window.send_to_editor(bpvm_shortcode); 

            $('#bwl_pvm_editor_overlay').remove();
            
            return false;
            
        });

        $('#closeShortCodebtn').click(function(event) {
            $('#bwl_pvm_editor_overlay').remove();
            return false;
        });
        
        custom_filter_items.addClass('bpvm_dn');
        voting_panel_items.removeClass('bpvm_dn');
        
         /*------------------------------ Single Posts ---------------------------------*/
        
        $('select#bpvm_post_items').add("multiple","multiple");
        
        $('select#bpvm_post_items').multipleSelect({
            placeholder: "- Select -",
            selectAll: true,
            filter: true
           
        });
        
        $('select#bpvm_post_items').multipleSelect("uncheckAll");
        
        
        interval_container.find("#bpvm_interval").on("keypress", function(evt){
            
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        });
        
        interval_container.find("#bpvm_limit").on("keypress", function(evt){
            
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
            
        });
        
 
    });
    
</script>

<h3><?php _e('BPVM Shortcode Editor', 'bwl-pro-voting-manager'); ?></h3>

<div id="bwl_pvm_editor_popup_content">
    
    <div class="row">
        
        <label for="custom_selection"><?php _e('Selection Type', 'bwl-pro-voting-manager'); ?></label>
        
        <input type="radio" name="custom_selection" class="custom_selection" value="1" checked="checked"/>Voting Panel&nbsp;
        <input type="radio" name="custom_selection" class="custom_selection" value="2"/>Custom Filter
        
    </div>
    
    <hr class="bpvm-shortcode-seperator"/>
    
    <div class="row post_type_container">
        <label for="bpvm_post_type"><?php _e('Post Type', 'bwl-pro-voting-manager'); ?></label>
        <select id="bpvm_post_type" name="bpvm_post_type">
            <option value="" selected>- <?php _e('Select', 'bwl-pro-voting-manager'); ?> -</option>
            <?php
            $available_bpvm_post_types = bpvm_get_widget_custom_post_types();

            foreach ($available_bpvm_post_types as $bpvm_post_type_key => $bpvm_post_type_value) :

                $bpvm_post_type_value = strtolower($bpvm_post_type_value);

                $bpvm_post_type_title = ucfirst(str_replace('_', ' ', $bpvm_post_type_value));
            ?>
                <option value="<?php echo $bpvm_post_type_value; ?>"><?php echo $bpvm_post_type_title; ?></option>
             <?php
                endforeach;
                ?>
              <option value="post-format-gallery"><?php _e('Gallery posts', 'bwl-pro-voting-manager'); ?></option>
        </select>
    </div>
    
    <div class="row thumbnail_container">
        
        <label for="bpvm_thumbnail_filter"><?php _e('Display Thumbnail', 'bwl-pro-voting-manager')?></label>
        <input type="checkbox" id="bpvm_thumbnail_filter" name="bpvm_thumbnail_filter" value="1" class="bpvm_checkbox"/>
        
    </div> <!-- end row  -->
    
    <div class="row date_filter_container">
        
        <label for="bpvm_date_filter"><?php _e('Day Filter', 'bwl-pro-voting-manager')?></label>
        <input type="checkbox" id="bpvm_date_filter" name="bpvm_date_filter" value="1" class="bpvm_checkbox"/>
        
    </div> <!-- end row  -->
    
    <div class="row interval_container">
        <label for="bpvm_interval"><?php _e('Day Interval','bwl-pro-voting-manager'); ?></label>
        <input type="text" id="bpvm_interval" name="bpvm_interval" value="" size="3" style="width: 100px;"/> <small>i.e: Set value 30 for last 30 days posts.</small>
    </div>
    
    <div class="row limit_container">
        <label for="bpvm_limit"><?php _e('Post Display Limit','bwl-pro-voting-manager'); ?></label>
        <input type="text" id="bpvm_limit" name="bpvm_limit" value="" size="3" style="width: 100px;"/> <small>i.e: Set value 5 for display 5 posts.</small>
    </div>
    
    <div class="row orderby_container">
        <label for="bpvm_orderby"><?php _e('Order By', 'bwl-pro-voting-manager'); ?></label>
        <select id="bpvm_orderby" name="orderby">
            <option value="" selected>- <?php _e('Select', 'bwl-pro-voting-manager'); ?> -</option>
            <option value="liked"><?php _e('Liked', 'bwl-pro-voting-manager'); ?></option>
            <option value="disliked"><?php _e('Disliked', 'bwl-pro-voting-manager'); ?></option>
        </select>
    </div>

    <div class="row animation_container">
        
        <label for="bpvm_animation"><?php _e('Voting Bar Animation', 'bwl-pro-voting-manager')?></label>
        <input type="checkbox" id="bpvm_animation" name="bpvm_animation" value="1" class="bpvm_checkbox" checked="checked"/>
        
    </div> <!-- end row  -->
    
    <?php 
    
        $bpvm_voting_themes = array(
            'animated_red_theme' => __('Red Theme', 'bwl-pro-voting-manager'),
            'animated_blue_theme' => __('Blue Theme', 'bwl-pro-voting-manager'),
            'animated_green_theme' => __('Green Theme', 'bwl-pro-voting-manager'),
            'animated_orange_theme' => __('Orange Theme', 'bwl-pro-voting-manager'),
            'animated_pink_theme' => __('Pink Theme', 'bwl-pro-voting-manager'),
            'animated_yellow_theme' => __('Yellow Theme', 'bwl-pro-voting-manager'),
            'animated_yellow_green_theme' => __('Yellow Green Theme', 'bwl-pro-voting-manager'),
            'animated_brown_theme' => __('brown Theme', 'bwl-pro-voting-manager'),
            'animated_chocolate_theme' => __('Chocolate Theme', 'bwl-pro-voting-manager'),
            'animated_crimson_theme' => __('Crimson Theme', 'bwl-pro-voting-manager'),
        );
    ?>
    
    <div class="row like_theme_container">
        <label for="bpvm_like_theme"><?php _e('Like Bar Theme', 'bwl-pro-voting-manager'); ?></label>
        <select id="bpvm_like_theme" name="bpvm_like_theme">
            <option value="" selected>- <?php _e('Select', 'bwl-pro-voting-manager'); ?> -</option>
            <?php foreach( $bpvm_voting_themes as $like_voting_theme_key=> $like_voting_theme_value ) : ?>
                <option value="<?php echo $like_voting_theme_key; ?>"><?php echo $like_voting_theme_value; ?></option>
            <?php endforeach;?>
        </select>
    </div>
    
    <div class="row dislike_theme_container">
        <label for="bpvm_dislike_theme"><?php _e('Dislike Bar Theme', 'bwl-pro-voting-manager'); ?></label>
        <select id="bpvm_dislike_theme" name="bpvm_dislike_theme">
            <option value="" selected>- <?php _e('Select', 'bwl-pro-voting-manager'); ?> -</option>
            <?php foreach( $bpvm_voting_themes as $dislike_voting_theme_key=> $dislike_voting_theme_value ) : ?>
                <option value="<?php echo $dislike_voting_theme_key; ?>"><?php echo $dislike_voting_theme_value; ?></option>
            <?php endforeach;?>
        </select>
    </div>
    
    <div id="bwl_pvm_editor_popup_buttons">
        <input id="addShortCodebtn" name="addShortCodebtn" class="button-primary" type="button" value="Insert" />
        <input id="closeShortCodebtn" name="closeShortCodebtn" class="button" type="button" value="Close" />
    </div>

</div>