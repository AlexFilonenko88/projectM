<?

$name = $_POST['username'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$email = $_POST['email'];
$password = $_POST['password'];
$vk = $_POST['vk'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];

// var_dump($vk);
// var_dump($telegram);
// die();

function add_user ($email, $password) { 
//добавить пользователя
// возвр id пользователя

    $pdo = new PDO ("mysql:host=localhost;dbname=projectm_users", "root", "");
    $sql = "INSERT INTO projectm_users (email, password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email, 'password' => $password]);
    // var_dump($statement);
    // die();
};

function edit_information ($username, $job_title, $phone, $address) {
// редактирует профиль
// возвращает буль
};

function set_status ($status) {
// устанавливает статус
// возвр null 
};

function upload_avatar ($image) {
// загрузить аватар
//взвр null || string (path)
};

function add_social_links ($telegram, $instagram, $vk) {
// доб ссылка на соц сети
// возв null
};