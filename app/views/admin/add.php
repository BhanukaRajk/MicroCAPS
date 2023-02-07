<?php require_once APP_ROOT . '/views/admin/includes/header.php'; ?>
<?php require_once APP_ROOT . '/views/admin/navbar.php'; ?>
    
    <!-- <header>

        <ul class="display-flex-column">
            <li>
                <div class="nav_logo">
                    <img src="http://localhost/MicroCAPS/public/images/nav_logo.png" class="text-center width-50" alt="logo" />
                </div>
            </li>
            <li>
                <div class="nav_section_headings margin-top-5">MAIN MENU</div>
                <a href="<?php echo URL_ROOT; ?>admins/dash"><img src="http://localhost/MicroCAPS/public/images/icon1.jpg" class="width-rem-1p25" alt="icon1" />Dashboard</a><br>
            </li>
            <li>
                <div class="nav_section_headings">WORKSPACE</div>
                <a href="<?php echo URL_ROOT; ?>admins/viewemployees"><img src="http://localhost/MicroCAPS/public/images/icon7.png" class="width-rem-1p25" alt="icon7" />Manage Employees</a><br>
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
                <img src="http://localhost/MicroCAPS/public/images/drop.png" class="width-rem-0p75" alt="drop" id="drop" />
                <div class="logout" id="logout"><a href="http://localhost/MicroCAPS/admins/logout" class="text-decoration-none text-black">logout</a></div>
            </div>
        </div>
    </header> -->

    <div class="container1">
        <h3>Add Employee</h3>

        <?php
        //session_start();
        if (!empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            $_SESSION['errors'] = "";
            print_r($_SESSION['errors']);
        } else {
            unset($errors);

        }


        ?>
        <form action="<?php echo URL_ROOT; ?>admins/insertadd" method="POST">
            <div class="display-flex-row justify-content-between formbox">
                <div class="name-column left">
                    <input type="text" id="fname" name="fname" class="form-input" placeholder="First Name" required>
                </div>
                <div class="name-column right">
                    <input type="text" id="lname" name="lname" class="form-input" placeholder="Last Name" required>
                </div>
            </div>

            <div class="formbox">
                <input type="text" id="nic" name="nic" class="form-input" placeholder="National Identity Card" required>
                <span class="er">
                    <?php
                    echo isset($errors['nic']) ? $errors['nic'] : '';
                    ?>
                </span>
            </div>

            <div class="formbox">
                <input type="text" id="empid" name="empid" class="form-input" placeholder="Employee Id" required>
                <span class="er">
                    <?php
                    echo isset($errors['id']) ? $errors['id'] : '';
                    ?>
                </span>
            </div>

            <div class="formbox">
                <input type="tel" id="teleno" name="teleno" class="form-input" placeholder="Telephone number" required>
                <span class="er">
                    <?php
                    echo isset($errors['mobile']) ? $errors['mobile'] : '';
                    ?>
                </span>
            </div>

            <div class="formbox">
                <input type="text" id="address" name="address" class="form-input" placeholder="Address" required>
            </div>

            <div class="formbox">
                <input type="email" id="email" name="email" class="form-input" placeholder="Email" required>
                <span class="er">
                    <?php
                    echo isset($errors['mail']) ? $errors['mail'] : '';
                    ?>
                </span>
            </div>

            <div class="formbox">
                <input type="text" id="role" name="role" class="form-input" placeholder="Role" required>
                <span class="er">
                    <?php
                    echo isset($errors['role']) ? $errors['role'] : '';
                    ?>
                </span>
            </div>

            <div class="formbox">
                <input type="radio" id="stage01" name="stageNo" value="001" required>
                <label for="stage01">Stage 001</label>
                <input type="radio" id="stage02" name="stageNo" value="002" required>
                <label for="stage02">Stage 002</label>
                <input type="radio" id="stage03" name="stageNo" value="003" required>
                <label for="stage03">Stage 003</label>
                <input type="radio" id="stage03" name="stageNo" value="004" required>
                <label for="stage04">Stage 004</label>
            </div><br>


            <label>
                <input type="checkbox" name="sameadr">Create User Account
            </label>
            <input type="submit" value="Submit" class="btn">
        </form>
    </div>
    </div>
    <script src="<?php echo URL_ROOT; ?>public/javascripts/main.js"></script>
</body>

</html>