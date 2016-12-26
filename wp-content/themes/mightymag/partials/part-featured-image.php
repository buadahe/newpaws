	<div class="entry-img featured-img">	
	
	<?php if (!$small_featured) { ?>

		<span class="entry-img-src">
		<?php 
			if ($has_post_thumbnail AND !$mgm_has_video AND !$full_width) { the_post_thumbnail('regular-featured');} 
			elseif ($has_post_thumbnail AND !$mgm_has_video AND $full_width ) { the_post_thumbnail('slider-full');}
			elseif ($mgm_has_video) echo $mgm_video;		
		?>
		</span>
		
	<?php } else { ?>
		
		<div class="small-featured-image-wrap">
		
			<?php				
			if (!$mgm_has_video) { ?>
			
			<span class="entry-img-src"><?php the_post_thumbnail('small-featured'); //load small featured image ?></span>
			
			<?php } else { ?>
			
			<span class="entry-img-src"><?php echo $mgm_video; // load small video ?></span>
			
			<?php } ?>
		
		</div><!-- small-featured-image-wrap -->
		
	<?php } ?>
			
	</div><!-- entry-img -->