<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
    <div class="display-flex-row justify-content-between margin-bottom-2">
        <div class="page-heading font-weight  margin-bottom-4">
            Task Manager
        </div>
        <div>
                <input type="text" placeholder="Search" class="form-control" oninput="searchTaskM('<?php echo  $_SESSION['_id'];?>')" id="searchId">
                <label class="form-label">Search</label>
        </div>
        </div>
        <div id = "vehicleList">

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
                
                $check_1 = "";
                $check_2 = $value->TesterId;
                $testername = "";

                
                
                if($check_2 == NULL){
                    $testername = "None";
                } else {
                    foreach ($data['testers'] as $value_2){
                        if($value_2->EmployeeId == $check_2){
                            $testername = $value_2->Firstname." ".$value_2->Lastname;
                        }
                    }
                    if($check_2 == $_SESSION['_id']){
                        $check_1 = "checked";
                    }
                }

                

                echo '
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
                                <div class="carstatus green"> PDI </div>
                                <div class="arrivaldate margin-top-1">Assigned to: '.$testername.'</div>
                                <div class="mytasks font-size-13 display-flex-row align-items-center margin-top-2 margin-bottom-0 marginx-0">
                                    <div>
                                        <label class="form-control-checkbox">
                                            <input type="checkbox"
                                                    id=""
                                                    name=""
                                                    onChange="  if (this.checked) { 
                                                        addTask(\'' . $value->ChassisNo . '\',\'' . $_SESSION['_id'] . '\')
                                                    }else{
                                                        removeTask(\'' . $value->ChassisNo . '\')
                                                    }"
                                                    ' . $check_1 . '>
                                            <div class="checkmark-small"></div>
                                        </label>
                                    </div>
                                    <div class="padding-left-2">Add to My Tasks</div>
                                </div>
                            </div>';
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