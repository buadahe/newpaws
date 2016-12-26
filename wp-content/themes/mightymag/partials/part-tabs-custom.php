<div id="hometabs-wrap" class="row"> <!-- afrgun -->
	<div class="cat-tabs col-md-12 clearfix">

			<div class="mgm-title mgm-title-tabs">
				<?php if(of_get_option('tab9_title') != '') { ?>
				<span><a href="#"><?php echo of_get_option('tab9_title'); ?></a></span>
				<?php } ?>
			</div>

	</div>

	<!-- afrgun -->
		<?php if (of_get_option('banner_ask_doctor') != NULL) { // Bottom Banner
				
					$everywhere = of_get_option('banner_ask_doctor_display') == 'all'; 
					$home = of_get_option('banner_ask_doctor_display') == 'home';
					$nothome = of_get_option('banner_ask_doctor_display') == 'nothome';
				
					if ( $home AND is_front_page() OR ($nothome AND !is_front_page() OR $everywhere ) ) {
					?>

					<div id="mgm-bottom-ad" class="banner_ask_doctor">
						<a href="mailto:info.pawsunion@gmail.com?subject=Konsultasi">
					    <?php echo ( of_get_option('banner_ask_doctor') ); ?>
					   </a>
					</div>

					<hr class="mgm-separator"/>
					
					<?php }
		}?>
		<!-- afrgun -->
	
	<?php
	$tab9 = "tab9";
	?>
		
	<?php if(of_get_option('tab9_title') != '') { ?>
	<div class="cat-panes-content" style="margin: 0 5px;">
	<?php mgm_cat_tabs_custom($tab9); ?>
	</div>
	<?php } ?>
	
	
</div>

<hr class="mgm-separator"/>
