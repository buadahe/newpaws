<?php 

$posts_per_page = of_get_option('mgm_ticker_count');
$ticker_title = of_get_option('mgm_ticker_title'); 

?>

<div id="ticker-wrap">	
		
		<div class="mgm-spinner-pos">
			<div class="mgm-spinner"></div>
		</div>
		
		<ul id="ticker-items">
		<?php 
			query_posts( array(
				
				'posts_per_page' => $posts_per_page,
				'cat' => of_get_option('mgm_ticker_cat')
			));
		?>
		
			<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
			<li class="news-item">
				<span class="ticker-title"><?php echo $ticker_title ?> </span><a href='<?php the_permalink(); ?>' title='<?php the_title() ?>'><?php the_title(); ?></a>
			</li>
			<?php endwhile; 
			endif; ?>
			
			<?php wp_reset_query() ?>
		</ul>
		
		<span class="ticker-controls next"></span>
		<span class="ticker-controls prev"></span>
		
</div><!-- #ticker -->