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
            getQuestion();
        }
        if ($(".recent-btn").hasClass("is-selected")) {
            getPopularQuestion();
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
    $(this).animate({ height: "150px" }, 500);
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
likeQuestion = function(){
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
}
loadLike = function(){
    var likedButton = $('.like-btn');
    for(var i=0; i<likedButton.length; i++){
        if(localStorage.getItem('isliked'+likedButton[i].getAttribute('value'))=="true")
        {
            $(likedButton[i]).addClass("is-liked");
            $(likedButton[i]).removeClass("is-not-liked");
        };
    }
}

//get replies
getReplies = function(){
    $('.reply-btn').on('click', function(){
        $('.modal-reply').html('');
        $('#questionIdInput').attr('value',$(this).attr('data-id'));
        $('.question-reply-title').html($(this).attr('data-name'));
        $.ajax({
            url: 'room/showreply/'+$(this).attr('data-id'),
            success: function(data) {

                for (var i=0; i<data.length; i++){
                    var date = moment.parseZone(data[i].date).format("YYYY-MM-DD HH:mm:ss");
                    if(data[i].host!=null){
                        $('.modal-reply').append(
                            '<div class="reply-item">'+
                                '<div class="user" style="color: #20b875"><i class="fa fa-user"></i> '+data[i].name+' - Host</div>'+
                                '<div class="reply-date">'+date+'</div>'+
                                '<div>'+data[i].content+'</div>'+
                            '</div>'
                        )
                    }else{
                        $('.modal-reply').append(
                            '<div class="reply-item">'+
                                '<div class="user"><i class="fa fa-user"></i> '+data[i].name+'</div>'+
                                '<div class="reply-date">'+date+'</div>'+
                                '<div>'+data[i].content+'</div>'+
                            '</div>'
                        )
                    }
                }
            },
            error: function(data) {
                alert('fail'+ data[1].id);
            }
        })
    })
}

$(document).ready(function() {
    loadLike();
    likeQuestion();
    getReplies();
    getQuestion();
    sendQuestion();
    sendReply();
});

$('.reply-form').submit(function(e){
    e.preventDefault();
})



