<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section class="page-section">
    <div class="stage-content">

        <div class="stage-progress-head">
            <div class="stage-progress-heading">On Going Assembly - CH065BD3X00</div>
            <div class="stage-progress-head-changer">
                <button>Overall</button>
            </div>
        </div>

        <div class="stage-progress-body">

            <div class="stage-progress-chart">
                <div class="chart-heading">
                    <div>Stage 03</div>
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

            // THIS IS THE AREA FOR CONTROL BUTTONS AND THGE LIST OF ASSEMBLY COMPONENTS
            <div class="stage-progress-control"></div>

        </div>
    </div>
</section>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>