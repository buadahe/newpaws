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
</body>
</html>