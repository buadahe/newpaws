<?php
$tags = wp_get_post_tags($post->ID);
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

$mgm_related_count = of_get_option('mgm_related_count');

$args=array(
'tag__in' => $tag_ids,
'post__not_in' => array($post->ID),
'showposts'=> 3,  // Number of related posts that will be shown.
'ignore_sticky_posts'=>1
);

$i = 1;

$my_query = new wp_query($args);
if( $my_query->have_posts() ) {
	
echo '<div class="row">';


while ($my_query->have_posts()) {
$my_query->the_post();
?>

<?php 
$mgm_video = get_post_meta(get_the_ID(), 'mgm_video_encode', true);
$mgm_has_video = $mgm_video != ""; 

$category = get_the_category(); 
$separator = ', ';
$output = '';
?>
<!-- Content -->
	<div class="col-md-4 article-content-wrapper post-related">
		<div class="wrapper-custom">
			<div class="img-frame">
				<div class="cat-corner-top">
					<?php if(!empty($category)){ 
						foreach ($category as $cat) {
						$output .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $cat->name ) ) . '">' . esc_html( $cat->name ) . '</a>' . $separator;
						}
					?>
					<p> <?php echo trim( $output, $separator); ?> </p>
					<?php } ?>
				</div>
				<div class="see-article">
					<?php if ( of_get_option('mgm_pageviews', true) ) { /* @since MGM 1.4 */ ?>
					<span class="entry-details-item"><?php echo mgm_get_post_views(get_the_ID()); //Show Post Views ?></span>
					<?php } ?>
				</div>

				<?php the_post_thumbnail( 'grid', array( 'alt' => get_the_title(), 'title' => get_the_title() ) ); ?>	
			</div>

			<div class="box-content">
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo wp_trim_words( get_the_title(), 6); ?></a>
				</h3>

				<p>
					<?php echo mgm_string_limit_words(get_the_excerpt(), 10); ?>...
				</p>

				<div class="wrapper-readmore">
					<a href="<?php echo get_permalink(); ?>"><button class="btn more hvr-sweep-to-bottom" style="margin-bottom: 0px;"> Read More </button></a>
				</div>
			</div>

		</div>
	</div>
<!-- Close Content -->

<?php 

if ( ($i % 3 == 0) && $mgm_related_count > 3 ) {
	
	echo '<div class="clear with-space"></div>';} 

$i++;

}
echo '</div>';
}
}
wp_reset_query();
?>
