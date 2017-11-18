<?php include_once '../../config.php'; checkLogin();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../inc/head.inc.php';?>
</head>

<body>
    <?php include_once '../../inc/navbar.inc.php';?>

    <?php
    $command = $conn->prepare("SELECT * FROM item WHERE item_id=:item_id");
    $command->bindParam(':item_id', $_GET['itemid']);
    $command->execute();
    $result = $command->fetch(PDO::FETCH_OBJ);
    ?>

        <div class="container mt-5">
            <h2 class="text-center">Add item</h2>
            <div class="col-md-12 jumbotron">

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form method="POST" action="editing_item.php" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="item_name">Item name</label>
                                <input type="text" class="form-control" id="item_name" name="item_name" placeholder="<?php echo $result->item_name;?>" />
                            </div>

                            <div class="form-group">
                                <label for="item_price">Item price</label>
                                <input type="number" step="0.01" class="form-control" id="item_price" name="item_price" placeholder="<?php echo $result->item_price;?>" />
                            </div>

                            <div class="form-group">
                                <label for="item_desc">Item description</label>
                                <textarea class="form-control" id="item_desc" name="item_desc" placeholder="<?php echo $result->item_desc;?>"></textarea>
                            </div>

                            <div class="row jusify-content-center">
                                <img class="col-md-5" src="../../img/items/<?php echo $result->item_id;?>.jpg" style="width: 320px; height: 220px;">
                                <div class="form-group align-bottom">
                                    <label class="custom-file col">
                                    <input type="file" name="imgfile" id="imgfile" class="custom-file-input">
                                    <span class="custom-file-control"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row justify-content-center">
                                    <button type="submit" class="btn btn-primary">Add item</button>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['logged']->user_id;?>" />
                            
                            <input type="hidden" name="item_id" value="<?php echo $result->item_id;?>" />


                        </form>
                    </div>

                </div>

            </div>

        </div>

        <?php include_once '../../inc/footer.inc.php';?>
        <?php include_once '../../inc/scripts.inc.php';?>
</body>

</html>