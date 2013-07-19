function getDefaultStyle(obj,attribute){ 
    return obj.currentStyle?obj.currentStyle[attribute]:document.defaultView.getComputedStyle(obj,false)[attribute];   
}

function getElementTop(element){
    var actualTop = element.offsetTop;
    var current = element.offsetParent;
    while(current !== null){
        actualTop += current.offsetTop;
        current = current.offsetParent;
    }
    return actualTop;
}

var sidebar_top = getElementTop(document.getElementById("sidebar"));
var sidebar_left = document.getElementById("sidebar").getBoundingClientRect().left;
var sidebar_margin_left = parseInt(getDefaultStyle(document.getElementById("sidebar"), "margin-left"));

window.onscroll = function () {
	var header = document.getElementById("header");
	var sidebar = document.getElementById("sidebar");
	//var headertext = document.getElementById("header h1 a");
	var scrolltop = document.documentElement.scrollTop || document.body.scrollTop;
	
	if (scrolltop > sidebar_top){
		sidebar.style.position = "fixed";
		sidebar.style.left = (sidebar_left - sidebar_margin_left) + "px";
		sidebar.style.top = "0";
	}
	else{
		sidebar.style.position = "";
	}
};
