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
                <div class="stage-switch">
                    <!-- BUTTON TO JUMP TO THE OVERALL PROGRESS -->
                    <button class="back-button">Overall</button>
                </div>
            </div>

            <div class="single-stage-body">
                <div class="single-stage-chart align-items-center">
                    <div class="chart-heading">
                        <div>Stage 02</div>
                    </div>
                    <div class="chart-grid">
                        <canvas id="Lstage02"></canvas>
                        <label class="chart-percentage-ao " for="Lstage02" id="Lstage02-label"></label>
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

                                            <div><input type="checkbox" id="connectivity-cb" name="connectivity" value="Connected"></div>
                                            <div><input type="checkbox" id="holding-cb" name="holding" value="Hold"></div>
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

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/charts.js"></script>

<script>

    let s2 = {complete: <?php echo $data['stageSum']['completed']; ?>, pending: <?php echo $data['stageSum']['pending']; ?>}

    var ctx = document.getElementById('Lstage02').getContext('2d');

    let ltx = document.getElementById('Lstage02-label');

    renderChart(ctx, ltx, s2, 110);

</script>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>