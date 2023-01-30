<?php require_once APP_ROOT . '\views\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="page-heading font-weight">
            Body Shell
        </div>

        <div class="display-flex-column align-items-start border-radius-1 background-white paddingx-5 paddingy-3 margin-top-3">
            <div class="display-flex-row align-items-start align-self-center gap-1">
                <div onclick="rounds(event, 'one')" class="shell-btn active display-flex-column align-items-center justify-content-center border-radius-1">
                    <div class="padding-3 font-weight">Request New Shell</div>
                </div>
                <div onclick="rounds(event, 'two')" class="shell-btn display-flex-column align-items-center justify-content-center border-radius-1" id = "option-two">
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
            <form id="request-shell">
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
                    <button class="btn btn-primary" type="button"  onclick="requestShell()">
                        Request Shell
                    </button>
                </div>

            </form>
        </div>
    </section>

    <section class="shell-forms position-absolute" id="two">
        <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
            <div class="section-heading font-weight"> New Body Shell </div>
            <form id="add-shell">
                <div class="display-flex-row align-items-center gap-2">
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
                <div class="display-flex-row align-items-center gap-2p1">
                    <div>
                        <!-- <input type="text"
                            id="dropdown"
                            name="chassisType"
                            onChange=""
                            value=""
                            class="form-control custom-select-2"
                            placeholder="Chassis Type"
                            autocomplete="off"
                            required />
                        <label class="form-label">Chassis Type</label> -->
                        <div class="custom-select-2">
                            <select name="chassis" class="form-control text-gray width-rem-20" id="chassis">
                                <option value="">Select Chassis Type</option>
                                <option value="SUV">SUV</option>
                                <option value="Normal">Normal</option>
                            </select>
                            <label class="chassis-label display-none" id="chassis-label">Chassis Type</label>
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
                <div class="display-none display-flex-row align-items-center justify-content-center gap-2 margin-top-4" id="repairD">
                    <div class="">
                        <input type="text"
                            id="repairDescription"
                            name="repairDescription"
                            onChange=""
                            value=""
                            class="form-control width-rem-38p75"
                            placeholder="Repair Description"
                            autocomplete="off" />
                        <label class="form-label">Repair Description</label>
                    </div>
                </div>
                <div class="text-center margin-top-3">
                    <button class="btn btn-primary" type="button" onclick="addShell()">
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
                    $job = "'repair'";

                    if ( $data['repairDetails'] == false ) {
                        echo '<div class="display-flex-row justify-content-center align-items-center padding-z border-bottom gap-3">
                        <div class="display-flex-row align-items-start">
                                <div class="display-flex-column align-items-start">
                                    <div class="font-weight">No Details</div>
                                </div>
                            </div>
                    </div>';
                    } else {
                        foreach($data['repairDetails'] as $value) {
                            $id = "'".$value->RepairID."'";
                            echo '<div class="display-flex-row justify-content-center align-items-center paddingy-2 paddingx-3 border-bottom gap-3">
                            <div class="display-flex-row align-items-start">
                                <div class="display-flex-column align-items-start">
                                    <div class="font-weight">'.$value->ChassisNo.'</div>
                                    <div class="text-gray">'.$value->RepairID.'</div>
                                </div>
                            </div>
                            <div class="display-flex-row align-items-end inner-layout">
                                <div class="display-flex-row align-items-center gap-2 padding-3">
                                    <button class="btn btn-primary width-rem-12 height-rem-2 padding-0" type="submit">
                                            Request a Re-Repair
                                    </button>
                                    <label class="form-control-checkbox">
                                        <input type="checkbox"
                                                id="repairJob"
                                                onChange="jobDone('.$id.','.$job.')"  
                                                name="repair"
                                                value="Yes">
                                        <div class="checkmark"></div>
                                    </label>
                                </div>
                            </div>
                        </div>';
                        }  
                    }

                    
                ?>
            </div>
            <div class="display-flex-column align-items-center border-radius-1 background-white paddingx-5 paddingy-5">
                <div class="section-heading font-weight"> Paint Jobs </div>
                <?php
                    $job = "'paint'";
                    if ( $data['paintDetails'] == false ) {
                        echo '<div class="display-flex-row justify-content-center align-items-center padding-z border-bottom gap-3">
                        <div class="display-flex-row align-items-start">
                                <div class="display-flex-column align-items-start">
                                    <div class="font-weight">No Details</div>
                                </div>
                            </div>
                    </div>';
                    } else {
                    foreach($data['paintDetails'] as $value) {
                        $id = "'".$value->PaintID."'";
                        echo '<div class="display-flex-row justify-content-center align-items-center paddingy-2 paddingx-3 border-bottom gap-3">
                        <div class="display-flex-row align-items-start">
                            <div class="display-flex-column align-items-start">
                                <div class="font-weight">'.$value->ChassisNo.'</div>
                                <div class="text-gray">'.$value->PaintID.'</div>
                            </div>
                        </div>
                        <div class="display-flex-row align-items-end inner-layout">
                            <div class="display-flex-row align-items-center gap-2 padding-3">
                                <button class="btn btn-primary  width-rem-12 height-rem-2 padding-0" type="submit">
                                    Request a Re-Paint
                                </button>
                                <label class="form-control-checkbox">
                                    <input type="checkbox"
                                            id="paintJob"
                                            onChange="jobDone( '.$id.','.$job.')" 
                                            name="paint"
                                            value="Yes">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>';
                    }
                }
                ?>
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

    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/bodyshell.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/cors.js"></script>

</body>