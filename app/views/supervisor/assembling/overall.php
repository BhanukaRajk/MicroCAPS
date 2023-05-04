<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<!--<section>-->
<!--    <!-- THIS IS THE CONTENT DISPLAYING AREA -->-->
<!--    <div class="content">-->
<!--        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->-->
<!--        <div class="stage-progress-margin">-->
<!---->
<!--            <div class="stage-progress-head">-->
<!--                <div class="heading">On Going Assembly - CH065BD3X00</div>-->
<!--                <div class="stage-changer">-->
<!--                    <label for="vehicle"></label>-->
<!--                    <select name="vehicle" id="vehicle">-->
<!--                        <option value="CH065BD3X00">CH065BD3X00</option>-->
<!--                        <option value="CH065BD3G98">CH065BD3G98</option>-->
<!--                        <option value="CH065B6YU32">CH065B6YU32</option>-->
<!--                        <option value="CH065B7YM00">CH065B7YM00</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="stage-progress-body">-->
<!---->
<!--                <div class="main-chart">-->
<!--                    <div class="chart-heading horizontal-centralizer">-->
<!--                        <div>Stage 03</div>-->
<!--                    </div>-->
<!--                    <div class="chart-box horizontal-centralizer">-->
<!--                        <div>-->
<!--                            <canvas id="myChart"></canvas>-->
<!--                            <label class="chart-percentage" for="myChart">60%</label>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="chart-legend">-->
<!--                        <div class="dash-graph-menu">-->
<!--                            <div class="dash-graph-color-circle dash-darkblue-circle test1"></div>-->
<!--                            <div>Done</div>-->
<!--                        </div>-->
<!--                        <div class="dash-graph-menu">-->
<!--                            <div class="dash-graph-color-circle dash-lightblue-circle test1"></div>-->
<!--                            <div>On-going</div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="stage-charts">-->
<!---->
<!--                    <div class="chart1">-->
<!--                        <div class="small-chart-heading">-->
<!--                            <div>Stage 01</div>-->
<!--                        </div>-->
<!--                        <div class="chart-box-small">-->
<!--                            <canvas id="stage01"></canvas>-->
<!--                            <label class="chart-percentage" for="stage01">60%</label>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="chart2">-->
<!--                        <div class="small-chart-heading">-->
<!--                            <div>Stage 02</div>-->
<!--                        </div>-->
<!--                        <div class="chart-box-small">-->
<!--                            <canvas id="stage02"></canvas>-->
<!--                            <label class="chart-percentage" for="stage02">60%</label>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="chart3">-->
<!--                        <div class="small-chart-heading">-->
<!--                            <div>Stage 03</div>-->
<!--                        </div>-->
<!--                        <div class="chart-box-small">-->
<!--                            <canvas id="stage03"></canvas>-->
<!--                            <label class="chart-percentage" for="stage03">60%</label>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="chart4">-->
<!--                        <div class="small-chart-heading">-->
<!--                            <div>Stage 04</div>-->
<!--                        </div>-->
<!--                        <div class="chart-box-small">-->
<!--                            <canvas id="stage04"></canvas>-->
<!--                            <label class="chart-percentage" for="stage04">60%</label>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->


