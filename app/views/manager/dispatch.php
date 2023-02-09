<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="page-heading font-weight  margin-bottom-4">
            Dispatched Vehicles
        </div>

        <!-- <div class="display-flex-column align-items-start margin-top-3"> -->
        <?php
        if ($data['dispatchDetails'] == false) {
            echo '
                        <div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                                <div class="font-weight">No Details</div>
                            </div>
                        ';
        } else {
            echo '<div class="vehicle-detail-board  margin-bottom-4">
                        <div class="vehicle-data-board justify-content-evenly">';
            foreach ($data['dispatchDetails'] as $value) {
                echo '<div class="carcard">
                            <div class="cardhead">
                                <div class="cardid">
                                    <div class="carmodel">' . $value->ModelName . '</div>
                                    <div class="chassisno">' . $value->ChassisNo . '</div>
                                </div>
                            </div>
                            <div class="carpicbox">
                                <img src="' . URL_ROOT . 'public/images/cars/'. $value->ModelName . ' ' . $value->Color .'.png" class="carpic" alt="' . $value->ModelName . ' ' . $value->Color . '">
                            </div>
                            <div class="carstatus green">Show Room: '.$value->ShowRoomName.'</div>
                            <div class="arrivaldate">Arrival Date: ', $value->ReleaseDate, '</div>
                        </div>';
            }

            echo '  </div>
                    </div>';
        }
        ?>
        <!-- </div> -->
    </section>


    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
    
</body>