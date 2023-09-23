<?

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

function login(){
    // подключение к бд
    // $_SESSION['user'] = $user;
}

function is_logget_in (){
    if(isset($_SESSION['user'])) { // существует такой ключ в глобальном массиве
        return true;
    }

    return false;
}

function is_not_logget_in (){
    return !is_logget_in();
}

function redirect_to ($path) {
    var_dump('redirect to $path');
    exit;
}

function get_users (){
    // подключение к бд
    $pdo = new PDO("mysql:host=localhost;dbname=projectm_users", "root", "");
    $statement = $pdo->prepare("SELECT * FROM user");
    return $statement->fetchAll(PDO::FETCH_ASSOC); // !!!! передать
}

function get_authenticated_user (){ // возвращает пользователя
    if(is_logget_in()){
        return $_SESSION['user'];
    }
}

function is_admin ($user){
    if(is_logget_in()){
        if($user['role' === "admin"]){
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