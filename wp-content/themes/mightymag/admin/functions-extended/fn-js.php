<?php

/*
==========================================================
JQUERY DEPENDANT - FOOTER LOADED DYNAMIC JS TRIGGERS
==========================================================
*/

function mgm_footer_scripts() {
    if( wp_script_is( 'jquery', 'done' ) ) { //Check if jQuery is loaded
	

		/*
		==========================================================
		Link featured image to full size in JackBox
		==========================================================
		*/

		global $post;
		
		if ( ( of_get_option('mgm_linkfullsize')) ) {
		$full_image_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'full');
		?>
			<script>
				jQuery(document).ready(function($) {
					$(".entry-img .entry-img-src a").attr("href", "<?php echo $full_image_url ?>");
					$(".entry-img .entry-img-src a").attr("data-group", "mgm-featured");
				});
			</script>
		<?php } else { ?>
			<script>
				jQuery(document).ready(function($) {
					$(".entry-img .entry-img-src a").css("cursor", "default");
					$('.entry-img-src a').contents().unwrap();
				});
			</script>
		<?php };
		
		
		/*
		==========================================================
		Useful Variable
		==========================================================
		*/
		
		?>
			<script>
			var templateDir = "<?php echo get_template_directory_uri() ?>";
			</script>
		<?php
		
		
		/*
		==========================================================
		Sticky Navigation
		==========================================================
		*/

		if ( of_get_option('mgm_stickynav') ) { ?>
		
		<script>
		jQuery( document ).ready( function( $ ) {
			
			/* djwd StickyClone function */
			var $nav = $(".nav-wrap"),
			
				//clone navigation
				$clone = $nav.before($nav.clone().attr( "id" , "nav-clone") );
				
				//rename the original nav ID to make the small menu toggle:target work
				$("#mgm-menu").attr('id', 'mgm-menu-replica');
				
				timeout = false;
			
			/* The function */
			$.fn.stickyNav = function() {
					
				$(window).on("scroll", function() {
					var fromTop = $( document ).scrollTop(); /* Firefox abmazumdar fix @since MGM 1.4 */
					
					if(fromTop > 400){
						$("body").addClass('down')
					} else {
						$("body").removeClass('down');
					};
				});
				
			};
		
			// Check viewport width on first load.
			if ( $( window ).width() >= 767 ) {
				$.fn.stickyNav();
			};
		
			// Check viewport width when user resizes the browser window.
			$( window ).resize( function() {
				var browserWidth = $( window ).width();
		
				if ( false !== timeout )
					clearTimeout( timeout );
		
				timeout = setTimeout( function() {
					if ( browserWidth > 767 ) {
						$.fn.stickyNav();	
					}
				}, 200 );
			} );
			
			//Remove double scroll up
			$( "#mgm-branding .scrollup, .nav-wrap#nav-original .scrollup" ).remove();
		} );
		
		</script>
		
		<?php };


		/*
		==========================================================
		Masonry Fire
		==========================================================
		*/

		if ( !is_singular() ) { ?>
		
			<script>
			//<![CDATA[
			jQuery(document).ready(function($) {
				var $container = $('#mgm-loop-wrap');
			
				var gutter = 30;
				var min_width = 360;
				$container.imagesLoaded( function(){
					$container.masonry({
						itemSelector : '.box',
						gutterWidth: gutter,
						isAnimated: true,
						  columnWidth: function( containerWidth ) {
							var num_of_boxes = (containerWidth/min_width | 0);
			
							var box_width = (((containerWidth - (num_of_boxes-1)*gutter)/num_of_boxes) | 0) ;
			
							if (containerWidth < min_width) {
								box_width = containerWidth;
							}
			
							$('.box').width(box_width);
			
							return box_width;
						  }
					});
				});
			});
			//]]>
			</script>
		<?php };

		
		/*
		==========================================================
		Primary Slider
		==========================================================
		*/
		
		$slider = get_post_meta(get_the_ID(), 'mgm_hp_slider', true);


		if ( $slider != 'slider_none') { ?>
			<script>
			
			jQuery(document).ready(function($) {
	
				$(".flex-container .mgm-spinner").hide(300);
				//$(".flexslider").delay(200).fadeIn(500);
				
				jQuery('.slider1 .flexslider').flexslider({
					
					animation: "<?php echo of_get_option('mgm_slider_1_animation'); ?>",
					direction: "<?php echo of_get_option('mgm_slider_1_direction'); ?>",
					startAt: <?php if ( !is_category() ) { echo of_get_option('mgm_slider_1_start', '0'); } else { echo '0'; } ?>,
					slideshowSpeed: <?php echo of_get_option('mgm_slider_1_slide_speed', '7000'); ?>,         
					animationSpeed: <?php echo of_get_option('mgm_slider_1_anim_speed', '600'); ?>, 
					useCSS: false,
					//directionNav: true,
					prevText: "",
					nextText: "",
					
					start: function(slider){
        				$('.slider1 .flexslider').resize();
					}
					
				});
				
			});
		
			</script>
		<?php };
		
		
		/*
		==========================================================
		Jackbox ON/OFF
		==========================================================
		*/
		
		if ( ( of_get_option('mgm_jackbox')) ) { ?>
			<script>
			jQuery(document).ready(function ($) {
				$('a[href]').filter(function() {
				  return /(jpg|gif|png)$/.test($(this).attr('href'))
				}).bind().addClass('jackbox'); //If a link targets an image, add .jackbox class
				
				$('.gallery-item .gallery-icon a').addClass('img-frame') //Add also img-frame class to galleries for hover effect
				$('.jackbox').not(".entry-img .entry-img-src a").attr('data-group','mgm-gallery'); //Add data-group attribute
				$(".jackbox").not(".entry-img .entry-img-src a").attr("data-title", function() { //Get title and put it inside data-title
					
					return this.title;
				});
			
					$(".jackbox").each(function(){
					 
						var uniqueID = 'mgm_cap_' + Math.floor( Math.random()*99999 ); //Generate Unique id name
						 
						var CaptionDivGallery = $(this).parent().next('.gallery-caption');
						var CaptionDivImage = $(this).siblings('.wp-caption-text'); //Set the correct relative caption divs or jackbox
						
						$(CaptionDivGallery).attr('id', uniqueID ); //Add the uniqueID to .gallery-caption (Galleries)
						$(CaptionDivImage).attr('id', uniqueID ); //Add the uniqueID to .wp-caption-text (Single Images)
				
						$(this).attr('data-description', '#' + uniqueID ); //Add the div name to data-description
				
					});
				
				$(".jackbox[data-group]").jackBox("init"); //initialize jackbox, thank you.
			});
			</script>
		<?php };
		
		
		/*
		==========================================================
		Home Tabs
		==========================================================
		*/
		
		$hometabs =  of_get_option('tabs_activate');
		$home_1 = is_page_template('home-widgetized-1.php');
		$home_2 = is_page_template('home-widgetized-2.php');
		$home_3 = is_page_template('home-widgetized-3.php');
		$home_4 = is_page_template('home-widgetized-4.php');
		$home_5 = is_page_template('home-widgetized-5.php');
		$home_6 = is_page_template('home-widgetized-6.php');
		$home_7 = is_page_template('home-widgetized-7.php');
		
		if ( ( $hometabs ) AND is_front_page() || is_home() || $home_1 || $home_2 || $home_3 || $home_4 || $home_5 || $home_6 || $home_7 ) { ?>
			<script>
			jQuery(document).ready(function($) {
				   $(".cat-tabs").tabs(".cat-panes-content", {
					effect: 'fade',
					tabs: 'span',
					rotate: true,
	
			   }).slideshow( {
					autoplay: <?php if ( of_get_option('tabs_autoplay') ) { echo 'true'; } else { echo 'false';} ?>,
					interval: <?php echo of_get_option('tabs_duration'); ?>,
					clickable: false,
				});
			});
			</script>
	
		<?php };


		/*
		==========================================================
		User Rating
		==========================================================
		*/
		
		$mgm_review_scale = get_post_meta(get_the_ID(), 'mgm_review_scale', true);
		$mgm_user_rating_switch = get_post_meta(get_the_ID(), 'mgm_user_rating_switch', true);
		
		if ( ($mgm_user_rating_switch) AND is_single() ) {
		?>
		
		<script>
		;
		(function ($) {
			function user_rating() {
				if ($('.rw-user-rating').length) {
				  // Get elements
				  this.el = this.build_el();
				  if (!this.is_rated()) {
					  
					  // Interface fixes
					  <?php if ($mgm_review_scale == 'percent') { ?>
					  this.el.stars.top.css('width', '1%');
					  this.el.stars.under.css('width', '100');
					  <?php } else { ?>
					  this.el.stars.top.css('background-position-y', '1px');
					  this.el.stars.under.css('width', '100px');
					  <?php } ?>
					  
					  // Bind Events
					  this.bind_events();
				  } else {
					  this.display_user_rating();
				  }
				}
			}
		
			user_rating.prototype.is_rated = function () {
				if (this.readCookie('mgm_rating_' + mgm_script.post_id) === 'rated') {
					return true;
				} else {
					return false;
				}
			};
		
			user_rating.prototype.display_user_rating = function () {
				var score = this.readCookie('mgm_rating_score_' + mgm_script.post_id),
					position = this.readCookie('mgm_rating_position_'+ mgm_script.post_id);
				this.el.rating.score.html(score);
				this.el.stars.top.css('width', position + '%');
				this.el.rating.label.your_rating.show();
				this.el.rating.label.user_rating.hide();
			};
		
			user_rating.prototype.build_el = function () {
				var el = {
					rating:{
						score:$('SPAN.score', '.rw-user-rating-desc'),
						count:$('SPAN.count', '.rw-user-rating-desc'),
						label:{
							your_rating:$('SPAN.your_rating', '.rw-user-rating-desc'),
							user_rating:$('SPAN.user_rating', '.rw-user-rating-desc')
						}
					},
					
					<?php if ($mgm_review_scale == 'percent') { ?>
					stars:{
						under:$('.rw-bar-wrap', '.rw-user-rating'),
						top:$('.rw-bar-progress', '.rw-user-rating')
					}
					<?php } else { ?>
					stars:{
						under:$('.criteria-stars-color', '.rw-user-rating'),
						top:$('.criteria-stars-overlay', '.rw-user-rating')
					}
					<?php } ?>
				};
		
				// Plain JS style retrieval
				el.stars.old_position = parseInt(el.stars.top[0].style.width, 10);
				el.rating.old_score = el.rating.score.html();
		
				return el;
			};
		
			user_rating.prototype.bind_events = function () {
				var me = this;
		
				// Hover effect
				me.el.stars.under.on('mouseover', function () {
					// changes the sprite
					<?php if ($mgm_review_scale == 'percent') { ?>
					me.el.stars.top.css('width', '0%');
					<?php } else { ?>
					me.el.stars.top.css('background-position-y', '-20px');
					<?php } ?>
					
					// Changes the cursor
					$(this).css('cursor', 'pointer');
		
					// changes the text
					me.el.rating.label.your_rating.show();
					me.el.rating.label.user_rating.hide();
		
				});
				me.el.stars.under.on('mouseout', function () {
					// Returns the sprite
					<?php if ($mgm_review_scale == 'percent') { ?>
					me.el.stars.top.css('width', '0%');
					<?php } else { ?>
					me.el.stars.top.css('background-position-y', '1px');
					<?php } ?>
		
					// Returns the initial position
					me.el.stars.top.css('width', me.el.stars.old_position + '%');
		
					// Returns the text and initial rating
					me.el.rating.label.user_rating.show();
					me.el.rating.label.your_rating.hide();
					me.el.rating.score.html(me.el.rating.old_score);
		
				});
				me.el.stars.under.on('mousemove', function (e) {
					if (!e.offsetX){
						e.offsetX = e.clientX - $(e.target).offset().left;
					}
					// Moves the width
					var offset = e.offsetX + 4;
					if (offset > 100) {
						offset = 100;
					}
					me.el.stars.top.css('width', offset + '%');
		
					
					// Update the real-time score
					
					<?php if ($mgm_review_scale == 'percent') { ?>
					
					var score = Math.floor(offset);
					if (score > 100) {
						score = 100;
					}
					me.el.rating.score.html(score + '<small>%</small>');
					<?php } else { ?>
	
					var score = Math.floor(((offset / 10) * 5)) / 10;
					if (score > 5) {
						score = 5;
					}
					me.el.rating.score.html(score);
					<?php } ?>
					
		
				});
		
				// Click effect
				me.el.stars.under.on('click', function (e) {
					if (!e.offsetX){
						e.offsetX = e.clientX - $(e.target).offset().left;
					}
					
					<?php if ($mgm_review_scale == 'percent') { // Display votes in a scale of 100 if % is selected ?>
					
					var count = parseInt(me.el.rating.count.html(), 10) + 1,
						score = (Math.floor(((e.offsetX + 4)) ) ),
						position = e.offsetX + 4;
					if (score > 100) {
						score = 100;
					}
					
					<?php } else { //Display votes in a scale of 5 if stars are selected ?>
					
					var count = parseInt(me.el.rating.count.html(), 10) + 1,
						score = (Math.floor(((e.offsetX + 4) / 10) * 5) / 10),
						position = e.offsetX + 4;
					if (score > 5) {
						score = 5;
					}
					
					<?php } ?>
					
					if (position > 100) {
						position = 100;
					}
					// Unbind events
					me.el.stars.under.off();
					me.el.stars.under.css('cursor', 'default');
		
					// Stars animation
					me.el.stars.top.fadeOut(function () {
						//me.el.stars.top.css('width', '0%');
						me.el.stars.top.fadeIn();
					});
		
					// Count increment
					me.el.rating.count.html(count + " <?php _e(' votes', 'powermag')?>" );
		
					// AJAX call to wordpress
					var req = {
						action:'mgm_rating',
						rating_position:position,
						rating_score:score,
						post_id:mgm_script.post_id
					};
		
					$.post(mgm_script.ajaxurl, req, function () {
						// Save cookie
						me.createCookie('mgm_rating_' + mgm_script.post_id, 'rated', 900);
						me.createCookie('mgm_rating_score_' + mgm_script.post_id, score, 900);
						me.createCookie('mgm_rating_position_' + mgm_script.post_id, position, 900);
					})
				});
			};
		
			user_rating.prototype.createCookie = function (name, value, days) {
				if (days) {
					var date = new Date();
					date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
					var expires = "; expires=" + date.toGMTString();
				}
				else var expires = "";
				document.cookie = name + "=" + value + expires + "; path=/";
			}
		
			user_rating.prototype.readCookie = function (name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for (var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') c = c.substring(1, c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
				}
				return null;
			}
		
			user_rating.prototype.eraseCookie = function (name) {
				createCookie(name, "", -1);
			}
		
			$(document).ready(function () {
				new user_rating();
			});
		})(jQuery);
		</script>

		<?php }
		
		
		/*
		==========================================================
		User Custom JS
		==========================================================
		*/

		if ( ( of_get_option('mgm_custom_js')) ) { ?>
			<script><?php echo of_get_option('mgm_custom_js'); ?></script>
		<?php }; 
	
		/*End*/
		
    }
	
}
add_action( 'wp_footer', 'mgm_footer_scripts' );

?>