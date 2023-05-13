<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="parts-view-margin">

                <div class="parts-top-section">
                    <div class="parts-top-section-breaker">

                        <div class="vertical-centralizer">
                            <div class="parts-title" id="partPageId">Part details - <?php echo $data['chassis_no']; ?></div>
                        </div>

                        <!-- <div class="vertical-centralizer"></div> -->

                        <div class="vehicle-selection-box horizontal-centralizer">
                            <div class="vertical-centralizer">
                                <button class="full-list-btn blue-hover" onclick="location.href = '<?php echo URL_ROOT; ?>Supervisors/viewCarComponent'">Vehicle list</button>
                            </div>
                            <div>
                                <label for="vehicles" class="display-none">Select Vehicle</label>
                                <select name="vehicles" id="P23_vehicle_list" class="vehicle-selection">
                                    <?php echo'<option value="'.$data['chassis_no'].'">'.$data['chassis_no'].'</option>';
                                        foreach ($data['car_selection'] AS $car_id) {
                                            if($car_id->ChassisNo != $data['chassis_no']) {
                                                echo '<option value="'.$car_id->ChassisNo.'">'.$car_id->ChassisNo.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="parts-info-box">
                    <div class="parts-info-box-inner">

                        <div onchange="filterStatus()" class="parts-info-set-1">
                            <div class="filter-btn-box">
                                <button class="page-filter-btn">All: 22</button>
                            </div>
                            <div class="filter-btn-box">
                                <button class="page-filter-btn">Issued: 45</button>
                            </div>
                            <div class="filter-btn-box">
                                <button class="page-filter-btn">Pending: 10</button>
                            </div>
                            <div class="filter-btn-box">
                                <button class="page-filter-btn">Damaged: 2</button>
                            </div>
                            <div class="filter-btn-box">
                                <label for="part-search"></label>
                                <input class="part-searchbox" id="searchBox" oninput="searchPart()" placeholder="Search a part">
                            </div>
                        </div>



                        <div class="parts-info-set-2">

                            <div class="parts-table" id="partsTable">
                                <div class="parts-table-row">
                                    <div class="parts-col-01 parts-bold">PART NAME</div>
                                    <div class="parts-col-02 parts-bold">STATUS</div>
                                    <div class="parts-col-03 parts-bold">DAMAGES</div>
                                    <div class="parts-col-04 parts-bold">ISSUED</div>
                                </div>
                                <div class="bottom-border"></div>

                                <?php foreach ($data['components'] AS $component) {
                                    echo '<div class="parts-table-row bottom-border">
                                            <div class="parts-col-01">'. $component->PartName .'</div>
                                            <div class="parts-col-02">'. $component->Status .'</div>
                                            <div class="parts-col-03">
                                                <div class="round">
                                                    <input type="checkbox" id="'. $component->PartNo .'-D" class="issue-check" '. (($component->Status == "DAMAGED") ? 'checked' : '' ) .' />
                                                    <label for="'. $component->PartNo .'D"></label>
                                                </div>
                                            </div>
                                            <div class="parts-col-04">
                                                <div class="round">
                                                    <input type="checkbox" id="'. $component->PartNo .'-I" class="damage-check" '. (($component->Status == "ISSUED") ? 'checked' : '' ) .' />
                                                    <label for="'. $component->PartNo .'I"></label>
                                                </div>
                                            </div>
                                        </div>';
                                }

                                if($component == NULL) {
                                    echo '<div class="horizontal-centralizer">
                                            <div class="marginy-4">No parts available</div>
                                            <div class=""></div>
                                        </div>
                                        <div class="bottom-border"></div>';
                                }
                                ?>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
    </div>
</section>

<script src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/components.js"></script>

<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>