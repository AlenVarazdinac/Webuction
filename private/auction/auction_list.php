<?php include_once '../../config.php'; checkLogin();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../inc/head.inc.php';?>
</head>

<body>
    <?php include_once '../../inc/navbar.inc.php';?>

    <?php
    $command = $conn->query('SELECT * FROM item a
        LEFT JOIN user b ON a.item_added_by=b.user_id WHERE a.item_live=1;');
    $result = $command->fetchAll(PDO::FETCH_OBJ);
    
    ?>
        <div class="container mt-5">
            <?php if(isset($_GET['succbid'])): ?>
            <div class="alert alert-success">
                <p class="text-center">You have successfully placed a bid.</p>
            </div>
            <?php endif;?>
            
            <?php if(isset($_GET['higherbid'])): ?>
            <div class="alert alert-danger">
                <p class="text-center">Your bid has to be higher than the current one.</p>
            </div>
            <?php endif;?>
            <div class="row justify-content-center">
                <?php foreach($result as $item): 
                $fileName = '../../img/items/' . $item->item_id . '.jpg';
                if(!file_exists($fileName)) {
                    $fileName = '../../img/items/no-item-image.png';
                }
                ?>
                <div class="card mr-1 mt-2" style="width: 20rem;">
                    <img class="card-img-top" src="<?php echo $fileName;?>" alt="Item image" style="width: 320px; height: 220px;" />

                    <div class="card-body">
                        <h4 class="card-title text-center">
                            <?php echo $item->item_name;?>
                        </h4>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center">Highest bid - $<?php echo $item->item_highest_bid;?>
                        </li>
                    </ul>

                    <div class="card-body row justify-content-center">
                        <a href="#" class="card-link">Show</a>
                        <a href="#" class="card-link" data-toggle="modal" data-target="#bidModal" data-itemid='<?php echo $item->item_id;?>' name="item_id">Bid</a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="item_bidding.php">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bidModalLabel">Bid amount</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-2 mb-sm-0">
                                    <div class="input-group-addon">$</div>
                                    <input type="text" class="form-control" placeholder="Enter bid amount" name="bid_amount" />
                                </div>
                            </div>
                            <input type="hidden" id="item_id" name="item_id" />
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['logged']->user_id;?>" />
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Bid</button>   
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>

        </div> <!-- / Container end -->

        <?php include_once '../../inc/footer.inc.php';?>
        <?php include_once '../../inc/scripts.inc.php';?>
        
        <script>
            $('#bidModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var item = button.data('itemid') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                //modal.find('.modal-title').text('New message to ' + item)
                modal.find('#item_id').val(item)
            })
        </script>
</body>

</html>