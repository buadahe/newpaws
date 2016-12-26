<?php 
$user_rating = new mgm_user_rating();
$mgm_review_scale = get_post_meta(get_the_ID(), 'mgm_review_scale', true);
?>

<div id="rw-user-rating-wrapper">
	<div class="rw-user-rating-desc">
	
		<span class="your_rating" style="display:none;"><?php _e('Your Rating', 'mightymag'); ?></span>
		<span class="user_rating"><?php _e('Readers Rating', 'mightymag'); ?></span>

		<?php if (($mgm_review_scale) == 'percent') { ?>
		
			<span class="score percent"><?php echo $user_rating->current_rating ?><small>%</small></span>
			
			<div class="rw-user-rating">
				<div class="rw-bar-wrap">
					<span class="rw-bar-progress" style="width:<?php echo $user_rating->current_rating; ?>%"></span>
				</div>
			</div>
			
		<span class="count percent"><?php echo $user_rating->count; ?> <?php _e('votes', 'mightymag'); ?></span>	
		
		<?php } else { ?>
		
			<span class="score"><?php echo floor($user_rating->current_rating/2) /10 ?></span>

			<span class="rw-criteria rw-user-rating">
				<span class="criteria-stars-color">
					<span class="criteria-stars-overlay" style="width:<?php echo $user_rating->current_position; ?>%"></span>
				</span>
			</span>
			
		<span class="count stars"><?php echo $user_rating->count; ?> <?php _e('votes', 'mightymag'); ?></span>
		
		<?php } ?>
		
	</div><!--.rw-user-rating-desc-->
</div><!-- .rw-user-rating-wrapper -->