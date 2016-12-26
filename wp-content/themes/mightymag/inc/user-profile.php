<?php
add_action('show_user_profile', 'wpsplash_extraProfileFields');
add_action('edit_user_profile', 'wpsplash_extraProfileFields');
add_action('personal_options_update', 'wpsplash_saveExtraProfileFields');
add_action('edit_user_profile_update', 'wpsplash_saveExtraProfileFields');

function wpsplash_saveExtraProfileFields($userID) {

	if (!current_user_can('edit_user', $userID)) {
		return false;
	}

	update_user_meta($userID, 'twitter', $_POST['twitter']);
	update_user_meta($userID, 'facebook', $_POST['facebook']);
	update_user_meta($userID, 'googleplus', $_POST['googleplus']);
	update_user_meta($userID, 'flickr', $_POST['flickr']);
	update_user_meta($userID, 'linkedin', $_POST['linkedin']);
	update_user_meta($userID, 'pinterest', $_POST['pinterest']);
}

function wpsplash_extraProfileFields($user)
{
?>
	<h3>Social Accounts</h3>

	<table class='form-table'>
		<tr>
			<th><label for='twitter'>Twitter</label></th>
			<td>
				<input type='text' name='twitter' id='twitter' value='<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'>Twitter Username. Eg. http://www.twitter.com/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='facebook'>Facebook</label></th>
			<td>
				<input type='text' name='facebook' id='facebook' value='<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'>Facebook Username or Alias. Eg. http://www.facebook.com/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='googleplus'>Google Plus</label></th>
			<td>
				<input type='text' name='googleplus' id='googleplus' value='<?php echo esc_attr(get_the_author_meta('googleplus', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'>Google Plus Username or Alias. Eg. http://plus.google.com/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='flickr'>Flickr</label></th>
			<td>
				<input type='text' name='flickr' id='flickr' value='<?php echo esc_attr(get_the_author_meta('flickr', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'>Flickr Username or Alias. Eg. http://www.flickr.com/photos/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='linkedin'>LinkedIn</label></th>
			<td>
				<input type='text' name='linkedin' id='linkedin' value='<?php echo esc_attr(get_the_author_meta('linkedin', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'>LinkedIn Username or Alias. Eg. http://www.linkedin.com/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='pinterest'>Pinterest</label></th>
			<td>
				<input type='text' name='pinterest' id='pinterest' value='<?php echo esc_attr(get_the_author_meta('pinterest', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'>Pinterest Username or Alias. Eg. http://pinterest.com/<strong>username</strong></span>
			</td>
		</tr>
	</table>
<?php } ?>