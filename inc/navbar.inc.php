<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $appPath;?>index.php"><?php echo $appName;?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $appPath;?>index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php if(isset($_SESSION['logged'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $appPath;?>private/auction/auction_list.php">Auctions</a>
                    </li>
                <?php endif;?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $appPath;?>public/about.php">About</a>
                </li>
            </ul>

            <?php if(!isset($_SESSION['logged'])): ?>
                <a class="btn btn-outline-success my-2 my-sm-0 mx-1" href="<?php echo $appPath;?>public/login.php">Log in</a>
                <a class="btn btn-outline-primary my-2 my-sm-0 mx-1" href="<?php echo $appPath;?>public/register.php">Register</a>
            <?php else: ?>
                <ul class="navbar-nav mr-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if(isset($_SESSION['logged']->user_name)) { echo $_SESSION['logged']->user_name; }?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo $appPath;?>private/profile.php">Profile</a>
                            <a class="dropdown-item" href="<?php echo $appPath;?>private/items/my_items.php">My items</a>
                            <a class="dropdown-item" href="<?php echo $appPath;?>private/change_password/new_password.php">Change password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Admin panel</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item btn btn-outline-danger" href="<?php echo $appPath;?>public/logout.php">Log out</a>
                        </div>
                    </li>
                </ul>
            <?php endif;?>

        </div>
    </div>

</nav>
