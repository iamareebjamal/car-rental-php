<?php if($loginInfo == 0) {
    include_once('../templates/logout.php');
} else { ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-4">
                <h4>Hello, <?=$user['first_name']?> </h4>
            </div>
        </div>
    </div>
    <?php if(!isset($rentals) || count($rentals) == 0) { ?>
        <div class="panel panel-default" style="background-color: #ff333b">
            <div class="panel-body text-center">
                <h3 class="lead" style="color: #ffccc6">You have not rented any car!</h3>
            </div>
        </div>
    <?php } else {
        include_once('../templates/rental_item.php');
    } ?>

<?php } ?>