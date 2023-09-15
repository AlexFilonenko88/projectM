<?php
session_start();

require "functions.php";

$email = $_POST['email'];
$password = $_POST["password"];

$user = get_user_by_email($email);

if(!empty($user)){
    $_SESSION['danger'] = "Этот эл. адрес уже занят другим пользователем.";

    header("Location: /page_register.php");
    die();
};

add_user($email, $password);

$_SESSION['success'] = 'Пользователь зарегистрирован!';

header("Location: /page_login.php");
