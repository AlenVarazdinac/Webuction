<?php include_once '../../config.php'; checkLogin();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../inc/head.inc.php';?>
</head>

<body>
    <?php include_once '../../inc/navbar.inc.php';?>

    <?php    
    $command = $conn->query('SELECT item_id, item_name, item_desc, item_starting_price,
 item_owner, item_added_at, item_starting_at, item_ending_at,
 item_live, bid_id, bid_by, bid_item, MAX(bid_amount) AS bid_amount, user_id,
user_name, user_balance FROM item a
LEFT JOIN bid b ON b.bid_item=a.item_id
LEFT JOIN user c ON a.item_owner=c.user_id
WHERE item_live=1 GROUP BY a.item_id;');
    $command->execute();
    $result = $command->fetchAll(PDO::FETCH_OBJ);    
    
    function timeLength($sec)
    {
        $s=$sec % 60;
        $m=(($sec-$s) / 60) % 60;
        $h=floor($sec / 3600);
        return $h.":".substr("0".$m,-2).":".substr("0".$s,-2);
    }
    
    
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

                    <?php
                    // Get end date
                    $currentDateTime = strtotime(date('Y-m-d H:i:s'));
                    $itemEndTime = strtotime($item->item_ending_at);
                    $itemEnd = $itemEndTime - $currentDateTime;

                    $dateNow = date('Y-m-d H:i:s', $currentDateTime);
                    $dateEnd = date('Y-m-d H:i:s', $itemEndTime);
                    ?>


                    <div class="card mr-1 mt-2" style="width: 20rem;">
                        <div class="card-header">
                           <span class="timer" id="n_<?php echo $item->item_id;?>"><?php echo timeLength($itemEnd);?></span>
                        </div>
                        <img class="card-img-top" src="<?php echo $fileName;?>" alt="Item image" style="width: 320px; height: 220px;" />

                        <div class="card-body">
                            <h4 class="card-title text-center">
                                <?php echo $item->item_name;?>
                            </h4>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-center"><?php
                            if(empty($item->bid_amount)) {echo 'Starting price $' . $item->item_starting_price;} else {echo 'Highest bid - $' . $item->bid_amount;}
                            ?>
                            </li>
                        </ul>

                        <div class="card-body row justify-content-center">
                            <a href="#" class="card-link">Show</a>
                            <?php if($item->item_owner!=$_SESSION['logged']->user_id): ?>
                            <a href="#" class="card-link" data-toggle="modal" data-target="#bidModal" data-itemid='<?php echo $item->item_id;?>' name="item_id">Bid</a>
                            <?php endif;?>
                        </div>
                    </div>
                    
                    <?php
                    if(timeLength($itemEnd) === '00:00:00' || timeLength($itemEnd) <= '00:00:00') {
                        $item_ended = true;
                        $this_item_id = $item->item_id;
                    }
                    ?>
                    
                    
                    <?php 
                    /*
                    if(!empty($dateNow) && !empty($dateEnd)) {
                        if($dateNow>=$dateEnd) {
                            $dateNow = $dateEnd;
                        }     
                    }
                    */
                    ?>
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
            var item_ended = <?php if(!empty($item_ended)){echo $item_ended;} else {echo 0;}?>;
            var item_id = "<?php if(!empty($this_item_id)){echo $this_item_id;}?>";
            
            console.log(item_ended);
            
            var timer = document.getElementsByClassName('timer');
                var timer_id = '';
                for(var i=0; i<timer.length; i++) {
                    timer_id += timer[i].id.split('_')[1];
                }
            
            var timer_val = $('p #n_' + timer_id + ' .timer').text();
            
            setInterval(function (){

                console.log(timer_val);

                if(item_ended == 1) {
                var request =  $.ajax({
                method: 'POST',
                url: 'update_auctions.php',
                data: { itemid: item_id}
                })  

                request.done(function( msg ) {
                  console.log( msg );
                });

                }

            }, 1000);  
            
            
            
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