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

    $(document).scroll(function() {
        if ($(this).scrollTop() > 250) {
            $('#header-container').addClass("sticky");
        }
        else{
            $('#header-container').removeClass("sticky");
        }
    });

        //
        // // Длительность анимации появления
        // transitionDuration: 300,
        //
        // // Включает тень у шапки
        // shadow: true,
        //
        // // Прозрачность тени у шапки
        // shadowOpacity: 0.3,
        //
        // // Включение анимации при появлении шапки
        // animate: true,
        //
        // // true: Шапка прилипнет к верху когда окно браузера будет достигнут центр страницы
        // // false: Шапка прилипнет к верху как только пропадет из поля зрения при скролинге страницы
        // triggerAtCenter: false,
        //
        // //  Шапка прилипнет к верху при пролистывании страницы на 200 пикселей
        // topOffset: 300,
        //
        // // Плавное появление 'fade' или скольжение при появлении 'slide'
        // transitionStyle: 'slide',
        //
        // //  Шапка прикреплена к верху при загрузке страницы
        // stickyAlready: false

});