<?
session_start();

require "functions.php";

$email = $_POST['email'];
$password = $_POST['password'];

$user = login($email);

if(!empty($user)){
    if(password_verify($password, $user['password'])){
        $_SESSION['success'] = "Добро пожаловать!";
        // $_SESSION['user'] = $user;
    
        header("Location: /users.php");
    } else {
        $_SESSION['error'] = 'Не верный пароль!';

        header("Location: /page_login.php");
    }
} else {
    $_SESSION['error'] = 'Пользователь не зарегистрирован!';

    header("Location: /page_register.php");
};


