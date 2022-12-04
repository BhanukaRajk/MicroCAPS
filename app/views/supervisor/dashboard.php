<?php require_once APP_ROOT . '/views/includes/header.php'; ?>


<?php require_once APP_ROOT . '/views/supervisor/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/topnavbar.php'; ?>

<section class="position-absolute">
    <div class="detailed_content dec">

        <?php $count = $data['count']; ?>

        <div class="heading dec"><b>Dashboard</b></div>
        <div class="display-flex-row dec">
            <div class="left dec">
                <div class="indetail dec">
                    <div class="graph dec">
                        <div class="upper dec">
                            <div class="bold dec">Ongoing Assembly</div>
                            <div><label for="vehicles" class="small">Select Vehicle</label>
                                <select name="vehicles" id="vehicles">
                                    <option value=""></option>
                                    <option value="test">Test</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart dec"><img src="../temp/graph.jpg" class="donut" alt="status graph"></div>
                        <div class="map_list dec">
                            <div class="map dec">
                                <div class="circle dec"></div>
                                <div>Done</div>
                            </div>
                            <div class="map dec">
                                <div class="circle dec"></div>
                                <div>On-going</div>
                            </div>
                        </div>
                    </div>
                    <div class="line dec"></div>
                    <div class="damages dec">
                        <div>
                            <div class="bold dec">Damaged Parts</div>
                            <div></div>
                        </div>
                        <div></div>
                    </div>
                </div>
                <div class="count dec">
                    <div class="countbox dec">
                        <div class="number dec"><?php echo $count; ?></div>
                        <div>On Assembly</div>
                    </div>
                    <div class="countbox dec">
                        <div class="number dec">10</div>
                        <div>Dispatched</div>
                    </div>
                    <div class="countbox dec">
                        <div class="number dec">2</div>
                        <div>On Hold</div>
                    </div>
                </div>
            </div>
            <div class="right dec">
                <div class="logs bold dec">
                    <div class="sidebox dec">Activity Log</div>
                    <div class="sidebox dec"></div>
                </div>
                <div class="quick bold dec">
                    <div class="sidebox dec">Quick Access</div>
                    <div class="sidebox activity_btn dec">
                        <button type="button" class="blue_button">Issue Parts</button>
                        <a href="<?php echo URL_ROOT; ?>supervisors/leaves">
                            <button type="button" class="blue_button">Leaves</button>
                        </a>
                    </div>
                </div>
                <div class="calender dec"></div>
            </div>
        </div>
    </div>
</section>

<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>