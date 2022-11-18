<header class="position-absolute">

    <ul class="display-flex-column">
        <li>
            <div class="nav_logo">
                <img src="<?php echo URL_ROOT; ?>public/images/nav_logo.png" class="text-center width-50" alt="logo" />
            </div>
        </li>
        <li>
            <div class="nav_section_headings margin-top-5">MAIN MENU</div>
            <a class="<?php echo ($data['url'][1] == "dashboard") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>supervisors/dashboard"><img src="<?php echo URL_ROOT; ?>public/images/icon1.jpg" class="width-rem-1p25" alt="icon1" />Dashboard</a>
        </li>
        <li>
            <div class="nav_section_headings">WORKSPACE</div>
            <a href="#"><img src="<?php echo URL_ROOT; ?>public/images/icon3.png" class="width-rem-1p25" alt="icon3" />Assembly Process</a>
            <a href="#"><img src="<?php echo URL_ROOT; ?>public/images/icon2.png" class="width-rem-1p25" alt="icon2" />Manage Parts</a>
            <a href="#"><img src="<?php echo URL_ROOT; ?>public/images/icon6.png" class="width-rem-1p25" alt="icon6" />Schedule Tasks</a>
            <a href="<?php echo URL_ROOT; ?>supervisors/testing"><img src="<?php echo URL_ROOT; ?>public/images/icon7.png" class="width-rem-1p25" alt="icon7" />Testing</a>
        </li>
        <li>
            <div class="nav_section_headings">GENERAL</div>
            <a href="#"><img src="../images/icon5.png" class="width-rem-1p25" alt="icon5" />Settings</a>
        </li>
    </ul>

</header>