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
                    <div>Assembly completed vehicles</div>
                    <div>
                        <label for="searchBox" class="display-none"></label>
                        <input type="text" id="searchBox" oninput="searchCar()" class="vehicle-searchbox" placeholder="Search Chassis No">
                    </div>
                </div>
                <div class="vehicle-detail-board">
                    <div class="vehicle-data-board" id="carList">

                        <?php
                        foreach ($data['CarComp'] as $CAR) {
                            echo '<form method="POST" action="'. URL_ROOT .'Supervisors/componentsView"><div onclick="this.closest(\'form\').submit()" class="carcard">
                                <div class="cardhead">
                                    <div class="cardid">
                                        <div class="carmodel">'. $CAR->ModelName .'</div>
                                        <div class="chassisno">'. $CAR->ChassisNo .'</div>
                                        <input type="hidden" name="form-car-id" value="' .$CAR->ChassisNo. '">
                                    </div>
                                    <div class="carstatuscolor">
                                        <div class="status-circle status-orange-circle"></div>
                                    </div>
                                </div>
                                <div class="carpicbox">
                                    <img src="' . URL_ROOT . 'public/images/cars/'. $CAR->ModelName .' '. $CAR->Color .'.png" class="carpic" alt="'. $CAR->ModelName .' '. $CAR->Color .'">
                                </div>
                                <div class="carstatus">Not Inspected</div>
                            </div></form>';
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
                                                <input type="checkbox" id="micro-panda" name="car-model" checked>
                                                <label for="micro-panda">Micro Panda</label>
                                            </div>
                                            <div class="filters">
                                                <input type="checkbox" id="panda-cross" name="car-model">
                                                <label for="panda-cross">Panda Cross</label>
                                            </div>
                                            <div class="filters">
                                                <input type="checkbox" id="mg" name="car-model">
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