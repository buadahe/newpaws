<?php 

$posts_per_page = of_get_option('mgm_ticker_count');
$ticker_title = __('Now on sale //', 'mightymag'); 

?>

<div id="ticker-wrap">
		
		<div class="mgm-spinner-pos">
			<div class="mgm-spinner"></div>
		</div>
		
		<ul id="ticker-items">
			<?php 
				query_posts( array(
					
					'post_type'  => 'product',
					'meta_query' => array(
					
						array(
							'key'  => '_sale_price',
						)
					)
				));
			?>
		
			<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
			
			<?php   $regular_price = get_post_meta( get_the_ID(), '_regular_price', true); 
					$sale_price = get_post_meta( get_the_ID(), '_sale_price');
			?>
			
			<li class="news-item">
				<span class="ticker-title"><?php echo $ticker_title ?> </span><a href='<?php the_permalink(); ?>' title='<?php the_title() ?>'><?php the_title(); ?></a><span><span class="ticker-title"> // </span><?php woocommerce_get_template( 'loop/price.php' ); ?> <span class="ticker-title"><?php _e('ONLY!', 'mightymag') ?></span></span>
			</li>
			<?php endwhile;
			endif; ?>

			<?php wp_reset_query() ?>
		</ul>
		
		<span class="ticker-controls next"></span>
		<span class="ticker-controls prev"></span>
		
</div><!-- #ticker -->