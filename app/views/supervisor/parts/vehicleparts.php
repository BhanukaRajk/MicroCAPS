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
                            <div class="parts-title">Part details - CN112218766A</div>
                        </div>

                        <div class="vertical-centralizer">

                        </div>

                        <div class="vehicle-selection-box horizontal-centralizer">
                            <div class="vertical-centralizer">
                                <a href="<?php echo URL_ROOT; ?>Supervisors/viewCarComponent" class="full-list-btn blue-hover">Vehicle list</a>
                            </div>
                            <div>
                                <label for="vehicles" class="display-none">Select Vehicle</label>
                                <select name="vehicles" id="vehicles" class="vehicle-selection">
                                    <option class="bh" disabled selected value>- Select vehicle -</option>
                                    <option value="CN1294B0934">CN1294B0934</option>
                                    <option value="CN1294G0836">CN1294G0836</option>
                                    <option value="CN1294L9302">CN1294L9302</option>
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
                                <input class="page-filter-btn" id="[art]-search" placeholder="Search a part">
                            </div>
                        </div>



                        <div class="parts-info-set-2">

                            <div class="parts-table">
                                <div class="parts-table-row">
                                    <div class="parts-col-01 parts-bold">PART NAME</div>
                                    <div class="parts-col-02 parts-bold">STATUS</div>
                                    <div class="parts-col-03 parts-bold">DAMAGES</div>
                                    <div class="parts-col-04 parts-bold">ISSUED</div>
                                </div>
                                <div class="bottom-border"></div>

                                <?php foreach ($data['components'] AS $component) {
                                    echo '<div class="parts-table-row">
                                            <div class="parts-col-01 ">'. $component->PartName .'</div>
                                            <div class="parts-col-02">'. $component->CurrentStatus .'</div>
                                            <div class="parts-col-03">
                                                <div class="round">
                                                    <input type="checkbox" id="'. $component->PartNo .'D" '. (($component->CurrentStatus == "DAMAGED") ? 'checked' : '' ) .' />
                                                    <label for="'. $component->PartNo .'D"></label>
                                                </div>
                                            </div>
                                            <div class="parts-col-04">
                                                <div class="round">
                                                    <input type="checkbox" id="'. $component->PartNo .'I" '. (($component->CurrentStatus == "ISSUED") ? 'checked' : '' ) .' />
                                                    <label for="'. $component->PartNo .'I"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bottom-border"></div>';
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


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>