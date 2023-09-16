<?
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$pdo = new PDO ("mysql:host=localhost;dbname=projectm", "root", "");
$sql = "SELECT * FROM projectm WHERE email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email]);
$res = $statement->fetch(PDO:: FETCH_ASSOC);

if(!empty($res)){
 
    if(password_verify($password, $res['password'])){
        $_SESSION['success'] = "Добро пожаловать!";
    
        header("Location: /page_profile.php");
    } else {
        $_SESSION['error'] = 'Не верный пароль!';

        header("Location: /page_login.php");
    }
} else {
    $_SESSION['error'] = 'Пользователь не зарегистрирован!';

    header("Location: /page_register.php");
};


