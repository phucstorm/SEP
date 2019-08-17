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

//delete question
deleteQuestion = function(){
    $('.item-action.delete-item').on('click', function(){
        $('#delete_title').html($(this).attr('data-name'));
        var id = $(this).attr('data-id');
        $('#del_ques').on('click', function(){
            $.ajax({
                url: "/room/question/denied/"+ id,
                success: function(data){
                    
                },
                error: function(data){
    
                }
                
            })
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
$(function() { //run when the DOM is ready
    $(".sort-item").click(function() {
        $(".sort-item").removeClass("is-selected");
        $(this).addClass("is-selected"); //add the class to the clicked element  
        if ($(".popular-btn").hasClass("is-selected")) {
            getPopularQuestion();
        }
        if ($(".recent-btn").hasClass("is-selected")) {
            getQuestion();
        }
    });
});
$(document).ready(function() {
    getQuestion();
});