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
            url: "/room/like/" + $(this).val(),
        });
        $(this).removeClass("is-not-liked")
        $(this).addClass("is-liked");
        localStorage.setItem('isliked'+$(this).val(), true);
    }else{
        $.ajax({
            url: "/room/unlike/" + $(this).val(),
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

//go live event
        // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('9ca3866fa2e26a25d235', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('form-submitted', function (data) {
        var date = moment.parseZone(data.created_at).format("YYYY-MM-DD HH:mm:ss");
        $('.question-list.popular-question').append(
            "<div class='question-container'>"+
            "<div class='question-info'>"+
                "<div class='question-username'><i class='fa fa-user'></i> "+data.user_name+"</div>"+
                "<div class='question-date'>"+date+"</div>"+
                "<div class='question-content'>"+data.question+"</div>"+
            "</div>"+
            "<div class='question-like'><button class='like-btn'><i class='fa fa-thumbs-up'></i></button></div>"+
        "</div>"
        );
    });
    var votes = pusher.subscribe('vote-channel');
    votes.bind('vote-submitted', function (data){
        // $('.poll-result').html('');

        for (i = 0; i < data.answerArray.length; i++) {
            $( ".poll-result-bar").eq(i).attr("data-width",Math.round((data.answerArray[i]/data.sumVotes)*90)+"%");
            $(".votes").eq(i).html('('+data.answerArray[i]+')');
            $(".percent").eq(i).html(''+Math.round((data.answerArray[i]/data.sumVotes)*100)+'%');
        }
        $('.total-answer').html(''+data.votes+' <i class="fa fa-user" aria-hidden="true"></i>');         
    })

    var play = pusher.subscribe('play-poll-channel');
    play.bind('play-poll', function (data){
        $('.poll-form-header').html(''+data.pollContent);
        $('.poll-answers').html('');
        $('form.poll-form').attr('action','/room/poll/vote/'+data.id)
        if(data.multiChoice==0)
        {   for (i = 0; i < data.answerId.length; i++) {
            $('.poll-answers').append(
                '<input id="talk-type-'+data.answerId[i]+'"'+
                        'name="poll_answer[]"'+
                        'type="radio"'+
                        'value="'+data.answerId[i]+'"'+
                        'hidden/>'+
                '<label for="talk-type-'+data.answerId[i]+'" class="radio-label poll-label">'+
                    '<span class="styled-radio-btn"></span>'+
                    data.answerContent[i]+
                '</label>'
            );
            }
        }else
        {
            for (i = 0; i < data.answerId.length; i++) {
                $('.poll-answers').append(
                    '<label class="checkbox-label poll-label" for="available-'+data.answerId[i]+'">'+
                        '<input id="available-'+data.answerId[i]+'"'+
                                'name="poll_answer['+data.answerId[i]+']"'+
                                'type="checkbox"'+
                                'value="'+data.answerId[i]+'"'+
                                    'hidden/>'+
                                    '<span class="styled-checkbox"></span>'+
                                data.answerContent[i]+
                        '</label>'
                );
            }

        }
    })
    