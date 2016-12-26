<?php if ( of_get_option('mgm_third_sidebar') == 'widgetized' ) {
	
	
	/* Third Widgetized Area */
	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Right')) :  
	endif;
	
	} else {
	
	/* Regular Sidebar */
	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar')): 
	endif;
	
} ?>
