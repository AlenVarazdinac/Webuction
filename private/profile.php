<?php include_once '../config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../inc/head.inc.php';?>
</head>
<body>
    <?php include_once '../inc/navbar.inc.php';?>

    <?php 
    $command = $conn->prepare("SELECT * FROM user WHERE user_id=:user_id");
    $command->bindParam(':user_id', $_SESSION['logged']->user_id);
    $command->execute();
    $result = $command->fetch(PDO::FETCH_OBJ);
    ?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid img-thumbnail" alt="profile_picture" src="<?php echo $appPath;?>img/profile/no_img.png" />
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <small class="align-self-center mr-3 ml-3 ml-md-0">Username</small>
                            <h3><?php echo $result->user_name;?></h3>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include_once '../inc/footer.inc.php';?>
    <?php include_once '../inc/scripts.inc.php';?>
</body>
</html>
