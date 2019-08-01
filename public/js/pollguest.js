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
$('.show-result').click(function(){
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

setInterval(function(){ 
  $(".poll-result-bar").each(function(){
      $(this).animate({
        width: $(this).attr("data-width")
      },2500)
    });
  }, 2500);

$(".poll-form").submit(function(e){
  e.preventDefault();
})
//Vote poll function
$('.submit-poll-btn').on('click', function(){
  $.ajax({
    url: "/room/poll/vote/" + $(this).val(),
    success: function(data) {
      // window.location.reload();
      console.log('success' + data);
    },
    error: function(data) {
        // alert(data);
        console.log('error' + data);
        // window.location.reload();
    },
  });
})