<section class="position-absolute page-content">
    <div class="display-flex-row margin-bottom-4 align-items-center justify-content-between margin-right-5">
        <div class="page-heading font-weight">
            On Going Assembly
        </div>
        <div class="custom-select">
            <select name="vehicles" class="background-none" id="assemblyVehicles">
                <?php
                echo '<option value="' . URL_ROOT . 'managers/assembly/' . $data['ChassisNo'] .'">'.$data['ChassisNo'].'</option>';
                foreach($data['assemblyDetails'] as $value) {
                    if ($value->ChassisNo == $data['ChassisNo']) {
                        continue;
                    }
                    echo '<option value="' . URL_ROOT . 'managers/assembly/' . $value->ChassisNo . '">'.$value->ChassisNo.'</option>';
                }
                ?>
            </select>
        </div>
    </div>


    <div class="display-flex-row justify-content-around gap-2">
        <div class="display-flex-column align-items-center justify-content-center border-radius-1 background-white paddingy-5 paddingx-7 gap-1">
            <div class="section-heading font-weight"> Overall Progress </div>
            <div class="chart-grid">
                <canvas id="assemblyOverall"></canvas>
                <label class="chart-percentage-ao " for="assemblyOverall" id="assemblyOverall-label"></label>
            </div>
            <div class="display-flex-row justify-content-center gap-0p5">
                <div class="display-flex-row justify-content-center align-items-center border-gray border-radius-0p5 padding-2 font-size">
                    <div class="dash-graph-color-circle dash-darkblue-circle "></div>
                    <div>Completed</div>
                </div>
                <div class="display-flex-row justify-content-center align-items-center border-gray border-radius-0p5 padding-2 font-size">
                    <div class="dash-graph-color-circle dash-lightblue-circle "></div>
                    <div>Pending</div>
                </div>
            </div>
        </div>
        <div class="row background-none gap-2">
            <a href="<?php echo URL_ROOT; ?>managers/assembly/<?php echo $data['ChassisNo']; ?>/stageone">
                <div class="display-flex-column align-items-center border-radius-1 background-white padding-4 gap-1">
                    <div class="section-heading font-weight"> Stage 01 </div>
                    <div class="chart-grid-stage">
                        <canvas id="stage01"></canvas>
                        <label class="chart-percentage-stage" for="stage01" id="stage01-label"></label>
                    </div>
                </div>
            </a>
            <a href="<?php echo URL_ROOT; ?>managers/assembly/<?php echo $data['ChassisNo']; ?>/stagetwo">
                <div class="display-flex-column align-items-center border-radius-1 background-white padding-4 gap-1">
                    <div class="section-heading font-weight"> Stage 02 </div>
                    <div class="chart-grid-stage">
                        <canvas id="stage02"></canvas>
                        <label class="chart-percentage-stage" for="stage02" id="stage02-label"></label>
                    </div>
                </div>
            </a>
            <a href="<?php echo URL_ROOT; ?>managers/assembly/<?php echo $data['ChassisNo']; ?>/stagethree">
                <div class="display-flex-column align-items-center border-radius-1 background-white padding-4 gap-1">
                    <div class="section-heading font-weight"> Stage 03 </div>
                    <div class="chart-grid-stage">
                        <canvas id="stage03"></canvas>
                        <label class="chart-percentage-stage" for="stage03" id="stage03-label"></label>
                    </div>
                </div>
            </a>
            <a href="<?php echo URL_ROOT; ?>managers/assembly/<?php echo $data['ChassisNo']; ?>/stagefour">
                <div class="display-flex-column align-items-center border-radius-1 background-white padding-4 gap-1">
                    <div class="section-heading font-weight"> Stage 04 </div>
                    <div class="chart-grid-stage">
                        <canvas id="stage04"></canvas>
                        <label class="chart-percentage-stage" for="stage04" id="stage04-label"></label>
                    </div>
                </div>
            </a>

        </div>

    </div>
</section>

<script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/dounutCharts.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>

<script>

    let all = {complete: <?php echo $data['overall']['completed']; ?>, pending: <?php echo $data['overall']['pending']; ?>}
    let s1 = {complete: <?php echo $data['stage01']['completed']; ?>, pending: <?php echo $data['stage01']['pending']; ?>}
    let s2 = {complete: <?php echo $data['stage02']['completed']; ?>, pending: <?php echo $data['stage02']['pending']; ?>}
    let s3 = {complete: <?php echo $data['stage03']['completed']; ?>, pending: <?php echo $data['stage03']['pending']; ?>}
    let s4 = {complete: <?php echo $data['stage04']['completed']; ?>, pending: <?php echo $data['stage04']['pending']; ?>}

    var ctx = document.getElementById('assemblyOverall').getContext('2d');
    var ctx1 = document.getElementById('stage01').getContext('2d');
    var ctx2 = document.getElementById('stage02').getContext('2d');
    var ctx3 = document.getElementById('stage03').getContext('2d');
    var ctx4 = document.getElementById('stage04').getContext('2d');

    let ltx = document.getElementById('assemblyOverall-label');
    let ltx1 = document.getElementById('stage01-label');
    let ltx2 = document.getElementById('stage02-label');
    let ltx3 = document.getElementById('stage03-label');
    let ltx4 = document.getElementById('stage04-label');

    renderChart(ctx, ltx, all, 110);
    renderChart(ctx1, ltx1, s1);
    renderChart(ctx2, ltx2, s2);
    renderChart(ctx3, ltx3, s3);
    renderChart(ctx4, ltx4, s4);

</script>

<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>