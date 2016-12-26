<?php
/*
Template Name: Cstm Rescue
*/

get_header(); ?>


<?php 

	$args = array(	
		'post_type' 	=> 'post',
		'category_name'	=> 'rescue',
		'post_status'	=> 'publish',
		'posts_per_page' => -1,
		'paged'		    => $paged,
	);

	$rescue = get_posts($args);

?>

<div class="row">
		<section id="primary" class="content-area col-md-8">
			<div id="content" class="site-content" role="main">

				<header class="entry-header boxed">
					<?php if ( of_get_option('mgm_breadcrumb') ) echo mgm_breadcrumb(); ?>
					<h1 class="entry-title">
					
						<span><?php echo the_title(); ?></span>
					</h1>
				</header>

				<div class="col-md-6 cstm_btn_rescue">  
					<img src="<?php echo get_template_directory_uri(); ?>/images/no_thumb.png">
					<a href="#"><button class="btn btn-help"> Help Me </button></a>
				</div>

				<div class="col-md-6 cstm_btn_rescue"> 
					<img src="<?php echo get_template_directory_uri(); ?>/images/no_thumb.png">
					<a href="#"><button class="btn btn-help"> Help Me </button></a>
				</div>

				<div class="mgm-title mgm-title-tabs">
					<span class="current"><a href="#" style="color: #00aced !important;">YOU MAY ALSO LIKE</a></span>
				</div>
				<div class="col-md-6 col-sm-6">
					<?php
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Bottom Left')): 
						endif;
					?>
				</div>
				<div class="col-md-6 col-sm-6">
					<?php
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Bottom Right')): 
						endif;
					?>
				</div>
			

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->
		
	<div class="col-md-4"><?php get_sidebar(); ?></div>
	
</div><!-- .row (archive)-->
<?php get_footer(); ?>