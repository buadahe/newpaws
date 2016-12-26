<?php
/**
 * The template for displaying search forms in MightyMag
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>
	
	
		<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
			<label for="s" class="assistive-text"><?php _e( 'Search', 'mightymag' ); ?></label>
			
			<div class="input-group">
				<input type="text" class="field form-control" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search here', 'mightymag' ); ?>" />
				
				<div class="input-group-btn">
					<input type="submit" class="submit btn btn-success" name="submit" id="searchsubmit" value="<?php echo esc_attr('Search','mighymag'); ?>" />
				</div>
				
			</div>
		</form>