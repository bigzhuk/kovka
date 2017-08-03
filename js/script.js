$(document).ready(function() {
	setInterval(dindin, 15000);

	scrollPage();
	$(window).on('scroll', scrollPage);
	subMenu();
    recall_radio_checker();

	/* категории под картинками !!! $('.prod_box').on('mouseover', function () {
		$(this).find('.subcategories_list').show();
    });
    $('.prod_box').on('mouseout', function () {
        $(this).find('.subcategories_list').hide();
    });*/

	/* левое меню аккордеон */
    var checkCookie = $.cookie("sub-nav");
    if (checkCookie != "") {
        $('#menu > li.sub > a:eq('+checkCookie+')').addClass('active').next().show();
    }
    $('#menu > li.sub > a').click(function(){
        event.preventDefault();
        var navIndex = $('#menu > li.sub > a').index(this);
        $.cookie("sub-nav", navIndex);
        $('#menu li ul').slideUp();
        if ($(this).next().is(":visible")){
            $(this).next().slideUp();
        } else {
            $(this).next().slideToggle();
        }
        $('#menu li a').removeClass('active');
        $(this).addClass('active');
    });
    var checkCookie = $.cookie("sub-link");
    if (checkCookie != "") {
        $('#menu > li.sub > ul li a:eq('+checkCookie+')').addClass('active');
    }
    $('.sub ul li a').click(function(){
        var subIndex = $('.sub ul li a').index(this);
        $.cookie("sub-link", subIndex);
        $('.sub ul li a').removeClass('active');
        $(this).addClass('active');
    });

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
        left_menu.addClass('attached_left_menu');
	} else {
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

function recall_radio_checker() {
    var bt_radio_trigger = $('.bt-radio-trigger');
    bt_radio_trigger.on('mouseover', function() {
        $(this).parent().css({'background': 'white'});
    });
    bt_radio_trigger.on('mouseout', function() {
        $(this).parent().css({'background': '#a4a4a4'});
    });
    bt_radio_trigger.on('click', function() {
        $(this).parent().parent().find('a').removeClass('checked');
        $(this).addClass('checked');
        $(this).prev().attr('checked', 'checked');
    });
}
