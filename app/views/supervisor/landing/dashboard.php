<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<!-- GET DATA FROM CONTROLLER -->
<?php $counts = $data['counts']; ?>

<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="dash-section-frame test1">
            <div class="dash-section-heading test1"><b>Dashboard</b></div>
            <div class="dash-section-cardsframe test1">
                <div class="dash-cardsframe-left test1">
                    <div class="dash-card-left-top test1">
                        <div class="dash-graph-frame test1">
                            <div class="dash-graph-top test1">
                                <div class="dash-frame-headings test1">Ongoing Assembly</div>
                                <div>
                                    <select name="vehicles" id="dashboardChart" onchange="dashboardChart()">
                                        <?php
                                        foreach($data['assemblyDetails'] as $value) {
                                            echo '<option value="' . $value->ChassisNo . '">'.$value->ChassisNo.'</option>';
                                        }
                                        ?>>
                                    </select>
                                </div>
                            </div>
                            <div class="dash-graph-view">
                                <canvas id="myChart"></canvas>
                                <label class="chart-percentage" for="myChart">60%</label>
                            </div>
                            <div class="dash-graph-bottom test1">
                                <div class="dash-graph-menu test1">
                                    <div class="dash-graph-color-circle dash-darkblue-circle test1"></div>
                                    <div>Done</div>
                                </div>
                                <div class="dash-graph-menu test1">
                                    <div class="dash-graph-color-circle dash-lightblue-circle test1"></div>
                                    <div>On-going</div>
                                </div>
                            </div>

                        </div>

                        <div class="dash-line-breaker test1"></div>

                        <div class="dash-damages-frame test1">
                            <div>
                                <div class="dash-frame-headings test1">Damaged Parts</div>
                                <div></div>
                            </div>
                            <div class="display-flex-column gap-1 overflow">
                                <?php
                                if (!$data['damagedParts']) {

                                    echo '<div class="horizontal-centralizer">
                                                        <div class="marginy-4">No Damaged Parts Available</div>
                                                        <div class=""></div>
                                                    </div>
                                                    <div class="bottom-border"></div>';
        
                                } else {
                                    foreach ($data['damagedParts'] as $part) {
                                        echo '<div class="medfont display-flex-row justify-content-between border-bottom width-rem-20">
                                                <div class="display-flex-column padding-bottom-3">
                                                    <div class="part-name">'.$part->PartName.'</div>
                                                    <div class="display-flex-row gap-1">
                                                        <div class="">Serial No: '. $part->SerialNo .'</div>
                                                        <div class="">Color: '. $part->Color .'</div>
                                                    </div>
                                                </div>
                                                <div class="display-flex-column justify-content-center align-items-center border-radius-0p5 width-rem-6 height-rem-1p5 red-box">
                                                    <div class="'. (($part->RequestStatus == "Requested") ? 'result-text-req' : 'result-text-not-req' ) .'">'. $part->RequestStatus .'</div>
                                                </div>
                                            </div>
                                            ';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </div>


                    <div class="dash-card-left-bottom test1">
                        <div class="dash-card-left-bottom-countbox test1">
                            <div class="dash-countbox-number test1"><?php echo $counts[0]->asLine; ?></div>
                            <div>On Assembly</div>
                        </div>
                        <div class="dash-card-left-bottom-countbox test1">
                            <div class="dash-countbox-number test1"><?php echo $counts[1]->dispatched; ?></div>
                            <div>Dispatched</div>
                        </div>
                        <div class="dash-card-left-bottom-countbox test1">
                            <div class="dash-countbox-number test1"><?php echo $counts[2]->onHold; ?></div>
                            <div>On Hold</div>
                        </div>
                    </div>

                </div>

                <div class="dash-cardsframe-right test1">

                    <div class="dash-card-logs">
                        <div class="dash-card-right-datalines dash-card-headings test1">Activity Log</div>
                        <div class="horizontal-centralizer"><table><?php

                            echo '<tr><td class="log-data"><b>You</b></td>';
                            echo '<td class="log-data"><span class="online-user">Online</span></td></tr>';

                            foreach ($data['activities'] as $activityLog) {

                                if ($activityLog->EmployeeId != $_SESSION['_id']) {
                                    echo '<tr><td class="log-data">' . $activityLog->empName  . '</td>';
                                    if($activityLog->LoggedIn == 1) {
                                        echo '<td class="log-data"><span class="online-user">Online</span></td></tr>';
                                    } else {
                                        echo '<td class="log-data">'. $activityLog->logDate .' at '. substr($activityLog->logTime, 0, 5) .'</td></tr>';
                                    }
                                }
                                
                            }
                                ?></table></div>

                    </div>

                    <div class="dash-card-quickaccess test1">
                        <div class="dash-card-right-datalines dash-card-headings test1">Quick Access</div>
                        <div class="dash-card-right-datalines dash-quickbtns-frame test1">
                            <a href="<?php echo URL_ROOT; ?>supervisors/componentsView">
                                <button type="button" class="dash-quickbtn">Issue Parts</button>
                            </a>
                            <a href="<?php echo URL_ROOT; ?>Supervisors/leaves">
                                <button type="button" class="dash-quickbtn">Leaves</button>
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

<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>