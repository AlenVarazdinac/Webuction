<?php include_once '../../config.php'; checkLogin();

if(isset($_GET['itemid'])) {
    $command = $conn->prepare('DELETE FROM item WHERE item_id=:item_id');
    $command->bindParam(':item_id', $_GET['itemid']);
    $command->execute();    
    header('location: ' . $appPath . 'private/items/my_items.php');
}