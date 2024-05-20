<?php
session_start(); // Запускаем сессию (чтобы работал массив $_SESSION, который используется для авторизации)
/**
 * После того, как мы отправили форму на странице логина (register.php), у которой:
 * 1. В action указан данный файл (registerHandler.php)
 * 2. В method указан POST
 * В данном файле доступен глобальный массив $_POST, который хранит данные с инпутов формы под ключами, которые
 * указаны в атрибутах name
 */

// 1. Проверяем, была ли отправлена форма методом POST
if(!isset($_POST['submit'])){         // если форма НЕ была отправлена:
    echo 'форма не была отправлена';  // выводим сообщение
    die();                            // прерываем выполнение скрипта
}

// 2. Проверяем, были ли отправлены остальные поля
if(!isset($_POST['email'])){
    echo 'необходимо передать email';
    die(); //
}
if(!isset($_POST['username'])){
    echo 'необходимо передать username';
    die(); //
}
if(!isset($_POST['password'])){
    echo 'необходимо передать password';
    die(); //
}

// 3. Проверяем, чтобы в БД не было аккаунта с нашим email
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']); // шифруем пароль
/**
 * Подключение к базе данных
 * mysqli_connect($hostname, $username, $password, $database)
 * По дефолту такие значения: mysqli_connect('localhost', 'root', '', 'название_вашей_бд')
 */
$connection = mysqli_connect('localhost', 'user', 'xsdcwe23', 'auth');
/**
 * mysqli_query($подключение, $запрос)
 * В $check_user приходит сырой результат запроса, который нужно преобразовать в ассоциативный массив функцей mysqli_fetch_assoc
 */
$check_user = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'"); // отправляем запрос

// В переменную $user придет массив пользователей, которых мы получили в сыром виде строкой выше
$user = mysqli_fetch_assoc($check_user);
//mysqli_close($connection);
// если уже есть пользователь с такой почтой, отказываем в создании аккаунта
if (mysqli_num_rows($check_user) >= 1) { // Возвращает количество строк, которые вернул запрос check_user
    echo 'почта занята';
    die();
}

// добавляем нового юзера или кидаем ошибку
mysqli_query($connection, "INSERT INTO `users` (`email`,`username`,`password`, `is_admin`) 
                         VALUES ('$email','$username','$password', 0)") or die(mysqli_error($connection));

//  записываем данные о пользователе в сессию, чтобы использовать их на странице пользователя
$_SESSION['user'] = [
    'email' => $email,
    'username' => $username,
]; // Присваивает после обновления страницы


// 5. Редиректим на страницу юзера
header('Location: /user.php');
