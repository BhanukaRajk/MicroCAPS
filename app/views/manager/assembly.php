<?php require_once APP_ROOT . '\views\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row margin-bottom-3 align-items-center justify-content-between margin-right-6">
            <div class="page-heading font-weight">
                On Going Assembly
            </div>
            <div class="custom-select">
                <select name="vehicles" class="background-none" id="vehicles">
                    <option value="">Select vehicle</option>
                    <option value="CN1294B0934">CN1294B0934</option>
                    <option value="CN1294G0836">CN1294G0836</option>
                    <option value="CN1294L9302">CN1294L9302</option>
                </select>
            </div>
        </div>
        

        <div class="display-flex-row justify-content-around gap-2">
            <div class="display-flex-column align-items-center justify-content-center border-radius-1 background-white paddingy-5 paddingx-7 gap-1">
                <div class="section-heading font-weight"> Overall Progress </div>
                <div class="chart-grid">
                    <canvas id="assemblyOverall"></canvas>
                    <label class="chart-grid-add chart-percentage-ao " for="assemblyOverall">60%</label>
                </div>
                <div class="display-flex-row justify-content-center gap-0p5">
                    <div class="display-flex-row justify-content-center align-items-center border-gray border-radius-0p5 padding-2 font-size">
                        <div class="dash-graph-color-circle dash-darkblue-circle "></div>
                        <div>Done</div>
                    </div>
                    <div class="display-flex-row justify-content-center align-items-center border-gray border-radius-0p5 padding-2 font-size">
                        <div class="dash-graph-color-circle dash-lightblue-circle "></div>
                        <div>On-going</div>
                    </div>
                </div>
            </div>
            <div class="row background-none gap-2">
                <a href="<?php echo URL_ROOT; ?>managers/assemblystage/stageone">
                    <div class="display-flex-column align-items-center border-radius-1 background-white padding-4 gap-1">
                        <div class="section-heading font-weight"> Stage 01 </div>
                        <div class="chart-grid-stage">
                            <canvas id="stage01"></canvas>
                            <label class="chart-grid-stage-add chart-percentage-stage width-rem-3" for="assemblyOverall">100%</label>
                        </div> 
                    </div>
                </a>
                <a href="<?php echo URL_ROOT; ?>managers/assemblystage/stagetwo">
                    <div class="display-flex-column align-items-center border-radius-1 background-white padding-4 gap-1">
                        <div class="section-heading font-weight"> Stage 02 </div>
                        <div class="chart-grid-stage">
                            <canvas id="stage02"></canvas>
                            <label class="chart-grid-stage-add chart-percentage-stage width-rem-3" for="assemblyOverall">100%</label>
                        </div> 
                    </div>
                </a>
                <a href="<?php echo URL_ROOT; ?>managers/assemblystage/stagethree">
                    <div class="display-flex-column align-items-center border-radius-1 background-white padding-4 gap-1">
                        <div class="section-heading font-weight"> Stage 03 </div>
                        <div class="chart-grid-stage">
                            <canvas id="stage03"></canvas>
                            <label class="chart-grid-stage-add chart-percentage-stage" for="assemblyOverall">55%</label>
                        </div> 
                    </div>
                </a>
                <a href="<?php echo URL_ROOT; ?>managers/assemblystage/stagefour">
                    <div class="display-flex-column align-items-center border-radius-1 background-white padding-4 gap-1">
                        <div class="section-heading font-weight"> Stage 04 </div>
                        <div class="chart-grid-stage">
                            <canvas id="stage04"></canvas>
                            <label class="chart-grid-stage-add chart-percentage-stage" for="assemblyOverall">&nbsp;0%</label>
                        </div> 
                    </div>
                </a>
                
            </div>
            
        </div>
    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/assemblyCharts.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/cors.js"></script>

    
</body>