$(document).ready(function() {
// Панель авторизации в сайдбаре справа
    $('#show-target').click(function () {
        $('#show-target').css('display', 'none');
        $('.auth-form').show(400);
    });

    $('#hide-target').click(function () {
        $('#show-target').delay(410).fadeIn(400);
        $('.auth-form').fadeOut(400);
    });
// Реализация открывания меню в мобильной версии
    $('.mobile-menu').click(function () {
        $('.mobile-menu').fadeOut(300).css({"display": "none",});
        $('header').css({"flex-direction": "column"});
        $('nav ul').fadeIn(300).css({"display": "flex",
        "margin-top": "10px"});
        $('#main-container').css({"margin-top": "90px"});
        $('.close-header').fadeIn(500).css({"display": "block"});
    });

    $('.close-header').click(function () {
        $('.mobile-menu').fadeIn(300).css({"display": "block",});
        $('header').css({"flex-direction": "row"});
        $('nav ul').fadeOut(300).css({"display": "none",
            "margin-top": "0"});
        $('#main-container').css({"margin-top": "65px"});
        $('.close-header').fadeOut(300).css({"display": "none"});
    });
});