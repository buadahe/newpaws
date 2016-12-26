<?php 
$newsletter = of_get_option('mgm_collapsible_newsletter');
$login = is_active_sidebar('login-sidebar');
$custom = of_get_option('mgm_collapsible_custom');
?>

<!-- open panel group -->
<div class="panel-group" id="mgm-full-collapsible">


<?php if ($newsletter) { ?>
<!-- Panel 1 - Newsletter
================================================== -->

	<div class="panel">
		<div id="mgm-collapse-newsletter" class="panel-collapse collapse">
			<div class="mgm-collapse-content-all">
			
			<?php if ( of_get_option('mgm_collapsible_newsletter') ) { ?>
		
			<span><?php echo of_get_option('mgm_collapsible_nl_catch')?></span>
			<div class="mgm-newsletter-form">
			
				<!-- Begin MailChimp Signup Form -->

				<div id="mc_embed_signup">
					<form action="<?php echo of_get_option('mgm_collapsible_nl_action'); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<input type="email" value="" name="EMAIL" class="email form-control col-md-4" id="mce-EMAIL" placeholder="<?php _e('Enter your email address', 'mightymag'); ?>" required>
						<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;"><input type="text" name="<?php echo of_get_option('mgm_collapsible_nl_name'); ?>" tabindex="-1" value=""></div>
						<div class="clear"><input type="submit" value="<?php _e('Subscribe', 'mightymag'); ?>" name="subscribe" id="mc-embedded-subscribe" class="btn btn-success btn-lg"></div>
					</form>
					
				</div><!--End mc_embed_signup-->
			
			</div>
					
			<?php } ?>
			
			</div>
		</div>
	</div>
<?php } ?>


<?php if ($login) { ?>
<!-- Panel 2 - Login / Register
================================================== -->

	<div class="panel">
		<div id="mgm-collapse-login" class="panel-collapse collapse">
			<div class="mgm-collapse-content-all">
			
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('login-sidebar')): 
				endif;
				?>
				
			</div>
		</div>
	</div>
<?php } ?>

<?php if ($custom) { ?>
<!-- Panel 3 - Unknown
================================================== -->
	
	<div class="panel">
		<div id="mgm-collapse-custom" class="panel-collapse collapse">
			<div class="mgm-collapse-content-all">
			
				<?php echo of_get_option('mgm_collapsible_custom_textarea'); ?>
				
			</div>
		</div>
	</div>
<?php } ?>

<!-- closing panel group -->
</div>
