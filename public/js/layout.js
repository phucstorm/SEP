
$('.sidebar-toggle').click(function(){
    $('.sidebar-navigation').toggleClass('toggle-sidebar');
    $('body .container').toggleClass('has-darken-bg');
})
// function toggleAction() {
//     const actions = document.querySelectorAll('.event-action-mobile')
//     actions.forEach(action => action.classList.toggle('toggle-show'));
// }

$('html').on('click',function(event){
    var container = $('.sidebar-navigation').find('*');
    if(!$(event.target).is('.fa-bars')&&!$(event.target).is(container)&&!$(event.target).is('.sidebar-navigation')){
      $(".sidebar-navigation").removeClass("toggle-sidebar");
      $('body .container').removeClass('has-darken-bg');
    }
 });
 
// document.querySelector('.toggle-action').addEventListener('click',toggleAction);
$(".toggle-action").click(function(event) { 
    $(".event-action-mobile").removeClass("toggle-event-action");
    $(this).next().addClass('toggle-event-action');
    
})
$('html').on('click',function(event){
    var container = $('.event-action-mobile').find('*');
    if(!$(event.target).is('.toggle-action')&&!$(event.target).is('.event-action-mobile')&&!$(event.target).is(container)){
      $(".event-action-mobile").removeClass("toggle-event-action");
    }
 });
// $(document).mouseup(function(e) {
//     var container = $(".event-action-mobile");
//     if (!container.is(e.target) && container.has(e.target).length === 0) {
//         container.removeClass('toggle-show');
//     }
//     var sidenav = $(".sidebar-navigation");
//     if (!sidenav.is(e.target) && sidenav.has(e.target).length === 0) {
//         sidenav.removeClass('toggle-show');
//     }
// });