<?php require_once APP_ROOT . '\views\includes\header.php'; ?>


<?php require_once APP_ROOT . '\views\supervisor\leftnavbar.php'; ?>
<?php require_once APP_ROOT . '\views\supervisor\topnavbar.php'; ?>

<section class="position-absolute page-content">
    <div class="leave_form">
<?php print_r($data['LeaveDetails']) ?>
    </div>
</section>


<section class="shell-forms position-absolute">
    <div class="display-flex-column align-items-center border-radius-1 background-white paddingx-5 paddingy-5">
        <?php
            foreach($data['LeaveDetails'] as $value) {
                echo '<div class="display-flex-row justify-content-center align-items-center paddingy-2 paddingx-3 border-bottom gap-46">
                <div class="display-flex-row align-items-start">
                    <div class="display-flex-column align-items-start">
                        <div class="font-weight">'.$value->employeeId.'</div>
                        <div class="text-gray">'.$value->leavedate.'</div>
                        <div class="text-gray">'.$value->reason.'</div>
                    </div>
                </div>
            </div>';
            }
        ?>
    </div>
</section>


<?php require_once APP_ROOT . '\views\includes\footer.php'; ?>