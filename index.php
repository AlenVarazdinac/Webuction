<?php include_once 'config.php';?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once 'inc/head.inc.php';?>
    </head>
    <body>
        <?php include_once 'inc/navbar.inc.php';?>
        
        <?php
        $command = $conn->query('SELECT count(*) c, bid_item, item_name, item_desc, item_id FROM bid a 
        LEFT JOIN item b ON bid_item=item_id
        GROUP BY bid_item HAVING COUNT(*) > 0 ORDER BY count(*) DESC;;');
        $result = $command->fetchAll(PDO::FETCH_OBJ);
        ?>

        <div class="container mt-5">
            <?php if(isset($_GET['loggedout'])): ?>
            <div class="col-md-12 alert alert-success">
                <p class="text-center">
                    You have successfully logged out.
                </p>
            </div>
            <?php endif; ?>

            <div class="col-md-12 jumbotron">
                <h1 class="text-center display-4">Welcome to <?php echo $appName;?></h1>
                <h4 class="text-center">Biggest online auction!</h4>
            </div>

            <h3 class="text-center mt-3">Hot ongoing deals!</h3>

            <div class="row justify-content-center mt-4">
                <?php foreach($result as $item): 
                $fileName = 'img/items/' . $item->item_id . '.jpg';
                if(!file_exists($fileName)) {
                    $fileName = 'img/items/no-item-image.png'; } 
                ?>
                <div class="card mr-md-2" style="width: 20rem;">
                    <img class="card-img-top" src="<?php echo $fileName;?>" alt="item_image">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $item->item_name;?></h4>
                        <p class="card-text"><?php echo $item->item_desc;?></p>
                        <p class="card-text"><?php echo $item->c;?> Bids</p>
                        <a href="#" class="btn btn-primary">Show</a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>

        </div>

        <?php include_once 'inc/footer.inc.php';?>

        <?php include_once 'inc/scripts.inc.php';?>
    </body>
</html>
