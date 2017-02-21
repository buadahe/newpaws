<?php

/*
Template Name: Template Gallery
 */

?>

<?php get_header();?>

<?php
$args = array(
    'numberposts'    => -1, // Using -1 loads all posts
    'orderby'        => 'menu_order', // This ensures images are in the order set in the page media manager
    'order'          => 'ASC',
    'post_mime_type' => 'image', // Make sure it doesn't pull other resources, like videos
    'post_parent'    => 0, // Important part - ensures the associated images are loaded
    'post_status'    => null,
    'post_type'      => 'attachment',
);

$images = array_filter(get_children($args), function ($img){ return $img->post_author != 1; });
// print_r($images);
// echo count($images);
?>

<div class="row">
	<section id="primary" class="content-area col-md-12">
		<div id="content" class="site-content" role="main">

		<?php if ( $images ) : ?>

			<header class="entry-header boxed" style="margin-left: 10px;">
				
				<?php if ( of_get_option('mgm_breadcrumb') ) echo mgm_breadcrumb(); ?>
				
				<h1 class="entry-title">
					<span>Gallery</span>
				</h1>
			</header>
			<div id="gallery">
				<?php foreach (array_chunk($images, 4, true) as $image): ?>
					<div class="row">
					    <?php foreach($image as $img): ?>
						    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
						        <div class="thumbnail" data-toggle="modal" data-target="#popup" style="cursor: pointer;">
						            <img class="img-responsive" src="<?php echo $img->guid; ?>" alt="<?php echo $img->post_title; ?>" title="<?php echo $img->post_title; ?>">
								    <div class="caption" style="padding: 5px 0 0;">
							        	<p><?php echo $img->post_title; ?></p>
							        </div>
						        </div>
						    </div>
						<?php endforeach ?>
					</div>
				<?php endforeach ?>
			</div>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</div>
	</section>
</div>

<?php get_footer();?>
