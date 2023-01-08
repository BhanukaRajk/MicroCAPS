<header id="topbar" class="position-absolute">

    <!-- LEFT NAVIGATION BAR MENU LIST -->
    <ul class="display-flex-column">

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
            <a class="<?php echo ($data['url'][1] == "dashboard") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>supervisors/landing/dashboard">
                <img src="<?php echo URL_ROOT; ?>public/images/icon1.jpg" class="width-rem-1p25" alt="icon1" />Dashboard
            </a>
        </li>

        <!-- WORKSPACE CATEGORY ON NAV BAR -->
        <li>
            <div class="nav_section_headings">WORKSPACE</div>

            <a class="<?php echo ($data['url'][1] == "assembly") ? 'active' : '' ; ?>" href="#">
                <img src="<?php echo URL_ROOT; ?>public/images/icon3.png" class="width-rem-1p25" alt="icon3" />Assembly Process
            </a>

            <a class="<?php echo ($data['url'][1] == "components") ? 'active' : '' ; ?>" href="#">
                <img src="<?php echo URL_ROOT; ?>public/images/icon2.png" class="width-rem-1p25" alt="icon2" />Manage Parts
            </a>

            <a class="<?php echo ($data['url'][1] == "scheduletasks") ? 'active' : '' ; ?>" href="#">
                <img src="<?php echo URL_ROOT; ?>public/images/icon6.png" class="width-rem-1p25" alt="icon6" />Schedule Tasks
            </a>

            <a class="<?php echo ($data['url'][1] == "testing") ? 'active' : '' ; ?>" href="#">
                <img src="<?php echo URL_ROOT; ?>public/images/icon7.png" class="width-rem-1p25" alt="icon7" />Testing
            </a>

            <a class="<?php echo ($data['url'][1] == "tools") ? 'active' : '' ; ?>" href="#">
                <img src="<?php echo URL_ROOT; ?>public/images/icon8.png" class="width-rem-1p25" alt="icon7" />Tools & Consumables
            </a>
        </li>

        <!-- GENERAL SETTINGS CATEGORY ON NAV BAR -->
        <li>
            <div class="nav_section_headings">GENERAL</div>
            <a class="<?php echo ($data['url'][1] == "editprofile") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>supervisors/editprofile">
                <img src="../images/icon5.png" class="width-rem-1p25" alt="icon5" />Settings
            </a>
        </li>

    <!-- LEFT NAVIGATION BAR MENU LIST END -->
    </ul>

</header>