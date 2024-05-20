<?php
if(!isset($_SESSION['user'])){
    header('location: index.php');
}
echo 'Admin: ' . $_SESSION['user']['username'];
