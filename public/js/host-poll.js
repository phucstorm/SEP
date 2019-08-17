$('question-btn').removeClass('is-active');
$('.poll-btn').addClass('is-active');

$('.question-nav .incoming').click(function() {
    $('.question-item-accepted').css('display', 'none');
    $('.question-item-reviewing').css('display', 'initial');
    $('.question-nav .incoming').css('font-weight', '700');
    $('.question-nav .live').css('font-weight', '300');
})

$('.question-nav .live').click(function() {
    $('.question-item-reviewing').css('display', 'none');
    $('.question-item-accepted').css('display', 'initial');
    $('.question-nav .live').css('font-weight', '700');
    $('.question-nav .incoming').css('font-weight', '300');
})

$('.plus-answer').click(function() {
    var answer = '<div class="w-100 position-relative"><input id="poll_answer"' +
    'type="text"'+ 
    'class="form-control mt-2" '+
    'name="poll_answer[]" '+
    'value="" '+
    'autocomplete="poll_answer" '+
    'autofocus required maxlength="160">'+
    '<button type="button" class="delete-poll-answer-btn"><i class="fa fa-trash"></i></button></div>'
    $('.poll-answer').append(answer);
    $('.delete-poll-answer-btn').click(function(){
        $(this).parent().remove();
    }); 
});

$('.plus-new-answer').click(function() {
    var answer = '<div class="w-100 position-relative"><input id="poll_answer"' +
    'type="text"'+ 
    'class="form-control mt-2" '+
    'name="new_poll_answer[]" '+
    'value="" '+
    'autocomplete="poll_answer" '+
    'autofocus required maxlength="160">'+
    '<button type="button" class="delete-poll-answer-btn"><i class="fa fa-trash"></i></button></div>'
    $('.poll-answer').append(answer);
    $('.delete-poll-answer-btn').click(function(){
        $(this).parent().remove();
    }); 
});

setInterval(function(){ 
$(".poll-result-bar").each(function(){
    $(this).animate({
      width: $(this).attr("data-width")
    },2000)
  });
}, 2000);

//get poll answer
getPollAnswers = function(){
    $('.edit-poll-btn').on('click', function(){
        var pollid = $(this).val()
        $('#upoll-id').attr('value',$(this).val())
        if($(this).attr('data-mulcheck')==1){
            $('#multiple-answer-edit').attr('checked','checked')
        }
        $('.poll-answer-list').html('<label for="poll_answer">Poll Answers</label>')
        $('#poll-content-input').attr('value',$(this).attr('data-name'))
        $.ajax({
            url: '/admin/getpollanswer/'+$(this).val(),
            success: function(data){
                for (var i=0; i<data.length; i++){
                    $('.poll-answer-list').append(
                        '<div class="w-100 position-relative">'+
                        '<input id="poll_answer" '+
                            'type="text" '+
                            'class="form-control mt-2" '+
                            'name="poll_answer['+data[i].id+']" '+
                            'value="'+data[i].content+'" '+
                            'required maxlength="160">'+
                            (i < 2 ? '' : '<button type="button" class="delete-poll-answer-btn"><i class="fa fa-trash"></i></button>')+
                            '</div>'
                    )
                }
                $('.delete-poll-answer-btn').click(function(){
                    $(this).parent().remove();
                }); 
            },
            error: function(data){
                alert(data[0].content)
            }
        })
    })

}
$('.update-poll').on('click', function(){
    pollid=$('#upoll-id').val();
    $.ajax({
        method:'POST',
        url: '/admin/event/poll/edit/'+pollid,
        data: $('.edit-poll-form').serialize(),
        success: function(data){
            if(data=="emptyanswer"){
                $('.error-update-poll').html('You must fill in all the poll answer')
            }else if(data=="emptycontent"){
                $('.error-update-poll').html('You must fill in the poll content')
            }else{
                alert('You have updated poll successfully')
                $('#editPoll').modal('hide')
            }
        },
        error: function(data){
            alert('fail')
        }
    })
})
// Create Poll
$('#create-poll').click(function() {
    $.ajax({
        type: 'POST',
        url: '/admin/event/poll/create',
        data: $('.create-poll-form').serialize(),
        success: function(data) {
            if(data=="emptyanswer"){
                $('.error-create-poll').html('You must fill in all the poll answer')
            }else if(data=="emptycontent"){
                $('.error-create-poll').html('You must fill in the poll content')
            }else{
                alert('You have created poll successfully')
                $('#createPollModal').modal('hide')
                getPolls()
            }
        },
        error: function(data) {
            alert('error' + data);
        },
    });

});
//delete poll 
deletePoll = function(){

    $('.delete-poll-btn').on('click', function(){
        $('#delete-title').html($(this).attr('data-content'))
        $('#dpoll-id').attr('value',$(this).attr('data-id'))

    })
}
$('#deletePoll').on('click', function(){
    pollid=$('#dpoll-id').val();
    $.ajax({
        url: '/admin/event/poll/delete/'+pollid,
        success: function(data){
            $('#deletePollModal').modal('hide')
            getPolls()
        },
        error: function(data){

        }
    })
})
//play and stop poll
updateStatus = function(){
    $('.update-status-btn').on('click', function(){
        $.ajax({
            url: '/admin/event/poll/status/'+$(this).attr('data-id'),
            success: function(data){
                getPolls()
            },
            fail: function(data){
                alert('fail'+data)
            }
        })
    })
}
$(document).ready(function() {
    getPolls();
});