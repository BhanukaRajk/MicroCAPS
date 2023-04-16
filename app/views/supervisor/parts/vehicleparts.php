<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section>
    <div class="content">
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
                            <button class="full-list-btn blue-hover">Vehicle list</button>
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

                    <div class="parts-info-set-1">
                        <div class="filter-btn-box">
                            <button class="filter-btn">All: 22</button>
                        </div>
                        <div class="filter-btn-box">
                            <button class="filter-btn">Issued: 45</button>
                        </div>
                        <div class="filter-btn-box">
                            <button class="filter-btn">Pending: 10</button>
                        </div>
                        <div class="filter-btn-box">
                            <button class="filter-btn">Damaged: 2</button>
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

                            <div class="parts-table-row">
                                <div class="parts-col-01 ">Front bumper</div>
                                <div class="parts-col-02">DAMAGED</div>
                                <div class="parts-col-03">
                                    <div class="round">
                                        <input type="checkbox" id="dcheckbox1" />
                                        <label for="dcheckbox1"></label>
                                    </div>
                                </div>
                                <div class="parts-col-04">
                                    <div class="round">
                                        <input type="checkbox" id="icheckbox1" />
                                        <label for="icheckbox1"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-border"></div>

                            <div class="parts-table-row">
                                <div class="parts-col-01 ">Seat belts</div>
                                <div class="parts-col-02">ISSUED</div>
                                <div class="parts-col-03">
                                    <div class="round">
                                        <input type="checkbox" id="dcheckbox2" />
                                        <label for="dcheckbox2"></label>
                                    </div>
                                </div>
                                <div class="parts-col-04">
                                    <div class="round">
                                        <input type="checkbox" id="icheckbox2" />
                                        <label for="icheckbox2"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-border"></div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>



<!-- ADD COMMON FOOTER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>