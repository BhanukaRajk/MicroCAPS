<?php require_once APP_ROOT . '\views\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\navbar.php'; ?>


<section class="position-absolute page-content">
    <div class="page-heading font-weight">
        Body Shell
    </div>

    <div class="display-flex-column align-items-start border-radius-1 background-white paddingx-5 paddingy-3 margin-top-3">
        <div class="display-flex-row align-items-start align-self-center gap-1">
            <div onclick="rounds(event, 'one')" class="shell-btn active display-flex-column align-items-center justify-content-center border-radius-1">
                <div class="padding-3 font-weight">Request New Shell</div>
            </div>
            <div onclick="rounds(event, 'two')" class="shell-btn display-flex-column align-items-center justify-content-center border-radius-1">
                <div class="padding-3 font-weight">Add New Shell</div>
            </div>
            <div onclick="rounds(event, 'three')" class="shell-btn display-flex-column align-items-center justify-content-center border-radius-1">
                <div class="padding-3 font-weight">Shell Details</div>
            </div>
            <div onclick="rounds(event, 'four')" class="shell-btn display-flex-column align-items-center justify-content-center border-radius-1">
                <div class="padding-3 font-weight">Repair & Paint</div>
            </div>
        </div>
    </div>
</section>

<section class="shell-forms position-absolute display-block" id="one">
    <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
        <div class="section-heading font-weight"> Send a Request </div>
        <form action="<?php echo URL_ROOT; ?>Managers/shellRequest" method="post">
            <div>
                <input type="number"
                       id="Chassis01"
                       name="suvQty"
                       onChange=""
                       value="0"
                       class="form-control"
                       placeholder="Username"
                       autocomplete="off"
                       required />
                <label class="form-label">SUV Chassis - Quantity</label>
            </div>
            <div>
                <input type="number"
                       id="chasis02"
                       name="normalQty"
                       onChange=""
                       value="0"
                       class="form-control"
                       placeholder="Password"
                       required />
                <label class="form-label">Normal Chassis - Quantity</label>
            </div>

            <div class="text-center margin-top-3">
                <button class="btn btn-primary" type="submit" onClick={this.onSubmit}>
                    Request Shell
                </button>
            </div>

        </form>
    </div>
</section>

<section class="shell-forms position-absolute" id="two">
    <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
        <div class="section-heading font-weight"> New Body Shell </div>
        <form action="<?php echo URL_ROOT; ?>Managers/addShell" method="post">
            <div class="display-flex-row align-items-center justify-content-center gap-2">
                <div>
                    <input type="text"
                        id="chassisNo"
                        name="chassisNo"
                        onChange=""
                        value=""
                        class="form-control"
                        placeholder="Chassis Number"
                        autocomplete="off"
                        required />
                    <label class="form-label">Chassis Number</label>
                </div>
                <div>
                    <input type="text"
                        id="color"
                        name="color"
                        onChange=""
                        value=""
                        class="form-control"
                        placeholder="Color"
                        required />
                    <label class="form-label">Color</label>
                </div>
            </div>
            <div class="display-flex-row align-items-center justify-content-center gap-2p1">
                <div>
                    
                    <input type="text"
                        id="dropdown"
                        name="chassisType"
                        onChange=""
                        value=""
                        class="form-control"
                        placeholder="Chassis Type"
                        autocomplete="off"
                        required />
                    <label class="form-label">Chassis Type</label>
                    <div class="select display-none" id="select">
                        <div class="form-control display-flex-column align-items-center paddingy-0">
                            <div class="text-gray width-inherit border-bottom paddingy-3" onclick="selectFunc('')">Select</div>
                            <div class="text-gray width-inherit border-bottom paddingy-3" onclick="selectFunc('SUV')">SUV</div>
                            <div class="text-gray width-inherit paddingy-3" onclick="selectFunc('Normal')">Normal</div>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="form-control-checkbox">
                        Repair
                        <input type="checkbox"
                                id="repair"
                                name="repair"
                                value="Yes">
                        <div class="checkmark"></div>
                    </label>
                </div>
                <div>
                    <label class="form-control-checkbox">
                        Paint Work
                        <input type="checkbox"
                                id="paint"
                                name="paint"
                                value="Yes">
                        <div class="checkmark"></div>
                    </label>
                </div>
            </div>

            <div class="text-center margin-top-3">
                <button class="btn btn-primary" type="submit">
                    Submit
                </button>
            </div>

        </form>
    </div>
