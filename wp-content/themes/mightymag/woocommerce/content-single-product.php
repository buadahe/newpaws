<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<header class="entry-header boxed">
		
	<?php if ( of_get_option('mgm_breadcrumb') ) echo woocommerce_breadcrumb(); ?>
	
	<h1 class="entry-title"><?php the_title(); ?></h1>		
	
	<div class="clear"></div>
	
	<div class="entry-details clearfix">
		
		<div class="mgm-wc-cat cat-bg">
			
			<span>
			<?php
			
			$product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );

				 if ( $product_cats && ! is_wp_error ( $product_cats ) ){

					$single_cat = array_shift( $product_cats ); 
			} ?>

				<?php echo $single_cat->name; ?>
			</span>
			
		</div>
		
		<span class="mgm-details">
			
			<span class="entry-details-item">
				
					<span class="glyphicon glyphicon-comment"></span>
					<?php comments_number( '0', '1', '%' ) . _e(' reviews', 'mightymag');?>
			
			</span>
			
		</span>

	</div><!--entry-details-->
			
</header><!-- .entry-header -->


<div class="mgm-shop-share-wrap">
	<?php 
	/* Social Share Links */
	$social_share = of_get_option('mgm_social_share_switch');
	if ( $social_share ) {get_template_part( 'partials/part', 'social-share' ); 
	} ?>
</div>
	

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="mgm-product-single-wrap clearfix">
		
		<?php
			/**
			 * woocommerce_before_single_product_summary hook
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>
	
		<div class="summary entry-summary">
			
			<h4 class="mgm-single-product-title"><?php _e('Item Description','mightymag'); ?></h4>
			
			<div class="clear"></div>
		
			<?php
				/**
				 * woocommerce_single_product_summary hook
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>
	
		</div><!-- .summary -->
		
	</div><!-- .mgm-product-single-wrap -->
	

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
