<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/main.js"></script>

  
  <body id="add-form-body">
    <div class="add-form-container">
      <div class="add-form-title">Add Defect Form</div>
      
      <form id="defect-form" action="<?php echo URL_ROOT; ?>testers/add_defect" method="POST">
        <div class="add-form-field">
          <input type="text"
                    name="ChassisNo"
                    value="<?php echo $data['ChassisNo']; ?>"
                    id="ChassisNo"
                    placeholder="Chassis Number" 
                    class="add-form-input"
                    required />
        </div>
        
        <div class="add-form-field">
        <span class="add-form-error">
            <?php 
              echo !empty($data['defect_id_err']) ? $data['defect_id_err'] : '';
              echo !empty($data['defect_err']) ? $data['defect_err'] : '';
            ?>
          </span>
          <input type="text" 
                    id="DefectNo" 
                    name="DefectNo" 
                    value="<?php echo $data['DefectNo']; ?>"
                    placeholder="Defect Number" 
                    class="add-form-input"
                    required autofocus/>
        </div>

        <div class="add-form-field">
          <label class="add-form-label" for="date">Inspection Date:</label>
          <input type="date" 
                    id="InspectionDate" 
                    name="InspectionDate"
                    value="<?php echo $data['InspectionDate']; ?>"
                    class="add-form-input"
                    required />
        </div>

        <div class="add-form-field">
          <span class="add-form-error">
            <?php 
              echo !empty($data['user_err']) ? $data['user_err'] : '';
            ?>
          </span>
          <input type="text" 
                    id="EmployeeID" 
                    name="EmployeeID" 
                    value="<?php echo $_SESSION['_id']; ?>"
                    placeholder="Employee ID"
                    class="add-form-input"
                    required />
        </div>

        <div class="add-form-field">
          <input type="text" 
                    id="RepairDescription" 
                    name="RepairDescription"
                    value="<?php //echo $data['RepairDescription']; ?>" 
                    placeholder="Repair Description"
                    class="add-form-input"/>
        </div>

        <div class="add-form-field">
          <input type="text" 
                    id="ReCorrection" 
                    name="ReCorrection" 
                    value="<?php echo $data['ReCorrection']; ?>"
                    placeholder="Recorrection"
                    class="add-form-input"/>
        </div>

        <div class="add-form-field">
          <button name="submit" type="submit" class="add-form-update-button">Add Defect</button>
        </div>

      </form>
    </div>
  </body>