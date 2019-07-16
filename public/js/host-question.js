$('poll-btn').removeClass('is-active');
$('.question-btn').addClass('is-active');
$('.question-nav .incoming').click(function(){
    $('.question-item-accepted').css('display','none');
    $('.question-item-reviewing').css('display','initial');
    $('.question-nav .incoming').css('font-weight', '700');
    $('.question-nav .live').css('font-weight', '300');
})

$('.question-nav .live').click(function(){
    $('.question-item-reviewing').css('display','none');
    $('.question-item-accepted').css('display','initial');
    $('.question-nav .live').css('font-weight', '700');
    $('.question-nav .incoming').css('font-weight', '300');
})