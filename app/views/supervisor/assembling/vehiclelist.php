<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section class="listsection">
    <div class="datawall">
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

                    <!-- <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">', ($car->ModelNo == "M0001") ? 'Micro Panda' : (($car->ModelNo == "M0002") ? 'Micro Panda Cross' : 'MG ZS SUV'),'</div>
                                <div class="chassisno">' , $car->ChassisNo , '</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle ', ($item->volume == NULL) ? (($item->weight >= 100) ? 'status-green-circle' : 'status-orange-circle') : (($item->volume >= 100) ? 'status-green-circle' : 'status-orange-circle'), ' "></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="' . URL_ROOT . 'public/images/cars/' . ($car->ModelNo == " M0001") ? 'Micro Panda ' : (($car->ModelNo == "M0002") ? 'Micro Panda Cross ' : 'MG ZS SUV ') . ''.$car->Color.'" class="carpic" alt="Car image">
                        </div>
                        <div class="carstatus ', ($item->volume == NULL) ? (($item->weight >= 100) ? 'available' : 'lower') : (($item->volume >= 100) ? 'available' : 'lower'), '">', ($item->volume == NULL) ? (($item->weight > 100) ? 'Available' : 'Low in stock') : (($item->volume > 100) ? 'Available' : 'Low in stock'), '</div>
                        <div class="chassisno">Last update: ', $item->last_update, '</div>
                    </div> -->

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda Cross</div>
                                <div class="chassisno">CN112150768A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Cross Red.png" class="carpic" alt="micro panda black">
                        </div>
                        <div class="carstatus">Not Inspected</div>
                    </div>

                    

                </div>

                <div class="thisfilter">
                    <div class="filterbox">
                        <div class="filterin">Filter by</div>
                        <div class="">
                            <hr>
                        </div>
                        <div class="">
                            <ul id="consume_filter">

                                <li>
                                    <div class="filtertype">Vehicle Type</div>
                                    <div class="filters">
                                        <input type="checkbox" id="enoil" name="enoil" checked>
                                        <label for="enoil">Micro Panda</label>
                                    </div>
                                    <div class="filters">
                                        <input type="checkbox" id="coolant" name="coolant">
                                        <label for="coolant">Panda Cross</label>
                                    </div>
                                    <div class="filters">
                                        <input type="checkbox" id="grease" name="grease">
                                        <label for="mg">MG ZH SUV</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="filtertype">Timeline</div>
                                    <div class="filters">
                                        <input type="radio" id="all" name="timeline-filter" value="all" checked>
                                        <label for="all">All</label>
                                    </div>
                                    <div class="filters">
                                        <input type="radio" id="current" name="timeline-filter" value="current">
                                        <label for="current">Current</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="filtertype">Status</div>
                                    <div class="filters">
                                        <input type="checkbox" id="available" name="available" checked>
                                        <label for="available">Accepted</label>
                                    </div>
                                    <div class="filters">
                                        <input type="checkbox" id="lowst" name="lowst" checked>
                                        <label for="lowst">Not accepted</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- ADD COMMON FOOTER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>