<?php require_once APP_ROOT . '\views\tester\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>


<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/main.js"></script>


<section class="position-absolute page-content">
    <div class="detailed_content">
        <div class="left">
            <div class="heading bold">Tester - Dashboard</div>
            <div class="indetail">
                <div class="dash_cap">Pending Tasks</div>
                <div class="graph">

                    <?php foreach ($data['vehicles'] as $values) : ?>

                        <!-- <div class="blue_button_long"  onClick="location.href='<?php // echo URL_ROOT; ?>testers/defect_sheet/<?php //echo $values->ChassisNo; ?>'"><?php //echo $values->ChassisNo; ?></div> -->
                        <div class="blue_button_long"  onClick="location.href='<?php echo URL_ROOT; ?>testers/select_view/<?php echo $values->ChassisNo; ?>'"><?php echo $values->ChassisNo; ?></div>
                        

                    <?php endforeach; ?>

                </div>
            </div>
            <div class="count">
                <div class="countbox">
                    <div class="number">5</div>
                    <div>Pending Tasks</div>
                </div>
                <div class="countbox">
                    <div class="number">10</div>
                    <div>Dispatched</div>
                </div>
                <div class="countbox">
                    <div class="number">2</div>
                    <div>On Assembly</div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="logs bold">
                <div class="sidebox">Activity Logs</div>
                <div class="sidebox"></div>
            </div>
            <div class="quick bold">
                <div class="sidebox">Quick Access</div>
                <div class="sidebox activity_btn">
                    <button type="button" class="blue_button">Select Vehicle</button>
                    <a href="<?php echo URL_ROOT; ?>testers/add_defect">
                        <button type="button" class="blue_button">Add Defect</button>
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
</section>

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/dashboard.js"></script>