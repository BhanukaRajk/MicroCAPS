<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>


<?php require_once APP_ROOT . '/views/sup/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/sup/topnavbar.php'; ?>

<!-- top navbar bottom -> bottom
     left navbar right -> right
-->
<section class="sup-edit-prof-page">
    <!-- take 2rem margin from left and right -->
    <div class="sup-edit-prof-content">

        <!-- Content window -->
        <div class="sup-edit-prof-databox">

            <div class="sup-edit-prof-heading">
                <h1>Scheduled Task List</h1>
            </div>

            <!-- Your info not-editable -->
            <div class="sup-edit-prof-info-box">
                <div class="sup-edit-prof-non-edit">
                    <div class="block-heading">Basic Info</div>
                </div>
                <div class="sup-edit-prof-non-edit">
                    <div class="prof-property">First Name</div>
                    <div class="prof-value">Alex</div>
                </div>
                <div class="div-ender"></div>
                <div class="sup-edit-prof-non-edit">
                    <div class="prof-property">Last Name</div>
                    <div class="prof-value">Hales</div>
                </div>
                <div class="div-ender"></div>
                <div class="sup-edit-prof-non-edit">
                    <div class="prof-property">Employee ID</div>
                    <div class="prof-value">EMP1203</div>
                </div>
                <div class="div-ender"></div>
                <div class="sup-edit-prof-non-edit">
                    <div class="prof-property">Role</div>
                    <div class="prof-value">Supervisor</div>
                </div>
            </div>

            <!-- Your info editable -->
            <div class="sup-edit-prof-info-box">
                <div class="sup-edit-prof-non-edit">
                    <div class="block-heading">Contact & security Info</div>
                </div>
                <div class="sup-edit-prof-edit">
                    <div class="prof-property">Mobile Number</div>
                    <div class="prof-value">077 6655990</div>
                    <div class="sup-edit-info">Edit</div>
                </div>
                <div class="div-ender"></div>
                <div class="sup-edit-prof-edit">
                    <div class="prof-property">Email</div>
                    <div class="prof-value">alexhalesengland@gmail.com</div>
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


<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>