<?php     
$socials = array('vimeo' => 'Vimeo', 'gplus' => 'Google +', 'technorati' => 'Technorati', 'skype' => 'Skype', 'blogger' => 'Blogger', 'rss' => 'Rss Feed', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'twitter' => 'Twitter', 'delicious' => 'Delicious', 'youtube' => 'YouTube', 'flickr' => 'Flickr', 'digg' => 'Digg', 'stumble' => 'Stumble Upon', 'linkedin' => 'Linked In', 'deviant' => 'Deviant Art','picasa' => 'Picasa', 'dribbble' => 'Dribbble', 'tumblr' => 'Tumblr', 'forrst' => 'Forrst');  

$target = of_get_option('mgm_social_target');

?>

<?php if(!is_user_logged_in()) {?>
<ul class="login-box">
	<div class="login-text">
		<center>
			<a href="#" data-toggle="modal" data-target="#login-modal" class="login-text-detail">LOGIN</a>
			|
			<a href="#" data-toggle="modal" data-target="#register-modal" class="login-text-detail">REGISTER</a>
		</center>
	</div>
</ul>
<? } ?>

<ul class="socials">
	<?php foreach($socials as $key=>$val){
	if ( of_get_option('mgm_sm_'.$key) ) { 

	?>	
	<li><a href="<?php echo of_get_option('mgm_sm_'.$key); ?>" class="btn btn-social-icon <?php echo 'btn-'.$key; ?>" title="<?php _e('Follow us on', 'mightymag') ?> <?php echo $val; ?>" target="_blank">
		<span class="<?php echo 'fa fa-'.$key; ?>"></span>
	</a></li>
	<!--li><a href="<?php echo of_get_option('mgm_sm_'.$key); ?>" class="sprite-socials <?php echo 'sprite-'.$key; ?>" title="<?php _e('Follow us on', 'mightymag') ?> <?php echo $val; ?>" target="<?php if ($target) {echo '_blank';} else {echo '_self';}?>"></a></li-->
	<?php } 
}?>
</ul>