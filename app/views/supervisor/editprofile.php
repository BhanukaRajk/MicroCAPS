<?php require_once APP_ROOT . '/views/includes/header.php'; ?>


<?php require_once APP_ROOT . '/views/supervisor/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/topnavbar.php'; ?>

<!-- top navbar bottom -> bottom
     left navbar right -> right
-->
<section class="sup-edit-prof-page">
    <!-- take 2rem margin from left and right -->
    <div class="sup-edit-prof-content">

        <!-- Content window -->
        <div class="sup-edit-prof-databox">

            <div class="sup-edit-prof-heading">
                <h1>Profile info</h1>
            </div>

            <?php $userdata = $data['ProfileDetails']; ?>

            <!-- Your info not-editable -->
            <div class="sup-edit-prof-info-box">
                <div class="sup-edit-prof-non-edit">
                    <div class="block-heading">Basic Info</div>
                </div>
                <div class="sup-edit-prof-edit">
                    <div class="prof-property">First Name</div>
                    <div class="prof-value"><?php echo $userdata->Firstname; ?></div>
                    <div class="sup-edit-info">Edit</div>
                </div>
                <div class="div-ender"></div>
                <div class="sup-edit-prof-edit">
                    <div class="prof-property">Last Name</div>
                    <div class="prof-value"><?php echo $userdata->Lastname; ?></div>
                    <div class="sup-edit-info">Edit</div>
                </div>
                <div class="div-ender"></div>
                <div class="sup-edit-prof-non-edit">
                    <div class="prof-property">Employee ID</div>
                    <div class="prof-value"><?php echo $userdata->EmployeeId; ?></div>
                </div>
                <div class="div-ender"></div>
                <div class="sup-edit-prof-non-edit">
                    <div class="prof-property">Role</div>
                    <div class="prof-value"><?php echo $userdata->Position; ?></div>
                </div>
                <div class="div-ender"></div>
                <div class="sup-edit-prof-non-edit">
                    <div class="prof-property">Stage</div>
                    <div class="prof-value"><?php echo $userdata->StageNo; ?></div>
                </div>
            </div>

            <!-- Your info editable -->
            <div class="sup-edit-prof-info-box">
                <div class="sup-edit-prof-non-edit">
                    <div class="block-heading">Contact & security Info</div>
                </div>
                <div class="sup-edit-prof-non-edit">
                    <div class="prof-property">Mobile Number</div>
                    <div class="prof-value"><?php echo $userdata->TelephoneNo; ?></div>
                </div>
                <div class="div-ender"></div>
                <div class="sup-edit-prof-edit">
                    <div class="prof-property">Email</div>
                    <div class="prof-value"><?php echo $userdata->Email; ?></div>
                    <div class="sup-edit-info">Edit</div>
                </div>
                <div class="div-ender"></div>
                <div class="sup-edit-prof-edit">
                    <div class="prof-property">Password</div>
                    <div class="prof-value">xxxxxxxxxx</div>
                    <div class="sup-edit-info">Edit</div>
                </div>
            </div>

        </div>
    </div>
</section>


<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>