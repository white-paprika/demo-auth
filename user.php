<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location: index.php');
}
$email = $_SESSION['user']['email'];

$connection = mysqli_connect('localhost', 'user', 'xsdcwe23', 'demo');
// получаем сертификаты
$check_certificates = mysqli_query($connection, "SELECT c.ID, c.certificate_number, p.login FROM personal_data p JOIN certificates c ON c.ID_personal_data = p.id WHERE p.email = '$email'"); // отправляем запрос

$certificates = mysqli_fetch_all($check_certificates);
?>
<!doctype html>
<html lang="en">
<head>
    <title>User</title>
</head>
<body>
<h1><?php echo('User: ' . $_SESSION['user']['login']) ?></h1>
<?php
print_r($_SESSION['user'])
?>

<table>
    <tr>
        <th>id</th>
        <th>certificate number</th>
        <th>login</th>
    </tr>
    <?php
        foreach ($certificates as $certificate) {
            echo "<tr>";
                echo '<td>' . $certificate[0] . '</td>';
                echo '<td>' . $certificate[1] . '</td>';
                echo '<td>' . $certificate[2] . '</td>';
            echo "</tr>";
        }
    ?>
</table>
<a href="/vendor/logout.php">Log out</a>
</body>
</html>
