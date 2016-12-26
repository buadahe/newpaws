<!-- Vertically Center Aligned Triggers
================================================== -->

<?php 
$newsletter = of_get_option('mgm_collapsible_newsletter');
$login = is_active_sidebar('login-sidebar');
$custom = of_get_option('mgm_collapsible_custom');
$custom_tooltip = of_get_option('mgm_collapsible_custom_tooltip')
?>

<div id="collapse-trigger-wrap">
	<div id="collapse-trigger">
		<div id="collapse-icons-wrap">
			
			<div id="collapse-icons">
				
				<?php if ($newsletter) { ?>
				<a class="accordion-toggle ico-newsletter" data-toggle="collapse" data-parent="#mgm-full-collapsible" href="#mgm-collapse-newsletter" title="Newsletter"><span class="glyphicon glyphicon-envelope"></span></a>
				<?php } ?>
				
				<?php if ($login) { ?>
				<a class="accordion-toggle ico-login" data-toggle="collapse" data-parent="#mgm-full-collapsible" href="#mgm-collapse-login" title="Login&nbsp;&frasl;&nbsp;Register"><span class="glyphicon glyphicon-user"></span></a>
				<?php } ?>
				
				<?php if ($custom) { ?>
				<a class="accordion-toggle ico-custom" data-toggle="collapse" data-parent="#mgm-full-collapsible" href="#mgm-collapse-custom"<?php if ($custom_tooltip) { echo ' title="' . $custom_tooltip . '"'; } ?>><span class="glyphicon glyphicon-plus"></span></a>
				<?php } ?>
			
			</div>
			
		</div>
	</div>
</div>