<?php 

/*
 * Declaring WooCommerce Support
*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


/**
 * Optimize WooCommerce Scripts
 * Removes WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */


function mgm_wc_script_optimization() {
	
	//Enqueue shop js file
	wp_enqueue_script( 'shop-js', get_template_directory_uri() . '/js/shop.js', array( 'jquery' ), true );
	
	//remove generator meta tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

	//re-check that woo exists to prevent fatal errors, just in case
	if ( function_exists( 'is_woocommerce' ) ) {
		
		//dequeue scripts and styles on non wc pages
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			wp_dequeue_style( 'woocommerce-layout' );
			wp_dequeue_style( 'woocommerce-general' );
			wp_dequeue_style( 'woocommerce-smallscreen' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );
		}
	}
	
	//always remove these (Jackbox will be used instead)
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	
}

add_action( 'wp_enqueue_scripts', 'mgm_wc_script_optimization', 99 );


// Separate Breadcrumbs from content wrappers

function mgm_woocommerce_remove_breadcrumb(){
remove_action( 
    'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
add_action(
    'woocommerce_before_main_content', 'mgm_woocommerce_remove_breadcrumb'
);

function mgm_woocommerce_custom_breadcrumb(){
    woocommerce_breadcrumb();
}

add_action( 'woo_custom_breadcrumb', 'mgm_woocommerce_custom_breadcrumb' );



// Customize Breadcrumbs

function mgm_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '<span class="glyphicon glyphicon-chevron-right"></span>';
	return $defaults;
}

add_filter( 'woocommerce_breadcrumb_defaults', 'mgm_change_breadcrumb_delimiter' );


// Change number or products per row to 3

if (!function_exists('loop_columns')) {
	function mgm_loop_columns() {
		return 3; // 3 products per row
	}
}

add_filter('loop_shop_columns', 'mgm_loop_columns');

// Display 9 products per page

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );

// Reordering single product HTML

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 30 );

?>