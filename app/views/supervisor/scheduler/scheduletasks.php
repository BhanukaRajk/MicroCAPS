<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/notification.php'; ?>


<section id="my-section">
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="task-schedule-margin">

            <div class="task-schedule-header">
                <div class="task-schedule-heading">Scheduled Task List</div>
            </div>





            <div class="task-schedule-control-box vertical-centralizer " id="myHeader">

                <form>

                    <div class="control-box-inner horizontal-centralizer">
                        <div class="name-box vertical-centralizer">
                            <label for="TaskName" class="display-none"></label>
                            <input type="text" id="TaskName" name="TaskName" oninput="findCarProcesses()" class="new-task-name" placeholder="Task Name" autocomplete="off" required>
                            <!-- <ul id="taskMenu" class="">
                                <li>HTML</li> -->
                                <!-- <li>CSS</li>
                                <li>JavaScript</li>
                                <li>PHP</li>
                                <li>Python</li>
                                <li>jQuery</li>
                                <li>SQL</li>
                                <li>Bootstrap</li>
                                <li>Node.js</li> -->
                            <!-- </ul> -->
                        </div>
                        <div class="vehicle-selection-box vertical-centralizer">
                            <label for="vehicles" class="display-none">Select Vehicle</label>
                            <select name="vehicles" id="vehicles" class="task-vehicle-selection">
                                <option class="" disabled selected value>- Select vehicle -</option>
                                <!-- IN THIS SELECTION, VEHICLES SHOULD BE THE SAME STAGE AS THE SUPERVISOR'S STAGE-->
                                <?php
                                // foreach ($data['AssemblingCars'] as $carOnLine) {
                                //      echo '<option value="' . $carOnLine->ChassisNo . '">' . $carOnLine->ChassisNo . '</option>';
                                // }

                                // if($carOnLine == NULL) {
                                //     echo '<option disabled selected value>No vehicles on assembly line</option>';
                                // }
                                ?>
                                <option value="CN112215002A">CN112215002A</option>
                                <option value="CN112215000A">CN112215000A</option>
                                <option value="CN112910320A">CN112910320A</option>
                            </select>
                        </div>
                        <div class="task-add-button-box vertical-centralizer">
                            <button type="button" onclick="showThisPopup('asm-add-1')" id="add-task-btn" class="task-add-button">Add task</button>
                        </div>
                    </div>





                    <!-- ASSEMBLER DETAIL INSERTING POPUP BOX -->
                    <div class="low-content-blurer vertical-centralizer display-none" id="asm-add-1">
                        <div class="horizontal-centralizer">
                            <div class="add-task-box">
                                <div onclick="closeThisPopup('asm-add-1')" class="close-add-task-box">
                                    <img src="<?php echo URL_ROOT; ?>public/images/icons/close.png" class="popup-close-icon">
                                </div>
                                <div class="box-heading">Assign Assembler</div>
                                <div class="margin-top-2">Would you like to assign an employee for this task?</div>
                                <div>
                                    <label for="assembler-assign">Assembler name</label>
                                    <input type="text" class="assembler-assign" id="assembler-assign">
                                </div>
                                <div>
                                    <label for="add-assign-emp">Assign an assembler</label>
                                    <input type="checkbox" id="add-assign-emp" onchange="allowAssign()" checked>
                                </div>
                                <div>
                                    <button type="submit" class="action-one-button">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>



                </form>

            </div>









            <!-- RECORDED TASK DISPLAYING AREA -->
            <div class="scheduled-list-box">
                <div class="task-detail-box-inner">

                    <?php
