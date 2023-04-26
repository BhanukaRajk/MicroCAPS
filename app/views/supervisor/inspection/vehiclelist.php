<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section class="listsection">
    <div class="datawall">
        <div class="databoard">
            <div class="pagehead">Assembly completed vehicles</div>
            <div class="vehicle-detail-board">
                <div class="vehicle-data-board">

                    <?php
                    foreach ($data['S4Finishers'] as $car) {
                        echo '<div class="carcard">
                                <div class="cardhead">
                                    <div class="cardid">
                                        <div class="carmodel">', $car->consumable_name, '</div>
                                        <div class="chassisno">', ($car->volume == NULL) ? 'Grease' : 'Lubricants', '</div>
                                    </div>
                                    <div class="carstatuscolor">
                                        <div class="status-circle ', ($car->volume == NULL) ? (($car->volume > 100) ? 'status-green-circle' : 'status-orange-circle') : (($car->weight > 100) ? 'status-green-circle' : 'status-orange-circle'), ' "></div>
                                    </div>
                                </div>
                                <div class="carpicbox">
                                    <img src="' . URL_ROOT . 'public/images/consumables/' . $car->image . '" class="carpic" alt="micro panda red">
                                </div>
                                <div class="carstatus ', ($car->volume == NULL) ? (($car->volume > 100) ? 'available' : 'lower') : (($car->weight > 100) ? 'available' : 'lower'), '">', ($car->volume == NULL) ? (($car->volume > 100) ? 'Available' : 'Low in stock') : (($car->weight > 100) ? 'Available' : 'Low in stock'), '</div>
                                <div class="chassisno">Last update: ', $car->last_update, '</div>
                            </div>';
                        //print_r($car);
                        //echo $car->consumable_id;
                    }
                    ?>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112150768A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-green-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Black.png" class="carpic" alt="micro panda black">
                        </div>
                        <div class="carstatus">Ready</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112215000A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Blue.png" class="carpic" alt="micro panda blue">
                        </div>
                        <div class="carstatus">Not Ready</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112215000A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Cross Green.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Not Ready</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112745594A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Blue.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Not Ready</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112881202A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-green-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro%20Panda%20Cross%20Blue.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Ready</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112910320A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-green-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda White.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Ready</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112902287A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Red.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Not Ready</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112087629A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-green-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Yellow.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Ready</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112767681A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-green-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Black.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Ready</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112142532A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-green-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Green.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Ready</div>
                    </div>

                    <a href="DON'T CLICK HERE">
                        <div class="carcard">
                            <div class="cardhead">
                                <div class="cardid">
                                    <div class="carmodel">Micro Panda</div>
                                    <div class="chassisno">CN112297310A</div>
                                </div>
                                <div class="carstatuscolor">
                                    <div class="status-circle status-orange-circle"></div>
                                </div>
                            </div>
                            <div class="carpicbox">
                                <img src="<?php echo URL_ROOT; ?>public/images/cars/MG ZS SUV Blue.png" class="carpic" alt="micro panda green">
                            </div>
                            <div class="carstatus">Not Ready</div>
                        </div>
                    </a>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">MG ZS SUV</div>
                                <div class="chassisno">CN112764853A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/MG ZS SUV Black.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Not Ready</div>
                    </div>

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
</section>


<!-- ADD COMMON FOOTER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>