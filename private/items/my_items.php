<?php include_once '../../config.php'; checkLogin();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../inc/head.inc.php';?>
</head>

<body>
    <?php include_once '../../inc/navbar.inc.php';?>

    <?php
  $command = $conn->prepare("SELECT item_id, item_name, item_desc, item_starting_price, item_owner, item_added_at, item_starting_at, item_ending_at, item_live, bid_id, bid_by, bid_item, MAX(bid_amount) AS bid_amount FROM item a
  LEFT JOIN bid b ON b.bid_item=a.item_id WHERE item_owner=:user_id AND item_live=1 GROUP BY item_id;");
  $command->bindParam(":user_id", $_SESSION['logged']->user_id);
  $command->execute();  
  $result = $command->fetchAll(PDO::FETCH_OBJ);
  ?>

        <div class="container mt-5">
            <!-- ##### List all item you have for sale ##### -->
            <div class="row justify-content-around mb-5">
                <h2 class="col-md-8">Items on auction</h2>
                <a class="col-md-2 btn btn-primary" href="add_item.php">+ Add item</a>
            </div>


            <div class="row justify-content-center">
                <?php foreach($result as $item): 
       
        $fileName = '../../img/items/' . $item->item_id . '.jpg';
        if(!file_exists($fileName)) {
            $fileName = '../../img/items/no-item-image.png';
        } ?>

                <div class="card mr-1" style="width: 20rem;">
                    <img class="card-img-top" src="<?php echo $fileName;?>" alt="Item image" style="width: 320px; height: 220px;" />
                    <div class="card-body">
                        <h4 class="card-title text-center">
                            <?php echo $item->item_name;?>
                        </h4>
                        <p class="card-text text-center">
                            <?php echo $item->item_desc;?>
                        </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center">Starting price - $<?php echo $item->item_starting_price;?>
                        </li>
                        <li class="list-group-item text-center"><?php
                            if(empty($item->bid_amount)) {echo 'No bids';} else {echo 'Highest bid - $' . $item->bid_amount;}
                            ?>
                        </li>
                    </ul>
                    <div class="card-body row justify-content-center">
                        <a href="#" class="card-link">Show</a>
                        <a href="edit_item.php?itemid=<?php echo $item->item_id;?>" class="card-link">Edit</a>
                        <a href="remove_item.php?itemid=<?php echo $item->item_id;?>" class="card-link">Remove</a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 mt-5">
                    <hr/>
                </div>
            </div>

            <?php
            $command = $conn->prepare('SELECT * FROM inventory a 
LEFT JOIN item b ON a.inventory_item=b.item_id 
LEFT JOIN bid c ON c.bid_item=b.item_id WHERE inventory_owner=:inventory_owner AND item_live=0 GROUP BY item_id ORDER BY bid_amount DESC;');
            $command->bindParam(':inventory_owner', $_SESSION['logged']->user_id);
            $command->execute();
            $invResult = $command->fetchAll(PDO::FETCH_OBJ);
            
            ?>
                <!-- ##### List all item you have purchased ##### -->
                <div class="row justify-content-left">
                    <h2 class="col-md-12 ml-5">Purchased items</h2>
                </div>

                <div class="row justify-content-center">
                    <?php foreach($invResult as $invItem): 
       
        $fileName = '../../img/items/' . $invItem->item_id . '.jpg';
        if(!file_exists($fileName)) {
            $fileName = '../../img/items/no-item-image.png';
        } ?>

                    <div class="card mr-1" style="width: 20rem;">
                        <img class="card-img-top" src="<?php echo $fileName;?>" alt="Item image" style="width: 320px; height: 220px;" />
                        <div class="card-body">
                            <h4 class="card-title text-center">
                                <?php echo $invItem->item_name;?>
                            </h4>
                            <p class="card-text text-center">
                                <?php echo $invItem->item_desc;?>
                            </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-center">Paid - $<?php echo $invItem->bid_amount;?>
                            </li>
                        </ul>
                        <!-- 
                        <div class="card-body row justify-content-center">
                            <a href="edit_item.php?itemid=<?php echo $invItem->item_id;?>" class="card-link">Edit</a>
                        </div>
                        -->
                    </div>
                    <?php endforeach;?>
                </div>

        </div>

        <?php include_once '../../inc/footer.inc.php';?>
        <?php include_once '../../inc/scripts.inc.php';?>
</body>

</html>