if (!$data['taskList']) {

    echo '<div class="horizontal-centralizer">
                        <div class="marginy-4">No Schedules Available</div>
                        <div class=""></div>
                    </div>
                    <div class="bottom-border"></div>';

} else {

    foreach ($data['taskList'] as $Task) {
        echo '<div class="task-schedule-record">
        <div class="task-schedule-record-inner">
            <div class="vline"></div>
            <div class="task-status vertical-centralizer">
                <div class="round">
                    <input type="checkbox" name="' . $Task->ChassisNo . '-' . $Task->ProcessId . '" 
                    class="P28_taskrecord"
                    value="' . (($Task->Completeness == 1) ? 1 : 0) . '"
                    id="' . $Task->ChassisNo . '-' . $Task->ProcessId . '" 
                    ' . (($Task->Completeness == 1) ? 'checked' : '') . '>
                    <label for="' . $Task->ChassisNo . '-' . $Task->ProcessId . '"></label>
                </div>
            </div>
            <div class="vline"></div>
            <div class="task-vehicle">
                <div class="task-vehicle-id">' . $Task->ChassisNo . '</div>
                <div class="task-vehicle-date">' . $Task->Date . '</div>
            </div>
            <div class="vline"></div>
            <div class="task-name vertical-centralizer">
                <div>Task: ' . $Task->ProcessName . '</div>
            </div>
            <div class="vline"></div>
            <div class="task-worker vertical-centralizer">
                <div>Assembler: ' . $Task->Worker . '</div>
            </div>
            <div class="vline"></div>
            <div class="task-edit vertical-centralizer">
                <img src="' . URL_ROOT . '/public/images/icons/edit.png" onclick="taskUpdateOpen(\''.$Task->ChassisNo. '\', \''.$Task->ProcessId. '\', \'' . $Task->Worker . '\')" class="mouse-pointer width-rem-1p25" alt="Edit">
            </div>
            <div class="task-edit vertical-centralizer">
                <img src="' . URL_ROOT . '/public/images/icons/delete.png" onclick="taskDeleteConfirmation(\''.$Task->ChassisNo. '\', \''.$Task->ProcessId. '\')" class="mouse-pointer width-rem-1p25" alt="Remove">
            </div>
        </div>
    </div>';
    }
}                    ?>

                </div>
            </div>











            <!-- THIS IS THE POPUP BOX FOR TASK UPDATES -->
            <div class="low-content-blurer vertical-centralizer display-none" id="asm-add-2">
                <!-- <div class="background-bluer vertical-centralizer"> -->
                <div class="horizontal-centralizer">
                    <div class="add-task-box">
                        <div class="update-task-box-closer">
                            <div onclick="closeThisPopup('asm-add-2')" class="close-add-task-box">
                                <img src="<?php echo URL_ROOT; ?>public/images/icons/close.png" class="popup-close-icon">
                            </div>
                        </div>
                        <div class="update-task-box-head">
                            <div class="popup-box-heading1 update-task-box-heading">Assign for task</div>
                        </div>

                        <form method="POST" action="<?php echo URL_ROOT; ?>Supervisors/updateThisTask">
                            <div class="update-task-box-process">
                                <div>Adjusting clutch</div>
                            </div>
                            <div class="margin-top-2">
                                <div class="update-task-box-carno">Vehicle No: CN83JH43HG636</div>
                            </div>
                            <div class="margin-top-3 horizontal-centralizer">
                                <div>

                                    <label for="stock">Assembler Name</label>
                                    <input id="stock" type="text" class="assembler-assign"></input>


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
                            <div class="margin-top-3 horizontal-centralizer">
                                <div><button type="submit" class="action-one-button">Update</button></div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>






            <!-- DELETE CONFIRMATION POPUP BOX (THIS IS INCLUDED HERE BECAUSE IT HAS TO BE CENTRALIZED ON CONTENT AREA) -->
            <div class="delete-conf-blur horizontal-centralizer display-none" id="P28_taskdelpopupWindow">
                <div class="vertical-centralizer">

                    <div class="del-confirm-box">
                        <div class="del-confirm-box-content">
                            <div class="del-confirm-msg-box">Are you sure?</div>
                            <div class="del-conf-button-set">
                                <div class="del-conf-button-box">

                                    <form method="POST" action="<?php echo URL_ROOT; ?>Supervisors/removeThisTask">
                                        <input type="hidden" name="vehicle_id" id="del-task-car-id">
                                        <input type="hidden" name="process_id" id="del-task-process-id">
                                        <button type="submit" class="delete-button-2">Remove</button>
                                    </form>

                                </div>
                                <div class="del-conf-button-box">
                                    <button onclick="closeThisPopup('P28_taskdelpopupWindow')" class="edit-button-2">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>











        </div>
    </div>
</section>














<script>
    // const section = document.getElementById("my-section");
    // const addTaskBox = document.querySelector(".add-task-box");

    // // PREVENT CLICK AND SCROLL EVENTS ON THE SECTION
    // section.addEventListener("click", function(event) {
    //     if (!event.target.closest(".add-task-box")) {
    //         event.preventDefault();
    //     }
    // });

    // section.addEventListener("wheel", function(event) {
    //     if (!event.target.closest(".add-task-box")) {
    //         event.preventDefault();
    //     }
    // });

    // // ALLOW CLICK AND SCROLL EVENTS ON THE ADD-TASK-BOX
    // addTaskBox.addEventListener("click", function(event) {
    //     event.stopPropagation();
    // });

    // addTaskBox.addEventListener("wheel", function(event) {
    //     event.stopPropagation();
    // });


    function allowAssign() {
        var checkbox = document.getElementById("add-assign-emp");
        var input = document.getElementById("assembler-assign");
        if (checkbox.checked) {
            input.disabled = false;
        } else {
            input.disabled = true;
        }
    }



    function checkInputs() {
        var taskNameInput = document.getElementById('TaskName');
        var vehicleSelection = document.getElementById('vehicles');
        var addTaskButton = document.getElementById('add-task-btn');

        if (taskNameInput.value !== '' && vehicleSelection.value !== '') {
            addTaskButton.disabled = false;
        } else {
            addTaskButton.disabled = true;
        }
    }

    // call checkInputs on page load and input changes
    checkInputs();
    document.getElementById('TaskName').addEventListener('input', checkInputs);
    document.getElementById('vehicles').addEventListener('change', checkInputs);
</script>





<!-- ADD COMMON FOOTER FILE -->
<script src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/fetch.js"></script>
<script src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/scheduler.js"></script>
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>