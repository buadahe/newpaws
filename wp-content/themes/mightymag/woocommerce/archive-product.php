<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' );

global $wp_query;
$cat = $wp_query->get_queried_object();

if(isset($cat->term_id)) {
	$thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true );
} else {
	$thumbnail_id = '';
}

$image = wp_get_attachment_url( $thumbnail_id );

$mgm_woo_sidebar = of_get_option('mgm_woo_sidebar'); 
?>

<div class="row">
		
	<div id="primary" class="content-area <?php if ($mgm_woo_sidebar != 'none') { echo 'col-md-8'; } else { echo 'col-md-12'; } ?>">
		<div id="content" class="site-content" role="main">

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			
			<?php if(!$image) { ?>
			<header class="entry-header boxed clearfix">
			
				<?php if ( of_get_option('mgm_breadcrumb') ) echo woocommerce_breadcrumb(); ?>
				<h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>	
				
				<div class="taxonomy-description reply-wrap">
					<p>
					<?php $args = array( 'taxonomy' => 'product_cat' );
					$terms = get_terms('product_cat', $args);
					
						$count = count($terms); 
						if ($count > 0) {
					
							foreach ($terms as $term) {
								echo $term->description;
					
							}
					} ?>
					</p>
				</div>
				
			</header>
			<?php } ?>
			
		<?php endif; ?>
		
		<?php
			/**
			 * woocommerce_before_main_content hook
			 
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action( 'woocommerce_before_main_content' );
		?>
		
		<?php get_template_part('partials/part', 'shop-banner'); ?>
		
		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>
			
			<div class="mgm-sort-wrap reply-wrap clearfix<?php if (!$image) { echo ' middle-top';} ?>">
			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>
			</div>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
	
				<?php wc_get_template( 'loop/no-products-found.php' ); ?>
	
			<?php endif; ?>
	
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