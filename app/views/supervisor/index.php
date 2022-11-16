<?php require_once APP_ROOT . '\views\includes\header.php'; ?>

<body class="display-flex-column justify-content-center align-items-center">

    <!--FULL PAGE-->
    <div>
        <!--LOGIN FORM BOX-->
        <div class="row align-items-center border padding-5  width-rem-20 justify-content-center">
            <form <?php echo URL_ROOT; ?>Supervisors/login" method="post" autocomplete="off">

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
                        name="pw"
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
</body>

</html>