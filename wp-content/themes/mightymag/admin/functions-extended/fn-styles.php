<?php

function mgm_user_css () {
		
		$output = '';

/*
==========================================================
GENERAL TEXT COLOR (Primary)
==========================================================
*/

$color_primary = of_get_option( 'mgm_color_primary', '' );

		
	/*
	======================================================
	Text Color On Primary
	======================================================
	*/
	
	$color_primary_body = of_get_option('mgm_color_primary_body', '#686868');
	$color_primary_link = of_get_option('mgm_color_primary_link', '#555555');
	$color_primary_hover = of_get_option('mgm_color_primary_hover', '#1e73be');
	
			{
				/* Titles */
				$output .= 
				'
				.mgm-title a,
				.mgm-title span
				{color:' . $color_primary_body . '!important}
				';			
				
				/* Regular Text */
				$output .= 
				'
				body
				{color:' . $color_primary_body . '}
				';

				/* Links */
				$output .= 
				'
				a
				{color:' . $color_primary_link . '}
				';
				
				/* Hovers */
				$output .= 
				'
				a:hover
				{color:' . $color_primary_hover . ';}
				';
				
				/* Hover Importants */
				$output .= 
				'
				.breadcrumb a:hover,
				.woocommerce-breadcrumb a:hover,
				.bbp-breadcrumb a:hover
				{color:' . $color_primary_hover . '!important;}
				';
			}
			

/*
==========================================================
SKIN COLOR
==========================================================

Check partials/part-cat-options.php to edit inline 
styles for global skin and categories colors
*/

	/*
	======================================================
	Text Color On Skin
	======================================================
	*/
	
	$color_skin_body = of_get_option('mgm_color_skin_body', '#ffffff');
	$color_skin_link = of_get_option('mgm_color_skin_link', '#ffffff');
	$color_skin_hover = of_get_option('mgm_color_skin_hover', '#eaeaea');
	
		{
			/* Text */
			$output .= 
			'
			.cat-bg,
			.inverse .boxed,
			.inverse .boxed .entry-details,
			.social-count-plus .items,
			.social-count-plus span.label,
			.sticky .entry-details,
			.article-content-wrapper:hover .img-hover-info,
			.rw-user-rating-desc .user_rating, 
			.rw-user-rating-desc .your_rating,
			.btn-success, .btn-success:hover, .btn-success:active, .btn-success:focus,
			.generic-button a,
			div.item-list-tabs ul li a span,
			.taxonomy-description p,
			#mgm-toolbar .topnav-wrap a,
			#mgm-toolbar .mgm-search-icon-trigger:hover .glyphicon-search
			{color:' . $color_skin_body . '}
			';
			
			/* Links */
			$output .= 
			'
			.inverse .boxed a,
			.social-count-plus .items a,
			.social-count-plus span.label a,
			.sticky .entry-details a,
			.mgm-cat .entry-details a,
			.cat-panes-content .entry-details,
			.cat-panes-content .entry-details a
			{color:' . $color_skin_link . '}
			';
			
			/* Hovers */
			$output .= 
			'
			.inverse .boxed a:hover,
			.social-count-plus .items a:hover,
			.social-count-plus span.label a:hover,
			.sticky .entry-details a:hover
			{color:' . $color_skin_hover . '}
			';
			
		}

			
/*
==========================================================
SECONDARY COLOR
==========================================================
*/
		
$color_secondary = of_get_option( 'mgm_color_secondary', '#f9f9f9' );
		
		{
			
			$output .= 
			'
			.search-in-place,
			.search-in-place .more,
			#collapse-trigger-wrap #collapse-icons,
			.entry-details,
			.mgm-title:after,
			.reply-wrap,
			#author-socials-wrap,
			.mgm-gray-frame,
			.rw-bar-wrap, 
			.rw-end,
			.affiliate-wrap,
			table thead tr,
			div.item-list-tabs,
			#bbpress-forums li.bbp-header,
			#bbpress-forums li.bbp-footer,
			.gallery-caption
			{background-color:' . $color_secondary . '}
			';
			
			$output .= 
			'
			#mgm-grid,
			#mgm-grid .mgm-grid-block:last-child
			{border-left: 1px solid ' . $color_secondary . '}
			';
			
			$output .= 
			'
			#mgm-grid .mgm-grid-block.mgm-grid-wide
			{border-bottom: 1px solid ' . $color_secondary . '}
			';
			
			$output .= 
			'
			#mgm-live-search input
			{border-color: ' . $color_secondary . '}
			';

		}
		

	/*
	======================================================
	Text Color On Secondary
	======================================================
	*/
	
	$color_secondary_link = of_get_option('mgm_color_secondary_link', '#555555');
	$color_secondary_hover = of_get_option('mgm_color_secondary_hover', '#1e73be');
	$color_secondary_body = of_get_option('mgm_color_secondary_body', '#686868');
	
			{
				/* Text */
				$output .= 
				'
				.search-in-place,
				.search-in-place .more,
				#collapse-trigger-wrap #collapse-icons,
				.entry-details,
				.mgm-title:after,
				.reply-wrap,
				#author-socials-wrap,
				.rw-bar-wrap, 
				.rw-end,
				.affiliate-wrap,
				.gallery-caption,
				.gallery-caption:before
				{color:' . $color_secondary_body . '}
				';
				
				/* Links */
				$output .= 
				'
				.search-in-place a,
				.search-in-place .more a,
				#collapse-trigger-wrap #collapse-icons a,
				.mgm-title:after a,
				#author-socials-wrap a,
				.rw-bar-wrap a, 
				.rw-end a
				{color:' . $color_secondary_link . '}
				';
				
				/* Hovers */
				$output .= 
				'
				.search-in-place a:hover,
				.search-in-place .more a:hover,
				#collapse-trigger-wrap #collapse-icons a:hover,
				.entry-details a:hover,
				.mgm-title:after a:hover,
				#author-socials-wrap a:hover,
				.rw-bar-wrap a:hover,
				.rw-end a:hover
				{color:' . $color_secondary_hover . '}
				';
				
			}
			

/*
==========================================================
BORDERS STYLE AND ALPHA
==========================================================
*/
		
$border_style = of_get_option( 'mgm_border_style' );
$border_alpha = of_get_option( 'mgm_border_alpha' );

if ($border_style == 'solid') {
			
			$output .= 
			'
			.boxed,
			#respond,
			.woocommerce #reviews #respond,
			.woocommerce-page #reviews #respond,
			div.activity-comments ul li,
			#bbpress-forums label,
			.wpcf7 label {
				border-style: solid;
				border-bottom: none;
			}';
			
			$output .= 
			'
			.tag-list a,
			.page-nav .page-numbers,
			.bbp-pagination-links .page-numbers {
				border-style: solid;
				border-left: none;
			}';
			
			$output .= 
			'
			.page-nav,
			.bbp-pagination-links {
				border-left-style: solid;
			}';
			
			$output .= 
			'
			.widget.buddypress ul#members-list li, 
			.widget.buddypress ul#groups-list li,
			.widget_categories ul li a,
			.widget_pages ul li a,
			.widget_meta ul li a,
			.widget_archive ul li a,
			.widget_nav_menu ul li a,
			.widget_recent_entries ul li a,
			.widget_recent_comments ul li
			 {
				border-bottom-style: solid;
			}';
			
}



if ($border_alpha == 'lighter') {
			
			$output .= 
			'
			.boxed,
			#respond {
				border-color: rgba(255,255,255, .1);
			}';
}
	
	
/*
==========================================================
HEADER BACKGROUND
==========================================================
*/

