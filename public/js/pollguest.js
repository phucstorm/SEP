$('question-btn').removeClass('is-active');
$('.poll-btn').addClass('is-active');
$(document). ready(function(){
    $('input[type="checkbox"]'). click(function(){
        if ($(this).prop("checked")){
            $(this).parent().css('background','#20b87633');
        }else{
            $(this).parent().css('background','#f8f8f8');
        }
    })
})
$('#submit-btn').click(function(){
    $('#submit-btn').css('display','none');
    $('#edit-btn').css('display','initial');
    $('.poll-result').css('display', 'inherit');
    $('.poll-form-body').css('display', 'none');
})
$('#edit-btn').click(function(){
    $('#edit-btn').css('display','none');
    $('#submit-btn').css('display','initial');
    $('.poll-result').css('display', 'none');
    $('.poll-form-body').css('display', 'inherit');
})
$(".poll-result-bar").each(function(){
    $(this).animate({
      width: $(this).attr("data-width")
    },2500)
  });