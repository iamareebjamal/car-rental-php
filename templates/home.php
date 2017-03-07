<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-lg-4">
            <? if($loginInfo == 0) { ?>
                <h4>Sign In/Register to rent cars</h4>
            <? } else { ?>
                <h4>Hello, <?=$user['first_name']?> </h4>
            <? } ?>
        </div>
    </div>
</div>

<? function getColor($stock) {
    $color = 'danger';

    if($stock > 50){
        $color = 'success';
    } else if($stock > 20) {
        $color = 'warning';
    }

    return $color;
}
?>

<div class="row">
    <? foreach ($cars as $car) { ?>
        <div class="col-md-3 text-center">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4><?= $car['name'] ?></h4>
                    <img src="<?= $car['pic'] ?>" class="img-responsive" style="height: 160px;"/>

                    <?
                    $stock = $car['stock'];
                    $color = getColor($stock);
                    ?>

                    <?= "<h5 class=\"text-$color\" >Stock : $stock </h5>"; ?>
                    <a href="/car/<?= $car['_id'] ?>"><button class="btn btn-primary">Details</button></a>
                    <? if ($loginInfo != 0) { ?>
                        <? if ($stock == 0) $disable = "disabled"; else $disable = ""; ?>

                        <a href="/rent/<?= $car['_id'] ?>" class="btn btn-<?=$color . " " . $disable?>" style="margin-left: 10px;">Rent</a>
                    <? } ?>
                </div>
            </div>
        </div>
    <? } ?>
</div>