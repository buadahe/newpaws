<!-- HomePage Slider
================================================== -->

<?php
$slider = get_post_meta(get_the_ID(), 'mgm_hp_slider', true);
$featured_post = get_post_meta(get_the_ID(), 'mgm_featured_post_1', true);
$slider_1_words = of_get_option('mgm_slider_1_words');
?>

<div class="sliders clearfix<?php if($slider  == 'slider_grid') {echo ' slider-half';}?>">

	<div class="flex-container slider1">
		
		<div class="mgm-spinner-pos"><div class="mgm-spinner mgm-spinner-xl"></div></div>
		
		<div class="flexslider">	
			
			<ul class="slides">
			
			<?php //Slider query
		
			$querydetails = "
			SELECT wposts.*
			FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
			WHERE wposts.ID = wpostmeta.post_id
			AND wpostmeta.meta_key = 'mgm_featured_post_1'
			AND wpostmeta.meta_value = '1'
			AND wposts.post_status = 'publish'
			AND wposts.post_type IN ('post', 'page')
			ORDER BY wposts.post_date DESC
			";
			
			$pageposts = $wpdb->get_results($querydetails, OBJECT);
			
			$i = 0;
			if ($pageposts):
			foreach ($pageposts as $post):
			setup_postdata($post);
			
			$slider1_count = of_get_option('mgm_slider_1_count');

			$i++;
			$format = get_post_format();
			if ($i < $slider1_count + 1)
			
			{ ?>
			
				<li>
					<?php if (class_exists('MultiPostThumbnails')) {

MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'secondary-image');
 }

					//if ($slider == 'slider_grid') { the_post_thumbnail('slider-half'); } else { the_post_thumbnail('slider-full'); }; ?>
					
					<div class="flex-caption">
					
						<h1>
							<span class="relative-wrap">
							
								<?php
								
								if ( $post->post_type == 'post' ) {
		
										//Get and output Category Color as inline style
										
										foreach( (get_the_category() ) as $category) {
	
											$category_ID = $category->cat_ID;
											$category_color = get_tax_meta($category_ID,'mgm_color_field_id');
											$output = '';
											
											//$output .= '<span class="flex-cat" style="background: '.$category_color.'">';
												
										}
										
										echo $output;
									
										//Get and output last child category only
										
										$category = get_the_category($post->ID);
										$cat_id = get_cat_ID( $name );
										$link = get_category_link( $cat_id );
											
											
											//echo '<a href="'. get_category_link( end($category)->term_id ) .'">'. end($category)->cat_name .'</a>';
											echo '</span><!--flex-cat-->';
										
								} ?>
								
								<a class="mgm-overtitle" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mightymag' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title();?></a>
								
							</span><!--relative-wrap-->
						</h1>
						
						<div class="flex-excerpt">
							<p><?php echo mgm_string_limit_words(get_the_excerpt(), $slider_1_words); if ($slider_1_words != '0') echo '...' ?></p>
						</div>
						
					</div>
				</li>
				<?php } endforeach; 	
				endif; wp_reset_query();?>
			</ul>

		</div><!-- .flexslider -->
	
	</div><!-- .flex-container -->
	
	<?php if ($slider == 'slider_grid') { get_template_part('partials/part','grid'); }?>

</div><!--.row .sliders-->