<?php require_once APP_ROOT . '/views/includes/header.php'; ?>


<!-- FULL PAGE -->
<div class="page">

    <!--LOGIN FORM BOX-->
    <div class="login_form">
        <!--LOGO-->
        <div><img class="logo" src="../images/logo2.png" alt="MicroCAPS-logo"></div>

        <form action="<?php echo URL_ROOT; ?>Supervisors/login" method="post">

            <div>
                <h2>Log In</h2>
            </div>

            <!--USERNAME FIELD-->
            <div class="display-box">
                <label><?php echo (empty($data['username_err'])) ? '' : 'Incorrect Username'; ?></label>
            </div>
            <div>
                <input type="email" id="username" name="username" onchange="" class="ipbox" value="<?php echo $data['username']; ?>" placeholder="Username" autocomplete="off" required>
            </div>

            <!-- PASSWORD FIELD -->
            <div class="display-box">
                <label><?php echo (empty($data['password_err'])) ? '' : 'Incorrect Password'; ?></label>
            </div>
            <div>
                <input type="password" id="password" name="password" onchange="" class="ipbox" value="<?php echo $data['password']; ?>" placeholder="Password" required>
            </div>

            <!--FORGOT PASSWORD LINK-->
            <div><a class="forgot_pw" href="<?php echo URL_ROOT; ?>supervisors/forgotpassword">Forgot password?</a></div><br>

            <!--SUBMIT BUTTON-->
            <div><button class="btn_submit" type="submit" onClick={this.onSubmit}>Submit</button></div>
        </form>
    </div>
</div>


<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>