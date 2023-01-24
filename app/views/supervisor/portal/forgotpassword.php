<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- FULL PAGE -->
<div class="page">

    <!-- FORGOT PASSWORD FORM BOX -->
    <div class="fp_form">

        <!-- MICROCAPS LOGO -->
        <div><img class="logo" src="../images/logo2.png" alt="MicroCAPS-logo"></div>

        <!-- FORM -->
        <form action="<?php echo URL_ROOT; ?>Supervisors/forgot" method="post">

            <!-- HEADING -->
            <div>
                <h2>Forgot Password</h2>
            </div>

            <!-- GREY COLOR TEXT AREA -->
            <div class="forgot_pw"><p class="grey-indicator">Enter the email address associated with your<br> account and we'll send you an verification code to<br> verify you</p></div>

            <!-- RED COLOR ERROR INDICATING AREA -->
            <div class="display-box">
                <label><?php echo (empty($data['username_err'])) ? '' : 'Incorrect Username'; ?></label>
            </div>

            <!-- USERNAME INPUT FIELD -->
            <div>
                <input type="email" id="username" name="username" onchange="" class="fp-email" value="" placeholder="Username" autocomplete="off" required="">
            </div>

            <!-- SUBMIT BUTTON -->
            <div><button class="fpcont margin-top-3" type="submit" onclick="{this.onSubmit}">Continue</button></div>

            <!-- BACK TO LOGIN SECTION -->
            <div class="forgot_pw"><p>Back to <a class="blue text-decoration-none" href="<?php echo URL_ROOT; ?>supervisors/index">Login</a></p></div>
        
        </form>
    </div>
</div>


<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>