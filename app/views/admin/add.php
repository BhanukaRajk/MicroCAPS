<?php require_once APP_ROOT . '/views/admin/includes/header.php'; ?>
<?php require_once APP_ROOT . '/views/admin/navbar.php'; ?>

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