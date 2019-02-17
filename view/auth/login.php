<?php

?>

<div id="show-target">
    <a href="#" onclick="event.preventDefault()">Авторизация</a>
</div>

<section class="auth-form">
    <span>Авторизация</span>
    <form action="index.php" method="post">
        <input type="text" name="login" placeholder="Ваш логин" required>
        <input type="password" name="password" placeholder="Ваш пароль" required>
        <div class="auth-buttons">
            <button>Вход</button>
            <button id="hide-target" onclick="event.preventDefault()">Скрыть</button>
        </div>
    </form>
</section>
