<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/notification.php'; ?>


<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="list-view-side-margins">
            <div class="databoard">
                <div class="pagehead display-flex-row justify-content-between">
                    <div>Current vehicles</div>
                    <div>
                        <label for="searchBox" class="display-none"></label>
                        <input type="text" id="searchBox" oninput="searchCar()" class="vehicle-searchbox" placeholder="Search Chassis No">
                    </div>
                </div>
                <div class="vehicle-detail-board">
                    <div class="vehicle-data-board" id="carList">

                        <?php
                        foreach ($data['LineCarsSet'] as $car) {
                            echo '<form method="POST" action="'. URL_ROOT .'Supervisors/getProgress">
                                <div class="carcard" onClick="this.closest(\'form\').submit()">
                                    <div class="cardhead">
                                        <div class="cardid">
                                            <div class="carmodel">'. (($car->ModelNo == "M0001") ? 'Micro Panda ' : (($car->ModelNo == "M0002") ? 'Micro Panda Cross ' : 'MG ZS SUV ')) .'</div>
                                            <div class="chassisno">'. ($car->ChassisNo) .'</div>
                                            <input type="hidden" name="form-car-id" value="' .$car->ChassisNo. '">
                                        </div>
                                    </div>
                                    <div class="carpicbox">
                                        <img src="'. URL_ROOT .'public/images/cars/'. (($car->ModelNo == "M0001") ? 'Micro Panda' : (($car->ModelNo == "M0002") ? 'Micro Panda Cross' : 'MG ZS SUV')) .' '. $car->Color .'.png" class="carpic" alt="Car image">
                                    </div>
                                    <div class="carstatus">';
                                        if($car->CurrentStatus == "S1") { echo 'At Stage 01'; }
                                        else if($car->CurrentStatus == "S2") { echo 'At Stage 02'; }
                                        else if($car->CurrentStatus == "S3") { echo 'At Stage 03'; }
                                        else { echo 'At Stage 04'; }
                                        echo '<input type="hidden" name="form-car-stage" value="' .$car->CurrentStatus. '">
                                    </div>
                                </div>
                            </form>';
                        }

                        if($car == NULL) {
                            echo '<div id="middler">Nothing to show!</div>';
                        }
                        ?>

                    </div>

                    <!-- THIS IS THE FILTER BOX -->
                    <div class="toolset-filterbox">
                        <div class="toolfilter">
                            <div class="filter-head">Filter by</div>
                            <div class="line"></div>
                            <div class="filters">

                                <form method="POST" action="">
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
                                            <div class="filtertype">Timeline</div>
                                            <div class="filters">
                                                <input type="radio" id="current" name="timeline" value="Current" checked>
                                                <label for="current">Current</label>
                                            </div>
                                            <div class="filters">
                                                <input type="radio" id="all-time" name="timeline" value="All">
                                                <label for="all-time">All</label>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="filtertype">Status</div>
                                            <div class="filters">
                                                <input type="radio" id="acceptance" name="acceptance" value="CM">
                                                <label for="acceptance">Accepted</label>
                                            </div>
                                            <div class="filters">
                                                <input type="radio" id="non-acceptance" name="acceptance" value="NC">
                                                <label for="non-acceptance">Not accepted</label>
                                            </div>
                                            <div class="filters">
                                                <input type="radio" id="all-tested" name="acceptance" value="All" checked>
                                                <label for="all-tested">All</label>
                                            </div>
                                        </li>

                                        <!-- <li>
                                            <div class="filtertype">Stage</div>
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
                                            <div class="filters">
                                                <input type="checkbox" id="mg" name="car-model" value="M0003" checked>
                                                <label for="mg">MG ZH SUV</label>
                                            </div>
                                        </li> -->


                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>