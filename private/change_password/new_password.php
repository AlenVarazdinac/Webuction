<?php include_once '../../config.php'; checkLogin();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../../inc/head.inc.php';?>
</head>
<body>
    <?php include_once '../../inc/navbar.inc.php';?>

    <div class="container mt-5">
        <div class="col-md-12 jumbotron">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="updating_password.php">

                        <div class="form-group">
                            <label for="currentpassword">Current password</label>
                            <input type="password" class="form-control" id="currentpassword" name="currentpassword" placeholder="Enter current password"/>
                        </div>

                        <div class="form-group">
                            <label for="newpassword">New password</label>
                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter new password"/>
                        </div>

                        <div class="form-group">
                            <label for="repassword">Re-type new password</label>
                            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Enter new password again" />
                        </div>

                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary">Change password</button>
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['logged']->user_id;?>"/>

                    </form>
                </div>

            </div>

        </div>

    </div>

    <?php include_once '../../inc/footer.inc.php';?>
    <?php include_once '../../inc/scripts.inc.php';?>
</body>
</html>
