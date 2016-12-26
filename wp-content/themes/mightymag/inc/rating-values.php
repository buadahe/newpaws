<?php
//Get the comments option
$mgm_comment_type = get_post_meta(get_the_ID(), 'mgm_comment_type', true);

//Bring in the ratings data
$mgm_review_enable = get_post_meta(get_the_ID(), 'mgm_review_enable', true);
$mgm_user_rating_switch = get_post_meta(get_the_ID(), 'mgm_user_rating_switch', true);
$mgm_overall_score = get_post_meta(get_the_ID(), 'mgm_overall_score', true);
$mgm_summary = get_post_meta(get_the_ID(), 'mgm_summary', true);
$mgm_tagline = get_post_meta(get_the_ID(), 'mgm_tagline', true);
$mgm_review_scale = get_post_meta(get_the_ID(), 'mgm_review_scale', true);
$mgm_box_position = get_post_meta(get_the_ID(), 'mgm_box_position', true);
$mgm_review_header = get_post_meta(get_the_ID(), 'mgm_review_header', true);
$mgm_rating_c1 = get_post_meta(get_the_ID(), 'mgm_rating_c1', true);
$mgm_description_c1 = get_post_meta(get_the_ID(), 'mgm_description_c1', true);
$mgm_rating_c2 = get_post_meta(get_the_ID(), 'mgm_rating_c2', true);
$mgm_description_c2 = get_post_meta(get_the_ID(), 'mgm_description_c2', true);
$mgm_rating_c3 = get_post_meta(get_the_ID(), 'mgm_rating_c3', true);
$mgm_description_c3 = get_post_meta(get_the_ID(), 'mgm_description_c3', true);
$mgm_rating_c4 = get_post_meta(get_the_ID(), 'mgm_rating_c4', true);
$mgm_description_c4 = get_post_meta(get_the_ID(), 'mgm_description_c4', true);
$mgm_rating_c5 = get_post_meta(get_the_ID(), 'mgm_rating_c5', true);
$mgm_description_c5 = get_post_meta(get_the_ID(), 'mgm_description_c5', true);
$mgm_rating_c6 = get_post_meta(get_the_ID(), 'mgm_rating_c6', true);
$mgm_description_c6 = get_post_meta(get_the_ID(), 'mgm_description_c6', true);

// Calculate the percentages from the star ratings
$mgm_percentage_c1 = $mgm_rating_c1;
$mgm_percentage_c2 = $mgm_rating_c2;
$mgm_percentage_c3 = $mgm_rating_c3;
$mgm_percentage_c4 = $mgm_rating_c4;
$mgm_percentage_c5 = $mgm_rating_c5;
$mgm_percentage_c6 = $mgm_rating_c6;
$mgm_overall_percent = $mgm_overall_score;

// Setup new variable to echo out the sprite width
$mgm_width_c1 = $mgm_percentage_c1;
$mgm_width_c2 = $mgm_percentage_c2;
$mgm_width_c3 = $mgm_percentage_c3;
$mgm_width_c4 = $mgm_percentage_c4;
$mgm_width_c5 = $mgm_percentage_c5;
$mgm_width_c6 = $mgm_percentage_c6;
$mgm_overall_width = $mgm_overall_percent;

$format = get_post_format();
if (false === $format)
	$format = 'standard';
?>