<?php require_once APP_ROOT . '/views/includes/header.php'; ?>
<body class="display-flex-column height-vh-100 gap-2 align-items-center justify-content-center">
<section>
    <!-- <div class="container"> -->
    <div class="row align-items-center border-gray padding-5  width-rem-20 justify-content-center">

        <div class="text-center">
            <img src="<?php echo URL_ROOT;?>public/images/logo.png" class="text-center width-75" alt="logo"/>
        </div>

        <div class="text-center">
            <h3 class="margin-top-4">Log In</h3>
        </div>

        <form action="<?php echo URL_ROOT; ?>users/login" method="post" autocomplete="off">

            <div>
                <input type="text"
                       id="username"
                       name="username"
                       onChange=""
                       value="<?php echo $data['username'] ; ?>"
                       class="form-control <?php echo (!empty($data['username_err'])) ? 'form-control-invalid' : '' ; ?>"
                       placeholder="Username"
                       autocomplete="off"
                       required />
                <label id="username-label" class="form-label <?php echo (empty($data['username_err'])) ? '' : 'red' ; ?>"><?php echo (empty($data['username_err'])) ? 'Username' : 'Incorrect Username' ; ?></label>
                <span></span>

            </div>

            <div>
                <input type="password"
                       id="password"
                       name="password"
                       onChange=""
                       value="<?php echo $data['password'] ; ?>"
                       class="form-control <?php echo (!empty($data['password_err'])) ? 'form-control-invalid' : '' ; ?>"
                       placeholder="Password"
                       required />
                <label id="password-label" class="form-label <?php echo (empty($data['password_err'])) ? '' : 'red' ; ?>"><?php echo (empty($data['password_err'])) ? 'Password' : 'Incorrect Password' ; ?></label>
            </div>

            <div class="text-center"> <a class = "text-gray text-decoration-none" href="<?php echo URL_ROOT; ?>users/search"> Forgot Password ? </a></div>

            <div class="text-center margin-top-3">
                <button class="btn btn-primary" type="submit">
                    Submit
                </button>
            </div>

        </form>
    </div>
</section>

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/form.js"></script>

</body>

</html>