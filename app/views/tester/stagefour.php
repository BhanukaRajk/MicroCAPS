<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row margin-bottom-3 align-items-center justify-content-between">
            <div class="page-heading font-weight">
                On Going Assembly
            </div>
            <div class="display-flex-row gap-1">
                <a href="<?php echo URL_ROOT; ?>testers/assemblystage/stagethree">
                    <div class="next">
                        <i class='icon fa-angle-left'></i>
                        Previous
                    </div>
                </a>
            </div>
        </div>
        

        <div class="display-flex-row justify-content-start gap-2">
            <div class="display-flex-column align-items-center justify-content-center border-radius-1 background-white paddingy-5 paddingx-7 gap-1">
                <div class="section-heading font-weight"> Stage Four </div>
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
                                
            </div>
            
        </div>
    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/assemblyCharts.js"></script>
    <!-- <script type="text/javascript" src="<?php //echo URL_ROOT; ?>public/javascripts/testerjs/cors.js"></script> -->

    
</body>