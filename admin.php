<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location: index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Admin</title>
</head>
<body>
    <h1><?php echo('Admin: ' . $_SESSION['user']['username']) ?></h1>
    <a href="/vendor/logout.php">Log out</a>
</body>
</html>
