<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<section class = "position-absolute page-content" >

<div class="display-flex-row align-items-center justify-content-center">
    <section>
        <div class="row align-items-center border-gray padding-4  width-rem-25 justify-content-center">

            <div class="text-center">
                <h3 class="margin-top-1">Edit Defect</h3>
            </div>

            <!-- <form action="<?php //echo URL_ROOT; ?>testers/edit_defect/<?php //echo $data['ChassisNo']; ?>/<?php //echo $data['DefectNo']; ?>" method="POST"> -->
            <form>

            <div>
                    <input type="text"
                        id="ChassisNo"
                        name="ChassisNo"
                        onChange=""
                        value="<?php echo $data['ChassisNo']; ?>"
                        class="form-control"
                        placeholder="Chassis Number"
                        autocomplete="off"
                        readonly />
                    <label class="form-label">Chassis Number</label>
                    <span></span>

                </div>

                <div>
                    <input type="text"
                        id="DefectNo"
                        name="DefectNo"
                        onChange=""
                        value="<?php echo $data['DefectNo']; ?>"
                        class="form-control"
                        placeholder="Defect Number"
                        autocomplete="off"
                        readonly />
                    <label class="form-label">Defect Number</label>
                    <span></span>

                </div>

                <div>
                    <input type="date"
                        id="InspectionDate"
                        name="InspectionDate"
                        onChange=""
                        value="<?php echo $data['InspectionDate']; ?>"
                        class="form-control"
                        placeholder="Inspection Date"
                        autocomplete="off"
                        required />
                    <label class="form-label">Inspection Date</label>
                    <span></span>

                </div>

                <div>
                    <input type="text"
                        id="EmployeeID"
                        name="EmployeeID"
                        onChange=""
                        value="<?php echo $data['EmployeeID']; ?>"
                        class="form-control"
                        placeholder="Employee ID"
                        autocomplete="off"
                        required />
                    <label class="form-label">Employee ID</label>
                    <span></span>

                </div>

                <div>
                    <input type="text"
                        id="RepairDescription"
                        name="RepairDescription"
                        onChange=""
                        value="<?php echo $data['RepairDescription']; ?>"
                        class="form-control"
                        placeholder="Repair Description"
                        autocomplete="off"
                        required />
                    <label class="form-label">Repair Description</label>
                    <span></span>

                </div>

                <div>
                    <input type="text"
                        id="ReCorrection"
                        name="ReCorrection"
                        onChange=""
                        value="<?php echo $data['ReCorrection']; ?>"
                        class="form-control"
                        placeholder="Recorrection"
                        autocomplete="off"
                        required />
                    <label class="form-label">Recorrection</label>
                    <span></span>

                </div>

                <div class="text-center margin-top-3">
                    <button class="btn btn-primary" type="submit" id="" onclick="editDefect('<?php echo $data['ChassisNo']; ?>', '<?php echo $data['DefectNo']; ?>')">
                        Update Defect
                    </button>
                </div>

                <div class="text-center text-blue font-size margin-top-3 pointer" id="cancel" onclick="history.back()">Cancel</div>

            </form>
        </div>
    </section>
</div>

<section class="display-flex-column">

    <div id="alert" class="hideme" role="alert"></div>

</section>

<script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/cors.js"></script>