<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>

<?php

/* Variables */
$mgm_video = get_post_meta(get_the_ID(), 'mgm_video_encode', true);
$mgm_has_video = $mgm_video != "";
$full_width = get_post_meta(get_the_ID(), 'mgm_full_width_switch', true);
$small_featured = get_post_meta(get_the_ID(), 'mgm_small_featured_switch', true); 
$has_post_thumbnail = has_post_thumbnail();
$social_multicheck = of_get_option('mgm_social_share'); 
$mgm_comment_type = get_post_meta(get_the_ID(), 'mgm_comment_type', true);

/* Load Facebook SDK if needed */
if ($social_multicheck['fb_share'] == true OR $mgm_comment_type == 'fb') { include(locate_template('partials/part-fb-sdk.php')); }

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header boxed">
		
		<?php 	if (function_exists('bbp_version') AND is_bbpress() ) { 
		
					echo bbp_breadcrumb();
		
				} else {
					
					if ( of_get_option('mgm_breadcrumb') ) { echo mgm_breadcrumb();  } 
		} ?>
		
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		<?php if (function_exists('bbp_version') AND is_bbpress() ) : ?>
		
			<div class="clear"></div>
			
			<div class="entry-details clearfix">
				
				<div class="mgm-cat">
					
					<?php if (bbp_is_forum_archive()) { ?>
					<a>
					<?php echo __('Select your favorite forum','mightymag'); ?>
					</a>
					<?php } else { ?>
					<a><?php _e('There is a total of','mightymag') ?> <?php echo bbp_get_forum_topic_count() ?> <?php _e('topics and','mightymag')?> <?php bbp_forum_reply_count(); ?> <?php _e('replies for this category','mightymag')?>
					</a>
					<?php }; ?>
					
				</div>
				
			</div>
			
		<?php endif; ?>

	</header><!-- .entry-header -->	
	
	<div class="clear"></div>

	<?php 
	/* Include Featured Image / Video */
	if ($has_post_thumbnail OR $mgm_has_video) include(locate_template('partials/part-featured-image.php')); 
	?>
	
	<div class="entry-content clearfix">
	
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mightymag' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( '<div class="clear"></div><span class="glyphicon glyphicon-edit"></span>', '<span class="edit-link">', '</span>' ); ?>
	
	</div><!-- .entry-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->
