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


$('.sidebar-toggle').click(function() {
    $('.sidebar-navigation').css('visibility', 'visible');
    $('.sidebar-navigation').css('display', 'unset');
    $('.sidebar-navigation').css('transform', 'translateX(0px)');
    $('.opacity_menu').toggleClass('open_opacity');
})

$('.opacity_menu').click(function(e) {
    $('.opacity_menu').removeClass('open_opacity');
    $('.sidebar-navigation').css('visibility', 'hidden');
    $('.sidebar-navigation').css('transform', 'translateX(-280px)');
});

$(".navbar_select > div > button").on('click', function() {
    $('.is-active').removeClass();
    $(this).addClass('is-active');
});