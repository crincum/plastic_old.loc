$(document).ready(function(){
	var pic = new Array();
	pic['item23'] = new Image();
	pic['item23'].src = "/wp-content/themes/clear/img/menu/menu-main.png";
	pic['item22'] = new Image();
	pic['item22'].src = "/wp-content/themes/clear/img/menu/menu-2.png";
	pic['item20'] = new Image();
	pic['item20'].src = "/wp-content/themes/clear/img/menu/menu-3.png";
	pic['item21'] = new Image();
	pic['item21'].src = "/wp-content/themes/clear/img/menu/menu-4.png";
	pic['item19'] = new Image();
	pic['item19'].src = "/wp-content/themes/clear/img/menu/menu-5.png";
	pic['item18'] = new Image();
	pic['item18'].src = "/wp-content/themes/clear/img/menu/menu-6.png";
    $('.menu-item').hover(
		function(){
			var child = $(this).children('a').first();
			$("#header").css("background-image",'url("' pic[$(child).attr("rel")].src '")');
		},
		function(){
			if($("#menu > .current_page_item").val() == undefined){
				$("#header").css("background-image",'url("/wp-content/themes/clear/img/menu/menu.png")');
			}
		}
	);
	if($("#menu > .current_page_item").val() != undefined){
		$("#header").css("background-image",'url("' pic[$("#menu > .current_page_item > a").attr('rel')].src '")');
	}
	$('.post').hover(function(){
		$("#header").css("background-image",'url("' pic[$("#menu > .current_page_item > a").attr('rel')].src '")');
	});
});