<header id="navbar" class="position-absolute">

    <!-- LEFT NAVIGATION BAR MENU LIST -->
    <ul class="navigation-bar display-flex-column">

        <!-- LOGO ON TOP -->
        <li>
            <div class="nav_logo">
                <div>
                    <img src="<?php echo URL_ROOT; ?>public/images/logo.png" class="text-center width-rem-10" alt="logo" />
                </div>
            </div>
        </li>

        <!-- MAIN CATEGORY ON NAV BAR -->
        <li>
            <!-- <div class="nav_section_headings margin-top-5">MAIN MENU</div> -->
            <div class="nav_section_headings">MAIN MENU</div>
            <a class="<?php echo ($data['url'][1] == "dashboard") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/dashboard">
                <img src="<?php echo URL_ROOT; ?>public/images/icon1.jpg" class="width-rem-1p25" alt="icon1" />Dashboard
            </a>
        </li>

        <!-- WORKSPACE CATEGORY ON NAV BAR -->
        <li>
            <div class="nav_section_headings">WORKSPACE</div>

            <a class="<?php echo ($data['url'][1] == "linevehicleview" || 
                                    $data['url'][1] == "getProcess" || 
                                    $data['url'][1] == "findAssemblyLineCars"
            ) ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/findAssemblyLineCars">
                <img src="<?php echo URL_ROOT; ?>public/images/icon3.png" class="width-rem-1p25" alt="icon3" />Assembly Process
            </a>

            <a class="<?php echo ($data['url'][1] == "viewCarComponent" ||
                                    $data['url'][1] == "componentsView"
            ) ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/viewCarComponent">
                <img src="<?php echo URL_ROOT; ?>public/images/icon5.png" class="width-rem-1p25" alt="icon2" />Manage Parts
            </a>

            <a class="<?php echo ($data['url'][1] == "taskSchedule" ||
                                    $data['url'][1] == "leaves" ||
                                    $data['url'][1] == "addleave" ||
                                    $data['url'][1] == "editleave" ||
                                    $data['url'][1] == "getEditingData"
            ) ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/taskSchedule">
                <img src="<?php echo URL_ROOT; ?>public/images/icon4.png" class="width-rem-1p25" alt="icon6" />Schedule Tasks
            </a>

            <a class="<?php echo ($data['url'][1] == "testRunQueue" ||
                                    $data['url'][1] == "getCarInfo"
            ) ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/testRunQueue">
                <img src="<?php echo URL_ROOT; ?>public/images/icon7.png" class="width-rem-1p25" alt="icon7" />Pre-Inspection
            </a>

            <a class="<?php echo ($data['url'][1] == "pdiresults" ||
                                    $data['url'][1] == "pdilinevehicleview"
            ) ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/pdilinevehicleview">
                <img src="<?php echo URL_ROOT; ?>public/images/icon8.png" class="width-rem-1p25" alt="icon7" />Test run
            </a>

            <a class="<?php echo ($data['url'][1] == "viewTools") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/viewTools">
                <img src="<?php echo URL_ROOT; ?>public/images/icon10.png" class="width-rem-1p25" alt="icon7" />Tools
            </a>

            <!-- <a class="<?php //echo ($data['url'][1] == "viewConsumables") ? 'active' : '' ; ?>" href="<?php //echo URL_ROOT; ?>Supervisors/viewConsumables"> -->
            <a class="<?php echo ($data['url'][1] == "findConsumables") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/findConsumables">
                <img src="<?php echo URL_ROOT; ?>public/images/icon9.png" class="width-rem-1p25" alt="icon7" />Consumables
            </a>
        </li>

        <!-- GENERAL SETTINGS CATEGORY ON NAV BAR -->
        <li>
            <div class="nav_section_headings">GENERAL</div>
            <a class="<?php echo ($data['url'][1] == "settings") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/settings">
                <img src="../images/icon6.png" class="width-rem-1p25" alt="icon5" />Settings
            </a>
        </li>

    <!-- LEFT NAVIGATION BAR MENU LIST END -->
    </ul>

<!--    <div class="navigationtoggle" onclick="navbartoggle(this)">-->
<!--        <div class="bar1"></div>-->
<!--        <div class="bar2"></div>-->
<!--        <div class="bar3"></div>-->
<!--    </div>-->

</header>