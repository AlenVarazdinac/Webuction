<?php

function checkLogin() {
    if(!isset($_SESSION['logged'])) {
        header('location: ' . $GLOBALS['appPath'] . 'public/login.php?login1st');
        exit;
    }
}

function checkRole($role) {
    if(!(isset($_SESSION['logged']) && $_SESSION['logged']->user_right===$role)) {
        header('location: ' . $GLOBALS['appPath'] . 'index.php');
        exit;
    }
}