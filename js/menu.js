function getScrollableRoot() {
    var body = document.body;
    var prev = body.scrollTop;
    body.scrollTop++;
    if (body.scrollTop === prev) {
        return document.documentElement;
    } else {
        body.scrollTop--;
        return body;
    }
}

$(document).ready(function(){

	$('.arriba').click(function(){
		$(getScrollableRoot()).animate({ scrollTop: 0 }, "slow");
	});

	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.arriba').slideDown(300);
		} else{
			$('.arriba').slideUp(300);
		}
	})
});


$(document).ready(function(){
	$(window).scroll(function(){
		$('.chatbot').slideDown(300);
	})
});