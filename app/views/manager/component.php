<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="page-heading font-weight">
            Request Components
        </div>
    </section>

    <section class="shell-forms top-10 position-absolute display-block" id="one">
        <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
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

    <!-- <section class="shell-forms top-10 position-absolute display-block" id="one">
        <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
            <div class="display-flex-column gap-1 padding-4">
                <table role="presentation" aria-hidden="true" width="100%" class="" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th valign="bottom" class="text-darkblue font-weight font-size-16 width-rem-12 padding-bottom-2 border-bottom">
                                MODEL
                            </th>
                            <th valign="bottom" class="text-darkblue font-weight font-size-16 width-rem-12 padding-bottom-2 border-bottom">
                                COLOR
                            </th>
                            <th valign="bottom" class="text-darkblue font-weight font-size-16 width-rem-12 padding-bottom-2 border-bottom">
                                QUANTITY
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($data['componentRequestDetails'] as $request){
                            echo ' <tr>
                                <th valign="bottom" class="detail font-size-16 width-rem-12 padding-3">
                                    '.$request->ModelName.'
                                </th>
                                <th valign="bottom" class="detail font-size-16 width-rem-12 padding-3">
                                    '.$request->Color.'
                                </th>
                                <th valign="bottom" class="detail font-size-16 width-rem-12 padding-3">
                                    '.$request->Qty.'
                                </th>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>

                <div class="text-center margin-top-3">
                    <button class="btn btn-primary" type="button"  onclick="createList()">
                        Create Component List
                    </button>
                </div>
            </div>
        </div>
    </section> -->

    <section class="display-flex-column">

        <div id="alert" class="hideme" role="alert"></div>

    </section>

    <!-- <script>
        window.onload = function() {
            if (getItem("PDFState") === "Set") {
                
            }

            removeLocalStorage();
        }
    </script> -->
    
    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/component.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>

</body>