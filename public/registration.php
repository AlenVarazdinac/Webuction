<?php include_once '../config.php';

echo $_POST['username'];
echo '<br/>';
echo $_POST['email'];
echo '</br/>';
echo $_POST['password'];
echo '</br/>';

if(isset($_POST['username']) && $_POST['email'] && $_POST['password']) {
    $command = $conn->prepare('INSERT INTO user (user_name, user_email, user_pw) VALUES (:user_name, :user_email, md5(:user_pw))');
    $command->bindParam(':user_name', $_POST['username']);
    $command->bindParam(':user_email', $_POST['email']);
    $command->bindParam(':user_pw', $_POST['password']);
    $command->execute();

    header('location: ' . $appPath . 'private/profile.php');
} else {
    header('location: ' . $appPath . 'public/register.php?notset');
}
