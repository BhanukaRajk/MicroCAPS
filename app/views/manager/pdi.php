<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row justify-content-between  align-items-start">
            <div class="page-heading font-weight  margin-bottom-4">
                Pre Delivery Inspection
            </div>
            <div class="search-container">
                <form action="" class="search" id="search-bar">
                    <input type="text" placeholder="Search" class="search-input" oninput="searchByChassis('pdi')" id="searchId">

                    <div class="search-button" id="search-button">
                        <i class="ri-search-2-line search-icon"></i>
                        <i class="ri-close-line search-close"></i>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if ($data['onPDIVehicles'] == false) {
            echo '
                        <div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                                <div class="font-weight">No Details</div>
                            </div>
                        ';
        } else {
            echo '<div class="vehicle-detail-board  margin-bottom-4">
                        <div class="vehicle-data-board justify-content-evenly">';
            foreach ($data['onPDIVehicles'] as $value) {
                echo '<a href="' . URL_ROOT . 'managers/pdi/' . $value->ChassisNo . '">
                            <div class="carcard">
                                <div class="cardhead">
                                    <div class="cardid">
                                        <div class="carmodel">' . $value->ModelName . '</div>
                                        <div class="chassisno">' . $value->ChassisNo . '</div>
                                    </div>
                                </div>
                                <div class="carpicbox">
                                    <img src="' . URL_ROOT . 'public/images/cars/'. $value->ModelName . ' ' . $value->Color .'.png" class="carpic" alt="' . $value->ModelName . ' ' . $value->Color . '">
                                </div>
                                <div class="carstatus green"> On Assembly </div>
                                <div class="arrivaldate">Stage: '.$value->CurrentStatus.'</div>
                            </div>';
            }

            echo '  </div>
                    </div>';
        }
        ?>

    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>