<?php include_once '../../config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../../inc/head.inc.php';?>
</head>
<body>
    <?php include_once '../../inc/navbar.inc.php';?>

    <div class="container mt-5">
        <h2 class="text-center">Add item</h2>
        <div class="col-md-12 jumbotron">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="adding_item.php" 
                    enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="item_name">Item name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter item name"/>
                        </div>

                        <div class="form-group">
                            <label for="item_price">Item price</label>
                            <input type="number" step="0.01" class="form-control" id="item_price" name="item_price" placeholder="Enter item price"/>
                        </div>

                        <div class="form-group">
                            <label for="item_desc">Item description</label>
                            <textarea class="form-control" id="item_desc" name="item_desc" placeholder="Enter item description"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="custom-file col-md-12">
                            <input type="file" name="imgfile" id="imgfile" class="custom-file-input">
                            <span class="custom-file-control"></span>
                            </label>
                        </div>

                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary">Add item</button>
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
