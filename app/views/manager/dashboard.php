<?php require_once APP_ROOT . '\views\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\navbar.php'; ?>

<?php $count = 0; ?>

<section class="position-absolute page-content">
    <div class="page-heading font-weight">
        Dashboard
    </div>
</section>
<section class="dash-section height-90">
        <div class="dash-section-cardsframe  margin-bottom-5">
            <div class="dash-cardsframe-left ">
                <div class="dash-card-left-top ">
                    <div class="dash-graph-frame ">
                        <div class="dash-graph-top ">
                            <div class="dash-frame-headings ">Ongoing Assembly</div>
                            <div class="custom-select">
                                <select name="vehicles" id="vehicles">
                                    <option value="">Select vehicle</option>
                                    <option value="CN1294B0934">CN1294B0934</option>
                                    <option value="CN1294G0836">CN1294G0836</option>
                                    <option value="CN1294L9302">CN1294L9302</option>
                                </select>
                            </div>
                        </div>
                        <div class="dash-graph-view ">
                            <canvas id="myChart"></canvas>
                            <label class="chart-percentage" for="myChart">60%</label>
                        </div>
                        <div class="dash-graph-bottom ">
                            <div class="dash-graph-menu ">
                                <div class="dash-graph-color-circle dash-darkblue-circle "></div>
                                <div>Done</div>
                            </div>
                            <div class="dash-graph-menu ">
                                <div class="dash-graph-color-circle dash-lightblue-circle "></div>
                                <div>On-going</div>
                            </div>
                        </div>

                    </div>

                    <div class="dash-line-breaker "></div>

                    <div class="dash-damages-frame ">
                        <div>
                            <div class="dash-frame-headings ">Damaged Parts</div>
                            <div></div>
                        </div>
                        <div></div>
                    </div>

                </div>


                <div class="dash-card-left-bottom ">
                    <div class="dash-card-left-bottom-countbox ">
                        <div class="dash-countbox-number "><?php echo $count; ?></div>
                        <div>On Assembly</div>
                    </div>
                    <div class="dash-card-left-bottom-countbox ">
                        <div class="dash-countbox-number "><?php echo $count; ?></div>
                        <div>Dispatched</div>
                    </div>
                    <div class="dash-card-left-bottom-countbox ">
                        <div class="dash-countbox-number "><?php echo $count; ?></div>
                        <div>On Hold</div>
                    </div>
                </div>

            </div>


            <div class="dash-cardsframe-right ">

                <div class="dash-card-logs ">
                    <div class="dash-card-right-datalines dash-card-headings ">Activity Log</div>
                    <div class="dash-card-right-datalines "></div>
                </div>
                <div class="dash-card-quickaccess ">
                    <div class="dash-card-right-datalines dash-card-headings ">Quick Access</div>
                    <div class="dash-card-right-datalines dash-quickbtns-frame ">
                        <button type="button" class="dash-quickbtn">Issue Parts</button>
                        <a href="<?php echo URL_ROOT; ?>supervisors/leaves">
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

<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/dashboard.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/charts.js"></script>

</body>

</html>