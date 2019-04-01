<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "./config.php";

session_start();

$pdo = new PDO(
    "mysql:host={$db_host}; dbname={$db_name}; charset={$charset};",
    $db_user,
    $db_user_pass
);

$user = new \App\Auth\User($pdo);
if(isset($_GET['action']) && $_GET['action'] === 'logout') $user->logout();

$getData = new \App\Database\GetData($pdo);
$contactForm = new \App\contacts\ContactForm();

$script_name = explode("/", $_SERVER['REQUEST_URI']);
$index_page = $script_name[count($script_name)-1];

include "view/index.php";



