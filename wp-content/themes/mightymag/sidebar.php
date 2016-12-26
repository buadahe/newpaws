<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>
	<div id="sidebar">

		<div id="secondary" role="complementary">
		
		<?php do_action( 'before_sidebar' ); ?>			
		
		<?php 
				
				//Select wich sidebar will be display
				$selected_sidebar_replacement = 'sidebar-1'; //Default Sidebar
				
				//If is page or single.
				if(is_singular()){
					
					global $wp_query;
					$post = $wp_query->get_queried_object();
					$selected_sidebar_replacement = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
					
					//If default selected
					if($selected_sidebar_replacement == '0' || $selected_sidebar_replacement == ''){
						$selected_sidebar_replacement = 'sidebar-1';
					}
					
					// Reset the global $the_post as this query will have stomped on it
					wp_reset_query();
	
				}		
				
				if (function_exists('dynamic_sidebar') && dynamic_sidebar($selected_sidebar_replacement)) : else : ?>
				
			<p>You selected an empty sidebar, try populating it with some awesome widgets!</p>
			
			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary -->
	</div><!-- #sidebar -->
