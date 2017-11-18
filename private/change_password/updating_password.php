<?php include_once '../../config.php';

$command = $conn->prepare('SELECT user_pw FROM user WHERE user_id=:user_id');
$command->bindParam('user_id', $_POST['user_id']);
$command->execute();
$currentPassword = $command->fetchColumn();

$command = $conn->prepare('SELECT user_name FROM user WHERE user_id=:user_id');
$command->bindParam('user_id', $_POST['user_id']);
$command->execute();
$currentUser = $command->fetchColumn();

if(isset($_POST['currentpassword'])) {
    if(md5($_POST['currentpassword']) === $currentPassword) {

        if(isset($_POST['newpassword']) && $_POST['repassword']) {
            if($_POST['newpassword'] === $_POST['repassword']) {
                $command = $conn->prepare('UPDATE user SET user_pw=md5(:user_pw) WHERE user_id=:user_id');
                $command->bindParam('user_pw', $_POST['newpassword']);
                $command->bindParam('user_id', $_POST['user_id']);
                $command->execute();

                echo 'Password changed!';
                header('location: ' . $appPath . 'public/logout.php?passwordchanged&username=' . $currentUser);
            } else {
                echo 'Passwords does not match';
            }
        } else {
            echo 'Please enter \'New password\'.';
        }

    } else {
        echo 'You typed current password wrong!';
    }
}
