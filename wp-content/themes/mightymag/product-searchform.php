<?php
/**
 * The template for displaying Woocommerce Products search form
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>
	
	
		<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
			<label for="s" class="assistive-text"><?php _e( 'Search for products', 'mightymag' ); ?></label>
			
			<div class="input-group">
				<input type="text" class="field form-control" name="s" value="<?php echo get_search_query(); ?>" id="s" placeholder="<?php esc_attr_e( 'Search for products', 'mightymag' ); ?>" />
				
				<div class="input-group-btn">
					<input type="submit" id="searchsubmit"  class="submit btn btn-success" value="<?php echo esc_attr__( 'Search' ); ?>" />
					<input type="hidden" name="post_type" value="product" />
				</div>
				
			</div>
		</form>
		
		
