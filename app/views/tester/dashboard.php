<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>

<section>
    <div class="db-page">
        <div class="db-board-2">
            <div class="db-section">
                <div class="db-section-2">
                    <div class="db-data-board">
                        <div class="db-detailed-content">
                            <div class="db-left">
                                <div class="page-heading font-weight margin-top-4 margin-bottom-4">Tester - Dashboard</div>
                                <div class="indetail">
                                    <div class="dash-cap">Your Tasks</div>
                                    <div class="pending-tasks">

                                        <?php 

                                        if (!$data['vehicles']) {
                                            echo '
                                            <div class="display-flex-row justify-content-center align-items-center width-100 paddingy-6">
                                                    <div class="font-weight">No PDI Vehicles</div>
                                                </div>
                                            ';
                                        } else {                       
                                            $i=1;                  
                                            foreach ($data['vehicles'] as $values) : 
                                                    if($values->TesterId == $_SESSION['_id'] && $values->PDIStatus == 'P' && $i <= 3){ 
                                                        $i++;
                                                        ?>
                                                            <div 
                                                                    class="blue-button-long"  
                                                                    onClick="location.href='<?php echo URL_ROOT; ?>testers/pdi/<?php  echo $values->ChassisNo; ?>'"
                                                            >
                                                                    <?php echo $values->ChassisNo; ?>
                                                            </div>

                                            <?php } endforeach; } ?>

                                    </div>
                                </div>
                                <div class="db-count">
                                    <div class="db-countbox">
                                        <div class="db-number"><?php echo $data['counts'][0]->inLine; ?></div>
                                        <div>Pending</div>
                                    </div>
                                    <div class="db-countbox">
                                        <div class="db-number"><?php echo $data['counts'][1]->dispatched; ?></div>
                                        <div>Dispatched</div>
                                    </div>
                                    <div class="db-countbox">
                                        <div class="db-number"><?php echo $data['counts'][2]->onHold; ?></div>
                                        <div>On Assembly</div>
                                    </div>
                                </div>
                            </div>
                            <div class="db-right">
                                <div class="db-logs">
                                    <div class="db-act-sidebox bold">Activity Logs</div>
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
                                <div class="db-quick bold">
                                    <div class="db-qck-sidebox">Quick Access</div>
                                    <div class="db-qck-sidebox db-activity-btn">
                                        <button type="button" class="btn btn-primary btn-blue " onClick="location.href='<?php echo URL_ROOT; ?>testers/selectpdi'">PDI Results</button>
                                        <button type="button" class="btn btn-primary btn-blue" onClick="location.href='<?php echo URL_ROOT; ?>testers/mytasks/<?php echo $_SESSION['_id']; ?>'">My Tasks</button>
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
            </div>
        </div>
</section>

<script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/dashboard.js"></script>