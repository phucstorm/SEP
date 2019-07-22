$(".user_info .fa-cog").click(function(){
    $(".user-setting-menu").toggleClass('toggle-user-setting');
})
function classToggle() {
    const navs = document.querySelectorAll('.sidebar-navigation');

    navs.forEach(nav => nav.classList.toggle('toggle-show'));
}
document.querySelector('.sidebar-toggle').addEventListener('click', classToggle);
$(".toggle-action").click(function() {
    $(".event-action-mobile").removeClass('toggle-show');
    $(this).next().addClass('toggle-show');
    $(this).next().css('height', '143px');
})
$(document).mouseup(function(e) {
    var container = $(".event-action-mobile");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.removeClass('toggle-show');
        container.css('height', '0px');
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
$(document).ready(function() {
    $('button.qr-btn-mobile').each(function(index) {
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

$('.search-mobile i.fa.fa-search').click(function() {
    $('.search-mobile input').css('display', 'initial');
    $('.vlask-logo').css('display', 'none');
    $('.vlask-logo img').css('width', '0');
    $('.sidebar-toggle').css('display', 'none');
    $('.fa-bars').css('font-size', '0px');
    $('.search-mobile i.fa.fa-chevron-left').css('display', 'initial');
    $('.search-mobile i.fa.fa-search').css('display', 'none');
    $('.search-mobile').css('width', '100%');
})

$('.search-mobile i.fa.fa-chevron-left').click(function() {
    $('.search-mobile').css('width', '0%');
    $('.vlask-logo img').css('width', '50px');
    $('.vlask-logo').css('display', 'flex');
    $('.sidebar-toggle').css('display', 'initial');
    $('.fa-bars').css('font-size', '30px');
    $('.search-mobile i.fa.fa-chevron-left').css('display', 'none');
    $('.search-mobile i.fa.fa-search').css('display', 'initial');

})