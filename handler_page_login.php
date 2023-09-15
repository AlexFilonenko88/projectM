<?

$password_hashed1 = password_hash($password, PASSWORD_DEFAULT);

$pdo = new PDO ("mysql:host=localhost;dbname=projectm", "root", "");
$sql = "SELECT * FROM projectm WHERE password=:password";
$statement = $pdo->prepare($sql);
$statement->execute(['password' => $password_hashed1]);
$res = $statement->fetch(PDO:: FETCH_ASSOC);

//1пользовательский пароь, 2хэш пароля
if(!password_verify($password_hashed1, $res['password'])){
    $_SESSION['danger'] = "Этот ПАРОЛЬ уже занят другим пользователем.";

    header("Location; /page_register.php");
    die();
};