//$bg_header_switch = of_get_option( 'mgm_bg_header_switch' );
$bg_header = of_get_option( 'mgm_bg_header' );
		
		 if ( $bg_header['image'] != NULL ) {
			
			$output .= 
			'			
			ul.menu > li > a:before {
				display: none;
			}
			
			#mgm-header-opacity
			{		
				background-image:url('. $bg_header['image']. '); 
				background-repeat:' . $bg_header['repeat'] . '; 
				background-position:' . $bg_header['position'] . ';
				background-attachment:' . $bg_header['attachment'] . ';
				background-color:' . $bg_header['color'] . '!important;
			}
			';
		
		}


/*
======================================================
ANIMATE CONTENT IN DEPENDENCIES
======================================================
*/

$animate = of_get_option('mgm_animations');

	if ($animate) {
		
		$output .= 
			'
			.home .flexslider,
			#mgm-grid,
			.cat-panes-content,
			.widget_socialcountplus
			 {
				display: none;
			}
			';
	}
	

/*
==========================================================
NAVIGATION BACKGROUND
==========================================================
*/
		
$color_navigation = of_get_option( 'mgm_color_navigation', '#333333');
		
		{	
			$output .= 
			'
			.main-navigation ul
			{background-color:' . $color_navigation . '}
			';
	}
	
	
