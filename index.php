<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "./config.php";

session_start();

$pdo = new PDO(
    "mysql:host={$db_host};dbname={$db_name}",
    $db_user,
    $db_user_pass
);

$user = new \App\Auth\User($pdo);
if(isset($_GET['action']) && $_GET['action'] === 'logout') $user->logout();

include "view/index.php";
