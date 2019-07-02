window.onscroll = function() {scrollingFunction()};



function scrollingFunction() {
    var navbar = document.getElementById("attendee-navbar");
    var fixtop = navbar.offsetTop;
    if (window.pageYOffset > fixtop) {
        navbar.classList.add("fixtop");
    }else {
        navbar.classList.remove("fixtop");
    }
}

$(function() {                       //run when the DOM is ready
    $(".content-nav-tabs-item").click(function() {  //use a class, since your ID gets mangled
        $(".content-nav-tabs-item").removeClass("is-selected");
        $(this).addClass("is-selected");      //add the class to the clicked element
    });
});

$(function() {
    $(".nav-item-link").click(function() {
        $(".nav-item-link").removeClass("is-active");
        $(this).addClass("is-active");
    })
});
