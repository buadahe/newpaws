<div id="mgm-live-search" class="collapse">
	
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'mightymag' ); ?></label>
		
			<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search here', 'mightymag' ); ?>" />
	
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="" />
	</form>
	
</div>