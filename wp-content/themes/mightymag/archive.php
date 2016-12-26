<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */

get_header(); ?>

<div class="row">
		<section id="primary" class="content-area col-md-8" style="padding: 0px;">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="entry-header boxed" style="margin-left: 10px;">
					
					<?php if ( of_get_option('mgm_breadcrumb') ) echo mgm_breadcrumb(); ?>
					
					<h1 class="entry-title">
					
						<span><?php
						
							if ( is_category() ) {
								printf( __( '', '%s', 'mightymag' ) . single_cat_title( '', false ) . '</span>' );

							} elseif ( is_tag() ) {
								printf( __( '', 'Tag Archives %s', 'mightymag' ) . single_tag_title( '', false ) . '</span>' );

							} elseif ( is_author() ) {
								/* Queue the first post, that way we know
								 * what author we're dealing with (if that is the case).
								*/
								the_post();
								printf( __( 'Author %s', 'mightymag' ), '<strong class="cat-color">&gt;</strong> <span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
								/* Since we called the_post() above, we need to
								 * rewind the loop back to the beginning that way
								 * we can run the loop properly, in full.
								 */
								rewind_posts();
								
							} elseif ( is_day() ) {
								printf( __( '','Daily Archives %s', 'mightymag' ) . get_the_date() . '</span>' );

							} elseif ( is_month() ) {
								printf( __( '','Monthly Archives %s', 'mightymag' ) . get_the_date( 'F Y' ) . '</span>' );

							} elseif ( is_year() ) {
								printf( __( '', 'Yearly Archives %s', 'mightymag' ) . get_the_date( 'Y' ) . '</span>' );

							} else {
								_e( 'Archives', 'mightymag' );

							}
						?></span>
					</h1>
					<?php
						if ( is_category() ) {
							// show an optional category description
							$category_description = category_description();
							if ( ! empty( $category_description ) )
								echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description reply-wrap">' . $category_description . '</div>' );

						} elseif ( is_tag() ) {
							// show an optional tag description
							$tag_description = tag_description();
							if ( ! empty( $tag_description ) )
								echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
						
						} elseif ( is_author() ) {
							get_template_part('partials/part','author-archive');
						}
						
					?>
				
				</header><!-- .page-header -->
				
				<?php if ( is_author() ) { ?>
				<h2 class="mgm-title">
					<span><?php _e('Posts by ', 'mightymag') . printf( get_the_author() ) ?></span>
				</h2>
				<?php } ?>
				
				<?php // Get Category Slider if enabled
				$category_ID = get_query_var('cat');
				$cat_slider = get_tax_meta($category_ID,'mgm_featured_slider');	
				
				if ( is_category() AND ($cat_slider == 'on') ) { get_template_part('partials/part', 'slider-category'); 
				
				} ?>

				<?php if ( is_category('109')) { ?> <!-- vet -->
					
					<!-- afrgun -->
						<?php 
						if ( of_get_option('tabs_activate_custom')) { 
							

							if (of_get_option('banner_ask_doctor') != NULL) {
						?>

							<div id="mgm-bottom-ad" class="banner_ask_doctor">
								<a href="mailto:info.pawsunion@gmail.com?subject=Konsultasi">
							    <?php echo ( of_get_option('banner_ask_doctor') ); ?>
							   </a>
							</div>

							<hr class="mgm-separator"/>


							<?php 
							} 
						}?>
					<!-- afrgun -->
	
					<div id="mgm-loop-wrap">
						<?php #$my_query = new WP_Query( 'posts_per_page=8' ); ?>
						<?php 
						$i = 1;
					 	while ( have_posts() ): the_post(); ?>
							<?php 
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );
							?> 
							<?php if($i % 2 == 0 ) :?>
								<div class="clearfix"></div>
							<?php endif; ?>

						<?php
						$i ++; ?>
						

						<?php endwhile; ?>
					</div><!-- #mgm-loop-wrap-->
					
				<?php } else if( is_category('118')) { ?>
						<!-- afrgun -->
						<?php 	if (of_get_option('banner_directories') != NULL) { ?>

							<div id="mgm-bottom-ad" class="banner_ask_doctor">
								<a href="mailto:info.pawsunion@gmail.com?subject=Pemesanan">
							    <?php echo ( of_get_option('banner_directories') ); ?>
							   </a>
							</div>

							<hr class="mgm-separator"/>


						<?php } ?> <!-- Directories -->
					<!-- afrgun -->

					<div id="mgm-loop-wrap">
						<?php #$my_query = new WP_Query( 'posts_per_page=8' ); ?>
						<?php 
						$i = 1;
					 	while ( have_posts() ): the_post(); ?>
							<?php 
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );
							?> 
							<?php if($i % 2 == 0 ) :?>
								<div class="clearfix"></div>
							<?php endif; ?>

						<?php
						$i ++; ?>
						

						<?php endwhile; ?>
					</div><!-- #mgm-loop-wrap-->

				<?php } else {?>
				
				
					<div id="mgm-loop-wrap">
						<?php #$my_query = new WP_Query( 'posts_per_page=8' ); ?>
						<?php 
						$i = 1;
					 	while ( have_posts() ) : the_post(); ?>
							<?php 
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );
							?> 
							<?php if($i % 2 == 0 ) :?>
								<div class="clearfix"></div>
							<?php endif; ?>

						<?php
						$i ++; ?>
						

						<?php endwhile; ?>
					</div><!-- #mgm-loop-wrap-->
				<?php } ?>
						

				<?php mgm_num_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->
		
    <div class="col-md-4"><?php get_sidebar(); ?>
        
    </div>
	
</div><!-- .row (archive)-->
<?php get_footer(); ?>
