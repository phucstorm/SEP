// Create Event 
$('#add').click(function() {
    if (
        $('input[name=event_name]').val() != "" &&
        $('input[name=event_description]').val() != "" &&
        $('input[name=start_date]').val() != "" &&
        $('input[name=end_date]').val() != ""
    ) {
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
                alert("Tạo event thành công");
                window.location.reload();
            },
            error: function(data) {
                alert("Yêu cầu kiểm tra lại các dữ liệu đã nhập");
            }
        });
    } else {
        alert("Bạn phải điền đầy đủ thông tin mới có thể tạo được event !");
    }
});

// Edit Event
$(document).on('click', '.btn.btn-outline-success.desktop-btn', function() {
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
                    alert("Cập nhật thông tin event hoàn tất");
                    window.location.reload();
                },
                error: function(data) {
                    alert("Dữ liệu bạn nhập không đúng định dạng !");
                },
            });
        } else {
            alert("Bạn phải nhập đầy đủ thông tin để hoàn tất việc chỉnh sửa event");

        }

    });
});

// Delete Event
$(document).on('click', '.btn.btn-outline-danger.desktop-btn', function() {
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
                    'email': $('input[name=em]').val(),
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
            alert("Bạn cần điền tên và email để hoàn tất cập nhật thông tin");
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
$(document).on('click', '.btn.btn-outline-danger.delete_question', function() {
    var question_id = $(this).attr('data-id');
    $('#del_ques').click(function() {
        $.ajax({
            type: 'POST',
            url: '/room/question/denied',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': question_id
            },
            success: function(data) {
                window.location.reload();
            },
            error: function(data) {
                alert("Gặp vấn đề khi xóa question");
            }
        });
    });
});