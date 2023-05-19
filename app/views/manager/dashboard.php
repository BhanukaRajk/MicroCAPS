<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<section class="position-absolute page-content">
    <div class="page-heading font-weight">
        Dashboard
    </div>
</section>
<section class="dash-section height-90">
        <div class="dash-section-cardsframe  margin-bottom-4">
            <div class="dash-cardsframe-left ">
                <div class="dash-card-left-top ">
                    <div class="dash-graph-frame ">
                        <div class="dash-graph-top ">
                            <div class="dash-frame-headings ">Ongoing Assembly</div>
                            <div class="custom-select">
                                <select name="vehicles" id="dashboardChart" onchange="dashboardChart()">
                                    <?php 
                                        foreach($data['assemblyDetails'] as $value) {
                                            echo '<option value="' . $value->ChassisNo . '">'.$value->ChassisNo.'</option>';
                                        }
                                    ?>>
                                </select>
                            </div>
                        </div>
                        <div class="dash-graph-view ">
                            <canvas id="myChart"></canvas>
                            <label class="chart-percentage" for="myChart" id="myChart-label"></label>
                        </div>
                        <div class="dash-graph-bottom ">
                            <div class="dash-graph-menu ">
                                <div class="dash-graph-color-circle dash-darkblue-circle "></div>
                                <div>Completed</div>
                            </div>
                            <div class="dash-graph-menu ">
                                <div class="dash-graph-color-circle dash-lightblue-circle "></div>
                                <div>Pending</div>
                            </div>
                        </div>

                    </div>

                    <div class="dash-line-breaker "></div>

                    <div class="dash-damages-frame ">
                        <div>
                            <div class="dash-frame-headings ">Damaged Components</div>
                        </div>
                        <div class="display-flex-column gap-1 overflow">
                            <?php 
                                if ($data['onHoldComponents'] == false) {
                                    echo '
                                                <div class="display-flex-row justify-content-center align-items-center width-100 paddingy-6">
                                                        <div class="font-weight">No Damaged Components</div>
                                                    </div>
                                                ';
                                } else {
                                    $cnt = 1;
                                    $sentence = '';
                                    $string = '';
                                    foreach ($data['onHoldComponents'] as $value) {

                                        if ($value->Color == 0) {
                                            $color = 'None';
                                        } else {
                                            $color = $value->VehicleColor;
                                        }

                                        $string = $string . '&type'.$cnt.'='.$value->ModelNo.'&color'.$cnt.'='.$value->VehicleColor.'&qty'.$cnt.'='.$value->Qty;
                                        $cnt++;                                  

                                        echo '<div class="display-flex-row justify-content-between border-bottom width-rem-20">
                                                <div class="display-flex-column padding-bottom-3">
                                                    <div class="font-size">'.$value->PartName.'</div>
                                                    <div class="display-flex-row gap-1">
                                                        <div class="qty">Quantity : ' . $value->Qty . '</div>
                                                        <div class="qty">Color : ' . $color . '</div>
                                                    </div>
                                                </div>
                                                <div class="display-flex-column justify-content-center align-items-center border-radius-0p5 width-rem-6 height-rem-1p5 red-box">
                                                    <div class="result-text">On Hold</div>
                                                </div>
                                            </div>
                                            ';
                                    }
                                }
                            ?>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary btn-red-2 <?php  echo  ($data['onHoldComponents'] == false) ? 'display-none' : ''; ?>" onclick="damagedComponents('<?php echo $string; ?>')">Request</button>
                        </div>
                    </div>

                </div>


                <div class="dash-card-left-bottom ">
                    <div class="dash-card-left-bottom-countbox ">
                        <div class="dash-countbox-number "><?php echo $data['onAssembly']; ?></div>
                        <div>On Assembly</div>
                    </div>
                    <div class="dash-card-left-bottom-countbox ">
                        <div class="dash-countbox-number "><?php echo $data['dispatched']; ?></div>
                        <div>Dispatched</div>
                    </div>
                    <div class="dash-card-left-bottom-countbox ">
                        <div class="dash-countbox-number "><?php echo $data['onHold']; ?></div>
                        <div>On Hold</div>
                    </div>
                </div>

            </div>


            <div class="dash-cardsframe-right ">

                <div class="dash-card-logs ">
                    <div class="dash-card-right-datalines dash-card-headings ">Activity Log</div>
                    <div class="display-flex-row justify-content-center">
                        <table>
                            <?php 

                                echo '<tr><td class="font-size width-rem-8p5 word-wrap-normal"><b>You</b></td>';
                                echo '<td class="font-size width-rem-8p5 word-wrap-normal"><span class="text-green"><b>Online</b></span></td></tr>';

                                foreach ($data['activityLogs'] as $activityLog) {

                                    if ($activityLog->EmployeeId != $_SESSION['_id']) {
                                        echo '<tr><td class="font-size width-rem-8p5 word-wrap-normal">' . $activityLog->empName . '</td>';
                                    
                                    
                                        if($activityLog->LoggedIn == 1) {
                                            echo '<td class="font-size width-rem-8p5 word-wrap-normal"><span class="text-green"><b>Online</b></span></td></tr>';
                                        } else {
                                            echo '<td class="font-size width-rem-8p5 word-wrap-normal">'. $activityLog->logDate .' at '. substr($activityLog->logTime, 0, 5) .'</td></tr>';
                                        }
                                    }
                                    
                                }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="dash-card-quickaccess ">
                    <div class="dash-card-right-datalines dash-card-headings ">Quick Access</div>
                    <div class="dash-card-right-datalines dash-quickbtns-frame ">
                        <a href="<?php echo URL_ROOT; ?>managers/bodyshell">
                            <button type="button" class="btn btn-primary btn-blue">Request Body Shell</button>
                        </a>
                        <a href="<?php echo URL_ROOT; ?>managers/dispatch">
                            <button type="button" class="btn btn-primary btn-blue">Dispatch Vehicles</button>
                        </a>
                    </div>
                </div>
                <div class="display-flex-column align-items-center border-radius-1 background-white padding-3" id="calender">
                    <div class="calender-title margin-top-3" id="calender-title">May 2021</div>
                    <table class="margin-top-3">
                        <thead>
                            <tr>
                                <th>Mo</th>
                                <th>Tu</th>
                                <th>We</th>
                                <th>Th</th>
                                <th>Fr</th>
                                <th>Sa</th>
                                <th>Su</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                            </tr>
                            <tr>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                            </tr>
                            <tr>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                            </tr>
                            <tr>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                            </tr>
                            <tr>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                                <td class="date"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="display-flex-column">

    <div id="alert" class="hideme" role="alert"></div>

</section>

<script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/dashboard.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/dounutCharts.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>

<script>

    let ao = {complete: <?php echo $data['overall']['completed']; ?>, pending: <?php echo $data['overall']['pending']; ?>}

    var ctx = document.getElementById('myChart').getContext('2d');

    let ltx = document.getElementById('myChart-label');

    renderChart(ctx, ltx, ao, 80);

</script>

</body>

</html>