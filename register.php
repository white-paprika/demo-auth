<!--
index.php - стартовая страница приложения. Она должна находится в корне папки проекта.
На ней реализована страница register (регистрация)
-->
<!doctype html>
<html lang="en">
<head>
    <title>Register</title>
</head>

<!--
Форма регистрации
-->
<form action="vendor/registerHandler.php" method="POST">

    <p>Email</p>
    <input type="text" name="email"><br>

    <p>Username</p>
    <input type="text" name="login"><br>

    <p>Password</p>
    <input type="password" name="password"><br>


    <!--
    Кнопка отправки данных. У нее тоже есть атрибут name,
    чтобы потом по нему можно было проверить, была ли отправлена форма
    -->
    <input type="submit" name="submit" value="Зарегистрироваться">


    <!--  Кнопка для перехода на страницу логина  -->
    <a href="index.php">Login</a>
</form>
</html>
