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
                <div class="heading">On Going Assembly - <?php echo $data['chassisNo']; ?></div>
                <div class="display-none" id="vehicle_id"><?php echo $data['chassisNo']; ?></div> 
                <div class="stage-switch">
                    <button class="back-button">Overall</button>
                </div>
            </div>

            <div class="single-stage-body">

                <div class="single-stage-chart align-items-center">
                    <div class="chart-heading">
                        <div>Stage 03</div>
                        <div class="display-none" id="stage_id">Lstage03</div>
                    </div>
                    <div class="chart-grid">
                        <canvas id="Lstage03"></canvas>
                        <label class="chart-percentage-ao " for="Lstage03" id="Lstage03-label"></label>
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
                            if ($data['FormCarData'] == NULL) {

                                echo '<div class="horizontal-centralizer no-leave-data">
                                <div class="vertical-centralizer">
                                <div>- Not Ready for this stage -</div>
                                </div>
                                </div>';

                            } else {
                                
                                foreach ($data['FormCarData'] as $process) {
                                    echo '
                                    <div class="stage-control-row pagination-item">
                                        <div class="row-data">' . $process->ProcessName . '</div>
                                        <div class="row-data display-none">' . $process->Status . '</div>
                                        <form>
                                            <div class="row-data">
    
                                                <!-- IF THERE IS SOME PART RELATED TO THE PARTICULAR PROCESS IS DAMAGED,
                                                THAT PROCESS WILL BE AUTOMATICALLY HOLDS AND CANNOT CHANGED UNTIL REQUIRED PART IS RECEIVED -->
    
                                                <div><input type="checkbox" id="'. trim($process->ProcessId) .'-con" name="'. trim($process->ProcessId) .'-con" class="connected-btn" '. (($process->Status == "completed") ? "checked" : "") .' onclick="updateProcessStatus(\''. trim($process->ProcessId) .'\',\'con\')"></div>
                                                <div><input type="checkbox" id="'. trim($process->ProcessId) .'-hold" name="'. trim($process->ProcessId) .'-hold" class="holding-btn" '. (($process->Status == "OnHold") ? "checked" : "") .' onclick="updateProcessStatus(\''. trim($process->ProcessId) .'\',\'hold\')"></div>
                                            </div>
                                        </form>
                                    </div>';
                                }
                            }
                            ?>
                            
                        </div>
                    </div>

                    <div class="progress-handlers">
                        <!-- SET OF BUTTONS USED TO NAVIGATE BETWEEN PROCESS SETS -->
                        <div class="page-button-set">
                            <!-- <button onclick="showPage(1)" class="paginate">1</button>
                            <button onclick="showPage(2)" class="paginate">2</button>
                            <button onclick="showPage(3)" class="paginate">3</button>
                            <button onclick="showPage(4)" class="paginate">4</button> -->
                        </div>
                        <div class="sender">
                            <form action = "<?php echo URL_ROOT .'Supervisors/proceed'; ?>" method="post">
                                <input type="hidden" name="form-car-id" value="<?php echo $data['chassisNo']; ?>">
                                <input type="hidden" name="form-car-stage" value="S4">
                                <button type="Submit" id="stage-passer">Proceed to Next Stage</button>
                            </form>
                        </div>
                    </div>
                        

                </div>

            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/staging.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/charts.js"></script>

<script>

        let s3 = {complete: <?php echo $data['stageSum']['completed']; ?>, pending: <?php echo $data['stageSum']['pending']; ?>}

        var ctx = document.getElementById('Lstage03').getContext('2d');

        let ltx = document.getElementById('Lstage03-label');

        renderChart(ctx, ltx, s3, 110);

    </script>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>