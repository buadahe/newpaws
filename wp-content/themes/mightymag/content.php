<?php
/**
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>

<?php 

$mgm_video = get_post_meta(get_the_ID(), 'mgm_video_encode', true);
$mgm_has_video = $mgm_video != ""; 


if ( !is_search() ) {
$category = get_the_category();
$category_ID =  $category[0]->cat_ID;		
$category_parent = pa_category_top_parent_id ($category_ID);
$category_color = get_tax_meta($category_ID,'mgm_color_field_id');
}

$cat_tooltip = of_get_option('mgm_cat_tooltip');

$mgm_review_enable = get_post_meta(get_the_ID(), 'mgm_review_enable', true);
$mgm_review_scale = get_post_meta(get_the_ID(), 'mgm_review_scale', true);
$mgm_overall_score = get_post_meta(get_the_ID(), 'mgm_overall_score', true);

?>

<article id="post-<?php the_ID(); ?>" class="col-md-6 col-xs-12 cat-content-custom"<?php #post_class('pull-left box'); // Apply Masonry Classes ?>>

	<div class="article-content-wrapper wow fadeInUp entry-main-content<?php if ( is_sticky() ) echo ' sticky';?><?php if ( !has_post_thumbnail() ) echo ' without-featured'?>">
		<div class="wrapper-custom">
				
		<?php if ( has_post_thumbnail() OR $mgm_has_video ) { ?>
		
		<div class="entry-img">
			<div class="img-frame">
				<div class="see-article">
							<?php if ( of_get_option('mgm_pageviews', true) ) { /* @since MGM 1.4 */ ?>
									<span class="entry-details-item">
										<?php echo mgm_get_post_views(get_the_ID()); //Show Post Views ?>
									</span>
							<?php } ?>
						</div>
				<?php if ( has_post_thumbnail() ) { ?>
			
						<?php the_post_thumbnail('loop'); ?>
									
				<?php } else { 
				
				 echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="no-thumb-img"></span></a>'; 
				 
				 } ?>
				
			</div><!-- img-frame -->
		</div><!--entry-img -->
		<?php } ?>


			<div class="entry-block boxed">
			
					<header>
					
						<?php if ( has_post_thumbnail() OR $mgm_has_video ) echo ''; ?>
						
		
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mightymag' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h2>
				
						<?php if ( 'post' == get_post_type() ) : ?>
						
						<?php endif; ?>
						
					</header><!-- .entry-header -->
		
						<?php 
						$excerpt = get_the_excerpt();
						$excerpt_count = of_get_option('mgm_excerpt_count');	
							
							if (of_get_option('mgm_excerpt') == 'moretag') 
								the_content( '<span class="label label-cat" style="background-color: '. $category_color .'"> ' . __('Continue Reading', 'mightymag') . ' <span class="meta-nav">&rarr;</span></span>' );
						
							elseif ($excerpt != '0') {
								 echo '<p>';
								 echo mgm_string_limit_words($excerpt, 12);
								 echo '</p>';
							};
						?>
						<div class="wrapper-readmore">
							<a href="<?php the_permalink(); ?>"><button class="btn more hvr-sweep-to-bottom"> Read More </button></a>
						</div>
		
						<?php #wp_link_pages( array( 'before' => '<div class="page-links"><span>' . __( 'Pages:', 'mightymag' ) . '</span>', 'after' => '</div>' ) ); ?>
					
					<!--span class="entry-details">
					
						<span class="entry-posted-on"><?php mgm_posted_on(); ?></span>
						
						<?php if ( is_sticky() ) {?>
						<span class="mgm-sticky"><span class="glyphicon glyphicon-paperclip"></span><?php _e('Sticky!', 'mightymag')?></span>
						<?php } ?>
						
						<span class="pull-right">
						
							<?php if ( of_get_option('mgm_pageviews', true) ) { /* @since MGM 1.6 */ ?>
							<span class="entry-details-item">
								<?php echo mgm_get_post_views(get_the_ID()); //Show Post Views ?>
							</span>
							<?php } ?>
							
							<?php if ( of_get_option('mgm_commentscount', true) ) { /* @since MGM 1.6 */ ?>
							<span class="entry-details-item">
								<a href="<?php comments_link(); ?>">
									<span class="glyphicon glyphicon-comment"></span>
									<?php comments_number( '0', '1', '%' ); ?>
								</a>
							</span>
							<?php } ?>
							
						</span>
					</span-->
					
			</div><!-- .boxed -->
			
			<?php #include ( get_template_directory() . '/partials/part-social-share.php'); // Get ratings output ?>
		</div>	
	</div><!-- article-content-wrapper-->
</article><!-- #post-<?php the_ID(); ?> -->
