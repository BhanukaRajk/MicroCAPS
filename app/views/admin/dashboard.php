<?php require_once APP_ROOT . '/views/admin/includes/header.php'; ?>
<?php require_once APP_ROOT . '/views/admin/includes/navbar.php'; ?>

<section class="position-absolute page-content">
    <div class="page-heading font-weight">
        Dashboard
    </div>

    <div class="admin-dash-content">

        <div class="admin-dash-left-content">
            <div class="admin-dash-left-content-inner">
                <div class="admin-dash-emp-count">
                    <div class="admin-dash-emp-count-head">Employees</div>
                    <div class="admin-dash-emp-count-content">
                        <div class="admin-dash-count-box">
                            <div class="admin-dash-count-box-value">1</div>
                            <div class="admin-dash-count-box-category">Manager</div>
                        </div>
                        <div class="admin-dash-count-box">
                            <div class="admin-dash-count-box-value">4</div>
                            <div class="admin-dash-count-box-category">Supervisors</div>
                        </div>
                        <div class="admin-dash-count-box">
                            <div class="admin-dash-count-box-value">10</div>
                            <div class="admin-dash-count-box-category">Assemblers</div>
                        </div>
                        <div class="admin-dash-count-box">
                            <div class="admin-dash-count-box-value">5</div>
                            <div class="admin-dash-count-box-category">Testers</div>
                        </div>
                    </div>
                </div>
                <div class="admin-dash-car-count">
                    <div class="admin-dash-car-count-head">On Assembly Line</div>
                    <div class="admin-dash-car-count-content">
                        <div class="admin-dash-count-box-value">5</div>
                        <div class="admin-dash-count-box-category">Vehicles</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-dash-right-content">
            <div class="admin-dash-activity-logs">
                <div class="dash-card-right-datalines dash-card-headings ">Activity Log</div>
                <div class="dash-card-right-datalines "></div>
            </div>
            <div class="admin-dash-quick-access">
                <div class="dash-card-right-datalines dash-card-headings ">Quick Access</div>
                <div class="dash-card-right-datalines dash-quickbtns-frame ">
                    <!-- <a href="<?php //echo URL_ROOT; ?>managers/bodyshell">
                        <button type="button" class="dash-quickbtn">Request Body Shell</button>
                    </a>
                    <a href="<?php //echo URL_ROOT; ?>managers/test">
                        <button type="button" class="dash-quickbtn">Dispatch Vehicles</button>
                    </a> -->
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

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/adminjs/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/adminjs/dashboard.js"></script>


</body>

</html>