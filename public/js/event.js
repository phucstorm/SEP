// Create Event 


$('#add').click(function () {
    $.ajax({
        type: 'POST',
        url: 'event/create',
        data: {
            '_token': $('input[name=_token]').val(),
            'event_name': $('input[name=event_name]').val(),
            'event_code': $('input[name=event_code]').val(),
            'start_date': $('input[name=start_date]').val(),
            'end_date': $('input[name=end_date]').val()
        },
        success: function (data) {
            window.location.reload();
        }
    });
});

// Edit Event
$(document).on('click', '.btn-outline-warning', function () {
    var event_id = $(this).attr('data-id');
    var event_name = $(this).attr('data-name');
    var event_start = $(this).attr('data-start');
    var event_end = $(this).attr('data-end');
    var setting_join = $(this).attr('data-join');
    var setting_question = $(this).attr('data-question');
    var setting_reply = $(this).attr('data-reply');

    $('#en').val(event_name);
    $('#sd').val(event_start);
    $('#ed').val(event_end);


    if(setting_join == 1){
        $('#ji').attr("checked", true);
    }else{
        $('#ji').attr("checked", false);
    }
    if(setting_question == 1){
        $('#qt').attr("checked", true);
    }else{
        $('#qt').attr("checked", false);
    }
    if(setting_reply == 1){
        $('#rl').attr("checked", true);
    }else{
        $('#rl').attr("checked", false);
    }

    $('#update').click(function () {
        $.ajax({
            type: 'POST',
            url: 'event/edit',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': event_id,
                'event_name': $('input[name=en]').val(),
                'event_start': $('input[name=sd]').val(),
                'event_end': $('input[name=ed]').val(),
                'join' : $('input[name=ji]').is(':checked') == true ? 1 : 0,
                'question' : $('input[name=qt]').is(':checked') == true &&  $('input[name=ji]').is(':checked') == true ? 1 : 0,
                'reply' : $('input[name=rl]').is(':checked') == true &&  $('input[name=ji]').is(':checked') == true ? 1 : 0,
            },
            success: function (data) {
                window.location.reload();
                // console.log(data);
            },
            error: function (data) {
                // window.location.reload();
                console.log(data);
            },
        });
    });
});


// Delete Event
$(document).on('click', '.btn-outline-danger', function () {
    var event_id = $(this).attr('data-id');
    $('#del').click(function () {
        $.ajax({
            type: 'POST',
            url: 'event/delete',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': event_id
            },
            success: function (data) {
                window.location.reload();
                // console.log(event_id);
            },
            error: function (data) {
                // console.log(event_id);
            }
        });
    });
});

