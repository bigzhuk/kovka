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

	var left_menu = $('#left_menu');
	var catalog = $('#catalog');
	if (typeof(left_menu[0]) === 'undefined' || typeof(catalog[0]) === 'undefined') {
		return;
	}

	var catalog_position = catalog.position();
    var top_border = catalog_position.top;
    var bottom_border = catalog_position.top + catalog.outerHeight() - left_menu.outerHeight() - 45;

    if (scrollTop > top_border && scrollTop <= bottom_border) {
    	console.log('add');
        left_menu.addClass('attached_left_menu');
	} else {
        console.log('remove');
        left_menu.removeClass('attached_left_menu');
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

function searchSubmit() {
    $('#search-form').submit();
}
