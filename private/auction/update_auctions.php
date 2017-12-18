<?php

include_once '../../config.php';

$conn->beginTransaction();

/* Remove item from auctions */
$command = $conn->prepare('UPDATE item SET item_live=0 WHERE item_id=:item_id;');
$command->bindParam(':item_id', $_POST['itemid']);
$command->execute();

/* Select buyer that bid the most and the bid amount */
$command = $conn->prepare('SELECT bid_id, bid_by, bid_item, MAX(bid_amount) AS bid_amount FROM bid WHERE bid_item=5 GROUP BY bid_by ORDER BY bid_amount DESC LIMIT 1;');

$command->bindParam(':item_id', $_POST['itemid']);
$command->execute();
while($row = $command->fetch(PDO::FETCH_ASSOC)) {
    $buyer = $row['bid_by'];
    $bidAmount = $row['bid_amount'];
}

/* Select item seller */
$command = $conn->prepare('SELECT item_id, item_owner FROM item WHERE item_id=:item_id;');
$command->bindParam(':item_id', $_POST['itemid']);
$command->execute();
while($row = $command->fetch(PDO::FETCH_ASSOC)) {
    $seller = $row['item_owner'];
}

/* Transfer money from Buyer to Seller */
/* Remove money from buyers balance */
$command = $conn->prepare('UPDATE user SET user_balance=user_balance - :balance WHERE user_id=:user_id;');
$command->bindParam(':balance', $bidAmount);
$command->bindParam(':user_id', $buyer);
$command->execute();

/* Add money to sellers balance */
$command = $conn->prepare('UPDATE user SET user_balance=user_balance + :balance WHERE user_id=:user_id;');
$command->bindParam(':balance', $bidAmount);
$command->bindParam(':user_id', $seller);
$command->execute();

/* Move item from Seller to Buyer */
/* Add item to buyers inventory */
$command = $conn->prepare('UPDATE inventory SET inventory_owner=:inventory_owner WHERE inventory_item=:inventory_item;');
$command->bindParam(':inventory_owner', $buyer);
$command->bindParam(':inventory_item', $_POST['itemid']);
$command->execute();

/* Change item owner */
$command = $conn->prepare('UPDATE item SET item_owner=:item_owner');
$command->bindParam(':item_owner', $buyer);
$command->execute();

$conn->commit();

