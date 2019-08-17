// Create Event
$(".date-error-message").hide();
$(".data-error-message").hide();
$('.event-code-error-message').hide();
$(".startdate-error-message").hide();

$(".submit-form").submit(function(e){
    e.preventDefault();
});


$('#add-new-event-btn').click(function() {
    var startdate = new Date($('.create-start-date').val());
    var dateNow = new Date();
    if (
        $('input[name=event_name]').val() != "" &&
        $('input[name=event_description]').val() != "" &&
        $('input[name=start_date]').val() != "" &&
        $('input[name=end_date]').val() != ""
    ) {
        if ($('input[name=start_date]').val() >= $('input[name=end_date]').val()) {
            $(".date-error-message").show();
            $(".startdate-error-message").hide();
        } else if(startdate<dateNow){
            $(".startdate-error-message").show();
            $(".date-error-message").hide();

        } else {
            
            $.ajax({
                type: 'POST',
                url: 'event/create',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'event_name': $('input[name=event_name]').val(),
                    'event_description': $('input[name=event_description]').val(),
                    'start_date': $('input[name=start_date]').val(),
                    'end_date': $('input[name=end_date]').val()
                },
                success: function(data) {
                    alert("You have created event successfully");
                    window.location.reload();
                    // console.log(data);
                },
                error: function(data) {
                    $(".data-error-message").show();
                    $(".date-error-message").hide();
                }
            });
        }

    }
});

// Edit Event
$(document).on('click', '.edit-event-btn', function() {
    $(".date-error-message").hide();
    $(".data-error-message").hide();
    $('.event-code-error-message').hide();
    var event_id = $(this).attr('data-id');
    $('#en').val($(this).attr('data-name'));
    $('#ec').val($(this).attr('data-code'));
    $('#ds').val($(this).attr('data-description'));
    $('#sd').val($(this).attr('data-start'));
    $('#ed').val($(this).attr('data-end'));
    $('#li').val($(this).attr('data-link'));

    if ($(this).attr('data-join') == 1) {
        $('#ji').attr("checked", true);
    } else {
        $('#ji').attr("checked", false);
    }
    if ($(this).attr('data-question') == 1) {
        $('#qt').attr("checked", true);
    } else {
        $('#qt').attr("checked", false);
    }
    if ($(this).attr('data-reply') == 1) {
        $('#rl').attr("checked", true);
    } else {
        $('#rl').attr("checked", false);
    }
    if ($(this).attr('data-mod') == 1) {
        $('#md').attr("checked", true);
    } else {
        $('#md').attr("checked", false);
    }
    if ($(this).attr('data-anonymous') == 1) {
        $('#an').attr("checked", true);
    } else {
        $('#an').attr("checked", false);
    }

    $('#update').click(function() {
        if (
            $('input[name=en]').val() != "" &&
            $('input[name=ds]').val() != "" &&
            $('input[name=sd]').val() != "" &&
            $('input[name=ed]').val() != ""
        ) {
            if ($('input[name=sd]').val() >= $('input[name=ed]').val()) {
                $(".date-error-message").show();
                $(".data-error-message").hide();
                $('.event-code-error-message').hide();
            } else {
                $.ajax({
                    type: 'POST',
                    url: '/admin/event/edit',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': event_id,
                        'event_name': $('input[name=en]').val(),
                        'event_code': $('input[name=ec]').val(),
                        'event_description': $('input[name=ds]').val(),
                        'event_start': $('input[name=sd]').val(),
                        'event_end': $('input[name=ed]').val(),
                        'join': $('input[name=ji]').is(':checked') == true ? 1 : 0,
                        'question': $('input[name=qt]').is(':checked') == true && $('input[name=ji]').is(':checked') == true ? 1 : 0,
                        'reply': $('input[name=rl]').is(':checked') == true && $('input[name=ji]').is(':checked') == true ? 1 : 0,
                        'moderation': $('input[name=md]').is(':checked') == true && $('input[name=md]').is(':checked') == true ? 1 : 0,
                        'anonymous': $('input[name=an]').is(':checked') == true && $('input[name=an]').is(':checked') == true ? 1 : 0,
                    },
                    success: function(data) {
                        if (data == "Mã event đã tồn tại") {
                            $('.event-code-error-message').show();
                            $(".date-error-message").hide();
                            $(".data-error-message").hide();
                        } else {
                            alert("Your event have updated successfully");
                            window.location.reload();
                        }
                    },
                    error: function(data) {
                        alert(data)
                        $(".data-error-message").show();
                        $(".date-error-message").hide();
                        $('.event-code-error-message').hide();
                    },
                });
            }
        } else {
            
        }

    });
});

