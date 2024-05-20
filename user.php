<?php
if(!isset($_SESSION['user'])){
    header('location: index.php');
}
echo 'User: ' . $_SESSION['user']['username'];