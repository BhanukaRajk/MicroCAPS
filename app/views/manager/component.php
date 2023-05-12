<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="page-heading font-weight">
            Components
        </div>

        <div class="display-flex-column align-items-start margin-top-3">
            <div class="display-flex-row align-items-start align-self-start width-fill-available gap-1 border-radius-1 background-white paddingx-5 paddingy-3 ">
                <div onclick="rounds(event, 'one')" class="shell-btn active display-flex-column align-items-center justify-content-center border-radius-1">
                    <div class="padding-3 font-weight">Request Components</div>
                </div>
                <div onclick="rounds(event, 'two')" class="shell-btn display-flex-column align-items-center justify-content-center border-radius-1" id = "option-two">
                    <div class="padding-3 font-weight">Add Components</div>
                </div>
            </div>
        </div>
    </section>

    <section class="shell-forms position-absolute display-block" id="one">
        <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
            <div class="section-heading font-weight"> Send a Request </div>
            <form id="request-shell">
                <div id="fields">
                    <div class="display-flex-row align-items-start gap-1 "  id="field1">
                        <div>
                            <div class="custom-select-type1">
                                <select name="type1" class="form-control form-control-blue text-blue" id="type1">
                                    <option value="">Select Chassis Type</option>
                                    <option value="M0001">Micro Panda</option>
                                    <option value="M0002">Micro Panda Cross</option>
                                    <option value="M0003">MG ZS SUV</option>
                                </select>
                                <label class="type1-label text-blue display-none" id="type1-label">Chassis Type</label>
                            </div>
                        </div>
                        <div>
                            <div class="custom-select-color1">
                                <select name="color1" class="form-control form-control-blue text-blue" id="color1">
                                    <option value="">Select Color</option>
                                </select>
                                <label class="color1-label text-blue display-none" id="color1-label">Color</label>
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
                    <button class="btn btn-primary" type="button"  onclick="createList()">
                        Create Component List
                    </button>
                </div>

            </form>
        </div>
    </section>

    <section class="shell-forms position-absolute" id="two">
        <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
            <div class="display-flex-row justify-content-between align-items-center width-100"> 
                <div class="section-heading font-weight">Received Components</div>
                <div class="custom-select">
                    <select name="vehicles" id="components" onchange="component()">
                        <?php 
                            foreach($data['chassis'] as $value) {
                                echo '<option value="' . $value->ChassisNo . '">'.$value->ChassisNo.'</option>';
                            }
                        ?>>
                    </select>
                </div>
            </div>

            <?php 
            
            if ($data['chassis'] == false) {
                echo '
                            <div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                                    <div class="font-weight">No Details</div>
                                </div>
                            ';
            } else {

                echo '<div class="display-flex-row justify-content-between align-items-center width-80">
                    <div class="display-flex-column">
                        <div class="paddingy-2 font-weight" id="chassiNoC">Chassis No : '.$data['chassis'][0]->ChassisNo.'</div>
                        <div class="paddingy-2 font-weight" id="colorC">Color : '.$data['chassis'][0]->Color.'</div>
                    </div>
                    <label class="form-control-checkbox">
                        Select All
                        <input type="checkbox"
                                id="select-all"
                                name="select-all"
                                value="Yes">
                        <div class="checkmark"></div>
                    </label>
                </div>';

                echo '<div id="selected" class="margin-top-3"><div class="display-flex-row gap-5">';

                $count = 1;

                foreach ($data['components'] as $value) {

                    if ($count == 1) {
                        echo '<div class="display-flex-column gap-1">';
                    }

                    if ($value->Status == 'R') {
                        $checked = 'checked';
                        $disabled = 'disabled';
                    } else {
                        $checked = '';
                        $disabled = '';
                    }

                    echo '<div class="display-flex-row justify-content-between border-bottom width-rem-12">
                                <div class="padding-bottom-3 font-size">'.$value->PartName.'</div>
                                <label class="form-control-checkbox" id="checkbox">
                                    <input type="checkbox"
                                            id="componentStatus"
                                            name="status"
                                            value="'.$value->PartNo.'" 
                                            '. $disabled .'
                                            '. $checked .'>
                                    <div class="checkmark-small-blue"></div>
                                </label>
                            </div>';
                    
                    $count++;

                    if ($count == 51) {
                        echo '</div>';
                        $count = 1;
                    }

                }

                echo '</div>
                    <div class="text-center margin-top-3">
                        <button class="btn btn-primary" type="button"  onclick="changeComponentStatus(\''.$data['chassis'][0]->ChassisNo.'\')">
                            Mark as Received
                        </button>
                    </div></div>';
            }
                
            
            ?>

                
            
        </div>
    </section>

    <section class="display-flex-column">

        <div id="alert" class="hideme" role="alert"></div>

    </section>
    
    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/addFieldsComponent.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/components.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>

</body>