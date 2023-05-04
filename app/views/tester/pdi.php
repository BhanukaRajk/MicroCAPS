<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row margin-bottom-3 align-items-center justify-content-between margin-right-6 margin-bottom-4">
            <div class="page-heading font-weight">
                Pre Delivery Testing
            </div>
        </div>

        <div class="display-flex-row justify-content-between">
            <div>
                <div class="paddingy-2 font-weight">VIN : <?php echo $data['pdiVehicle']->ChassisNo ?></div>
                <div class="paddingy-2 font-weight">Engine : <?php echo $data['pdiVehicle']->EngineNo ?></div>
            </div>
            <div>
                <button class="btn btn-primary" onClick="location.href='<?php echo URL_ROOT; ?>testers/defect_sheet/<?php echo $data['pdiVehicle']->ChassisNo ?>'">Edit Defect Sheet</button>
            </div>
            <!-- <div>
            <button id="cccc" onclick="this.style.backgroundColor='red'">Click me!</button>
            </div> -->
        </div>


        <div class="display-flex-row justify-content-start gap-2 margin-top-3 flex-wrap">

            <?php
            foreach ($data['pdiCheckCategories'] as $value) {
                echo '
                        <div class="pdi-card">
                            <div class="pdi-card-head">
                                <div class="pdi-card-main">' . $value->Title . '</div>
                                <div class="pdi-card-sub">' . $value->SubTitle . '</div>

                                <div class="pdiresultbox paddingy-3">
                                <div class="paddingx-4 paddingy-2">
                                    <div class="pdi-checklist">
                                    <div class="padding-bottom-3 font-size"></div>
                                    <div class="padding-bottom-1 font-size"><pre class="margin-0 font-family">OK    SA</pre></div>
                                </div>
                                </div>
                    ';

                foreach ($data['pdiCheckList'] as $value2) {
                    if ($value2->CategoryId == $value->CategoryId) {
                        $check1 = $value2->Status == 'OK' ? "checked" : "";
                        $check2 = $value2->Status == 'SA' ? "checked" : "";
                        echo '
                                <div class="paddingx-4 paddingy-2">
                                    <div class="pdi-checklist">
                                        <div class="padding-bottom-3 font-size">' . $value2->CheckName . '</div>
                                        <div>
                                            <input type="radio" 
                                                        name="' . $value2->CheckId . '" 
                                                        value="OK" 
                                                        class="round-checkbox-green" 
                                                        onChange="addPDI(\'' . $value2->ChassisNo . '\',\'' . $value2->CheckId . '\',\'OK\')" ' . $check1 . '>
                                            <input type="radio" 
                                                        name="' . $value2->CheckId . '" 
                                                        value="SA" 
                                                        class="round-checkbox-red" 
                                                        onChange="addPDI(\'' . $value2->ChassisNo . '\',\'' . $value2->CheckId . '\',\'SA\')" ' . $check2 . '>
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
        <div class="margin-bottom-3"></div>
    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/cors.js"></script>


</body>