<?php include_once '../config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../inc/head.inc.php';?>
</head>
<body>
    <?php include_once '../inc/navbar.inc.php';?>

    <div class="container mt-5">
        <?php if(isset($_GET['badcombination'])): ?>
        <div class="col-md-12 alert alert-danger">
            <p class="text-center">
                Username and password does not match!
            </p>
        </div>
        <?php endif;?>

        <?php if(isset($_GET['passwordchanged'])): ?>
        <div class="col-md-12 alert alert-success">
            <p class="text-center">
                Password successfully changed! Please login using new password.
            </p>
        </div>
        <?php endif;?>
        
        <?php if(isset($_GET['login1st'])): ?>
        <div class="col-md-12 alert alert-danger">
            <p class="text-center">
                You must be logged in to access this page.
            </p>
        </div>
        <?php endif;?>

        <div class="col-md-12 jumbotron">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="authorize.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username"
                             value="<?php if(isset($_GET['username'])) { echo $_GET['username']; }?>"/>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" />
                        </div>

                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary">Log in</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

    <?php include_once '../inc/footer.inc.php';?>
    <?php include_once '../inc/scripts.inc.php';?>
</body>
</html>
