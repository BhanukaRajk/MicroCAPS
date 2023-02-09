<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>

<body id="grid-body">
  <!-- <div class="grid-container">
    <?php //foreach ($data['pdi_tests'] as $values) : 
    ?>
      <?php //if ($values->categoryid == '01000') { 
      ?>
          <div class="grid-item-1">
            <div class="padding-left-form"><?php //echo $values->CheckName; 
                                            ?></div>
          </div>
          <div class="grid-item-2 grid-center">
            <input type="radio" name="pdi" value="OK" class="round-checkbox">
            <input type="radio" name="pdi" value="SA" class="round-checkbox">
          </div>
      <?php //} 
      ?>
    <?php //endforeach; 
    ?>
  </div> -->
  <div class="grid-container">
    <div class="grid-item-1"></div>
    <div class="grid-item-2 grid-center">
      <span class="grid-item-caption">OK</span>
      <span class="grid-item-caption">S/A</span>
    </div>
    <?php foreach ($data['pdi_tests'] as $values) : ?>
      <?php 
      if ($values->categoryid == '01000') { 
      ?>
      <div class="grid-item-1">
        <div class="padding-left-form"><?php echo $values->CheckName; ?></div>
      </div>
      <div class="grid-item-2 grid-center">
        <input type="radio" name="<?php echo $values->CheckId; ?>" 
                  value="OK" 
                  class="round-checkbox" 
                  onChange="addPDI('<?php echo $values->ChassisNo; ?>','<?php echo $values->CheckId; ?>','OK','<?php echo $values->EmployeeID; ?>')"
                  <?php echo $values->Status == 'OK' ? "checked" : ''; ?>>
        <input type="radio" 
                  name="<?php echo $values->CheckId; ?>" 
                  value="SA" 
                  class="round-checkbox" 
                  onChange="addPDI('<?php echo $values->ChassisNo; ?>','<?php echo $values->CheckId; ?>','SA','<?php echo $values->EmployeeID; ?>')"
                  <?php echo $values->Status == 'SA' ? "checked" : ''; ?>>
      </div>
      <?php 
      } 
      ?>
    <?php endforeach; ?>
  </div>
</body>

</html>