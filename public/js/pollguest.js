$('question-btn').removeClass('is-active');
$('.poll-btn').addClass('is-active');
// $('.vote-error').hide();
// $('.poll-result').hide();
// $('#resubmit-btn-poll').hide();

$(document).ready(function(){
    $('input[type="checkbox"]'). click(function(){
        if ($(this).prop("checked")){
            $(this).parent().css('background','#20b87633');
        }else{
            $(this).parent().css('background','#f8f8f8');
        }
    })
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

votePoll = function(){
  $('#submit-btn-poll').on('click', function(){
    var answerChecked = $('.check-answer:checked');
    $.ajax({
      type: 'POST',
      url: "/room/poll/vote/",
      data: 
        $('.poll-form').serialize()
      ,
      success: function(data) {
        if (data=="emptyvote"){
          $('.vote-error').html('Please vote for an answer!')
        }else{
          $('.vote-error').html('')
          localStorage.setItem('isvoted'+$('input[name=poll-id]').val(), true);
          $.each($(".check-answer:checked"), function(){            
            // console.log($(this).val());
            localStorage.setItem('answerisvoted'+$(this).val(), true);
          });
          $.each($(".check-answer:not(:checked)"), function(){            
            localStorage.setItem('answerisvoted'+$(this).val(), false);
          });
          isVoted();
        }

      },
      error: function(data) {
        alert('fail '+data)
      },
    });
  })
}

//revote a poll
reVote = function(){
  $('#edit-poll-btn').click(function(){
    // $('.poll-form-body').show();
    // $('.poll-result').hide();
    $.ajax({
      type: 'POST',
      url: "/room/poll/revote/",
      data: 
        $('.poll-form').serialize()
      ,
      success: function(data) {
        localStorage.setItem('isvoted'+$('input[name=poll-id]').val(), false);
        isVoted();
      },
      error: function(data) {
        $('.vote-error').show();
      },
    });
  })
}

//check if user voted this poll
isVoted = function(){
  var poll = $('input[name=poll-id]').val();
  console.log('isvoted'+poll);
  if(localStorage.getItem('isvoted'+poll)=="true"){
    $('.poll-form').hide();
    $('.poll-result').show();
  }else{
    $('.poll-form').show();
    $('.poll-result').hide();
  }
}
answerIsVoted = function(){
  var answers = $('.check-answer');
  for(var i = 0; i<answers.length; i++){
    if(localStorage.getItem('answerisvoted'+answers[i].getAttribute('value'))=="true"){
      $(answers[i]).prop('checked', true);
      console.log('answerisvoted'+answers[i].getAttribute('value'));
    }
  }
}
$(document).ready(function() {
  getRunningPoll();
  getResultRunningPoll();
});

//go live event
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('9ca3866fa2e26a25d235', {
    cluster: 'ap1',
    forceTLS: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('form-submitted', function (data) {
    var date = moment.parseZone(data.created_at).format("YYYY-MM-DD HH:mm:ss");
    $('.question-list.popular-question').append(
        "<div class='question-container'>"+
        "<div class='question-info'>"+
            "<div class='question-username'><i class='fa fa-user'></i> "+data.user_name+"</div>"+
            "<div class='question-date'>"+date+"</div>"+
            "<div class='question-content'>"+data.question+"</div>"+
        "</div>"+
        "<div class='question-like'><button class='like-btn'><i class='fa fa-thumbs-up'></i></button></div>"+
    "</div>"
    );
});
var votes = pusher.subscribe('vote-channel');
votes.bind('vote-submitted', function (data){
    // $('.poll-result').html('');
    if(data.sumVotes!=0){
      for (i = 0; i < data.answerArray.length; i++) {
        $( ".poll-result-bar").eq(i).attr("data-width",Math.round((data.answerArray[i]/data.sumVotes)*90)+"%");
        $(".votes").eq(i).html('('+data.answerArray[i]+')');
        $(".percent").eq(i).html(''+Math.round((data.answerArray[i]/data.sumVotes)*100)+'%');
      }
    }
    $('.total-answer').html(''+data.votes+' <i class="fa fa-user" aria-hidden="true"></i>');         
})

var play = pusher.subscribe('play-poll-channel');
play.bind('play-poll', function (data){
  if($('#this-event-id').val()==data.id){
    getRunningPoll()
    getResultRunningPoll()
  }
})