<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>
				</div><!-- .content-sidebar-wrap -->
			</div><!-- #main .site-main -->
			
			<div id="mgm-footer-wrap" class="mgm-gray-frame">
			
				<!--<?php if (of_get_option('mgm_ad_bottom') != NULL) { // Bottom Banner
				
					$everywhere = of_get_option('mgm_ad_bottom_display') == 'all'; 
					$home = of_get_option('mgm_ad_bottom_display') == 'home';
					$nothome = of_get_option('mgm_ad_bottom_display') == 'nothome';
				
					if ( $home AND is_front_page() OR ($nothome AND !is_front_page() OR $everywhere ) ) {
					?>
					
					<div id="mgm-bottom-ad">
						<?php echo ( of_get_option('mgm_ad_bottom') ); ?>
					</div>
					
					<?php }
				
				} ?>-->
	
				<div id="mgm-full-footer">
				
					<footer class="container" id="widgetized-footer">
						
						<div class="row">
							
							<div class="col-md-4 footer-item wow fadeInUp">
								<?php
								if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer1')): 
								endif;
								?>
							</div>
							
							<div class="col-md-8 footer-item wow fadeInUp" data-wow-delay="0.2s">
								<?php
								if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer2')): 
								endif;
								?>
							</div>	
							
							<!--div class="col-md-4 footer-item wow fadeInUp" data-wow-delay="0.4s">
								<?php
								if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer3')): 
								endif;
								?>
							</div-->
						
						</div><!--row-->		
					</footer><!--container-->
				</div><!-- #mgm-full-footer -->
					
				<div id="mgm-full-site-info">	
					<div id="colophon" class="site-footer container" role="contentinfo">
						<div class="site-info row">
							<div class="col-md-3">
								<?php if ( of_get_option('mgm_footer_logo') != NULL ) { ?>
								<div id="footer-logo" class="wow flipInX" data-wow-delay="0.5s">
									<img src="<?php echo of_get_option('mgm_footer_logo') ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
								</div>
								<?php } ?>
							</div>
							<div class="col-md-6">
								<a class="btn more hvr-sweep-to-bottom" href="http://pawsunion.com/index.php/about/"> About Us </a>
								<div class="utilities footer">
									<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'footer-menu', 'depth' => 1 ) ); ?>
								</div>
							
								<p><?php echo of_get_option('mgm_credits') ?></p>
							</div>
							<div class="col-md-3">
								<?php     
								$socials = array('vimeo' => 'Vimeo', 'gplus' => 'Google +', 'technorati' => 'Technorati', 'skype' => 'Skype', 'blogger' => 'Blogger', 'rss' => 'Rss Feed', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'twitter' => 'Twitter', 'delicious' => 'Delicious', 'youtube' => 'YouTube', 'flickr' => 'Flickr', 'digg' => 'Digg', 'stumble' => 'Stumble Upon', 'linkedin' => 'Linked In', 'deviant' => 'Deviant Art','picasa' => 'Picasa', 'dribbble' => 'Dribbble', 'tumblr' => 'Tumblr', 'forrst' => 'Forrst');  

								$target = of_get_option('mgm_social_target');

								?>


								<ul class="socials">
									<p> Follow Us: </p>
									<?php foreach($socials as $key=>$val){
								if ( of_get_option('mgm_sm_'.$key) ) { ?>
									<li><a href="<?php echo of_get_option('mgm_sm_'.$key); ?>" class="btn btn-social-icon <?php echo 'btn-'.$key; ?>" title="<?php _e('Follow us on', 'mightymag') ?> <?php echo $val; ?>" target="<?php if ($target) {echo '_blank';} else {echo '_self';}?>">
									<span class="<?php echo 'fa fa-'.$key; ?>"></span>
									</a></li>
									<?php } 
								}?>
								</ul>
							</div>


							
						</div><!-- .site-info -->
					</div><!-- #colophon .site-footer -->
				</div>
			</div><!--#mgm-footer-wrap-->
					
		</div><!-- #page .hfeed .site -->
		
		<?php if ( of_get_option('mgm_scrollup') AND !of_get_option('mgm_stickynav') ) {
			 echo '<span class="scrollup"><span class="glyphicon glyphicon-chevron-up"></span></span>'; 
		} ?>
		
		
		</div><!-- .container.supermain -->
		
		
	<?php wp_footer(); ?>
	
	</div><!-- #mgm-super-container -->

