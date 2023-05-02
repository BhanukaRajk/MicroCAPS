<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row margin-bottom-3 align-items-center justify-content-between margin-right-6 margin-bottom-4">
            <div class="page-heading font-weight">
                Pre Delivery Testing
            </div>
        </div>

        <div class="display-flex-row justify-content-between">
        <div>
            <div class="paddingy-2 font-weight">VIN : <?php echo $data['pdiVehicle']->ChassisNo ?></div>
            <div class="paddingy-2 font-weight">Engine : <?php echo $data['pdiVehicle']->EngineNo ?></div>
        </div>
        <div>
            <button class="btn btn-primary" id="chg-pass">Add Defect</button>
        </div>
        </div>


        <div class="display-flex-row justify-content-start gap-2 margin-top-3 flex-wrap">

        <?php 
                foreach ($data['pdiCheckCategories'] as $value) {
                    echo '
                        <div class="pdi-card">
                            <div class="pdi-card-head">
                                <div class="pdi-card-main">'.$value->Title.'</div>
                                <div class="pdi-card-sub">'.$value->SubTitle.'</div>

                                <div class="pdiresultbox paddingy-3">
                    ';

                    foreach ($data['pdiCheckList'] as $value2) {
                        if ($value2->CategoryId == $value->CategoryId) {
                            $check1 = $value2->Status == 'OK' ? "checked" : "";
                            $check2 = $value2->Status == 'SA' ? "checked" : "";
                            echo '
                                <div class="paddingx-4 paddingy-2">
                                    <div class="pdi-checklist">
                                        <div class="padding-bottom-3 font-size">'.$value2->CheckName.'</div>
                                        <div>
                                        <input type="radio" name="' .$value2->CheckId.'" 
                                        value="OK" 
                                        class="round-checkbox-green" 
                                        onChange="addPDI(\''.$value2->ChassisNo.'\',\''.$value2->CheckId.'\',\'OK\')" '.$check1.'>
                                <input type="radio" name="' .$value2->CheckId.'" 
                                        value="SA" 
                                        class="round-checkbox-red" 
                                        onChange="addPDI(\''.$value2->ChassisNo.'\',\''.$value2->CheckId.'\',\'SA\')" '.$check2.'>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    }

                    echo '
                                </div>
                            </div>
                        </div>
                    ';
                }
            ?>

        </div>
    </section>

    <section class="display-flex-column">

        <div id="alert" class="hideme" role="alert"></div>
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

<script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/cors.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/testerjs/settings.js"></script>


</body>

