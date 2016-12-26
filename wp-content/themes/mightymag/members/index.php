<?php

/**
 * BuddyPress - Members Directory
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

	<div class="row">
		<div id="primary" class="content-area col-md-8 mgm-buddypress">
			<div id="content" class="site-content" role="main">

			<?php do_action( 'bp_before_directory_members_page' ); ?>

					<div class="padder">
					
						<header class="entry-header boxed">
							<?php do_action( 'bp_before_directory_members' ); ?>
					
							<form action="" method="post" id="members-directory-form" class="dir-form">
							
								<?php if ( of_get_option('mgm_breadcrumb') ) { bbp_breadcrumb(); }?>
					
								<h1 class="entry-title"><?php _e('Community', 'buddypress')?> <strong class="cat-color"><?php  if( !is_rtl() ) { echo '<span class="glyphicon glyphicon-chevron-right mgm-arrow"></span>';} else { echo '<span class="glyphicon glyphicon-chevron-left mgm-arrow"></span>';} ?></strong> <?php _e( 'Members Directory', 'buddypress' ); ?></h1>
					
								<?php do_action( 'bp_before_directory_members_content' ); ?>
								
									<div class="reply-wrap clearfix">
										<div id="members-dir-search" class="dir-search pull-right" role="search">
							
											<?php bp_directory_members_search_form(); ?>
							
										</div><!-- #members-dir-search -->
										
										<li id="members-order-select" class="last filter">
											
											<?php do_action( 'bp_members_directory_member_sub_types' ); ?>
											
											<select id="members-order-by" class="form-control">
												<option value="active"><?php _e( 'Last Active', 'buddypress' ); ?></option>
												<option value="newest"><?php _e( 'Newest Registered', 'buddypress' ); ?></option>
					
												<?php if ( bp_is_active( 'xprofile' ) ) : ?>
					
													<option value="alphabetical"><?php _e( 'Alphabetical', 'buddypress' ); ?></option>
					
												<?php endif; ?>
					
												<?php do_action( 'bp_members_directory_order_options' ); ?>
					
											</select>
											
										</li><!-- members-order-select -->
										
									</div><!-- clearfix-->
									
								</form><!-- #members-directory-form -->
								
								</header>
								
								<div class="item-list-tabs" role="navigation">
									<ul>
										<li class="selected" id="members-all"><a href="<?php echo trailingslashit( bp_get_root_domain() . '/' . bp_get_members_root_slug() ); ?>"><?php printf( __( 'All Members <span>%s</span>', 'buddypress' ), bp_get_total_member_count() ); ?></a></li>
					
										<?php if ( is_user_logged_in() && bp_is_active( 'friends' ) && bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>
					
											<li id="members-personal"><a href="<?php echo bp_loggedin_user_domain() . bp_get_friends_slug() . '/my-friends/' ?>"><?php printf( __( 'My Friends <span>%s</span>', 'buddypress' ), bp_get_total_friend_count( bp_loggedin_user_id() ) ); ?></a></li>
					
										<?php endif; ?>
					
										<?php do_action( 'bp_members_directory_member_types' ); ?>
					
									</ul>
								</div><!-- .item-list-tabs -->
					
								<div class="item-list-tabs" id="subnav" role="navigation">
									<ul>
					
				
									</ul>
								</div>
							
							
				
							<div id="members-dir-list" class="members dir-list">
				
								<?php locate_template( array( 'members/members-loop.php' ), true ); ?>
				
							</div><!-- #members-dir-list -->
				
							<?php do_action( 'bp_directory_members_content' ); ?>
				
							<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>
				
							<?php do_action( 'bp_after_directory_members_content' ); ?>
				
						<?php do_action( 'bp_after_directory_members' ); ?>
						
					</div><!-- .padder -->
				

				<?php do_action( 'bp_after_directory_members_page' ); ?>

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
