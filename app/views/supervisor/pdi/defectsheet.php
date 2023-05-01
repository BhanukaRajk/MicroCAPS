<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="ds-view-inner">

            <div class="ds-top-section">
                <div class="ds-top-section-breaker">
                    <div class="ds-title">Defect sheet of CB876216374R</div>
                    <div class="ds-back-button-box">
                        <button type="button" class="ds-back-button">Go back</button>
                    </div>
                </div>
            </div>

            <div class="ds-info-box">
                <div class="ds-info-box-inner">

                    <div class="ds-info-set-1">
                        <div class="ds-info-top">
                            <div class="ds-heading">Return defect sheet info</div>
                            <div class="vertical-centralizer">
                                <div class="ds-inspector"><b>Checked by:</b> Gayan Grero</div>
                            </div>
                        </div>

                        <div class="ds-vehicle-data">
                            <div class="ds-data-field">
                                <div><b>Chassis No:</b> CR345298D4</div>
                                <div><b>Make:</b> Micro</div>
                                <div><b>Model:</b> SUV</div>
                            </div>

                            <div class="ds-data-field">
                                <div><b>Inspect date:</b> 2022/12/29</div>
                                <div><b>Colour Exterior:</b> Ruby Red</div>
                                <div><b>Odometer:</b> 000010 KM</div>
                            </div>
                        </div>
                    </div>



                    <div class="ds-info-set-2">

                        <div class="ds-table">
                            <div class="ds-table-row">
                                <div class="ds-col-01 ds-bold">NO</div>
                                <div class="ds-col-02 ds-bold">DEFECT DESCRIPTION</div>
                                <div class="ds-col-03 ds-bold">SECTION</div>
                                <div class="ds-col-04 ds-bold">EPF</div>
                                <div class="ds-col-05 ds-bold">RE-CORRECTION</div>
                            </div>

                            <div class="ds-table-row">
                                <div class="ds-col-01 ds-bold">01</div>
                                <div class="ds-col-02">Adjust front main lamps</div>
                                <div class="ds-col-03">Stage 01</div>
                                <div class="ds-col-04">EMP1968</div>
                                <div class="ds-col-05 horizontal-centralizer">
                                    <div class="round">
                                        <input type="checkbox" id="checkbox1" />
                                        <label for="checkbox1"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="top-border"></div>

                            <div class="ds-table-row">
                                <div class="ds-col-01 ds-bold">02</div>
                                <div class="ds-col-02">Seat belts are very tight</div>
                                <div class="ds-col-03">Stage 01</div>
                                <div class="ds-col-04">EMP1968</div>
                                <div class="ds-col-05 horizontal-centralizer">
                                    <div class="round">
                                        <input type="checkbox" id="checkbox2" />
                                        <label for="checkbox2"></label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>