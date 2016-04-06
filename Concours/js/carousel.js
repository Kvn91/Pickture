$("#foo3").after('<ul id="fooX" />').next().html($("#foo3").html());
$("#foo3 li:odd").remove();
$("#fooX li:even").remove();
$("#foo3").carouFredSel({
	width : "100%",
	synchronise	: "#fooX",
	scroll		: 1,
	prev: '#prev',
	next: '#next',

	auto : {
		play : false
	},
	items: {
		visible: {
			min: 1,
			max: 5
		}
	}
});
$("#fooX").carouFredSel({
	width : "100%",
	auto		: false,
	items: {
		visible: {
			min: 1,
			max: 5
		}
	}
});