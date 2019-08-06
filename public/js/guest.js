// window.onscroll = function() { scrollingFunction() };

// function scrollingFunction() {
//     var navbar = document.getElementById("attendee-navbar");
//     var fixtop = navbar.offsetTop;
//     if (window.pageYOffset > fixtop) {
//         navbar.classList.add("fixtop");
//     } else {
//         navbar.classList.remove("fixtop");
//     }
// }

$(function() { //run when the DOM is ready
    $(".content-nav-tabs-item").click(function() { //use a class, since your ID gets mangled
        $(".content-nav-tabs-item").removeClass("is-selected");
        $(this).addClass("is-selected"); //add the class to the clicked element  
        if ($(".popular-btn").hasClass("is-selected")) {
            $(".popular-question").removeClass("display-none");
            $(".recent-question").addClass("display-none");
        }
        if ($(".recent-btn").hasClass("is-selected")) {
            $(".popular-question").addClass("display-none");
            $(".recent-question").removeClass("display-none");
        }
    });
});

if ($(".popular-btn").hasClass("is-selected")) {
    $(".recent-question").addClass("display-none");
}
if ($(".recent-btn").hasClass("is-selected")) {
    $(".popular-question").addClass("display-none");
}

function classToggle() {
    const navs = document.querySelectorAll('.sidebar-navigation')

    navs.forEach(nav => nav.classList.toggle('toggle-show'));
}

document.querySelector('.sidebar-toggle')
    .addEventListener('click', classToggle);

$('#input-question').focus(function () {
    $(this).animate({ height: "220px" }, 500);
    $('#characters').css('display', 'initial');
});
$('#input-question').blur(function () {
    $(this).animate({height: '80px'}, 500);
    //Resize back to one row if the textarea is manually resized via the handle
    $('#characters').css('display', 'none');
});
$('#input-question').on('keyup keydown', updateCount);
function updateCount() {
    $('#characters').text(300-$(this).val().length);
}
$('poll-btn').removeClass('is-active');
$('.question-btn').addClass('is-active');

//Like question
$('.like-btn').on('click', function() {
    if($(this).hasClass("is-not-liked")){
        $.ajax({
            url: "/room/guest/like/" + $(this).val(),
        });
        $(this).removeClass("is-not-liked")
        $(this).addClass("is-liked");
        localStorage.setItem('isliked'+$(this).val(), true);
    }else{
        $.ajax({
            url: "/room/guest/unlike/" + $(this).val(),
        });
        $(this).addClass("is-not-liked");
        $(this).removeClass("is-liked");
        localStorage.setItem('isliked'+$(this).val(), false);
    }
});
loadLike = function(){
    var likedButton = $('.like-btn');
    var likedButtonId = [];
    for(var i=0; i<likedButton.length; i++){
        if(localStorage.getItem('isliked'+likedButton[i].getAttribute('value'))=="true")
        {
            $(likedButton[i]).addClass("is-liked");
            $(likedButton[i]).removeClass("is-not-liked");
        };
    }
}
$(document).ready(function() {
    loadLike();
});

