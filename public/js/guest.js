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
        if($(".popular-btn").hasClass("is-selected")){
            $(".popular-question").removeClass("display-none");
            $(".recent-question").addClass("display-none");
        }
        if($(".recent-btn").hasClass("is-selected")){
            $(".popular-question").addClass("display-none");
            $(".recent-question").removeClass("display-none");
        }       
    });
});

$(function() {
    $(".nav-item-link").click(function() {
        $(".nav-item-link").removeClass("is-active");
        $(this).addClass("is-active");
    })
});

if($(".popular-btn").hasClass("is-selected")){
    $(".recent-question").addClass("display-none");
}
if($(".recent-btn").hasClass("is-selected")){
    $(".popular-question").addClass("display-none");
} 

function classToggle() {
    const navs = document.querySelectorAll('.sidebar-navigation')
    
    navs.forEach(nav => nav.classList.toggle('toggle-show'));
  }
  
  document.querySelector('.sidebar-toggle')
    .addEventListener('click', classToggle);
