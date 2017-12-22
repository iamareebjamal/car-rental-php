<?php foreach ($rentals as $rental) { ?>
<?php $rate = $rental["rate_by_" . $rental["mode"]]; ?>
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-body text-center">
            <h5><strong><?=$rental['first_name'] . " " . $rental['last_name']?></strong></h5>
            rented
            <div>
                <a href="/car/<?=$rental['car_id']?>"><img src="<?=$rental['pic']?>" class="img-thumbnail" style="height: 190px" /></a><br>
                <h5><?=$rental['name']?></h5>
            </div>
            for  <h6 style="display: inline"><?=$rental['value'] . " " . $rental['mode'] ?></h6><br>
            on  <h6 style="display: inline"><?=$rental['time']?></h6><br>
            for  <h6 style="display: inline">₹ <?=$rental['value']*$rate?></h6><br><br>
            <form method="post">
                <input name="transaction_id" value="<?=$rental["_id"]?>" style="display: none"/>
                <button type="submit" class="btn btn-danger">Cancel</button>
            </form>
        </div>
    </div>
</div>
<?php } ?>