<?php

add_action('widgets_init', 'mgm_main_cat_regular_widget_custom');

function mgm_main_cat_regular_widget_custom()
{
	register_widget('mgm_Main_cat_regular_Widget');
}

class mgm_Main_cat_regular_Widget extends WP_Widget {
	
	function mgm_Main_cat_regular_Widget()
	
	
	{
		$widget_ops = array('classname' => 'entry-main-content', 'description' => 'Recent Post Widget for Main Content');

		$control_ops = array('id_base' => 'mgm_main_cat_regular-widget');

		/*$this->WP_Widget(
			'mgm_main_cat_regular-widget',
			'MightyMag - HP Category', 
			$widget_ops,
			$control_ops
		);*/
		
		parent::__construct(
			'mgm_main_cat_regular-widget',
			'MightyMag - HP Category', 
			$widget_ops,
			$control_ops
		);
	}
	
	function widget($args, $instance)
	{
		global $post;
		
		extract($args);
		
		$show_excerpt = isset($instance['show_excerpt']) ? 'true' : 'false';
		
		
		$title = $instance['title'];
		//$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$words_primary = $instance['words-primary'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		echo $before_widget;
		?>
<?php
		//$post_types = get_post_types();
//		unset($post_types['page'], $post_types['reviews'], $post_types['gallery'], $post_types['portfolio'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
//		
//		if($post_type == 'all') {
//			$post_type_array = $post_types;
//		} else {
//			$post_type_array = $post_type;
//		}
		?>

	<?php $category_color = get_tax_meta($categories,'mgm_color_field_id'); ?>

	<?php if ($title != '') : ?>
	
	<h2 class="mgm-title mgm-title-skin mgm-title-cat">
		<?php if ('all' != $instance['categories']) { ?>
		<a href="<?php echo get_category_link($categories); ?>"><?php echo $title; ?></a>
		<?php } else { ?>
		<span><a href="#"><?php echo $title; ?></a></span><?php } ?>
		<span class="mgm-stripe" style="background-color: <?php echo $category_color ?>"></span>
	</h2>
	
	<?php endif; ?>
	
	<?php
				$recent_posts = new WP_Query(array(
                    'posts_per_page' => 4,
                    'meta_key' => 'post_views_count',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                    //'showposts' => $posts,
					//'cat' => $categories,
					//'post_type' => $post_type_array,
				));
	?>
				
	<?php $i = 1; 
	while($recent_posts->have_posts()): $recent_posts->the_post(); ?>

		<?php //////////// PRIMARY BLOCK //////////// ?>
		
		<?php include ( get_template_directory() . '/inc/rating-values.php'); // Get ratings output ?>
		
		<?php 
		$mgm_video = get_post_meta($post->ID, 'mgm_video_encode', true);
		$mgm_has_video = $mgm_video != "";
		//@since MGM 1.2
		$home_1 = is_page_template('home-widgetized-1.php');
		$home_2 = is_page_template('home-widgetized-2.php');
		$home_3 = is_page_template('home-widgetized-3.php');
		$home_4 = is_page_template('home-widgetized-4.php');
		$home_5 = is_page_template('home-widgetized-5.php');
		$home_6 = is_page_template('home-widgetized-6.php');
		$home_7 = is_page_template('home-widgetized-7.php');
		
		$category = get_the_category();
		$separator = ', ';
		$output = '';

		?>
	
	<div class="article-content-wrapper col-md-6 col-xs-12 wow fadeInUp hentry<?php if ( is_sticky() ) echo ' sticky';?>">
		<div class="wrapper-custom">
		<?php if ( has_post_thumbnail() ) { ?>
		
			<div class="entry-img">
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
						<span class="entry-details-item">
							<?php echo mgm_get_post_views(get_the_ID()); //Show Post Views ?>
						</span>
						<?php } ?>
				</div>

				<?php if ( has_post_thumbnail() ) { 
				
							if (!$home_3 AND !$home_4 AND !$home_6 AND !$home_7) /* load bigger thumbnails for HP templates with bigger cols @since MGM 1.2 */ {
							
							the_post_thumbnail( 'custom_img_artikel', array( 'alt' => get_the_title(), 'title' => get_the_title() ) );
							
							} else { the_post_thumbnail( 'slider-half', array( 'alt' => get_the_title(), 'title' => get_the_title() ) ); 
							
							}
						
						} else { 
							
					echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ></a>'; }
				
					if ( $mgm_has_video ) { echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="mgm-video-icon"><span class="glyphicon glyphicon-play"></span></span></a>'; }
				?>
				
					<!--a class="img-hover-info<?php if ( $mgm_review_scale == 'percent' ) { echo ' preview-percent'; } ?>" href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?> "-->
						<?php #_e('Read More', 'mightymag')?>
						
						<?php 			
						
						if ( $mgm_review_enable ) { 
					
							if ( $mgm_review_scale == 'percent' ) {
						
							?>
						
							<span class="entry-rating-wrap">
								<span class="entry-rating" style="width: <?php echo $mgm_overall_score ?>%"><?php echo $mgm_overall_score ?></span>
							</span>
						
							<?php } else { ?>
							
							<span class="rw-criteria stars-preview stars-small">
								<span class="criteria-stars-color">
									<span class="criteria-stars-overlay" style="width:<?php echo $mgm_overall_score; ?>%"></span>
								</span>
							</span>
							
							<?php }
						} ?>
					</a>
					
				</div><!--img-frame-->
			</div><!-- entry-img -->
			
			<?php } ?>
				
			<div class="entry-block boxed">
		
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
				</h3>
				
				<?php if ($instance['words-primary'] != 0) { ?>
				<p>
				<?php #echo mgm_string_limit_words(get_the_excerpt(), $instance['words-primary']); ?>
				<?php echo wp_trim_words(get_the_excerpt(), $instance['words-primary']); ?>
				</p>
				<?php } ?> 

				<div class="wrapper-readmore">
					<a href='<?php the_permalink(); ?>'><button class="btn more hvr-sweep-to-bottom"> Read More </button></a>
				</div>

				<!--span class="entry-details">
				
					<span class="entry-posted-on"><?php mgm_posted_on(); ?></span>
					
					<?php if ( is_sticky() ) {?>
					<span class="mgm-sticky"><span class="glyphicon glyphicon-paperclip"></span><?php _e('Sticky!', 'mightymag')?></span>
					<?php } ?>
					
					<span class="pull-right">
						
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
				</span-->

			</div><!-- .boxed -->
			
			<?php #include ( get_template_directory() . '/partials/part-social-share.php'); // Get Social buttons ?>
		</div>
		
	</div><!-- .article-content-wrapper -->
	

	<?php  if($i % 2 == 0) :?>
		<div class="clearfix"></div>
	<?php endif; 
		$i++; ?>
	<?php endwhile; 
	wp_reset_query();?>


	<?php //////////// ADMIN SETUP //////////// ?>
	
	<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['words-primary'] = $new_instance['words-primary'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts', 'categories' => 'all', 'posts' => 3, 'words-primary' => 25 );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Group Title', 'mightymag')?></label><br />
	<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Filter by Category:', 'mightymag')?></label>
	<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
		<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e('All categories', 'mightymag')?></option>
		<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
		<?php foreach($categories as $category) { ?>
		<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
		<?php } ?>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e('Posts Number', 'mightymag')?></label>
	<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('words-primary'); ?>"><?php _e('Excerpt Words Limit', 'mightymag')?></label>
	<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('words-primary'); ?>" name="<?php echo $this->get_field_name('words-primary'); ?>" value="<?php echo $instance['words-primary']; ?>" />
</p>


<?php }
}
?>
