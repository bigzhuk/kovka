$(document).ready(function() {
	setInterval(dindin, 15000);

	scrollPage();
	$(window).on('scroll', scrollPage);
	subMenu();
});

function scrollPage(){
	var scrollTop = $(window).scrollTop();
	if (scrollTop > $('#header_top').outerHeight()){
		$('#header_bottom').addClass('attached');
	} else {
		$('#header_bottom').removeClass('attached');
	}
}

function dindin() {
	$('#phone_img').rotate({
		angle: 0,
		animateTo: 60,
		duration: 500,
		callback: function () {
			$('#phone_img').rotate({
				angle: 60,
				animateTo: 0,
				duration: 500
			});
			setTimeout(function () {
				$("#phone_img").stopRotate();
			}, 500);
		}
	});
}

function subMenu() {
	$('.main_menu_link').parent().on('mouseover', function() {
		$(this).children('.sub_menu_link').css("display","block");
	});
	$('.main_menu_link').parent().on('mouseout', function() {
		$(this).children('.sub_menu_link').css("display","none");
	});
}
