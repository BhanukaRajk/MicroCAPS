<?php require_once APP_ROOT . '/views/admin/includes/header.php'; ?>
<?php require_once APP_ROOT . '/views/admin/includes/navbar.php'; ?>

<section class="position-absolute page-content">
    <div class="display-flex-row margin-bottom-3 align-items-center justify-content-between width-100">
        <div class="page-heading font-weight">
            Employees
        </div>
        <div>
            <a href="<?php echo URL_ROOT; ?>admins/add">
                <div class="next">
                    <button type="button" class="btn btn-primary btn-noback">Add New Employees</button>
                </div>
            </a>
        </div>
    </div>


    <div class="profile-detail-board  margin-bottom-4">
        <div class="profile-data-board justify-content-evenly">
            <?php foreach($data['managerDetail'] as $value) {

                echo '<div class="profile-card">
                        <div class="display-flex-row justify-content-between">
                            <div class="profile-img">
                                <div style="background-image:url('. URL_ROOT .'public/images/profile/'.$value->Image.')" class="width-rem-8p5 height-rem-8p5 background-image border-radius-11"></div>
                            </div>
                            <div class="display-flex-row gap-1">
                                <i class="fa-solid fa-pen-to-square text-gray text-hover-blue"></i>
                                <i class="fa-solid fa-trash-can text-gray text-hover-red"></i>
                            </div>
                        </div>
                        <div class="cardhead">
                            <div>
                                <div class="profile-name">'. $value->Firstname . ' ' . $value->Lastname .'</div>                                            
                                <div class="position">'.$value->Position.'</div>
                            </div>
                        </div>
                    </div>';
            }

            ?>

        </div>
    </div>

    <div class="profile-detail-board  margin-bottom-4">
        <div class="profile-data-board justify-content-evenly">
            <?php foreach($data['supervisorDetail'] as $value) {

                echo '<div class="profile-card">
                        <div class="display-flex-row justify-content-between">
                            <div class="profile-img">
                                <div style="background-image:url('. URL_ROOT .'public/images/profile/'.$value->Image.')" class="width-rem-8p5 height-rem-8p5 background-image border-radius-11"></div>
                            </div>
                            <div class="display-flex-row gap-1">
                                <i class="fa-solid fa-pen-to-square text-gray text-hover-blue"></i>
                                <i class="fa-solid fa-trash-can text-gray text-hover-red" onclick="deleteEmployee(\'' . $value->EmployeeId . '\')"></i>
                            </div>
                        </div>
                        <div class="cardhead">
                            <div>
                                <div class="profile-name">'. $value->Firstname . ' ' . $value->Lastname .'</div>                                            
                                <div class="position">'.$value->Position.'</div>
                            </div>
                        </div>
                    </div>';
            }

            ?>

        </div>
    </div>

    <div class="profile-detail-board  margin-bottom-4">
        <div class="profile-data-board justify-content-evenly">
            <?php foreach($data['testerDetail'] as $value) {

                echo '<div class="profile-card">
                        <div class="display-flex-row justify-content-between">
                            <div class="profile-img">
                                <div style="background-image:url('. URL_ROOT .'public/images/profile/'.$value->Image.')" class="width-rem-8p5 height-rem-8p5 background-image border-radius-11"></div>
                            </div>
                            <div class="display-flex-row gap-1">
                                <i class="fa-solid fa-pen-to-square text-gray text-hover-blue"></i>
                                <i class="fa-solid fa-trash-can text-gray text-hover-red"></i>
                            </div>
                        </div>
                        <div class="cardhead">
                            <div>
                                <div class="profile-name">'. $value->Firstname . ' ' . $value->Lastname .'</div>                                            
                                <div class="position">'.$value->Position.'</div>
                            </div>
                        </div>
                    </div>';
            }

            ?>

        </div>
    </div>
</section>

<section class="display-flex-column">

    <div id="alert" class="hideme" role="alert"></div>

</section>

<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/adminjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/adminjs/cors.js"></script>

</body>

</html>