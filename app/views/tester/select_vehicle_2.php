<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/testerjs/main.js"></script>
    
<body id="select_vehicle">
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <div class="head_sv">Select Vehicle</div>



  <?php foreach($data['vehicles'] as $values) : ?>

    <div class="box_sv-3">
      <div class="btn_sv btn_sv-three" onClick="location.href='<?php echo URL_ROOT; ?>testers/record_pdi/<?php echo $values->ChassisNo; ?>'">
        <span><?php echo $values->ChassisNo; ?></span>
      </div>
    </div>

  <?php endforeach; ?>





</body>
</html>