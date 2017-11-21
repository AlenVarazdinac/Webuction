<?php
include_once '../../config.php';

$command = $conn->prepare('SELECT * FROM bid WHERE bid_item=:bid_item ORDER BY bid_amount DESC LIMIT 1;');
$command->bindParam(':bid_item', $_POST['item_id']);
$command->execute();
$result = $command->fetch(PDO::FETCH_OBJ);
print_r($result);

$bidAmount = $_POST['bid_amount'];
echo '<br/>';
echo $bidAmount;
echo '<br/>';
echo $_POST['bid_amount'];
echo '<br/>';
echo $result->bid_amount;
echo '<br/>';

if(isset($_POST['item_id']) && isset($_POST['user_id']) && isset($_POST['bid_amount'])) {
    if($result->bid_amount < $bidAmount) {
        $command = $conn->prepare("INSERT INTO bid (bid_item, bid_user, bid_amount) VALUES (:bid_item, :bid_user, :bid_amount)");
        $command->bindParam(':bid_item', $_POST['item_id']);
        $command->bindParam(':bid_user', $_POST['user_id']);
        $command->bindParam(':bid_amount', $_POST['bid_amount']);
        $command->execute();

        header('location: auction_list.php?succbid');     
    } else {
        echo 'Bid amount must be higher than the current one';
        header('location: auction_list.php?higherbid');
    }
      
}
