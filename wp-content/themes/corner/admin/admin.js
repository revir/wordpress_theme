jQuery.noConflict();
jQuery(document).ready(function($){
	$('form#corner h3').remove();
	
	$('table.form-table').eq(0).attr('id','corner_header');
	$('table.form-table').eq(1).attr('id','corner_reading');
	$('table.form-table').eq(2).attr('id','corner_comment');
	$('table.form-table').eq(3).attr('id','corner_footer');
	
	/* Tab control */
	var cookie = $.cookie('corner_tabs');
	if (cookie == null){
		$('#corner_switch a:first').addClass('current');
		$('form#corner table:not(:first)').hide();
	} else {
		$('#corner_switch a#' + cookie).addClass('current');
		$('form#corner table').hide();
		$('form#corner table#' + cookie).show();
	}
	$("#corner_switch a").click(function(){
		var tab = $(this).attr('id');
		$.cookie('corner_tabs',tab,{expires: 1});
		$('#corner_switch a').removeClass('current');
		$(this).addClass('current');
		$('form#corner table').hide();
		$('form#corner table#' + tab).fadeIn();
	});
	
	function hideChild(object, child){
		var value = object.attr('checked');
		object.parent().addClass('object');
		
		if (value == true)
			child.slideDown();
		else
			child.slideUp();
		
		$(object).click(function(){
			var value = object.attr('checked');
			if (value == true)
				child.slideDown();
			else
				child.slideUp();
		});
	}
	
	hideChild($('input#use_banner'), $('input#random_banner').parent());
});

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') {
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString();
        }
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};