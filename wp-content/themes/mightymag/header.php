<?php
/**
 * The Header for MightyMag.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php get_template_part( 'partials/part', 'background');?>>
<head>
<?php if ( is_404() ) { ?>
<link href='http://fonts.googleapis.com/css?family=Monoton' rel='stylesheet' type='text/css'>
<?php } ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-2.5.3.min.js" type="text/javascript"></script>
<![endif]-->


<?php include('partials/part-cat-options.php' );?>

<?php
/* FB comments moderation  */
$fb_userID = of_get_option('mgm_fb_userid');
$fb_appID = of_get_option('mgm_fb_appid');

if (is_single() AND $fb_userID !== NULL) {
	echo '<meta property="fb:admins" content="' . $fb_userID . '"/>';
}

if (is_single() AND $fb_appID !== NULL) {
	echo '<meta property="fb:app_id" content="' . $fb_appID . '"/>';
}
?>
<?php wp_head(); ?>
</head>

<?php $full_width = of_get_option('mgm_boxed') == 'free'; ?>

<body <?php if (!$full_width) { body_class(); } else {body_class('mgm-minimal-unboxed');} ?> >

<?php if ( of_get_option('mgm_animations') ) { //Fallback for non-js browsers ?>
<noscript><style scoped>.content-sidebar-wrap { visibility: visible!important } .mgm-spinner {display:none;} </style></noscript>
<?php } ?>

<?php if (of_get_option('mgm_wall_ad') != NULL) { //Link Wallpaper if enabled ?>
<div id="mgm-wallpaper">
	<?php if( of_get_option('mgm_wall_ad')) { ?>
	<a href="<?php echo of_get_option('mgm_wall_ad'); ?>" class="mgm-wallpaper-link"  target="_blank"></a>
	<?php } ?>
</div><!--wallpaper-->
<?php } ?>

<?php

if ( $full_width ) { ?>
<div id="mgm-toolbar-width"></div>
<?php } ?>

