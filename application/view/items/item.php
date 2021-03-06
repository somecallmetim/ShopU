<?php
// Change category on the search bar if user made a search
if (isset($_GET["submit_search"])) {
    if ($category != NULL && $category != 'All') {
        echo("<script>$('#category').val('$category');</script>");
    }
} ?>
<!--back to search link-->
<div id = "backlink" class="container-fluid">
    <div class="col-md-2 text-center">
        <a href="javascript://" onclick="goBack();">Go Back</a>
    </div> 
</div>
<!--back to search link end-->

<div class="container">
    <div class="row">
        <div class="col-md-6 text-right">
            <?php
            // display user-uploaded image if it exists
            if (isset($item->image)) {
                echo ("<img src='data:image/jpeg;base64," . base64_encode($item->image)
                . "' alt='Item image' class='img-responsive' style='height:400px'");
            } else {
                echo ("<img src='//placehold.it/400/000000.jpg?text=No+Image' "
                . "alt='Item Image' class='img-responsive'");
            }?>
        <br>
        </div>

        <div class="col-md-6 text-left">
            <h1>
                <?php if (isset($item->title)) echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
            </h1>
            <h3>
                Price: <?php if (isset($item->price)) echo '$' . htmlspecialchars($item->price, ENT_QUOTES, 'UTF-8'); ?>
            </h3>

            <!-- buy button -->
            <?php if (isset($_SESSION["user_id"])) { ?>
                <a href="<?php echo URL . 'items/orderConfirm/' . htmlspecialchars($item->id, ENT_QUOTES, 'UTF-8'); ?>"
                   class="btn btn-warning btn-lg buy-button" id="buy">BUY</a>
                
            <!-- users need to sign in before buy an item-->           
            <?php } else { ?>
                <a data-toggle="tooltip" data-placement="auto" title="You must sign in to buy items!"
                   class="btn btn-warning btn-lg buy-button" id="buy">BUY</a>
               <?php } ?>
            <br><br>

            <!-- tab names -->
            <ul class="nav nav-tabs ">
                <li class="active"><a data-toggle="tab" href="#tab-description">Description</a></li>
                <li><a data-toggle="tab" href="#tab-info">Info</a></li>
                <li><a data-toggle="tab" href="#tab-keywords">Keywords</a></li>
            </ul>

            <!-- tab content -->
            <div class="tab-content">
                <div id="tab-description" class="tab-pane fade in active pull-left">
                    <?php if (isset($item->description)) echo nl2br(htmlspecialchars($item->description, ENT_QUOTES, 'UTF-8')); ?>
                </div>
                <div id="tab-info" class="tab-pane fade pull-left">
                    Category: <?php
                                if (isset($item->category)) {
                                    foreach($categories as $theCat) {
                                        if($item->category == $theCat->id)
                                            echo htmlspecialchars($theCat->category, ENT_QUOTES, 'UTF-8');
                                    }
                                } ?>
                    <br>
                    Item ID: <?php if (isset($item->id)) echo htmlspecialchars($item->id, ENT_QUOTES, 'UTF-8'); ?><br>
                    Seller: <?php if(isset($seller)) echo htmlspecialchars($seller, ENT_QUOTES, 'UTF-8'); ?><br>
                    <?php
                        // display user image if it exists
                        if (isset($sellerImage)) {
                            echo ("<img src='data:image/jpeg;base64," . base64_encode($sellerImage)
                            . "' alt='Item image' class='img-responsive' style='height:100px; width:100px'");
                        }
                    ?>
                    <br>
                </div>
                <div id="tab-keywords" class="tab-pane fade pull-left">
                    <?php if (isset($item->keywords)) echo htmlspecialchars($item->keywords, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            </div>
        </div>
        <br><br>
    </div>
</div>
<br><br>
