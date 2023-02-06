<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo URL_ROOT; ?>public/stylesheets/admin/main.css" rel="stylesheet" />
    <link href="<?php echo URL_ROOT; ?>public/stylesheets/admin/viewemployees.css" rel="stylesheet" />
</head>

<body>

    <header>

        <ul class="display-flex-column">
            <li>
                <div class="nav_logo">
                    <img src="http://localhost/MicroCAPS/public/images/nav_logo.png" class="text-center width-50" alt="logo" />
                </div>
            </li>
            <li>
                <div class="nav_section_headings margin-top-5">MAIN MENU</div>
                <a href="<?php echo URL_ROOT; ?>admins/dash"><img src="http://localhost/MicroCAPS/public/images/icon1.jpg" class="width-rem-1p25" alt="icon1" />Dashboard</a><br>
            </li>
            <li>
                <div class="nav_section_headings">WORKSPACE</div>
                <a href="<?php echo URL_ROOT; ?>admins/viewemployees"><img src="http://localhost/MicroCAPS/public/images/icon7.png" class="width-rem-1p25" alt="icon7" />Manage Employees</a><br>
                <a href="#"><img src="http://localhost/MicroCAPS/public/images/icon3.png" class="width-rem-1p25" alt="icon3" />Assembly Process</a><br>
                <a href="#"><img src="http://localhost/MicroCAPS/public/images/icon6.png" class="width-rem-1p25" alt="icon6" />Testing</a><br>
                <a href="#"><img src="http://localhost/MicroCAPS/public/images/icon4.png" class="width-rem-1p25" alt="icon4" />Dispatch</a><br>
            </li>
            <li>
                <div class="nav_section_headings">GENERAL</div>
                <a href="#"><img src="http://localhost/MicroCAPS/public/images/icon2.png" class="width-rem-1p25" alt="icon2" />Reports</a><br>
                <a href="#"><img src="http://localhost/MicroCAPS/public/images/icon5.png" class="width-rem-1p25" alt="icon5" />Settings</a><br>
            </li>
        </ul>

    </header>

    <header id="header" class="fixed-top display-flex align-items-start">
        <div class="container display-flex align-items-center justify-content-end">
            <div class="top_nav_content display-flex align-items-center gap-4 width-rem-25">
                <img src="http://localhost/MicroCAPS/public/images/profilepic.png" class="width-rem-2p5" alt="profilepic" />
                <div class="font-weight"><?php echo "Admin" ?></div>
                <img src="http://localhost/MicroCAPS/public/images/drop.png" class="width-rem-0p75" alt="drop" id="drop" />
                <div class="logout" id="logout"><a href="http://localhost/MicroCAPS/admins/logout" class="text-decoration-none text-black">logout</a></div>
            </div>
        </div>
    </header>
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