$(window).scroll(function() {
    if ($(window).scrollTop() > 200) {
        $('.navbar').removeClass('bg-transparent');
	    $('.navbar').addClass('bg-transparent-dark');
	    $('.bg-transparent-dark').css('background-color','#1d2124bf');
    }
    if($(window).scrollTop() == 0){
        $('.navbar').addClass('bg-transparent');
    }
});
  