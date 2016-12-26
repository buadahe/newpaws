<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>

<header class="entry-header boxed">

	<?php if ( of_get_option('mgm_breadcrumb') ) echo mgm_breadcrumb(); ?>
	<h1 class="entry-title"><?php _e( 'Nothing Found', 'mightymag' ); ?></h1>

</header><!-- .entry-header -->

<div class="clear"></div>

<article id="post-0" class="post no-results not-found">

	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p class="tc"><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mightymag' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p class="tc"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mightymag' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p class="tc"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mightymag' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 .post .no-results .not-found -->
