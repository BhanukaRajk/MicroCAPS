<header id="topbar" class="position-absolute">

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
            <div class="nav_section_headings margin-top-5">MAIN MENU</div>
            <a class="<?php echo ($data['url'][1] == "dashboard") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/dashboard">
                <img src="<?php echo URL_ROOT; ?>public/images/icon1.jpg" class="width-rem-1p25" alt="icon1" />Dashboard
            </a>
        </li>

        <!-- WORKSPACE CATEGORY ON NAV BAR -->
        <li>
            <div class="nav_section_headings">WORKSPACE</div>

            <a class="<?php echo ($data['url'][1] == "linevehicleview") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/linevehicleview">
                <img src="<?php echo URL_ROOT; ?>public/images/icon3.png" class="width-rem-1p25" alt="icon3" />Assembly Process
            </a>

            <a class="<?php echo ($data['url'][1] == "componentsView") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/componentsView">
                <img src="<?php echo URL_ROOT; ?>public/images/icon2.png" class="width-rem-1p25" alt="icon2" />Manage Parts
            </a>

            <a class="<?php echo ($data['url'][1] == "taskSchedule") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/taskSchedule">
                <img src="<?php echo URL_ROOT; ?>public/images/icon6.png" class="width-rem-1p25" alt="icon6" />Schedule Tasks
            </a>

            <a class="<?php echo ($data['url'][1] == "testRunQueue") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/testRunQueue">
                <img src="<?php echo URL_ROOT; ?>public/images/icon7.png" class="width-rem-1p25" alt="icon7" />Testing
            </a>

            <!-- <a class="<?php //echo ($data['url'][1] == "pdiresults") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/pdiresults">
                <img src="<?php //echo URL_ROOT; ?>public/images/icon10.png" class="width-rem-1p25" alt="icon7" />Tools
            </a> -->

            <a class="<?php echo ($data['url'][1] == "consumableview") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/consumableview">
                <img src="<?php echo URL_ROOT; ?>public/images/icon12.png" class="width-rem-1p25" alt="icon7" />Consumables
            </a>
        </li>

        <!-- GENERAL SETTINGS CATEGORY ON NAV BAR -->
        <li>
            <div class="nav_section_headings">GENERAL</div>
            <a class="<?php echo ($data['url'][1] == "settings") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>Supervisors/settings">
                <img src="../images/icon5.png" class="width-rem-1p25" alt="icon5" />Settings
            </a>
        </li>

    <!-- LEFT NAVIGATION BAR MENU LIST END -->
    </ul>

</header>