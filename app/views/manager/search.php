<?php require_once APP_ROOT . '\views\includes\header.php'; ?>
<body class="display-flex-column height-vh-100 gap-2 align-items-center justify-content-center">
<section>
    <div class="row align-items-center border-gray padding-5  width-rem-20 justify-content-center">

        <div class="text-center">
            <img src="<?php echo URL_ROOT;?>public/images/logo.png" class="text-center width-50" alt="logo"/>
        </div>

        <div class="text-center">
            <h3 class="margin-top-4">Search User</h3>
        </div>

        <form action="<?php echo URL_ROOT; ?>Managers/search" method="post" autocomplete="off">

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
                <label id="username-label" class="form-label <?php echo (empty($data['username_err'])) ? '' : 'red' ; ?>"><?php echo (empty($data['username_err'])) ? 'Username' : 'User Not Found' ; ?></label>
                <span></span>

            </div>

            <div class="text-center margin-top-3">
                <button class="btn btn-primary" type="submit">
                    Search
                </button>
            </div>

        </form>
    </div>
</section>

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/form.js"></script>

</body>

</html>