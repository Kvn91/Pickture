$("#foo3").after('<ul id="fooX" />').next().html($("#foo3").html());
					$("#foo3 li:odd").remove();
					$("#fooX li:even").remove();
					$("#foo3").carouFredSel({
						synchronise	: "#fooX",
						scroll		: 2,

						prev: '#prev',
						next: '#next',
						auto : {
							play : false
						},

					});
					$("#fooX").carouFredSel({
						auto		: false
					});