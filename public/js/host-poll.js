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
    'autofocus required>'+
    '<button type="button" class="delete-poll-answer-btn"><i class="fa fa-trash"></i></button></div>'
    $('.poll-answer').append(answer);
});

$('.plus-new-answer').click(function() {
    var answer = '<div class="w-100 position-relative"><input id="poll_answer"' +
    'type="text"'+ 
    'class="form-control mt-2" '+
    'name="new_poll_answer[]" '+
    'value="" '+
    'autocomplete="poll_answer" '+
    'autofocus required>'+
    '<button type="button" class="delete-poll-answer-btn"><i class="fa fa-trash"></i></button></div>'
    $('.poll-answer').append(answer);
});
setInterval(function(){ 
    $('.delete-poll-answer-btn').click(function(){
        $(this).parent().remove();
    }); 
}, 500);
$(".poll-result-bar").each(function(){
    $(this).animate({
      width: $(this).attr("data-width")
    },2500)
  });