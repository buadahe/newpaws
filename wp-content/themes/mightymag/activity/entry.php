<?php

/**
 * BuddyPress - Activity Stream (Single Item)
 *
 * This template is used by activity-loop.php and AJAX functions to show
 * each activity.
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_activity_entry' ); ?>

<li class="<?php bp_activity_css_class(); ?>" id="activity-<?php bp_activity_id(); ?>">

	<div class="activity-content boxed<?php if ( !bp_get_activity_content_body() ) : echo ' no-inner-content'; endif; ?>">

		<div class="activity-header">
		
			<div class="activity-avatar">
				<a href="<?php bp_activity_user_link(); ?>">
		
					<?php bp_activity_avatar( 'type=full&width=60&height=60' ); ?>
		
				</a>
			</div>			
			
			<div class="pull-left">
			
				<div class="comment-author vcard">
					
					<cite class="fn">
						<a href="<?php bp_activity_user_link(); ?>" class="activity-name-link">
							<?php global $activities_template;echo $activities_template->activity->user_nicename;?>
						</a>
					</cite>

				</div>
				
				<div class="comment-meta commentmetadata"><?php bp_activity_action(); ?></div>
				
			</div><!-- pull-left-->
				
		</div><!--activity-header-->
		
		<div class="clear"></div>

		<?php if ( 'activity_comment' == bp_get_activity_type() ) : ?>

			<div class="activity-inreplyto">
				<strong><?php _e( 'In reply to: ', 'buddypress' ); ?></strong><?php bp_activity_parent_content(); ?> <a href="<?php bp_activity_thread_permalink(); ?>" class="view" title="<?php _e( 'View Thread / Permalink', 'buddypress' ); ?>"><?php _e( 'View', 'buddypress' ); ?></a>
			</div>

		<?php endif; ?>

		<?php if ( bp_activity_has_content() ) : ?>

			<div class="activity-inner">

				<?php bp_activity_content_body(); ?>

			</div>

		<?php endif; ?>

		<?php do_action( 'bp_activity_entry_content' ); ?>

		<?php 
		$logged = is_user_logged_in();
		/*if ( is_user_logged_in() ) :*/ ?>

			<div class="activity-meta clearfix reply-wrap">
				
				<div class="pull-right mgm-bbp" <?php if (!$logged) echo 'data-toggle="tooltip" data-placement="left" title="Please register or sign-in to take action!"';?>>
					
					<?php if ( bp_activity_can_comment() ) : ?>

						<a href="<?php bp_activity_comment_link(); ?>" class="acomment-reply bp-primary-action btn btn-xs btn-success<?php if (!$logged) echo ' disabled';?>" id="acomment-comment-<?php bp_activity_id(); ?>"><?php printf( __( 'Comment <span>%s</span>', 'buddypress' ), bp_activity_get_comment_count() ); ?></a>
	
					<?php endif; ?>
	
					<?php if ( bp_activity_can_favorite() ) : ?>
	
						<?php if ( !bp_get_activity_is_favorite() ) : ?>
	
							<a href="<?php bp_activity_favorite_link(); ?>" class="fav bp-secondary-action btn btn-xs btn-success<?php if (!$logged) echo ' disabled';?>" title="<?php esc_attr_e( 'Mark as Favorite', 'buddypress' ); ?>"><?php _e( 'Favorite', 'buddypress' ); ?></a>
	
						<?php else : ?>
	
							<a href="<?php bp_activity_unfavorite_link(); ?>" class="unfav bp-secondary-action btn btn-xs btn-success<?php if (!$logged) echo ' disabled';?>" title="<?php esc_attr_e( 'Remove Favorite', 'buddypress' ); ?>"><?php _e( 'Remove Favorite', 'buddypress' ); ?></a>
	
						<?php endif; ?>
	
					<?php endif; ?>
	
					<?php if ( bp_activity_user_can_delete() ) bp_activity_delete_link(); ?>
	
					<?php do_action( 'bp_activity_entry_meta' ); ?>
				
				</div><!-- .btn-group .pull-right -->

			</div>
			
		<?php /*endif;*/ ?>

	</div>

	<?php do_action( 'bp_before_activity_entry_comments' ); ?>

	<?php if ( ( is_user_logged_in() && bp_activity_can_comment() ) || bp_activity_get_comment_count() ) : ?>

		<div class="activity-comments">

			<?php bp_activity_comments(); ?>

			<?php if ( is_user_logged_in() ) : ?>

				<form action="<?php bp_activity_comment_form_action(); ?>" method="post" id="ac-form-<?php bp_activity_id(); ?>" class="ac-form"<?php bp_activity_comment_form_nojs_display(); ?>>
					<div class="ac-reply-avatar"><?php bp_loggedin_user_avatar( 'width=' . BP_AVATAR_THUMB_WIDTH . '&height=' . BP_AVATAR_THUMB_HEIGHT ); ?></div>
					<div class="ac-reply-content">
						<div class="ac-textarea">
							<textarea id="ac-input-<?php bp_activity_id(); ?>" class="ac-input form-control" name="ac_input_<?php bp_activity_id(); ?>"></textarea>
						</div>
						<div class="reply-wrap clearfix">
							<span class="reply-wrap-submit"><input type="submit" class="btn btn-xs btn-success" name="ac_form_submit" value="<?php _e( 'Post', 'buddypress' ); ?>" /></span><span class="press-esc"><?php _e( 'press esc to cancel.', 'buddypress' ); ?></span>
							<input type="hidden" name="comment_form_id" value="<?php bp_activity_id(); ?>" />
						</div>
					</div>

					<?php do_action( 'bp_activity_entry_comments' ); ?>

					<?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ); ?>

				</form>

			<?php endif; ?>

		</div>

	<?php endif; ?>

	<?php do_action( 'bp_after_activity_entry_comments' ); ?>

</li>

<?php do_action( 'bp_after_activity_entry' ); ?>
