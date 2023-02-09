<header>

    <ul class="display-flex-column height-100 gap-2 z-index-1">
        <li>
            <div class="nav_logo">
                <img src="<?php echo URL_ROOT; ?>public/images/nav_logo.png" class="text-center width-80" alt="logo" />
            </div>
        </li>
        <li>
            <div class="nav_section_headings margin-top-5">MAIN MENU</div>
            <a class="<?php echo ($data['url'][1] == "dashboard") ? 'active' : ''; ?>" href="<?php echo URL_ROOT; ?>managers/dashboard"><img src="<?php echo URL_ROOT; ?>public/images/icon1.jpg" class="width-rem-1p25" alt="icon1" />Dashboard</a>
        </li>
        <li>
            <div class="nav_section_headings">WORKSPACE</div>
            <a class="<?php echo ($data['url'][1] == "bodyshell") ? 'active' : ''; ?>" href="<?php echo URL_ROOT; ?>managers/bodyshell"><img src="<?php echo URL_ROOT; ?>public/images/icon2.png" class="width-rem-1p25" alt="icon2" />Body Shell</a>
            <a href="#"><img src="<?php echo URL_ROOT; ?>public/images/icon2.png" class="width-rem-1p25" alt="icon3" />Components</a>
            <a class="<?php echo ($data['url'][1] == "assembly") || ($data['url'][1] == "assemblystage") ? 'active' : ''; ?>" href="<?php echo URL_ROOT; ?>managers/assembly"><img src="<?php echo URL_ROOT; ?>public/images/icon3.png" class="width-rem-1p25" alt="icon3" />Assembly Process</a>
            <a class="<?php echo ($data['url'][1] == "dispatch") ? 'active' : ''; ?>" href="<?php echo URL_ROOT; ?>managers/dispatch"><img src="<?php echo URL_ROOT; ?>public/images/icon4.png" class="width-rem-1p25" alt="icon4" />Dispatch</a>
        </li>
        <li>
            <div class="nav_section_headings">GENERAL</div>
            <a class="<?php echo ($data['url'][1] == "settings") ? 'active' : ''; ?>" href="<?php echo URL_ROOT; ?>managers/settings"><img src="<?php echo URL_ROOT; ?>public/images/icon5.png" class="width-rem-1p25" alt="icon5" />Settings</a>
        </li>
    </ul>

</header>

<header id="header" class="fixed-top display-flex-row align-items-start">
    <div class="container display-flex-row align-items-center justify-content-end">
        <div class="display-flex-row justify-content-end align-items-center gap-0p75 width-rem-20">
            <div class="font-weight">
                <?php echo $_SESSION['_firstname'] . ' ' . $_SESSION['_lastname']; ?>
            </div>
            <div style="background-image:url(<?php echo URL_ROOT; ?>public/images/profile/<?php echo $_SESSION['_profile']; ?>)" class="width-rem-2p5 height-rem-2p5 background-image border-radius-11"></div>
            <div class="profilemenu"> 
                <img src="<?php echo URL_ROOT; ?>public/images/drop.png" class="pointer width-rem-0p75" alt="drop" id="drop" />
                <div class="logout position-absolute display-none border-blue" id="logout">
                    <a href="<?php echo URL_ROOT; ?>users/logout" class="text-decoration-none text-blue">logout</a>
                </div>
            </div>
        </div>
    </div>
</header>