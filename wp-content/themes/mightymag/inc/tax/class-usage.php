<?php
/*
Plugin Name: Mgm Tax meta class
Plugin URI: http://en.bainternet.info
Description: Tax meta class usage demo
Version: 1.2
Author: Bainternet, Ohad Raz
Author URI: http://en.bainternet.info
*/

//include the main class file
require_once("tax-meta-class/tax-meta-class.php");

if (is_admin()){

	$prefix = 'mgm_';

	$config = array(
		'id' => 'demo_meta_box',					// meta box id, unique per meta box
		'title' => 'Demo Meta Box',					// meta box title
		'pages' => array('category'),				// taxonomy name, accept categories, post_tag and custom taxonomies
		'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
		'fields' => array(),						// list of meta fields (can be added by field arrays)
		'local_images' => false,					// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true					//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
	
	
	/*
	 * Initiating meta boxes
	 */
	$my_meta =  new Tax_Meta_Class($config);
	
	/*
	 * Adding fields to meta boxes
	 */
	

	//Add Category Color
	$my_meta->addColor($prefix.'color_field_id',array(
		'name'=> __('Category Color', 'mightymag-admin' ),
		)
	);
	
	//Add Background Color
	$my_meta->addColor($prefix.'bg_field_id',array(
		'name'=> __('Background Color', 'mightymag-admin' ),
		)
	);
	
	//Add Background Image
	$my_meta->addImage($prefix.'image_field_id',array(
		'name'=> __('Background Image or Pattern', 'mightymag-admin' ),
		)
	);

	//Background position
	$my_meta->addSelect($prefix.'background_position',array(
		'tiled'=> __('Tiled', 'mightymag-admin' ),
		'static'=> __('Static', 'mightymag-admin' ),
		'fullscreen'=> __('CSS3 Full Screen', 'mightymag-admin' ),
		), array(
			'name'=> __('Background Position', 'mightymag-admin' ), 
			'std'=> array('tiled')
		)
	);
	
	//Add Header Background Image
	$my_meta->addImage($prefix.'image_header',array(
		'name'=> __('Header Background Image', 'mightymag-admin' ), 
		'desc' => __('', 'mightymag-admin' ),
		)
	);
	
	//Custom CSS
	$my_meta->addTextarea($prefix.'category_custom_css',array(
		'name'=> __('Custom CSS for this category', 'mightymag-admin' ),
		)
	);
	
	// Add Featured Slider
	$my_meta->addCheckbox($prefix.'featured_slider',array(
		'name'=> __('Enable Featured Slider', 'mightymag-admin' ),
		)
	);
	
	
	// Show posts in menu
	$my_meta->addCheckbox($prefix.'menu_posts',array(
		'name'=> __('Show Posts Previews in Main Menu', 'mightymag-admin' ),
		)
	);
	
	
	/*
	 * Closing up
	 */
	 
	//Finish Meta Box Decleration
	$my_meta->Finish();
}