<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section class="content">
    <div class="stage-progress-margin">

        <div class="stage-progress-head">
            <div class="heading">On Going Assembly - CH065BD3X00</div>
            <div class="stage-changer">
                <button>Overall</button>
            </div>
        </div>

        <div class="stage-progress-body">

            <div class="main-chart">
                <div class="chart-heading horizontal-centralizer">
                    <div>Stage 03</div>
                </div>
                <div class="chart-box horizontal-centralizer">
                    <div>
                        <canvas id="myChart"></canvas>
                        <label class="chart-percentage" for="myChart">60%</label>
                    </div>
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

            <div class="stage-charts">

                <div class="chart1">
                    <div class="small-chart-heading">
                        <div>Stage 01</div>
                    </div>
                    <div class="chart-box-small">
                        <canvas id="stage01"></canvas>
                        <label class="chart-percentage" for="stage01">60%</label>
                    </div>
                </div>

                <div class="chart2">
                    <div class="small-chart-heading">
                        <div>Stage 02</div>
                    </div>
                    <div class="chart-box-small">
                        <canvas id="stage02"></canvas>
                        <label class="chart-percentage" for="stage02">60%</label>
                    </div>
                </div>

                <div class="chart3">
                    <div class="small-chart-heading">
                        <div>Stage 03</div>
                    </div>
                    <div class="chart-box-small">
                        <canvas id="stage03"></canvas>
                        <label class="chart-percentage" for="stage03">60%</label>
                    </div>
                </div>

                <div class="chart4">
                    <div class="small-chart-heading">
                        <div>Stage 04</div>
                    </div>
                    <div class="chart-box-small">
                        <canvas id="stage04"></canvas>
                        <label class="chart-percentage" for="stage04">60%</label>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>