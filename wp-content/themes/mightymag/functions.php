<?php

/*
==========================================================
MIGHTYMAG GENERAL SETUP
==========================================================
*/

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since MightyMag 1.0
 */

if ( ! isset( $content_width ) )
	$content_width = 1140; /* pixels */

if ( ! function_exists( 'mgm_setup' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since MightyMag 1.0
 */

function mgm_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );
	
	/**
	 * Options Framework
	 */
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/options-core/' );
		require_once dirname( __FILE__ ) . '/admin/options-core/options-framework.php';
	}
		require_once dirname( __FILE__ ) . '/admin/options.php';

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on MightyMag, use a find and replace
	 * to change 'mightymag' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mightymag', get_template_directory() . '/languages' );
	load_theme_textdomain( 'mightymag-admin', get_template_directory() . '/languages/admin/' );
	//load_theme_textdomain( 'login-with-ajax', get_template_directory() . '/inc/register-with-ajax/langs/' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'mightymag' ),
		'utilities' => __( 'Utilities Menu', 'mightymag' ),
		'footer' => __( 'Footer Menu', 'mightymag' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'image', 'video') );
	
	/**
	 * Declare BuddyPress Support
	 */
	add_theme_support( 'buddypress' );
}
endif; // mgm_setup
add_action( 'after_setup_theme', 'mgm_setup' );


/*
==========================================================
INCLUDES
==========================================================
*/

//Core
require('inc/lessc.inc.php'); //Less PHP compiler
require('inc/tax/class-usage.php'); //Tax Class
require('inc/tgm-plugin-activation/class-tgm-plugin-activation.php'); //TGM Plugin Activation

//Custom
include_once('admin/functions-extended/fn-js.php'); //Dynamic Inline JS's
include_once('admin/functions-extended/fn-styles.php'); //User Styles
include_once('admin/functions-extended/fn-typography.php'); //User Typography
include_once('inc/bwp-minify/bwp-minify.php'); //Minifier

//Tools
include_once('inc/live-search/live-search.php'); //Live Search
include_once('inc/user-profile.php'); //User Profile additional fields
include_once('inc/login-with-ajax/login-with-ajax.php'); //Login with Ajax
include_once('inc/sidebar-generator.php'); //Sidebar Generator
include_once('inc/panes.php'); //Home Tabs Panes
include_once('inc/panes-custom.php'); //Home Tabs Custom afrgun
include_once('inc/user-rating-class.php'); //User Rating Engine
include_once('inc/wp-comment-master/wp-comment-master.php'); // Ajax Comments

//Widgets
include_once('inc/widgets/wg-main-cat.php'); // HomePage
include_once('inc/widgets/wg-side-post.php'); //Sidebar Posts
include_once('inc/widgets/wg-sidebar.php'); //Sidebar Tools
include_once('inc/widgets/recent-tweets-widget/recent-tweets.php'); //Twitter API 1.1 Widget

//Custom MetaBoxes Path
define('RWMB_URL', trailingslashit(get_template_directory_uri() . '/admin/meta-box'));
define('RWMB_DIR', trailingslashit(get_template_directory() . '/admin/meta-box'));

// Metaboxes Script
require_once RWMB_DIR . 'meta-box.php';

// Include Metabox Definitions
include get_template_directory() . '/admin/meta-box-config.php';

// Buddypress functions
if(function_exists('bp_is_active') ) {
// Load the default BuddyPress AJAX and other functions if BP is active
	if ( !(int)get_option( 'bp_tpack_disable_js' ) ) {
		include_once('admin/functions-extended/fn-buddypress.php');
	}
}

// bbPress functions @since MGM 1.4
if(function_exists('bbp_version') ) {
	include_once('admin/functions-extended/fn-bbpress.php');
}

// WooCommerce functions
if(function_exists('is_woocommerce')){
		include_once('admin/functions-extended/fn-woocommerce.php');
}


/*
==========================================================
WIDGETIZED AREAS
==========================================================
*/

