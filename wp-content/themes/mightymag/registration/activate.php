<?php get_header( 'buddypress' ); ?>

<div class="row">
	<div id="primary" class="content-area col-md-8 mgm-buddypress">
		<div id="content" class="site-content" role="main">

			
					<div class="padder">
			
					<?php do_action( 'bp_before_activation_page' ); ?>
			
					<div class="page" id="activate-page">
			
						<h1 class="boxed-title"><?php if ( bp_account_was_activated() ) :
							_e( 'Account Activated', 'buddypress' );
						else :
							_e( 'Activate your Account', 'buddypress' );
						endif; ?></h1>
			
						<?php do_action( 'template_notices' ); ?>
			
						<?php do_action( 'bp_before_activate_content' ); ?>
			
						<?php if ( bp_account_was_activated() ) : ?>
							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<?php if ( isset( $_GET['e'] ) ) : ?>
									<?php _e( '<strong>Your account was activated successfully!</strong> Your account details have been sent to you in a separate email.', 'buddypress' ); ?>
								<?php else : ?>
									<?php _e( '<strong>Your account was activated successfully!</strong> You can now log in with the username and password you provided when you signed up.', 'buddypress' ); ?>
								<?php endif; ?>
							</div>
			
						<?php else : ?>
						
							<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<p><?php _e( '<strong>Error!</strong> Please provide a valid activation key.', 'buddypress' ); ?></p>
				
								<form action="" method="get" class="standard-form" id="activation-form">
				
									<label for="key"><?php _e( 'Activation Key:', 'buddypress' ); ?></label>
									<input type="text" name="key" id="key" value="" />
				
									<p class="submit">
										<input type="submit" name="submit" value="<?php _e( 'Activate', 'buddypress' ); ?>" />
									</p>
				
								</form>
							</div>
			
						<?php endif; ?>
			
						<?php do_action( 'bp_after_activate_content' ); ?>
			
					</div><!-- .page -->
			
					<?php do_action( 'bp_after_activation_page' ); ?>
			
					</div><!-- .padder -->
			
			
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

	<div class="col-md-4">
		<?php if ( of_get_option('mgm_bp_sidebar') == 'buddypress_sidebar' ) {			
				
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('BuddyPress')): endif;
				
		 		} else { get_sidebar( 'buddypress' );
		}; ?>
	</div>

</div><!-- .row (buddypress)-->

<?php get_footer( 'buddypress' ); ?>
