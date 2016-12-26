<?php

global $wp_query;

/*
==========================================================
SET TOP LEVEL PARENT
==========================================================
*/

function pa_category_top_parent_id ($catid) {
	while ($catid) {
	$cat = get_category($catid); // get the object for the catid
	$catid = $cat->category_parent; // assign parent ID (if exists) to $catid
	// the while loop will continue whilst there is a $catid
	// when there is no longer a parent $catid will be NULL so we can assign our $catParent
	$catParent = $cat->cat_ID;
	}
	return(isset($catParent)?$catParent:null);
}

/*
==========================================================
OUTPUT CAT STYLES
==========================================================
*/

function mgm_output_cat_options(){

	$skin_color = of_get_option( 'mgm_color_skin', '#00aced' );
	$category = get_the_category();
	//$bbpress_active =  function_exists( 'bp_forums_is_installed_correctly' );
	//$buddypress_active = function_exists('bp_is_active');
	 
	if ( isset($category[0]->cat_ID) ) { 
		$category_ID = $category[0]->cat_ID;
	} else {
		$category_ID = '';
	}

	$category_parent = pa_category_top_parent_id ($category_ID);
	
	// Get current category CSS
	$category_color = get_tax_meta($category_ID,'mgm_color_field_id');
	$category_background_image = get_tax_meta($category_ID,'mgm_image_field_id');
	$category_background_position = get_tax_meta($category_ID,'mgm_background_position');
	$category_background_header = get_tax_meta($category_ID,'mgm_image_header');
	$category_custom_css = get_tax_meta($category_ID,'mgm_category_custom_css');
	
	// Get parent category CSS 
	$category_parent_color = get_tax_meta($category_parent,'mgm_color_field_id');
	$category_parent_background = get_tax_meta($category_parent,'mgm_image_field_id');
	$category_parent_background_position = get_tax_meta($category_parent,'mgm_background_position');
	$category_parent_background_header = get_tax_meta($category_parent,'mgm_image_header');
	$category_parent_custom_css = get_tax_meta($category_parent,'mgm_category_custom_css');

	
	// if current category bg returns nothing then set to parent value
	if ($category_background_image == '') {
		$category_background_image = $category_parent_background;		
	}
	
	// if current category bg position returns nothing then set to parent value
	if ($category_background_position == '') {
		$category_background_position = $category_parent_background_position;		
	}

	// if current category header image returns nothing then set to parent value
	if ($category_background_header == '') {
		$category_background_header = $category_parent_background_header;		
	}	
	
	// if current category css returns nothing then set to parent value
	if ($category_custom_css == '') {
		$category_custom_css = $category_parent_custom_css;		
	}	
	
	// if current category returns no color then set to parent value
	if (strlen($category_color) < 2) {
		$category_color = $category_parent_color;		
	}	
	
	// if there's no parent then use the global option
	if (strlen($category_color) < 2) {
		$category_color = $category_color;
	}

// Check to make sure the varialbe are set
if (isset($category_background_image) && $category_background_image !== '') { $category_src = $category_background_image['src']; }
if (isset($category_background_header) && $category_background_header !== '') { $category_header_src = $category_background_header['src']; }


if (is_page() || is_search() || is_author() || is_tag() || is_home()) {
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$category_color = get_post_meta(get_the_ID(), 'mgm_page_color', true);
		if (strlen($category_color) < 2 || $category_color === NULL) {
		$category_color = $category_color;		
	}	
	endwhile; endif;
}

	
// If no category color is found, just get the global skin color

//$show_on_front = get_option('show_on_front');
if ( empty($category_color) OR $category_color == ' ' /* inheritance fix */ ) {$category_color = $skin_color; }
	
	?><style>
		
	<?php
	// Category Colors Head CSS
	if (!empty($category_color)) { echo('
	
	.cat-color,
	.comment-author cite,
	.comment-author cite a,
	#mgm-toolbar .topnav-wrap a:hover,
	.search-in-place .more a,
	.mgm-search-icon-trigger .glyphicon-search,
	#collapse-icons a.active,
	#mgm-collapse-newsletter span,
	#mgm-full-footer .mgm-title a,
	#mgm-full-footer .mgm-title span,
	.custom-widget .entry-rating,
	#author-wrap .author-name a,
	.lwa-formlinks a,
	.lwa-formlinks label,
	.mgm-trigger.active,
	#ticker-wrap a,
	.readmore,
	#rw-box-title,
	.rw-overall-number,
	.rw-user-rating-desc .score,
	.affiliate-wrap p,
	.woocommerce p.stars a, 
	.woocommerce-page p.stars a,
	h4, h5, h6,
	h4.cat-color a,
	h5.cat-color a,
	h6.cat-color a,
	.widget_display_stats dd,
	.woocommerce span.amount,
	.widget_recent_reviews .reviewer,
	.shop-banner-title a,
	.user-name,
	.mgm-reply-author a,
	#bbpress-forums .bbp-forum-title,
	.activity-read-more a {	
		color:' . $category_color . ';
	}
	
	h4.mgm-title a,
	h4.mgm-title span,
	ul.tabs li.active a,
	.cat-tabs span.current a,
	a[class*="star-"]:hover:after,
	a.active[class*="star-"]:after  {
		color:' . $category_color . '!important;
	}
	
	.cat-bg,
	#mgm-header-opacity,
	.nav-wrap#nav-clone .mgm-logo,
	.nav-wrap#nav-clone .mgm-logo-text,
	.sticky	.entry-details,
	#mgm-full-collapsible .btn-success:hover,
	#mgm-full-collapsible .btn-success:focus,
	#mgm-full-site-info,
	.mgm-cat a,
	.flex-cat,
	.mgm-title.mgm-title-skin:after,
	.mgm-title a:after, .mgm-title a:before, .mgm-title span:after, .mgm-title span:before,
	.inverse .boxed,
	.reply-wrap .mgm-reply a,
	.article-content-wrapper:hover .img-hover-info,
	.rw-criteria.stars-preview,
	.rw-bar-progress,
	.social-count-plus ul li,
	.cat-panes-content .entry-details,
	.cat-panes-content .entry-details a,
	.rw-user-rating-desc .user_rating, 
	.rw-user-rating-desc .your_rating,
	.mgm-share-text,
	.flex-direction-nav,
	.woocommerce #comments .star-rating, 
	.woocommerce-page #comments .star-rating,
	.mgm-onsale,
	.btn-success, .btn-success:hover, .btn-success:active, .btn-success:focus, .btn-success.disabled, .btn-success[disabled],
	.generic-button a,
	.actions a.mark-read,
	div.item-list-tabs ul li a span,
	.taxonomy-description p,
	.mgm-search-icon-trigger:before,
	.mgm-title span.mgm-stripe,
	.jackbox-panel:hover,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, 
	.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce-review-link,
	.label-minus,
	.label-plus,
	.single_add_to_cart_button,
	.mgm-product-single-wrap .price,
	.shop-banner-price .price,
	span#subscription-toggle a, span#favorite-toggle a,
	.woocommerce-result-count {
		background-color:' . $category_color . ';
	}
	
	.mgm-spinner { 
		border-top-color:' . $category_color . ';
	}

	ul.menu > li > a:before {
		
		border-top: 6px solid ' . $category_color /*ArrowDown*/ . ';
	}
	
	.mgm-share-text:after {
		border-left: 8px solid ' . $category_color /*ArrowRight*/ . ';
	}

	.bypostauthor > .boxed {
		border: 1px solid ' . $category_color . ';
		border-bottom: none;
	}
	
	::-moz-selection {
		
		background:'.$category_color.'!important;
		color: #fff;
	}
	::selection {
		
		background:'.$category_color.'!important;
		color: #fff;
	}
	
	*:focus {
		outline: 0!important;
	}
	
	.form-control:focus {
		border-color: '.$category_color.'!important;
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 10px '.$category_color.'!important;
	}

	');
}
	            

/* Category GLOBAL Backgrounds */
	
if ( !is_home() ) {	
				
	if ($category_background_image != NULL) { // If has an image uploaded, do the following:
		
		// Tiled Background
		if ($category_background_position == 'tiled') {
			
			echo '
			
			body {
				background-image: url('.$category_src.')!important;
			}';
			
		}
		
		// Static Background	
		if ($category_background_position == 'static') {
			
			echo '
			
			body {
				background-attachment:fixed; background-image: url('.$category_src.')!important;
			}';
			
		}
			
		// CSS3 Full Page Background	
		if ($category_background_position == 'fullscreen') {
			
			echo '
			
			html { 
				background: url('.$category_src.') no-repeat center center fixed!important; 
				-webkit-background-size: cover!important;
				-moz-background-size: cover!important;
				-o-background-size: cover!important;
				background-size: cover!important; 
			}';
			
		}
	}
}

/* Category HEADER Backgrounds */
	
if ( !is_home() ) {	
				
	if ( ( $category_background_header != NULL ) /*AND of_get_option('mgm_bg_header_switch')*/ ) { 
	// If has an image uploaded and Header BG is enabled in Theme Options, do the following:
			
			echo '

			ul.menu > li > a:before {
				display: none;
			}
			
			#mgm-header-opacity {
				background: url('.$category_header_src.')!important;
			}';
	}
}


// Remove Ad Wallpaper Link if another BG is set for the category

if ( ($category_background_image != NULL) AND !is_home() ) {
	
	echo '
		
		#mgm-wallpaper {
			display: none!important;
			visibility: hidden!important;
		}
	';

}
	
// Check and echo custom CSS for this cat 
	if (isset($category_custom_css) && $category_custom_css !== '') { echo ($category_custom_css.' '); }

?> </style>

<?php }; 
	
add_action('wp_head','mgm_output_cat_options');