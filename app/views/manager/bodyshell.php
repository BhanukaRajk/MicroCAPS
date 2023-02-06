<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="page-heading font-weight">
            Body Shell
        </div>

        <div class="display-flex-column align-items-start margin-top-3">
            <div class="display-flex-row align-items-start align-self-start width-fill-available gap-1 border-radius-1 background-white paddingx-5 paddingy-3 ">
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
                <div id="fields">
                    <div class="display-flex-row align-items-start gap-1">
                        <div>
                            <div class="custom-select">
                                <select name="type1" class="form-control form-control-blue text-blue" id="type1">
                                    <option value="">Select Chassis Type</option>
                                    <option value="Micro Panda">Micro Panda</option>
                                    <option value="Micro Panda Cross">Micro Panda Cross</option>
                                    <option value="MG ZS SUV">MG ZS SUV</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <input type="number"
                                id="qty1"
                                name="qty1"
                                onChange=""
                                value="0"
                                class="form-control"
                                placeholder="Username"
                                autocomplete="off"
                                required />
                            <label class="form-label">Quantity</label>
                        </div>
                        <div class="addBtn font-size-24 font-weight border-blue background-blue text-white padding-2 border-radius-11" id="addBtnContainer">
                            <i class="fas fa-plus" id="addBtn"></i>
                        </div>
                    </div>
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
                <div class="display-flex-row align-items-start gap-2">
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
                        <div class="custom-select-color">
                            <select name="color" class="form-control text-gray width-rem-20" id="color">
                                <option value="">Select Color</option>
                                <option value="White">White</option>
                                <option value="Black">Black</option>
                                <option value="Red">Red</option>
                                <option value="Green">Green</option>
                                <option value="Blue">Blue</option>
                                <option value="Yellow">Yellow</option>
                            </select>
                            <label class="color-label display-none" id="color-label">Color</label>
                        </div>
                    </div>
                </div>
                <div class="display-flex-row align-items-center gap-2p1">
                    <div>
                        <div class="custom-select-model">
                            <select name="chassis" class="form-control text-gray width-rem-20" id="chassis">
                                <option value="">Select Chassis Type</option>
                                <option value="M0001">Micro Panda</option>
                                <option value="M0002">Micro Panda Cross</option>
                                <option value="M0003">MG ZS SUV</option>
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
        <?php
            if ( $data['shellDetails'] == false ) {
                echo '
                        <div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                                <div class="font-weight">No Details</div>
                            </div>
                        ';
            } else {
                echo '<div class="vehicle-detail-board  margin-bottom-4">
                        <div class="vehicle-data-board justify-content-evenly">';
                foreach($data['shellDetails'] as $value) {

                    $repairS = $data['repairDetails'] ? array_search($value->ChassisNo, array_column($data['repairDetails'], 'ChassisNo')) : false ;
                    $paintS = $data['paintDetails'] ? array_search($value->ChassisNo, array_column($data['paintDetails'], 'ChassisNo')) : false ;
                    $status = $color = "";

                    if ($repairS || $repairS === 0) {
                        $status = "Repair & Paint";
                        $color = "red";
                    } 
                    else if ($paintS  || $paintS === 0) {
                        $status = "Paint";
                        $color = "orange";
                    }
                    else {
                        $status = "Ready";
                        $color = "green";
                    }

                    echo '<div class="carcard">
                            <div class="cardhead">
                                <div class="cardid">
                                    <div class="carmodel">'.$value->ModelName.'</div>
                                    <div class="chassisno">'.$value->ChassisNo.'</div>
                                </div>
                            </div>
                            <div class="carpicbox">
                                <img src="'. URL_ROOT .'public/images/chassis.jpg" class="carpic" alt="'.$value->ModelName.' '. $value->Color.'">
                            </div>
                            <div class="carstatus '.$color.'">'.$status.'</div>
                            <div class="arrivaldate">Arrival Date: ' , $value->ArrivalDate, '</div>
                        </div>';
                }

                echo '  </div>
                    </div>';
                
            }
        ?>
            
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
                            $id = "'".$value->RepairId."'";
                            echo '<div class="display-flex-row justify-content-center align-items-center paddingy-2 paddingx-3 border-bottom gap-3">
                            <div class="display-flex-row align-items-start">
                                <div class="display-flex-column align-items-start">
                                    <div class="font-weight">'.$value->ChassisNo.'</div>
                                    <div class="text-gray">'.$value->RepairId.'</div>
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
                        $id = "'".$value->PaintId."'";
                        echo '<div class="display-flex-row justify-content-center align-items-center paddingy-2 paddingx-3 border-bottom gap-3">
                        <div class="display-flex-row align-items-start">
                            <div class="display-flex-column align-items-start">
                                <div class="font-weight">'.$value->ChassisNo.'</div>
                                <div class="text-gray">'.$value->PaintId.'</div>
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

        <div id="alert" class="hideme" role="alert"></div>

    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/main.js"></script>
    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/addFields.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/bodyshell.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/cors.js"></script>

</body>