/* BBpress DOM modifications */

jQuery(document).ready(function ($) {

	//Replace
	$('.bbp-topic-tags p:contains(",")').html(function(i, h) {
  		return h.replace(/,/g, '');
	});
	
	$('.widget_display_topics:contains("by")').each(function(){
    	$(this).html($(this).html().split("by").join(""));
	});
	
	$('.widget_display_replies:contains("on")').each(function(){
    	$(this).html($(this).html().split("on").join(""));
	});
	
	//Buttons
	$('#bbpress-forums .button').not('.wp-editor-container input[type="button"]').removeClass('button').addClass('btn btn-success');
	$('.wp-editor-container input[type="button"]').removeClass('button button-small').addClass('btn btn-xs btn-default');
	$('#bbp_topic_submit,#bbp_reply_submit').removeClass('button').addClass('btn btn-success pull-right btn-full');
	$('.subscription-toggle').addClass('btn btn-xs btn-success pull-right');
	$('.favorite-toggle').addClass('btn btn-xs btn-success pull-right');
	
	//Topics
	$('.single-forum #subscription-toggle').wrap('<div class="reply-wrap mgm-subscription-button">');
	$('.single-topic .bbp-topic-tags').addClass('reply-wrap');
	$('.single-topic .bbp-topic-tags a').addClass('btn btn-success btn-xs');

	//Notices 
	$('.bbp-template-notice').removeClass('bbp-template-notice').find('p').addClass('alert alert-info');
	$('.bbp-form .error p').addClass('alert alert-danger');
	
	//Forms
	$('#bbpress-forums input[type="text"],.bbpress select').not('.bbpress input[type="checkbox"]').addClass('form-control');
	$('.bbp-form legend').addClass('cat-color');
	$('#bbp_search, .bbp-the-content.wp-editor-area').addClass('form-control');
	$('#bbp_search_submit').addClass('btn btn-success');
	
	//Pagination
	$('.bbp-pagination-count').addClass('reply-wrap');
	$('.bbp-pagination').addClass('clearfix');
	
	//Icons
	$('.widget_display_views li, .widget_display_topics li, .widget_display_replies li, .widget_display_forums li').prepend('<span class="glyphicon glyphicon-comment cat-color"></span>');
	
	//wp-ctent bug @since MGM 1.6
	$(".bbp-author-avatar img").each(function(){
 	 var newSrc = $(this).attr('src').replace('wp-ctent', 'wp-content');
 	 $(this).attr('src', newSrc);
	});

});
