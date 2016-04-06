$(function() {
	$('#carousel').carouFredSel({
		width : 100,
		auto  : {
			play : true
		},
		items: {
			width: 150,
			visible: 5
		},
		scroll : {
			items : 1
		},
		prev: '#prev',
		next: '#next'
	});
});
