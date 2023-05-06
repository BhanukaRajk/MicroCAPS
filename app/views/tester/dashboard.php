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
                                <div class="db-heading bold">Tester - Dashboard</div>
                                <div class="indetail">
                                    <div class="dash-cap">Pending Tasks</div>
                                    <div class="pending-tasks">

                                        <?php // foreach ($data['vehicles'] as $values) : ?>

                                        <!-- <div class="blue-button-long"  onClick="location.href='<?php // echo URL_ROOT; ?>testers/select_view/<?php // echo $values->ChassisNo; ?>'"><?php // echo $values->ChassisNo; ?></div> -->

                                        <?php // endforeach; ?>

                                    </div>
                                </div>
                                <div class="db-count">
                                    <div class="db-countbox">
                                        <div class="db-number"><?php echo $data['counts'][0]->inLine; ?></div>
                                        <div>Pending Tasks</div>
                                        <?php //var_dump($data['counts'][0]->inLine); ?> 
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
                                <div class="db-logs bold">
                                    <div class="db-act-sidebox">Activity Logs</div>
                                    <div class="db-act-sidebox"></div>
                                </div>
                                <div class="db-quick bold">
                                    <div class="db-qck-sidebox">Quick Access</div>
                                    <div class="db-qck-sidebox db-activity-btn">
                                        <button type="button" class="btn btn-primary btn-blue " onClick="location.href='<?php echo URL_ROOT; ?>testers/selectpdi'">PDI Results</button>
                                        <button type="button" class="btn btn-primary btn-blue" ck="location.href='<?php echo URL_ROOT; ?>testers/add_defect'">Add Defect</button>
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