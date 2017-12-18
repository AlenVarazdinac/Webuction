<?php include_once '../../config.php'; checkLogin();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../inc/head.inc.php';?>
</head>

<body>
    <?php include_once '../../inc/navbar.inc.php';?>

    <div class="container mt-5">
        <h2 class="text-center">Add item</h2>
        <div class="col-md-12 jumbotron">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="adding_item.php" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="item_name">Item name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter item name" />
                        </div>

                        <div class="form-group">
                            <label for="item_starting_price">Item starting price</label>
                            <input type="number" step="0.01" class="form-control" id="item_starting_price" name="item_starting_price" placeholder="Enter item starting price" />
                        </div>

                        <div class="form-group">
                            <label for="item_desc">Item description</label>
                            <textarea class="form-control" id="item_desc" name="item_desc" placeholder="Enter item description"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="custom-file col-md-12">
                            <input type="file" name="imgfile" id="imgfile" class="custom-file-input">
                            <span class="custom-file-control"></span>
                            </label>
                        </div>
                        
                        <!-- Auction start type -->
                        <div class="form-group">
                            <p>Auction starts at</p>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="auction_start_type" id="auction_start_now" value="now">Now
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="auction_start_type" id="auction_start_date" value="date">Specify date
                                </label>
                            </div>
                            
                            <!-- Auction set date -->
                            <input class="form-control-inline" type="datetime" name="auction_start" id="auction_start" placeholder="YYYY-MM-DD hh:mm:ss" />
                            
                        </div>
                        
                        <!-- Auction end time -->
                        <div class="form-group">
                            <p>Auction length</p>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="auction_end" id="auction_end1" value="24"> 24 hours
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="auction_end" id="auction_end2" value="48"> 48 hours
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="auction_end" id="auction_end3" value="72"> 72 hours
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary">Add item</button>
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['logged']->user_id;?>" />

                    </form>
                </div>

            </div>

        </div>

    </div>

    <?php include_once '../../inc/footer.inc.php';?>
    <?php include_once '../../inc/scripts.inc.php';?>
    
    <script>
    $('#auction_start').datetimepicker({
        format:'Y-m-d H:m:s',
        minDate:'0',
        maxDate:'+1970/01/03'
    });
    </script>
</body>

</html>
