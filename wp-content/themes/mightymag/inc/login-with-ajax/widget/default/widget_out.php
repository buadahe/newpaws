<?php 
/*
 * This is the page users will see logged out. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>

<div class="lwa lwa-default">
	<?php //class must be here, and if this is a template, class name should be that of template directory ?>
	
<a href="#collapseLogin" class="mgm-trigger mgm-trigger-login active" data-toggle="collapse" data-parent="#lwa-accordion"><?php esc_html_e('Login','mightymag') ?></a>
<small><span class="mgm-trigger mgm-trigger-sep">//</span></small>
<a href="#collapseRegister" class="mgm-trigger mgm-trigger-register" data-toggle="collapse" data-parent="#lwa-accordion"><?php esc_html_e('Register','mightymag') ?></a>

<div id="lwa-accordion">

	<!-- LOGIN FORM
	================================================== -->
	<div class="panel panel-default panel-login">
	
	<div id="collapseLogin" class="panel-collapse collapse in">
		
		<form class="lwa-form"  action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">
			
			<div class="row">
				
				<!-- username -->
				<div class="col-md-6">
					<div class="input-group">
						<?php $msg = __('Username','mightymag'); ?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<label class="sr-only" for="log"><?php esc_html_e( $msg ) ?></label>
						<input type="text" name="log" id="log" class="form-control" placeholder="<?php esc_html_e( $msg ) ?>">
					</div>
				</div>
				
				<!-- password -->
				<div class="col-md-6">			
					<div class="input-group">
					<?php $msg = __('Password','mightymag'); ?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
						<label class="sr-only" for="pwd"><?php esc_html_e( $msg ) ?></label>
						<input type="password" name="pwd" id="pwd" class="form-control" placeholder="<?php esc_html_e( $msg ) ?>">
						
						<span class="input-group-btn">
							<input type="submit" name="wp-submit" id="lwa_wp-submit" class="btn btn-success" value="<?php esc_attr_e( 'Log In','mightymag' ); ?>" tabindex="100" />
						</span>
	
					</div>
				</div>
		
			</div><!-- login .row-->
			
			<input type="hidden" name="lwa_profile_link" value="<?php echo esc_attr($lwa_data['profile_link']); ?>" />
			<input type="hidden" name="login-with-ajax" value="login" />
			
			<div class="lwa-formlinks">
			
				<input name="rememberme" type="checkbox" class="lwa-rememberme" value="forever" />
				<label><?php esc_html_e( 'Remember Me','mightymag' ) ?></label>
			
				<?php if( !empty($lwa_data['remember']) ): ?>
				
				<a class="lwa-links-remember" href="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" title="<?php esc_attr_e('Password Lost and Found','mightymag') ?>"><?php esc_attr_e('Lost your password?','mightymag')?></a>
				<?php endif; ?>
	
				<?php if ( get_option('users_can_register') && !empty($lwa_data['registration']) ) : ?>
				
				
				<?php endif; ?>
			
			</div><!-- .lwa-formlinks -->
		</form>
		
		
		<?php if( !empty($lwa_data['remember']) ): ?>
		<form class="lwa-remember" action="<?php echo esc_attr(LoginWithAjax::$url_remember) ?>" method="post" style="display:none;">
			
			<label for="lwa-user-remember" class="sr-only"><?php esc_html_e("Forgotten Password", 'mightymag'); ?></label>
	
			<?php $msg = __("Enter username or email", 'mightymag'); ?>
			
			<div class="input-group">
				<input type="text" name="user_login" class="lwa-user-remember form-control" id="lwa-user-remember" value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
				
				<span class="input-group-btn">
					<?php do_action('lostpassword_form'); ?>
					<input type="submit" value="<?php esc_attr_e("Get New Password", 'mightymag'); ?>" class="lwa-button-remember btn btn-success" />
					<a href="#" class="lwa-links-remember-cancel btn btn-danger"><?php esc_html_e("Cancel", 'mightymag'); ?></a>
				</span>
			</div>		
	
			<input type="hidden" name="login-with-ajax" value="remember" />
	
		</form>
		<?php endif; ?>
	
		</div><!-- .panel-login -->
	</div><!-- #collapseLogin-->
		
		
	
	<?php if ( $lwa_data['registration'] == true ) : ?>
	
	<!-- REGISTRATION FORM
	================================================== -->
	
	<div class="panel panel-default panel-register lwa-register">
		<div id="collapseRegister" class="panel-collapse collapse">
		
			<div class="register-form-inner">
				<form name="registerform" id="registerform" action="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" method="post">
		
					<div class="row">
						
						<!-- new username -->
						<div class="lwa-username col-md-6">
							<div class="input-group">
								<?php $msg = __('Choose Username','mightymag'); ?>
								<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<label class="sr-only" for="user_login"><?php esc_html_e($msg) ?></label>
								<input type="text" name="user_login" id="user_login" class="form-control" placeholder="<?php esc_html_e( $msg ) ?>">
							</div>
						</div>
				
						<!-- user e-mail -->
						<div class="lwa-email col-md-6">			
							<div class="input-group">
								<?php $msg = __('Your E-mail','mightymag'); ?>
								<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
								<label class="sr-only" for="user_email"><?php esc_html_e($msg) ?></label>
								<input type="text" name="user_email" id="user_email" class="form-control" placeholder="<?php esc_html_e ( $msg ) ?>">
								
								<?php do_action('register_form'); ?>
								<span class="lwa-submit-button input-group-btn">
									<input type="submit" name="wp-submit" id="wp-submit" class="btn btn-success" value="<?php esc_attr_e('Register', 'mightymag'); ?>" tabindex="100" />
									<input type="hidden" name="login-with-ajax" value="register" />
								</span>
							</div>
						</div>
			
					</div><!-- registration row-->	
	
					<div class="lwa-formlinks">
						<?php esc_html_e('A password will be e-mailed to you.','mightymag') ?>
					</div>

				</form>
			</div><!--register-form-inner--> 
		
		</div><!-- .panel-register -->
	</div><!-- #collapseRegister -->
	
</div><!-- lwa-accordion -->

<?php endif; ?>
</div>