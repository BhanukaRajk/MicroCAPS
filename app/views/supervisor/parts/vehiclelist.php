<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="list-view-side-margins">
            <div class="databoard">
                <div class="pagehead display-flex-row justify-content-between">
                    <div>Assembly line car components</div>
                    <div>
                        <label for="searchBox" class="display-none"></label>
                        <input type="text" id="searchBox" oninput="searchCar()" class="vehicle-searchbox" placeholder="Search Chassis No">
                    </div>
                </div>
                <div class="vehicle-detail-board">
                    <div class="vehicle-data-board" id="carList">

                        <?php

                        if ($data['CarComp'])  {
                            foreach ($data['CarComp'] as $CAR) {
                                echo '<form method="POST" action="' . URL_ROOT . 'Supervisors/componentsView"><div onclick="this.closest(\'form\').submit()" class="carcard">
                                    <div class="cardhead">
                                        <div class="cardid">
                                            <div class="carmodel">' . $CAR->ModelName . '</div>
                                            <div class="chassisno">' . $CAR->ChassisNo . '</div>
                                            <input type="hidden" name="form-car-id" value="' . $CAR->ChassisNo . '">
                                        </div>
                                        <div class="carstatuscolor">
                                            <div class="status-circle '. (($CAR->CurrentStatus == "H") ? "status-orange-circle" : "status-green-circle") .'"></div>
                                        </div>
                                    </div>
                                    <div class="carpicbox">
                                        <img src="' . URL_ROOT . 'public/images/cars/' . $CAR->ModelName . ' ' . $CAR->Color . '.png" class="carpic" alt="' . $CAR->ModelName . ' ' . $CAR->Color . '">
                                    </div>
                                    <div class="carstatus">';
                                    
                                    if($CAR->CurrentStatus == "S1") { echo 'Stage 01'; }
                                    else if($CAR->CurrentStatus == "S2") { echo 'Stage 02'; }
                                    else if($CAR->CurrentStatus == "S3") { echo 'Stage 03'; }
                                    else if($CAR->CurrentStatus == "S4") { echo 'Stage 04'; }
                                    else { echo 'On-Hold'; }
                                    
                                    echo '</div>
                                </div></form>';
                            }
                        } else {
                            echo '<div class="no-data horizontal-centralizer">
                                    <div class="margin-top-5 vertical-centralizer">
                                        <div> Nothing to show :( </div>
                                        <div>
                                            <img src="'. URL_ROOT .'public/images/common/no_data.png" class="no-data-icon" alt="No Data">
                                        </div>
                                    </div>
                                </div>';
                        }
                        ?>

                    </div>

                    <!-- THIS IS THE FILTER BOX -->
                    <div class="toolset-filterbox">
                        <div class="toolfilter">
                            <div class="filter-head">Filter by</div>
                            <div class="line"></div>
                            <div class="filters">

                                <ul id="consume_filter">

                                    <li>
                                        <div class="filtertype">Vehicle Type</div>
                                        <div class="filters">
                                            <input type="checkbox" id="micro-panda" name="car-model" value="M0001" checked>
                                            <label for="micro-panda">Micro Panda</label>
                                        </div>
                                        <div class="filters">
                                            <input type="checkbox" id="panda-cross" name="car-model" value="M0002" checked>
                                            <label for="panda-cross">Panda Cross</label>
                                        </div>
                                        <div class="filters">
                                            <input type="checkbox" id="mg" name="car-model" value="M0003" checked>
                                            <label for="mg">MG ZH SUV</label>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="filtertype">Stage</div>
                                        <div class="filters">
                                            <input type="checkbox" id="stage-1" name="car-stage" value="S1" checked>
                                            <label for="stage-1">At Stage 01</label>
                                        </div>
                                        <div class="filters">
                                            <input type="checkbox" id="stage-2" name="car-stage" value="S2" checked>
                                            <label for="stage-2">At Stage 02</label>
                                        </div>
                                        <div class="filters">
                                            <input type="checkbox" id="stage-3" name="car-stage" value="S3" checked>
                                            <label for="stage-3">At Stage 03</label>
                                        </div>
                                        <div class="filters">
                                            <input type="checkbox" id="stage-4" name="car-stage" value="S4" checked>
                                            <label for="stage-4">At Stage 04</label>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="filtertype">Progress</div>
                                        <div class="filters">
                                            <input type="radio" id="inprogress" name="progress" value="inprogress" checked>
                                            <label for="inprogress">In progress</label>
                                        </div>
                                        <div class="filters">
                                            <input type="radio" id="all-cars" name="progress" value="All">
                                            <label for="all-cars">All</label>
                                        </div>

                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/components.js"></script>

<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>