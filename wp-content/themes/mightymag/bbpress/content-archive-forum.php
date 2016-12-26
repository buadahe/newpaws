<?php

//Forum index

/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage MightyMag
 */

function mgm_show_forum($forum_object) {

    $last_active = bbp_get_forum_last_active_id($forum_object->ID);

    $time_since = '';
    $last_updated_by_avatar = '';

    if (!empty($last_active)) {
        $time_since      = bbp_get_forum_freshness_link( $forum_object->ID );
        $last_updated_by_avatar = bbp_get_author_link( array( 'post_id' => $last_active, 'size' => 50, 'type' => 'avatar' ) );
        //echo $time_since;
    }
    ?>
	
    <div class="clearfix"></div>
    <ul class="mgm-forum-list-table mgm-forum-content">
        <li class="mgm-forum-category-title<?php if (empty($forum_object->post_content)) {  echo ' mgm-forum-title-no-desc'; }?>">
                <a class="bbp-forum-title" href="<?php bbp_forum_permalink
                ($forum_object->ID); ?>"><?php
                    bbp_forum_title($forum_object->ID); ?></a>
                <?php if (!empty($forum_object->post_content)) { ?>
                    <div class="mgm-forum-description"><?php echo $forum_object->post_content?></div>
                <?php } ?>

                </li><li class="mgm-forum-replies">
                    <div><strong class="mgm-forum-replies-digit cat-color"><?php echo bbp_get_forum_topic_count($forum_object->ID);?></strong> <?php _e('topics', 'mightymag'); ?></div>
                    <div><strong class="mgm-forum-replies-digit cat-color"><?php echo bbp_get_forum_reply_count($forum_object->ID); ?></strong> <?php _e('replies', 'mightymag'); ?></div>
                </li><li class="mgm-forum-last-comment">

                <div>
                    <?php echo $last_updated_by_avatar; ?>
                </div>

                <div class="mgm-forum-last-comment-content">
                    <div class="mgm-forum-author-name">
                        <?php _e('by', 'mightymag'); ?> <a class="mgm-forum-last-author" href="<?php bbp_reply_author_url( bbp_get_forum_last_active_id() ) ?>">													
						<?php echo bbp_get_topic_author_display_name( bbp_get_forum_last_active_id($forum_object->ID) ); ?></a>
                    </div>
					
                    <div class="mgm-forum-time-comment">
                        <?php bbp_forum_freshness_link( $forum_object->ID ) ?>
                    </div>
                </div>
        </li>
    </ul>
    <div class="clearfix"></div>
    <?php
}

?>
<div id="bbpress-forums">

    <?php if ( bbp_allow_search() ) : ?>

        <div class="bbp-search-form">

            <?php bbp_get_template_part( 'form', 'search' ); ?>

        </div>

    <?php endif; ?>

    <?php do_action( 'bbp_template_before_forums_index' ); ?>

    <?php if ( bbp_has_forums() ) : ?>


            <?php do_action( 'bbp_template_before_forums_loop' ); ?>
                    <?php while ( bbp_forums() ) : bbp_the_forum(); ?>
                        <!-- forum loop -->
                        <?php
                        /**
                         * Forums Loop - Single Forum
                         */
                        $cur_forum_obj = bbp_get_forum('');

                        if (bbp_is_forum_category()) {
                            //is a category - print the header and output the forums
                            ?>
							<div class="clear"></div>

									<h4 class="mgm-title middle-top">
										<span><?php echo $cur_forum_obj->post_title?></span>
									</h4>

							<?php
                            $sub_forums_obj = bbp_forum_get_subforums();
                            if (is_array($sub_forums_obj)){
                                foreach ($sub_forums_obj as $sub_forum_obj) {
                                    mgm_show_forum($sub_forum_obj);
                                }
                            }
                        } else {
                            //show the normal forum - no header
                            mgm_show_forum($cur_forum_obj);
                        }
                        ?>
                        <!-- end forum loop -->
                    <?php endwhile; ?>
            <?php do_action( 'bbp_template_after_forums_loop' ); ?>

    <?php else : ?>

        <?php bbp_get_template_part( 'feedback', 'no-forums' ); ?>

    <?php endif; ?>

    <?php do_action( 'bbp_template_after_forums_index' ); ?>

</div>
