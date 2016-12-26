<?php
$link = get_post_meta(get_the_ID(), 'mgm_affiliate', true);
$catch = get_post_meta(get_the_ID(), 'mgm_affiliate_catch', true);
$btn_txt = get_post_meta(get_the_ID(), 'mgm_affiliate_btn', true);
$btn_icon = get_post_meta(get_the_ID(), 'mgm_affiliate_btn_icon', true);
?>

<div class="affiliate-wrap clearfix">
	<p class="pull-left"><?php echo $catch; ?></p>
	<span class="affiliate-link"><a href="<?php echo $link; ?>" target="_blank" class="btn btn-success"><?php if ($btn_icon) { echo '<span class="glyphicon glyphicon-shopping-cart"></span> '; } ?><?php echo $btn_txt; ?></a></span>
</div>