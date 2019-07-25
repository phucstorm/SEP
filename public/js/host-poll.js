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

setInterval(function() {
    $('.delete-poll-answer-btn').click(function() {
        $(this).parent().remove();
    });
}, 500);


$('.plus-answer').click(function() {
    var answer = '<div><input type="text" class="form-control" id="poll_answer" name="poll_answer" placeholder="Answer" required><button class="delete-poll-answer-btn"><i class="fa fa-trash"></i></button></div>'
    $('.poll-answers').append(answer);
})