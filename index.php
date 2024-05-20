<!--
index.php - стартовая страница приложения. Она должна находится в корне папки проекта.
На ней реализована страница login (вход в аккаунт)
-->
<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
</head>

<!--
Форма входа
action="путь к файлу, который будет обрабатывать данные, отправленные с формы"
method="метод отправки данных"
-->
<form action="vendor/loginHandler.php" method="POST">
    <!--
    name - обязательный атрибут, который обозначает ключ,
    по которому в обработчике (loginHandler.php) мы сможем достать отпраленные из этого инпута данные
    -->
    <p>Email</p>
    <input type="text" name="email"><br>


    <p>Password</p>
    <input type="password" name="password"><br>


    <!--
    Кнопка отправки данных. У нее тоже есть атрибут name,
    чтобы потом по нему можно было проверить, была ли отправлена форма
    -->
    <input type="submit" name="submit" value="Войти">


    <!--  Кнопка для перехода на страницу регистрации  -->
    <a href="register.php">Register</a>
</form>
</html>
