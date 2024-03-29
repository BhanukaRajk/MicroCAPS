<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="border-gray display-flex-column formbox">

            <form action="<?php echo URL_ROOT; ?>Supervisors/updateLeave" method="post">

                <?php $value = $data['EditorDetails']; ?>


                <div class="form-headings align-self-start">
                    Update leave details
                </div>

                <div>
                    <input type="text" id="leaveId" name="leaveId" class="display-none" value="<?php echo (empty($data['leaveId'])) ? $value->Leave_Id : $data['leaveId']; ?>" required>
                </div>

                <div class="display-flex-row justify-content-between marginy-3">
                    <div class="display-flex-column">
                        <div class="grey-up">
                            <label>EMPLOYEE ID</label>
                        </div>
                        <div>
                            <input type="text" id="employeeId" name="employeeId" class="form-input" value="<?php echo (empty($data['employeeId'])) ? $value->EmployeeId : $data['employeeId']; ?>" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="width-25"> </div>
                    <div class="display-flex-column">
                        <div class="grey-up">
                            <label>REQUESTED DATE</label>
                        </div>
                        <div>
                            <input type="date" id="leavedate" name="leavedate" class="form-input" value="<?php echo (empty($data['leavedate'])) ? $value->LeaveDate : $data['leavedate']; ?>" required>
                        </div>
                    </div>
                </div>


                <div class="display-flex-column justify-content-between marginy-3">
                    <div class="grey-up">
                        <label>REASON</label>
                    </div>
                    <div>
                        <textarea id="reason" name="reason" class="form-input" required><?php echo (empty($data['reason'])) ? $value->Reason : $data['reason']; ?></textarea>
                        <!-- <input type="text" id="reason" name="reason" class="form-control" placeholder="Reason" required> -->
                    </div>
                </div>

                <div class="text-center marginy-2">
                    <button class="submit-button wide" type="submit" onClick={this.onSubmit}>Submit</button>
                </div>
                <div class="text-center marginy-2">
                    <a href="<?php echo URL_ROOT; ?>supervisors/leaves" class="text-decoration-none">Cancel</a>
                </div>

            </form>

        </div>
    </div>
</section>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>