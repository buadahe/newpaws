<?php 

$posts_per_page = of_get_option('mgm_ticker_count');
$ticker_title = __('', 'mightymag'); 

?>

<div id="shop-banner-wrap">
		
		<div class="mgm-spinner-pos">
			<div class="mgm-spinner"></div>
		</div>
		
		<ul id="shop-banner-items">
		
			<?php 
				query_posts( array(
					
					'post_type'  => 'product',
					'orderby' => 'rand',
					
				));
			?>
		
			<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
			
			<li class="news-item">
				
				<div class="animated fadeInLeft">
					<a itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" rel="thumbnails" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>"><?php echo get_the_post_thumbnail( $post->ID ) ?></a>
				</div>
				
				<div class="shop-banner-txt-wrap">
				
					<span class="shop-banner-title mgm-font animated fadeInRight">					
						<a href='<?php the_permalink(); ?>' title='<?php the_title() ?>'><?php the_title(); ?></a>
					</span>
					
					<span class="shop-banner-price animated pulse"><?php woocommerce_get_template( 'loop/price.php' ); ?></span>
				</div>
				
			</li>
			<?php endwhile;
			endif; ?>

			<?php wp_reset_query() ?>
		</ul>
		
		<span class="shop-banner-controls next"></span>
		<span class="shop-banner-controls prev"></span>
		
</div><!-- #ticker -->