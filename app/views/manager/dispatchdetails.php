<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>



<section class="position-absolute page-content">
    
    <div class="display-flex-column gap-1">
        <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
            <div class="display-flex-row justify-content-between align-items-center width-100"> 
                <div class="section-heading font-weight">Vehicle Dispatch Note</div>
            </div>

            <div class="display-flex-row align-items-center justify-content-evenly width-100">
                <div class="">
                    <?php echo '<img src="' . URL_ROOT . 'public/images/cars/'. $data['vehicle']->ModelName . ' ' . $data['vehicle']->Color .'.png" class="height-rem-15" alt="' . $data['vehicle']->ModelName . ' ' . $data['vehicle']->Color . '">'; ?>
                </div>
                <div class="display-flex-row gap-1">
                    <div>
                        <label class="text-blue description">VEHICLE DESCRIPTION</label>
                        <div class="display-flex-row gap-1 border-gray padding-4 width-rem-20 justify-content-evenly">
                            <div class="display-flex-column gap-1">
                                <div>
                                    <div class="text-darkblue font-weight font-size-14">MODEL</div>
                                    <div class="detail"><?php echo $data['vehicle']->ModelName; ?></div>
                                </div>
                                <div>
                                    <div class="text-darkblue font-weight font-size-14">COLOR</div>
                                    <div class="detail"><?php echo $data['vehicle']->Color; ?></div>
                                </div>
                                <div>
                                    <div class="text-darkblue font-weight font-size-14">CHASSIS NO</div>
                                    <div class="detail" id="chassisNo"><?php echo $data['vehicle']->ChassisNo; ?></div>
                                </div>
                            </div>
                            <div class="display-flex-column gap-1">
                                <div>
                                    <div class="text-darkblue font-weight font-size-14">ARRIVAL DATE</div>
                                    <div class="detail"><?php echo $data['vehicle']->ArrivalDate; ?></div>
                                </div>
                                <div>
                                    <div class="text-darkblue font-weight font-size-14">RELEASE DATE</div>
                                    <div class="detail"><?php echo $data['vehicle']->ReleaseDate; ?></div>
                                </div>
                                <div>
                                    <div class="text-darkblue font-weight font-size-14">SHOWROOM</div>
                                    <div class="detail"><?php echo $data['vehicle']->ShowRoomName; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="font-size-20 font-weight marginy-0 padding-3 background-white border-bottom-green"> Repairs </div>
            </div>

            <div class="display-flex-row align-items-center gap-2 justify-content-center  width-100">     
                <table class="table">
                    <thead>
                        <tr class="tr">
                            <th class="th width-25">REPAIR ID</th>
                            <th class="th width-25">REPAIR DESCRIPTION</th>
                            <th class="th width-25">REQUEST DATE</th>
                            <th class="th width-25">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if ($data['repairDetails'] == null) {
                            echo '<tr class="tr">
                                    <td colspan="4" class="text-center">No Repairs</td>
                                </tr>';
                        } else {
                            foreach ($data['repairDetails'] as $value) {
                                if ($value->Status === "NC") {
                                    $status = "Not Completed";
                                }  else {
                                    $status = "Completed";
                                }
                                echo '<tr class="tr">
                                        <td class="td width-25">'.$value->RepairId.'</td>
                                        <td class="td width-25">'.$value->RepairDescription.'</td>
                                        <td class="td width-25">'.$value->RequestDate.'</td>
                                        <td class="td width-25">'.$status.'</td>
                                    </tr>';
                            }
                        }
                    ?>
                        
                    </tbody>
                </table>
            </div>
            
            <div>
                <div class="font-size-20 font-weight marginy-0 padding-3 background-white border-bottom-green"> Paint Work </div>
            </div>

            <div class="display-flex-row align-items-center gap-2 justify-content-center  width-100">     
                <table class="table">
                    <thead>
                        <tr class="tr">
                            <th class="th">PAINT ID</th>
                            <th class="th">REQUEST DATE</th>
                            <th class="th">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if ($data['paintDetails'] == null) {
                            echo '<tr class="tr">
                                    <td colspan="3" class="text-center">No Paint Work</td>
                                </tr>';
                        } else {
                            foreach ($data['paintDetails'] as $value) {
                                if ($value->Status === "NC") {
                                    $status = "Not Completed";
                                }  else {
                                    $status = "Completed";
                                }
                                echo '<tr class="tr">
                                        <td class="td">'.$value->PaintId.'</td>
                                        <td class="td">'.$value->RequestDate.'</td>
                                        <td class="td">'.$status.'</td>
                                    </tr>';
                            }
                        }
                    ?>
                        
                    </tbody>
                </table>
            </div>

            <div>
                <div class="font-size-20 font-weight marginy-0 padding-3 background-white border-bottom-green"> Pre-Delivery Inspection </div>
            </div>

            <div class="display-flex-row align-items-center gap-2 justify-content-center  width-100">     
                <table class="table">
                    <thead>
                        <tr class="tr">
                            <th class="th width-20">DEFECT #</th>
                            <th class="th width-20">DEFECT DESCRIPTION</th>
                            <th class="th width-20">INSPECTION DATE</th>
                            <th class="th width-20">TESTER</th>
                            <th class="th width-20">RECORRECTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if ($data['defects'] == null) {
                            echo '<tr class="tr">
                                    <td colspan="5" class="text-center">No Defects</td>
                                </tr>';
                        } else {
                            foreach ($data['defects'] as $value) {
                                echo '<tr class="tr">
                                        <td class="td width-20">'.$value->DefectNo.'</td>
                                        <td class="td width-20">'.$value->RepairDescription.'</td>
                                        <td class="td width-20">'.$value->InspectionDate.'</td>
                                        <td class="td width-20">'.$value->EmployeeName.'</td>
                                        <td class="td width-20">'.$value->ReCorrection.'</td>
                                    </tr>';
                            }
                        }
                    ?>
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
</section>

<section class="display-flex-column">

    <div id="alert" class="hideme" role="alert"></div>

</section>

<script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/dispatch.js"></script>