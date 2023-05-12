<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>



<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="single-stage-margin">

            <div class="single-stage-head">
                <!-- GET DATA FROM CONTROLLER AND FILLING THE HEADING-->
                <div class="heading">On Going Assembly - <?php echo $data['chassisNo']; ?></div>
                <div class="display-none"><?php echo $data['chassisNo']; ?></div>
                <div class="stage-switch">
                    <!-- BUTTON TO JUMP TO THE OVERALL PROGRESS -->
                    <button class="back-button">Overall</button>
                </div>
            </div>

            <div class="single-stage-body">

                <div class="single-stage-chart">
                    <div class="chart-heading">
                        <div>Stage 02</div>
                    </div>
                    <div class="chart-box">
                        <canvas id="myChart" class="SX-bigChart"></canvas>
                        <label class="chart-percentage SX-bigstate" for="myChart">100%</label>
                    </div>
                    <div class="chart-legend">
                        <div class="dash-graph-menu">
                            <div class="dash-graph-color-circle dash-darkblue-circle test1"></div>
                            <div>Done</div>
                        </div>
                        <div class="dash-graph-menu">
                            <div class="dash-graph-color-circle dash-lightblue-circle test1"></div>
                            <div>On-going</div>
                        </div>
                    </div>
                </div>

                <!-- THIS IS THE AREA FOR CONTROL BUTTONS AND THE LIST OF ASSEMBLY COMPONENTS-->
                <div class="stage-controls">
                    <div class="stage-control-rowset">
                        <div class="stage-control-rowset-heading">
                            <div class="option1">Connected</div>
                            <div class="option2">Hold</div>
                        </div>

                        <div id="pagination-container">

                            <!-- DISPLAY THE PROCESSES OF THIS STAGE ONE BY ONE WITH COMPLETENESS AND HOLDING OPTIONS -->
                            <?php
                            foreach ($data['FormCarData'] as $process) {
                                echo '
                                <div class="stage-control-row pagination-item">
                                    <div class="row-data">' . $process->ProcessName . '</div>
                                    <div class="row-data display-none">' . $process->Status . '</div>
                                    <form>
                                        <div class="row-data">

                                            <!-- IF THERE IS SOME PART RELATED TO THE PARTICULAR PROCESS IS DAMAGED,
                                            THAT PROCESS WILL BE AUTOMATICALLY HOLDS AND CANNOT CHANGED UNTIL REQUIRED PART IS RECEIVED -->

                                            <div><input type="checkbox" id="'. $process->ProcessId .'-con" name="'. $process->ProcessId .'-con" class="connected-btn" value="Connected"></div>
                                            <div><input type="checkbox" id="'. $process->ProcessId .'-hold" name="'. $process->ProcessId .'-hold" class="holding-btn" value="Hold"></div>
                                        </div>
                                    </form>
                                </div>';
                            }

                            // WHEN THERE IS NO DATA TO SHOW, THAT MEANS THIS CAR IS NOT READY FOR THIS STAGE
                            if ($process == NULL) {
                                echo '<div class="horizontal-centralizer no-leave-data">
                                <div class="vertical-centralizer">
                                <div>- Not Ready for this stage -</div>
                                </div>
                                </div>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- SET OF BUTTONS USED TO NAVIGATE BETWEEN PROCESS SETS -->
                    <div class="page-button-set">
                        <button onclick="showPage(1)" class="paginate">1</button>
                        <button onclick="showPage(2)" class="paginate">2</button>
                        <button onclick="showPage(3)" class="paginate">3</button>
                        <button onclick="showPage(4)" class="paginate">4</button>
                    </div>
                        

                </div>

            </div>
        </div>
    </div>
</section>

<script src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/staging.js"></script>

<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>