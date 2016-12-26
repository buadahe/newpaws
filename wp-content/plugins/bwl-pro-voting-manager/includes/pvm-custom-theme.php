<?php


if( !function_exists('pvm_custom_theme')) {
        
    
    function pvm_custom_theme() {
        
        /*------------------------------  Default Settings ---------------------------------*/
        $pvm_like_bar_color = '#559900';
        $pvm_dislike_bar_color = '#C9231A';
        $pvm_like_thumb_color= '#559900';
        $pvm_dislike_bar_color = '#C9231A';
        
        
        $pvm_data = get_option('bwl_pvm_options');
        
        
        $custom_theme = '<style type="text/css">';
        
        // Like Bar Color.
        
        if( isset( $pvm_data['pvm_like_bar_color'] ) && $pvm_data['pvm_like_bar_color']!="" ) {
            
            $pvm_like_bar_color = $pvm_data['pvm_like_bar_color'];            
            $custom_theme .= '.bg-green{ background-color: ' . $pvm_like_bar_color .';}';
            
        }
        
        // Dislike Bar Color.
        
        if( isset( $pvm_data['pvm_dislike_bar_color'] ) && $pvm_data['pvm_dislike_bar_color']!="" ) {
            $pvm_dislike_bar_color = $pvm_data['pvm_dislike_bar_color'];
            $custom_theme .= '.bg-red{ background-color: ' . $pvm_dislike_bar_color .';}';
        }
        
        // Like Button Thumb Color.
        
        if( isset( $pvm_data['pvm_like_thumb_color'] ) && $pvm_data['pvm_like_thumb_color']!="" ) {
            
            $pvm_like_thumb_color= $pvm_data['pvm_like_thumb_color'];            
            $custom_theme .= '.btn_like{ color: ' . $pvm_like_thumb_color .';}';
            $custom_theme .= '.icon_like_color{ color: ' . $pvm_like_thumb_color .';}';
            
        }
        
        // Dislike Button Text Color.
        
        if( isset( $pvm_data['pvm_dislike_thumb_color'] ) && $pvm_data['pvm_dislike_thumb_color']!="" ) {
            $pvm_dislike_thumb_color = $pvm_data['pvm_dislike_thumb_color'];
            $custom_theme .= '.btn_dislike{ color: ' . $pvm_dislike_thumb_color .';}';
            $custom_theme .= '.icon_dislike_color{ color: ' . $pvm_dislike_thumb_color .';}';
        }
        
        
        /*------------------------------ Tipsy ---------------------------------*/
        
        $pvm_tipsy_bg = "#000000";
        $pvm_tipsy_text_color = "#FFFFFF";
        
        if( isset( $pvm_data['pvm_tipsy_bg'] ) && $pvm_data['pvm_tipsy_bg']!="" ) {
            $pvm_tipsy_bg = $pvm_data['pvm_tipsy_bg'];
        }
        
        if( isset( $pvm_data['pvm_tipsy_text_color'] ) && $pvm_data['pvm_tipsy_text_color']!="" ) {
            $pvm_tipsy_text_color = $pvm_data['pvm_tipsy_text_color'];
        }
        
        $custom_theme .= '.tipsy-inner{ background: ' . $pvm_tipsy_bg .'; color: ' . $pvm_tipsy_text_color .';}';
        
        /*---------------------------- Custom CSS -----------------------------------*/
        
        $pvm_custom_css = "";
        
        if( isset( $pvm_data['pvm_custom_css'] ) && $pvm_data['pvm_custom_css']!="" ) {
            $pvm_custom_css = $pvm_data['pvm_custom_css'];
        }
        
        $custom_theme .= $pvm_custom_css;
        
        
        $custom_theme .= '</style>';
        
        
        echo $custom_theme;
        
    }
    
    
    add_action('wp_head', 'pvm_custom_theme');
    
}

?>
