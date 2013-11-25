/* Easing */
jQuery.easing.quart = function (x, t, b, c, d) {
	return -c * ((t=t/d-1)*t*t*t - 1) + b;
};
/* Fade & Slide */
jQuery.fn.slideFadeToggle = function(speed, easing, callback) {
	return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);  
};
/* Mouse commands */
jQuery(document).ready(function($){
	/* Search */
	$('#search_button').click(function(){
		$(this).animate({top:-100,opacity:0},400,"quart");
		$('#search').show().animate({top:0,opacity:1},400,"quart");
		$('#search input#s1').focus();
	});
	$('#search .cancel').click(function(){
		$('#search_button').animate({top:0,opacity:1},400,"quart");
		$('#search').animate({top:-100,opacity:0},400,"quart");
		$('#search input#s1').attr("value",'');
	});
	/* Menus */
	$('#subscribe, .menu li, #archive_meta .detail').hover(function(){
		$(this).addClass('current');
		$(this).find('ul:eq(0)').slideFadeToggle(400,'quart');
	},function(){
		$(this).find('ul:eq(0)').slideFadeToggle(400,'quart');
		$(this).removeClass('current');
	});
	$('.menu li ul li ul li').parent().prev().addClass('nested');
	$('.menu li ul li ul li').parent().parent().addClass('nested');
	$('li.nested ul').hover(function(){
		$(this).prev().addClass('nested_hover');
	},function(){
		$(this).prev().removeClass('nested_hover');
	});
	/* Width of Menu & Widget */	
	var docuWidth = $(window).width();
	function reset_side_width(){
		var contentWidth = $('#content').width();
		$('#header .title, #sidebar').width(contentWidth - 720);
	}
	if( docuWidth < 1140 ){
		reset_side_width();
	}
	$(window).resize(function(){
		reset_side_width();
	});
});

function home_page_ajax(){
	jQuery('.wp-pagenavi a').click(function(){
		var id = jQuery(this).attr('href').replace(/(.*)paged=|&(.*)/g,'');
		jQuery.ajax({
			url: '?paged=' + id,
			data: 'action=ajax_home',
			type: 'GET',
			beforeSend: function(){
				document.body.style.cursor = 'wait';
				jQuery('.wp-pagenavi').html('<span class="loading">' + al_loading + '</span>');
			},
			error: function(request){
				alert(al_error);
			},
			success: function(data){
				jQuery('#main_col').html(data);
				jQuery('html,body').animate({scrollTop:jQuery('#content').offset().top - 20}, 800, "quart");
				document.body.style.cursor = 'auto';
				home_page_ajax();
			}
		});
		return false;
	});
}