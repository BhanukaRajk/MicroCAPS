<?php require_once APP_ROOT . '\views\includes_r\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar_2.php'; ?>

<?php 

$id = $_GET['ChassisNo'];

?>

<?php 
  if(!empty($_SESSION['errors'])){
    $errors = $_SESSION['errors'];
  }
  $_SESSION["errors"] = "";
?>

<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/main.js"></script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box; border-radius: 7px;}
    </style>
</head>
<body id = "add_defect">
  <div class="container2">  
    <form id="defect" action="<?php echo URL_ROOT; ?>testers/add_defect2" method="POST">
      <h3>Add Defect Form</h3>
      <br/>
      <br/>
      <span color="red">
          <?php 
            echo isset($errors['primary']) ? $errors['primary'] : '';
          ?>
      </span>
      <fieldset>
        <input  placeholder="Defect Number"
                name="DefectNo"
                type="text" 
                tabindex="1" 
                required autofocus>
      </fieldset>
      <fieldset>
        <label for="InspectionDate" id="label_ins">Inspection Date</label>
        <input  placeholder="Inspection Date" 
                name="InspectionDate"
                id="InspectionDate"
                type="date" 
                tabindex="2" 
                required>
      </fieldset>
      <fieldset>
        <label for="ChassisNo" id="label_cha">Chassis Number</label>
        <input  placeholder="Chassis No." 
                name="ChassisNo"
                value="<?php echo $id; ?>"
                type="text" 
                tabindex="3" 
                required>
      </fieldset>
      <fieldset>
      <span color="red"><p color="red">
          <?php 
            echo isset($errors['exists']) ? $errors['exists'] : '';
          ?></p>
      </span>
        <label for="EmployeeID" id="label_cha">Employee ID</label>
        <input  placeholder="Employee ID" 
                name="EmployeeID"
                type="text" 
                tabindex="4" 
                value="<?php echo $_SESSION['_id']; ?>"
                required>
      </fieldset>
      <fieldset>
        <textarea   placeholder="Recorrection" 
                    name="ReCorrection"
                    tabindex="5" ></textarea>
      </fieldset>
      <fieldset>
        <button name="submit" type="submit" class="submit">Add Defect</button>
      </fieldset>
    </form>
  </div>
</body>
</html>
