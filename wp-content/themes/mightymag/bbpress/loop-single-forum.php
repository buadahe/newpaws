<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>


<ul id="bbp-forum-<?php bbp_forum_id(); ?>" class="mgm-forum-list-table mgm-forum-content">

	<li class="bbp-forum-info mgm-forum-category-title">

		<?php if ( bbp_is_user_home() && bbp_is_subscriptions() ) : ?>

			<span class="bbp-row-actions">

				<?php do_action( 'bbp_theme_before_forum_subscription_action' ); ?>

				<?php bbp_forum_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

				<?php do_action( 'bbp_theme_after_forum_subscription_action' ); ?>

			</span>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

		<a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

		<?php do_action( 'bbp_theme_before_forum_description' ); ?>
		

		<div class="bbp-forum-content mgm-forum-description"><?php bbp_forum_content(); ?></div>

		<?php do_action( 'bbp_theme_after_forum_description' ); ?>

		<?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>

		<?php bbp_list_forums(); ?>

		<?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>

		<?php bbp_forum_row_actions(); ?>

	</li>
	
	<li class="mgm-forum-replies">
		<div class="bbp-forum-topic-count">
			<strong class="mgm-forum-replies-digit cat-color"><?php bbp_forum_topic_count(); ?></strong> <?php _e('topics', 'mightymag'); ?>
		</div>
		
		<div class="bbp-forum-reply-count">
			<strong class="mgm-forum-replies-digit cat-color"><?php bbp_show_lead_topic() ? bbp_forum_reply_count() : bbp_forum_post_count(); ?></strong> <?php _e('replies', 'mightymag'); ?></div>
		
	</li>


	<li class="mgm-forum-last-comment">
		
		<div class="mgm-forum-last-comment-content">
			<?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>
	
			<?php bbp_forum_freshness_link(); ?>
	
			<?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>
			
	
			<p class="bbp-topic-meta">
	
				<?php do_action( 'bbp_theme_before_topic_author' ); ?>
	
				<span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'size' => 50 ) ); ?></span>
	
				<?php do_action( 'bbp_theme_after_topic_author' ); ?>
	
			</p>
		</div>
	</li>
	
	
</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->
