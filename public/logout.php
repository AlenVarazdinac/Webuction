<?php include_once '../config.php';

session_destroy();
if(isset($_GET['passwordchanged'])) {
    header('location: ' . $appPath . 'public/login.php?passwordchanged&username=' . $_GET['username']);
} else {
    header('location: ' . $appPath . 'index.php?loggedout');
}
