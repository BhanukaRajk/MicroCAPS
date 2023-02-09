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
                    foreach ($data['consumableset'] as $item) {
                        echo '<div class="carcard">
                            <div class="cardhead">
                                <div class="cardid">
                                    <div class="carmodel">', $item->consumable_name, '</div>
                                    <div class="chassisno">', ($item->volume == NULL) ? 'Grease' : 'Lubricants', '</div>
                                </div>
                                <div class="carstatuscolor">
                                    <div class="status-circle ', ($item->volume == NULL) ? (($item->weight >= 100) ? 'status-green-circle' : 'status-orange-circle') : (($item->volume >= 100) ? 'status-green-circle' : 'status-orange-circle'), ' "></div>
                                </div>
                            </div>
                            <div class="carpicbox">
                                <img src="' . URL_ROOT . 'public/images/consumables/' . $item->image . '" class="carpic" alt="micro panda red">
                            </div>
                            <div class="carstatus ', ($item->volume == NULL) ? (($item->weight >= 100) ? 'available' : 'lower') : (($item->volume >= 100) ? 'available' : 'lower'), '">', ($item->volume == NULL) ? (($item->weight > 100) ? 'Available' : 'Low in stock') : (($item->volume > 100) ? 'Available' : 'Low in stock'), '</div>
                            <div class="chassisno">Last update: ', $item->last_update, '</div>
                        </div>';
                        //print_r($item);
                        //echo $item->consumable_id;
                    }

                    // if($item == NULL) {
                    //     echo '<div id="middler">Nothing to show!</div>';
                    // }
                    ?>

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

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112215000A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-green-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Red.png" class="carpic" alt="micro panda red">
                        </div>
                        <div class="carstatus">Inspected</div>
                    </div>

                    <a href="DON'T CLICK HERE">
                        <div class="carcard">
                            <div class="cardhead">
                                <div class="cardid">
                                    <div class="carmodel">Micro Panda</div>
                                    <div class="chassisno">CN112745594A</div>
                                </div>
                                <div class="carstatuscolor">
                                    <div class="status-circle status-green-circle"></div>
                                </div>
                            </div>
                            <div class="carpicbox">
                                <img src="<?php echo URL_ROOT; ?>public/images/cars/MG ZS SUV Blue.png" class="carpic" alt="micro panda green">
                            </div>
                            <div class="carstatus">Stage 01</div>
                        </div>
                    </a>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112881202A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Black.png" class="carpic" alt="micro panda black">
                        </div>
                        <div class="carstatus">Not Inspected</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112910320A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Blue.png" class="carpic" alt="micro panda blue">
                        </div>
                        <div class="carstatus">Not Inspected</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112902287A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-green-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Cross Green.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Inspected</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112087629A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Blue.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Not Inspected</div>
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
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro%20Panda%20Cross%20Blue.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Inspected</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112142532A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda White.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Not Inspected</div>
                    </div>

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
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Red.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Not Inspected</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112764853A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-green-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Yellow.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Inspected</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112109283A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Black.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Not Inspected</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">Micro Panda</div>
                                <div class="chassisno">CN112875209Q</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-green-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/Micro Panda Green.png" class="carpic" alt="micro panda green">
                        </div>
                        <div class="carstatus">Inspected</div>
                    </div>

                    <div class="carcard">
                        <div class="cardhead">
                            <div class="cardid">
                                <div class="carmodel">MG ZS SUV</div>
                                <div class="chassisno">CG112876543A</div>
                            </div>
                            <div class="carstatuscolor">
                                <div class="status-circle status-orange-circle"></div>
                            </div>
                        </div>
                        <div class="carpicbox">
                            <img src="<?php echo URL_ROOT; ?>public/images/cars/MG ZS SUV Black.png" class="carpic" alt="micro panda green">
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