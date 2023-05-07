<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
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
                    <div>Assembly completed vehicles</div>
                    <div>
                        <label for="searchBox" class="display-none"></label>
                        <input type="text" id="searchBox" oninput="searchCar()" class="vehicle-searchbox" placeholder="Enter Chassis No">
                    </div>
                </div>
                <div class="vehicle-detail-board">
                    <div class="vehicle-data-board" id="carList">

                        <?php
                            foreach ($data['LineCarsSet'] as $car) {
                                echo '<form method="POST" action="'. URL_ROOT .'Supervisors/getCarInfo">
                                    <div onclick="this.closest(\'form\').submit()" class="carcard">
                                        <div class="cardhead">
                                            <div class="cardid">
                                                <div class="carmodel">'. $car->ModelName .'</div>
                                                <div class="chassisno">'. $car->ChassisNo .'</div>
                                                <input type="hidden" name="form-car-id" value="' .$car->ChassisNo. '">
                                            </div>
                                        </div>
                                        <div class="carpicbox">
                                            <img src="'.  URL_ROOT .'public/images/cars/'. $car->ModelName .' '. $car->Color .'.png" class="carpic" alt="Car image">
                                        </div>
                                        <div></div>
                                    </div>
                                </form>';
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
                                            <div class="filtertype">Inspection</div>
                                            <div class="filters">
                                                <input type="radio" id="current" name="completeness" value="CM">
                                                <label for="current">Completed</label>
                                            </div>
                                            <div class="filters">
                                                <input type="radio" id="all-time" name="completeness" value="NC">
                                                <label for="all-time">Not completed</label>
                                            </div>
                                            <div class="filters">
                                                <input type="radio" id="all-time" name="completeness" value="All" checked>
                                                <label for="all-time">All</label>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="filtertype">Status</div>
                                            <div class="filters">
                                                <input type="radio" id="acceptance" name="acceptance" value="Accepted">
                                                <label for="acceptance">Accepted</label>
                                            </div>
                                            <div class="filters">
                                                <input type="radio" id="non-acceptance" name="acceptance" value="Not accepted">
                                                <label for="non-acceptance">Not accepted</label>
                                            </div>
                                            <div class="filters">
                                                <input type="radio" id="all-tested" name="acceptance" value="All" checked>
                                                <label for="all-tested">All</label>
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


<!-- ADD COMMON FOOTER FILE -->
<script src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/fetch.js"></script>
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>