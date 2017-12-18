<?php include_once '../config.php';

if(!isset($_POST['username']) || !isset($_POST['username'])) {
    header('location: ' . $appPath . 'index.php');
}

$command = $conn->prepare('SELECT * FROM user WHERE user_name=:username AND user_pw=md5(:password)');
$command->execute(array('username' => $_POST['username'], 'password' => $_POST['password']));
$user = $command->fetch(PDO::FETCH_OBJ);

if($user!=null) {
    $_SESSION['logged'] = $user;
    header('location: ' . $appPath . 'private/profile.php');
} else {
    header('location: ' . $appPath . 'public/login.php?badcombination&username=' . $_POST['username']);
}
