<?php

/*
Template Name: MightyMag Widgetized Home 6
*/

?>

<?php get_header(); ?>

<?php if ( of_get_option('tabs_activate')) { get_template_part( 'partials/part', 'tabs' ); } // Get Home Tabs if enabled ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			
				<div class="row" id="widgetized-home">
				
					
				<?php // Output the First Widgetized Area ?>
					
					<div class="col-md-6 col-sm-6 col-xs-12 widgetized w-1">
					
						<?php
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Left')): 
						endif;
						?>
					
					</div>
					
					
				<?php // Output the Second Widgetized Area ?>
				
					<div class="col-md-6 col-sm-6 col-xs-12 widgetized w-2">
						
						<?php
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Middle')): 
						endif;
						?>

					</div>	
					
					
				</div><!-- .row #widgetized-home -->

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
<?php get_footer(); ?>