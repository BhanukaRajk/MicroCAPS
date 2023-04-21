<header id="topbar" class="fixed-top display-flex-row align-items-start">
    <div class="container display-flex-row align-items-center justify-content-end">
        <div class="display-flex-row justify-content-end align-items-center gap-0p75 width-rem-20">
            <div class="font-weight">
                <?php echo $_SESSION['_firstname'] . ' ' . $_SESSION['_lastname']; ?>
            </div>
            <img src="<?php echo URL_ROOT; ?>public/images/profile/default.png" class="width-rem-2p5 profileImg" alt="profilepic" />
            <div class="profilemenu">
                <button onclick="profiledropdown()" class="arrowbtn">
                    <img src="<?php echo URL_ROOT; ?>public/images/drop.png" class="width-rem-0p75" alt="drop" onclick="profiledropdown()">
                </button>
                <div id="profileDropdown" class="profilemenu-content">
                    <a href="<?php echo URL_ROOT; ?>Users/logout">Log out</a>
                    <a href="<?php echo URL_ROOT; ?>Supervisors/settings">Settings</a>
                </div>
            </div>

        </div>
    </div>
</header>