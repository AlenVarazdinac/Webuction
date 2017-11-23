<?php include_once '../../config.php'; checkLogin();

$command = $conn->prepare('SELECT * FROM item WHERE item_id=:item_id');
$command->bindParam(':item_id', $_POST['item_id']);
$command->execute();

while($row = $command->fetch(PDO::FETCH_ASSOC)) {
    $itemName = $row['item_name'];
    $itemDesc = $row['item_desc'];
    $itemStartingPrice = $row['item_starting_price'];
}

if(!empty($_POST['item_name'])) {
    $itemName = $_POST['item_name'];
} 

if(!empty($_POST['item_desc'])) {
    $itemDesc = $_POST['item_desc'];
}

if(!empty($_POST['item_starting_price'])) {
    $itemStartingPrice = $_POST['item_starting_price'];
}



if(isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_starting_price']) && isset($_POST['user_id']) && isset($_POST['item_id'])) {
    $command = $conn->prepare('UPDATE item SET item_name=:item_name, item_desc=:item_desc, item_starting_price=:item_starting_price, item_highest_bid=:item_highest_bid WHERE item_id=:item_id');
	$command->bindParam(':item_name', $itemName);
	$command->bindParam(':item_desc', $itemDesc);
	$command->bindParam(':item_starting_price', $itemStartingPrice);
    $command->bindParam(':item_highest_bid', $itemStartingPrice);
	$command->bindParam(':item_id', $_POST['item_id']);
	$command->execute();

	if(isset($_FILES['imgfile'])) {
		move_uploaded_file($_FILES['imgfile']['tmp_name'], "../../img/items/" . $_POST['item_id'] . ".jpg");
	}

	header('location: ' . $appPath . 'private/items/my_items.php');	
}

	
