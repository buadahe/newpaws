<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */

get_header();

$mgm_full_width = get_post_meta(get_the_ID(), 'mgm_full_width_switch', true); ?>

<div class="row">
		
		<div id="primary" class="content-area <?php if ($mgm_full_width) { echo 'col-md-12'; } else { echo 'col-md-8'; } ?>">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php // Load Facebook or WP Comments
					$mgm_comment_type = get_post_meta(get_the_ID(), 'mgm_comment_type', true);
					
					$url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
					?>
					
					<?php if ($mgm_comment_type == 'fb') { ?>
							
						<div class="fb-comments" data-width="100%" data-href="<?php echo $url; ?>" data-num-posts="4"></div>
						
					<?php } elseif ($mgm_comment_type == 'none') { 
						
								echo '';
					
						  } else {
						
							if ( comments_open() || '0' != get_comments_number() )
							comments_template( '', true );
						  }
					?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

		<div class="col-md-4">
        
<?php if ( of_get_option('mgm_bbpress_sidebar') == 'bbpress_sidebar' AND function_exists('bbp_version') AND is_bbpress() ) {			
					
					if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('BBpress')): endif;
					
					} elseif (!$mgm_full_width)  { 
						get_sidebar();
			}; ?>
		</div>
	
</div><!-- .row (single)-->
<?php get_footer(); ?>
