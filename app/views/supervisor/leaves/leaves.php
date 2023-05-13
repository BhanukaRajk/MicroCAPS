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
                    <h1>Accepted time offs info</h1>
                </div>
                <div class="display-flex-column justify-content-center">
                    <button class="adding-button" type="button" onclick="showThisPopup('newTimeOffPopUp')">Add New Time Off</button>
                </div>
            </div>

            <!-- LEAVES DATA TABLE -->
            <div class="sup-leave-list-info-box">
                <div class="sup-leave-list-non-edit">
                    <div class="leave-value block-heading">Employee Id</div>
                    <div class="leave-value block-heading">Name</div>
                    <div class="leave-value block-heading">Requested date</div>
                    <div class="leave-value block-heading padding-right-5">Reason</div>
                </div>

                <?php
                if($data['LeaveDetails'] == NULL) {
                    echo '<div class="horizontal-centralizer no-leave-data">
                            <div class="vertical-centralizer">
                                <div>No data available</div>
                            </div>
                        </div>';
                    
                } else {
                    foreach ($data['LeaveDetails'] as $value) {
                        echo '<div class="div-ender"></div>
                                <div class="sup-leave-list-non-edit">
                                    <div class="display-none leave-identifier">' . $value->LeaveId . '</div>
                                    <div class="leave-value leave-value-emp">' . $value->EmployeeId . '</div>
                                    <div class="leave-value ">' . $value->Name . '</div>
                                    <div class="leave-value leave-value-date">' . $value->LeaveDate . '</div>
                                    <div class="leave-value padding-right-5 leave-value-reason">' . $value->Reason . '</div>


                                    <div class="leave-edit-info ppadding-left-2">
                                        <img src="'. URL_ROOT .'public/images/icons/edit.png" onclick="expandThisLeave(this.parentNode.parentNode)" class="width-rem-1p25 mouse-pointer" alt="edit">
                                    </div>
        
                                    <div class="leave-edit-info">
                                        <img src="'. URL_ROOT .'public/images/icons/delete.png" onclick="leaveDeleteConfirmation(\''.$value->LeaveId. '\')" class="width-rem-1p25 mouse-pointer" alt="remove">
                                    </div>
                                    
                                </div>
                                <div class="panel">
                                    <p>' . $value->Reason . '</p>
                                </div>';
                    }
                }
                
                ?>
            </div>

        </div>



        <!-- UPDATE TIME OFF POPUP BOX (THIS IS INCLUDED HERE BECAUSE IT HAS TO BE CENTRALIZED ON CONTENT AREA) -->
        <form method="POST" action="<?php echo URL_ROOT; ?>Supervisors/updateThisLeave" id="leaveUpdate">
        <div class="background-bluer display-none" id="timeOffUpdatePopUp">
            <div class="vertical-centralizer">
                <div class="time-off-update-popup">

                    <div class="timeoff-heading horizontal-centralizer">
                        <div>UPDATE TIME-OFF</div>
                        <input type="hidden" id="updt-timeoffId" name="timeoffId" class="timeoff-unique-inputs">
                    </div>
                    <div class="timeoff-unique-fields">
                        <div class="timeoff-unique-field-01">
                            <div class="grey-up">
                                <label for="employeeId">EMPLOYEE ID</label>
                            </div>
                            <div>
                                <input type="text" id="updt-employeeId" name="employeeId" class="timeoff-unique-inputs" placeholder="Employee ID" required>
                            </div>
                        </div>
                        <div class="timeoff-unique-field-02">
                            <div class="grey-up">
                                <label for="leavedate">REQUESTED DATE</label>
                            </div>
                            <div>
                                <input type="date" id="updt-leavedate" name="leavedate" class="timeoff-unique-inputs" placeholder="Leave Date" required>
                            </div>
                        </div>
                    </div>
                    <div class="timeoff-unique-field-03">
                        <div class="grey-up">
                            <label for="reason">REASON</label>
                        </div>
                        <div>
                            <textarea id="updt-timeoff-reason" name="reason" class="timeoff-reason-input" placeholder="Maximum 500 characters" required></textarea>
                        </div>
                    </div>
                    
                    <div class="text-center marginy-2">
                        <button class="action-one-button width-100per" type="submit">Submit</button>
                    </div>
                    <div class="text-center marginy-2">
                        <button class="free-action-button width-100per" type="reset">Reset</button>
                    </div>

                    <div class="popup-close-icon"><img src="<?php echo URL_ROOT; ?>public/images/icons/close.png" class="popup-close-icon" onclick="closeThisPopup('timeOffUpdatePopUp')"></div>

                </div>
            </div>
        </div>
        </form>



        <!-- ADD NEW TIMEOFF POPUP BOX (THIS IS INCLUDED HERE BECAUSE IT HAS TO BE CENTRALIZED ON CONTENT AREA) -->
        <form method="POST" action="<?php echo URL_ROOT; ?>Supervisors/addleave" id="newLeave">
            <div class="background-bluer display-none" id="newTimeOffPopUp">
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
                                    <input type="text" id="add-employeeId" name="employeeId" class="timeoff-unique-inputs" placeholder="Employee ID" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="timeoff-unique-field-02">
                                <div class="grey-up">
                                    <label for="leavedate">REQUESTED DATE</label>
                                </div>
                                <div>
                                    <input type="date" id="add-leavedate" name="leavedate" class="timeoff-unique-inputs" placeholder="Leave Date" required>
                                </div>
                            </div>
                        </div>
                        <div class="timeoff-unique-field-03">
                            <div class="grey-up">
                                <label for="reason">REASON</label>
                            </div>
                            <div>
                                <textarea id="add-timeoff-reason" name="reason" class="timeoff-reason-input" placeholder="Maximum 500 characters" required></textarea></textarea>
                            </div>
                        </div>
                        
                        <div class="text-center marginy-2">
                            <button class="action-one-button width-100per" type="submit">Submit</button>
                        </div>
                        <div class="text-center marginy-2">
                            <button class="free-action-button width-100per" type="reset">Reset</button>
                        </div>

                        <div class="popup-close-icon"><img src="<?php echo URL_ROOT; ?>public/images/icons/close.png" class="popup-close-icon" onclick="closeThisPopup('newTimeOffPopUp')"></div>

                    </div>
                </div>
            </div>
        </form>



        

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

<script src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/leaves.js"></script>

<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>