<?php
session_start();

$email = $_POST['email'];
$password = $_POST["password"];

$pdo = new PDO ("mysql:host=localhost;dbname=projectm", "root", "");
$sql = "SELECT * FROM projectm WHERE email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email]);
$res = $statement->fetch(PDO:: FETCH_ASSOC);

if(!empty($res)){
    $_SESSION['error'] = "Этот эл. адрес уже занят другим пользователем.";

    header("Location: /page_register.php");
    die();
};

$sql = "INSERT INTO projectm (email, password) VALUES (:email, :password)";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email, 'password' => $password]);

$_SESSION['success'] = "Регистриция успешна!";

header("Location: /page_login.php");
