									
									
										<?php if (of_get_option('mgm_logo') == NULL) { ?>
										
										<div class="mgm-logo-text">
										
											<div class="mgm-logo-wrap">
											
												<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
												<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
												
											</div>
											
										</div>
										
										<?php } else { ?>
										
										<div class="mgm-logo">
										
											<div class="mgm-logo-wrap">
											
												<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo of_get_option('mgm_logo'); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/></a>
											</div>
											
										</div>
	
										<?php } ?>
										
										<?php if (of_get_option('mgm_scrollup') AND of_get_option('mgm_stickynav') ) { 
												echo '<span class="scrollup cat-bg"><span class="glyphicon glyphicon-chevron-up"></span></span>'; 
										} ?>