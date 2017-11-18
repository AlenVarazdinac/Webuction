<?php include_once '../../config.php'; checkLogin();

if(isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_price']) && isset($_POST['user_id']) && isset($_POST['item_id'])) {
    $command = $conn->prepare('UPDATE item SET item_name=:item_name, item_desc=:item_desc, item_price=:item_price WHERE item_id=:item_id');
	$command->bindParam(':item_name', $_POST['item_name']);
	$command->bindParam(':item_desc', $_POST['item_desc']);
	$command->bindParam(':item_price', $_POST['item_price']);
	$command->bindParam(':item_id', $_POST['item_id']);
	$command->execute();

	if(isset($_FILES['imgfile'])) {
		move_uploaded_file($_FILES['imgfile']['tmp_name'], "../../img/items/" . $_POST['item_id'] . ".jpg");
	}

	header('location: ' . $appPath . 'private/items/my_items.php');	
}

	
