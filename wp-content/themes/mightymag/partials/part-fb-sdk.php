<?php
	
	if ($social_multicheck['fb_share'] == true OR $mgm_comment_type == 'fb') {
		echo '<div id="fb-root"></div>';
		echo '
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, "script", "facebook-jssdk"));
		</script>';
	}
?>