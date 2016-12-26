<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */

get_header(); ?>

<div class="row">
	<div id="primary" class="content-area col-md-8">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post not-found">
			
				<header class="entry-header boxed">
					
					<?php if ( of_get_option('mgm_breadcrumb') ) echo mgm_breadcrumb(); ?>
					
					<h1 class="entry-title"><?php _e( 'Whoopsie! That page can&rsquo;t be found.', 'mightymag' ); ?></h1>
				
				</header><!-- .entry-header -->

				<div class="entry-content">
				
					<span class="error-404">404 :(</span>
					
					<p class="error-404-msg cat-color">
						<?php _e( 'It looks like nothing was found at this location. <br>Maybe try a search?', 'mightymag' ); ?>
					</p>
					
					<?php get_search_form(); ?>
				
				</div><!-- .entry-content -->
				
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

	<div class="col-md-4"><?php get_sidebar(); ?></div>
	
</div><!-- .row (single)-->
<?php get_footer(); ?>