<?php
if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['text'])) {
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $text = trim(htmlspecialchars($_POST['text']));

    $to = "win9@ya.ru";
    $subject = "Псиьмо с {$_SERVER['SERVER_NAME']}";
    $message = "Вам написал: {$name}<br>";
    $message .= "Его почта: {$email}<br>";
    $message .= "Текст сообщения: {$text}";

    $headers= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: {$_SERVER['SERVER_NAME']} <admin@{$_SERVER['SERVER_NAME']}>\r\n";

    mail($to, $subject, $message, $headers);

    header('Location: /?contacts=well');
    exit();
} else {
    header('Location: /?contacts=bad');
    exit();
}
