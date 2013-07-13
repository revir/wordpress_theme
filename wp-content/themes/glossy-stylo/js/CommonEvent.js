var header_abstop = $("#header").getBoundingClientRect().top;
var sidebar_left = $("#sidebar").getBoundingClientRect().left;

window.onscroll = function () {
	var header = $("#header");
	var sidebar = $("#sidebar");
	var headertext = $("#header h1 a");
	var scrolltop = document.documentElement.scrollTop || document.body.scrollTop;
	
	if (sidebar.getBoundingClientRect().top < 0){
		sidebar.style.position = "fixed";
		sidebar.style.left = sidebar_left;
		sidebar.style.top = "0 px";
	}
	else{
		sidebar.style.position = "";
	}
};