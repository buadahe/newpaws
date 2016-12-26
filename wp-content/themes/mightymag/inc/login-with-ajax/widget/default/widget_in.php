<div class="lwa">
	<div class="mgm-logged-wrap">
	
			<div class="btn-group">
					
					<span class="btn btn-default lwa-welcome" data-toggle="modal" data-target="#mgm-notifications-modal">
						<?php 
						global $current_user;
						get_currentuserinfo();
						?>
						<span class="lwa-avatar">
						<?php echo get_avatar( $current_user->ID, $size = '44' );  ?>
						</span>
						
						<span class="lwa-title"><?php echo __( 'Hi', 'mightymag' ) . " " . $current_user->display_name . '!';  ?></span>
					</span>
					
					<?php
					//Admin URL
					if ( $lwa_data['profile_link'] == '1' ) {
						if( function_exists('bp_loggedin_user_link') ){
					?>
					
					<a href="<?php bp_loggedin_user_link(); ?>" class="btn btn-success">
						<span class="glyphicon glyphicon-user"></span>
						<?php esc_html_e('Profile','mightymag') ?>
					</a>
					
					<?php	
					} else {
					?>
					
					<a href="<?php echo trailingslashit(get_admin_url()); ?>profile.php" class="btn btn-success">
						<span class="glyphicon glyphicon-user"></span>
						<?php esc_html_e('Profile','mightymag') ?>
					</a>
					<?php	
							}
					}
					
					//Logout URL
					?>
					<a id="wp-logout" href="<?php echo wp_logout_url() ?>" class="btn btn-success">
						<span class="glyphicon glyphicon-log-out"></span>
						<?php esc_html_e( 'Log Out' ,'mightymag') ?>
					</a>
					
					<?php
					//Blog Admin
					if( current_user_can('list_users') ) {
					?>
					<a href="<?php echo get_admin_url(); ?>" class="btn btn-success">
							<span class="glyphicon glyphicon-cog"></span>
						<?php esc_html_e("Blog Admin", 'mightymag'); ?>
					</a>
					
					<?php } ?>
					
					<a class="accordion-toggle btn btn-danger lwa-close" data-toggle="collapse" data-parent="#mgm-full-collapsible" href="#mgm-collapse-login"><?php esc_html_e('Close', 'mightymag'); ?>
					</a>
					
			</div>
			<!--button group--> 
			
			<?php /* Integrate BuddyPress Notification if plugin is active */ 
			
			if ( defined('BP_VERSION') ) { ?>
			
			<div id="mgm-notifications-modal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
						
						<ul class="mgm-bp-notices">
						<?php mgm_bp_notification_badge(); ?>
						</ul>
							
					</div>
				</div>
			</div>
			
			<?php } ?>
	</div>
	<!--.mgm-logged-wrap--> 
</div>
<!--lwa-->