<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>


<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section class="content-area position-absolute">

    <?php
        // $messege = $_SESSION['return_message'];

        $success_message = $_SESSION['success_message'];
        $error_message = $_SESSION['error_message'];

        $_SESSION['success_message'] = '';
        $_SESSION['error_message'] = '';
    ?>

    <?php
        echo ($error_message == '') ? '<div id="messagebox" class="hideme success-msg"><div><strong>SUCCESS!</strong></div><div>'. $success_message .'</div></div>' : 
        '<div id="messagebox" class="hideme error-msg"><div><strong>ERROR!</strong></div><div>'. $error_message .'</div></div>';
    ?>

    <?php
        echo ($error_message == '' and $success_message == '') ? '<div class="sup-leave-list-content">' : '<div class="sup-leave-list-content">
        <script type="text/javascript">notifyMe();</script>';
    ?>

    <div class="border-gray display-flex-column formbox">

        <form action="<?php echo URL_ROOT; ?>Supervisors/addleave" method="POST" class="wide"><br>
            <div class="form-headings align-self-start">
                Record new leave
            </div>
            <div class="display-flex-row justify-content-between marginy-3">
                <div class="display-flex-column">
                    <div class="grey-up">
                        <label>EMPLOYEE ID</label>
                    </div>
                    <div>
                        <input type="text" id="employeeId" name="employeeId" class="form-input" value="<?php echo $data['employeeId']; ?>" placeholder="Employee Id" autocomplete="off" required>
                    </div>
                </div>
                <div class="width-25"> </div>
                <div class="display-flex-column">
                    <div class="grey-up">
                        <label>REQUESTED DATE</label>
                    </div>
                    <div>
                        <input type="date" id="leavedate" name="leavedate" class="form-input" value="<?php echo $data['leavedate']; ?>" placeholder="Leave Date" required>
                    </div>
                </div>
            </div>


            <div class="display-flex-column justify-content-between marginy-3">
                <div class="grey-up">
                    <label>REASON</label>
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
            <div class="text-center marginy-2">
                <a href="<?php echo URL_ROOT; ?>Supervisors/leaves" class="text-decoration-none">Cancel</a>
            </div>

        </form>
    </div>

    </div>
</section>


<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>