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
                    <h1>Accepted leave info</h1>
                </div>
                <div class="display-flex-column justify-content-center">
                    <a class="text-decoration-none" href="<?php echo URL_ROOT; ?>Supervisors/addleave">
                        <button class="head-button" type="button">Add New Leave</button>
                    </a>
                </div>
            </div>

            <!-- LEAVES DATA TABLE -->
            <div class="sup-leave-list-info-box">
                <div class="sup-leave-list-non-edit">
                    <div class="leave-value block-heading">Employee Id</div>
                    <div class="leave-value block-heading">First Name</div>
                    <div class="leave-value block-heading">Last Name</div>
                    <div class="leave-value block-heading">Leave date</div>
                    <div class="leave-value block-heading padding-right-5">Reason</div>
                </div>
                <?php
                foreach ($data['LeaveDetails'] as $value) {
                    echo '<div class="div-ender"></div>
                            <div class="sup-leave-list-non-edit">
                                <div class="display-none leave-identifier">' . $value->LeaveId . '</div>
                                <div class="leave-value">' . $value->EmployeeId . '</div>
                                <div class="leave-value">' . $value->Firstname . '</div>
                                <div class="leave-value">' . $value->Lastname . '</div>
                                <div class="leave-value">' . $value->LeaveDate . '</div>
                                <div class="leave-value padding-right-5">' . $value->Reason . '</div>


                                <form method="POST" action="'.URL_ROOT.'Supervisors/getEditingData">
                                <div class="leave-edit-info padding-left-2">
                                    <input type="hidden" name="leave_id" value="'. $value->LeaveId .'">
                                    <input type="submit" name="edit" class="edit-button" value="Edit">
                                    </div>
                                </form>
    
                                <!-- <form method="POST" action="'.URL_ROOT.'Supervisors/removeleave"> -->
                                <div class="leave-edit-info">
                                    <!-- <input type="hidden" name="leave_id" value="', $value->LeaveId ,'">
                                    <input type="submit" name="remove" class="delete-button" value="Remove"> -->
                                    <button class="delete-button" onclick="leaveDeleteConfirmation(\''.$value->LeaveId. '\')">Remove</button>
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
                                <div>Nothing to show</div>
                            </div>
                        </div>';
                }
                
                ?>
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