<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */

get_header(); ?>

<div class="row">

		<section id="primary" class="content-area col-md-8">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="entry-header boxed">
				
					<?php if ( of_get_option('mgm_breadcrumb') ) echo mgm_breadcrumb(); ?>
				
					<h1 class="entry-title"><?php printf( __( 'Search Results for <span class="cat-color">%s</span>', 'mightymag' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				
				</header><!-- .page-header -->

				<div id="mgm-loop-wrap">
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search'); ?>

				<?php endwhile; ?>

				</div><!-- #mgm-loop-wrap-->

				<?php mgm_num_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

	<div class="col-md-4"><?php get_sidebar(); ?></div>
	
</div><!-- .row (search)-->
<?php get_footer(); ?>