<!-- <!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="dash.css">
</head> -->
<?php require_once APP_ROOT . '\views\includes_d\header.php'; ?>

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
                <a href="#"><img src="http://localhost/MicroCAPS/public/images/icon1.jpg" class="width-rem-1p25" alt="icon1" />Dashboard</a><br>
            </li>
            <li>
                <div class="nav_section_headings">WORKSPACE</div>
                <a href="<?php echo URL_ROOT; ?>admins/just"><img src="http://localhost/MicroCAPS/public/images/icon7.png" class="width-rem-1p25" alt="icon7" />Manage Employees</a><br>
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
              <img src="http://localhost/MicroCAPS/public/images/drop.png" class="width-rem-0p75" alt="drop" id="drop"/>
          <div class="logout" id="logout"><a href="http://localhost/MicroCAPS/admins/logout" class="text-decoration-none text-black">logout</a></div>
          </div>
      </div>
    </header>
    <!--<script src="" async defer></script>-->
    <!-- <div class="page"> -->
        <!-- <div class="navigation"></div> -->
        <!-- <div class="full_content"> -->
            <!-- <div class="top_content"></div> -->
            <div class="detailed_content">
                <div class="left" style="margin-top: -30%">
                    <div class="heading bold" style="margin-top: 45%" >Dashboard</div>
                    <div class="row">
                        <div class="column le">
                            <div class="c1">
                                <div class="c11"><h4>Employees</h4></div>
                                <div class="c11">
                                    <div class="c111">
                                        <div class="c112">
                                            <div class="countbox">
                                                <div class="number1">1</div>
                                                <div>Manager</div>
                                            </div>
                                        </div><br>
                                        <div class="c112">
                                            <div class="countbox">
                                                <div class="number1">10</div>
                                                <div>Assemblers</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c111">
                                        <div class="c112">
                                            <div class="countbox">
                                                <div class="number1">4</div>
                                                <div>Supervisors</div>
                                            </div>
                                    </div>
                                        <br><div class="c112">
                                            <div class="countbox">
                                                <div class="number1">5</div>
                                                <div class="text1">Testers</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <!-- <div class="map_list">
                                <div class="map">
                                    <div class="circle"></div>
                                    <div>Done</div>
                                </div>
                                <div class="map">
                                    <div class="circle"></div>
                                    <div>On-going</div>
                                </div>
                            </div> -->
                        </div>
                        <!-- <div class="line">fhfhfh</div> -->
                        
                            <div class="column ri">
                                <div class="oal1">
                                    <h4>On Assembly Line</h4>
                                </div>
                                <div class="oal2">
                                    <div class="countbox2">
                                        <div class="number2">5</div>
                                        <div class="text2">Vehicles</div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                </div>
                <div class="right" style="margin-top: -10%">
                    <div class="logs bold">
                        <div class="sidebox">Activity Logs</div>
                        <div class="sidebox"></div>
                    </div>
                    <div class="quick bold">
                        <div class="sidebox">Quick Access</div>
                        <div class="sidebox btn">
                            <a href="<?php echo URL_ROOT; ?>admins/add"><button type="button" class="blue_button">Add New Employee</button></a>
                            <button type="button" class="red_button">Edit PDI Content</button></div>
                    </div>
                    <div class="calender"></div>
                </div>
            </div>
            <script src="<?php echo URL_ROOT;?>public/javascripts/main.js"></script>
        <!-- </div> -->
    <!-- </div> -->

</body>

</html>