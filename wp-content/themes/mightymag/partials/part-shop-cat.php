<!-- Shop Category Image
================================================== -->

<?php 

global $wp_query;
$cat = $wp_query->get_queried_object();

if(isset($cat->term_id)) {
	$thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true );
} else {
	$thumbnail_id = '';
}

$image = wp_get_attachment_url( $thumbnail_id );

if ($image) {

?>

<div class="mgm-shop-thumb-wrap">

	<img src="<?php echo $image ?>"/>
	
	<div class="mgm-shop-thumb-details">

		<span class="relative-wrap">
		
			<span class="mgm-shop-page-title cat-bg mgm-font">
				<?php woocommerce_page_title(); ?>
			</span>
		
			<span class="mgm-shop-cat-desc mgm-font">
				<?php $args = array( 'taxonomy' => 'product_cat' );
					$terms = get_terms('product_cat', $args);
					
						$count = count($terms); 
						if ($count > 0) {
					
							foreach ($terms as $term) {
								echo $term->description;
					
						}
				} ?>
			</span>
	
		</span>
	
	</div><!-- .relative-wrap -->
	
</div><!-- .mgm-shop-thumb-wrap -->

<?php } ?>
