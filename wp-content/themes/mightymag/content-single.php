<?php
/**
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>

<?php

/* Get ratings output */
include ('inc/rating-values.php');

/* Variables */
$full_width = get_post_meta(get_the_ID(), 'mgm_full_width_switch', true);
$small_featured = get_post_meta(get_the_ID(), 'mgm_small_featured_switch', true); 
$hide_featured = get_post_meta(get_the_ID(), 'mgm_hide_featured_switch', true); 
$has_post_thumbnail = has_post_thumbnail();
$mgm_video = get_post_meta(get_the_ID(), 'mgm_video_encode', true);
$mgm_has_video = $mgm_video != "";
$social_multicheck = of_get_option('mgm_social_share'); 
$mgm_comment_type = get_post_meta(get_the_ID(), 'mgm_comment_type', true);
$social_share = of_get_option('mgm_social_share_switch');
$social_share_pos = of_get_option('mgm_social_share_position');

/* Load Facebook SDK when needed */
if ($social_multicheck['fb_share'] == true OR $mgm_comment_type == 'fb') { include(locate_template('partials/part-fb-sdk.php')); }

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header boxed">
		
		<?php if ( of_get_option('mgm_breadcrumb') ) echo mgm_breadcrumb(); ?>
		
		<div class="entry-details clearfix">
			
			<div class="mgm-cat">
			
				<?php
					$categories = get_the_category();
					$separator = ' ';
					$output = '';
					
					if($categories){
						foreach($categories as $category) {
							
							$category_ID =  $category->cat_ID;	
							$category_color = get_tax_meta($category_ID,'mgm_color_field_id');	
							
							$output .= '<a style="background-color: ' . $category_color . '" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'mightymag' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
						}
					echo trim($output, $separator);
					}
				?>

			</div>
			
			<span class="mgm-details">
			
				<span class="entry-posted-on"><?php mgm_posted_on(); ?></span>
				<span> | </span>
				<?php if ( of_get_option('mgm_pageviews', true) ) { /* @since MGM 1.4 */ ?>
				<span class="entry-details-item">
					<?php echo mgm_get_post_views(get_the_ID()); //Show Post Views ?>
				</span>
				<?php } ?>
				
				<?php if ( of_get_option('mgm_commentscount', true) ) { /* @since MGM 1.4 */ ?>
				<span class="entry-details-item">
					<a href="<?php comments_link(); ?>">
						<span class="glyphicon glyphicon-comment"></span>
						<?php comments_number( '0', '1', '%' ); ?>
					</a>
				</span>
				<?php } ?>
				
			</span>

		</div><!--entry-details-->

		<h1 class="entry-title"><?php the_title(); ?></h1>		
		
		<div class="clear"></div>
		
		
				
	</header><!-- .entry-header -->
	
	<?php 
	/* Social Share Links with small featured images (before) */
	
	if ( $small_featured ) { 
	
		if ( $social_share AND $social_share_pos == 'top' OR $social_share_pos == 'both' ) {get_template_part( 'partials/part', 'social-share' ); } 
	
	} ?>


	<?php 
	/* Include Featured Image / Video */
	if (!$hide_featured) include(locate_template('partials/part-featured-image.php')); 
	?>

	<?php 
	/* Social Share Link with regular featured images (after) */
	
	if ( !$small_featured ) { 
	
		if ( $social_share AND $social_share_pos == 'top' OR $social_share_pos == 'both' ) {get_template_part( 'partials/part', 'social-share' ); } 
	
	} ?>
	
	<?php 
	/* Display top rating box if enabled */ 
		if ( ($mgm_review_enable) AND ($mgm_box_position) == 'top' ) {  
			
			if ( ($mgm_review_scale) == 'percent' ) {
				include('partials/part-review-percent.php');
			} else {
				include('partials/part-review-stars.php');	
			}
		}
	?>

	
	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php wp_link_pages( array(
					 'before' 	  => '<div class="page-links"><span class="mgm-share-text">' . __( 'Pages:', 'mightymag' ) . '</span>', 
					 'after' 	  => '</div>',
					 'pagelink'   => '<span class="page-links-numbers">%</span>',

					 ) 
		); ?>

		
	</div><!-- .entry-content -->
	

	<?php 
	/* Display bottom rating box if enabled */ 
		if ( ($mgm_review_enable) AND ($mgm_box_position) == 'bottom' ) {  
			
			if ( ($mgm_review_scale) == 'percent' ) {
				include('partials/part-review-percent.php');
			} else {
				include('partials/part-review-stars.php');	
			}
		}
	?>
	
	<footer class="entry-meta clearfix">
		
		<div class="tag-list">
			<span class="mgm-share-text"><?php _e('Tagged','mightymag'); ?></span>
			
			<?php /* Show tags mod @since MGM 1.2 */
			
			$tags = get_the_tags();
				
				if( $tags ) :
			  		foreach( $tags as $tag ) { ?>
					<a href="<?php echo get_tag_link($tag->term_id); ?>"><span><?php echo $tag->name; ?></span></a>
			<?php }
			
			endif; ?>

			<!-- social media share -->
			<ul class="clearfix">
				<?php 
					$social_multicheck = of_get_option('mgm_social_share');
					
					/* Forcing proper URL encoding */
					ob_start();
					the_title_attribute();
					$title = ob_get_clean();
				
					/* Twitter */
					if ($social_multicheck['twitter_share'] == true ) {
				
						?>
				
						<li>
							<a href="http://twitter.com/home?status=<?php echo urlencode($title); ?>+<?php echo urlencode(get_permalink()); ?>" class="mgm-share-twitter" onclick="javascript:void window.open('http://twitter.com/home?status=<?php echo urlencode($title); ?>+<?php echo urlencode(get_permalink()); ?>','1412258836570','width=640,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"><span class="socicon socicon-twitter"></span></a>
						</li>
						
						<?php
					
					};
					
					/* Facebook */
					if ($social_multicheck['fb_share'] == true ) {
						 
						?>
						
						<li>
							<a href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode($title); ?>" class="mgm-share-fb" onclick="javascript:void window.open('http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode($title); ?>','1412258836570','width=640,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"><span class="socicon socicon-facebook"></span></a>
						</li>
				
						<?php
					};
					
					/* Google+ */
					if ($social_multicheck['google_share'] == true ) {
						
						?>
						
						
						<li>
							<a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>" class="mgm-share-google" onclick="javascript:void window.open('https://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>','1412258836570','width=640,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"><span class="socicon socicon-google"></span></a>
						</li>
						
						
						<?php
					
					};
					
					/* Linked In */
					if ($social_multicheck['linkedin_share'] == true ) {
						
						?>
						
						<li>
							<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode($title); ?>&amp;source=<?php bloginfo('name'); ?>" class="mgm-share-linkedin" onclick="javascript:void window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode($title); ?>&amp;source=<?php bloginfo('name'); ?>','1412258836570','width=640,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"><span class="socicon socicon-linkedin"></span></a>
						</li>
						
						<?php
						
					};
					
					/* Pin it */
					if ($social_multicheck['pinit_share'] == true ) {
				
						?>
						
						<li>
							<a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php if (has_post_thumbnail( $post->ID ) ): ?><?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?><?php echo $image[0]; ?><?php endif; ?>&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;is_video=false&amp;description=<?php echo urlencode($title); ?>" class="mgm-share-pinterest" onclick="javascript:void window.open('http://pinterest.com/pin/create/bookmarklet/?media=<?php if (has_post_thumbnail( $post->ID ) ): ?><?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?><?php echo $image[0]; ?><?php endif; ?>&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;is_video=false&amp;description=<?php echo urlencode($title); ?>','1412258836570','width=640,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"><span class="socicon socicon-pinterest"></span></a>
						</li>
						
						<?php
				
					};
					
					/* Stumble Upon */
					if ($social_multicheck['stumble_share'] == true ) {
				
						?>
						
						<li>
							<a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode($title); ?>" class="mgm-share-stumbleupon" onclick="javascript:void window.open('http://www.stumbleupon.com/submit?url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode($title); ?>','1412258836570','width=640,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"><span class="socicon socicon-stumbleupon"></span></a>
						</li>
						
						
						<?php
				
					};
					
					/* Instagram */
					/*if ($social_multicheck['instagram_share'] == true ) {
						
						?>
						
						<li>
							<a href="" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=640,height=480')" target="_blank" class="mgm-share-linkedin"><span class="socicon socicon-instagram"></span></a>
						</li>
						
						<?php
						
					};*/
					
					/* Reddit */
					if ($social_multicheck['reddit_share'] == true ) {
						
						?>
						
						
						<li>
							<a href="http://www.reddit.com/submit?url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode($title); ?>" class="mgm-share-reddit" onclick="javascript:void window.open('http://www.reddit.com/submit?url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode($title); ?>','1412258836570','width=640,height=480,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"><span class="socicon socicon-reddit"></span></a>
						</li>
						
						
						<?php
						
					};	
				?>
			</ul>
			<!-- close social media share -->
			
		</div>
		

		<?php edit_post_link( '<div class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit Post', '<span class="edit-link">', '</span></div>' ); ?>
	</footer><!-- .entry-meta -->
	
</article><!-- #post-<?php the_ID(); ?> -->
