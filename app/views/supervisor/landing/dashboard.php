<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>

<!-- GET DATA FROM CONTROLLER -->
<?php $count = $data['count']; ?>


<!-- DASHBOARD DETAILED CONTENT -->
<section class="dash-section">
    <div class="dash-section-frame test1">
        <div class="dash-section-heading test1"><b>Dashboard</b></div>
        <div class="dash-section-cardsframe test1">
            <div class="dash-cardsframe-left test1">
                <div class="dash-card-left-top test1">
                    <div class="dash-graph-frame test1">
                        <div class="dash-graph-top test1">
                            <div class="dash-frame-headings test1">Ongoing Assembly</div>
                            <div>
                                <!-- <label for="vehicles" class="small">Select Vehicle</label> -->
                                <select name="vehicles" id="vehicles">
                                    <option value="NULL">Select vehicle</option>
                                    <option value="CN1294B0934">CN1294B0934</option>
                                    <option value="CN1294G0836">CN1294G0836</option>
                                    <option value="CN1294L9302">CN1294L9302</option>
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
                        <div></div>
                    </div>

                </div>


                <div class="dash-card-left-bottom test1">
                    <div class="dash-card-left-bottom-countbox test1">
                        <div class="dash-countbox-number test1"><?php echo $count; ?></div>
                        <div>On Assembly</div>
                    </div>
                    <div class="dash-card-left-bottom-countbox test1">
                        <div class="dash-countbox-number test1"><?php echo $count; ?></div>
                        <div>Dispatched</div>
                    </div>
                    <div class="dash-card-left-bottom-countbox test1">
                        <div class="dash-countbox-number test1"><?php echo $count; ?></div>
                        <div>On Hold</div>
                    </div>
                </div>

            </div>


            <div class="dash-cardsframe-right test1">

                <div class="dash-card-logs test1">
                    <div class="dash-card-right-datalines dash-card-headings test1">Activity Log</div>
                    <div class="dash-card-right-datalines test1"></div>
                </div>
                <div class="dash-card-quickaccess test1">
                    <div class="dash-card-right-datalines dash-card-headings test1">Quick Access</div>
                    <div class="dash-card-right-datalines dash-quickbtns-frame test1">
                        <a href="<?php echo URL_ROOT; ?>supervisors/PAQrecord">
                            <button type="button" class="dash-quickbtn">Issue Parts</button>
                        </a>
                        <a href="<?php echo URL_ROOT; ?>Supervisors/leaves">
                            <button type="button" class="dash-quickbtn">Leaves</button>
                        </a>
                    </div>
                </div>
                <div class="dash-card-calender test1"></div>
            </div>
        </div>
    </div>
</section>

<!-- ADD COMMON FOOTER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>