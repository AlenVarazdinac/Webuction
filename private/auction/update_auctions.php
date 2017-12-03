<?php

include_once '../../config.php';

$command = $conn->prepare('UPDATE item SET item_live=0 WHERE item_id=:item_id;');
$command->bindParam(':item_id', $_POST['itemid']);
$command->execute();
echo 'Hello' . '<br/>';