// Create Event
$(".date-error-message").hide();
$(".data-error-message").hide();
$('.event-code-error-message').hide();
$(".submit-form").submit(function(e){
    e.preventDefault();
});
// $('.create-poll-form').submit(function(e)
// {
//     e.preventDefault();
// });
$('#add-new-event-btn').click(function() {
    if (
        $('input[name=event_name]').val() != "" &&
        $('input[name=event_description]').val() != "" &&
        $('input[name=start_date]').val() != "" &&
        $('input[name=end_date]').val() != ""
    ) {
        if ($('input[name=start_date]').val() >= $('input[name=end_date]').val()) {
            $(".date-error-message").show();
            $(".data-error-message").hide();
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
$(document).on('click', '.btn.btn-outline-success', function() {
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
                    url: 'event/edit',
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
$(document).on('click', '.btn.btn-outline-danger.desktop-btn', function() {
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
                alert("Xóa event thành công");
                window.location.reload();
            },
            error: function(data) {
                alert("Gặp vấn đề khi xóa event");
            }
        });
    });
});

//Edit User
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
                    alert("Cập nhật thông tin người dùng hoàn tất");
                    window.location.reload();
                },
                error: function(data) {
                    alert("Email này đã có người sử dụng");
                },
            });
        } else {
            alert("Bạn cần điền tên để hoàn tất cập nhật thông tin");
        }
    });
});

$(document).on('click', '.edit_user_pass-btn', function() {
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
                                alert(data);
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
$(document).on('click', '.item-action.delete-item', function() {
    var question_id = $(this).attr('data-id');
    $('#del_ques').click(function() {
        window.location.href = "/room/question/denied/" + question_id;
    });
});


//Reply question
$(document).on('click', '.question-item-accepted > div.accept > div.question-item > div:nth-child(5) > div:nth-child(2) > div > button', function() {
    var question_id = $(this).attr('data-id');
    var content = $(this).attr('data-content');
    $("#reply > div > div > div.modal-header > .modal-title").text(content);
    $('#reply > div > div > div.footer > button').click(function() {
        $.ajax({
            type: 'POST',
            url: '/room/reply',
            data: {
                '_token': $('input[name=_token]').val(),
                'question_id': question_id,
                'content': $('#reply > div > div > div.footer > textarea').val(),
            },
            success: function(data) {
                // window.location.reload();
                console.log(data);
            },
            error: function(data) {
                // alert(data);
                console.log(data);
            },
        });
    });
});

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
// Create Poll
$('#create-poll').click(function() {
    if ($('input[name=poll_question_content]').val() != '') {
        if ($('input[name=poll_answer]').val() != '') {
            $.ajax({
                type: 'POST',
                url: '/admin/event/poll/create',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'event_id': $('input[name=event_id]').val(),
                    // 'poll_question_content': $('input[name=poll_question_content]').val(),
                    // 'poll_answer': $('input[name=poll_answer]').serializeArray(),
                    // 'mul_choice': $('input[name=multiple-answer]').is(':checked') == true ? 1 : 0,
                },
                success: function(data) {
                    // alert('You have successfully create new poll');
                    // window.location.reload();
                    // console.log('success' + data);
                },
                error: function(data) {
                    // alert(data);
                    // alert('error' + data);
                    // window.location.reload();
                },
            });
        } else {
            alert('Please, fill at least one option');
        }
    } else {
        alert('Question text is required');
    }
});

$('.delete-poll-btn').on('click', function() {
    var poll_id = $(this).attr('data-id');
    $('#delete-poll').click(function() {
        $.ajax({
            type: 'POST',
            url: '/admin/event/poll/delete',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': poll_id,
            },
            success: function(data) {
                alert('Thông báo delete thành công');
                window.location.reload();
                // console.log('success' + data);
            },
            error: function(data) {
                // alert(data);
                console.log('error' + data);
                // window.location.reload();
            },
        });
    });
});

$('button[id=edit-poll]').click(function() {
    $.ajax({
        type: 'POST',
        url: '/admin/event/poll/edit',
        data: {
            '_token': $('input[name=_token]').val(),
            'poll_id': $('#form-poll-edit > div:nth-child(1) > div > #poll_id').val(),
            'event_id': $('#form-poll-edit > div:nth-child(1) > div > #event_id').val(),
            'poll_question': $('#form-poll-edit > div:nth-child(1) > div > #poll-name').val(),
            'poll_answer': $('#form-poll-edit > div:nth-child(2) > div.col-sm-8.poll-answers > div > input[name=poll-answer]').serializeArray(),
            'option': $('#form-poll-edit > div:nth-child(4) > label > input[name=multiple-answer]').is(':checked') == true ? 1 : 0,
        },
        success: function(data) {
            // window.location.reload();
            console.log('success' + data);
        },
        error: function(data) {
            // alert(data);
            console.log('error' + data);
            // window.location.reload();
        },
    });
    console.log('this');
});

//listen channel live
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('9ca3866fa2e26a25d235', {
    cluster: 'ap1',
    forceTLS: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('form-submitted', function (data) {
    var date = moment.parseZone(data.created_at).format("YYYY-MM-DD HH:mm:ss");
    $('.content').append(
        "<div class='question-item'>" +
            "<div class='question-username'>"+
                "<i class=' fa fa-user'></i> "+ data.user_name+
            "</div>"+
            "<div class='question-date'>"+date+"</div>"+
            "<div class='question-content'>"+data.question+"</div>"+
        "<div class='check-question'>" +
        "<a href='/room/question/accept/" + data.id + "'><i class='fa fa-check-circle-o text-success' aria-hidden='true'></i></a> " +
        "<a href='/room/question/denied/" + data.id + "'><i class='fa fa-times-circle-o text-success' aria-hidden='true'></i></a>" +
        "</div>"+
        "</div>"
    );
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
    }

    $('.voted-person').html(''+data.votes+' <i class="fa fa-user" aria-hidden="true"></i>');

    
});

var likes = pusher.subscribe('like-channel');
likes.bind('like-question', function (data){
    // $('.like-btn').html(''+data.likes+'<i class="fa fa-thumbs-up"></i>');
    $('.like-btn'+data.questionId).html(''+data.likes+' <i class="fa fa-thumbs-up"></i>');
})
var unlikes = pusher.subscribe('unlike-channel');
unlikes.bind('unlike-question', function (data){
    // $('.like-btn').html(''+data.likes+'<i class="fa fa-thumbs-up"></i>');
    $('#dislike-btn'+data.questionId).html(''+data.unlikes+' <i class="fa fa-thumbs-down"></i>');
})
