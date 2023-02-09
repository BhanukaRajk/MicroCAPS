<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>


<body>
  <div class="container1">
    <div class="head_1">Defect Sheet</div>
    <div class="head_2">Chassis Number : <?php echo $data['defects'][1]->ChassisNo; ?></div>
    <table class="rwd-table">
      <tbody>
        <tr>
          <th>DefectNo</th>
          <th>DefectDescription</th>
          <th>Date</th>
          <!-- <th>Chassis</th> -->
          <th>EmployeeID</th>
          <th>Recorrection</th>
          <th colspan="2">Edit / Delete</th>
        </tr>


        <?php foreach ($data['defects'] as $values) : ?>

          <tr>
            <td><?php echo $values->DefectNo; ?></td>
            <td><?php echo $values->RepairDescription; ?></td>
            <td><?php echo $values->InspectionDate; ?></td>
            <!-- <td><?php //echo $values->ChassisNo; ?></td> -->
            <td><?php echo $values->EmployeeID; ?></td>
            <td><?php echo $values->ReCorrection; ?></td>
            <td><button style='text-decoration: none' class='edit-button' onClick="location.href='<?php echo URL_ROOT; ?>testers/edit_defect/<?php echo $values->ChassisNo; ?>/<?php echo $values->DefectNo; ?>'">Edit</a> </button></td>
            <td><button style='text-decoration: none' class='delete-button' onClick="location.href='<?php echo URL_ROOT; ?>testers/delete_defect/<?php echo $values->ChassisNo; ?>/<?php echo $values->DefectNo; ?>'">Delete</button></td>
          </tr>

        <?php endforeach; ?>


      </tbody>
    </table>
    <br><br>

    <button type="submit" class="btn btn-primary" onClick="location.href='<?php echo URL_ROOT; ?>testers/add_defect/<?php echo $values->ChassisNo; ?>'">
      Add Defects
    </button>
  </div>




</body>

</html>