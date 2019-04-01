<?php
/**
 * Created by PhpStorm.
 * User: win9
 * Date: 19.03.2019
 * Time: 1:10
 */

namespace App\Contacts;


class ContactForm

{

    public function getContactForm () {
        $html = "
            <section class=\"contact-form\">
                <h1>Форма обратной связи</h1>
                <form action=\"mail.php\" method=\"post\">
                    <label for=\"name\">Ваше имя:</label>
                    <input type=\"text\" id=\"name\" name=\"name\" required>
                    <label for=\"email\">Ваш e-mail:</label>
                    <input type=\"email\" id=\"email\" name=\"email\" required>
                    <label for=\"text\">Ваше сообщение:</label>
                    <textarea name=\"text\" id=\"text\" cols=\"30\" rows=\"10\" required></textarea>
                    <div class='buttons'>
                        <button>Отправить</button>
                        <button type='reset'>Очистить</button>
                    </div>
                </form>
            </section>";
        return $html;
    }



}