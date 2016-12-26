<?php

add_action('widgets_init', 'mgm_side_posts_custom');

function mgm_side_posts_custom()
{
	register_widget('mgm_Side_posts_widget');
}

class mgm_Side_posts_widget extends WP_Widget {
	
	function mgm_Side_posts_widget()
	{
		$widget_ops = array('classname' => 'widget-side-posts', 'description' => 'Displays posts filtered by Recent / Popular / Best Reviews');

		$control_ops = array('id_base' => 'mgm_side_posts-widget');

		parent::__construct('mgm_side_posts-widget', 'MightyMag - Side Posts', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		global $post;
		
		extract($args);
		
		$show_excerpt = isset($instance['show_excerpt']) ? 'true' : 'false';
		
		$title = $instance['title'];
		$query = $instance['query'];
		//$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$words_primary = $instance['words-primary'];
		$inverse_color = isset($instance['inverse-color']) ? 'true' : 'false';

		?>
		
		<aside class="widget clearfix side-posts-widget<?php if ( $title == '' ) { echo ' title-less'; } if ( $inverse_color == 'true' ) { echo ' inverse'; }?>">
		
		<?php
/*		$post_types = get_post_types();
		unset($post_types['page'], $post_types['reviews'], $post_types['gallery'], $post_types['portfolio'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type == 'all') {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}*/
		?>
	
	<?php $category_color = get_tax_meta($categories,'mgm_color_field_id'); ?>
	
	<?php if ( $title != '' ) { ?>
	<h2 class="mgm-title">
		<?php if ('all' != $instance['categories']) { ?>
		<a href="<?php echo get_category_link($categories); ?>"><?php echo $title; ?></a>
		<?php } else { ?>
		<span><?php echo $title; ?></span>
		<?php } ?>
	</h2>
	<?php } ?>
	
	<?php // Choose your query
	
	if ($instance['query'] == 'recent') {
		
				$posts_query = new WP_Query(array(
					'showposts' => $posts,
					'cat' => $categories,
					//'post_type' => $post_type_array,
				));
				
	} elseif ($instance['query'] == 'popular') {
				$posts_query = new WP_Query(array(
					'showposts' => $posts,
					'cat' => $categories,
					//'post_type' => $post_type_array,
					'meta_key' => 'post_views_count',
					'orderby' => 'meta_value_num',
					'order' => 'DESC'
				));
				
	} else { 
				$posts_query = new WP_Query(array(
					'showposts' => $posts,
					'cat' => $categories,
					'nopaging' => 0,
					'meta_key' => 'mgm_overall_score',
					'post_status' => 'publish',
					'orderby' => 'meta_value'
				));
	}

	?>
				
	<?php while ( $posts_query->have_posts() ): $posts_query->the_post(); ?>

	<?php //////////// OUTPUT //////////// ?>
	
	<?php include ( get_template_directory() . '/inc/rating-values.php'); // Get ratings output ?>
	
	<?php 
	$mgm_video = get_post_meta($post->ID, 'mgm_video_encode', true);
	$mgm_has_video = $mgm_video != "";
	?>
			
		<div class="boxed custom-widget<?php if ( !has_post_thumbnail() ) { echo ' img-less'; } ?>">
			
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
				
				<?php 			
				
				if ( $mgm_review_enable ) { 
			
					if ( $mgm_review_scale == 'percent' ) {
				
					?>
				
					<span class="entry-rating-wrap">
					
						<span class="entry-rating"><?php echo $mgm_overall_score ?></span>
					</span>
				
					<?php } else { ?>
					
					<span class="rw-criteria stars-preview stars-small">
						<span class="criteria-stars-color">
							<span class="criteria-stars-overlay" style="width:<?php echo $mgm_overall_score; ?>%"></span>
						</span>
					</span>
					
					<?php } 
				} ?>
			
			</h3>
			
			
			<?php #if ( has_post_thumbnail() ) { ?>
			<!--div class="entry-img">
				<div class="img-frame pull-left">
						
				<?php the_post_thumbnail( 'mini-square', array( 'alt' => get_the_title(), 'title' => get_the_title() ) );
				
					#if ( $mgm_has_video ) { echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="mgm-video-icon mgm-video-icon-xs"><span class="glyphicon glyphicon-play"></span></span></a>'; }
				?>	
				</div><!--.img-frame-->
			<!--/div><!--.entry-img -->
			<?php #} ?>
			
			
			<?php if ($instance['words-primary'] != 0) { ?>
			<p>
			<?php echo mgm_string_limit_words(get_the_excerpt(), $instance['words-primary']); ?>...<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="readmore"><?php _e('More', 'mightymag')?></a>
			</p>
			<?php } ?>
			

			<span class="entry-details">
			
				<span class="entry-posted-on"><?php mgm_posted_on(); ?></span>
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
			</span>

		</div><!-- .boxed -->
	

	<?php endwhile; 
	wp_reset_query();?>

	<?php
		echo $after_widget;
	}
	
	
	//////////// ADMIN SETUP ////////////
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['query'] = $new_instance['query'];
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['words-primary'] = $new_instance['words-primary'];
		$instance['inverse-color'] = $new_instance['inverse-color'];
		
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'query' => 'recent', 'categories' => 'all', 'posts' => 3, 'words-primary' => 15, 'inverse-color' => false );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Group Title:', 'mightymag') ?></label><br />
	<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('query'); ?>"><?php _e('Show', 'mightymag') ?></label>
	<select id="<?php echo $this->get_field_id('query'); ?>" name="<?php echo $this->get_field_name('query'); ?>" class="widefat query" style="width:100%;">
		<option value='recent' <?php if ( $instance['query'] == 'recent') echo 'selected="selected"'; ?>><?php _e('Recent Posts', 'mightymag') ?></option>
		<option value='popular' <?php if ( $instance['query'] == 'popular') echo 'selected="selected"'; ?>><?php _e('Popular Posts', 'mightymag') ?></option>
		<option value='reviews' <?php if ( $instance['query'] == 'reviews') echo 'selected="selected"'; ?>><?php _e('Best Reviews', 'mightymag') ?></option>
	</select>
</p>

<p>
	<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Filter by Category:', 'mightymag') ?></label>
	<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
		<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e('All categories', 'mightymag') ?></option>
		<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
		<?php foreach($categories as $category) { ?>
		<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
		<?php } ?>
	</select>
</p>

<p>
	<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e('Posts Number', 'mightymag') ?></label>
	<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('words-primary'); ?>"><?php _e('Excerpt Words Limit', 'mightymag') ?></label>
	<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('words-primary'); ?>" name="<?php echo $this->get_field_name('words-primary'); ?>" value="<?php echo $instance['words-primary']; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('inverse-color'); ?>"><?php _e('Inverse Color Scheme', 'mightymag') ?></label>
	<input class="checkbox" type="checkbox" <?php checked($instance['inverse-color'], 'on'); ?> id="<?php echo $this->get_field_id('inverse-color'); ?>" name="<?php echo $this->get_field_name('inverse-color'); ?>" />
</p>


<?php }
}
?>