</section>

<section class="shell-forms position-absolute" id="three">
    <div class="display-flex-column align-items-center border-radius-1 background-white paddingx-5 paddingy-5 margin-bottom-4">
        <?php
            foreach($data['shellDetails'] as $value) {
                echo '<div class="display-flex-row justify-content-center align-items-center paddingy-2 paddingx-3 border-bottom gap-46">
                <div class="display-flex-row align-items-start">
                    <div class="display-flex-column align-items-start">
                        <div class="font-weight">'.$value->ChassisNo.'</div>
                        <div class="text-gray">'.rearrange($value->ArrivalDate).'</div>
                    </div>
                </div>
                <div class="display-flex-row align-items-end inner-layout">
                    <div class="display-flex-row align-items-center gap-0p5 padding-3">
                        <div class="view-more">View More Details</div>
                        <img src="'. URL_ROOT .'public/images/right.png" class="width-rem-0p75" alt="right" id="right"/>
                    </div>
                </div>
            </div>';
            }
        ?>
    </div>
</section>

<section class="shell-forms position-absolute" id="four">
    <div class="display-flex-row gap-1 margin-bottom-4">
        <div class="display-flex-column align-items-center border-radius-1 background-white paddingx-5 paddingy-5">
            <div class="section-heading font-weight"> Repair Jobs </div>
            <?php
                foreach($data['repairDetails'] as $value) {
                    echo '<div class="display-flex-row justify-content-center align-items-center paddingy-2 paddingx-3 border-bottom gap-3">
                    <div class="display-flex-row align-items-start">
                        <div class="display-flex-column align-items-start">
                            <div class="font-weight">'.$value->ChassisNo.'</div>
                        </div>
                    </div>
                    <div class="display-flex-row align-items-end inner-layout">
                        <div class="display-flex-row align-items-center gap-2 padding-3">
                            <button class="btn btn-primary width-rem-12 height-rem-2 padding-0" type="submit">
                                    Request a Re-Repair
                            </button>
                            <label class="form-control-checkbox">
                                <input type="checkbox"
                                        id="repair"
                                        name="repair"
                                        value="Yes">
                                <div class="checkmark"></div>
                            </label>
                        </div>
                    </div>
                </div>';
                }
            ?>
        </div>
        <div class="display-flex-column align-items-center border-radius-1 background-white paddingx-5 paddingy-5">
            <div class="section-heading font-weight"> Paint Jobs </div>
            <?php
                foreach($data['paintDetails'] as $value) {
                    echo '<div class="display-flex-row justify-content-center align-items-center paddingy-2 paddingx-3 border-bottom gap-3">
                    <div class="display-flex-row align-items-start">
                        <div class="display-flex-column align-items-start">
                            <div class="font-weight">'.$value->ChassisNo.'</div>
                        </div>
                    </div>
                    <div class="display-flex-row align-items-end inner-layout">
                        <div class="display-flex-row align-items-center gap-2 padding-3">
                            <button class="btn btn-primary  width-rem-12 height-rem-2 padding-0" type="submit">
                                Request a Re-Paint
                            </button>
                            <label class="form-control-checkbox">
                                <input type="checkbox"
                                        id="repair"
                                        name="repair"
                                        value="Yes">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>';
                }
            ?>
        </div>
    </div>
</section>

<?php 
    
    if (isset($_SESSION['addShell_Message'])) {
        if ($_SESSION['addShell_Message'] == 'Successful') {
            echo '<div class="success-flash display-block" id="flash">Data Insertion in Successfull</div>';
            unset($_SESSION['addShell_Message']);
        } elseif ($_SESSION['addShell_Message'] == 'Error') {
            echo '<div class="err-flash display-block" id="flash">Data Insertion in Unsuccessfull</div>' ;
            unset($_SESSION['addShell_Message']);
        }
    }
    

?>

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/main.js"></script>
