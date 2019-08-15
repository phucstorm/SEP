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

// /room/question/accept/" + data[i].id
// accept
acceptQuestion = function(){
    $('.accept-btn').on('click', function(){
        $.ajax({
            url: "/room/question/accept/"+ $(this).attr('data-id'),
            success: function(data){

            },
            error: function(data){

            }
            
        })
    })
}
denyQuestion = function(){
    $('.deny-btn').on('click', function(){
        $.ajax({
            url: "/room/question/denied/"+ $(this).attr('data-id'),
            success: function(data){

            },
            error: function(data){

            }
            
        })
    })
}
$(document).ready(function() {
    getQuestion();
});