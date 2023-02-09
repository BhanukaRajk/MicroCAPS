<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>

<section>
    <div class="form-page">
        <div class="form-board-2">
            <div class="form-section">
                <div class="form-main">
                    <div class="form-page-heading"></div>
                </div>
                <div class="form-section-2">
                    <div class="sv-data-board">
                        <div class="box_sv-3">
                            <div class="btn_sv btn_sv-three" onClick="location.href='<?php echo URL_ROOT; ?>testers/defect_sheet/<?php echo $data['ChassisNo']; ?>'">
                                <span>Defect Sheet</span>
                            </div>
                        </div>
                        <div class="box_sv-3">
                            <div class="btn_sv btn_sv-three" onClick="location.href='<?php echo URL_ROOT; ?>testers/pdi/<?php echo $data['ChassisNo'] ?>'">
                                <span>Edit PDI List</span>
                            </div>
                        </div>
                        <div class="box_sv-3">
                            <div class="btn_sv btn_sv-three" onClick="location.href='<?php echo URL_ROOT; ?>testers/pdi_results/<?php echo $data['ChassisNo'] ?>'">
                                <span>PDI Results</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>