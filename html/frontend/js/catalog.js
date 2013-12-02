//TOOLTIPS IN HEADER NAVIGATION
$(function ($) {
        $("a").tooltip()
    });

//POPOVERS FOR ITEMS
$(document).ready(function() {
	$('.popOver1').popover({
		html: true,
		title: 'Solar Panel 300W <a class="close" href="#");">&times;</a>',
		content: '<div class="msg"><img src="img/panels/300w.jpg" alt="Solar Panel 300W - 24VDC"></div>',
	});
	$('.popOver2').popover({
		html: true,
		title: 'Solar Panel 250W <a class="close" href="#");">&times;</a>',
		content: '<div class="msg"><img src="img/panels/250w-mono4.jpg" alt="Solar Panel 250W - 24VDC BLD"></div>',
	});
	$('.popOver3').popover({
		placement: 'left',
		html: true,
		title: 'Solar Panel 135W <a class="close" href="#");">&times;</a>',
		content: '<div class="msg"><img src="img/panels/125w4.jpg" alt="Solar Panel 135W"></div>',
	});
	$('.popOver4').popover({
		placement: 'left',
		html: true,
		title: 'Solar Panel 85W <a class="close" href="#");">&times;</a>',
		content: '<div class="msg"><img src="img/panels/85w4.jpg" alt="Solar Panel 85W"></div>',
	});
	$('[class*=popOver]').click(function (e) {
		e.stopPropagation();
	});
	$(document).click(function (e) {
		if (($('.popover').has(e.target).length == 0) || $(e.target).is('.close')) {
			$('.popOver1').popover('hide');
		}
	});
});

//SHOW RANGE VALUE IN FORM
function chgValue(elem)
	{
		var element = elem.id + "Score";
		document.getElementById(element).value = elem.value;
	}
