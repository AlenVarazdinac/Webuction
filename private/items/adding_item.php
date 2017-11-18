<?php include_once '../../config.php'; checkLogin();

$date = date('Y-m-d H:i:s');


if(isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_price']) && isset($_POST['user_id'])) {
	$command = $conn->prepare('INSERT INTO item (item_name, item_desc, item_price, item_added_at, item_added_by) VALUES (:item_name, :item_desc, :item_price, :item_added_at, :item_added_by)');
	$command->bindParam(':item_name', $_POST['item_name']);
	$command->bindParam(':item_desc', $_POST['item_desc']);
	$command->bindParam(':item_price', $_POST['item_price']);
	$command->bindParam(':item_added_at', $date);
	$command->bindParam(':item_added_by', $_POST['user_id']);
	$command->execute();

	$lastId = $conn->lastInsertId();

	if(isset($_FILES['imgfile'])) {
		move_uploaded_file($_FILES['imgfile']['tmp_name'], "../../img/items/" . $lastId . ".jpg");
	}

	header('location: ' . $appPath . 'private/items/my_items.php');	
}

	
