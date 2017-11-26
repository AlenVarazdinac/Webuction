<?php include_once '../../config.php'; checkLogin();

/* Set auction starting date */
$date = date('Y-m-d H:i:s');
if($_POST['auction_start_type']=='now') {
    $startingDate = $date;
    $itemLive = 1;
} else {
    if($_POST['auction_start']<$date) {
        $startingDate = $date;
        $itemLive = 1;
    } else {
        $startingDate = $_POST['auction_start'];
        $itemLive = 0;
    }
}

/* Configure auction length */
switch($_POST['auction_end']){
    case 24:
        $auctionLength = date('Y-m-d H:i:s', strtotime($startingDate . ' + 1 days'));
        break;
    case 48:
        $auctionLength = date('Y-m-d H:i:s', strtotime($startingDate . ' + 2 days'));
        break;
    case 72:
        $auctionLength = date('Y-m-d H:i:s', strtotime($startingDate . ' + 3 days'));
        break;
    default:
        break;
}


if(isset($_POST['item_name']) && isset($_POST['item_starting_price']) && isset($_POST['item_desc']) && isset($_POST['auction_start']) && isset($_POST['auction_end']) && isset($_POST['user_id'])) {
    
    $command = $conn->prepare('INSERT INTO item 
    (item_name, item_desc, item_starting_price, item_added_at, item_starting_at, item_ending_at, item_added_by, item_highest_bid, item_live) 
    VALUES (:item_name, :item_desc, :item_starting_price, :item_added_at, :item_starting_at, :item_ending_at, :item_added_by, :item_highest_bid, :item_live)');
    $command->bindParam(':item_name', $_POST['item_name']);
    $command->bindParam(':item_desc', $_POST['item_desc']);
    $command->bindParam(':item_starting_price', $_POST['item_starting_price']);
    $command->bindParam(':item_added_at', $date);
    $command->bindParam(':item_starting_at', $startingDate);
    $command->bindParam(':item_ending_at', $auctionLength);
    $command->bindParam(':item_added_by', $_POST['user_id']);
    $command->bindParam(':item_highest_bid', $_POST['item_starting_price']);
    $command->bindParam(':item_live', $itemLive);
    $command->execute();
    
    $lastId = $conn->lastInsertId();

	if(isset($_FILES['imgfile'])) {
		move_uploaded_file($_FILES['imgfile']['tmp_name'], "../../img/items/" . $lastId . ".jpg");
	}

	header('location: ' . $appPath . 'private/items/my_items.php');	
    
}





/*

if(isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_starting_price']) && isset($_POST['user_id']) && isset($_POST['item_live'])) {    
	$command = $conn->prepare('INSERT INTO item (item_name, item_desc, item_starting_price, item_added_at, item_added_by, item_highest_bid, item_live) VALUES (:item_name, :item_desc, :item_starting_price, :item_added_at, :item_added_by, :item_highest_bid, :item_added_at, :item_ending_at)');
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

	
*/