<header id="header" class="fixed-top display-flex-row align-items-start">
    <div class="container display-flex-row align-items-center justify-content-end">
        <div class="top_nav_content display-flex-row align-items-center gap-0p75 width-rem-25">
            <img src="<?php echo URL_ROOT; ?>public/images/profilepic.png" class="width-rem-2p5" alt="profilepic" />
            <div class="font-weight"><?php echo $_SESSION['_firstname'] . ' ' . $_SESSION['_lastname']; ?></div>
            <img src="<?php echo URL_ROOT; ?>public/images/drop.png" class="width-rem-0p75" alt="drop" id="drop"/>
        <div class="logout position-relative display-none border-gray" id="logout"><a href="<?php echo URL_ROOT; ?>supervisors/logout" class="text-decoration-none text-black">logout</a></div>
        </div>
    </div>
</header>