<?php

/*
Template Name: MightyMag Widgetized Home 2
*/

?>

<?php get_header(); ?>

<?php if ( of_get_option('tabs_activate')) { get_template_part( 'partials/part', 'tabs' ); } // Get Home Tabs if enabled ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			
				<div class="row" id="widgetized-home">
				
				<?php // Get the correct Left Sidebar
					
					if (of_get_option('mgm_sidebar_position') == 'sidebar-content')
					
				{ ?>
						
					<div class="clearfix visible-sm"></div>

					<div class="col-md-3 col-sm-12 widgetized w-3">
					
						<?php get_template_part('partials/part', 'home-sidebar'); ?>
					
					</div>
						
				<?php } ?>
					
					
				<?php // Output the First Widgetized Area ?>
					
					<div class="col-md-5 col-sm-6 col-xs-12 widgetized w-1">
					
						<?php
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Left')): 
						endif;
						?>
					
					</div>
					
					
				<?php // Output the Second Widgetized Area ?>
				
					<div class="col-md-4 col-sm-6 col-xs-12 widgetized w-2">
						
						<?php
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Middle')): 
						endif;
						?>

					</div>	
					
					
				<?php //Get the correct Right Sidebar
					
					if (of_get_option('mgm_sidebar_position') == 'content-sidebar')
					
				{ ?>
						
					<div class="clearfix visible-sm"></div>

					<div class="col-md-3 col-sm-12 widgetized w-3">
					
						<?php get_template_part('partials/part', 'home-sidebar'); ?>
					
					</div>
						
				<?php } ?>
					
				</div><!-- .row #widgetized-home -->

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
<?php get_footer(); ?>