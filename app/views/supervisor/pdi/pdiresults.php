<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row margin-bottom-3 align-items-center justify-content-between margin-right-6 margin-bottom-4">
            <div class="page-heading font-weight">
                PDI Results
            </div>
        </div>

        <div class="display-flex-row justify-content-between">
            <div>
                <div class="paddingy-2 font-weight">VIN : <?php echo $data['pdiVehicle']->ChassisNo ?></div>
                <div class="paddingy-2 font-weight">Engine : <?php echo $data['pdiVehicle']->EngineNo ?></div>
            </div>
            <div>
                <button class="btn btn-primary btn-blue width-rem-12" id="view-defect">View Defect Sheet</button>
            </div>
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

    <div class="overlay display-flex-row align-items-center justify-content-center" id="overlay">
        <section id="pop-con" class="overflow-defects border-gray">
        <div class="column align-items-center border-gray padding-5 justify-content-center">
        <div class="page-heading font-weight  margin-bottom-4">
            Defect Sheet
        </div>
            <table class="ds-table">
                <tbody>
                    <tr>
                        <th>Defect No.</th>
                        <th>Defect Description</th>
                        <th>Inspection Date</th>
                        <th>Employee ID</th>
                        <th>Recorrection</th>
                    </tr>

                    <?php
                    if (empty($data['defects'])) {
                        echo "<tr><td colspan='7'>No Defects Found</td></tr>";
                    } else {
                        foreach ($data['defects'] as $values) :
                    ?>

                            <tr>
                                <td><?php echo $values->DefectNo; ?></td>
                                <td><?php echo $values->RepairDescription; ?></td>
                                <td><?php echo $values->InspectionDate; ?></td>
                                <td><?php echo $values->EmployeeID; ?></td>
                                <td><?php echo $values->ReCorrection; ?></td>
                            </tr>

                        <?php endforeach; ?>
                    <?php } ?>

                </tbody>
            </table>

            <div class="text-center text-blue font-size-14 margin-top-4 pointer" id="cancel">Cancel</div>
        </div>
        </section>
    </div>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/cors.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/pdi.js"></script>


</body>
<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>