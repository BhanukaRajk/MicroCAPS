<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<link rel="stylesheet" href="temp.css">

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>

<section>
    <div class="select-page">
        <div class="select-board-2">
            <div class="select-section">
                    <div class="select-data-board">
                        <div class="sp-detailed-content">
                            <div class="box">
                                <div class="btn-s select-btn" onClick="location.href='<?php echo URL_ROOT; ?>testers/defect_sheet/<?php echo $data['ChassisNo']; ?>'">
                                  <i class="fa-regular fa-clipboard"></i>
                                  <div class="btn-caption">View Defect Sheet</div>
                                </div>
                                <div class="btn-s select-btn" onClick="location.href='<?php echo URL_ROOT; ?>testers/pdi/<?php echo $data['ChassisNo'] ?>'">
                                  <i class="fa-regular fa-pen-to-square"></i>
                                  <div class="btn-caption">Edit PDI Check List</div>
                                </div>
                                <div class="btn-s select-btn" onClick="location.href='<?php echo URL_ROOT; ?>testers/pdi_results/<?php echo $data['ChassisNo'] ?>'">
                                  <i class="fa-regular fa-file"></i>
                                  <div class="btn-caption">View PDI results</div>
                                </div>
                              </div>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
</section>