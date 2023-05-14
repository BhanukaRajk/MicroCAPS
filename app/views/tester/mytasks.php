<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
    <div class="display-flex-row justify-content-between margin-bottom-2">
        <div class="page-heading font-weight  margin-bottom-4">
            My Tasks
        </div>
        <div>
                <input type="text" placeholder="Search" class="form-control" oninput="searchTask('<?php echo  $_SESSION['_id'];?>')" id="searchId">
                <label class="form-label">Search</label>
        </div>
        </div>
        <div id = "vehicleList">

        <?php
        if ($data['onPDIVehicles'] == false) {
            echo '
                        <div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                                <div class="font-weight">No Vehicles in Your List</div>
                            </div>
                        ';
        } else {
            echo '<div class="vehicle-detail-board  margin-bottom-4">
                        <div class="vehicle-data-board justify-content-evenly">';
            foreach ($data['onPDIVehicles'] as $value) {

                $val = '';
                if($value->CurrentStatus == 'RR'){
                    $val = 'Ready to Test';
                }
                echo '<a href="' . URL_ROOT . 'testers/pdi/' . $value->ChassisNo . '">
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
                                <div class="arrivaldate">Stage: '.$val.'</div>
                            </div>
                            </a>';
            }

            echo '  </div>
                    </div>';
        }
        ?>

        </div>

    </section>

    <section class="display-flex-column">

        <div id="alert" class="hideme" role="alert"></div>

    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/cors.js"></script>