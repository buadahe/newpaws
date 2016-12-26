<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to mgm_comment() which is
 * located in the functions.php file.
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<div id="comments" class="comments-area">

	
		<h4 class="comments-title mgm-title">
			<span>
			<?php
            
            
			if (comments_number() > 1 ) {
			
				printf( _n( 'One comment ', '%1$s comments', get_comments_number(), 'mightymag' ),
					number_format_i18n( get_comments_number() ),  'on <span class="comment-title-visibility">"' . get_the_title() . '"</span>' );
			} else {
				echo ' <span class="comment-title-visibility" style="border:none">' . __('on ', 'mightymag') . '"' . get_the_title() .'"</span>'; 
			}
			
			?>
			</span>
		</h4>
		
	<?php /*if ( have_comments() ) : ?>
		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'mightymag' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mightymag' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mightymag' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use mgm_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define mgm_comment() and that will be used instead.
				 * See mgm_comment() in inc/template-tags.php for more.
				 */
				#wp_list_comments( array( 'callback' => 'mgm_comment' ) );
			?>
		</ol><!-- .commentlist -->

		<?php /*if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'mightymag' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mightymag' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mightymag' ) ); ?></div>
		</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'mightymag' ); ?></p>
    <?php endif;*/ ?>

    <?php 
        echo do_shortcode('[fbcomments]');            
#comment_form(); ?>

</div><!-- #comments .comments-area -->
