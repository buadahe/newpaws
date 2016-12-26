<?php

$prefix = 'mgm_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'review',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Rating Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post'),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'low',

	// List of meta fields
	
	
	
	'fields' => array(
		array(
			'name'		=> __('Enable Review', 'mightymag-admin' ),
			'id'		=> $prefix . 'review_enable',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'std'		=> false
		),
		array(
			'name'		=> __('Enable User Ratings?', 'mightymag-admin' ),
			'id'		=> $prefix . 'user_rating_switch',
		    'class' 	=> 'sep',
			'type'		=> 'checkbox',
			'std'		=> false
		),
		
		// CRITERIA ONE
		
		array(
			'name'		=> __('<strong>Criteria 1</strong> name:', 'mightymag-admin' ), 
			'desc'		=> __('Leave empty not to show', 'mightymag-admin' ), 
			'id'		=> "{$prefix}description_c1",
			'type'		=> 'text',
		),
	
		/* Slider 1 */
		array(
			'id'   => "{$prefix}rating_c1",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		
		//CRITERIA TWO
		
		array(
			'name'		=> __('<strong>Criteria 2</strong> name:', 'mightymag-admin' ), 
			'desc'		=> __('Leave empty not to show', 'mightymag-admin' ), 
			'id'		=> "{$prefix}description_c2",
			'type'		=> 'text',
		),
		
		/* Slider 2 */
		array(
			'id'   => "{$prefix}rating_c2",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		//CRITERIA THREE
		
		array(
			'name'		=> __('<strong>Criteria 3</strong> name:', 'mightymag-admin' ), 
			'desc'		=> __('Leave empty not to show', 'mightymag-admin' ), 
			'id'		=> "{$prefix}description_c3",
			'type'		=> 'text',
		),

		/* Slider 3 */
		array(
			'id'   => "{$prefix}rating_c3",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		//CRITERIA FOUR
		
		array(
			'name'		=> __('<strong>Criteria 4</strong> name:', 'mightymag-admin' ), 
			'desc'		=> __('Leave empty not to show', 'mightymag-admin' ), 
			'id'		=> "{$prefix}description_c4",
			'type'		=> 'text',
		),

		/* Slider 4 */
		array(
			'id'   => "{$prefix}rating_c4",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		//CRITERIA FIVE
		
		array(
			'name'		=> __('<strong>Criteria 5</strong> name:', 'mightymag-admin' ), 
			'desc'		=> __('Leave empty not to show', 'mightymag-admin' ), 
			'id'		=> "{$prefix}description_c5",
			'type'		=> 'text',
		),
		
		/* Slider 5 */
		array(
			'id'   => "{$prefix}rating_c5",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		//CRITERIA SIX
		
		array(
			'name'		=> __('<strong>Criteria 1</strong> name:', 'mightymag-admin' ), 
			'desc'		=> __('Leave empty not to show', 'mightymag-admin' ), 
			'id'		=> "{$prefix}description_c6",
			'type'		=> 'text',
		),
		
		/* Slider 6 */
		array(
			'id'   => "{$prefix}rating_c6",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		array(
			'name' => __('<strong>Average</strong>', 'mightymag-admin' ),
			'id'   => "{$prefix}overall_score",
			'class' => "average-value",
			'type' => 'text',
		),
		
		//RATING TYPE
			
		array(
			'name'		=> __('<strong>Rating Type</strong>', 'mightymag-admin' ), 
			'id'		=> "{$prefix}review_scale",
			'class'		=> "sep",
			'type'		=> 'select',
			'options'	=> array(
				'star'	  => 'Stars',
				'percent' => 'Percentage'
			),
			'std'		=> 'Stars',
			
		),
		
		//ADDITIONAL INFO
		
		array(
			'name'		=> __('Criteria Header', 'mightymag-admin' ),
			'desc'		=> __('Disabled if empty', 'mightymag-admin' ),
			'id'		=> "{$prefix}review_header",
			'type'		=> 'text',
		),
		array(
			'name'		=> __('Rating Tag', 'mightymag-admin' ),
			'desc'		=> __('One or two words', 'mightymag-admin' ),
			'id'		=> "{$prefix}tagline",
			'type'		=> 'text',
		),
		array(
			'name'		=> __('Longer Summary', 'mightymag-admin' ),
			'id'		=> "{$prefix}summary",
			'type'		=> 'textarea',
			'class'		=> "sep",
			'cols'		=> "50",
			'rows'		=> "5"
		),
		
		array(
			'name'		=> __('Affiliate Link', 'mightymag-admin' ),
			'desc'		=> "Enter an affiliate link - Disabled if empty",
			'id'		=> "{$prefix}affiliate",
			'type'		=> 'text',
		),
		
		array(
			'name'		=> __('Affiliate Catch Phrase', 'mightymag-admin' ),
			'desc'		=> __('Some catching words here', 'mightymag-admin' ),
			'id'		=> "{$prefix}affiliate_catch",
			'type'		=> 'text',
		),
		
		array(
			'name'		=> __('Affiliate Button Text', 'mightymag-admin' ),
			'desc'		=> __('One or two words to display inside the button (e.g."Buy now")', 'mightymag-admin' ),
			'id'		=> "{$prefix}affiliate_btn",
			'type'		=> 'text',
		),
		
		array(
			'name'		=> __('Cart Icon on Button', 'mightymag-admin' ),
			'desc'		=> __('Insert a cart icon inside the button', 'mightymag-admin' ),
			'id'		=> "{$prefix}affiliate_btn_icon",
			'type'		=> 'checkbox',
			'class'		=> "sep",
		),
		
		//RATING BOX POSITION
		array(
			'name'		=> __('Position', 'mightymag-admin' ),
			'id'		=> "{$prefix}box_position",
			'type'		=> 'select',
			'options'	=> array(
				'top'			=> __('Top', 'mightymag-admin' ),
				'bottom'		=> __('Bottom', 'mightymag-admin' ),
			),
			'std'		=> 'bottom',
			'desc'		=> __('Select where the review box should appear in the page', 'mightymag-admin' ),
		)
		
	)
);


// Tools Metabox
$meta_boxes[] = array(
	'id'		=> 'post_extension',
	'title'		=> 'Single Post Options',
	'pages'		=> array( 'post', 'page' ),

	'fields'	=> array(
	
		array(
			'name'		=> __('Feature this Post on the<strong> Homepage Slider?</strong>', 'mightymag-admin' ),
			'id'		=> $prefix . 'featured_post_1',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'std'		=> false
		),
		

		array(
			'name'		=> __('Video Embed Code', 'mightymag-admin' ),
			'id'		=> $prefix . 'video_encode',
			'clone'		=> false,
			'type'		=> 'textarea',
			'class'		=> 'sep',
			'desc'		=> __('Paste in the iframe in here', 'mightymag-admin' ),
			'std'		=> false
		),				
		array(
			'name'		=> __('Comment Type', 'mightymag-admin' ),
			'id'		=> "{$prefix}comment_type",
			'type'		=> 'radio',
			'options'	=> array(
				'fb'	=> __('Facebook Comments', 'mightymag-admin' ),
				'wp'	=> __('WP Comments', 'mightymag-admin' ),
				'none'  => __('None', 'mightymag-admin' ),
			),
			'std'		=> 'wp',
		)
	)
);


// Pages Only Options
$meta_boxes[] = array(
	'id'		=> 'page_extension',
	'title'		=> __('Page Color', 'mightymag-admin' ),
	'pages'		=> array( 'page' ),
	'fields'	=> array(
		
		array(
			'name'	=> __('Skin Color', 'mightymag-admin' ),
			'id'	=> "{$prefix}page_color",
			'type'	=> 'color'
		)
	)
);

// HomePages Only Options

	$meta_boxes[] = array(
		'id'		=> 'homepage_extension',
		'title'  => __( 'HomePage Options', 'mightymag-admin' ),
		'pages'		=> array( 'page'),
		'fields' => array(
		
			array(
				'name' => __( 'Slider Type', 'mightymag-admin' ),
				'id'   => "{$prefix}hp_slider",
				'type' => 'select',
				'desc' => __('Additional post count and animation options could be set in Theme Options > Sliders','mightymag-admin'),
				'options'	=> array(
					'slider_grid'	  => __('Half width Slider + Grid', 'mightymag-admin'),
					'slider_full' => __('Full width Slider', 'mightymag-admin' ),
					'slider_none' => __('None', 'mightymag-admin' )
				),
				'std'		=> 'slider_grid',
			),
	
		),
	);
	

// Full Width Option
$meta_boxes[] = array(
	'id'		=> __('full_width', 'mightymag-admin' ),
	'title'		=> __('Full Width Layout', 'mightymag-admin' ),
	'pages'		=> array( 'page', 'post' ),
	'priority'  => 'low',
	'fields'	=> array(

		array(
			'name'	=> __('Disable Sidebar', 'mightymag-admin' ),
			'id'	=> $prefix . 'full_width_switch',
			'type'	=> 'checkbox',
			'std'	=> false,
		),
	)
);


// Small Featured Image Option
$meta_boxes[] = array(
	'id'		=> 'small_featured',
	'title'		=> __('Small Featured Image', 'mightymag-admin' ),
	'pages'		=> array( 'page', 'post' ),
	'priority'  => 'low',
	'context' => 'side',
	'fields'	=> array(

		array(
			'name'	=> '',
			'id'	=> $prefix . 'small_featured_switch',
			'type'	=> 'checkbox',
			'std'	=> false,
			'desc'	=> __('Check this option if you wish to use a smaller in-content featured image/video. <br><br> <strong>Note:</strong> to wrap text around the image, enter it through the default text editor and <strong>not</strong> through the Visual Composer ', 'mightymag-admin' ),
		),
	)
);

// Hide Featured Image in Single Post Page

$meta_boxes[] = array(
	'id'		=> 'hide_featured',
	'title'		=> __('Hide Featured Image', 'mightymag-admin' ),
	'pages'		=> array( 'post' ),
	'priority'  => 'low',
	'context' => 'side',
	'fields'	=> array(

		array(
			'name'	=> '',
			'id'	=> $prefix . 'hide_featured_switch',
			'type'	=> 'checkbox',
			'std'	=> false,
			'desc'	=> __('Hide featured image in single post page', 'mightymag-admin' ),
		),
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function mgm_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'mgm_register_meta_boxes' );