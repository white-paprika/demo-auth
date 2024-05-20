<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location: index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>User</title>
</head>
<body>
<h1><?php echo('User: ' . $_SESSION['user']['username']) ?></h1>
<?php
print_r($_SESSION['user'])
?>
<a href="/vendor/logout.php">Log out</a>
</body>
</html>
