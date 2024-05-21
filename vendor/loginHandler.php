<?php
session_start(); // Запускаем сессию (чтобы работал массив $_SESSION, который используется для авторизации)
/**
 * После того, как мы отправили форму на странице логина (index.php), у которой:
 * 1. В action указан данный файл (loginHandler.php)
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
if(!isset($_POST['password'])){
    echo 'необходимо передать password';
    die(); //
}

// 3. Проверяем, существует ли такой пользователь в таблице users нашей БД
$email = $_POST['email'];
$password = md5($_POST['password']); // шифруем пароль
/**
 * Подключение к базе данных
 * mysqli_connect($hostname, $username, $password, $database)
 * По дефолту такие значения: mysqli_connect('localhost', 'root', '', 'название_вашей_бд')
 */
$connection = mysqli_connect('localhost', 'user', 'xsdcwe23', 'demo');
/**
 * mysqli_query($подключение, $запрос)
 * В $check_user приходит сырой результат запроса, который нужно преобразовать в ассоциативный массив функцей mysqli_fetch_assoc
 */
$check_user = mysqli_query($connection, "SELECT * FROM personal_data WHERE email = '$email' AND password = '$password'"); // отправляем запрос

// В переменную $user придет массив пользователей, которых мы получили в сыром виде строкой выше
$user = mysqli_fetch_assoc($check_user);

// проверяем, что в $check_user пришел как минимум 1 пользователь из БД
if (mysqli_num_rows($check_user) > 0) { // Возвращает количество строк, которые вернул запрос check_user

    //  записываем данные о пользователе в сессию, чтобы использовать их на странице пользователя или админа
    $_SESSION['user'] = [
        'email' => $user['email'],
        'login' => $user['login'],
    ]; // Присваивает после обновления страницы

} else {
    echo 'неправильная почта или пароль';
    die();
}

header('Location: /user.php');