<?php 
/*  
Plugin Name: Search In Place for MightyMag WP Theme
Plugin URI: http://wordpress.dwbooster.com/content-tools/search-in-place
Version: 1.0.3
Author: <a href="http://www.codepeople.net">CodePeople</a>
Description: Search in Place improves blog search by displaying query results in real time. Search in place displays a list with results dynamically as you enter the search criteria. Search in place groups search results by their type, labeling them as post, page, or attachment. To get started: 1) Click the "Activate" link to the left of this description.
*/



include 'php/live-search.class.php';

	//Initialize the admin panel 
	if (!function_exists("mgm_CodePeopleSearchInPlace_admin")) { 
		function mgm_CodePeopleSearchInPlace_admin() { 
			global $codepeople_search_in_place_obj; 
			if (!isset($codepeople_search_in_place_obj)) { 
				return; 
			} 
			if (function_exists('add_options_page')) { 
				//add_options_page('Search In Place', 'Search In Place', 'manage_options', basename(__FILE__), array(&$codepeople_search_in_place_obj, 'printAdminPage')); 
			} 
		}    
	}
	
	// Initialize the public website code
	if(!function_exists("mgm_CodePeopleSearchInPlace")){	
		function mgm_CodePeopleSearchInPlace(){
			global $codepeople_search_in_place_obj;
			
			if (is_admin ())
				return false;

			wp_enqueue_script('mgm-codepeople-search-in-place',get_template_directory_uri().'/inc/live-search/js/live-search.js', array('jquery')); /* djwd edit path */
			wp_localize_script('mgm-codepeople-search-in-place', 'codepeople_search_in_place', $codepeople_search_in_place_obj->javascriptVariables());
		}
	}	

$codepeople_search_in_place_obj = new mgm_CodePeopleSearchInPlace();
$codepeople_search_in_place_obj->init();

// Plugin activation and deactivation
register_activation_hook(__FILE__, array(&$codepeople_search_in_place_obj, 'activePlugin'));
register_deactivation_hook(__FILE__, array(&$codepeople_search_in_place_obj, 'deactivePlugin'));

$plugin = plugin_basename(__FILE__);
add_filter('plugin_action_links_'.$plugin, array(&$codepeople_search_in_place_obj, 'customizationLink'));
add_filter('plugin_action_links_'.$plugin, array(&$codepeople_search_in_place_obj, 'settingsLink'));

add_action('init', 'mgm_CodePeopleSearchInPlace');
add_action('admin_menu', 'mgm_CodePeopleSearchInPlace_admin');
add_action('wp_ajax_nopriv_search_in_place', array(&$codepeople_search_in_place_obj, 'populate'));
add_action('wp_ajax_search_in_place', array(&$codepeople_search_in_place_obj, 'populate'));
add_action('pre_get_posts', array(&$codepeople_search_in_place_obj, 'modifySearch'));


?>