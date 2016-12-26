// WooCommerce-MightyMag JS file

jQuery(document).ready(function ($) {
	
	/* Classes */
	
	$('.woocommerce .button.alt').removeClass('button alt').addClass('btn btn-danger');
	$('.woocommerce .button').not('button.alt').removeClass('button').addClass('btn btn-success');
	$('.woocommerce #content select, textarea#comment').addClass('form-control');
	$('.woocommerce-checkout input, .woocommerce-checkout textarea').not('.woocommerce-checkout input.input-checkbox, .woocommerce-checkout input[type="checkbox"]').addClass('form-control');
	$('.woocommerce #content h2').addClass('mgm-title').wrapInner('<span></span>');
	$('.woocommerce td.label').removeClass('label').addClass('woo-label');
	$('.woocommerce .order_details').not('.order_details.shop_table').addClass('superboxed');
	$('.woocommerce .order_details h3').addClass('cat-color');
	$('.woocommerce h2').not('.woocommerce h2.mgm-title, .woocommerce h2.cat-color').hide();
	$('.woocommerce-noreviews').addClass('alert alert-info');
	
	/* Markup */
	
	$('.woocommerce.single-product .mgm-onsale').prependTo('div.images .relative-wrap');
	
	$('.woocommerce .products li.product').each(function(){
    	$(this).children("h3, .price, .btn").wrapAll('<div class="boxed tc mgm-prod-desc">');
		$(this).children("h3").addClass('tr');
	});
	
	$('.woocommerce-review-link').after('<div class="clear"></div>');

	
	/* Rounded add to cart */
	
	$('.woocommerce .add_to_cart_button').each(function(){
    	$(this).removeClass('btn btn-success')
		.addClass('mgm-round-add-to-cart cat-bg')
		.html('<span class="glyphicon glyphicon-shopping-cart"></span>')
		.wrapAll("<div class='reply-wrap fixed-height clearfix'>");
	});
	
	
	/* Price Tools */
	
	$( ".mgm-product-single-wrap .price, .mgm-product-single-wrap .cart, .mgm-product-single-wrap .woocommerce-product-rating" ).wrapAll('<div class="mgm-price-tools"></div>');
	
	/* Price animation */
	
	//$('#shop-banner-wrap .price').addClass('animated pulse');
	
	/* Products Banner */
	
	$("#shop-banner-wrap .mgm-spinner").fadeOut(400);
	$("#shop-banner-wrap ul").delay(400).fadeIn(400);
	
	var $listItems = $("#shop-banner-items").children('li'),
		fadeDuration = 600,
		interval;
		$listItems.not(':first').hide();
	
	function showSlide(elm) {
		$listItems.filter(':visible').fadeOut(fadeDuration, function () {
			elm.fadeIn(fadeDuration);
		});
	}
	
	function autoSlide() {
		interval = setInterval(function () {
			showSlide( getNextElement('next'));
		}, 4000);
	}
	
	$('.shop-banner-controls.next').on('click', function () {
		stopAutoSlide(); 
		showSlide(getNextElement('prev'));
	});
	
	$('.shop-banner-controls.prev').on('click', function () {
		stopAutoSlide();
		showSlide(getNextElement('next'));
	});
	
	function getNextElement(direction) {
		var $next = $listItems.filter(':visible')[direction](), 
			fallBack = (direction === 'prev' ? 'last' : 'first');
		return !$next.length ? $listItems[fallBack]() : $next;
	
	}
	
	function stopAutoSlide() {
		$listItems.stop(true, true, true);
		clearInterval(interval);
	}
	
	autoSlide();

});