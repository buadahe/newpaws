<?php

/*
Template Name: MightyMag Widgetized Home 8
*/

?>

<?php get_header(); ?>



<?php if ( of_get_option('tabs_activate')) { get_template_part( 'partials/part', 'tabs' ); } // Get Home Tabs if enabled ?>
		<!-- afrgun -->
		<?php if (of_get_option('mgm_ad_middle') != NULL) { // Middle Banner
		
			$everywhere = of_get_option('mgm_ad_middle_display') == 'all'; 
			$home = of_get_option('mgm_ad_middle_display') == 'home';
			$nothome = of_get_option('mgm_ad_middle_display') == 'nothome';
		
			if ( $home AND is_front_page() OR ($nothome AND !is_front_page() OR $everywhere ) ) {
			?>
			
			<div id="mgm-middle-ad">
                <a href="https://www.facebook.com/SmartHeart-Indonesia-1086366294709830/?fref=ts" target="_blank"><?php echo ( of_get_option('mgm_ad_middle') ); ?></a>
			</div>

			<hr class="mgm-separator"/>
			
			<?php }
		} ?>
		<!-- afrgun -->

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			
				<div class="row" id="widgetized-home">
				
				<?php // Get the correct Left Sidebar
					
					if (of_get_option('mgm_sidebar_position') == 'sidebar-content')
					
				{ ?>
						
					<div class="clearfix visible-sm"></div>

					<div class="col-md-4 col-sm-12 widgetized w-3">
					
						<?php get_template_part('partials/part', 'home-sidebar'); ?>
					
					</div>
						
				<?php } ?>
					
					
				<?php // Output the First Widgetized Area ?>
					
					<div class="col-md-8 col-sm-12 col-xs-12 widgetized w-1">
					
						<?php
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Left')): 
						endif;
						?>
					
					</div>
					
					
				<?php // Output the Second Widgetized Area ?>
				
					<!--div class="col-md-4 col-sm-6 col-xs-12 widgetized w-2">
						
						<?php
						/*if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Middle')): 
						endif;*/
						?>

					</div-->	
					
					
				<?php //Get the correct Right Sidebar
					
					if (of_get_option('mgm_sidebar_position') == 'content-sidebar')
					
				{ ?>
						
					<div class="clearfix visible-sm"></div>

					<div class="col-md-4 col-sm-12 widgetized w-3">
					
						<?php get_template_part('partials/part', 'home-sidebar'); ?>
                           
					</div>
						
				<?php } ?>
					
				</div><!-- .row #widgetized-home -->

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
		
		<!-- afrgun -->
		<?php if (of_get_option('mgm_ad_middle_second') != NULL) { // Bottom Banner
				
					$everywhere = of_get_option('mgm_ad_middle_display_second') == 'all'; 
					$home = of_get_option('mgm_ad_middle_display_second') == 'home';
					$nothome = of_get_option('mgm_ad_middle_display_second') == 'nothome';
				
					if ( $home AND is_front_page() OR ($nothome AND !is_front_page() OR $everywhere ) ) {
					?>
					
					<hr class="mgm-separator"/>

					<div id="mgm-bottom-ad">
					    <?php echo ( of_get_option('mgm_ad_middle_second') ); ?>
					</div>

					<hr class="mgm-separator"/>
					
					<?php }
		}?>
		<!-- afrgun -->


		<?php if ( of_get_option('tabs_activate_custom')) { get_template_part('partials/part', 'tabs-custom');} ?><!-- afrgun -->

		

		
	
<?php get_footer(); ?>
