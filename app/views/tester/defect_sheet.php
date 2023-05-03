<?php require_once APP_ROOT . '\views\tester\includes\header.php'; 
?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; 
?>

<section>
    <div class="ds-page">
        <div class="ds-board-2">
            <div class="ds-section">
                <div class="ds-section-2">
                    <div class="ds-data-board">
                        <div class="ds-container">
                        <div class="column align-items-center border-gray padding-5 justify-content-center margin-bottom-4">
                            <div class="page-heading font-weight  margin-bottom-4">
                                Defect Sheet
                            </div>
                            <table class="ds-table">
                                <tbody>
                                    <tr>
                                        <th>Defect No.</th>
                                        <th>Defect Description</th>
                                        <th>Inspection Date</th>
                                        <th>Employee ID</th>
                                        <th>Recorrection</th>
                                        <th colspan="2">Edit / Delete</th>
                                    </tr>

                                    <?php 
                                        if (empty($data['defects'])) {
                                            echo "<tr><td colspan='7'>No Defects Found</td></tr>";
                                        } else {
                                            foreach ($data['defects'] as $values) :
                                    ?>

                                    <tr>
                                        <td><?php echo $values->DefectNo; ?></td>
                                        <td><?php echo $values->RepairDescription; ?></td>
                                        <td><?php echo $values->InspectionDate; ?></td>
                                        <td><?php echo $values->EmployeeID; ?></td>
                                        <td><?php echo $values->ReCorrection; ?></td>
                                        <td><i class="fa-solid fa-pen-to-square edit" onclick="location.href='<?php echo URL_ROOT; ?>testers/edit_defect/<?php echo $values->ChassisNo; ?>/<?php echo $values->DefectNo; ?>'"></i></td>
                                        <td><i class="fa-solid fa-trash-can delete" onclick="deleteDefect('<?php echo $values->ChassisNo; ?>', '<?php echo $values->DefectNo; ?>')"></i></td>
                                    </tr>

                                    <?php endforeach; ?>
                                    <?php } ?>
                                    
                                </tbody>
                            </table>
                            <div>
                                <!-- <button class="btn btn-primary margin-top-4" onClick="location.href='<?php //echo URL_ROOT; ?>testers/add_defect/<?php //echo $data['id']; ?>'">Add Defect</button> -->
                                <button id="view-defect" class="btn btn-primary margin-top-4">Add Defect</button>
                            </div>

                            <div class="text-center text-blue font-size margin-top-3 pointer" onclick="history.back()">
                                <i class="icon fa-angle-left"></i> Back
                            </div>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<div class="overlay display-flex-row align-items-center justify-content-center" id="overlay">
    <section id="pop-con">
    <div class="row align-items-center border-gray padding-4  width-rem-25 justify-content-center">

        <div class="text-center">
            <h3 class="margin-top-1">Add Defect</h3>
        </div>

        <!-- <form action="<?php //echo URL_ROOT; ?>testers/add_defect" method="POST"> -->
        <form>

        <div>
                <input type="text"
                    id="ChassisNo"
                    name="ChassisNo"
                    onChange=""
                    value="<?php echo $data['pdiVehicle']->ChassisNo ?>"
                    class="form-control"
                    placeholder="Chassis Number"
                    autocomplete="off"
                    required />
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
                    required />
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
                    value="<?php echo $_SESSION['_id']; ?>"
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
                <button class="btn btn-primary" type="submit" id="" onclick="addDefect()">
                    Add Defect
                </button>
            </div>

            <div class="text-center text-blue font-size margin-top-3 pointer" id="cancel">Cancel</div>

        </form>
        </div>
    </section>
</div>

<section class="display-flex-column">

    <div id="alert" class="hideme" role="alert"></div>

</section>

<script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/cors.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/pdi.js"></script>