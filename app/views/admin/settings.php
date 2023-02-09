<?php require_once APP_ROOT . '\views\admin\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\admin\includes\navbar.php'; ?>

<section class = "position-absolute page-content" >
    <div class="page-heading  font-weight">
        Account Settings
    </div>

    <div class="display-flex-row align-items-center gap-10 border-radius-1 background-white paddingx-6 paddingy-5 height-rem-25 margin-top-4">
        <div class="display-flex-column align-items-center justify-content-center margin-left-5">
            <div class="img-grid">
                <div style="background-image:url(<?php echo URL_ROOT; ?>public/images/profile/<?php echo $data['userDetails']->Image; ?>)" class="border-radius-11 width-rem-12p5 height-rem-12p5 background-image" title="profilepic" id="img-preview"></div>
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
                <button id="change" class="btn btn-primary btn-green display-none width-rem-8p5 height-rem-2p5" type="submit" onclick="saveChanges(<?php echo $_SESSION['_id'] ?>, '<?php echo $_SESSION['_position'] ?>')">
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
                            class="form-control form-control-blue text-fontgray width-rem-25"
                            placeholder="Firstname"
                            autocomplete="off"
                            disabled
                            focuse />
                        <label class="form-label blue">First Name</label>
                    </div>
                    <div>
                        <input type="text"
                            id="email"
                            name="email"
                            onChange=""
                            value="<?php echo $data['userDetails']->Email; ?>"
                            class="form-control form-control-blue text-fontgray width-rem-25"
                            placeholder="Email"
                            disabled />
                        <label class="form-label blue">Email</label>
                    </div>
                <div>
            </form>
        </div>
    </div>
</section>

<section class="display-flex-column">

    <div id="alert" class="hideme" role="alert"></div>

</section>


<script type="module" src="<?php echo URL_ROOT;?>public/javascripts/adminjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/adminjs/cors.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/adminjs/settings.js"></script>