/*
==========================================================
BOXED BACKGROUND OPTIONS
==========================================================
*/

$boxed = of_get_option('mgm_boxed') == 'boxed';
$boxed_bg = of_get_option('mgm_boxed_bg');


				$output .= 
				'
				.mgm-full-main,
				.mgm-title a, 
				.mgm-title span,
				.boxed.entry-block,
				.reply-wrap a:first-child:before, 
				.reply-wrap .reply-wrap-submit:first-child:before,
				.white-line {
				 	
					background-color:' . $boxed_bg . ';
					
				}';
				
				/* reset on mobiles */
				$output .= '
				
				@media (max-width: 767px) {
					.mgm-full-main {
						padding: 0;
						box-shadow: none;
						background: none;
					}
				}';
			
			
			
/*
==========================================================
ENTRIES STYLE - TO REVIEW
==========================================================
*/
		
/*$entries_style = of_get_option( 'mgm_entries_style' );

if ($entries_style == 'alternative') {
		
		{	
			$output .= 
			'
			span.entry-details {
				background-color:' . $boxed_bg . ';
				box-shadow: 0px -6px 8px -6px rgba(0,0,0,0.2);
				}
				
			.boxed.entry-block,
			.entry-main-content .mgm-social-share {
				background-color: white!important;
				}
			.article-content-wrapper:hover span.entry-details {
				box-shadow: none;
				}
			';
	}
}*/


			
/*
======================================================
GRAYSCALE EFFECT
======================================================
*/

$grayscale = of_get_option('mgm_grayscale');

	if ($grayscale) {
		
			/*All Images*/
			$output .= 
			'
			img {   
				filter: url('. get_template_directory_uri() .'/images/filters.svg#grayscale); /* Firefox 3.5+ */
				filter: gray; /* IE6-9 */
				-webkit-filter: grayscale(1); /* Google Chrome & Safari 6+ */
				-webkit-transition: all 0.6s;
			}';
			
			/*Hovers*/
			$output .= 
			'
			.widget:hover img,
			article:hover img,
			#author-wrap:hover img,
			.sliders:hover img,
			.cat-panes-content:hover img,
			.lwa:hover img,
			.related-posts:hover img {   
				filter: none;
				-webkit-filter: grayscale(0);
			}';
			
			/*Excluded Images*/
			$output .= 
			'
			.mgm-logo img,
			ul.socials img,
			.widget:hover img,
			article:hover img,
			#author-wrap:hover img,
			.sliders:hover img,
			.cat-panes-content:hover img,
			.lwa:hover img,
			.related-posts:hover img {
				filter: none;
				-webkit-filter: grayscale(0);
			}';
	}
	
/*
======================================================
ADVERT SLOTS
======================================================
*/

$ad_top_mobiles = of_get_option('mgm_ad_top_mobiles');
$ad_middle_mobiles = of_get_option('mgm_ad_middle_mobiles');
$ad_bottom_mobiles = of_get_option('mgm_ad_bottom_mobiles');

	if ($ad_top_mobiles) {
		
			/* Top Advert */
			$output .= 
			'
			@media (max-width: 767px) {
			
				#mgm-top-ad {
					display:none;
				}
			}
			';
	}
	
	if ($ad_middle_mobiles) {
			
			/* Middle Advert */
			$output .= 
			'
			@media (max-width: 767px) {
			
				#mgm-middle-ad {
					display:none;
				}
			}
			';
	}
	
	if ($ad_bottom_mobiles) {
		
			/* Bottom Advert */
			$output .= 
			'
			@media (max-width: 767px) {
			
				#mgm-bottom-ad {
					display:none;
				}
			}
			';
	}
			
	if (of_get_option('mgm_ad_top') != NULL) {
		
			/* Float Logo Top Advert (if present) for Minimal Unboxed layout */
			$output .= 
			'
			@media (min-width: 1199px) {
				.mgm-logo {
					float: left;
					margin-left: 40px;
				}
				
				#nav-clone .mgm-logo {
					margin-left: 0;
				}
				
				#mgm-top-ad {
					margin-top: 0;
					margin-right: 80px;
					text-align: right;
				}
			}
			';		 
	}

/*****Output*****/
		
		if ( $output != '' ) {
			$output = '<style>' . $output . '</style>';
			echo $output;
		}
	}
add_action('wp_head', 'mgm_user_css');

?>