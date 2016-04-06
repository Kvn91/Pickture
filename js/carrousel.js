$(function() {
	$('#carousel').carouFredSel({
		width : $(window).width + 100,
		auto  : {
			play : true
		},
		items: {
			width: 150
		},
		scroll : {
			items : 1
		},
		prev: '#prev',
		next: '#next'
	});

	$('.caroufredsel_wrapper').css('position', 'static');
});
