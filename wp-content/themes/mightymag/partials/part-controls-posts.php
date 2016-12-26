	<?php $prevPost = get_previous_post(true);
		if($prevPost) {
			$args = array(
				'posts_per_page' => 1,
				'include' => $prevPost->ID
			);
			$prevPost = get_posts($args);
			foreach ($prevPost as $post) {
				setup_postdata($post);
	?>
	<div id="prev-panel" class="small-caps">
		<a id="prev-tab" href="<?php the_permalink(); ?>"><i class="icon-chevron-left  icon-large"></i></a>
		<ul><li>
		<span class="img-frame"><span class="small-thumb"><?php the_post_thumbnail( array(105,105)); ?></span></span>
		<a href="<?php the_permalink(); ?>"><?php mgm_trimd_title('...', 45) ?>
		<span class="post-attribute small-caps"><?php the_date('F j, Y'); ?></span></a>
		</li></ul>
	</div>
	<?php
				wp_reset_postdata();
			} //end foreach
		} // end if
		$nextPost = get_next_post(true);
		if($nextPost) {
			$args = array(
				'posts_per_page' => 1,
				'include' => $nextPost->ID
			);
			$nextPost = get_posts($args);
			foreach ($nextPost as $post) {
				setup_postdata($post);
	?>
	<div id="next-panel" class="small-caps">
		<a id="next-tab" href="<?php the_permalink(); ?>"><i class="icon-chevron-next icon-large"></i></a>
		<ul><li>
		<span class="img-frame"><span class="small-thumb"><?php the_post_thumbnail('nextprev'); ?></span></span>
		<a href="<?php the_permalink(); ?>"><?php mgm_trimd_title('...', 45) ?>
		<span class="post-attribute"><?php the_date('F j, Y'); ?></span></a>
		</li></ul>
	</div>
	<?php
				wp_reset_postdata();
			} //end foreach
		} // end if
	?>