<?php require_once APP_ROOT . '/views/includes/header.php'; ?>

<!-- FULL PAGE -->
<div class="page">

    <!-- VERIFICATION CODE FORM BOX -->
    <div class="fp_form">

        <!-- MICROCAPS LOGO -->
        <div><img class="logo" src="../images/logo2.png" alt="MicroCAPS-logo"></div>

        <!-- FORM -->
        <form action="<?php echo URL_ROOT; ?>Supervisors/verifymail" method="post">

            <!-- HEADING -->
            <div>
                <h2>Verify Email</h2>
            </div>

            <!-- GREY COLOR TEXT AREA -->
            <div class="forgot_pw"><p class="grey-indicator">You will receive a verification code to your email<br> example@gmail.com</p></div>

            <!-- RED COLOR ERROR INDICATING AREA -->
            <div class="display-box">
                <label><?php echo (empty($data['username_err'])) ? '' : 'Incorrect Username'; ?></label>
            </div>

            <!-- VERIFICATION CODE INPUT FIELD -->
            <div>
                <input type="text" id="code" name="code" onchange="" class="fp-email" value="" placeholder="Verification code" autocomplete="off" required="">
            </div>

            <!-- SUBMIT BUTTON -->
            <div><button class="fpcont margin-top-3" type="submit" onclick="{this.onSubmit}">Verify</button></div>

            <!-- BACK TO LOGIN SECTION -->
            <div class="forgot_pw"><p>Back to <a class="blue text-decoration-none" href="<?php echo URL_ROOT; ?>supervisors/index">Login</a></p></div>
        
        </form>
    </div>
</div>


<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>