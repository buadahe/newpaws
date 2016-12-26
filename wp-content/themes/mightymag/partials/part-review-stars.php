<div id="rating-box" class="<?php if ( ($mgm_box_position) == 'top' ) echo 'rating-box-top '; ?>boxed wow fadeInUp">

	<?php if ( ($mgm_review_header) != '' ) { ?>
	<span id="rw-box-title"><?php echo $mgm_review_header; ?></span>
	<?php } ?>
	
	<?php
	$i = 0;
	while( $i < 6 ){
	$i ++;
	
	$criteria = "mgm_rating_c".$i."";
	$description = "mgm_description_c".$i."";
	$width = "mgm_percentage_c".$i."";
	
	if (isset($$criteria) && $$description != '') { ?>
	
	<div class="rw-criteria">
			<span class="criteria-stars-color wow bounceIn" data-wow-delay="0.5s">
				<span class="criteria-stars-overlay" style="width:<?php echo $$width; ?>%"></span>
			</span>
		<span class="criteria-description"><?php echo $$description ?></span>
	</div>
	
	<?php }
	} ?>
	
	<div itemprop="review" itemscope itemtype="http://schema.org/Review">
		<div class="rw-end">
	
			<div class="rw-overall">
				<span class="rw-overall-number" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
					<span itemprop="ratingValue" class="wow tada" data-wow-delay="2s"><?php echo (intval($mgm_overall_score/2))/10 . "\n"; ?></span>
				</span>
				
				<meta itemprop="itemReviewed" content="<?php the_title(); ?>" />
				<meta itemprop="author" content="<?php the_author(); ?>" />
				<meta itemprop="datePublished" content="<?php echo get_the_date(); ?>">
				
				<span class="rw-overall-tag wow pulse" data-wow-delay="3s"><?php echo $mgm_tagline ?></span>
				
				<?php //Get user rating for the post 
				$mgm_user_rating_switch = get_post_meta($post->ID, 'mgm_user_rating_switch', true);
					if ($mgm_user_rating_switch) { get_template_part ('partials/part', 'user-rating'); 
				} ?>
				
			</div><!--.rw-overall-->
			
			<div class="rw-summary">
				<p itemprop="description"><?php echo $mgm_summary ?></p>
			</div>
		
		</div><!--.rw-end-->
		
		<?php //Get Affiliate Link Stripe
		$mgm_affiliate = get_post_meta($post->ID, 'mgm_affiliate', true);
			if ($mgm_affiliate != NULL ) { get_template_part ('partials/part', 'review-affiliate'); 
		} ?>
		
	</div><!--schema.org wrap-->
	
</div><!-- #rating-box -->