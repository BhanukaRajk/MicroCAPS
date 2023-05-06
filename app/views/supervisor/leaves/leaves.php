<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>


<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/notification.php'; ?>


<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="sup-leave-list-databox">

            <div class="sup-leave-list-headbox">
                <div class="sup-leave-list-heading">
                    <!-- <h1>Accepted leave info</h1> -->
                    <h1>Accepted time offs info</h1>
                </div>
                <div class="display-flex-column justify-content-center">
                    <a class="text-decoration-none" href="<?php echo URL_ROOT; ?>Supervisors/addleave">
                        <!-- <button class="adding-button" type="button">Add New Leave</button> -->
                        <button class="adding-button" type="button">Add New Time Off</button>
                    </a>
                </div>
            </div>

            <!-- LEAVES DATA TABLE -->
            <div class="sup-leave-list-info-box">
                <div class="sup-leave-list-non-edit">
                    <div class="leave-value block-heading">Employee Id</div>
<!--                    <div class="leave-value block-heading">First Name</div>-->
<!--                    <div class="leave-value block-heading">Last Name</div>-->
                    <div class="leave-value block-heading">Name</div>
                    <div class="leave-value block-heading">Requested date</div>
                    <div class="leave-value block-heading padding-right-5">Reason</div>
                </div>

                <?php
                foreach ($data['LeaveDetails'] as $value) {
                    echo '<div class="div-ender"></div>
                            <div class="sup-leave-list-non-edit">
                                <div class="display-none leave-identifier">' . $value->LeaveId . '</div>
                                <div class="leave-value">' . $value->EmployeeId . '</div>
                                <div class="leave-value">' . $value->Name . '</div>
                                <div class="leave-value">' . $value->LeaveDate . '</div>
                                <div class="leave-value padding-right-5">' . $value->Reason . '</div>


                                <form method="POST" action="'.URL_ROOT.'Supervisors/getEditingData">
                                <div class="leave-edit-info ppadding-left-2">
                                    <input type="hidden" name="leave_id" value="'. $value->LeaveId .'">
                                    <!-- <input type="submit" name="edit" class="edit-button" value="Edit"> -->
                                    <img src="'. URL_ROOT .'public/images/icons/edit.png" onclick="this.closest(\'form\').submit()" class="width-rem-1p25 mouse-pointer" alt="edit">
                                    </div>
                                </form>
    
                                <!-- <form method="POST" action="'.URL_ROOT.'Supervisors/removeleave"> -->
                                <div class="leave-edit-info">
                                    <!-- <input type="hidden" name="leave_id" value="', $value->LeaveId ,'">
                                    <input type="submit" name="remove" class="delete-button" value="Remove"> -->
                                    <!-- <button class="delete-button" onclick="leaveDeleteConfirmation(\''.$value->LeaveId. '\')">Remove</button> -->
                                    <img src="'. URL_ROOT .'public/images/icons/delete.png" onclick="leaveDeleteConfirmation(\''.$value->LeaveId. '\')" class="width-rem-1p25 mouse-pointer" alt="edit">
                                    
                                    </div>
                                <!-- </form> -->
                                
                            </div>
                            <div class="panel">
                                <p>' . $value->Reason . '</p>
                            </div>';
                }

                if($value == NULL) {
                    echo '<div class="horizontal-centralizer no-leave-data">
                            <div class="vertical-centralizer">
                                <div>No data available</div>
                            </div>
                        </div>';
                }
                
                ?>
            </div>

        </div>



        <!-- UPDATE TIMEOFF POPUP BOX (THIS IS INCLUDED HERE BECAUSE IT HAS TO BE CENTRALIZED ON CONTENT AREA) -->
        <div class="background-bluer display-none" id="timeOffUpdatePopUp">
            <div class="vertical-centralizer">
                <div class="time-off-update-popup">

                    <div class="timeoff-heading horizontal-centralizer">
                        <div>NEW TIME-OFF</div>
                    </div>
                    <div class="timeoff-unique-fields">
                        <div class="timeoff-unique-field-01">
                            <div class="grey-up">
                                <label for="employeeId">EMPLOYEE ID</label>
                            </div>
                            <div>
                                <input type="text" id="employeeId" name="employeeId" class="timeoff-unique-inputs" value="<?php echo $data['employeeId']; ?>" placeholder="Employee ID" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="timeoff-unique-field-02">
                            <div class="grey-up">
                                <label for="leavedate">REQUESTED DATE</label>
                            </div>
                            <div>
                                <input type="date" id="leavedate" name="leavedate" class="timeoff-unique-inputs" value="<?php echo $data['leavedate']; ?>" placeholder="Leave Date" required>
                            </div>
                        </div>
                    </div>
                    <div class="timeoff-unique-field-03">
                        <div class="grey-up">
                            <label for="reason">REASON</label>
                        </div>
                        <div>
                            <textarea id="timeoff-reason" name="reason" class="timeoff-reason-input" placeholder="Maximum 500 characters" required><?php echo $data['reason']; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="text-center marginy-2">
                        <button class="action-one-button width-100per" type="submit" onClick={this.onSubmit}>Submit</button>
                    </div>
                    <div class="text-center marginy-2">
                        <button class="free-action-button width-100per" type="reset">Reset</button>
                    </div>

                    <div class="popup-close-icon"><img src="<?php echo URL_ROOT; ?>public/images/icons/close.png" class="popup-close-icon" onclick="closeThisPopup('timeOffUpdatePopUp')"></div>

                </div>
            </div>
        </div>

        <!-- ADD NEW TIMEOFF POPUP BOX (THIS IS INCLUDED HERE BECAUSE IT HAS TO BE CENTRALIZED ON CONTENT AREA) -->
        <div class="background-bluer" id="newTimeOffPopUp">
            <div class="vertical-centralizer">
                <div class="time-off-update-popup">

                    <div class="timeoff-heading horizontal-centralizer">
                        <div>NEW TIME-OFF</div>
                    </div>
                    <div class="timeoff-unique-fields">
                        <div class="timeoff-unique-field-01">
                            <div class="grey-up">
                                <label for="employeeId">EMPLOYEE ID</label>
                            </div>
                            <div>
                                <input type="text" id="employeeId" name="employeeId" class="timeoff-unique-inputs" value="<?php echo $data['employeeId']; ?>" placeholder="Employee ID" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="timeoff-unique-field-02">
                            <div class="grey-up">
                                <label for="leavedate">REQUESTED DATE</label>
                            </div>
                            <div>
                                <input type="date" id="leavedate" name="leavedate" class="timeoff-unique-inputs" value="<?php echo $data['leavedate']; ?>" placeholder="Leave Date" required>
                            </div>
                        </div>
                    </div>
                    <div class="timeoff-unique-field-03">
                        <div class="grey-up">
                            <label for="reason">REASON</label>
                        </div>
                        <div>
                            <textarea id="timeoff-reason" name="reason" class="timeoff-reason-input" placeholder="Maximum 500 characters" required><?php echo $data['reason']; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="text-center marginy-2">
                        <button class="action-one-button width-100per" type="submit" onClick={this.onSubmit}>Submit</button>
                    </div>
                    <div class="text-center marginy-2">
                        <button class="free-action-button width-100per" type="reset">Reset</button>
                    </div>

                    <div class="popup-close-icon"><img src="<?php echo URL_ROOT; ?>public/images/icons/close.png" class="popup-close-icon" onclick="closeThisPopup('newTimeOffPopUp')"></div>

                </div>
            </div>
        </div>


        <!-- DELETE CONFIRMATION POPUP BOX (THIS IS INCLUDED HERE BECAUSE IT HAS TO BE CENTRALIZED ON CONTENT AREA) -->
        <div class="delete-conf-blur horizontal-centralizer display-none" id="popupWindow">
            <div class="vertical-centralizer">

                <div class="del-confirm-box">
                    <div class="del-confirm-box-content">
                        <div class="del-confirm-msg-box">Are you sure?</div>
                        <div class="del-conf-button-set">
                            <div class="del-conf-button-box">
                                <form method="POST" action="<?php echo URL_ROOT; ?>Supervisors/removeleave">
                                    <input type="hidden" name="leave_id" id="form-leave-id">
                                    <button type="submit" class="delete-button-2">Remove</button>
                                    <!-- <button onclick="confirmDeletion()" class="delete-button-2">Remove</button> -->
                                </form>
                            </div>
                            <div class="del-conf-button-box">
                                <button onclick="closeleaveDeleteConfirmation()" class="edit-button-2">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>