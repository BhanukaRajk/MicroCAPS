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
                <div class="pagehead">Current vehicles</div>
                <div class="vehicle-detail-board">
                    <div class="vehicle-data-board">

                        <?php
                        foreach ($data['LineCarsSet'] as $car) {
                            echo '<div class="carcard">
                                <div class="cardhead">
                                    <div class="cardid">
                                        <div class="carmodel">' , ($car->ModelNo == "M0001") ? 'Micro Panda ' : (($car->ModelNo == "M0002") ? 'Micro Panda Cross ' : 'MG ZS SUV ') , '</div>
                                        <div class="chassisno">' ,$car->ChassisNo, '</div>
                                    </div>
                                </div>
                                <div class="carpicbox">
                                    <img src="' , URL_ROOT , 'public/images/cars/' , ($car->ModelNo == "M0001") ? 'Micro Panda ' : (($car->ModelNo == "M0002") ? 'Micro Panda Cross ' : 'MG ZS SUV ') , '' , $car->Color , '.png" class="carpic" alt="Car image">
                                </div>
                                <div></div>
                            </div>';
                            // print_r($car);
                            //echo $item->consumable_id;
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
                                                <input type="checkbox" id="micro-panda" name="micro-panda" checked>
                                                <label for="micro-panda">Micro Panda</label>
                                            </div>
                                            <div class="filters">
                                                <input type="checkbox" id="panda-cross" name="panda-cross">
                                                <label for="panda-cross">Panda Cross</label>
                                            </div>
                                            <div class="filters">
                                                <input type="checkbox" id="mg" name="mg">
                                                <label for="mg">MG ZH SUV</label>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="filtertype">Timeline</div>
                                            <div class="filters">
                                                <input type="radio" id="current" name="current" value="Current" checked>
                                                <label for="current">Current</label>
                                            </div>
                                            <div class="filters">
                                                <input type="radio" id="all-time" name="all-time" value="All">
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
                                                <input type="radio" id="non-acceptance" name="non-acceptance" value="Not accepted">
                                                <label for="non-acceptance">Not accepted</label>
                                            </div>
                                            <div class="filters">
                                                <input type="radio" id="all-tested" name="all-tested" value="All" checked>
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