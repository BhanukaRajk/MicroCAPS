<?php require_once APP_ROOT . '\views\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar_2.php'; ?>

<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/main.js"></script>

<style>
     * {margin: 0; padding: 0; box-sizing: border-box; border-radius: 7px;}
</style>

<body id = "add_defect">
  <div class="container2">  
    <form id="defect" action="<?php echo URL_ROOT; ?>testers/edit_defect/<?php echo $data['ChassisNo']; ?>/<?php echo $data['DefectNo']; ?>" method="POST">
      <h3>Edit Defect Form</h3>
      <br/>
      <br/>
      <span style="color:#F32424">
          <?php 
            echo !empty($data['defect_id_err']) ? $data['defect_id_err'] : '';
          ?>
      </span>
      <span style="color:#F32424">
          <?php 
            echo !empty($data['defect_err']) ? $data['defect_err'] : '';
          ?>
      </span>
      <fieldset>
        <input  placeholder="Defect Number"
                name="DefectNo"
                value="<?php echo $data['DefectNo']; ?>"
                type="text" 
                tabindex="1" 
                required autofocus>
      </fieldset>
      <fieldset>
        <label for="InspectionDate" id="label_ins">Inspection Date</label>
        <input  placeholder="Inspection Date" 
                name="InspectionDate"
                value="<?php echo $data['InspectionDate']; ?>"
                id="InspectionDate"
                type="date" 
                tabindex="2" 
                required>
      </fieldset>
      <fieldset>
        <label for="ChassisNo" id="label_cha">Chassis Number</label>
        <input  placeholder="Chassis No." 
                name="ChassisNo"
                value="<?php echo $data['ChassisNo']; ?>"
                type="text" 
                tabindex="3" 
                required>
      </fieldset>
      <fieldset>
      <span style="color:#F32424">
          <?php 
            echo !empty($data['user_err']) ? $data['user_err'] : '';
          ?>
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
                    value="<?php echo $data['ReCorrection']; ?>"
                    tabindex="5" ></textarea>
      </fieldset>
      <fieldset>
        <button name="submit" type="submit" class="submit">Edit Defect</button>
      </fieldset>
    </form>
  </div>
</body>
</html>
