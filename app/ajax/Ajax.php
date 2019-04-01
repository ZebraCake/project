<?php
/**
 * Created by PhpStorm.
 * User: win9
 * Date: 15.03.2019
 * Time: 15:26
 */

namespace App\Ajax;


class  Ajax
{
    public function createPostAjax()
    {

        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            move_uploaded_file($_FILES['file']['tmp_name'], '/assets/images/' . $_FILES['file']['name']);
        }
    }
}

Ajax::createPostAjax();