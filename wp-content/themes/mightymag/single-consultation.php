<?php get_header(); ?>


	<div class="row" style="margin: -35px 10px 0px;">
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<div class="col-md-8">

			<div id="primary" class="content-area single-custom">
				<div id="content" class="site-content" role="main">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header boxed">
		
							<?php if ( of_get_option('mgm_breadcrumb') ) echo mgm_breadcrumb(); ?>
							<div class="entry-details clearfix">
								
								<div class="mgm-cat">
								
									<?php
										$categories = get_the_category();
										$separator = ' ';
										$output = '';
										
										if($categories){
											foreach($categories as $category) {
												
												$category_ID =  $category->cat_ID;	
												$category_color = get_tax_meta($category_ID,'mgm_color_field_id');	
												
												$output .= '<a style="background-color: ' . $category_color . '" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'mightymag' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
											}
										echo trim($output, $separator);
										}
									?>

								</div>
								
								<span class="mgm-details">
								
									<span class="entry-posted-on"><?php mgm_posted_on(); ?></span>
									<span> | </span>
									<?php if ( of_get_option('mgm_pageviews', true) ) { /* @since MGM 1.4 */ ?>
									<span class="entry-details-item">
										<?php echo mgm_get_post_views(get_the_ID()); //Show Post Views ?>
									</span>
									<?php } ?>
									
									<?php if ( of_get_option('mgm_commentscount', true) ) { /* @since MGM 1.4 */ ?>
									<span class="entry-details-item">
										<a href="<?php comments_link(); ?>">
											<span class="glyphicon glyphicon-comment"></span>
											<?php comments_number( '0', '1', '%' ); ?>
										</a>
									</span>
									<?php } ?>
									
								</span>
							</div><!--entry-details-->

							<h1 class="entry-title"><?php the_title(); ?></h1>		
							
							<div class="clear"></div>
							
						</header><!-- .entry-header -->
					</article>

					<div class="entry-content clearfix">
						<?php the_content(); ?>

						
					</div><!-- .entry-content -->
				</div>
			</div>

			<!-- AUTHOR -->
			<h4 class="mgm-title">
				<span class="inner"><?php _e('About The Author', 'mightymag'); ?></span>
			</h4>
			<div id="primary" class="content-area single-custom">
				<?php 
				/*Get Author Box*/
				if ('consultation' == get_post_type() && ( of_get_option('mgm_author')) ) echo get_template_part ('partials/part', 'author');
				?>
			</div>
			<!-- CLOSE AUTHOR -->

		</div>

		<?php if (!$mgm_full_width) { ?>
		<div class="col-md-4"><?php get_sidebar(); ?></div>
		<?php } ?>


		<?php endwhile; ?>
 		<?php else: ?>
		<p>Sorry, Not Post Found.</p>
 		<?php endif; ?>
	</div>

<?php get_footer(); ?>