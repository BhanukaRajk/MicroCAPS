<?php require_once APP_ROOT . '\views\admin\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\admin\includes\navbar.php'; ?>

<section class="position-absolute page-content">
    <div class="display-flex-row margin-bottom-3 align-items-center justify-content-between width-100">
        <div class="page-heading font-weight">
            Employees
        </div>
        <div>
            <a href="<?php echo URL_ROOT; ?>admins\employees\add">
                <div class="next">
                    <button type="button" class="btn btn-primary btn-noback">Add New Employees</button>
                </div>
            </a>
        </div>
    </div>


    <div class="page-content-2">
        <?php
            if ($data['managerDetail'] != null) {
                echo '<div class="profile-detail-board  margin-bottom-4">
                        <div class="profile-data-board">';

                foreach ($data['managerDetail'] as $value) {

                    echo '<div class="profile-card">
                            <div class="display-flex-row justify-content-between">
                                <div class="profile-img">
                                    <div style="background-image:url(' . URL_ROOT . 'public/images/profile/' . $value->Image . ')" class="width-rem-8p5 height-rem-8p5 background-image border-radius-11"></div>
                                </div>
                                <div class="display-flex-row gap-0p5">
                                <a href="' . URL_ROOT . 'admins/employees/edit/' . $value->EmployeeId . '"> <i class="fa-solid fa-pen-to-square edit"></i></a>
                                    <i class="fa-solid fa-trash-can delete" onclick="deleteEmployee(\'' . $value->EmployeeId . '\')"></i>
                                </div>
                            </div>
                            <div class="cardhead">
                                <div>
                                    <div class="profile-name">' . $value->Firstname . ' ' . $value->Lastname . '</div>                                            
                                    <div class="position">' . $value->Position . '</div>
                                </div>
                            </div>
                        </div>';
                }
            }

            echo '</div>
                </div>';
        ?>

        <?php
            if ($data['supervisorDetail'] != null) {
                echo '<div class="profile-detail-board  margin-bottom-4">
                            <div class="profile-data-board">';

                foreach ($data['supervisorDetail'] as $value) {

                    echo '<div class="profile-card">
                                <div class="display-flex-row justify-content-between">
                                    <div class="profile-img">
                                        <div style="background-image:url(' . URL_ROOT . 'public/images/profile/' . $value->Image . ')" class="width-rem-8p5 height-rem-8p5 background-image border-radius-11"></div>
                                    </div>
                                    <div class="display-flex-row gap-0p5">
                                    <a href="' . URL_ROOT . 'admins/employees/edit/' . $value->EmployeeId . '"> <i class="fa-solid fa-pen-to-square edit"></i></a>
                                        <i class="fa-solid fa-trash-can delete" onclick="deleteEmployee(\'' . $value->EmployeeId . '\')"></i>
                                    </div>
                                </div>
                                <div class="cardhead">
                                    <div>
                                        <div class="profile-name">' . $value->Firstname . ' ' . $value->Lastname . '</div>                                            
                                        <div class="position">' . $value->Position . '</div>
                                    </div>
                                </div>
                            </div>';
                }

                echo '</div>
                    </div>';
            }
        ?>

        <?php
            if ($data['assemblerDetail'] != null) {
                echo '<div class="profile-detail-board  margin-bottom-4">
                            <div class="profile-data-board">';

                foreach ($data['assemblerDetail'] as $value) {

                    echo '<div class="profile-card">
                                <div class="display-flex-row justify-content-between">
                                    <div class="profile-img">
                                        <div style="background-image:url(' . URL_ROOT . 'public/images/profile/' . $value->Image . ')" class="width-rem-8p5 height-rem-8p5 background-image border-radius-11"></div>
                                    </div>
                                    <div class="display-flex-row gap-0p5">
                                    <a href="' . URL_ROOT . 'admins/employees/edit/' . $value->EmployeeId . '"> <i class="fa-solid fa-pen-to-square edit"></i></a>
                                        <i class="fa-solid fa-trash-can delete" onclick="deleteEmployee(\'' . $value->EmployeeId . '\')"></i>
                                    </div>
                                </div>
                                <div class="cardhead">
                                    <div>
                                        <div class="profile-name">' . $value->Firstname . ' ' . $value->Lastname . '</div>                                            
                                        <div class="position">' . $value->Position . '</div>
                                    </div>
                                </div>
                            </div>';
                }

                echo '</div>
                        </div>';

            }

        ?>

        <?php
            if ($data['testerDetail'] != null) {
                echo '<div class="profile-detail-board  margin-bottom-4">
                    <div class="profile-data-board">';

                foreach ($data['testerDetail'] as $value) {

                    echo '<div class="profile-card">
                                <div class="display-flex-row justify-content-between">
                                    <div class="profile-img">
                                        <div style="background-image:url(' . URL_ROOT . 'public/images/profile/' . $value->Image . ')" class="width-rem-8p5 height-rem-8p5 background-image border-radius-11"></div>
                                    </div>
                                    <div class="display-flex-row gap-0p5">
                                    <a href="' . URL_ROOT . 'admins/employees/edit/' . $value->EmployeeId . '"> <i class="fa-solid fa-pen-to-square edit"></i></a>
                                        <i class="fa-solid fa-trash-can delete" onclick="deleteEmployee(\'' . $value->EmployeeId . '\')"></i>
                                    </div>
                                </div>
                                <div class="cardhead">
                                    <div>
                                        <div class="profile-name">' . $value->Firstname . ' ' . $value->Lastname . '</div>                                            
                                        <div class="position">' . $value->Position . '</div>
                                    </div>
                                </div>
                            </div>';
                }
            }

            echo '</div>
                </div>';
        ?>


        <div class="toolset-filterbox">
            <div class="toolfilter">
                <div class="filter-head">Filter by</div>
                <div class="line"></div>
                <div class="filters">


                    <div class="filtertype">Vehicle Type</div>
                    <form method="POST" action="<?php echo URL_ROOT; ?>admins/employees">
                        <div class="filters">
                            <input type="checkbox" id="manager" name="manager" value="Manager" <?php echo ($data['managerDetail'] == null) ? "" : "checked" ?>>
                            <label for="manager">Manager</label>
                        </div>
                        <div class="filters">
                            <input type="checkbox" id="supervisor" name="supervisor" value="Supervisor" <?php echo ($data['supervisorDetail'] == null) ? "" : "checked" ?>>
                            <label for="supervisor">Supervisor</label>
                        </div>
                        <div class="filters">
                            <input type="checkbox" id="assembler" name="assembler" value="Assembler" <?php echo ($data['assemblerDetail'] == null) ? "" : "checked" ?>>
                            <label for="assembler">Assembler</label>
                        </div>
                        <div class="filters">
                            <input type="checkbox" id="tester" name="tester" value="Tester" <?php echo ($data['testerDetail'] == null) ? "" : "checked" ?>>
                            <label for="tester">Tester</label>
                        </div>
                        <div class="filters">
                            <button type="submit">Filter</button>
                        </div>

                </div>
            </div>
        </div>
    </div>

</section>

<section class="display-flex-column">

    <div id="alert" class="hideme" role="alert"></div>

</section>

<script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/adminjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/adminjs/cors.js"></script>

</body>

</html>