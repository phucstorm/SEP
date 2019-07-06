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
$(".toggle-action").click(function() {
    $(".event-action-mobile").removeClass('toggle-show');
    $(this).next().addClass('toggle-show');
})
$(document).mouseup(function(e) {
    var container = $(".event-action-mobile");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.removeClass('toggle-show');
    }
});
$(document).ready(function() {
    $('button.qr-btn').each(function(index) {
        $(this).attr('data-target', '.qrcode' + index);
    })

    $('.modal.fade.qrcode').each(function(index) {
        $(this).removeClass('qrcode');
        $(this).addClass('qrcode' + index);
    })
})