<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<div class="display-flex-column height-vh-100 gap-2 align-items-center justify-content-center">

    <!--FULL PAGE-->
    <div>
        <!--LOGIN FORM BOX-->
        <div class="row align-items-center border-gray padding-5  width-rem-20 justify-content-center">
            <form action="<?php echo URL_ROOT; ?>Supervisors/login" method="post" autocomplete="off">

                <!--LOGO-->
                <div class="text-center"><img class="width-50" src="<?php echo URL_ROOT; ?>public/images/logo.png" alt="MicroCAPS-logo"></div>

                <div class="text-center">
                    <h2 class="margin-top-4">Log In</h2>
                </div>

                <!--INPUT FIELDS-->
                <div>
                    <input type="email"
                        id="username"
                        name="username"
                        onchange=""
                        class="form-control <?php echo (!empty($data['username_err'])) ? 'form-control-invalid' : '' ; ?>"
                        value="<?php echo $data['username']; ?>"
                        placeholder="Username"
                        autocomplete="off"
                        required>
                        <label class="form-label <?php echo (empty($data['username_err'])) ? '' : 'red' ; ?>"><?php echo (empty($data['username_err'])) ? 'Username' : 'Incorrect Username' ; ?></label>
                </div><br>
            
                <div>
                    <input type="password"
                        id="password"
                        name="password"
                        onchange=""
                        class="form-control <?php echo (!empty($data['password_err'])) ? 'form-control-invalid' : '' ; ?>"
                        value="<?php echo $data['password'] ; ?>"
                        placeholder="Password"
                        required>
                        <label class="form-label <?php echo (empty($data['password_err'])) ? '' : 'red' ; ?>"><?php echo (empty($data['password_err'])) ? 'Password' : 'Incorrect Password' ; ?></label>
                </div><br>

                <!--FORGOT PASSWORD LINK-->
                <div class="text-center"><a href="####">Forgot password?</a></div><br>

                <!--SUBMIT BUTTON-->
                <div class="text-center"><button class="btn btn-primary" type="submit" onClick={this.onSubmit}>Submit</button></div>
            </form>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>












<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>


<!-- FULL PAGE -->
<div class="page">

    <!--LOGIN FORM BOX-->
    <div class="login_form">
        <!--LOGO-->
        <div><img class="logo" src="../images/loginpagelogo.png" alt="MicroCAPS-logo"></div>

        <form action="<?php echo URL_ROOT; ?>Supervisors/login" method="post">

            <div>
                <h2>Log In</h2>
            </div>

            <!--USERNAME FIELD-->
            <div class="display-box">
                <label><?php echo (empty($data['username_err'])) ? '' : 'Incorrect Username or Password'; ?><?php echo (empty($data['password_err'])) ? '' : 'Incorrect Username or Password'; ?></label>
            </div>
            <div>
                <input type="email" id="username" name="username" onchange="" class="ipbox" value="<?php echo $data['username']; ?>" placeholder="Username" autocomplete="off" required>
            </div>

            <!-- PASSWORD FIELD -->
            <div class="display-box">
                <label>
                    <!-- <?php
                    //  echo (empty($data['password_err'])) ? '' : 'Incorrect Password'; 
                     ?> -->
                </label>
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

<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>