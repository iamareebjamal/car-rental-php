<?php if($loginInfo == 0) {
    include_once('../templates/logout.php');
} else if(!isset($car) || $car == null) { ?>
    <div class="panel panel-default" style="background-color: #ff333b">
        <div class="panel-body text-center">
            <h3 class="lead" style="color: #ffccc6">No car with this ID found!</h3>
        </div>
    </div>
<?php } else { ?>
    <?php function getColor($stock) {
        $color = 'danger';

        if($stock > 50){
            $color = 'success';
        } else if($stock > 20) {
            $color = 'warning';
        }

        return $color;
    }
    ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-4">
                <h4>Hello, <?=$user['first_name']?> </h4>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
    <div class="panel panel-default col-lg-8">
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="">
                <fieldset>
                    <legend>Rent <?= $car['name'] ?></legend>
                    <img src="<?= $car['pic'] ?>" class="img-responsive" style="margin-bottom: 20px;" />

                    <?php

                    $hourMode = 'checked'; $dayMode = ''; $kmMode = '';
                    $rate = $car['rate_by_hour'];
                    if(isset($values['mode'])) {
                        switch ($values['mode']) {
                            case 'hour':
                                $hourMode = 'checked';
                                $rate = $car['rate_by_hour'];
                                break;
                            case 'day':
                                $dayMode = 'checked';
                                $rate = $car['rate_by_day'];
                                break;
                            case 'km':
                                $kmMode = 'checked';
                                $rate = $car['rate_by_km'];
                        }
                    }

                    $value = 1;
                    if(isset($values['value'])) {
                        $value = $values['value'];
                    }

                    $stock = $car['stock'];
                    $color = getColor($stock);
                    ?>

                    <?= "<h5 class=\"text-$color text-center\" >Stock : $stock </h5>"; ?>
                    <?php if ($car['stock'] > 0) { ?>
                    <div style="display: none;">
                        <input id="hour" value="<?=$car['rate_by_hour']?>" />
                        <input id="day" value="<?=$car['rate_by_day']?>" />
                        <input id="km" value="<?=$car['rate_by_km']?>" />
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Mode</label>
                        <div class="col-lg-10">
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="mode" id="optionsRadios1" value="hour" <?=$hourMode?>>
                                    Per Hour
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="mode" id="optionsRadios2" value="day" <?=$dayMode?>>
                                    Per Day
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="mode" id="optionsRadios2" value="km" <?=$kmMode?>>
                                    Per KM
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="value" class="col-lg-2 control-label">Rent</label>
                        <div class="col-sm-3">
                            <input type='text' class='form-control' id="rate" name='rate' value='<?= $rate ?>' placeholder='Value' disabled>
                        </div>
                        <div class="col-sm-3">
                            <input type="number" min="1" class='form-control' name='value' id="val" autofocus="autofocus" value='<?= $value ?>' placeholder='Value'>
                        </div>
                        <div class="input-group col-sm-3">
                            <span class="input-group-addon">₹</span>
                            <input type='text' class='form-control' id="rent" name='rent' value='<?= $car["rate_by_hour"] ?>' placeholder='Rent' readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2">
                            <button type="reset" class="btn btn-default" style="margin-right: 10px;">Cancel</button>
                            <button type="submit" class="btn btn-<?=$color?>">Rent</button>
                        </div>
                    </div>

                    <?php } else { ?>
                        <h5 class="text-danger text-center">Car out of stock!</h5>
                    <?php } ?>
                </fieldset>
            </form>
            <?php
            if(isset($errors)) {
                foreach ($errors as $error) {
                    echo "<div class=\"alert alert-dismissible alert-danger fade in\">\n" .
                        "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\n" .
                        "$error\n" .
                        "</div>\n";
                }
            }

            if(isset($success) && strlen($success) > 0) {
                echo "<div class=\"alert alert-dismissible alert-success fade in\">\n" .
                    "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\n" .
                    "$success\n" .
                    "</div>\n";
            }
            ?>
        </div>
    </div>
    <div class="col-lg-2"></div>
    <script>
        function refresh() {
            $('#rent').val($('#rate').val()*$('#val').val());
        }
        $('#val').bind('input', function() {
            refresh();
        });

        $('input[type=radio][name=mode]').on('change', function() {
            $('#rate').val(($('#' + $(this).val()).val()));
            refresh();
        });
    </script>
<?php } ?>