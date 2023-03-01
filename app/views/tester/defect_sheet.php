<?php require_once APP_ROOT . '\views\tester\includes\header.php'; 
?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; 
?>

<link rel="stylesheet" href="defect_sheet.css">

<script type="text/javascript" src="<?php echo URL_ROOT;  ?>public/javascripts/testerjs/main.js"></script>

<section>
    <div class="ds-page">
        <div class="ds-board-2">
            <div class="ds-section">
                <div class="ds-main">
                    <div class="ds-page-heading-large">Defect Sheet</div>
                    <div class="ds-page-heading-small">Chassis No : <?php echo $data['pdiVehicle']->ChassisNo ?></div>
                    <div class="ds-page-heading-small">Engine : <?php echo $data['pdiVehicle']->EngineNo ?></div>
                </div>
                <div class="ds-section-2">
                    <div class="ds-data-board">
                        <div class="ds-container">
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
                                        <td><button class='ds-edit-button' onClick="location.href='<?php echo URL_ROOT; ?>testers/edit_defect/<?php echo $values->ChassisNo; ?>/<?php echo $values->DefectNo; ?>'">Edit</button></td>
                                        <td><button class='ds-delete-button' onClick="location.href='<?php echo URL_ROOT; ?>testers/delete_defect/<?php echo $values->ChassisNo; ?>/<?php echo $values->DefectNo; ?>'">Delete</button></td>
                                    </tr>

                                    <?php endforeach; ?>
                                    <?php } ?>
                                    
                                </tbody>
                            </table>
                            <div>
                                <button class="ds-button" onClick="location.href='<?php echo URL_ROOT; ?>testers/add_defect/<?php echo $data['id']; ?>'">Add Defect</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>