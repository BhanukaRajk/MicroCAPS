<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row margin-bottom-3 align-items-center justify-content-between margin-right-6 margin-bottom-4">
            <div class="page-heading font-weight">
                PDI Results
            </div>
            <div class="custom-select">
                <select name="vehicles" class="background-none" id="pdiVehicles">
                    <?php 
                        echo '<option value="' . URL_ROOT . 'managers/pdi/' . $data['ChassisNo'] .'">'.$data['ChassisNo'].'</option>';
                        foreach($data['onPDIVehicles'] as $value) {
                            if ($value->ChassisNo == $data['ChassisNo']) {
                                continue;
                            }
                            echo '<option value="' . URL_ROOT . 'managers/pdi/' . $value->ChassisNo . '">'.$value->ChassisNo.'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>

        <div>
            <div class="paddingy-2 font-weight">VIN : <?php echo $data['onPDIVehicle']->ChassisNo ?></div>
            <div class="paddingy-2 font-weight">Engine : <?php echo $data['onPDIVehicle']->EngineNo ?></div>
            <div class="paddingy-2 font-weight">Tester : <?php echo $data['onPDIVehicle']->Tester ?></div>
        </div>


        <div class="display-flex-row justify-content-start gap-2 margin-top-3 flex-wrap padding-bottom-5">

        <?php 
                foreach ($data['pdiCheckCategories'] as $value) {
                    echo '
                        <div class="pdi-card">
                            <div class="pdi-card-head">
                                <div class="pdi-card-main">'.$value->Title.'</div>
                                <div class="pdi-card-sub">'.$value->SubTitle.'</div>

                                <div class="pdiresultbox paddingy-3">
                    ';

                    foreach ($data['pdiCheckList'] as $value2) {
                        if ($value2->CategoryId == $value->CategoryId) {

                            if ($value2->Result == 'OK') {
                                $color = 'green-box';
                            } else if ($value2->Result == 'S/A') {
                                $color = 'red-box';
                            } else {
                                $color = 'yellow-box';
                            }

                            echo '
                                <div class="paddingx-4 paddingy-2">
                                    <div class="pdi-checklist">
                                        <div class="padding-bottom-3 font-size">'.$value2->CheckName.'</div>
                                        <div class="pdi-checking-result '. $color .'">
                                            <div class="pdi-checking-result-text">'.$value2->Result.'</div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    }

                    echo '
                                </div>
                            </div>
                        </div>
                    ';
                }
            ?>

        </div>
    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>


</body>