function mgm_widgets_init() {
	
	$mgm_before_title = '<h3 class="mgm-title"><span>';
	$mgm_after_title = '</span></h3>';
		
	register_sidebar( array(
		'name' => __( 'Sidebar', 'mightymag' ),
		'id' => 'sidebar-1',
		'description' => __( 'This is the main sidebar, it will appear on every post/page unless a different sidebar is generated and attached through the Options Panel, or a full-width layout is selected for the post/page', 'mightymag' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => $mgm_before_title,
		'after_title' => $mgm_after_title,	) );
		
	register_sidebar( array(
		'name' => __( 'Login Bar', 'mightymag' ),
		'id' => 'login-sidebar',
		'description' => __( 'Please only drag the "MightyMag: Login Bar" widget here.', 'mightymag' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '', ) );
	
	register_sidebar( array(
		'name' => __( 'Homepage Left', 'mightymag' ),
		'id' => 'homepage-1',
		'description' => __( 'Everything here will output in the left homepage column.', 'mightymag' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s wrapper-article-popular">',
		'after_widget' => '</aside>',
		'before_title' => $mgm_before_title,
		'after_title' => $mgm_after_title,	) );

	
	register_sidebar( array(
		'name' => __( 'Homepage Middle', 'mightymag' ),
		'id' => 'homepage-2',
		'description' => __( 'Everything here will output in the middle homepage column.', 'mightymag' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => $mgm_before_title,
		'after_title' => $mgm_after_title,
	) );
	
	register_sidebar( array(
		'name' => __( 'Homepage Right', 'mightymag' ),
		'id' => 'homepage-3',
		'description' => __( 'This is the right handed one. You can also choose to hide this and display the default sidebar instead in Theme Options -> Sidebars', 'mightymag' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => $mgm_before_title,
		'after_title' => $mgm_after_title,	) );

	
	register_sidebar( array(
		'name' => __( 'Footer1', 'mightymag' ),
		'id' => 'footer-1',
		'description' => __( 'First column footer widget, for best results only place one widget here.', 'mightymag' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => $mgm_before_title,
		'after_title' => $mgm_after_title,	) );
	
	register_sidebar( array(
		'name' => __( 'Footer2', 'mightymag' ),
		'id' => 'footer-2',
		'description' => __( 'Second column footer widget, for best results only place one widget here.', 'mightymag' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => $mgm_before_title,
		'after_title' => $mgm_after_title,	) );
	
	register_sidebar( array(
		'name' => __( 'Footer3', 'mightymag' ),
		'id' => 'footer-3',
		'description' => __( 'Third column footer widget, for best results only place one widget here.', 'mightymag' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => $mgm_before_title,
		'after_title' => $mgm_after_title, ) );
		
	register_sidebar( array(
		'name' => __( 'BuddyPress', 'mightymag' ),
		'id' => 'buddypress',
		'description' => __( 'This is the sidebar that will display in BuddyPress pages, move to Theme Options > Sidebars to enable/disable this.', 'mightymag' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => $mgm_before_title,
		'after_title' => $mgm_after_title, ) );
		
	register_sidebar( array(
		'name' => __( 'BBpress', 'mightymag' ),
		'id' => 'bbpress',
		'description' => __( 'This is the sidebar that will display in BBpress pages, move to Theme Options > Sidebars to enable/disable this.', 'mightymag' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => $mgm_before_title,
		'after_title' => $mgm_after_title, ) );
		
	register_sidebar( array(
		'name' => __( 'WooCommerce', 'mightymag' ),
		'id' => 'woocommerce',
		'description' => __( 'This is the sidebar that will display in WooCommerce pages, move to Theme Options > Sidebars to enable/disable this.', 'mightymag' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => $mgm_before_title,
		'after_title' => $mgm_after_title, ) );
		
}
add_action( 'widgets_init', 'mgm_widgets_init' );


/*
==========================================================
POST THUMBNAIL FORMATS
==========================================================
*/

add_image_size( 'loop', 370, 180, true ); 
add_image_size( 'regular-featured', 750, 400, true );
add_image_size( 'small-featured', 375 );
add_image_size( 'menu-thumbs', 268, 130, true );
add_image_size( 'slider-full', 1190, 430, true );
add_image_size( 'slider-half', 694, 350, true );
/*add_image_size( 'mini-square', 60, 60, true ); */
add_image_size( 'grid', 248, 175, true );
add_image_size( 'grid-wide', 498, 175, true );
add_image_size( 'carousel-thumbs', 180, 200, true );

add_image_size( 'custom_img_artikel', 370, 230, true );

/* =================================
MULTIPLE THUMBNAIL 
================================= */
if (class_exists('MultiPostThumbnails')) {

new MultiPostThumbnails(array(
'label' => 'Secondary Image',
'id' => 'secondary-image',
'post_type' => 'post'
 ) );

 }

/*
==========================================================
PAGE BUILDER INITIALIZATION
==========================================================
*/
	
if(function_exists('vc_set_as_theme')) {
	
	vc_set_as_theme($notifier = false);
	vc_disable_frontend();
	wpb_remove("vc_posts_grid");
	wpb_remove("vc_carousel");

}


/*
==========================================================
ENQUEUE SCRIPTS AND STYLES
==========================================================
*/


// Server Side LESS PHP Compiler
/*
** This function will allow compiling a new css file output
** only if the original layout.less is modified,
** otherwise no action will be taken and less.css file is enqueued normally.
*/

function mgm_autoCompileLess($inputFile, $outputFile) {
  // load the cache
  $cacheFile = $inputFile.".cache";

  if (file_exists($cacheFile)) {
    $cache = unserialize(file_get_contents($cacheFile));
  } else {
    $cache = $inputFile;
  }

  $less = new lessc;
  $less->setFormatter('compressed');
  $newCache = $less->cachedCompile($cache);

  if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
    //file_put_contents($cacheFile, serialize($newCache));
    //file_put_contents($outputFile, $newCache['compiled']);
  }
}

$less_source = get_template_directory() . '/css/less/layout.less';
$css_output = get_template_directory() . '/css/less.css';

mgm_autoCompileLess( $less_source, $css_output);


function mgm_scripts() {
	
	$hometabs =  of_get_option('tabs_activate');
	$home_1 = is_page_template('home-widgetized-1.php');
	$home_2 = is_page_template('home-widgetized-2.php');
	$home_3 = is_page_template('home-widgetized-3.php');
	$home_4 = is_page_template('home-widgetized-4.php');
	$home_5 = is_page_template('home-widgetized-5.php');
	$home_6 = is_page_template('home-widgetized-6.php');
	$home_7 = is_page_template('home-widgetized-7.php');

	$mgm = wp_get_theme();
	$mgm_v = $mgm->Version;;
	
	//Basic Stylesheets
	wp_enqueue_style ('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css', array(), 'all' );
	wp_enqueue_style ('style', get_stylesheet_directory_uri() . '/style.css', array(), 'all' );
	wp_enqueue_style ('less-code', get_template_directory_uri() . '/css/less.css', array(), 'all' );
	wp_enqueue_style ('social-css', get_template_directory_uri() . '/css/bootstrap-social.css', array(), 'all' );
	wp_enqueue_style ('fontawesome-css', get_template_directory_uri() . '/css/font-awesome.css', array(), 'all' );
	wp_enqueue_style ('hvr-css', get_template_directory_uri() . '/css/hover.css', array(), 'all' );
	wp_enqueue_style ('custom-css', get_template_directory_uri() . '/css/cstm.css', array(), 'all' );
	
	//Basic Scripts
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.min.js', array( 'jquery' ), '2.2', true );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() .'/js/jquery.fitvids.min.js', array('jquery'), '1.1', true );
	wp_enqueue_script( 'djwd-js', get_template_directory_uri() . '/js/djwd.js', array( 'jquery' ), $mgm_v, true );
	wp_enqueue_script('jquery-311', get_template_directory_uri() . '/js/jquery-3.1.1.js', array( 'jquery' ), true );
	wp_enqueue_script( 'cstm-js', get_template_directory_uri() . '/js/cstm.js', array( 'jquery' ), true );
	
	//Deregister Uneeded scripts
	wp_deregister_script('prettyphoto');
	
	/* Conditional Scripts */
	
	//Page Builder Theme Customizations
	if(function_exists('vc_set_as_theme')) {
	wp_enqueue_style ( 'mgm-vc', get_template_directory_uri() . '/css/mgm-vc.css', array(), 'all' ); //Custom PageBuilder
	}
	
	//BBpress
	if (function_exists('bbp_version')) {
	wp_enqueue_script( 'mgm-bbpress-js', get_template_directory_uri() . '/js/bbpress.js', array( 'jquery' ), $mgm_v, true );
	}
	
	//jQuery Tools
	if ( ( $hometabs ) AND is_front_page() || is_home() || $home_1 || $home_2 || $home_3 || $home_4 || $home_5 || $home_6 || $home_7 ) {
	wp_enqueue_script( 'jquery-tools', get_template_directory_uri() .'/js/jquery.tools.min.js', array('jquery'), '1.2.7', true );
	}
	
	//Animations
	if ( of_get_option('mgm_animations') ) {
	wp_enqueue_style ('animate-css', get_stylesheet_directory_uri() . '/css/animate.custom.min.css', array(), 'all' );
	wp_enqueue_script( 'wow-js', get_template_directory_uri() . '/js/wow.min.js', array( 'jquery' ), true );
	}
	
	//Jackbox ON/OFF
	if ( of_get_option('mgm_jackbox') ) {
	wp_enqueue_script( 'jackbox', get_template_directory_uri() . '/inc/jackbox/js/jackbox-for-mightymag.min.js', array('jquery'), $mgm_v, true );
	wp_enqueue_style ( 'jackbox-css', get_template_directory_uri() . '/inc/jackbox/css/jackbox.css', array(), 'all' );
	}
	
	//Responsive menu
	wp_enqueue_script('small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	
	//Masonry Blog Style
	if ( !is_singular() ) {
		wp_enqueue_script( 'jquery-masonry');
	}
	
	//Retina.js
	if ( of_get_option('mgm_retina') ) {
	wp_enqueue_script( 'retina-js', get_template_directory_uri() . '/js/retina.min.js', array( 'jquery' ), '1.3.0', true ); }


	//Threaded Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	//Deregister Unneeded Styles  [ already incorporated with MightyMag ]
	add_action( 'wp_print_styles', 'deregister_styles', 100 );
	function deregister_styles() {
		
		//Contact Form 7
        wp_deregister_style( 'contact-form-7' );
		
		//PageBuilder
		wp_deregister_style( 'flexslider' );
		wp_deregister_style( 'prettyphoto' );
		
		//BuddyPress
		wp_deregister_style( 'bp' );
		
		//Twitter widget CSS
		wp_deregister_style( 'tp_twitter_plugin_css' );
		
		//Social Count Plus
		wp_deregister_style( 'social-count-plus' );
		
		//Bbpress
		wp_deregister_style( 'bbp-default' );
		
		}
		
		//BWL Pro Voting Manager @since MGM 1.5
		if (function_exists('bwl_pvm_set_ajax_url')) /* Load only if plugin is enabled */ {
			
			wp_deregister_style( 'bwl-pro-font-awesome-styles' );
			wp_deregister_style( 'bwl-pro-voting-manager-animated-styles' );		
			wp_enqueue_style ( 'mgm-voting', get_template_directory_uri() . '/inc/voting/css/mgm-voting.css', array(), 'all' );

		}
		
	}
	
add_action( 'wp_enqueue_scripts', 'mgm_scripts' );


/*
==========================================================
BWP MINIFY SETUP
==========================================================
*/

//Apply dir filter
add_filter('bwp_minify_min_dir', 'mgm_set_bwp_min_directory');
function mgm_set_bwp_min_directory()
{
	return get_template_directory_uri() . '/inc/bwp-minify/min/';
}

//Scripts to minify
add_filter('bwp_minify_allowed_scripts', 'mgm_allowed_scripts');
function mgm_allowed_scripts()
{
	$minify_js = of_get_option('mgm_minify_js');
	
	if ($minify_js) {
		
		return array( 'djwd-js', 'bootstrap-js', 'comment-reply', 'jackbox', 'flexslider', 'fitvids', 'jquery-masonry', 'masonry', 'elastislide', 'retina-js', 'small-menu', 'jquery-form', 'contact-form-7', 'login-with-ajax', 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-accordion', 'jquery-ui-widget', 'isotope', 'jquery-tools', 'wpb_composer_front_js', 'jquery_ui_tabs_rotate', 'paginating_js', 'wpb_bootstrap_modals_js', 'dtheme-ajax-js', 'bp_core_widget_members-js', 'groups_widget_groups_list-js', 'sticky-js', 'mgm-codepeople-search-in-place', 'mgm-bbpress-js', 'bbpress-editor', 'bp-confirm', 'wow-js', 'shop-js', /* since @MGM 1.5 */'bwl-pro-voting-manager-tipsy-script', 'bwl-pro-voting-manager-custom-script' );
		
	}
	
}

//Styles to minify
add_filter('bwp_minify_allowed_styles', 'mgm_allowed_styles');
function mgm_allowed_styles()
{	
	$minify_css = of_get_option('mgm_minify_css');
	
	if ($minify_css) {
		
		return array( 'style', 'mgm-vc', 'jackbox-css', 'less-code', /*'bootstrap-css',*/ 'bbp-default', 'animate-css', /* since MGM 1.5 */ 'bwl-pro-voting-manager-styles', 'bwl-pro-voting-manager-tipsy-styles', 'mgm-voting'  );
		
	}
}

//Remove Admin Settings Page
add_action( 'admin_menu', 'mgm_remove_menus', 999 );
function mgm_remove_menus() {

	remove_submenu_page( 'options-general.php', 'bwp_minify_general' );

}

/*
==========================================================
ENQUEUE ADMIN SCRIPTS
==========================================================
*/

function mgm_admin_scripts() {
	wp_enqueue_script('ios-checkboxes', get_template_directory_uri() . '/admin/options-core/js/djwd-admin.js');

}
add_action('admin_enqueue_scripts', 'mgm_admin_scripts');


/*
==========================================================
FAVICON
==========================================================
*/

function mgm_favicon() {
	$favicon = of_get_option('mgm_favicon', false);
	if ( $favicon ) {
        echo '<link rel="shortcut icon" href="'.  $favicon  .'"/>'."\n";
    }
}

add_action('wp_head', 'mgm_favicon', 1);


/*
==========================================================
<HEAD> CSS ADD-ONS
==========================================================
*/

function mgm_head_css_addons(){
	
	// Left Sidebar
	
	$left_sidebar = of_get_option('mgm_sidebar_position') == 'sidebar-content';
	
	if ( $left_sidebar ) { ?>
		<style>

		#sidebar {
			/*float:left!important;*/
			margin-left:0;
			
		}

		#primary {	
			margin-left:auto;
			float:right!important;
		}

		@media (max-width: 767px) {
		
		#sidebar {
				display: inline-block;
				margin-top: 20px;
				width: 100%;
		}
			
		#primary {
				float:none!important;
				margin-left:0;
			}
		}
		</style>
	<?php };
	
	
	//User Custom CSS
	
	if ( of_get_option('mgm_custom_css') ) { ?>
	
		<style><?php echo of_get_option('mgm_custom_css'); ?></style>
	
	<?php };
	
};

add_action('wp_head','mgm_head_css_addons');



/*
==========================================================
GOOGLE ANALYTICS
==========================================================
*/
 
function mgm_analytics(){
	$output = of_get_option( 'mgm_google_analytics' );
	if ( $output <> "" )
		echo stripslashes($output) . "\n";
}

add_action( 'wp_footer','mgm_analytics' );


/*
==========================================================
MAIN NAV ALTERATIONS
==========================================================
*/

/* Start Menu Walker */
//add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
class mgm_Category_Walker extends Walker_Nav_Menu {
		
    function start_lvl (&$output, $depth = 0, $args = array(), $id = 0)  {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-links\">\n";
    }
	
    function end_lvl (&$output, $depth = 0, $args = array(), $id = 0) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
	
    function start_el (&$output, $item, $depth = 0, $args = array(), $id = 0) {

        global $wp_query;
		$cat = $item->object_id;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		/*$output .= '<form method="get" id="searchform" class="a" action="'.esc_url( home_url( '/' ) ).'" role="search">
		
			<input type="text" class="field" name="s" value="'.esc_attr( get_search_query() ).'" id="s" placeholder="Search here" />
	
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="" />
	</form>';*/

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		
		$menu_posts_on = get_tax_meta($cat,'mgm_menu_posts') == 'on';
		
        $item_output .= $args->after;
		
		// Insert description for top level elements only
		
		$description = (!empty ($item->description) and 0 == $depth)

			?'<small class="nav_desc">' . esc_attr($item->description) . '</small>' : '';

		$title = apply_filters('the_title', $item->title, $item->ID);

		$args = (object)$args;
		
		$item_output = $args->before
			. "<a $attributes>"
			. $args->link_before
			. $title
			. '</a>'
			. $args->link_after
			. $description
			. $args->after;
									
		
		/* Add Posts previews only for 
		 * Parent category
		 */
		if ( $depth == 0 && $item->object == 'category' ) { 
			
			$cat = $item->object_id;
			
		if ( $menu_posts_on /*&& !empty( $children )*/ ) // Show if option is selected and category ain't empty.
			
			{
				
				if ( !empty($children) ) {
				$item_output .= '<ul class="sub-posts">';
				}
				
				else {
				$item_output .= '<ul class="sub-posts no-children">';
				}
				
					global $post;
					$post_args = array( 'numberposts' => 4, 'offset'=> 0, 'category' => $cat, 'meta_key' => '_thumbnail_id' );
					$menuposts = get_posts( $post_args );
					
					foreach( $menuposts as $post ) : setup_postdata( $post );
					
						$post_title = get_the_title();
						$post_link = get_permalink();
						$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "menu-thumbs" );
						
						if ( $post_image ){
							$menu_post_image = '<img src="' . $post_image[0]. '" alt="' . $post_title . '" width="' . $post_image[1]. '" height="' . $post_image[2]. '" />';
						} else {
							$menu_post_image = __( 'No image','mightymag');
						}

						$item_output .= '
								<li class="col-md-3">
								<figure>
								<a href="'  .$post_link . '">' . $menu_post_image . '</a>
								</figure>
								<a class="menu-post-links" href="' . $post_link . '">' . $post_title . '</a>
								</li>';
						
					endforeach;
					wp_reset_query();
					
				$item_output .= '</ul>';
			}
		
		}

		
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }
	
    function end_el (&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$cat = $item->object_id;
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		
		$output .= "</li>\n";
    }

    /*function add_search_box_to_menu( $items, $args ) {
	    if( $args->theme_location == 'primary' )
	        return $items.get_search_form();

	    return $items;
	}*/
}






/*
==========================================================
TRIMMING TOOLS
==========================================================
*/

//String Limit Title by letters
function mgm_trimd_title ($after = '', $length) 
{	
	$mytitle = get_the_title();
	if ( strlen($mytitle) > $length ) {
	$mytitle = substr($mytitle,0,$length);
	echo $mytitle . $after;
	} else {
	echo $mytitle;
	}
}

//String Limit by words
function mgm_string_limit_words($string, $word_limit)
{
	$words = explode(' ', $string, ($word_limit + 1));
	
	if(count($words) > $word_limit) {
		array_pop($words);
	}
	
	return implode(' ', $words);
}


/*
==========================================================
LINK THUMBNAILS TO PERMALINK
==========================================================
*/

function mgm_post_image_html( $html, $post_id, $post_image_id ) {
 
$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
 
return $html;
}

add_filter( 'post_thumbnail_html', 'mgm_post_image_html', 10, 3 );


/*
==========================================================
BREADCRUMBS
==========================================================
*/

function mgm_breadcrumb() {

	/* === OPTIONS === */
	$text['home']     = '<span class="glyphicon glyphicon-home"></span> ' . __('Home', 'mightymag'); // text for the 'Home' link
	$text['category'] = __('Category: <strong>%s</strong>', 'mightymag'); // text for a category page
	$text['search']   = __('Search results for <strong>%s</strong>', 'mightymag'); // text for a search results page
	$text['tag']      = __('Posts tagged <strong>%s</strong>', 'mightymag'); // text for a tag page
	$text['author']   = __('Articles posted by <strong>%s</strong>', 'mightymag'); // text for an author page
	$text['404']      = __('Error 404', 'mightymag'); // text for the 404 page

	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title     = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter      = ''; // delimiter between crumbs
	$before         = '<li class="current">'; // tag before the current crumb
	$after          = '</li>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$home_link    = home_url('/');
	$link_before  = '<li typeof="v:Breadcrumb">';
	$link_after   = '</li>';
	$link_attr    = ' rel="v:url" property="v:title"';
	$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id    = $post->post_parent;
	$frontpage_id = get_option('page_on_front');

	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) echo '<ul class="breadcrumb"><a href="' . $home_link . '">' . $text['home'] . '</a></ul>';

	} else {

		echo '<ul class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
		if ($show_home_link == 1) echo sprintf($link, $home_link, $text['home']);
		if ($parent_id != $frontpage_id && $show_home_link == 1) echo $delimiter;

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
			$cats = str_replace('</a>', '</a>' . $link_after, $cats);
			if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($parent_id != $frontpage_id || $show_home_link == 1) echo $delimiter;
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page','mightymag') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</ul><!-- .breadcrumbs -->';

	}
}

/* Remove not (yet) html5 valid [rel="category"] attribute on categories */

function mgm_remove_category_rel($output)
{
    $output = str_replace(' rel="category"', '', $output);
    return $output;
}
add_filter('the_category', 'mgm_remove_category_rel');

/*
==========================================================
COMMENT FORM ALTERATIONS
==========================================================
*/

function mgm_alter_comment_form($new_defaults) {

//required variables for changing the fields value
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$new_fields = array(
'author' => '<div class="comment-form-input comment-form-author">' . '<label for="author">' . __( 'Name', 'mightymag' ) . '</label>
<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
<input class="form-control" id="author" name="author" type="text" placeholder="'. esc_attr__('Name','mightymag') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . $aria_req . ' /><span class="glyphicon glyphicon-asterisk"></span></div>'.( $req ? '' : '' ).'</div>',

'email' => '<div class="comment-form-input comment-form-email">' . '<label for="email">' . __( 'Email', 'mightymag' ) . '</label>
<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
<input class="form-control" id="email" name="email" type="text" placeholder="'. esc_attr__('Email','mightymag') . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="20"' . $aria_req . ' /><span class="glyphicon glyphicon-asterisk"></span></div>' . ( $req ? '' : '' ) . '</div>',
				
'url' => '<div class="comment-form-input comment-form-url">' . '<label for="url">' . __( 'Url', 'mightymag' ) . '</label>
<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
<input class="form-control" id="url" name="url" type="text" placeholder="'. esc_attr__('Website','mightymag') . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="20"' . $aria_req . ' /></div></div>',
);

$new_defaults['fields'] = apply_filters('comment_form_default_fields', $new_fields);
$new_defaults['comment_field'] = '<div class="comment-form-input comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'mightymag' ) . '</label><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true"></textarea></div>';

$new_defaults['title_reply'] = __( 'Leave a Comment', 'mightymag');


return $new_defaults;
}

add_filter('comment_form_defaults', 'mgm_alter_comment_form');


/*
==========================================================
PAGINATION
==========================================================
*/

function mgm_num_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='page-nav'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."' class='page-numbers'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class='page-numbers'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='page-numbers current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='page-numbers' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."' class='page-numbers boxed'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."' class='page-numbers'>&raquo;</a>";
         echo "</div>\n";
		 echo "<div class='clear'></div>";
     }
}


/*
==========================================================
REMOVE CAPTIONS ADDITIONAL 10PX
==========================================================
*/


function mgm_fix_img_caption_shortcode($val, $attr, $content = null) {
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) ) return $val;

    return '<div id="' . $id . '" class="wp-caption ' . esc_attr($align) . '" style="width: ' . (2 + (int) $width) . 'px">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

add_filter('img_caption_shortcode', 'mgm_fix_img_caption_shortcode', 10, 3);


/* ================ SHORTCODE BOX ARTICLES ================== */
	function cstm_box_articles($atts){
		extract(shortcode_atts(array(
        'item'    => '',
        'category' => 'tips',
    ), $atts));

		$args = array(
			'post_type' => 'post',
			'post_status'	=> 'publish',
			'posts_per_page' => $item,
			'orderby'	=> 'rand',
		);

		$posts = get_posts($args);

		$categories = get_the_category();

		$retval = '<div class="box-featured-articles">
			<h3> Baca Juga Artikel Ini : </h3>

			<ul>';

		for($i=0;$i<sizeof($posts);$i++){
			$retval .= '<li> <a href="'.get_permalink($posts[$i]->ID).'">'.$posts[$i]->post_title.'</a></li>';
		}
		$retval .= '</ul>
		</div>';

		return $retval;
	}
	add_shortcode('box_articles', 'cstm_box_articles');

/*
==========================================================
FIX .DATE CLASS CONFLICT
==========================================================
*/


function mgm_remove_a_body_class($wp_classes) {
if( is_date() ) :
      foreach($wp_classes as $key => $value) {
      if ($value == 'date') unset($wp_classes[$key]);
      }
endif;
return $wp_classes;
}

add_filter('body_class', 'mgm_remove_a_body_class', 20, 2);

/*
==========================================================
GET FEATURED IMAGE WHEN SHARING A POST ON FB
==========================================================
*/

function mgm_insert_image_src_rel_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image= get_template_directory_uri() . '/images/no_thumb.png'; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "
";
}
add_action( 'wp_head', 'mgm_insert_image_src_rel_in_head', 5 );



/*
==========================================================
REMOVE ADMIN BAR
==========================================================
*/

function mgm_remove_admin_bar() {
	  
	$mgm_wptopbar = of_get_option('mgm_wptopbar');

	if ($mgm_wptopbar) {
	  
	  if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
		  }
	}

}

