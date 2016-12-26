<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' );

$mgm_woo_sidebar = of_get_option('mgm_woo_sidebar'); ?>

<div class="row">
		
	<div id="primary" class="content-area <?php if ($mgm_woo_sidebar != 'none') { echo 'col-md-8'; } else { echo 'col-md-12'; } ?>">
		<div id="content" class="site-content" role="main">

	
		<?php
			/**
			 * woocommerce_before_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action( 'woocommerce_before_main_content' );
		?>
	
			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php wc_get_template_part( 'content', 'single-product' ); ?>
	
			<?php endwhile; // end of the loop. ?>
	
		<?php
			/**
			 * woocommerce_after_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );
		?>

	
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

	<?php if ($mgm_woo_sidebar != 'none') { ?>
	<div class="col-md-4 mgm-shop-sidebar">
		<?php if ( of_get_option('mgm_woo_sidebar') == 'woocommerce_sidebar' ) {			
				
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('WooCommerce')): endif;
				
		 		} else { get_sidebar( 'woocommerce' );
		}; ?>
	</div>
	<?php }; ?>
	
</div><!-- .row (content)-->
<?php get_footer( 'shop' ); ?>