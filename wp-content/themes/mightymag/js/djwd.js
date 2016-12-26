/*
==========================================================
SUPERFISH
==========================================================
*/

/*
 * jQuery Superfish Menu Plugin - v1.7.4
 * Copyright (c) 2013 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *	http://www.opensource.org/licenses/mit-license.php
 *	http://www.gnu.org/licenses/gpl.html
 */

;(function(e){"use strict";var s=function(){var s={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",menuArrowClass:"sf-arrows"},o=function(){var s=/iPhone|iPad|iPod/i.test(navigator.userAgent);return s&&e(window).load(function(){e("body").children().on("click",e.noop)}),s}(),n=function(){var e=document.documentElement.style;return"behavior"in e&&"fill"in e&&/iemobile/i.test(navigator.userAgent)}(),t=function(e,o){var n=s.menuClass;o.cssArrows&&(n+=" "+s.menuArrowClass),e.toggleClass(n)},i=function(o,n){return o.find("li."+n.pathClass).slice(0,n.pathLevels).addClass(n.hoverClass+" "+s.bcClass).filter(function(){return e(this).children(n.popUpSelector).hide().show().length}).removeClass(n.pathClass)},r=function(e){e.children("a").toggleClass(s.anchorClass)},a=function(e){var s=e.css("ms-touch-action");s="pan-y"===s?"auto":"pan-y",e.css("ms-touch-action",s)},l=function(s,t){var i="li:has("+t.popUpSelector+")";e.fn.hoverIntent&&!t.disableHI?s.hoverIntent(u,p,i):s.on("mouseenter.superfish",i,u).on("mouseleave.superfish",i,p);var r="MSPointerDown.superfish";o||(r+=" touchend.superfish"),n&&(r+=" mousedown.superfish"),s.on("focusin.superfish","li",u).on("focusout.superfish","li",p).on(r,"a",t,h)},h=function(s){var o=e(this),n=o.siblings(s.data.popUpSelector);n.length>0&&n.is(":hidden")&&(o.one("click.superfish",!1),"MSPointerDown"===s.type?o.trigger("focus"):e.proxy(u,o.parent("li"))())},u=function(){var s=e(this),o=d(s);clearTimeout(o.sfTimer),s.siblings().superfish("hide").end().superfish("show")},p=function(){var s=e(this),n=d(s);o?e.proxy(f,s,n)():(clearTimeout(n.sfTimer),n.sfTimer=setTimeout(e.proxy(f,s,n),n.delay))},f=function(s){s.retainPath=e.inArray(this[0],s.$path)>-1,this.superfish("hide"),this.parents("."+s.hoverClass).length||(s.onIdle.call(c(this)),s.$path.length&&e.proxy(u,s.$path)())},c=function(e){return e.closest("."+s.menuClass)},d=function(e){return c(e).data("sf-options")};return{hide:function(s){if(this.length){var o=this,n=d(o);if(!n)return this;var t=n.retainPath===!0?n.$path:"",i=o.find("li."+n.hoverClass).add(this).not(t).removeClass(n.hoverClass).children(n.popUpSelector),r=n.speedOut;s&&(i.show(),r=0),n.retainPath=!1,n.onBeforeHide.call(i),i.stop(!0,!0).animate(n.animationOut,r,function(){var s=e(this);n.onHide.call(s)})}return this},show:function(){var e=d(this);if(!e)return this;var s=this.addClass(e.hoverClass),o=s.children(e.popUpSelector);return e.onBeforeShow.call(o),o.stop(!0,!0).animate(e.animation,e.speed,function(){e.onShow.call(o)}),this},destroy:function(){return this.each(function(){var o,n=e(this),i=n.data("sf-options");return i?(o=n.find(i.popUpSelector).parent("li"),clearTimeout(i.sfTimer),t(n,i),r(o),a(n),n.off(".superfish").off(".hoverIntent"),o.children(i.popUpSelector).attr("style",function(e,s){return s.replace(/display[^;]+;?/g,"")}),i.$path.removeClass(i.hoverClass+" "+s.bcClass).addClass(i.pathClass),n.find("."+i.hoverClass).removeClass(i.hoverClass),i.onDestroy.call(n),n.removeData("sf-options"),void 0):!1})},init:function(o){return this.each(function(){var n=e(this);if(n.data("sf-options"))return!1;var h=e.extend({},e.fn.superfish.defaults,o),u=n.find(h.popUpSelector).parent("li");h.$path=i(n,h),n.data("sf-options",h),t(n,h),r(u),a(n),l(n,h),u.not("."+s.bcClass).superfish("hide",!0),h.onInit.call(this)})}}}();e.fn.superfish=function(o){return s[o]?s[o].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof o&&o?e.error("Method "+o+" does not exist on jQuery.fn.superfish"):s.init.apply(this,arguments)},e.fn.superfish.defaults={popUpSelector:"ul,.sf-mega",hoverClass:"sfHover",pathClass:"overrideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},animationOut:{opacity:"hide"},speed:"normal",speedOut:"fast",cssArrows:!0,disableHI:!1,onInit:e.noop,onBeforeShow:e.noop,onShow:e.noop,onBeforeHide:e.noop,onHide:e.noop,onIdle:e.noop,onDestroy:e.noop},e.fn.extend({hideSuperfishUl:s.hide,showSuperfishUl:s.show})})(jQuery);


