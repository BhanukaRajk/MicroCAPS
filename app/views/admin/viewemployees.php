<?php require_once APP_ROOT . '/views/admin/includes/header.php'; ?>
<?php require_once APP_ROOT . '/views/admin/navbar.php'; ?>
    <div class="a">
        <div class="a1">
            <div class="column1 right1">
                <h2>Employees</h2>
            </div>
            <a href="<?php echo URL_ROOT; ?>admins/add">
                <div class="column1 left1"><button type="button" class="btn1">Add New Employees</button></div>
            </a>
        </div>
        <div class="a2">
            <div class="a22">
                <h4><u>Managers</u></h4>
                <div class="a222">
                <?php
                foreach ($data['managerdetail'] as $values) {
                    echo '<div class="c1">
                            <div class="container1">
                                <div class="p1"><center><h3>' . $values->Firstname . ' ' . $values->Lastname . ' </h3></center></div>
                                <div class="p1">
                                    <a href="http://localhost/MicroCAPS/admins/edit">
                                        <div class="p2 right1">
                                            <center>
                                                <button type="button" class="bttn edit" >Edit</button>
                                            </center>
                                        </div>
                                    </a>
                                    <a href="http://localhost/MicroCAPS/admins/delete">
                                        <div class="p2 left1">
                                            <center>
                                                <button type="button" class="btttn delete" >Delete</button>
                                            </center>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>

            </div>
            </div>
        <div class="a3">
            <div class="a22">
                <h4><u>Supervisors</u></h4>
            </div>
            <div class="a222">
                <?php
                foreach ($data['supervisordetail'] as $values) {
                    echo '<div class="c1">
                    <div class="container1">
                        <div class="p1"><center><h3>' . $values->Firstname . ' ' . $values->Lastname . '</h3></center></div>
                        <div class="p1">
                            <a href="http://localhost/MicroCAPS/admins/edit">
                                <div class="p2 right1">
                                    <center>
                                        <button type="button" class="bttn edit" >Edit</button>
                                    </center>
                                </div>
                            </a>
                            <a href="http://localhost/MicroCAPS/admins/delete">
                                <div class="p2 left1">
                                    <center>
                                        <button type="button" class="btttn delete" >Delete</button>
                                    </center>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>';
                }

                ?>
            </div>
        </div>

        <div class="a4">
            <div class="a22">
                <h4><u>Testers</u></h4>
            </div>
            <div class="a222">
                <?php
               foreach ($data['testerdetail'] as $values) {
                echo '
                <div class="c1">
                <div class="container1">
                    <div class="p1"><center><h3>' . $values->Firstname . ' ' . $values->Lastname . ' </h3></center></div>
                    <div class="p1">
                        <a href="http://localhost/MicroCAPS/admins/edit">
                            <div class="p2 right1">
                                <center>
                                    <button type="button" class="bttn edit" >Edit</button>
                                </center>
                            </div>
                        </a>
                        <a href="http://localhost/MicroCAPS/admins/delete">
                            <div class="p2 left1">
                                <center>
                                    <button type="button" class="btttn delete" >Delete</button>
                                </center>
                            </div>
                        </a>
                    </div>
                </div>
            </div>';
               }
                ?>
            </div>
        </div>
    </div>

        <script src="<?php echo URL_ROOT; ?>public/javascripts/main.js"></script>

</body>

</html>