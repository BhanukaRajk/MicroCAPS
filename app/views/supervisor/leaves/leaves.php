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


        <div class="background-bluer" id="timeOffUpdatePopUp">
            <div class="vertical-centralizer">
            <div class="time-off-update-popup display-flex-column">

                <div>New Time-off</div>
                <div class="display-flex-row justify-content-between marginy-3">
                    <div class="display-flex-column">
                        <div class="grey-up">
                            <label for="employeeId">EMPLOYEE ID</label>
                        </div>
                        <div>
                            <input type="text" id="employeeId" name="employeeId" class="form-input" value="<?php echo $data['employeeId']; ?>" placeholder="Employee Id" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="display-flex-column">
                        <div class="grey-up">
                            <label for="leavedate">REQUESTED DATE</label>
                        </div>
                        <div>
                            <input type="date" id="leavedate" name="leavedate" class="form-input" value="<?php echo $data['leavedate']; ?>" placeholder="Leave Date" required>
                        </div>
                    </div>
                </div>
                <div class="display-flex-column justify-content-between marginy-3">
                    <div class="grey-up">
                        <label for="reason">REASON</label>
                    </div>
                    <div>
                        <textarea id="reason" name="reason" class="form-input" placeholder="Maximum 500 characters" required><?php echo $data['reason']; ?></textarea>
                    </div>
                </div>
                <div class="text-center marginy-2">
                    <button class="reset-button wide" type="reset">Reset</button>
                </div>
                <div class="text-center marginy-2">
                    <button class="submit-button wide" type="submit" onClick={this.onSubmit}>Submit</button>
                </div>

                <div class="popup-close-icon"></div>




<!--                <div class="popup-left">-->
<!--                    <div class="horizontal-centralizer cs-popup-csname">-->
<!--                        <div class="form-toolname">TOOL NAME</div>-->
<!--                    </div>-->
<!--                    <div class="horizontal-centralizer">-->
<!--                        <div class="">-->
<!--                            <img class="consumable-popup-img" src="--><?php //echo URL_ROOT; ?><!--public/images/consumables/image1.png" class="carpic" alt="Consumable" id="formToolImg">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="horizontal-centralizer">-->
<!--                        <div class="form-tool-quantity">Quantity: QUANTITY</div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="border-div"></div>-->
<!--                <div class="popup-right">-->
<!--                    <div class="horizontal-centralizer">-->
<!--                        <div class="popup-box-heading1 margin-top-4">Update Tool Status</div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="horizontal-centralizer last-update margin-top-3">-->
<!--                        <div class="form-tool-lastupdate">Last update: DATE AND TIME</div>-->
<!--                    </div>-->
<!---->
<!---->
<!--                    <form method="POST" action="--><?php //echo URL_ROOT; ?><!--Supervisors/updateThisTool">-->
<!--                        <div class="horizontal-centralizer margin-top-4">-->
<!--                            <div>-->
<!---->
<!--                                <select name="tool-status" id="formToolStatus" class="form-tool-status">-->
<!--                                    <option id="status-opt1" value="Need an attention">Need an attention</option>-->
<!--                                    <option id="status-opt2" value="Normal">Normal</option>-->
<!--                                </select>-->
<!---->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="display-flex-row justify-content-center margin-top-2">-->
<!--                            <input type="hidden" name="tool_id_status" id="status-form-tool-id">-->
<!--                            <div><button type="submit" class="edit-button consume-update">Update</button></div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                    <div class="display-flex-row justify-content-center marginy-3">-->
<!--                        <div><button onclick="showToolDelConfBox()" class="delete-button consume-update">Remove item</button></div>-->
<!--                    </div>-->
<!--                    <div class="display-flex-row justify-content-center margin-top-2">-->
<!--                        <div><a onclick="closeToolUpdatePopup()" class="mouse-pointer">Close</a></div>-->
<!--                    </div>-->
<!--                </div>-->
            </div></div>
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