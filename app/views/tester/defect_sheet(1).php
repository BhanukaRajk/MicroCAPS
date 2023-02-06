<?php require_once APP_ROOT . '\views\includes_r\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/main.js"></script>

<style>
    body {
        background: #D2DAFF;
    }
    .head1{
        font-size: 30px;
        font-weight: bold;
        color: #1B2B65;
        margin-bottom: 30px;
    }
</style>

    
<body>
    <div class="container1">
    <div class="head1">Defect Sheet</div>
    <table class="rwd-table">
    <tbody>
  <tr>
    <th>DefectNo</th>
    <th>DefectDescription</th>
    <th>Date</th>
    <th>Chassis</th>
    <th>EmployeeID</th>
    <th>Recorrection</th>

    <!-- <th colspan="2"> Edit/Delete </th> -->
  </tr>
  
<?php

$id = $_GET['ChassisNo'];

$connection = mysqli_connect('localhost', 'root', '', 'microcaps');
$records = mysqli_query($connection,"SELECT cardefect.DefectNo, 
                                            defects.DefectDescription, 
                                            cardefect.InspectionDate, 
                                            cardefect.ChassisNo,
                                            cardefect.EmployeeID, 
                                            cardefect.ReCorrection 
                                            FROM `cardefect` INNER JOIN `defects` 
                                            ON cardefect.DefectNo = defects.DefectNo 
                                            WHERE cardefect.ChassisNo = '$id';");

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['DefectNo']; ?></td>
    <td><?php echo $data['DefectDescription']; ?></td>
    <td><?php echo $data['InspectionDate']; ?></td>
    <td><?php echo $data['ChassisNo']; ?></td>  
    <td><?php echo $data['EmployeeID']; ?></td> 
    <td><?php echo $data['ReCorrection']; ?></td>   
   
    <!-- <td> <button class="edit"><a href="">Edit</a> </button></td>
    <td ><button class="delete"><a href="">Delete</a></button></td> -->
  </tr>	
<?php
}
?>

</tbody>
</table>
<br><br>

<!-- <button type="submit" class="btn btn-primary" onClick="location.href='<?php echo URL_ROOT; ?>testers/add_defect'">
        Add Defects
</button> -->
<button type="submit" class="btn btn-primary" onClick="location.href='<?php echo URL_ROOT; ?>testers/add_defect ? ChassisNo=<?php echo $id; ?>'">
        Add Defects
</button>
</div>




</body>
</html>