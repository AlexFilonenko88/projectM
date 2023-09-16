<?

// файл handler_page_register.php

function get_user_by_email($email){
    $pdo = new PDO ("mysql:host=localhost;dbname=projectm", "root", "");
    $sql = "SELECT * FROM projectm WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    return $statement->fetch(PDO:: FETCH_ASSOC);
};

function add_user($email, $password){

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $pdo = new PDO ("mysql:host=localhost;dbname=projectm", "root", "");
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

// файл handler_page_login.php

