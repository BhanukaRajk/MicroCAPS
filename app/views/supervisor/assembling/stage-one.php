<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<!-- GET DATA FROM CONTROLLER -->
<?php //$testing_car = $data['FormCarData']; ?>

<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="single-stage-margin">

            <div class="single-stage-head">
                <div class="heading">On Going Assembly - <?php echo $data['chassisno']; ?></div>
                <div class="stage-switch">
                    <button>Overall</button>
                </div>
            </div>

            <div class="single-stage-body">

                <div class="single-stage-chart">
                    <div class="chart-heading">
                        <div>Stage 01</div>
                    </div>
                    <div class="chart-box">
                        <canvas id="myChart"></canvas>
                        <label class="chart-percentage" for="myChart">60%</label>
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

                    <?php
                    foreach ($data['FormCarData'] as $process) {
                        echo '<div class=""></div>
                            <div class="">
                                <div class="">' . $process->ProcessName . '</div>
                                <div class="">' . $process->Status . '</div>


                                <form>
                                    <input type="radio" name="color" value="Connected">
                                    <input type="radio" name="color" value="Hold">
                                </form>
                                
                            </div>';
                    }

                    if ($process == NULL) {
                        echo '<div class="horizontal-centralizer no-leave-data">
                            <div class="vertical-centralizer">
                                <div>Nothing to show</div>
                            </div>
                        </div>';
                    }

                    ?>

                </div>

            </div>
        </div>
    </div>
</section>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>