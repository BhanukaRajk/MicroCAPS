<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="task-schedule-margin">

            <div class="task-schedule-header">
                <div class="task-schedule-heading">Scheduled Task List</div>
            </div>


            <div class="task-schedule-control-box vertical-centralizer " id="myHeader">

                <div class="control-box-inner horizontal-centralizer">
                    <div class="name-box vertical-centralizer">
                        <label for="TaskName" class="display-none"></label>
                        <input type="text" id="TaskName" name="TaskName" class="new-task-name" placeholder="Task Name" autocomplete="off" required>
                    </div>
                    <div class="vehicle-selection-box vertical-centralizer">
                        <label for="vehicles" class="display-none">Select Vehicle</label>
                        <select name="vehicles" id="vehicles" class="task-vehicle-selection">
                            <option class="bh" disabled selected value>- Select vehicle -</option>
                            <!-- IN THIS SELECTION, VEHICLES SHOULD BE THE SAME STAGE AS THE SUPERVISOR'S STAGE-->
                            <?php
                            // foreach ($data['AssemblingCars'] as $carOnLine) {
                            //      echo '<option value="' . $carOnLine->ChassisNo . '">' . $carOnLine->ChassisNo . '</option>';
                            // }

                            // if($carOnLine == NULL) {
                            //     echo '<option disabled selected value>No vehicles on assembly line</option>';
                            // }
                            ?>
                            <option value="CN112150768A">CN112150768A</option>
                            <option value="CN112215000A">CN112215000A</option>
                            <option value="CN112910320A">CN112910320A</option>
                        </select>
                    </div>
                    <div class="task-add-button-box vertical-centralizer">
                        <button type="button" class="task-add-button">Add task</button>
                    </div>
                </div>

            </div>


            <div class="scheduled-list-box">
                <div class="task-detail-box-inner">

                    <?php
                    foreach ($data['taskList'] as $Task) {
                    echo '<div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">'. $Task->ChassisNo .'</div>
                                <div class="task-vehicle-date">'. $Task->Date .'</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: '. $Task->ProcessName .'</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: '. $Task->Worker .'</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="'. $Task->ChassisNo .'-'. $Task->ProcessId .'" 
                                    '. (($Task->Completeness == "0") ? 'checked' : '') .'>
                                    <label for="'. $Task->ChassisNo .'-'. $Task->ProcessId .'"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <!-- <a onclick="">Edit</a> -->
                                <img src="'. URL_ROOT.'/public/images/icons/edit.png" onclick="" class="mouse-pointer width-rem-1p25" alt="Edit">
                            </div>
                        </div>
                    </div>';
                    }
                    ?>

                </div>
            </div>



            <!-- THIS IS THE POPUP BOX FOR UPDATES AND DELETIONS -->
            <div class="background-bluer display-none">
                <div class="consumable-popup-window position-fixed">
                    <div class="">
                        <div><button type="">Close</button></div>
                    </div>
                    <div class="horizontal-centralizer">
                        <div class="popup-box-heading1">Assign for task</div>
                    </div>
                    <form method="POST">
                        <div class="horizontal-centralizer">
                            <div>Adjusting clutch</div>
                        </div>
                        <div class="horizontal-centralizer">
                            <div class="margin-top-1">CN83JH43HG636</div>
                        </div>
                        <div class="horizontal-centralizer margin-top-3">
                            <div>

                                <label for="stock">Assembler:</label>
                                <input id="stock" type="text"></input>


                                <!-- <select name="status" id="status">
                                        <option value="$state">$state</option>
                                        <?php
                                        // foreach ($data['states'] as $state) {
                                        //   if($state1 != $state2) {
                                        //     echo '<option value="' . $lineCar->ChassisNo . '">' . $lineCar->ChassisNo . '</option>';
                                        //   }
                                        // }
                                        ?>
                                        </select> -->

                            </div>
                        </div>
                        <div class="horizontal-centralizer margin-top-3">
                            <div><button type="submit">Update</button></div>
                        </div>
                    </form>
                    <form method="POST">
                        <div class="horizontal-centralizer display-none">
                            <div><input type="text"></input></div>
                        </div>
                        <div class="horizontal-centralizer">
                            <div><button type="submit">Remove item</button></div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>