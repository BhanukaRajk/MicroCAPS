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

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a onclick="">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: Adjust Clutch</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Janith Liyanage</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox2" />
                                    <label for="checkbox2"></label>
                                </div>
                            </div>
                            <div class="task-edit vertical-centralizer">
                                <a>Edit</a>
                            </div>
                        </div>
                    </div>

                    <?php
                        // foreach ($data['TaskList'] as $task) {
                            // echo '<div class="task-schedule-record">
                            //         <div class="task-schedule-record-inner">
                            //             <div class="task-vehicle">
                            //                 <div class="task-vehicle-id">'. $task->ChassisNo .'</div>
                            //                 <div class="task-vehicle-date">'. $task->ScheduledDate .'</div>
                            //             </div>
                            //             <div class="vline"></div>
                            //             <div class="task-name vertical-centralizer">
                            //                 <div>Task: '. $task->TaskName .'</div>
                            //             </div>
                            //             <div class="vline"></div>
                            //             <div class="task-worker vertical-centralizer">
                            //                 <div>Assembler: '. $task->EmployeeName .'</div>
                            //             </div>
                            //             <div class="task-status vertical-centralizer">
                            //                 <div class="round">
                            //                     <input type="checkbox" id="checkbox3" '. if($task->Status == Completed) { echo 'checked'; } .'/>
                            //                     <label for="checkbox3"></label>
                            //                 </div>
                            //             </div>
                            //             <div class="task-edit vertical-centralizer">
                            //                 <a>Edit</a>
                            //             </div>
                            //         </div>
                            //     </div>';
                        // }

                        // if($state1 != $state2) {
                        //     echo '<option value="' . $lineCar->ChassisNo . '">' . $lineCar->ChassisNo . '</option>';
                        // }
                    ?>

                    

                </div>
            </div>

            <!-- <div class="schedule-card">
                <table>
                    <?php
                    // foreach ($data['ScheduledList'] as $Task) {
                    //      echo '<tr>
                    //                <td>
                    //                    <div class="display-flex-column">
                    //                         <div>'.$Task->ChassisNo.'</div>
                    //                         <div>'.$Task->ScheduleDate.'</div>
                    //                    </div>
                    //                </td>
                    //                <td>Task: '.$Task->TaskName.'</td>
                    //                <td>Assembler: '.$Task->EmployeeName.'</td>
                    //                <td>
                    //                    <div class="round">
                    //                        <input type="checkbox" id="checkbox2" />
                    //                        <label for="checkbox2"></label>
                    //                    </div>
                    //                </td>
                    //                <td>
                    //                    <div class="">
                    //                        <input type="checkbox" id="checkbox2" />
                    //                        <label for="checkbox2"></label>
                    //                    </div>
                    //                </td>
                    //            </tr>';
                    // }
                    ?>
                </table>
            </div> -->


            <!-- THIS IS THE POP UP BOX FOR UPDATES AND DELETIONS -->
            <div class="background-blurer display-none">
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