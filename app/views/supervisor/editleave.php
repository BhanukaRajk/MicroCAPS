<?php require_once APP_ROOT . '/views/includes/header.php'; ?>

<div class="display-flex-row">
    <div>
        <?php require_once APP_ROOT . '/views/supervisor/leftnavbar.php'; ?>
    </div>
    <div class="display-flex-column">
        <div>
            <?php require_once APP_ROOT . '/views/supervisor/topnavbar.php'; ?>
        </div>
        <div>

            <section class="content-area position-absolute">
                <div class="border-gray display-flex-column formbox">
                    <div class="display-flex-row justify-content-between wider">
                        <div>
                            <p class="display-none">X</p>
                        </div>
                        <div class="form-headings text-center">
                            Update leave details
                        </div>
                        <div class="marginy-auto">
                            <a href="<?php echo URL_ROOT; ?>supervisors/leaves">
                                <button type="button" class="close-x">X</button>
                            </a>
                        </div>
                    </div>

                    <form action="<?php echo URL_ROOT; ?>Supervisors/editleave" method="post">

                        <?php $value = $data['EditorDetails']; ?>

                        <div>
                            <input type="text" id="leaveId" name="leaveId" class="display-none" value="<?php echo $value->Leave_Id; ?>" required>
                        </div>

                        <div class="display-flex-row justify-content-between marginy-3 wide">
                            <div>
                                <label><b>Employee Id:</b></label>
                            </div>
                            <div>
                                <input type="text" id="employeeId" name="employeeId" class="form-input" value="<?php echo $value->EmployeeId; ?>" placeholder="Employee Id" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="display-flex-row justify-content-between marginy-3">
                            <div>
                                <label><b>Requested date:</b></label>
                            </div>
                            <div>
                                <input type="date" id="leavedate" name="leavedate" class="form-input" value="<?php echo $value->LeaveDate; ?>" placeholder="Leave Date" required>
                            </div>
                        </div>

                        <div class="display-flex-row justify-content-between marginy-3">
                            <div>
                                <label><b>Reason:</b></label>
                            </div>
                            <div>
                                <textarea id="reason" name="reason" class="form-input" required><?php echo $value->Reason; ?></textarea>
                                <!-- <input type="text" id="reason" name="reason" class="form-control" placeholder="Reason" required> -->
                            </div>
                        </div>

                        <div class="text-center marginy-2">
                            <button class="submit-button wide" type="submit" onClick={this.onSubmit}>Update</button>
                        </div>

                    </form>

                </div>
            </section>

        </div>
    </div>
</div>


<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>