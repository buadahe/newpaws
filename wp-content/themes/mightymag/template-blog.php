<?php

/*
Template Name: MightyMag Blog
*/

?>

<?php get_header(); ?>


<?php if ( of_get_option('tabs_activate')) { get_template_part( 'partials/part', 'tabs' ); } // Get Home Tabs if enabled ?>

<div class="row">
		
		<div id="primary" class="content-area col-md-12">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>
				
				<div id="loop-wrap">
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>
					
				<?php endwhile; ?>

				</div><!-- #loop-wrap-->		

				<?php mgm_num_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
	<!--<div class="col-md-4">--><?php /*get_sidebar();*/ ?><!--</div>-->

</div><!--row-->

<?php get_footer(); ?>