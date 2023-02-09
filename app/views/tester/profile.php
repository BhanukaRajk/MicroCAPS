<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="We always care and cure" />
    <link rel="apple-touch-icon" href="" />

    <!-- Font Awesome -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="<?php echo URL_ROOT;?>public/stylesheets/main.css" rel="stylesheet" />

    <!-- <link rel="stylesheet" href="assets/stylesheets/style.css" type="text/css" /> -->

    <title>MicroCAPS</title>
</head>

<body class="color">
<section class="">
    <!-- <div class="container"> -->
    <div class="column align-items-center border padding-5  width-rem-25 height-25">

        <div class="text-center">
            <img src="<?php echo URL_ROOT;?>public/images/logo.png" class="text-center width-75" alt="logo"/>
        </div>

        <div class="text-center">
            <h3 class="margin-top-4 margin-bottom-5">Log In</h3>
        </div>

        <form action="<?php echo URL_ROOT; ?>Testers/login" method="post" autocomplete="off">

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
                <label class="form-label <?php echo (empty($data['username_err'])) ? '' : 'red' ; ?>"><?php echo (empty($data['username_err'])) ? 'Username' : 'Incorrect Username' ; ?></label>
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
                <label class="form-label <?php echo (empty($data['password_err'])) ? '' : 'red' ; ?>"><?php echo (empty($data['password_err'])) ? 'Password' : 'Incorrect Password' ; ?></label>
            </div>

            <div class="text-center margin-top-3 margin-bottom-5">
                <button class="btn btn-primary" type="submit" onClick={this.onSubmit}>
                    Submit
                </button>
            </div>

        </form>

        <!-- </div> -->
    </div>
</section>

</body>

</html>