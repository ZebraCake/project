<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>My BLOG</title>
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v3.2"></script>
<div id="header-container">
    <header>
        <i class="fas fa-times close-header"></i>
        <section id="header-logo">
            <span>My blog</span>
        </section>
        <nav>
            <i class="fas fa-bars mobile-menu"></i>
            <ul>
                <li><a href="./">Главная</a></li>
                <li><a href="#">Об авторе</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
        </nav>
    </header>
</div>
<div id="main-container">
    <div id="content-container">
        <main>
            <form action="">
                <input type="text" name="title" id="title">
                <input type="text" name="description" id="description">
                <input type="file" id="file">
                <textarea name="text" id="textarea"></textarea>
                <button type="button" id="add_post">Загрузить</button>

            </form>
        </main>
        <div class="aside-container">
            <aside>

                <section class="search">
                    <form action="?search=<?php echo $_GET['search']; ?>" method="get">
                        <input type="text" placeholder="Поиск" name="search">
                        <button></button>
                    </form>
                </section>
                <section class="categories">
                    <span>Категории</span>
                    <?= $getData->getCategories() ?>
                </section>

                <?php
                if (!$user->isAuth()) {
                    $message = "";

                    include("view/auth/login.php");
                } else {
                    include("view/auth/logout.php");
                }
                ?>

            </aside>
        </div>
    </div>
</div>
<div id="footer-container">
    <footer>
        <section class="copyright">
            <span>My Blog © 2019</span>
        </section>
        <section class="links">
            <a href="/?vk-target="><i class="fab fa-vk"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-google-plus-g"></i></a>
        </section>
    </footer>
</div>
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/createPostAjax.js"></script>
</body>
</html>