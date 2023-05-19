<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/notification.php'; ?>


<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="common-area-inner">
            <div class="common-heading">
                Account Settings
            </div>

            <div class="settings-card">
                <div class="display-flex-column align-items-center justify-content-center">
                    <div class="img-grid">
                        <div style="background-image:url(<?php echo URL_ROOT; ?>public/images/profile/<?php echo $data['userDetails']->Image; ?>)" class="border-radius-11 width-rem-12p5 height-rem-12p5 background-image" title="profilepic" id="img-preview"></div>
                        <img src="<?php echo URL_ROOT; ?>public/images/add.png" class="grid-add width-rem-2p5"/>
                    </div>
                    <div class="settings-username margin-top-4">
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
                    <div class="text-center font-size margin-top-3 text-blue pointer" id="chg-pass">Change Password</div>
                    <div class="display-flex-column align-items-baseline width-rem-20">
                        <div class="text-fontgray font-size margin-top-5">
                            <b>Employee Id:</b> <?php echo $data['userDetails']->EmployeeId; ?>
                        </div>
                        <div class="text-fontgray font-size margin-top-3">
                            <b>Role:</b> <?php echo $data['userDetails']->Position; ?>
                        </div>
                        <div class="text-fontgray font-size margin-top-3">
                            <b>Stage:</b> <?php echo $data['userDetails']->EmployeeId; ?>
                        </div>
                    </div>

                </div>
                <div class="display-flex-column align-items-center justify-content-center margin-top-6 ">
                    <form enctype="multipart/form-data" id="details">
                        <div>
                            <div>
                                <input type="file" id="image" class="display-none" name="profile" accept="image/*" disabled />
                            </div>
                            <div>
                                <input type="text" id="firstname" name="firstname" onChange="" value="<?php echo $data['userDetails']->Firstname; ?>" class="form-control form-control-blue text-fontgray width-rem-20" placeholder="Firstname" autocomplete="off" disabled focuse />
                                <label for="firstname" class="form-label blue">First Name</label>
                            </div>
                            <div>
                                <input type="text" id="lastname" name="lastname" onChange="" value="<?php echo $data['userDetails']->Lastname; ?>" class="form-control form-control-blue text-fontgray width-rem-20" placeholder="Lastname" disabled />
                                <label class="form-label blue">Last Name</label>
                            </div>
                            <div>
                                <input type="text" id="email" name="email" onChange="" value="<?php echo $data['userDetails']->Email; ?>" class="form-control form-control-blue text-fontgray width-rem-20" placeholder="Email" disabled />
                                <label class="form-label blue">Email</label>
                            </div>
                            <div>
                                <input type="text" id="mobile" name="mobile" onChange="" value="<?php echo $data['userDetails']->TelephoneNo; ?>" class="form-control form-control-blue text-fontgray width-rem-20" placeholder="mobile" disabled />
                                <label class="form-label blue">Mobile Number</label>
                            </div>
                            <div>
                                <input type="text" id="nic" name="nic" onChange="" value="<?php echo $data['userDetails']->NIC; ?>" class="form-control form-control-blue text-fontgray width-rem-20" placeholder="nic" disabled />
                                <label class="form-label blue">NIC</label>
                            </div>
                            <div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="overlay display-flex-row align-items-center justify-content-center" id="overlay">
    <section id="pop-con">
        <div class="row align-items-center border-gray padding-5  width-rem-25 justify-content-center">

            <div class="text-center">
                <img src="<?php echo URL_ROOT;?>public/images/logo.png" class="text-center width-50" alt="logo"/>
            </div>

            <div class="text-center">
                <h3 class="margin-top-4">Change Password</h3>
            </div>

            <form autocomplete="off">

            <div>
                    <input type="password"
                        id="currentpassword"
                        name="currentPassword"
                        onChange=""
                        value=""
                        class="form-control"
                        placeholder="Current Password"
                        autocomplete="off"
                        required />
                    <label id="current-label" class="form-label">Current Password</label>
                    <span id="out"></span>

                </div>

                <div>
                    <input type="password"
                        id="newpassword"
                        name="newPassword"
                        onChange=""
                        value=""
                        class="form-control"
                        placeholder="New Password"
                        autocomplete="off"
                        required />
                    <label class="form-label">New Password</label>
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
                    <button class="btn btn-primary" type="button" id="update-btn" disabled="true" onclick="updatePassword()">
                        Update Password
                    </button>
                </div>

                <div class="text-center text-blue font-size margin-top-3 pointer" id="cancel">Cancel</div>

            </form>
        </div>
    </section>
</div>

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/cors.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/settings.js"></script>

<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>