add_action('after_setup_theme', 'mgm_remove_admin_bar');



/*
==========================================================
GET POST VIEWS
==========================================================
*/


// function to display number of posts.
function mgm_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '<span class="glyphicon glyphicon-eye-open"></span> 0';
    }
    return '<span class="glyphicon glyphicon-eye-open"></span> '. $count;
}

// function to count views.
function mgm_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// Add it to a column in WP-Admin

function mgm_posts_column_views($defaults){
    $defaults['post_views'] = __('Views', 'mightymag');
    return $defaults;
}

add_filter('manage_posts_columns', 'mgm_posts_column_views');

function mgm_posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){ 
        echo mgm_get_post_views(get_the_ID());
    }
}

add_action('manage_posts_custom_column', 'mgm_posts_custom_column_views',5,2);


/*
==========================================================
TGM PLUGIN ACTIVATION CLASS
==========================================================
*/

add_action( 'tgmpa_register', 'mgm_register_required_plugins' );

function mgm_register_required_plugins() {

    $plugins = array(
 
        array(
            'name'      => 'Social Count Plus',
            'slug'      => 'social-count-plus',
            'required'  => false,
			'version'		=> '3.0',
        ),
		
		array(
            'name'			=> 'WPBakery Visual Composer',
            'slug'			=> 'js_composer',
            'source'		=> get_template_directory() . '/inc/tgm-plugin-activation/plugins/js_composer.zip',
			'version'		=> '4.12',
            'required'		=> false,
        ),
		
		array(
			'name'     				=> 'Envato WordPress Toolkit',
			'slug'     				=> 'envato-wordpress-toolkit-master',
			'source'   				=> get_stylesheet_directory() . '/inc/tgm-plugin-activation/plugins/envato-wordpress-toolkit-master.zip',
			'required' 				=> false,
			'version' 				=> '1.6.3',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),
		
		array(
			'name'     				=> 'BWL Pro Voting Manager',
			'slug'     				=> 'bwl-pro-voting-manager',
			'source'   				=> get_stylesheet_directory() . '/inc/tgm-plugin-activation/plugins/bwl-pro-voting-manager.zip',
			'required' 				=> false,
			'version' 				=> '1.0.6',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),
		
    );

 
    $theme_text_domain = 'mightymag';
    $config = array(
        'domain'            => $theme_text_domain,
        'default_path'      => '',
        'parent_menu_slug'  => 'themes.php',
        'parent_url_slug'   => 'themes.php',
        'menu'              => 'install-required-plugins',
        'has_notices'       => true,
        'is_automatic'      => false,
        'message'           => '',
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ),
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'               => _n_noop( 'MightyMag requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
            'notice_can_install_recommended'            => _n_noop( 'MightyMag recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain )
        )
    );
 
    tgmpa( $plugins, $config );
 
}


/*
==========================================================
TRULY IDENTIFY IF WOOCOMMERCE IS ACTIVE
==========================================================
*/


function mgm_is_really_woocommerce() {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
}


/*
==========================================================
FIN
==========================================================
*/

/* =============== CUSTOM POST TYPE ==================== */
	
require_once ( 'libraries/init.php' );


/* ================= QUERY ARCHIVE ===================== */
function wpd_archive_query( $query ){
    if( ! is_admin()
        && $query->is_main_query() ){
            $query->set( 'posts_per_page', 8 );
    }
}
add_action( 'pre_get_posts', 'wpd_archive_query' );

/*
==========================================================
Custom Register
==========================================================
*/

include 'custom/ajax-function.php';

/**
 * Remove admin bar for non administrator (user)
 */
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
	if (!is_user_logged_in()) {
		add_filter( 'show_admin_bar', '__return_false' , 1000 );
	}
}

add_filter( 'wpmu_signup_blog_notification', '__return_false' );
add_filter( 'bp_registration_needs_activation', '__return_false' );


?>