/* My Scripts */
jQuery.noConflict();

/* jQuery Cookie */
 
(function(e){if(typeof define==="function"&&define.amd){define(["jquery"],e)}else{e(jQuery)}})(function(e){function n(e){return u.raw?e:encodeURIComponent(e)}function r(e){return u.raw?e:decodeURIComponent(e)}function i(e){return n(u.json?JSON.stringify(e):String(e))}function s(e){if(e.indexOf('"')===0){e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\")}try{e=decodeURIComponent(e.replace(t," "));return u.json?JSON.parse(e):e}catch(n){}}function o(t,n){var r=u.raw?t:s(t);return e.isFunction(n)?n(r):r}var t=/\+/g;var u=e.cookie=function(t,s,a){if(s!==undefined&&!e.isFunction(s)){a=e.extend({},u.defaults,a);if(typeof a.expires==="number"){var f=a.expires,l=a.expires=new Date;l.setTime(+l+f*864e5)}return document.cookie=[n(t),"=",i(s),a.expires?"; expires="+a.expires.toUTCString():"",a.path?"; path="+a.path:"",a.domain?"; domain="+a.domain:"",a.secure?"; secure":""].join("")}var c=t?undefined:{};var h=document.cookie?document.cookie.split("; "):[];for(var p=0,d=h.length;p<d;p++){var v=h[p].split("=");var m=r(v.shift());var g=v.join("=");if(t&&t===m){c=o(g,s);break}if(!t&&(g=o(g))!==undefined){c[m]=g}}return c};u.defaults={};e.removeCookie=function(t,n){if(e.cookie(t)===undefined){return false}e.cookie(t,"",e.extend({},n,{expires:-1}));return!e.cookie(t)}})


/*
==========================================================
MENU ITEMS COLORS
==========================================================
*/

jQuery(document).ready(function ($) {
	
    $(".menu-main-container li").each(function(){
        
		$(this).addClass("custom-color");
        
		if ($(this).hasClass("custom-color")) {
            
			var catColor = $(this).find('small').text();
            
			if ( catColor ) {

				$(this).find(".bottom-line.custom-color").css('background', catColor)

            }
        }
    });


/*
==========================================================
TRIGGERS
==========================================================
*/
	
	
	/**
	 * SuperFish Fire
	 */
	
	$('ul.menu').superfish({
	delay: 400,
	animation: {opacity:'show'}, // animation
	speed: 400, // animation speed
	speedOut: 200,  
	autoArrows: true // disable generation of arrow mark-up
	});

	/**
	 * FitVids
	 */
	
    $(".container").fitVids();
	

	/**
	 * Tooltips
	 */
	
	$('#collapse-icons a').tooltip({
		placement: 'left',
	});
	
	$('.mgm-bbp').tooltip({
		placement: 'top',
		container: 'body',
	});
	
	$('.single_add_to_cart_button').tooltip({
		placement: 'top',
	});
	
	$('.mgm-round-add-to-cart').tooltip({
		placement: 'right',
		title: 'Add to cart',
	});

	
	/**
	 * Modals
	 */
	 
	$('#mgm-notifications-modal').appendTo("body").modal({
  		keyboard: true,
		show: false,
	});
	
	
	 /**
	 * Back to Top
	 */
	
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn(300);
		} else {
			$('.scrollup').fadeOut(300);
		}
		}); 
	
		$('.scrollup').click(function(){
			$("html, body").animate({ scrollTop: 0 }, 400);
			return false;
	});


/*
==========================================================
EXTRAS
==========================================================
*/

	/**
	 * Header Buttons
	 */
	
	//Add/remove .active class
	
	$('#mgm-collapse-newsletter').on('shown.bs.collapse', function () {
   		$(".ico-newsletter").addClass("active");
	});
	$('#mgm-collapse-newsletter').on('hidden.bs.collapse', function () {
   		$(".ico-newsletter").removeClass("active");
	});
	
	$('#mgm-collapse-login').on('shown.bs.collapse', function () {
   		$(".ico-login").addClass("active");
	});
	$('#mgm-collapse-login').on('hidden.bs.collapse', function () {
   		$(".ico-login").removeClass("active");
	});
	
	$('#mgm-collapse-custom').on('shown.bs.collapse', function () {
   		$(".ico-custom").addClass("active");
	});
	$('#mgm-collapse-custom').on('hidden.bs.collapse', function () {
   		$(".ico-custom").removeClass("active");
	});
	
		// From sub-accordion Login/Register
		
		$('#collapseLogin').on('shown.bs.collapse', function () {
			$(".mgm-trigger-login").addClass("active");
		});
		
		$('#collapseLogin').on('hidden.bs.collapse', function () {
			$(".mgm-trigger-login").removeClass("active");
		});
		
		$('#collapseRegister').on('shown.bs.collapse', function () {
			$(".mgm-trigger-register").addClass("active");
		});
		
		$('#collapseRegister').on('hidden.bs.collapse', function () {
			$(".mgm-trigger-register").removeClass("active");
		});
		
	// Save last state using jquery.cookie
	
	var c = document.cookie;
	
	$('#mgm-collapse-login.collapse').each(function () {
		if (this.id) {
			var pos = c.indexOf(this.id + "_collapse_in=");
			if (pos > -1) {
				c.substr(pos).split('=')[1].indexOf('false') ? $(this).addClass('in') : $(this).removeClass('in');
				c.substr(pos).split('=')[1].indexOf('false') ? $('.ico-login').addClass('active') : $('.ico-login').removeClass('active');
			}
		}
		
	}).on('hidden.bs.collapse shown.bs.collapse', function () {
		if (this.id) {
			document.cookie = this.id + "_collapse_in=" + $(this).hasClass('in');
			document.cookie = '.ico-login'.id + "_collapse_in=" + $('.ico-login').hasClass('active');
		}
	});
	
	
	/**
	 * News Ticker
	 */

	$("#ticker-wrap .mgm-spinner").fadeOut(400);
	$("#ticker-wrap ul").delay(400).fadeIn(400);
	
 	var $listItems = $("#ticker-items").children('li'),
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

    $('.ticker-controls.next').on('click', function () {
        stopAutoSlide(); 
        showSlide(getNextElement('prev'));
    });

    $('.ticker-controls.prev').on('click', function () {
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
	
	
	/**
	 * Hide Widgets Post Date when the Sidebar gets thin to preserve layout
	 */

	var sidebarWidth = $('.custom-widget');
	var date = $('.custom-widget .post-attribute');
	var width = sidebarWidth.width();
	
	if (width < 370)
    date.addClass('hidden');


	/**
	 * DOM manipulations
	 */
	 
	// Animate content in
	$('.content-sidebar-wrap').addClass('animated fadeInUp').css('visibility','visible').show();
	
	// WP and BuddyPress
	
	$('input#submit, #members_search_submit, #groups_search_submit, #messages_search_submit').addClass('btn btn-success').not('#qt_bbp_topic_content_toolbar input');
	$('#comments .form-submit,#review_form .form-submit').addClass('reply-wrap').append('<div class=white-line></div>');
	$('#members_search, #groups_search, #messages_search, #notifications-sort-order-list, #members-friends').addClass('form-control');
	$('.mgm-bp-notices li a').addClass('btn btn-success btn-full');
	$('.item-title').addClass('mgm-font');
	
	
	// Contact Form 7
	$('.wpcf7-form-control').not('input[type="submit"].wpcf7-form-control').addClass('form-control');
	$('input[type="submit"].wpcf7-form-control').addClass('btn btn-success');
	
	// Voting Plugin since @MGM 1.5
	
	$('#feedback_message, .bwl_pvm_feedback_form .sum, .bwl_pvm_feedback_form .captcha').addClass('form-control');
		
	/**
	 * Add and Clone BuddyPress Notifications Icon
	 */
	 
	$(".mgm-bp-badge").appendTo("#collapse-icons .glyphicon-user").clone().appendTo(".lwa-avatar");
	 
	
	/**
	 * Plus and Minus 
	 */
	
	$('.woocommerce input.minus').attr("id", "minus").val("").wrap('<div class="form-group"><div class="icon-addon addon-sm"></div></div>').after('<label for="minus" class="glyphicon glyphicon-chevron-down label-minus"></label>');
	
	$('.woocommerce input.plus').attr("id", "plus").val("").wrap('<div class="form-group"><div class="icon-addon addon-sm"></div></div>').after('<label for="plus" class="glyphicon glyphicon-chevron-up label-plus"></label>');

	
	/**
	 * Remove empty stuff
	 */
	 
	$('li, p').each(function() {
		var $this = $(this);
		if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
			$this.remove();
	});
	
	$('.page-nav:empty, .bbp-pagination:empty').hide();
	
	/**
	 * Social Count Plus plugin integration
	 */
	 
	
	$(".social-count-plus .count, .social-count-plus .label").removeAttr("style")
	$('.social-count-plus ul li:nth-child(3n)').css('margin-right', 0);
	 
	 var $this = ('.widget_socialcountplus .mgm-title')
	 
	 if ( $.trim( $($this).text() ) == "")
    	$($this).remove();
 

});