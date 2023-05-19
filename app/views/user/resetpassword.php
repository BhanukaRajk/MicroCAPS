<?php require_once APP_ROOT . '/views/user/includes/header.php'; ?>
<body class="display-flex-column height-vh-100 gap-2 align-items-center justify-content-center">
<section>
    <div class="row align-items-center border-gray padding-5  width-rem-20 justify-content-center">

        <div class="text-center">
            <img src="<?php echo URL_ROOT;?>public/images/logo.png" class="text-center width-75" alt="logo"/>
        </div>

        <div class="text-center">
            <h3 class="margin-top-4">Set New Password</h3>
        </div>

        <form action="<?php echo URL_ROOT; ?>users/resetPassword" method="post" autocomplete="off">

            <div>
                <input type="password"
                       id="newpassword"
                       name="newPassword"
                       onChange=""
                       value=""
                       class="form-control <?php echo (!empty($data['vCode_err'])) ? 'form-control-invalid' : '' ; ?>"
                       placeholder="New Password"
                       autocomplete="off"
                       required />
                <label class="form-label <?php echo (empty($data['vCode_err'])) ? '' : 'red' ; ?>"><?php echo (empty($data['vCode_err'])) ? 'New Password' : 'Incorrect Verification Code' ; ?></label>
                <span></span>

            </div>

            <div>
                <input type="password"
                       id="confirmpassword"
                       name="confirmPassword"
                       onChange=""
                       value=""
                       class="form-control"
                       placeholder="Confirm Password"
                       autocomplete="off"
                       required />
                <label id="confirm-label" class="form-label">Confirm Password</label>
                <span id="out"></span>

            </div>

            <div class="text-center margin-top-3">
                <button class="btn btn-primary" type="submit" id="update-btn" disabled="true">
                    Change Password
                </button>
            </div>

            <div class="text-center text-gray font-size margin-top-3">Back to<a class = "text-blue text-decoration-none" href="<?php echo URL_ROOT; ?>users/login"> Login </a></div>

        </form>
    </div>
</section>

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/userjs/form.js"></script>

</body>

</html>