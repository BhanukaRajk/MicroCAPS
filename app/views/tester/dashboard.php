<?php require_once APP_ROOT . '\views\includes_r\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>


<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/main.js"></script>


<section class="position-absolute page-content">
    <div class="detailed_content">
        <div class="left">
            <div class="heading bold">Tester - Dashboard</div>
            <div class="indetail">
                <div class="graph">
                    <div class="upper">
                        <div class="bold">Ongoing Assembly</div>
                    </div>
                    <div><label for="vehicles" class="small"><br>Select Vehicle</label>
                            <select name="vehicles" id="vehicles">
                                <option value=""></option>
                                <option value=""></option>
                            </select>
                    </div>
                    <div class="chart"><img src="<?php echo URL_ROOT; ?>public/images/graph.jpg" class="donut" alt="status graph"></div>
                    <div class="map_list">
                        <div class="map">
                            <div class="circle"></div>
                            <div>Done</div>
                        </div>
                        <div class="map">
                            <div class="circle"></div>
                            <div>On-going</div>
                        </div>
                    </div>
                </div>
                <div class="line"></div>
                <div class="damages">
                    <div>
                        <div class="bold">Damaged Parts</div>
                        <div></div>
                    </div>
                    <div></div>
                </div>
            </div>
            <div class="count">
                <div class="countbox">
                    <div class="number">5</div>
                    <div>On Assembly</div>
                </div>
                <div class="countbox">
                    <div class="number">10</div>
                    <div>Dispatched</div>
                </div>
                <div class="countbox">
                    <div class="number">2</div>
                    <div>On Hold</div>
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
                    <button type="button" class="blue_button">Defect Sheet</button>
                    <a href="<?php echo URL_ROOT; ?>testers/select_vehicle">
                        <button type="button" class="blue_button">Select Vehicle</button>
                </div>
            </div>
            <div class="calender"></div>
        </div>
    </div>
</section>