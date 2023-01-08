<?php require_once APP_ROOT . '/views/supervisorview/includes/header.php'; ?>

<!-- FULL PAGE -->
<div class="page">

    <!-- NEW PASSWORD FORM BOX -->
    <div class="fp_form">

        <!-- MICROCAPS LOGO -->
        <div><img class="logo" src="../images/logo2.png" alt="MicroCAPS-logo"></div>

        <!-- FORM -->
        <form action="<?php echo URL_ROOT; ?>Supervisors/newpassword" method="post">

            <!-- HEADING -->
            <div>
                <h2>Set new password</h2>
            </div>

            <!-- RED COLOR ERROR INDICATING AREA -->
            <div class="display-box">
                <label><?php echo (empty($data['username_err'])) ? '' : 'Incorrect Username'; ?></label>
            </div>
            <div>
                <input type="password" id="password" name="newpassword" onchange="" class="ipbox" value="<?php echo $data['password']; ?>" placeholder="New password" required>
            </div>

            <div class="display-box">
                <label><?php echo (empty($data['password_err'])) ? '' : 'Incorrect Password'; ?></label>
            </div>
            <div>
                <input type="password" id="password" name="repassword" onchange="" class="ipbox" value="<?php echo $data['password']; ?>" placeholder="Confirm new password" required>
            </div>

            <!-- SUBMIT BUTTON -->
            <div><button class="fpcont margin-top-3" type="submit" onclick="{this.onSubmit}">Change password</button></div>

            <!-- BACK TO LOGIN SECTION -->
            <div class="forgot_pw"><p>Back to <a class="blue text-decoration-none" href="<?php echo URL_ROOT; ?>supervisors/index">Login</a></p></div>
        
        </form>
    </div>
</div>

<?php require_once APP_ROOT . '/views/supervisorview/includes/footer.php'; ?>