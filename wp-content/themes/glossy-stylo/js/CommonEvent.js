var header_abstop = document.getElementById("header").getBoundingClientRect().top;
var sidebar_left = document.getElementById("sidebar").getBoundingClientRect().left;
var sidebar_top = document.getElementById("sidebar").getBoundingClientRect().top;

window.onscroll = function () {
	var header = document.getElementById("header");
	var sidebar = document.getElementById("sidebar");
	//var headertext = document.getElementById("header h1 a");
	var scrolltop = document.documentElement.scrollTop || document.body.scrollTop;
	
	if (scrolltop > sidebar_top){
		sidebar.style.position = "fixed";
		sidebar.style.left = sidebar_left+1+"px";
		sidebar.style.top = "0";
	}
	else{
		sidebar.style.position = "";
	}
};