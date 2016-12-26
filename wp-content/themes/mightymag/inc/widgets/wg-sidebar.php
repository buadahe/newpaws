<?php

/*
==========================================================
FACEBOOK FANS
==========================================================
*/

class facebook_page_custom extends WP_Widget {
	function facebook_page_custom() {
		$widget_ops = array('classname' => 'facebook_page_custom', 'description' => 'Official Facebook Like Box' );
		parent::__construct('facebook_page_custom', 'MightyMag - Facebook Page', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$fb_page_url = $instance['fb_page_url'];
		
		if(!empty($fb_page_url))
		{
			if(isset($_SESSION['mgm_menu_style']))
			{
				$mgm_menu_style = $_SESSION['mgm_menu_style'];
			}
			else
			{
				$mgm_menu_style = of_get_option('alt_stylesheet');
			}
			
			$fb_skin = 'light';
			$fb_border = 'ffffff';
			if($mgm_menu_style != 3 && $mgm_menu_style != 6)
			{
				$fb_skin = 'light';
				$fb_border = 'ffffff';
			}
			else
			{
				$fb_skin = 'dark';
				$fb_border = 'ffffff';
			}
?>
<h4 class="mgm-title">
    <span class="inner"><?php _e('Facebook', 'mightymag') ?></span>
</h4>

<div class="widget-wrapper">
	<iframe seamless src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($fb_page_url); ?>&amp;width=280&amp;height=258&amp;colorscheme=<?php echo $fb_skin; ?>&amp;show_faces=true&amp;border_color=%23<?php echo $fb_border; ?>&amp;stream=false&amp;header=false&amp;appId=268239076529520" style="background: #f6f6f6; overflow:hidden; height: 258px; width:100%; border: none"></iframe>
</div>
<?php
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['fb_page_url'] = strip_tags($new_instance['fb_page_url']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'fb_page_url' => '') );
		$fb_page_url = strip_tags($instance['fb_page_url']);

?>
<p>
	<label for="<?php echo $this->get_field_id('fb_page_url'); ?>">Facebook Page URL:
		<input class="widefat" id="<?php echo $this->get_field_id('fb_page_url'); ?>" name="<?php echo $this->get_field_name('fb_page_url'); ?>" type="text" value="<?php echo esc_attr($fb_page_url); ?>" />
	</label>
</p>
<?php
	}
}

register_widget('facebook_page_custom');

/*
==========================================================
FLICKR STREAM
==========================================================
*/

	class flickr_custom extends WP_Widget {
	function flickr_custom() {
		$widget_ops = array('classname' => 'flickr_stream', 'description' => 'Flickr Widget' );
		parent::__construct('flickr_stream', 'MightyMag - Flickr', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $user = empty($instance['user']) ? ' ' : apply_filters('widget_user', $instance['user']);
        $counter = empty($instance['counter']) ? ' ' : apply_filters('widget_counter', $instance['counter']);
		echo $before_title;
        echo $title;
		echo $after_title;
        echo '
			<div class="flickr clearfix">
			<script src="http://www.flickr.com/badge_code_v2.gne?show_name=1&amp;count='.$counter.'&amp;display=latest&amp;size=s&amp;layout=v&amp;source=user&amp;user='.$user.'" type="text/javascript">
			</script>
			</div>
			';
        echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['user'] = strip_tags($new_instance['user']);
        $instance['counter'] = strip_tags($new_instance['counter']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'user' => '', 'counter' => '' ) );
		$title = strip_tags($instance['title']);
        $user = strip_tags($instance['user']);
        $counter = strip_tags($instance['counter']);
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">Title:
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('user'); ?>">Flickr User ID: <a href="http://idgettr.com/" target="_blank">Find it here</a>
		<input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $instance['user']; ?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('counter'); ?>">Counter: <br /> <small>Max. 10</small>
		<input class="widefat" id="<?php echo $this->get_field_id('counter'); ?>" name="<?php echo $this->get_field_name('counter'); ?>" type="text" value="<?php echo $instance['counter']; ?>" />
	</label>
</p>
<?php
	}
}
register_widget('flickr_custom');


/*
==========================================================
DOUBLE ADS
==========================================================
*/

class mgm_custom_ads extends WP_Widget {
	var $settings = array( 'title', 'adcode', 'image', 'href', 'alt', 'title1', 'adcode1', 'image1', 'href1', 'alt1' );

	function mgm_custom_ads() {
		$widget_ops = array('description' => 'Add a Double Side by Side Banners Blocks to Your Content (e.g. 2x 125x125px)' );
		parent::__construct(false, __('MightyMag - Double Ads Widget', 'mightymag'),$widget_ops);      
	}

