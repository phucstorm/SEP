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
                'event_code': $('input[name=event_code]').val(),
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
    var event_name = $(this).attr('data-name');
    var event_code = $(this).attr('data-code');
    var event_description = $(this).attr('data-description');
    var event_link = $(this).attr('data-link');
    var event_start = $(this).attr('data-start');
    var event_end = $(this).attr('data-end');
    var setting_join = $(this).attr('data-join');
    var setting_question = $(this).attr('data-question');
    var setting_reply = $(this).attr('data-reply');
    var setting_moderation = $(this).attr('data-mod');
    var setting_anonymous = $(this).attr('data-anonymous');

    $('#en').val(event_name);
    $('#ec').val(event_code);
    $('#ds').val(event_description);
    $('#sd').val(event_start);
    $('#ed').val(event_end);
    $('#li').val(event_link);

    if (setting_join == 1) {
        $('#ji').attr("checked", true);
    } else {
        $('#ji').attr("checked", false);
    }
    if (setting_question == 1) {
        $('#qt').attr("checked", true);
    } else {
        $('#qt').attr("checked", false);
    }
    if (setting_reply == 1) {
        $('#rl').attr("checked", true);
    } else {
        $('#rl').attr("checked", false);
    }
    if (setting_moderation == 1) {
        $('#md').attr("checked", true);
    } else {
        $('#md').attr("checked", false);
    }
    if (setting_anonymous == 1) {
        $('#an').attr("checked", true);
    } else {
        $('#an').attr("checked", false);
    }

    $('#update').click(function() {
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
                window.location.reload();
                // console.log(data);
            },
            error: function(data) {
                // window.location.reload();
                // console.log(data);
                alert("Bạn cần phải nhập đầy đủ thông tin để hoàn tất việc chỉnh sửa");
            },
        });
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
                window.location.reload();
                // console.log(event_id);
            },
            error: function(data) {
                // console.log(event_id);
            }
        });
    });
});

$(document).on('click', '.edit_user-btn', function() {
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    var email = $(this).attr('data-email');

    $('#un').val(name);
    $('#em').val(email);

    $('#eUser').click(function() {
        if ($('input[name=pw]').val() == $('input[name=cp]').val()) {
            $.ajax({
                type: 'POST',
                url: '/user/edit',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id,
                    'name': $('input[name=un]').val(),
                    'email': $('input[name=em]').val(),
                    'password': $('input[name=pw]').val(),
                },
                success: function(data) {
                    // window.location.reload();
                    // console.log(data);
                },
                error: function(data) {
                    // window.location.reload();
                    console.log(data);
                },
            });
        } else {
            console.log('sai');
        }
    });

});