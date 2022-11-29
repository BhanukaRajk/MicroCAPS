<?php require_once APP_ROOT . '/views/includes/header.php'; ?>


<?php require_once APP_ROOT . '/views/supervisor/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/topnavbar.php'; ?>

<section id="main" class="sup-leave-list-page">
    <!-- take 2rem margin from left and right -->
    <div class="sup-leave-list-content">

        <!-- Content window -->
        <div class="sup-leave-list-databox">

            <div class="sup-leave-list-headbox">
                <div class="sup-leave-list-heading">
                    <h1>Accepted leave info</h1>
                </div>
                <div class="display-flex-column justify-content-center">
                    <a class="text-decoration-none" href="<?php echo URL_ROOT; ?>supervisors/addleave">
                        <button class="head-button" type="button">Add New Leave</button>
                    </a>
                </div>
            </div>

            <!-- Your info not-editable -->
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

                                <!-- <div class="leave-edit-info"><a href="'.URL_ROOT.'supervisors/editleave?id='.$value->EmployeeId.'&ldate='.$value->LeaveDate.'" class="edit-button">Edit</a></div> -->
                                
                                <div class="leave-edit-info padding-left-3"><a href="'.URL_ROOT.'supervisors/editleave?id='.$value->Leave_Id.'" class="edit-button">Edit</a></div>
                                <div class="leave-edit-info"><a href="'.URL_ROOT.'supervisors/removeleave?id='.$value->Leave_Id.'" class="delete-button">Remove</a></div>
                            </div>';
                }
                ?>
            </div>

        </div>
    </div>
</section>


<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>