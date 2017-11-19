<?php include_once '../config.php'; checkLogin();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/head.inc.php';?>
</head>

<body>
    <?php include_once '../inc/navbar.inc.php';?>

    <?php
    $command = $conn->query('SELECT * FROM item a
        LEFT JOIN user b ON a.item_added_by=b.user_id WHERE a.item_live=1;');
    $result = $command->fetchAll(PDO::FETCH_OBJ);
    
    ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <?php foreach($result as $item): 
                $fileName = '../img/items/' . $item->item_id . '.jpg';
                if(!file_exists($fileName)) {
                    $fileName = '../img/items/no-item-image.png';
                }
                ?>
                <div class="card mr-1 mt-2" style="width: 20rem;">
                    <img class="card-img-top" src="<?php echo $fileName;?>" alt="Item image" style="width: 320px; height: 220px;" />
                    
                    <div class="card-body">
                        <h4 class="card-title text-center">
                            <?php echo $item->item_name;?>
                        </h4>
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center">Current bid - $<?php echo $item->item_highest_bid;?>
                        </li>
                    </ul>
                    
                    <div class="card-body row justify-content-center">
                        <a href="#" class="card-link">Show</a>
                        <a href="#" class="card-link">Bid</a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>




        <?php include_once '../inc/footer.inc.php';?>
        <?php include_once '../inc/scripts.inc.php';?>
</body>

</html>