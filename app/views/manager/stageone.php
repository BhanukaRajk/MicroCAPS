<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row margin-bottom-4 align-items-center justify-content-between width-100">
            <div class="page-heading font-weight">
                On Going Assembly
            </div>
            <div>
                <a href="<?php echo URL_ROOT; ?>managers/assembly/<?php echo $data['ChassisNo']; ?>/stagetwo">
                    <div class="next">
                        Next
                        <i class='icon fa-angle-right'></i>
                    </div>
                </a>
            </div>
        </div>
        

        <div class="display-flex-row justify-content-start gap-2">
            <div class="display-flex-column align-items-center justify-content-center border-radius-1 background-white paddingy-5 paddingx-8 gap-1">
                <div class="section-heading font-weight"> Stage One </div>
                <div class="chart-grid">
                    <canvas id="Lstage01"></canvas>
                    <label class="chart-percentage-ao " for="Lstage01" id="Lstage01-label"></label>
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
            <div class="background-white border-radius-1 padding-top-4 padding-bottom-5 paddingx-5">
                <div class="display-flex-column gap-2">
                    <div class="display-flex-row justify-content-end">
                        <div class="custom-select">
                            <select name="status" id="component-status">
                                <option value="connected">Connected</option>
                                <option value="pending">Pending</option>
                                <option value="hold">On Hold</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-auto height-vh-57 ">
                        <?php
                            echo '<div class="state display-flex-column align-items-center gap-1 " id="connected">';
                            if (empty($data['stageDetails']['connected'])) {
                                echo '<div class="display-flex-row justify-content-between border-bottom width-rem-20 margin-right-3">
                                        <div class="padding-bottom-3 font-size">No Connected Parts</div>
                                    </div>
                                    ';
                            } else {
                                foreach ($data['stageDetails']['connected'] as $value) {
                                    echo '<div class="display-flex-row justify-content-between border-bottom width-rem-20 margin-right-3">
                                            <div class="padding-bottom-3 font-size">'.$value->ProcessName.'</div>
                                            <div class="display-flex-column justify-content-center align-items-center border-radius-0p5 width-rem-6 height-rem-1p5 green-box">
                                                <div class="result-text">Connected</div>
                                            </div>
                                        </div>
                                        ';
                                }
                            }
                            echo '</div>';
                            echo '<div class="state display-flex-column align-items-center gap-1 display-none" id="hold">';
                            if (empty($data['stageDetails']['hold'])) {
                                echo '<div class="display-flex-row justify-content-between border-bottom width-rem-20 margin-right-3">
                                        <div class="padding-bottom-3 font-size">No Holded Parts</div>
                                    </div>
                                    ';
                            } else {
                                foreach ($data['stageDetails']['hold'] as $value) {
                                    echo '<div class="display-flex-row justify-content-between border-bottom width-rem-20 margin-right-3">
                                            <div class="padding-bottom-3 font-size">'.$value->ProcessName.'</div>
                                            <div class="display-flex-column justify-content-center align-items-center border-radius-0p5 width-rem-6 height-rem-1p5 red-box">
                                                <div class="result-text">On Hold</div>
                                            </div>
                                        </div>
                                        ';
                                }
                            }
                            echo '</div>';
                            echo '<div class="state display-flex-column align-items-center gap-1 display-none" id="pending">';
                            if (empty($data['stageDetails']['pending'])) {
                                echo '<div class="display-flex-row justify-content-between border-bottom width-rem-20 margin-right-3">
                                        <div class="padding-bottom-3 font-size">No Pending Parts</div>
                                    </div>
                                    ';
                            } else {
                                foreach ($data['stageDetails']['pending'] as $value) {
                                    echo '<div class="display-flex-row justify-content-between border-bottom width-rem-20 margin-right-3">
                                            <div class="padding-bottom-3 font-size">'.$value->ProcessName.'</div>
                                            <div class="display-flex-column justify-content-center align-items-center border-radius-0p5 width-rem-6 height-rem-1p5 yellow-box">
                                                <div class="result-text">Pending</div>
                                            </div>
                                        </div>
                                        ';
                                }
                            }
                            echo '</div>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/dounutCharts.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/stages.js"></script>

    <script>

        let s1 = {complete: <?php echo $data['stageSum']['connected']; ?>, pending: <?php echo $data['stageSum']['pending']; ?>}

        var ctx = document.getElementById('Lstage01').getContext('2d');

        let ltx = document.getElementById('Lstage01-label');

        renderChart(ctx, ltx, s1, 110);

    </script>
    
</body>