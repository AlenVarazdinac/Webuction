<?php include_once '../../config.php'; checkLogin();

$date = date('Y-m-d H:i:s');

if(isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_starting_price']) && isset($_POST['user_id']) && isset($_POST['item_live'])) {    
	$command = $conn->prepare('INSERT INTO item (item_name, item_desc, item_starting_price, item_added_at, item_added_by, item_highest_bid, item_live) VALUES (:item_name, :item_desc, :item_starting_price, :item_added_at, :item_added_by, :item_highest_bid, :item_live)');
	$command->bindParam(':item_name', $_POST['item_name']);
	$command->bindParam(':item_desc', $_POST['item_desc']);
	$command->bindParam(':item_starting_price', $_POST['item_starting_price']);
	$command->bindParam(':item_added_at', $date);
	$command->bindParam(':item_added_by', $_POST['user_id']);
    $command->bindParam(':item_highest_bid', $_POST['item_starting_price']);
    $command->bindParam(':item_live', $_POST['item_live']);
	$command->execute();
    
	$lastId = $conn->lastInsertId();

	if(isset($_FILES['imgfile'])) {
		move_uploaded_file($_FILES['imgfile']['tmp_name'], "../../img/items/" . $lastId . ".jpg");
	}

	header('location: ' . $appPath . 'private/items/my_items.php');	
}

	