// Delete Event
$(document).on('click', '.delete-event', function() {
    $('#delete_title').append($(this).attr('data-name'));
    var event_id = $(this).attr('data-id');
    $('#del').click(function() {
        $.ajax({
            type: 'POST',
            url: 'event/delete',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': event_id
            },
            success: function(data) {
                window.location.reload();
            },
            error: function(data) {
                alert("Gặp vấn đề khi xóa event");
            }
        });
    });
});

//Edit User
$(".edit-info-form").submit(function(e){
    e.preventDefault();
});
$(document).on('click', '.edit_user_info-btn', function() {
    var id = $(this).attr('data-id');
    $('#un').val($(this).attr('data-name'));
    $('#em').val($(this).attr('data-email'));
    $('#edit_info').click(function() {
        if ($('input[name=un]').val() != "" && $('input[name=em]').val() != "") {
            $.ajax({
                type: 'POST',
                url: '/user/edit/info',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id,
                    'name': $('input[name=un]').val(),
                    // 'email': $('input[name=em]').val(),
                },
                success: function(data) {
                    alert("Your name have been updated successfully");
                    $(".name-error").hide();
                    window.location.reload();
                },
                error: function(data) {
                    $(".name-error").show();
                },
            });
        } else {
        }
    });
});

$(document).on('click', '#edit_pass', function() {
    var id = $(this).attr('data-id');
    $('#edit_pass').click(function() {
        if ($('input[name=cpw]').val() != "") {
            if ($('input[name=pw]').val() != "") {
                if ($('input[name=cp]').val() != "") {
                    if ($('input[name=pw]').val() == $('input[name=cp]').val()) {
                        $.ajax({
                            type: 'POST',
                            url: '/user/edit/password',
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id': id,
                                'current_pass': $('input[name=cpw]').val(),
                                'password': $('input[name=pw]').val(),
                            },
                            success: function(data) {
                                alert("Cập nhật mật khẩu thành công");
                                window.location.reload();
                            },
                            error: function(data) {
                                alert('data');
                            },
                        });
                    } else {
                        alert("Mật khẩu xác nhận không đúng");
                    }
                } else {
                    alert("Bạn cần phải nhập xác nhận mật khẩu");
                }
            } else {
                alert("Bạn cần phải nhập mật khẩu mới");
            }
        } else {
            alert("Bạn cần phải nhập mật khẩu hiện tại");
        }
    });
});

//Delete question
// $(document).on('click', '.item-action.delete-item', function() {
//     var question_id = $(this).attr('data-id');
//     $('#delete_title').html($(this).attr('data-name'));
//     $('#del_ques').click(function() {
//         window.location.href = "/room/question/denied/" + question_id;
//     });
// });

$('.reply-form').submit(function(e){
    e.preventDefault();
})
//Reply question
$('.send-reply-btn').on('click',function(){
    var button = $(this).parents('.footer').children('.input-answer');
    var answer = $(this).parents().children('.modal-body');
    var content = $(this).parents().children('.input-answer').val();
    var d = new Date($.now());
    var time = (d.getFullYear()+"-"+(d.getMonth() + 1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
    var username = $('input[name=username]').val();
    $.ajax({
        type:'POST',
        url: "/room/reply/",
        data:
        $(this).parents('.reply-form').serialize(),
        success: function(data) {
            console.log(answer);
            answer.append(
            '<div class="reply-item">'+
                '<div class="user" style="color: #20b875"><i class="fa fa-user"></i> '+username+' - Host</div>'+
                '<div class="reply-date">'+time+'</div>'+

                '<div class="">'+content+'</div>'+

            '</div>'
            );
            button.val('');
        },
        error: function(data) {
        }
    })
})
//get replies
getReplies = function(){
    $('.reply-button').on('click', function(){
        $('.modal-reply').html('');
        $('#questionIdInput').attr('value',$(this).attr('data-id'));
        $('.question-reply-title').html($(this).attr('data-name'));
        $.ajax({
            url: '/room/host/showreply/'+$(this).attr('data-id'),
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
//Like question
    likeQuestion = function(){
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
    $(document).ready(function() {
        loadLike();
        getReplies();
        likeQuestion();
    });


//listen channel live
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('9ca3866fa2e26a25d235', {
    cluster: 'ap1',
    forceTLS: true
});

var votes = pusher.subscribe('vote-channel');
votes.bind('vote-submitted', function (data){
    // $('.poll-result').html('');
    if(data.sumVotes!=0){
        for (i = 0; i < data.answerArray.length; i++) {
            $( ".poll-result-bar").eq(i).attr("data-width",Math.round((data.answerArray[i]/data.sumVotes)*90)+"%");
            $(".votes").eq(i).html('('+data.answerArray[i]+')');
            $(".percent").eq(i).html(''+Math.round((data.answerArray[i]/data.sumVotes)*100)+'%');
        }
        // getPolls();
    }

    $('.voted-person').html(''+data.votes+' <i class="fa fa-user" aria-hidden="true"></i>');

    
});
