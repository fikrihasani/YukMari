// create the back to top button
$(document).ready(function(){
	var amountScrolled = 300;
	$(window).scroll(function() {
		if ( $(window).scrollTop() > amountScrolled ) {
			$('a.back-to-top').fadeIn('slow');
		} else {
			$('a.back-to-top').fadeOut('slow');
		}
		});

		$('a.back-to-top, a.simple-back-to-top').click(function() {
			$('html, body').animate({
				scrollTop: 0
			}, 1000);
			return false;
		});

	$("#login").click(function(){
		$("#LoginForm").load("../site/login");
	});
});