<div id="mgm-super-container">

	<div class="mgm-full-main">
	
		<div id="page" class="hfeed site">
		
			<?php do_action( 'before' ); ?>
			
			<div id="mgm-header-wrap" class="mgm-gray-frame">
						
				<div id="mgm-header-opacity">
				
				
					<!-- SuperTop Toolbar
					================================================== -->
					<div id="mgm-full-supertop">
						<div id="mgm-full-supertop-overlay">
						
							<div id="mgm-toolbar">
								<div class="col-md-12">
								<?php get_template_part( 'partials/part', 'socials'); //Get Social Icons ?>
								</div>
								<div class="mgm-search-wrap tc">
									<a data-toggle="collapse" data-target="#mgm-live-search" class="mgm-search-icon-trigger">
										<span class="glyphicon glyphicon-search"></span>
									</a>
								</div>
				
								<?php wp_nav_menu( array( 'theme_location' => 'utilities', 'depth' => 1, 'menu_class' => 'topnav-wrap', 'container' => false ) ); ?>
								
							</div>
						</div>
						
						<?php get_template_part( 'partials/part', 'live-search'); //Get Live Search Form ?>
						
					</div><!--#full-super-top -->
		
					
					<!-- Masthead
					================================================== -->
					<div id="mgm-full-top">
						<header id="masthead" class="site-header clearfix" role="banner">
									
							<div id="mgm-branding">
								
								<?php get_template_part( 'partials/part', 'logo'); ?>
								
								<?php 
								$header_buttons = of_get_option('mgm_header_buttons');
								if ($header_buttons) { get_template_part( 'partials/part', 'collapsible-triggers'); } //Get Header Buttons 
								?>
								
								<?php if (of_get_option('mgm_ad_top') != NULL) { //Top Banner ?>
								<div id="mgm-top-ad">
								<a href="<?php echo home_url(); ?>">
									<?php echo ( of_get_option('mgm_ad_top') ); ?>
									</a>
								</div>
								<?php } ?>
								
							</div><!--#mgm-branding-->
			
						</header><!-- #masthead .site-header .container -->
					</div><!-- #mgm-full-top -->
					
					<div class="clear"></div>
					
					<?php if ($header_buttons) {  get_template_part( 'partials/part', 'collapsible'); } // Get Hidden Collapsibles ?>

					
					
					<!-- Main Navigation
					================================================== -->	
					<a href="#mgm-menu" class="menu-toggle animated visible-xs"><i class="glyphicon glyphicon-align-justify"></i></a>
					
					<?php if ($full_width) { ?>
					<div id="mgm-full-nav-wrap">
					<?php } ?>
					
					<div class="nav-wrap" id="nav-original">

						<?php get_template_part( 'partials/part', 'logo'); ?>

						<nav role="navigation" class="site-navigation main-navigation" id="mgm-menu">
		
							
							<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'mightymag' ); ?>"><?php _e( 'Skip to content', 'mightymag' ); ?></a></div>
							
							<a href="#" class="menu-toggle toggle-close"><i class="glyphicon glyphicon-remove-sign"></i></a>
							
							<?php 
							if (has_nav_menu('primary')) /* Avoids php warnings on first setup */ {
								wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => new mgm_Category_Walker, 'after' => '<span class="bottom-line custom-color cat-bg"></span>', 'container_class' => 'menu-main-container' ) ); 
							} else {
								wp_nav_menu( array( 'theme_location' => 'primary') ); }
							?>
							
						</nav><!-- .site-navigation .main-navigation -->
					
					</div><!-- #nav-wrap -->
				<?php if ($full_width) { ?>
				</div><!-- #mgm-full-nav-wrap -->
				<?php } ?>
					
			</div><!--mgm-header-opacity-->
				
			<?php //Get Slider and Grid for Homepage templates
			
			$slider = get_post_meta(get_the_ID(), 'mgm_hp_slider', true);
			$is_shop = mgm_is_really_woocommerce();
			$home_1 = is_page_template('home-widgetized-1.php');
			$home_2 = is_page_template('home-widgetized-2.php');
			$home_3 = is_page_template('home-widgetized-3.php');
			$home_4 = is_page_template('home-widgetized-4.php');
			$home_5 = is_page_template('home-widgetized-5.php');
			$home_6 = is_page_template('home-widgetized-6.php');
			$home_7 = is_page_template('home-widgetized-7.php');
			
			if ( $slider != 'slider_none' AND $home_1 || $home_2 || $home_3 || $home_4 || $home_5 || $home_6 || $home_7 ) { 
			
				get_template_part ('partials/part', 'sliders');
				
			} elseif ( $is_shop ) {
						
						get_template_part ('partials/part', 'shop-cat');	
				}
				
			 ?>
		
			<?php 
			// Get Posts News Ticker if Enabled 
			$has_ticker = of_get_option('mgm_ticker');
			$ticker_pos = of_get_option('mgm_ticker_where');

				if ( $has_ticker AND !$is_shop ) { ?>
				
					<?php if ( $ticker_pos == 'all' ) { get_template_part( 'partials/part', 'ticker'); }
						  
						  elseif ( $ticker_pos == 'home' AND is_home() || $home_1 || $home_2 || $home_3 || $home_4 || $home_5 || $home_6 || $home_7 ) {
							  
							  get_template_part( 'partials/part', 'ticker');
						  }
				}
			
			//Get Products News Ticker @since MM 1.1
			$has_wc_ticker = of_get_option('mgm_wc_ticker');
			
			if ( $is_shop ) {
				
				if($has_wc_ticker) {
					get_template_part( 'partials/part', 'shop-ticker');
				}
			
			}
			
			?>
				
		</div><!--mgm-header-wrap-->
		
		<!-- <?php if (of_get_option('mgm_ad_middle') != NULL) { // Middle Banner
		
			$everywhere = of_get_option('mgm_ad_middle_display') == 'all'; 
			$home = of_get_option('mgm_ad_middle_display') == 'home';
			$nothome = of_get_option('mgm_ad_middle_display') == 'nothome';
		
			if ( $home AND is_front_page() OR ($nothome AND !is_front_page() OR $everywhere ) ) {
			?>
			
			<div id="mgm-middle-ad">
				<?php echo ( of_get_option('mgm_ad_middle') ); ?>
			</div>
			
			<?php }
		
		} ?> -->
			

			
		<div id="main" class="site-main container">
			<?php if ( of_get_option('mgm_animations') ) { 
				echo '<div id="main-spinner"><div class="mgm-spinner-pos"><div class="mgm-spinner mgm-spinner-xxl"></div></div></div>'; 
			}?>
			<div class="content-sidebar-wrap">
