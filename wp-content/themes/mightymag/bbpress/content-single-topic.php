<?php
//single topic


/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage MightyMag
 */

?>

<div id="bbpress-forums">

	<?php do_action( 'bbp_template_before_single_topic' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		<?php //bbp_topic_tag_list(); ?>

		<?php //bbp_single_topic_description(); ?>

		<?php if ( bbp_show_lead_topic() ) : ?>

			<?php //bbp_get_template_part( 'content', 'single-topic-lead' ); ?>

		<?php endif; ?>

		<?php if ( bbp_has_replies() ) : ?>

			<?php //bbp_get_template_part( 'pagination', 'replies' ); ?>

            <?php do_action( 'bbp_template_before_replies_loop' ); ?>


	<h4 class="mgm-title mini-top"><a href="<?php bbp_forum_permalink(bbp_get_forum_id()); ?>"><?php bbp_forum_title(bbp_get_forum_id());?></a></h4>
	
		<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

                <div class="mgm-reply boxed">
                    <div class="mgm-reply-author-thumb">
                        <?php bbp_reply_author_link( array('show_role' => true, 'type' => 'avatar', 'size' => 60 ) ); ?>
                    </div>
                    <div class="mgm-reply-desc">
                        <div class="mgm-reply-header">
                            <!-- author -->
                            <div class="mgm-reply-author mgm-font">
                                <a href="<?php bbp_reply_author_url(); ?>"><?php bbp_reply_author_display_name() ?></a>
                            </div>

                            <!-- permalinks and post controls -->
                            <div class="mgm-reply-controls">
                                <a href="<?php bbp_reply_url(); ?>" class="bbp-reply-permalink">#<?php bbp_reply_id(); ?></a>
                                <?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>
                                <?php bbp_reply_admin_links(); ?>
                                <?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>
                            </div>
                            
                        </div>

                        <!-- comments -->
                        <div class="mgm-reply-content">
                            <span class="bbp-topic-post-date"><?php bbp_reply_post_date();
							
							 ?></span>
                            <?php bbp_reply_content(); ?>
                        </div>


                        <?php if ( bbp_is_user_keymaster() ) : ?>
                            <?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>
                            <div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>
                            <?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>
                        <?php endif; ?>
                    </div>
					
					<?php if ( is_user_logged_in() ) : ?>
					<div class="mgm-favorite-subscribe reply-wrap">
						<?php bbp_user_favorites_link(); ?>
						<?php bbp_user_subscribe_link(); ?>
					</div>
					<?php endif;?>
                </div>

			<div class="clear"></div>
            <?php endwhile; ?>


            <?php do_action( 'bbp_template_after_replies_loop' ); ?>
			<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

		<?php endif; ?>

		<?php bbp_get_template_part( 'form', 'reply' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_topic' ); ?>

</div>
