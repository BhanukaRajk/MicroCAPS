<header>

    <ul class="display-flex-column">
        <li>
            <div class="nav_logo">
                <img src="<?php echo URL_ROOT; ?>public/images/nav_logo.png" class="text-center width-50" alt="logo" />
            </div>
        </li>
        <li>
            <div class="nav_section_headings margin-top-5">MAIN MENU</div>
            <a class="active" href="#home"><img src="<?php echo URL_ROOT; ?>public/images/icon1.jpg" class="width-rem-1p25" alt="icon1" />Dashboard</a>
        </li>
        <li>
            <div class="nav_section_headings">WORKSPACE</div>
            <a href="#news"><img src="<?php echo URL_ROOT; ?>public/images/icon2.png" class="width-rem-1p25" alt="icon2" />Body Shell</a>
            <a href="#contact"><img src="<?php echo URL_ROOT; ?>public/images/icon3.png" class="width-rem-1p25" alt="icon3" />Assembly Process</a>
            <a href="#about"><img src="<?php echo URL_ROOT; ?>public/images/icon4.png" class="width-rem-1p25" alt="icon4" />Dispatch</a>
        </li>
        <li>
            <div class="nav_section_headings">GENERAL</div>
            <a href="#about"><img src="<?php echo URL_ROOT; ?>public/images/icon5.png" class="width-rem-1p25" alt="icon5" />Settings</a>
        </li>
    </ul>

</header>

<header id="header" class="fixed-top display-flex align-items-start">
    <div class="container display-flex align-items-center justify-content-end">
        <div class="top_nav_content display-flex align-items-center gap-4 width-rem-25">
            <img src="<?php echo URL_ROOT; ?>public/images/profilepic.png" class="width-rem-2p5" alt="profilepic" />
            <div class="font-weight"><?php echo $_SESSION['_firstname'] . ' ' . $_SESSION['_lastname']; ?></div>
            <img src="<?php echo URL_ROOT; ?>public/images/drop.png" class="width-rem-0p75" alt="drop" id="drop"/>
        <div class="logout" id="logout"><a href="<?php echo URL_ROOT; ?>managers/logout" class="text-decoration-none text-black">logout</a></div>
        </div>
    </div>
</header>