<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<!-- GET DATA FROM CONTROLLER -->
<?php //$testing_car = $data['chassisno']; ?>

<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="single-stage-margin">

            <div class="single-stage-head">
                <div class="heading">On Going Assembly - <?php echo $data['chassisNo']; ?></div>
                <div class="stage-switch">
                    <button class="back-button">Overall</button>
                </div>
            </div>

            <div class="single-stage-body">

                <div class="single-stage-chart">
                    <div class="chart-heading">
                        <div>Stage 01</div>
                    </div>
                    <div class="chart-box">
                        <canvas id="myChart" class="SX-bigChart"></canvas>
                        <label class="chart-percentage SX-bigstate" for="myChart">60%</label>
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
                            <?php
                            foreach ($data['FormCarData'] as $process) {
                                echo '
                                <div class="stage-control-row pagination-item">
                                    <div class="row-data">' . $process->ProcessName . '</div>
                                    <div class="row-data display-none">' . $process->Status . '</div>
                                    <form>
                                        <div class="row-data">
                                            <div><input type="checkbox" id="connectivity-cb" name="connectivity" value="Connected"></div>
                                            <div><input type="checkbox" id="holding-cb" name="holding" value="Hold"></div>
                                        </div>
                                    </form>
                                </div>';
                            }
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

                    <div class="page-button-set">
                        <button onclick="showPage(1)">1</button>
                        <button onclick="showPage(2)">2</button>
                        <button onclick="showPage(3)">3</button>
                        <button onclick="showPage(4)">4</button>
                    </div>
                        

                </div>

            </div>
        </div>
    </div>
</section>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>