	function widget($args, $instance) {
		$settings = $this->mgm_get_settings();
		extract( $args, EXTR_SKIP );
		$instance = wp_parse_args( $instance, $settings );
		extract( $instance, EXTR_SKIP );

		if ( $title != '' )
			echo $before_title . apply_filters( 'mgm-title', $title, $instance, $this->id_base ) . $after_title;

?>

<div class="ads-widget widget double-ad clearfix">

<?php

		if ( $adcode != '' ) {
			echo '<span class="left-ad">';
			echo $adcode;
			echo '</span>';
		} else {
			?>
			
	<a class="left-ad" href="<?php echo esc_url( $href ); ?>"><img src="<?php echo $image; ?>" alt="<?php echo esc_attr( $alt ); ?>" /></a>
	<?php
		}
		
		if ( $adcode1 != '' ) {
			echo '<span class="right-ad">';
			echo $adcode1;
			echo '</span>';
		} else {
			?>
	<a class="right-ad" href="<?php echo esc_url( $href1 ); ?>"><img src="<?php echo $image1; ?>" alt="<?php echo esc_attr( $alt1 ); ?>" /></a>
	<?php
		}
		echo '</div>';
		
	}

	function update( $new_instance, $old_instance ) {
		foreach ( array( 'title', 'alt', 'image', 'href', 'title1', 'alt1', 'image1', 'href1' ) as $setting )
			$new_instance[$setting] = strip_tags( $new_instance[$setting] );
			
		// You need to enable unfiltered_html in order to update this field
		if ( !current_user_can( 'unfiltered_html' ) )
			$new_instance['adcode'] = $old_instance['adcode'];
		return $new_instance;
	
		if ( !current_user_can( 'unfiltered_html' ) )
			$new_instance['adcode1'] = $old_instance['adcode1'];
		return $new_instance;
	}


	function mgm_get_settings() {
		// Blank string Defaults
		$settings = array_fill_keys( $this->settings, '' );
		// Specific defaults
		return $settings;
	}

