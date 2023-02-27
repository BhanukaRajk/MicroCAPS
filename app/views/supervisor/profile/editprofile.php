<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>

<section class = "position-absolute page-content" >
    <div class="page-heading  font-weight">
        Account Settings
    </div>

    <div class="display-flex-row align-items-center gap-10 border-radius-1 background-white paddingx-6 paddingy-5 height-rem-25 margin-top-4">
        <div class="display-flex-column align-items-center justify-content-center margin-left-5">
            <div class="img-grid">
                <img src="<?php echo URL_ROOT; ?>public/images/profile/<?php echo $data['userDetails']->Image; ?>" class="border-radius-11 width-rem-12p5" alt="profilepic" id="img-preview"/>
                <img src="<?php echo URL_ROOT; ?>public/images/add.png" class="grid-add width-rem-2p5"/>
            </div>
            <div class="page-heading font-size-24 font-weight margin-top-4">
                <?php echo $_SESSION['_firstname'] . ' ' . $_SESSION['_lastname']; ?>
            </div>
            <div class="text-center text-fontgray font-size margin-top-1">
                <?php echo $data['userDetails']->Position; ?>
            </div>
            <div class="text-center margin-top-3">
                <button id="edit" class="btn btn-primary width-rem-8p5 height-rem-2p5" type="button">
                    Edit Details
                </button>
                <button id="change" class="btn btn-primary btn-green display-none width-rem-8p5 height-rem-2p5" type="submit" onclick="saveChanges(<?php echo $_SESSION['_id'] ?>)">
                    Change
                </button>
            </div>
        </div>
        <div class="display-flex-column align-items-center justify-content-center margin-top-6 margin-left-5">
            <form enctype="multipart/form-data" id="details">
                <div>
                    <div>
                        <input type="file" 
                            id="image" 
                            class="display-none"
                            name="profile" 
                            accept="image/*" 
                            disabled />
                    </div>
                    <div>
                        <input type="text"
                            id="firstname"
                            name="firstname"
                            onChange=""
                            value="<?php echo $data['userDetails']->Firstname; ?>"
                            class="form-control form-control-blue text-fontgray width-rem-20"
                            placeholder="Firstname"
                            autocomplete="off"
                            disabled
                            focuse />
                        <label class="form-label blue">First Name</label>
                    </div>
                    <div>
                        <input type="text"
                            id="lastname"
                            name="lastname"
                            onChange=""
                            value="<?php echo $data['userDetails']->Lastname; ?>"
                            class="form-control form-control-blue text-fontgray width-rem-20"
                            placeholder="Lastname"
                            disabled />
                        <label class="form-label blue">Last Name</label>
                    </div>
                    <div>
                        <input type="text"
                            id="email"
                            name="email"
                            onChange=""
                            value="<?php echo $data['userDetails']->Email; ?>"
                            class="form-control form-control-blue text-fontgray width-rem-20"
                            placeholder="Email"
                            disabled />
                        <label class="form-label blue">Email</label>
                    </div>
                    <div>
                        <input type="text"
                            id="mobile"
                            name="mobile"
                            onChange=""
                            value="<?php echo $data['userDetails']->TelephoneNo; ?>"
                            class="form-control form-control-blue text-fontgray width-rem-20"
                            placeholder="mobile"
                            disabled />
                        <label class="form-label blue">Mobile Number</label>
                    </div>
                    <div>
                        <input type="text"
                            id="nic"
                            name="nic"
                            onChange=""
                            value="<?php echo $data['userDetails']->NIC; ?>"
                            class="form-control form-control-blue text-fontgray width-rem-20"
                            placeholder="nic"
                            disabled />
                        <label class="form-label blue">NIC</label>
                    </div>
                <div>
            </form>
        </div>
    </div>
</section>

<section class="display-flex-column">

    <div class="alert fade alert-success" id="alert-success" role="alert">
        <i class="icon fa-check-circle margin-right-3"></i>
        Success
    </div>

    <div class="alert fade alert-failure" id="alert-faliure" role="alert">
        <i class="icon fa-times-circle margin-right-3"></i>
        Falied
    </div>

</section>


<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/supervisorjs/smd.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/supervisorjs/cors.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/supervisorjs/settings.js"></script>