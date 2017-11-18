<?php include_once '../../config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once '../../inc/head.inc.php';?>
</head>
<body>
  <?php include_once '../../inc/navbar.inc.php';?>

  <?php
  $command = $conn->prepare("SELECT * FROM item WHERE item_added_by=:user_id");
  $command->bindParam(":user_id", $_SESSION['logged']->user_id);
  $command->execute();
  $result = $command->fetchAll(PDO::FETCH_OBJ)
  ?> 

  <div class="container mt-5">
   <div class="row justify-content-around mb-5">
     <h2 class="col-md-8">Items you own</h2>
     <a class="col-md-2 btn btn-primary" href="add_item.php">+ Add item</a>
   </div>


   <div class="row justify-content-center">
    <?php foreach($result as $item): ?>
      <div class="card mr-1" style="width: 20rem;">
        <img class="card-img-top" src="../../img/items/<?php echo $item->item_id;?>.jpg" alt="Item image">
        <div class="card-body">
          <h4 class="card-title text-center"><?php echo $item->item_name;?></h4>
          <p class="card-text text-center"><?php echo $item->item_desc;?></p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item text-center">$<?php echo $item->item_price;?></li>
        </ul>
        <div class="card-body row justify-content-center">
          <a href="#" class="card-link">Show</a>
          <a href="#" class="card-link">Edit</a>
        </div>
      </div>
    <?php endforeach;?>
  </div>

</div>

<?php include_once '../../inc/footer.inc.php';?>
<?php include_once '../../inc/scripts.inc.php';?>
</body>
</html>
