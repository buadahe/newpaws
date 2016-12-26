<?php

/**
 * BuddyPress - Groups Directory
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

<div class="row">
	<div id="primary" class="content-area col-md-8 mgm-buddypress">
		<div id="content" class="site-content" role="main">

			<?php do_action( 'bp_before_directory_groups_page' ); ?>
		
			
				<div class="padder">
		
				<?php do_action( 'bp_before_directory_groups' ); ?>
		
				<form action="" method="post" id="groups-directory-form" class="dir-form boxed entry-header clearfix">
				
				<?php if ( of_get_option('mgm_breadcrumb') ) { bbp_breadcrumb(); }?>
					
					<h1 class="entry-title"><?php _e( 'Groups Directory', 'buddypress' ); ?></h1>

					<?php do_action( 'bp_before_directory_groups_content' ); ?>
					
					<div class="reply-wrap clearfix">
						<div id="group-dir-search" class="dir-search pull-right" role="search">
					
						<?php bp_directory_groups_search_form(); ?>
		
						</div><!-- #group-dir-search -->
					</div>
					
					<?php if ( is_user_logged_in() && bp_user_can_create_groups() ) : ?> &nbsp;<a class="btn btn-primary btn-full pull-right" href="<?php echo trailingslashit( bp_get_root_domain() . '/' . bp_get_groups_root_slug() . '/create' ); ?>"><?php _e( 'Create a Group', 'buddypress' ); ?></a>			<?php endif; ?>
					
					<?php do_action( 'template_notices' ); ?>
		
					<div class="item-list-tabs" role="navigation">
						<ul>
							<li class="selected" id="groups-all"><a href="<?php echo trailingslashit( bp_get_root_domain() . '/' . bp_get_groups_root_slug() ); ?>"><?php printf( __( 'All Groups <span>%s</span>', 'buddypress' ), bp_get_total_group_count() ); ?></a></li>
		
							<?php if ( is_user_logged_in() && bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>
		
								<li id="groups-personal"><a href="<?php echo trailingslashit( bp_loggedin_user_domain() . bp_get_groups_slug() . '/my-groups' ); ?>"><?php printf( __( 'My Groups <span>%s</span>', 'buddypress' ), bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ); ?></a></li>
		
							<?php endif; ?>
		
							<?php do_action( 'bp_groups_directory_group_filter' ); ?>
		
						</ul>
					</div><!-- .item-list-tabs -->
		
					<div class="item-list-tabs" id="subnav" role="navigation">
						<ul>
		
							<?php do_action( 'bp_groups_directory_group_types' ); ?>
		
							<li id="groups-order-select" class="last filter">
		
								<label for="groups-order-by"><?php _e( 'Order By:', 'buddypress' ); ?></label>
								<select id="groups-order-by" class="form-control">
									<option value="active"><?php _e( 'Last Active', 'buddypress' ); ?></option>
									<option value="popular"><?php _e( 'Most Members', 'buddypress' ); ?></option>
									<option value="newest"><?php _e( 'Newly Created', 'buddypress' ); ?></option>
									<option value="alphabetical"><?php _e( 'Alphabetical', 'buddypress' ); ?></option>
		
									<?php do_action( 'bp_groups_directory_order_options' ); ?>
		
								</select>
							</li>
						</ul>
					</div>
		
					<div id="groups-dir-list" class="groups dir-list">
		
						<?php locate_template( array( 'groups/groups-loop.php' ), true ); ?>
		
					</div><!-- #groups-dir-list -->
		
					<?php do_action( 'bp_directory_groups_content' ); ?>
		
					<?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ); ?>
		
					<?php do_action( 'bp_after_directory_groups_content' ); ?>
		
				</form><!-- #groups-directory-form -->
		
				<?php do_action( 'bp_after_directory_groups' ); ?>
		
				</div><!-- .padder -->
			

			<?php do_action( 'bp_after_directory_groups_page' ); ?>

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