	function form($instance) {
		$instance = wp_parse_args( $instance, $this->mgm_get_settings() );
		extract( $instance, EXTR_SKIP );
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('Title (optional):','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
</p>
<p style="font-style:italic"><strong>Box No. 1</strong></p>
<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
<p>
	<label for="<?php echo $this->get_field_id('adcode'); ?>">
		<?php _e('Ad Code:','mightymag'); ?>
	</label>
	<textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo esc_textarea( $adcode ); ?></textarea>
</p>
<p style="font-style:italic"><strong>or</strong></p>
<?php endif; ?>
<p>
	<label for="<?php echo $this->get_field_id('image'); ?>">
		<?php _e('Image Url:','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo esc_attr( $image ); ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('href'); ?>">
		<?php _e('Link URL:','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo esc_attr( $href ); ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('alt'); ?>">
		<?php _e('Alt text:','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo esc_attr( $alt ); ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
</p>
<br />
<p style="font-style:italic"><strong>Box No. 2</strong></p>
<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
<p>
	<label for="<?php echo $this->get_field_id('adcode1'); ?>">
		<?php _e('Ad Code:','mightymag'); ?>
	</label>
	<textarea name="<?php echo $this->get_field_name('adcode1'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode1'); ?>"><?php echo esc_textarea( $adcode1 ); ?></textarea>
</p>
<p style="font-style:italic"><strong>or</strong></p>
<?php endif; ?>
<p>
	<label for="<?php echo $this->get_field_id('image1'); ?>">
		<?php _e('Image Url:','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('image1'); ?>" value="<?php echo esc_attr( $image1 ); ?>" class="widefat" id="<?php echo $this->get_field_id('image1'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('href1'); ?>">
		<?php _e('Link URL:','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('href1'); ?>" value="<?php echo esc_attr( $href1 ); ?>" class="widefat" id="<?php echo $this->get_field_id('href1'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('alt1'); ?>">
		<?php _e('Alt text:','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('alt1'); ?>" value="<?php echo esc_attr( $alt1 ); ?>" class="widefat" id="<?php echo $this->get_field_id('alt1'); ?>" />
</p>
<?php
	}
} 

register_widget( 'mgm_custom_ads' );


/*
==========================================================
SINGLE AD
==========================================================
*/

class mgm_custom_single_ad extends WP_Widget {
	var $settings = array( 'title', 'adcode', 'image', 'href', 'alt');

	function mgm_custom_single_ad() {
		$widget_ops = array('description' => 'Add a Single Banner Block to Your Content (e.g. 300x250px)' );
		parent::__construct(false, __('MightyMag - Single Ad Widget', 'mightymag'),$widget_ops);      
	}

	function widget($args, $instance) {
		$settings = $this->mgm_get_settings();
		extract( $args, EXTR_SKIP );
		$instance = wp_parse_args( $instance, $settings );
		extract( $instance, EXTR_SKIP );
		
		
?><div class="ads-widget single-ad widget"><?php

		if ( $title != '' )
			echo $before_title . apply_filters( 'mgm-title', $title, $instance, $this->id_base ) . $after_title;

		if ( $adcode != '' ) {
			echo $adcode;
		} else {
			?>

<a href="<?php echo esc_url( $href ); ?>"><img src="<?php echo $image; ?>" alt="<?php echo esc_attr( $alt ); ?>" /></a>

<?php }
		echo '</div>';
		
	}

	function update( $new_instance, $old_instance ) {
		foreach ( array( 'title', 'alt', 'image', 'href') as $setting )
			$new_instance[$setting] = strip_tags( $new_instance[$setting] );
			
		// You need to enable unfiltered_html in order to update this field
		if ( !current_user_can( 'unfiltered_html' ) )
			$new_instance['adcode'] = $old_instance['adcode'];
		return $new_instance;
	}

	function mgm_get_settings() {
		// Blank string Defaults
		$settings = array_fill_keys( $this->settings, '' );
		// Specific defaults
		return $settings;
	}

	function form($instance) {
		$instance = wp_parse_args( $instance, $this->mgm_get_settings() );
		extract( $instance, EXTR_SKIP );
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('Title (optional):','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
</p>
<p style="font-style:italic"><strong>Box No. 1</strong></p>
<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
<p>
	<label for="<?php echo $this->get_field_id('adcode'); ?>">
		<?php _e('Ad Code:','mightymag'); ?>
	</label>
	<textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo esc_textarea( $adcode ); ?></textarea>
</p>
<p style="font-style:italic"><strong>or</strong></p>
<?php endif; ?>
<p>
	<label for="<?php echo $this->get_field_id('image'); ?>">
		<?php _e('Image Url:','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo esc_attr( $image ); ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('href'); ?>">
		<?php _e('Link URL:','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo esc_attr( $href ); ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('alt'); ?>">
		<?php _e('Alt text:','mightymag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo esc_attr( $alt ); ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
</p>

<?php
	}
} 

register_widget( 'mgm_custom_single_ad' );


/*
==========================================================
VIDEOS
==========================================================
*/

add_action('widgets_init','mgm_video_custom');


function mgm_video_custom(){
		register_widget("mgm_video_widget");
}

class mgm_video_widget extends WP_widget{
	
	function mgm_video_widget(){
		$widget_ops = array('classname' => 'mgm_video_widget', 'description' => 'Video Widget');

		$control_ops = array('id_base' => 'mgm_video_widget');

		parent::__construct('mgm_video_widget', 'MightyMag - Video Embed', $widget_ops, $control_ops);
		
	}
	
	function widget($args,$instance){
		extract($args);

		$title = apply_filters('widget_title', $instance['title'] );
		$type = $instance['type'];
		$id = $instance['id'];

			echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
?>
<div class="videostream">
	<?php if($type == 'Youtube') { ?>
	<iframe name="youtube_<?php echo $id; ?>" width="560" height="315" src="http://www.youtube.com/embed/<?php echo $id; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<?php } elseif($type == 'Vimeo') { ?>
	<iframe name="vimeo_<?php echo $id; ?>" src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php } elseif($type == 'Dailymotion') { ?>
	<iframe name="dailymotion_<?php echo $id ?>" frameborder="0" src="http://www.dailymotion.com/embed/video/<?php echo $id ?>?logo=0"></iframe>
	<?php } ?>
</div>
<?php 

		echo $after_widget;
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = $new_instance['type'];
		$instance['id'] = $new_instance['id'];
		return $instance;
	}
	
	function form($instance){
		$defaults = array( 'title' => 'Video' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>">
		<?php _e('Title:', 'mightymag') ?>
	</label>
	<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'type' ); ?>">
		<?php _e('type', 'mightymag') ?>
	</label>
	<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
		<option <?php if (isset($instance['type']) && 'Youtube' == $instance['type'] ) echo 'selected="selected"'; ?>>Youtube</option>
		<option <?php if (isset($instance['type']) && 'Vimeo' == $instance['type'] ) echo 'selected="selected"'; ?>>Vimeo</option>
		<option <?php if (isset($instance['type']) && 'Dailymotion' == $instance['type'] ) echo 'selected="selected"'; ?>>Dailymotion</option>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'id' ); ?>">
		<?php _e('Video <strong>ID</strong>:', 'mightymag') ?>
	</label>
	<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php if (isset($instance['id']) ) echo $instance['id']; ?>" class="widefat" />
</p>
<?php

	}
}


/*
==========================================================
HOME CAROUSEL WIDGET
==========================================================
*/

add_action( 'widgets_init', 'mgm_carousel_load_widgets' );

function mgm_carousel_load_widgets() {
	register_widget( 'mgm_carousel_widget' );
}

class mgm_carousel_widget extends WP_Widget {

	function mgm_carousel_widget() {
		
		/* General settings. */
		$widget_ops = array( 'classname' => 'mgm_carousel_widget', 'description' => __('A carousel widget.', 'mgm_carousel_widget') );

		/* Control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mgm_carousel_widget' );

		/* Creation */
		parent::__construct( 'mgm_carousel_widget', __('MightyMag - Carousel Widget', 'mgm_carousel_widget'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		
		global $post;
		
		extract( $args );
		
		wp_enqueue_script( 'elastislide', get_template_directory_uri() . '/js/jquery.elastislide.min.js', array('jquery'), '1.0', true );

		/* Setting the options */
		$title = apply_filters('widget_title', $instance['title'] );
		$chars = $instance['chars'];
		$number = $instance['number'];
		$tags = $instance['tags'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		?>
		
			<div class="carousel es-carousel-wrap">
				<div class="es-carousel">
					<ul>

					<?php 
					if ('all' == $instance['tags']) {
					$recent = new WP_Query(array( 'showposts' => $number));
					} else {
					$recent = new WP_Query(array('tag' => $tags, 'showposts' => $number));					
					}
					
					while($recent->have_posts()) : $recent->the_post();?>
					
					<?php
					$mgm_video = get_post_meta($post->ID, 'mgm_video_encode', true);
					$mgm_has_video = $mgm_video != ""; 
					?>
						<li>
							<div class="carousel-image <?php if ( !has_post_thumbnail() ) echo 'no-thumb'?>">
							
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
							
									<?php the_post_thumbnail('carousel-thumbs');?>
									
								<?php } else {
							
									echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="no-thumb-img"></span></a>'; }
				
									if ( $mgm_has_video ) { echo '<span class="mgm-video-icon mgm-video-icon-center"><span class="glyphicon glyphicon-play"></span></span>'; 
								} ?>
							</div><!---carousel-image-->
							
							<div class="carousel-text">
									<a class="mgm-overtitle" href="<?php the_permalink() ?>"><?php mgm_trimd_title('...', $chars); ?></a>
							</div><!--carousel-text-->
						</li>
					<?php endwhile;
					wp_reset_query();?>
					</ul>
				</div><!--es-carousel-->
			</div><!--carousel-->


		<?php

		echo $after_widget;
	}

	/**
	 * Update widget settings
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['chars'] = strip_tags( $new_instance['chars'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['tags'] = $new_instance['tags'];


		return $instance;
	}


	function form( $instance ) {

		/* Defaults */
		$defaults = array( 'title' => __('Widget Title', 'mightymag'), 'number' => 10, 'chars' => 40, 'tags' => 'all');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'mightymag'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
			<small><?php _e('Leave empty not to show any', 'mightymag'); ?></small>
		</p>
		
		<!-- Chars Count -->
		<p>
			<label for="<?php echo $this->get_field_id( 'chars' ); ?>"><?php _e('Maximum chars number to show:', 'mightymag'); ?></label>
			<input id="<?php echo $this->get_field_id( 'chars' ); ?>" name="<?php echo $this->get_field_name( 'chars' ); ?>" value="<?php echo $instance['chars']; ?>" size="3" />
		</p>

		<!-- Post Count -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Maximum number of posts to show:', 'mightymag'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>

		<!-- Tag Selection -->
		<p>
			<label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Select Tag', 'mightymag'); ?></label>
			<select id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['tags']) echo 'selected="selected"'; ?>><?php _e('All Tags', 'mightymag'); ?></option>
				<?php $tags = get_tags('hide_empty=0'); ?>
				<?php foreach($tags as $tag) { ?>
				<option value='<?php echo $tag->slug; ?>' <?php if ($tag->slug == $instance['tags']) echo 'selected="selected"'; ?>><?php echo $tag->name; ?></option>
				<?php } ?>
			</select>
		</p>


	<?php
	}
}

?>