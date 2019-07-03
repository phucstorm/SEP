function classToggle() {
   const navs = document.querySelectorAll('.sidebar-navigation');
    
    navs.forEach(nav => nav.classList.toggle('toggle-show'));
  }
  
document.querySelector('.sidebar-toggle').addEventListener('click', classToggle);

// function toggleAction() {
//     const actions = document.querySelectorAll('.event-action-mobile')
//     actions.forEach(action => action.classList.toggle('toggle-show'));
// }

// document.querySelector('.toggle-action').addEventListener('click',toggleAction);
$(".toggle-action").click(function(){
  $(this).next().toggleClass('toggle-show');
})