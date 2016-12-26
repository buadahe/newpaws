<div class="mgm-social-share clearfix">
	
	<span class="mgm-share-text hidden-xs wow pulse" data-wow-delay="1s"><?php _e('Share it !', 'mightymag') ?></span>
	
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
	
</div>
<div class="clear"></div>