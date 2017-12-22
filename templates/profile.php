<?php if ($loginInfo == 0) {
    include_once('../templates/logout.php');
} else { ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="text-center">
                <h3><?= $user['first_name'] . " " . $user['last_name'] ?></h3>

                <img src="<?= $user['avatar'] ?>" style="height: 200px; width:200px;"/>
            </div>
            <br>
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <h4>Profile Info</h4>
                <hr>
                <div class="row">
                    <div class="col-sm-2">
                        <strong>Email :</strong>
                    </div>
                    <div class="col-sm-10">
                        <?= $user['email'] ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <strong>Phone No :</strong>
                    </div>
                    <div class="col-sm-10">
                        <?= $user['ph_no'] ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <strong>Join Time :</strong>
                    </div>
                    <div class="col-sm-10">
                        <?= $user['join_date'] ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-2">
                        <strong>Address :</strong>
                    </div>
                    <div class="col-sm-10">
                        <?= $user['street'] . "<br>" . $user['city'] . "<br>" . $user['state'] . "<br>" . $user['country'] . "<br>" . $user['zip'] ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>

    <?php if($admin) include_once('../templates/rental_item.php')?>

<?php } ?>