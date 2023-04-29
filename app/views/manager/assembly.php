<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row justify-content-between  align-items-start">
            <div class="page-heading font-weight  margin-bottom-4">
                On Assembly Vehicles
            </div>
            <div class="search-container">
                <form action="" class="search" id="search-bar">
                    <input type="text" placeholder="Search" class="search-input" oninput="searchByChassis('assembly')" id="searchId">

                    <div class="search-button" id="search-button">
                        <i class="ri-search-2-line search-icon"></i>
                        <i class="ri-close-line search-close"></i>
                    </div>
                </form>
            </div>
        </div>
        
        <div  id="vehicleList">
        <!-- <div class="display-flex-column align-items-start margin-top-3"> -->
            <?php
            if ($data['assemblyDetails'] == false) {
                echo '
                            <div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                                    <div class="font-weight">No Details</div>
                                </div>
                            ';
            } else {
                echo '<div class="vehicle-detail-board  margin-bottom-4">
                            <div class="vehicle-data-board justify-content-evenly">';
                foreach ($data['assemblyDetails'] as $value) {

                    if ($value->CurrentStatus == 'S1') {
                        $CurrentStatus = 'Stage 01';
                    } else if ($value->CurrentStatus == 'S2') {
                        $CurrentStatus = 'Stage 02';
                    } else if ($value->CurrentStatus == 'S3') {
                        $CurrentStatus = 'Stage 03';
                    } else if ($value->CurrentStatus == 'S4') {
                        $CurrentStatus = 'Stage 04';
                    } 

                    echo '<a href="' . URL_ROOT . 'managers/assembly/' . $value->ChassisNo . '">
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
                                    <div class="arrivaldate">Stage: '. $CurrentStatus . '</div>
                                </div></a>';
                }

                echo '  </div>
                        </div>';
            }
            ?>
        </div>

    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>