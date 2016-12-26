<!--left slider-->
<div class="row sliders slider-cat">

<?php
$category_ID = get_query_var('cat');
?>

	<div class="flex-container slider1">	

		<div class="flexslider col-md-12">
		
			<ul class="slides">
			
			<?php
			query_posts(array('cat' => $category_ID, 'posts_per_page' => '5', 'meta_key' => '_thumbnail_id' ));
			if(have_posts()) :
				while(have_posts()) : the_post();
			?>
				<li>
				
					<?php the_post_thumbnail('regular-featured'); ?>
					
					<div class="flex-caption">
					
						<h1>
						
						<span class="relative-wrap">
						
						<span class="flex-cat">
					
							<?php
							$category = get_the_category($post->ID);
							$cat_id = get_cat_ID( $name );
							$link = get_category_link( $cat_id );
								
								if (of_get_option('mgm_parentcat') == 'end' ) {
									echo '<a href="'. get_category_link( end($category)->term_id ) .'">'. end($category)->cat_name .'</a>';
								} else {
								
								$parentscategory ="";
									foreach((get_the_category()) as $category) {
										if ($category->category_parent == 0) {
											$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
										}
									}
									echo substr($parentscategory,0,-2);
								}
							?>		
							</span>
								
						<a class="mgm-overtitle" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mightymag' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title() ?></a>
						</span>
						
						</h1>
						
						<div class="flex-excerpt"><p><?php echo mgm_string_limit_words(get_the_excerpt(), 18); ?></p></div>
						
					</div><!--.flex-caption-->

				</li>
				<?php
					endwhile;
				endif;
				wp_reset_query();
				?>
			</ul>
		</div><!-- .flexslider -->
	
	</div><!-- .flex-container -->

</div><!--.row .sliders-->

<hr class="divider" />