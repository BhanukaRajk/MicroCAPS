<header>

    <ul class="display-flex-column">
        <li>
            <div class="nav_logo">
                <img src="<?php echo URL_ROOT; ?>public/images/logo.png" class="text-center width-50" alt="logo" />
            </div>
        </li>
        <li>
            <div class="nav_section_headings margin-top-5">MAIN MENU</div>
            <a class="<?php echo ($data['url'][1] == "dashboard") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>testers/dashboard"><img src="<?php echo URL_ROOT; ?>public/images/icon1.jpg" class="width-rem-1p25" alt="icon1" />Dashboard</a>
        </li>
        <li>
            <div class="nav_section_headings">WORKSPACE</div>
            <!-- <a class="<?php //echo ($data['url'][1] == "defect_sheet") ? 'active' : '' ; ?>" href="<?php //echo URL_ROOT; ?>testers/select_vehicle"><img src="<?php //echo URL_ROOT; ?>public/images/icon2.png" class="width-rem-1p25" alt="icon2" />Deffect Sheet</a> -->
            <!-- <a class="<?php //echo ($data['url'][1] == "select_vehicle") ? 'active' : '' ; ?>" href="<?php //echo URL_ROOT; ?>testers/select_vehicle"><img src="<?php //echo URL_ROOT; ?>public/images/icon3.png" class="width-rem-1p25" alt="icon3" />Select Vehicle</a> -->
            <a class="<?php echo ($data['url'][1] == "add_defect") ? 'active' : '' ; ?>" href="<?php echo URL_ROOT; ?>testers/add_defect"><img src="<?php echo URL_ROOT; ?>public/images/icon4.png" class="width-rem-1p25" alt="icon4" />Add Defect</a>
            <!-- <a class="<?php //echo ($data['url'][1] == "record_pdi") ? 'active' : '' ; ?>" href="<?php //echo URL_ROOT; ?>testers/select_vehicle_2"><img src="<?php //echo URL_ROOT; ?>public/images/icon2.png" class="width-rem-1p25" alt="icon2" />PDI Checks</a> -->
        </li>
        <li>
            <div class="nav_section_headings">GENERAL</div>
            <a href="#"><img src="<?php echo URL_ROOT; ?>public/images/icon5.png" class="width-rem-1p25" alt="icon5" />Settings</a>
        </li>
    </ul>

</header>

<header id="header" class="fixed-top display-flex align-items-start">
    <div class="container display-flex align-items-center justify-content-end">
        <div class="top_nav_content display-flex align-items-center gap-4 width-rem-25">
            <img src="<?php echo URL_ROOT; ?>public/images/profilepic.png" class="width-rem-2p5" alt="profilepic" />
            <div class="font-weight"><?php echo $_SESSION['_firstname'] . ' ' . $_SESSION['_lastname']; ?></div>
            <img src="<?php echo URL_ROOT; ?>public/images/drop.png" class="width-rem-0p75" alt="drop" id="drop"/>
        <div class="logout" id="logout"> <a href="<?php echo URL_ROOT; ?>users/logout" class="text-decoration-none text-black">logout</a></div>
        </div>
    </div>
</header>