<?
session_start();

$pdo = require("pdo.php");

// файл handler_page_register.php

function get_user_by_email($email){
    global $pdo;
    // $pdo = new PDO ("mysql:host=localhost;dbname=projectm", "root", "");
    $sql = "SELECT * FROM projectm WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    return $statement->fetch(PDO:: FETCH_ASSOC);
};

function add_user($email, $password){

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    global $pdo;
    // $pdo = new PDO ("mysql:host=localhost;dbname=projectm", "root", "");
    $sql = "INSERT INTO projectm (email, password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    return $statement->execute(['email' => $email, 'password' => $password_hashed]);
    };

function display_flash_message($name){
    if(isset($_SESSION[$name])){
        echo "<div class=\"alert alert-{$name} text-dark\"
                role=\"alert\">{$_SESSION[$name]}
            </div>";

            unset($_SESSION[$name]);
    }
};  

// файл users.php

function login($email, $password){
    // подключение к бд с юзерами

    $pdo = new PDO ("mysql:host=localhost;dbname=projectm", "root", "");
    $sql = "SELECT * FROM projectm WHERE email=:email password=:password";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email, 'password' => $password]);
    $statement->fetchAll(PDO:: FETCH_ASSOC);

      // $_SESSION['user'] = $user; ?????
}

function is_logget_in (){
    if(isset($_SESSION['user'])) { // существует такой ключ в глобальном массиве
        return true;                // если существует, значит залогенин
    }

    return false;
}

function is_not_logget_in (){ // если не залогенин, функция редирект
    return !is_logget_in();
}

function redirect_to ($path) { // откуда путь приходит ?
    header("Location: /page_login.php"); 
    exit;
}

function get_users (){ // вывести всех пользователей
    $pdo = new PDO("mysql:host=localhost;dbname=projectm_users", "root", "");
    $statement = $pdo->prepare("SELECT * FROM user"); //query ???
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function get_authenticated_user (){ // возвращает пользователя из сессии
    if(is_logget_in()){             // если залогенин
        return $_SESSION['user'];
    }
}

function is_admin ($user){ //проверка на админа
    if(is_logget_in()){
        if($user['role'] === "admin"){
            return true;
        }
        return false;
    }
}

function is_equel ($user, $current_user) {
    if($user["id"] == $current_user["id"]) {
        return true;
    }

    return false;
};