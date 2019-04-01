<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>My BLOG</title>
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v3.2"></script>
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
                    <li><a href="/?contacts">Контакты</a></li>
                </ul>
            </nav>
        </header>
    </div>
    <div id="main-container">
        <div id="content-container">
            <main>
                <?php
                    if (!empty($_GET['category'])){
                       echo  $getData->getPostsFromCategories($_GET['category']);
                    } elseif (!empty($_GET['post'])) {
                        echo  $getData->getPost($_GET['post']);
                    } elseif (!empty($_GET['search'])) {
                        echo $getData->findText($_GET['search']);
                    } elseif ($index_page == 'index.php' || $index_page == '' || !empty($_GET['page'])) {
                        echo $getData->getAllPosts();
                    } elseif ($index_page == '?action=logout' || $index_page == 'index.php?action=logout') {
                        header('Location: /');
                    } elseif ($index_page == '?contacts') {
                        echo $contactForm->getContactForm();
                    } elseif ($index_page == '?contacts=well') {
                        echo "<h1>Ваше сообщение отправлено!</h1><br><a href='./'>Главная страница</a>";
                    } elseif ($index_page == '?contacts=bad') {
                        echo "<h1>Ваше сообщение не было отправлено! Заполните все поля</h1><br><a href='/?contacts'>Вернуться к форме обратной связи</a>";
                    } else {
                        echo "<h1>Такой страницы нет</h1><br><a href='./'>Главная страница</a>";
                    }
                ?>


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
                        <?=$getData->getCategories()?>
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
</body>
</html>