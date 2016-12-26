<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {


	// Background Defaults
	$background_defaults = array(
		'color' => '#ffffff',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );
		
	// Header Background Defaults
	$background_header_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);
	
	// Yes/No Array
	$yesno_array = array(
		'true' => __('Yes', 'mightymag-admin'),
		'false' => __('No', 'mightymag-admin'),
	);

	// Social Share Multicheck Array
	$search_elements_array = array(
		'post_thumb' => __('Post Thumbnail', 'mightymag-admin'),
		'post_author' => __('Post Author', 'mightymag-admin'),
		'post_date' => __('Post Date', 'mightymag-admin'),
		'post_excerpt' => __('Post Excerpt', 'mightymag-admin'),
	);
	
	// Social Share Multicheck Array
	$social_share_array = array(
		'twitter_share' => __('Share on Twitter', 'mightymag-admin'),
		'google_share' => __('Google +1', 'mightymag-admin'),
		'fb_share' => __('Facebook Like', 'mightymag-admin'),
		'linkedin_share' => __('Linked In Share', 'mightymag-admin'),
		'pinit_share' => __('Pin it Button', 'mightymag-admin'),
		'stumble_share' => __('Stumble Upon Share', 'mightymag-admin'),
		//'instagram_share' => __('Instagram Share', 'mightymag-admin'),
		'reddit_share' => __('Reddit Share', 'mightymag-admin')
	);
	
	// Social Share Multicheck Defaults
	$social_share_defaults = array(
		'twitter_share' => '1',
		'google_share' => '1',
		'fb_share' => '1'
	);
	
	//Mixing Standard and Google Fonts Arrays (font arrays in admin/functions-extended/fn-typography.php)
	$typography_mixed_fonts = array_merge( mgm_get_os_fonts() , mgm_get_google_fonts() );
	asort($typography_mixed_fonts);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
		$options_categories['all'] = 'All Categories';
	}
	
	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/admin/options-core/images/';

	
	// OPTIONS

	$options = array();


	// Basics

	$options[] = array(
		'name' => __('Basic Settings', 'mightymag-admin'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Header Logo Upload', 'mightymag-admin'),
		'desc' => __('Select the image to use as logo.', 'mightymag-admin'),
		'id' => 'mgm_logo',
		'type' => 'upload');

/*	$options[] = array(
		'name' => __('Home Style', 'mightymag-admin'),
		'id' => 'mgm_homestyle',
		'std' => 'widgetized',
		'type' => 'select',
		'options' => array(
			'widgetized' => 'Widgetized Home (Magazine)',
			'classic' => 'Classic Blog' )
		);*/
		
	$options[] = array(
		'name' => __('Post Excerpts', 'mightymag-admin'),
		'id' => 'mgm_excerpt',
		'desc' => __('Select <em>More Tag</em> if you use the Wordpress --more-- tag for post excerpts, otherwise select <em>Auto Trim</em><strong><em> Notice: </strong>Please be aware that using Auto Trim will not output shortcodes in post excerpts.</em>', 'mightymag-admin'),
		'std' => 'autotrim',
		'class' => 'mini',
		'type' => 'select',
		'options' => array(
			'autotrim' => 'Auto Trim',
			'moretag' => 'More Tag')
		);
		
	$options[] = array(
		'name' => __('Words Count', 'mightymag-admin'),
		'id' => 'mgm_excerpt_count',
		'std' => '25',
		'class' => 'sub',
		'type' => 'range',
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'suffix' => 'words'
		);
		
	$options[] = array(
		'name' => __('Retina Support', 'mightymag-admin'),
		'id' => 'mgm_retina',
		'type' => 'checkbox',
		'std' => true,
		);	
		
/*	$options[] = array(
		'name' => __('Display Parent Category', 'mightymag-admin'),
		'desc' => __('Choose whether to show the parent category of a post or the end category (default) on post entries (e.g on archive pages and on blog style homepage)', 'mightymag-admin'),
		'id' => 'mgm_parentcat',
		'type' => 'images',
		'std' => 'end',
		"options" => 
		array (
			'parent' => $imagepath . 'cat_parent.png',
			'end' => $imagepath . 'cat_end.png',
			),
		);*/
		
$options[] = array( 
		'name' => __('Custom Favicon','mightymag-admin'),
		'desc' => __('Upload a 16px x 16px Png/Gif image to represent your website, this will be displayed right next to your address URL and as a bookmark icon.','mightymag-admin'),
		'id' => 'mgm_favicon',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Footer Logo Upload', 'mightymag-admin'),
		'desc' => __('Select the image to use as logo for the footer', 'mightymag-admin'),
		'id' => 'mgm_footer_logo',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Footer Credits', 'mightymag-admin'),
		'desc' => __('The text appearing at the bottom of the page. HTML is allowed.', 'mightymag-admin'),
		'id' => 'mgm_credits',
		'type' => 'textarea',
		'std' => 'MightyMag Magazine WP Theme by djwd. Remove this after purchase.',
		);
		
	// Single
		
	$options[] = array(
		'name' => __('Single', 'mightymag-admin'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Display Breadcrumb', 'mightymag-admin'),
		'desc' => __('Show breadcrumbs on top of post/pages headings', 'mightymag-admin'),
		'id' => 'mgm_breadcrumb',
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array(
		'name' => __('Display Related Posts', 'mightymag-admin'),
		'desc' => __('Show related posts (based on tags) at the bottom of a post', 'mightymag-admin'),
		'id' => 'mgm_related',
		'type' => 'checkbox',
		'std' => true,
	);
		
	$options[] = array(
		'name' => __('Related Posts Count', 'mightymag-admin'),
		'id' => 'mgm_related_count',
		'std' => '4',
		'class' => 'sub',
		'type' => 'range',
			'min' => '2',
			'max' => '8',
			'step' => '2',
			'suffix' => 'posts'
		);
		
	$options[] = array(
		'name' => __('Author Info', 'mightymag-admin'),
		'desc' => __('Show Author information after a post or review', 'mightymag-admin'),
		'id' => 'mgm_author',
		'std' => true,
		'type' => 'checkbox'
	);
		
	$options[] = array(
		'name' => __('Back To Top', 'mightymag-admin'),
		'desc' => __('Enable/Disable scroll to top button', 'mightymag-admin'),
		'id' => 'mgm_scrollup',
		'type' => 'checkbox',
		'std' => true
	);
		
	// Sidebars
	
	$options[] = array(
			'name' => __('Sidebars', 'mightymag-admin'),
			'type' => 'heading');		
			
	$options[] = array(
		'name' => __('Sidebar Position', 'mightymag-admin'),
		'desc' => __('Move the sidebar left or right', 'mightymag-admin'),
		'id' => 'mgm_sidebar_position',
		'type' => 'images',
		'std' => 'content-sidebar',
		'options' => array(
			'sidebar-content' => $imagepath . '2col-l.png',
			'content-sidebar' => $imagepath . '2col-r.png',
		)
	);
			
	$options[] = array(
			"name" => "Sidebar Generator",
			'desc' => __('Create sidebar for later use on pages and posts. If you need more control though, installing a plugin as <a href="https://wordpress.org/plugins/custom-sidebars/" target="_blank">Custom Sidebars</a> might be a better solution', 'mightymag-admin'),
			"id" => "mgm_sidebars",
			"std" => "",
			"type" => "sidebar");
			
	$options[] = array(
		'name' => __('Home Page Sidebar', 'mightymag-admin'),
		'desc' => __('Select whether to use the default sidebar or a third homepage widgetized area', 'mightymag-admin'),
		'id' => 'mgm_third_sidebar',
		'type' => 'select',
		'std' => 'widgetized',
		'options' => array(
			'widgetized' => 'Homepage Third Widgetized Area',
			'standard' => 'Default Sidebar',
		));
		
	$options[] = array(
		'name' => __('BuddyPress Sidebar', 'mightymag-admin'),
		'desc' => __('Select whether to use the default sidebar or the BuddyPress sidebar for BP pages', 'mightymag-admin'),
		'id' => 'mgm_bp_sidebar',
		'type' => 'select',
		'std' => 'standard',
		'options' => array(
			'buddypress_sidebar' => 'BuddyPress Sidebar',
			'standard' => 'Default Sidebar',
		));
		
	$options[] = array(
		'name' => __('BBpress Sidebar', 'mightymag-admin'),
		'desc' => __('Select whether to use the default sidebar or the BBpress sidebar for BBP pages', 'mightymag-admin'),
		'id' => 'mgm_bbpress_sidebar',
		'type' => 'select',
		'std' => 'standard',
		'options' => array(
			'bbpress_sidebar' => 'BBpress Sidebar',
			'standard' => 'Default Sidebar',
		));
		
	$options[] = array(
		'name' => __('WooCommerce Sidebar', 'mightymag-admin'),
		'desc' => __('Select whether to use the default sidebar, the WooCommerce sidebar for shop pages or none at all', 'mightymag-admin'),
		'id' => 'mgm_woo_sidebar',
		'type' => 'select',
		'std' => 'standard',
		'options' => array(
			'woocommerce_sidebar' => 'WooCommerce Sidebar',
			'standard' => 'Default Sidebar',
			'none' => 'No Sidebar',
		));
		
	$options[] = array(
		'name' => __('Blog Page Sidebar', 'mightymag-admin'),
		'desc' => __('Select whether to display the sidebar for the blog page or not', 'mightymag-admin'),
		'id' => 'mgm_blog_sidebar',
		'type' => 'checkbox',
		'std' => true,
		);
		

	// News Ticker

	$options[] = array(
		'name' => __('News Ticker', 'mightymag-admin'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Enable Latest Posts News Ticker', 'mightymag-admin'),
		'desc' => __('Show the news ticker in header section after slider/navigation', 'mightymag-admin'),
		'id' => 'mgm_ticker',
		'std' => false,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Title', 'powermag'),
		'std' => 'Not To Miss',
		'id' => 'mgm_ticker_title',
		'class' => 'sub',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Ticker Category', 'mightymag-admin'),
		'id' => 'mgm_ticker_cat',
		'std' => '1',
		'type' => 'select',
		'class' => 'sub',
		'options' => $options_categories
		);

	$options[] = array(
		'name' => __('Where to display', 'mightymag-admin'),
		'id' => 'mgm_ticker_where',
		'std' => 'all',
		'type' => 'select',
		'class' => 'sub',
		'options' => array(
			'home' => 'On the homepage only',
			'all' => 'Everywhere',
		));

	$options[] = array(
		'name' => __('News Ticker Post Count', 'mightymag-admin'),
		'id' => 'mgm_ticker_count',
		'std' => '6',
		'class' => 'sub',
		'type' => 'range',
			'min' => '1',
			'max' => '25',
			'step' => '1',
			'suffix' => 'posts'
		);
		
	$options[] = array(
		'name' => __('Enable Latest Products Ticker', 'mightymag-admin'),
		'desc' => __('Show the latest products added, ignore this if not using WooCommerce', 'mightymag-admin'),
		'id' => 'mgm_wc_ticker',
		'std' => false,
		'type' => 'checkbox');

	// Sliders

$options[] = array(
	'name' => __('Sliders', 'mightymag-admin'),
	'type' => 'heading');
	

	$options[] = array(
		'name' => __('Post Count', 'mightymag-admin'),
		'id' => 'mgm_slider_1_count',
		'std' => '4',
		'type' => 'range',
			'min' => '1',
			'max' => '20',
			'step' => '1',
			'suffix' => 'posts'
			);
			
	$options[] = array(
		'name' => __('Excerpt Words Count', 'mightymag-admin'),
		'id' => 'mgm_slider_1_words',
		'std' => '18',
		'type' => 'range',
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'suffix' => 'words'
			);
			
	$options[] = array(
		'name' => __('Starting Slide', 'mightymag-admin'),
		'id' => 'mgm_slider_1_start',
		'std' => '0',
		'type' => 'range',
			'min' => '0',
			'max' => '20',
			'step' => '1',
			'suffix' => 'slide'
		);
			
	$options[] = array(
		'name' => __('Animation', 'mightymag-admin'),
		'id' => 'mgm_slider_1_animation',
		'std' => 'slide',
		'class' => 'mini',
		'type' => 'select',
		'options' => array(
			'slide' => 'Slide',
			'fade' => 'Fade' )
		);
			
	$options[] = array(
		'name' => __('Direction', 'mightymag-admin'),
		'id' => 'mgm_slider_1_direction',
		'std' => 'vertical',
		'class' => 'mini',
		'type' => 'select',
		'options' => array(
			'vertical' => 'Vertical',
			'horizontal' => 'Horizontal' )
		);

	$options[] = array(
		'name' => __('SlideShow Speed', 'mightymag-admin'),
		'id' => 'mgm_slider_1_slide_speed',
		'std' => '7000',
		'type' => 'range',
			'min' => '1000',
			'max' => '9999',
			'step' => '100',
			'suffix' => 'milliseconds'
		);
		
	$options[] = array(
		'name' => __('Animation Speed', 'mightymag-admin'),
		'id' => 'mgm_slider_1_anim_speed',
		'std' => '600',
		'type' => 'range',
			'min' => '200',
			'max' => '2000',
			'step' => '100',
			'suffix' => 'milliseconds'
		);
	
	/* Grid @since MGM 1.6 */
		
	$options[] = array(
		'name' => __('Grid Offset', 'mightymag-admin'),
		'id' => 'mgm_grid_offset_method',
		'desc' => '<em>Offset</em> is the number of post to displace or pass over, mainly set to avoid posts duplication with the slider',
		'std' => 'automatic',
		'class' => 'mini',
		'type' => 'select',
		'options' => array(
			'automatic' => 'Automatic',
			'manual' => 'Manual' )
		);
		
	$options[] = array(
		'name' => __('Offset', 'mightymag-admin'),
		'id' => 'mgm_grid_offset_manual',
		'std' => '4',
		'class' => 'hidden sub',
		'type' => 'range',
			'min' => '0',
			'max' => '20',
			'step' => '1',
			'suffix' => 'posts'
		);
		
	$options[] = array(
		'name' => __('Grid Category', 'mightymag-admin'),
		'id' => 'mgm_grid_cat',
		'std' => '1',
		'type' => 'select',
		'options' => $options_categories
		);
		
	
		
		
	//Live Search
	
	$options[] = array(
		'name' => __('Live Search', 'mightymag-admin'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Minimum Characters to Begin Search', 'mightymag-admin'),
		'id' => 'mgm_search_minchars',
		'std' => '3',
		'type' => 'range',
			'min' => '0',
			'max' => '25',
			'step' => '1',
			'suffix' => 'chars'
		);
		
	$options[] = array(
		'name' => __('Elements to display', 'mightymag-admin'),
		'id' => 'mgm_search_elements',
		'std' => $social_share_defaults,
		'type' => 'multicheck',
		'options' => $search_elements_array
		);
		
	$options[] = array(
		'name' => __('Post Excerpt Chars Count', 'mightymag-admin'),
		'id' => 'mgm_search_charscount',
		'std' => '20',
		'type' => 'range',
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'suffix' => 'chars'
		);
		
		
	// Socials
		
	$options[] = array(
			'name' => __('Social Media', 'mightymag-admin'),
			'type' => 'heading');
			
	$options[] = array( 
			"name" => "Enable Post Sharing Buttons",
			'desc' => __('Enables/Disables sharing buttons on posts', 'mightymag-admin'),
			"id" => "mgm_social_share_switch",
			"type" => "checkbox",
			"std" => true,
		);

	$options[] = array(
			'name' => __('Social Share', 'mightymag-admin'),
			'desc' => __('Select which sharing buttons to display', 'mightymag-admin'),
			'id' => 'mgm_social_share',
			'class' => 'sub',
			'std' => $social_share_defaults,
			'type' => 'multicheck',
			'options' => $social_share_array);
			
	$options[] = array(
			'name' => __('Position', 'mightymag-admin'),
			'desc' => __('Select where to display the sharing buttons', 'mightymag-admin'),
			'id' => 'mgm_social_share_position',
			'class' => 'sub mini',
			'std' => 'top',
			'type' => 'select',
			'options' => array(
				'top' => 'Top',
				'bottom' => 'Bottom',
				'both' => 'Both')
		);
			
	$options[] = array( 
			'name' => __('Facebook Comment Moderation', "mightymag"),
			'desc' => __('Fill out the URLs for the social icons you want to appear on the very top of the site', 'mightymag-admin'),
			'type' => 'info',
		);
		
	$options[] = array(
			"name" => "Vimeo URL",
			"id" => "mgm_sm_vimeo",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "Google Plus URL",
			"id" => "mgm_sm_gplus",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "FeedBurner URL",
			"id" => "mgm_sm_rss",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "Facebook URL",
			"id" => "mgm_sm_facebook",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "Instagram URL",
			"id" => "mgm_sm_instagram",
			"type" => "text",
			"class"=> "sub",
			"std" => ""
	);
			
	$options[] = array( 
			"name" => "Twitter URL",
			"id" => "mgm_sm_twitter",
			"type" => "text",
			"class" => "sub",
			"std" => "Your Twitter URL"
		);
			
	$options[] = array( 
			"name" => "Delicious URL",
			"id" => "mgm_sm_delicious",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "YouTube URL",
			"id" => "mgm_sm_youtube",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "Flickr URL",
			"id" => "mgm_sm_flickr",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "Digg URL",
			"id" => "mgm_sm_digg",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "Linked In URL",
			"id" => "mgm_sm_linkedin",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "Deviant Art URL",
			"id" => "mgm_sm_deviant",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "Dribbble URL",
			"id" => "mgm_sm_dribbble",
			"type" => "text",
			"class" => "sub",
		);
			
	$options[] = array( 
			"name" => "Tumblr URL",
			"id" => "mgm_sm_tumblr",
			"type" => "text",
			"class" => "sub",
		);
			
/*	$options[] = array( 
			"name" => "Forrst URL",
			"id" => "mgm_sm_forrst",
			"type" => "text",
			"class" => "sub",
		);*/
			
	$options[] = array( 
			'name' => __('Facebook Comment Moderation', "mightymag"),
			'desc' => __('Fill out the following information to allow FB comments moderation', 'mightymag-admin'),
			'type' => 'info',
		);
			
	$options[] = array(
			'name' => __('Facebook Comments USER ID', 'powermag'),
			'desc' => __('Enter your USER ID', 'powermag'),
			'id' => 'mgm_fb_userid',
			'type' => 'text',
			"class" => "sub",
	);
	
	$options[] = array(
			'name' => __('Facebook Comments APP ID', 'powermag'),
			'desc' => __('Enter your APP ID', 'powermag'),
			'id' => 'mgm_fb_appid',
			'type' => 'text',
			"class" => "sub",
	);


// Ads
	
	$options[] = array(
		'name' => __('Ads', 'mightymag-admin'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Top Ad Code', 'mightymag-admin'),
		'desc' => __('Insert Advertising Code (E.g Google Adsense Code)', 'mightymag-admin'),
		'id' => 'mgm_ad_top',
		'std' => '',
		'type' => 'textarea');

		$options[] = array(
				'name' => __('Hide on Small Devices?', 'mightymag-admin'),
				'desc' => __('Enable this not to show the top banner on portable devices.', 'mightymag-admin'),
				'id' => 'mgm_ad_top_mobiles',
				'type' => 'checkbox',
				'class' => 'sub',
				'std' => false,
			);		

	$options[] = array(
		'name' => __('Middle Ad Code', 'mightymag-admin'),
		'desc' => __('Insert Advertising Code (E.g Google Adsense Code)', 'mightymag-admin'),
		'id' => 'mgm_ad_middle',
		'std' => '',
		'type' => 'textarea');
		
		$options[] = array(
			'name' => __('Show on:', 'mightymag-admin'),
			'id' => 'mgm_ad_middle_display',
			'std' => 'all',
			'type' => 'select',
			'class' => 'sub',
			'options' => array(
				'home' => 'HomePage',
				'all' => 'Everywhere',
				'nothome' => 'Everywhere but homepage' )
			);
		
		
		$options[] = array(
				'name' => __('Hide on Small Devices?', 'mightymag-admin'),
				'desc' => __('Enable this not to show the top banner on portable devices.', 'mightymag-admin'),
				'id' => 'mgm_ad_middle_mobiles',
				'type' => 'checkbox',
				'class' => 'sub',
				'std' => false,
			);	

	$options[] = array( //afrgun
		'name' => __('Middle second Ad Code', 'mightymag-admin'),
		'desc' => __('Insert Advertising Code (E.g Google Adsense Code)', 'mightymag-admin'),
		'id' => 'mgm_ad_middle_second',
		'std' => '',
		'type' => 'textarea');
		
		$options[] = array( //afrgun
			'name' => __('Show on:', 'mightymag-admin'),
			'id' => 'mgm_ad_middle_display_second',
			'std' => 'all',
			'type' => 'select',
			'class' => 'sub',
			'options' => array(
				'home' => 'HomePage',
				'all' => 'Everywhere',
				'nothome' => 'Everywhere but homepage' )
			);
		
		$options[] = array( //afrgun
				'name' => __('Hide on Small Devices?', 'mightymag-admin'),
				'desc' => __('Enable this not to show the top banner on portable devices.', 'mightymag-admin'),
				'id' => 'mgm_ad_middle_mobiles_second',
				'type' => 'checkbox',
				'class' => 'sub',
				'std' => false,
			);


	// Backgrounds

	$options[] = array(
		'name' => __('Backgrounds', 'mightymag-admin'),
		'type' => 'heading');
		
	$options[] = array(
		'name' =>  __('Set a Background color or Pattern', 'mightymag-admin'),
		'desc' => __('Change the background color or upload a pattern', 'mightymag-admin'),
		'id' => 'mgm_bg',
		'std' => $background_defaults,
		'type' => 'background' );
		
	$options[] = array(
		'name' =>  __('Full Page Background', 'mightymag-admin'),
		'desc' => __('Set a full page background image', 'mightymag-admin'),
		'id' => 'mgm_full_bg',
		'type' => 'upload' );
		
		$options[] = array( 
			"name" => __("Make the Background an Ad", "mightymag"),
			"desc" => __('Enter an URL to link the background (E.g. for advertising purposes), otherwise leave empty.', 'mightymag-admin'),
			"id" => "mgm_wall_ad",
			"type" => "text",
			"class" => "sub",
			"std" => "");

			
	$options[] = array(
		'name' => __('Header Background', 'mightymag-admin'),
		'desc' => __('Allows to set a background image or a fixed custom color for the header (logo area)', 'mightymag-admin'),
		'id' => 'mgm_bg_header',
		'std' => $background_header_defaults,
		'type' => 'background' );
			
	$options[] = array(
		"name" => "Navigation Background",
	    "id" => "mgm_color_navigation",
		"desc" => "Set your background color for the navigation",
	    "std" => "#333333",
	    "type" => "color" );
			
	$options[] = array(
		'name' => __('Header / Container Style', 'mightymag-admin'),
		'id' => 'mgm_boxed',
		'std' => 'boxed',
		'type' => 'select',
		'options' => array(
			'free' => 'Minimal Unboxed',
			'boxed' => 'Boxed' )
		);
	
		$options[] = array(
			'name' =>  __('Background color', 'mightymag-admin'),
			'desc' => __('Set a Background color for the inner container', 'mightymag-admin'),
			'id' => 'mgm_boxed_bg',
			'class' => 'sub',
			'std' => '#ffffff',
			'type' => 'color' );
			
/*	$options[] = array( //TO REVIEW
		'name' => __('Entries Style', 'mightymag-admin'),
		'id' => 'mgm_entries_style',
		'std' => 'default',
		'type' => 'images',
		'options' => array(
			'default' => $imagepath . 'entry_default.png',
			'alternative' => $imagepath . 'entry_alternative.png',
			)
		);*/
			
			
	// Colors

	$options[] = array(
		'name' => __('Style', 'mightymag-admin'),
		'type' => 'heading');
		
	$options[] = array(
		"name" => "GrayScale Effect On Images",
	    "id" => "mgm_grayscale",
	    "std" => false,
	    "type" => "checkbox" );
		
	$options[] = array(
		"name" => "Text Color",
		"id" => "mgm_color_primary_body",
		"std" => "#686868",
		"type" => "color" );
		
	$options[] = array(
		"name" => "Links Color",
		"id" => "mgm_color_primary_link",
		"std" => "#555555",
		"type" => "color" );
		
	$options[] = array(
		"name" => "Links Hover Color",
		"id" => "mgm_color_primary_hover",
		"std" => "#1e73be",
		"type" => "color" );

			
	$options[] = array(
		"name" => "Skin Color",
	    "id" => "mgm_color_skin",
		"desc" => __('Set your skin color and the color of text and links on this background', 'mightymag-admin'),
	    "std" => "#00aced",
	    "type" => "color" );
		
		$options[] = array(
			"name" => "Text Color",
			"id" => "mgm_color_skin_body",
			"class" => "sub",
			"std" => "#ffffff",
			"type" => "color" );
		
		$options[] = array(
			"name" => "Links Color",
			"id" => "mgm_color_skin_link",
			"class" => "sub",
			"std" => "#ffffff",
			"type" => "color" );
			
		$options[] = array(
			"name" => "Links Hover Color",
			"id" => "mgm_color_skin_hover",
			"class" => "sub",
			"std" => "#eaeaea",
			"type" => "color" );

			
	$options[] = array(
		"name" => "Secondary Color",
	    "id" => "mgm_color_secondary",
		"desc" => __('Set your secondary color and the color of text and links on this background', 'mightymag-admin'),
	    "std" => "#f9f9f9",
	    "type" => "color" );
		
		$options[] = array(
			"name" => "Text Color",
			"id" => "mgm_color_secondary_body",
			"class" => "sub",
			"std" => "#686868",
			"type" => "color" );
		
		$options[] = array(
			"name" => "Links Color",
			"id" => "mgm_color_secondary_link",
			"class" => "sub",
			"std" => "#555555",
			"type" => "color" );
			
		$options[] = array(
			"name" => "Links Hover Color",
			"id" => "mgm_color_secondary_hover",
			"class" => "sub",
			"std" => "#1e73be",
			"type" => "color" );
			
	$options[] = array(
		"name" => "Borders Style",
	    "id" => "mgm_border_style",
		"desc" => __('Set your borders style', 'mightymag-admin'),
	    "std" => "dotted",
	    "type" => "select",
		"options" =>
			array (
				'dotted' => 'Dotted (default)',
				'solid' => 'Solid',
			)
		);
		
	$options[] = array(
		"name" => "Borders Alpha",
	    "id" => "mgm_border_alpha",
		"desc" => __("Set <em>lighter</em> if your blog have dark colors, <em>darker</em> for light color palettes", 'mightymag-admin'),
	    "std" => "darker",
	    "type" => "select",
		"options" =>
			array (
				'darker' => 'Darker',
				'lighter' => 'Lighter',
			)
		);

			
	// Typography 
	
	$options[] = array(
		'name' => __('Typography', 'mightymag-admin'),
		'type' => 'heading');
		
	$options[] = array( 
		'name' => __('Enable Custom Typography Styles', "mightymag"),
		'desc' => __('Enable the use of custom typography for your site', "mightymag"),
		'id' => 'mgm_enable_styles',
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array( 
		'name' => __('Headings', 'mightymag-admin'),
		'id' => 'mgm_headings_font',
		'std' => array('face' => 'Oswald'),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts,
			'styles' => false,
			'color' => false,
			'sizes' => array( '10','11','12','13', '14', '15', '16', '17', '18') )
		);
		
	$options[] = array( 
		'name' => __('Body Font', "mightymag"),
		'desc' => __('Select the body font and its base size. Since font sizes are specified with relative values, all other sizes will change accordingly', 'mightymag-admin'),
		'type' => 'info',
		);
		
	$options[] = array( 
		'name' => __('Face', "mightymag"),
		'id' => 'mgm_body_font',
		'std' => array( 'face' => 'PT Sans', 'sizes' => '12'),
		'type' => 'typography',
		'class' => 'sub',
		'options' => array(
			'faces' => $typography_mixed_fonts,
			'sizes' => array( '10','11','12','13', '14', '15', '16', '17', '18'),
			'styles' => false,
			'color' => false )
		);

	$options[] = array(
		'name' => __('Base Size', 'mightymag-admin'),
		'id' => 'mgm_font_size',
		'std' => '12',
		'class' => 'sub',
			'type' => 'range',
			'min' => '8',
			'max' => '22',
			'step' => '1',
			'suffix' => 'px'
		);
		
	// Collapsibles
	
	$options[] = array(
		'name' => __('Header Buttons', 'mightymag-admin'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Enable Header Buttons', 'mightymag-admin'),
		"desc" => __("Enable collapsible header functionalities", 'mightymag-admin'),
		'id' => 'mgm_header_buttons',
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array(
		'name' => __('Insert Newsletter Box', 'mightymag-admin'),
		'id' => 'mgm_collapsible_newsletter',
		'type' => 'checkbox',
		'std' => true,
		);
			
		$options[] = array(
			'name' => __('Insert Newsletter Box', 'mightymag-admin'),
			'id' => 'mgm_collapsible_nl_catch',
			'type' => 'textarea',
			'class' => 'sub',
			'std' => __('// Join our awesome newsletter! <small>* You can also place any other content here</small>','mightymag-admin'),
			);
			
		$options[] = array(
			'name' => __('MailChimp URL', 'mightymag-admin'),
			'desc' => __('<strong>Example: </strong>http://yourdomain.us5.list-manage.com/subscribe/post?u=f05988bb168246549b08542d68&id=8acf9edf41', 'mightymag-admin'),
			'id' => 'mgm_collapsible_nl_action',
			'class' => 'sub',
			'std' => '',
			'type' => 'text');
			
		$options[] = array(
			'name' => __('MailChimp Name Code', 'mightymag-admin'),
			'desc' => __('Enter here the "name" code. <a href="' . get_stylesheet_directory_uri(). '/admin/options-core/images/mailchimp_help.png">Click here for a helpful screenshot</a> (Alt+click to open in an new page)', 'mightymag-admin'),
			'id' => 'mgm_collapsible_nl_name',
			'class' => 'sub',
			'std' => '',
			'type' => 'text');
			
	$options[] = array(
		'name' => __('Insert Login / Register Box', 'mightymag-admin'),
		'id' => 'mgm_collapsible_login',
		'desc' => __('To make the login button/box appear, move to <strong>Appereance > Widgets</strong> and drag the <strong>MightyMag - Login Widget</strong> into the <em>Login Sidebar</em>', 'mightymag-admin'),
		'type' => 'info',
		'std' => true,
		);
			
	$options[] = array(
		'name' => __('Insert Custom Content', 'mightymag-admin'),
		'id' => 'mgm_collapsible_custom',
		'type' => 'checkbox',
		'std' => true,
		);
		
		$options[] = array(
			'name' => __('Custom Content', 'mightymag-admin'),
			'desc' => __('', 'mightymag-admin'),
			'id' => 'mgm_collapsible_custom_textarea',
			'class' => 'sub',
			'std' => 'Hidden Custom Content Goes Here',
			'type' => 'textarea'
			);
			
		$options[] = array(
			'name' => __('Custom Icon Tooltip', 'mightymag-admin'),
			'desc' => __('Enter the text to show when hovering the icon, leave blank not to show.', 'mightymag-admin'),
			'id' => 'mgm_collapsible_custom_tooltip',
			'class' => 'sub',
			'std' => 'Custom&nbsp;Tooltip',
			'type' => 'text'
			);
			
			
	// Miscellaneous
	
	$options[] = array(
		'name' => __('Miscellaneous', 'mightymag-admin'),
		'type' => 'heading');

	$options[] = array( /* @since MGM 1.4 */
		'name' => __('Show Page Views', 'mightymag-admin'),
		'id' => 'mgm_pageviews',
		'desc' => __('Enable/disable page views throughout the site', 'mightymag-admin'),
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array(
		'name' => __('Show Comments Count', 'mightymag-admin'),
		'id' => 'mgm_commentscount',
		'desc' => __('Enable/disable comments count throughout the site', 'mightymag-admin'),
		'type' => 'checkbox',
		'std' => true,
		);
		

	$options[] = array(
		'name' => __('Sticky Navigation', 'mightymag-admin'),
		'id' => 'mgm_stickynav',
		'desc' => __('Enable/disable sticky navigation upon scrolling', 'mightymag-admin'),
		'type' => 'checkbox',
		'std' => false,
		);
		
	$options[] = array(
		'name' => __('Remove WP Top Bar', 'mightymag-admin'),
		'id' => 'mgm_wptopbar',
		'desc' => __('Disables the default Wordpress top bar for all users except admins', 'mightymag-admin'),
		'type' => 'checkbox',
		'std' => false,
		);

	$options[] = array(
		'name' => __('Animate Content In', 'mightymag-admin'),
		'desc' => __('Enable Content Animations as they load and enter the viewport', 'mightymag-admin'),
		'id' => 'mgm_animations',
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array(
		'name' => __('Enable Ajax Comments (no page reload)', 'mightymag-admin'),
		'desc' => __('Please be aware this is only appliable to default WP Comments', 'mightymag-admin'),
		'id' => 'mgm_ajax_comments',
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array(
		'name' => __('Comments Per Page', 'mightymag-admin'),
		'id' => 'mgm_ajax_comments_per_page',
		'std' => '800',
		'class' => 'sub',	
		'type' => 'range',
			'min' => '1',
			'max' => '50',
			'step' => '1',
			'suffix' => 'comments'
		);
		
	$options[] = array(
		'name' => __('Enable Jackbox Lightbox', 'mightymag-admin'),
		'desc' => __('Disable this if you are using other galleries/lightbox plugins', 'mightymag-admin'),
		'id' => 'mgm_jackbox',
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array(
		'name' => __('Link to full size', 'mightymag-admin'),
		'desc' => __('Link featured image to full size image', 'mightymag-admin'),
		'id' => 'mgm_linkfullsize',
		'type' => 'checkbox',
		'std' => true,
		);
		

	// Category Tabs
	
$options[] = array(
		'name' => __('Home Tabs', 'mightymag-admin'),
		'type' => 'heading', 
		"class" => "sub"
);

$options[] = array( "name" => __('Activate Home Tabs', 'mightymag-admin'),
						"id" => "tabs_activate",
						"type" => "checkbox",
						"desc" => __('Enable/Disable Home Tabs', 'mightymag-admin'),
						'std' => false,
);

$options[] = array( "name" => __('Autoplay', 'mightymag-admin'),
						"id" => "tabs_autoplay",
						"type" => "checkbox",
						'std' => false,
						"desc" => __('Enable/Disablea auto Tabs rotation', 'mightymag-admin'),
);

$options[] = array( "name" => __('Duration', 'mightymag-admin'),
						"id" => "tabs_duration",
						"std" => "4000",
						"step" => "500",
						"min" => "500",
						"max" => "9500",
						"type" => "range",
						"class" => "sub",
						"suffix" => "ms"				
);
	
	$options[] = array( "name" => __('Tab 1', 'mightymag-admin'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'mightymag-admin'),
						"id" => "tab1_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'mightymag-admin'),
						"class" => "sub",
						"std" => "",
);

	$options[] = array( "name" => __('Display', 'mightymag-admin'),
						"id" => "tab1_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 1 Category', 'mightymag-admin'),
						"id" => "tab1_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 1 Tag', 'mightymag-admin'),
						"id" => "tab1_tag",
						"type" => "text",
						"class" => "hide sub"
);

	/* Tab 2 */
	
	$options[] = array( "name" => __('Tab 2', 'mightymag-admin'),
						"type" => "info",
);

	$options[] = array( "name" => __('Tab Title', 'mightymag-admin'),
						"id" => "tab2_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'mightymag-admin'),
						"class" => "sub",
						"std" => "",
);

	$options[] = array( "name" => __('Display', 'mightymag-admin'),
						"id" => "tab2_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 2 Category', 'mightymag-admin'),
						"id" => "tab2_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 2 Tag', 'mightymag-admin'),
						"id" => "tab2_tag",
						"type" => "text",
						"class" => "hide sub"
);

	/* Tab 3 */
	
	$options[] = array( "name" => __('Tab 3', 'mightymag-admin'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'mightymag-admin'),
						"id" => "tab3_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'mightymag-admin'),
						"class" => "sub",
						"std" => "",
);

	$options[] = array( "name" => __('Display', 'mightymag-admin'),
						"id" => "tab3_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 3 Category', 'mightymag-admin'),
						"id" => "tab3_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 3 Tag', 'mightymag-admin'),
						"id" => "tab3_tag",
						"type" => "text",
						"class" => "hide sub",
);
	
	/* Tab 4 */

	$options[] = array( "name" => __('Tab 4', 'mightymag-admin'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'mightymag-admin'),
						"id" => "tab4_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'mightymag-admin'),
						"class" => "sub",
						"std" => "",
);

	$options[] = array( "name" => __('Display', 'mightymag-admin'),
						"id" => "tab4_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 4 Category', 'mightymag-admin'),
						"id" => "tab4_category",
						"type" => "select",
						"class" => "sub hide",
						"options" => $options_categories
);

	$options[] = array( "name" => __('Tab 4 Tag', 'mightymag-admin'),
						"id" => "tab4_tag",
						"type" => "text",
						"class" => "hide sub",
);
						

	/* Tab 5 */

	$options[] = array( "name" => __('Tab 5', 'mightymag-admin'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'mightymag-admin'),
						"id" => "tab5_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'mightymag-admin'),
						"class" => "sub",
);

	$options[] = array( "name" => __('Display', 'mightymag-admin'),
						"id" => "tab5_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 5 Category', 'mightymag-admin'),
						"id" => "tab5_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 5 Tag', 'mightymag-admin'),
						"id" => "tab5_tag",
						"type" => "text",
						"class" => "hide sub",);
						
	/* Tab 6 */

	$options[] = array( "name" => __('Tab 6', 'mightymag-admin'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'mightymag-admin'),
						"id" => "tab6_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'mightymag-admin'),
						"class" => "sub",
);

	$options[] = array( "name" => __('Display', 'mightymag-admin'),
						"id" => "tab6_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 6 Category', 'mightymag-admin'),
						"id" => "tab6_category",
						"type" => "select",
						"class" => "hide sub",
						"options" => $options_categories
);

	$options[] = array( "name" => __('Tab 6 Tag', 'mightymag-admin'),
						"id" => "tab6_tag",
						"type" => "text",
						"class" => "hide",
						"class" => "sub"
);
						
	/* Tab 7 */

	$options[] = array( "name" => __('Tab 7', 'mightymag-admin'),
						"type" => "info",
);

	$options[] = array( "name" => __('Tab Title', 'mightymag-admin'),
						"id" => "tab7_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'mightymag-admin'),
						"class" => "sub"
);


	$options[] = array( "name" => __('Display', 'mightymag-admin'),
						"id" => "tab7_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 7 Category', 'mightymag-admin'),
						"id" => "tab7_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 7 Tag', 'mightymag-admin'),
						"id" => "tab7_tag",
						"type" => "text",
						"class" => "hide sub",
);

	/* Tab 8 */
					
	$options[] = array( "name" => __('Tab 8', 'mightymag-admin'),
						"type" => "info",
);

	$options[] = array( "name" => __('Tab Title', 'mightymag-admin'),
						"id" => "tab8_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'mightymag-admin'),
						"class" => "sub",
);


	$options[] = array( "name" => __('Display', 'mightymag-admin'),
						"id" => "tab8_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 8 Category', 'mightymag-admin'),
						"id" => "tab8_category",
						"type" => "select",
						"class" => "hide sub",
						"options" => $options_categories
);

	$options[] = array( "name" => __('Tab 8 Tag', 'mightymag-admin'),
						"id" => "tab8_tag",
						"type" => "text",
						"class" => "hide sub",
);

//Directories OCENTRUM
$options[] = array(
    'name' => __('Directories Page', 'mightymag-admin'),
    'type' => 'heading', 
    "class" => "sub"
);

    $options[] = array( //afrgun
        'name' => __('Directories Ad Code', 'mightymag-admin'),
        'desc' => __('Insert Advertising Code (E.g Google Adsense Code)', 'mightymag-admin'),
        'id' => 'banner_directories',
        'std' => '',
        'type' => 'textarea');
                                                                      
                                                                              
    $options[] = array( //afrgun
        'name' => __('Hide on Small Devices?', 'mightymag-admin'), 
        'desc' => __('Enable this not to show the top banner on portable devices.', 'mightymag-admin'),                             'id' => 'banner_directories_mobiles',
        'type' => 'checkbox',
        'class' => 'sub',
        'std' => false,     );

	//vet page OCENTRUM
	$options[] = array(
		'name' => __('Vet Page', 'mightymag-admin'),
		'type' => 'heading', 
		"class" => "sub"
);

$options[] = array( "name" => __('Activate Home Tabs', 'mightymag-admin'),
						"id" => "tabs_activate_custom",
						"type" => "checkbox",
						"desc" => __('Enable/Disable Home Tabs', 'mightymag-admin'),
						'std' => false,
);

$options[] = array( "name" => __('Autoplay', 'mightymag-admin'),
						"id" => "tabs_autoplay",
						"type" => "checkbox",
						'std' => false,
						"desc" => __('Enable/Disablea auto Tabs rotation', 'mightymag-admin'),
);


	$options[] = array( //afrgun
		'name' => __('Middle second Ad Code', 'mightymag-admin'),
		'desc' => __('Insert Advertising Code (E.g Google Adsense Code)', 'mightymag-admin'),
		'id' => 'banner_ask_doctor',
		'std' => '',
		'type' => 'textarea');
		
		$options[] = array( //afrgun
			'name' => __('Show on:', 'mightymag-admin'),
			'id' => 'banner_ask_doctor_display',
			'std' => 'all',
			'type' => 'select',
			'class' => 'sub',
			'options' => array(
				'home' => 'HomePage',
				'all' => 'Everywhere',
				'nothome' => 'Everywhere but homepage' )
			);
		
		$options[] = array( //afrgun
				'name' => __('Hide on Small Devices?', 'mightymag-admin'),
				'desc' => __('Enable this not to show the top banner on portable devices.', 'mightymag-admin'),
				'id' => 'banner_ask_doctor_mobiles',
				'type' => 'checkbox',
				'class' => 'sub',
				'std' => false,
			);
		

	
	$options[] = array( "name" => __('Tab 9', 'mightymag-admin'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'mightymag-admin'),
						"id" => "tab9_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'mightymag-admin'),
						"class" => "sub",
						"std" => "",
);

	$options[] = array( "name" => __('Display', 'mightymag-admin'),
						"id" => "tab9_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 9 Category', 'mightymag-admin'),
						"id" => "tab9_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 9 Tag', 'mightymag-admin'),
						"id" => "tab9_tag",
						"type" => "text",
						"class" => "hide sub"
);


	// Advanced Settings
	
	$options[] = array(
		'name' => __('Advanced', 'mightymag-admin'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Minify Stylesheets', 'mightymag-admin'),
		'id' => 'mgm_minify_css',
		'desc' => __('Enable/disable front-end CSS minifier', 'mightymag-admin'),
		'type' => 'checkbox',
		'std' => false,
		);
		
	$options[] = array(
		'name' => __('Minify Javascrips', 'mightymag-admin'),
		'id' => 'mgm_minify_js',
		'desc' => __('Enable/disable front-end JS minifier', 'mightymag-admin'),
		'type' => 'checkbox',
		'std' => false,
		);

	$options[] = array(
		'name' => __("Custom CSS", "mightymag"),
		'desc' => __("Add some CSS to your theme by adding it to this block.", "mightymag"),
		'id' => 'mgm_custom_css',
		'std' => "",
		'type' => 'textarea' );

	$options[] = array(
		'name' => __("Tracking Code", "mightymag"),
		'desc' => __("Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.", "mightymag"),
		'id' => 'mgm_google_analytics',
		'std' => "",
		'type' => 'textarea' );
		
	$options[] = array(
		'name' => __("Custom Javascript", "mightymag"),
		'desc' => __("Paste any Javascript you want to load in the Head section.", "mightymag"),
		'id' => 'mgm_custom_js',
		'std' => "",
		'type' => 'textarea' );
		
	return $options;
}

include_once('options-js.php'); // OF Javascripts
