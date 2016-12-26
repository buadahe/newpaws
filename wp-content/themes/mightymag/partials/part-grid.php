<div id="mgm-grid">
		
		<?php // Query to get posts with thumbnails only

		$grid_offset_method = of_get_option('mgm_grid_offset_method');

		if (is_category( )) {
			
			$cat = get_query_var('cat');
			$yourcat = get_category($cat);
			
			/* Category Query */
			$args = array(
			'posts_per_page' => 5,
			'meta_key' => '_thumbnail_id',
			'category_name' => $yourcat->slug
			);
			
		} elseif ( !is_category() AND  $grid_offset_method == 'manual' ) {
			
			/* Homepage Query Manual */			
			$args = array(
			'posts_per_page' => 3,
			'meta_key' => '_thumbnail_id',
			'offset' => of_get_option('mgm_grid_offset_manual'),
			'ignore_sticky_posts' => 1,
			'cat' => of_get_option('mgm_grid_cat'),
			);
			
		} else {
			
			/* Homepage Query Automatic */			
			$args = array(
			'posts_per_page' => 3,
			'meta_key' => '_thumbnail_id',
			'offset' => of_get_option('mgm_slider_1_count'),
			'ignore_sticky_posts' => 1,
			'cat' => of_get_option('mgm_grid_cat'),
			);
			
		}
		query_posts($args); 	
		?>

		<?php 
		$count = 1;  
		while(have_posts()) : the_post(); 
		?>
		
			<div class="mgm-grid-block<?php if($count == 1) { echo ' mgm-grid-wide'; } ?>">
			
			
			
				<a class="mgm-overtitle" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mightymag' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
					<span class="mgm-grid-title"><?php the_title();?></span>
				</a>
				
				<?php if($count == 1) { the_post_thumbnail('grid-wide'); } else { the_post_thumbnail('grid'); } ?>

			</div>
			
		<?php $count++; endwhile; ?>
		
		<?php wp_reset_query(); ?>
		
</div><!-- mgm.grid -->