<!-- Modal Register -->
<div id="register-modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content modal-content-custom">
				<form id="registerss" action="register_custom" method="post">
					<p class="status"></p>
					<div class="form-group form-group-custom">
						<label class="label-custom" for="signup_email"><?php _e( 'Email', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
						<?php do_action( 'bp_signup_email_errors' ); ?>
						<input type="text" name="signup_email" id="signup_email" value="<?php bp_signup_email_value(); ?>" class="form-control form-control-custom"/>
					</div>
					<div class="form-group form-group-custom">
						<label class="label-custom" for="signup_username"><?php _e( 'Username', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
						<?php do_action( 'bp_signup_username_errors' ); ?>
						<input type="text" name="signup_username" id="signup_username" value="<?php bp_signup_username_value(); ?>" class="form-control form-control-custom" />
					</div>
					<div class="form-group form-group-custom">
						<label class="label-custom" for="signup_password"><?php _e( 'Password', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
						<?php do_action( 'bp_signup_password_errors' ); ?>
						<input type="password" name="signup_password" id="signup_password" value="" class="form-control form-control-custom" />
					</div>
					<div class="form-group form-group-custom">
						<label class="label-custom" for="signup_password_confirm"><?php _e( 'Confirm Password', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
						<?php do_action( 'bp_signup_password_confirm_errors' ); ?>
						<input type="password" name="signup_password_confirm" id="signup_password_confirm" value="" class="form-control form-control-custom" />
					</div>	

					<!-- <div class="radio radio-custom">
						<label class="radio-label-custom">
							<input class="input-radio-custom" type="radio" name="category" value="cat" id="category">
							<span class="radio-span-custom">Cat</span>
						</label>
						<label class="radio-label-custom">
							<input class="input-radio-custom" type="radio" name="category" value="dog" id="category">
							<span class="radio-span-custom">Dog</span>
						</label>
					</div>
					
					<?php //wp_nonce_field( 'ajax-login-nonce', 'security' ); ?> -->
					<center><input type="submit" name="signup_submit" class="btn btn-register" id="signup_submit" value="<?php _e( "Thank's", "buddypress" ); ?>" /></center>

					<?php do_action( 'bp_after_registration_submit_buttons' ); ?>
			
					<?php wp_nonce_field( 'bp_new_signup' ); ?>
				</form>
		</div>
	</div>
</div>

<!-- Modal Login -->
<div id="login-modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content modal-content-custom">
				<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
					<div class="form-group form-group-custom">
						<label class="label-custom" for="user_login">Nama</label>
						<input class="form-control form-control-custom" type="text" name="log" id="user_login"<?php echo $aria_describedby_error; ?> value="<?php echo esc_attr( $user_login ); ?>">
					</div>
					<div class="form-group form-group-custom">
						<label class="label-custom" for="user_pass">Password</label>
						<input class="form-control form-control-custom" type="password" name="pwd" id="user_pass"<?php echo $aria_describedby_error; ?> value="">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="forgot-password-login">Lupa Password</a>
					</div>
					<div class="form-group form-group-custom" style="margin-top: -10px;">
						<img src="wp-content/themes/mightymag/images/circle-facebook_icon.png" width="50px" height="50px"><br>
						<!-- <span class="fa fa-facebook-square login-facebook-logo"></span><br> -->
						<a href="#" class="login-facebook-text">login with facebook</a>
					</div>
					<div class="form-group form-group-custom" style="margin-top: -5px;">
						<input class="btn btn-register" type="submit" name="wp-submit" id="wp-submit" value="Go!">
						<?php	if ( $interim_login ) { ?>
								<input type="hidden" name="interim-login" value="1" />
						<?php	} else { ?>
								<input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect_to); ?>" />
						<?php 	} ?>
						<?php   if ( $customize_login ) : ?>
								<input type="hidden" name="customize-login" value="1" />
						<?php   endif; ?>
								<input type="hidden" name="testcookie" value="1" />
					</div>
				</form>
		</div>
	</div>
</div>
</body>
</html>