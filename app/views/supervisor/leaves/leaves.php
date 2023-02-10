<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>


<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section id="main" class="sup-leave-list-page">

<?php
    $messege = $_SESSION['return_message'];
    $_SESSION['return_message'] = '';    
?>

    <div id="messagebox" class="hideme"><?php echo $messege;?></div>

<?php  
    echo ($messege == '') ? '<div class="sup-leave-list-content">' : '<div class="sup-leave-list-content">
    <script type="text/javascript">myFunction();</script>
     ';
?>

    <!-- TAKE 2REM MARGIN FROM LEFT AND RIGHT -->

        <!-- CONTENT WINDOW -->
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
                                <div class="leave-value">' . $value->EmployeeId . '</div>
                                <div class="leave-value">' . $value->Firstname . '</div>
                                <div class="leave-value">' . $value->Lastname . '</div>
                                <div class="leave-value">' . $value->LeaveDate . '</div>
                                <div class="leave-value padding-right-5">' . $value->Reason . '</div>


                                <form method="POST" action="'.URL_ROOT.'Supervisors/editleave">
                                <div class="leave-edit-info padding-left-2">
                                    <input type="hidden" name="leave_id" value="'. $value->LeaveId .'">
                                    <input type="submit" name="edit" class="edit-button" value="Edit">
                                    </div>
                                </form>
    
                                <form method="POST" action="'.URL_ROOT.'Supervisors/removeleave">
                                <div class="leave-edit-info">
                                    <input type="hidden" name="leave_id" value="'. $value->LeaveId .'">
                                    <input type="submit" name="remove" class="delete-button" value="Remove">
                                    </div>
                                </form>
                                
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
    </div>
</section>


<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>