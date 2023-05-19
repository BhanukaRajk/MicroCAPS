<?php require_once APP_ROOT . '\views\admin\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\admin\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row justify-content-between  align-items-start">
            <div class="page-heading font-weight  margin-bottom-4">
                Pre Delivery Inspection
            </div>
        </div>

        <div  id="vehicleList">
        <?php
            if ($data['onPDIVehicles'] == false) {
                echo '
                            <div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                                    <div class="font-weight">No Details</div>
                                </div>
                            ';
            } else {
                echo '<div class="display-flex-row flex-wrap justify-content-between">';
                foreach ($data['onPDIVehicles'] as $value) {

                    if ($value->TesterId == 'NA') {
                        $word = 'Not Started';
                        $css = 'red';
                    } else {
                        if ($value->PDIStatus == 'P') {
                            $word = 'In Progress';
                            $css = 'orange';
                        } else {
                            $word = 'Completed';
                            $css = 'green';
                        }
                    }

                    echo '<div class="carcard">
                                <div class="cardhead">
                                    <div class="cardid">
                                        <div class="carmodel">' . $value->ModelName . '</div>
                                        <div class="chassisno">' . $value->ChassisNo . '</div>
                                    </div>
                                    <div class="toolstatuscolor">
                                        <div class="status-circle status-'.$css.'-circle"></div>
                                    </div>
                                </div>
                                <div class="carpicbox">
                                    <img src="' . URL_ROOT . 'public/images/cars/'. $value->ModelName . ' ' . $value->Color .'.png" class="carpic" alt="' . $value->ModelName . ' ' . $value->Color . '">
                                </div>
                                <div class="carstatus '.$css.'"> '.$word.' </div>
                                <div class="arrivaldate margin-top-1">Assigned to: '.$value->Tester.'</div>
                            </div>';
                }

                echo '</div>';
            }
            ?>
        </div>

    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>