<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row justify-content-between align-items-start">
            <div class="page-heading font-weight  margin-bottom-4">
                Dispatched Vehicles
            </div>
            <div class="search-container">
                <form action="" class="search" id="search-bar">
                    
                    <div class="display-flex-row height-100 align-items-center padding-left-3">
                        
                        <div class="custom-select search-select">
                            <select name="search-type" id="search-type" class="width-100">
                                <option value="chassisNo">Chassis No</option>
                                <option value="model">Model</option>
                                <option value="showroom">Show Room</option>
                            </select>
                        </div>

                        <div class="text-gray padding-left-3 search-line"> | </div>

                        <input type="text" placeholder="Search" class="search-input" oninput="searchByKey('dispatch')" id="searchId">
                        
                    </div>

                    <div class="search-button" id="search-button">
                        <i class="ri-search-2-line search-icon"></i>
                        <i class="ri-close-line search-close"></i>
                    </div>
                </form>
            </div>
        </div>

        

        <div class="display-flex-column gap-1">
            <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
                <div class="section-heading font-weight"> Dispatch a Vehicle </div>
                <form id="add-shell">
                    <div class="display-flex-row align-items-start gap-2">
                        <div>
                            <div class="custom-select-chassis">
                                <select name="chassisNo" class="form-control form-control-blue text-blue width-rem-20" id="chassisNo">
                                    <?php
                                    echo '<option value="">Select Chassis Number</option>';
                                    if ($data['toBeDispatched'] !== false) {
                                        foreach ($data['toBeDispatched'] as $value) {
                                            echo '<option value="' . $value->ChassisNo . '">' . $value->ChassisNo . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <label class="chassisNo-label text-blue display-none" id="chassisNo-label">Chassis Type</label>
                            </div>
                        </div>
                        <div>
                            <div class="custom-select-showroom">
                                <select name="showroom" class="form-control text-gray width-rem-20" id="showroom">
                                    <option value="">Showroom</option>
                                    <option value="Colombo">Colombo</option>
                                    <option value="Gampha">Gampha</option>
                                    <option value="Kaluthara">Kaluthara</option>
                                </select>
                                <label class="showroom-label text-gray display-none" id="showroom-label">Showroom</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center margin-top-3">
                        <button class="btn btn-primary" type="button" onclick="dispatch()">
                            Dispatch
                        </button>
                    </div>

                </form>
            </div>
            <div  id="vehicleList">                                
            <?php
            if ($data['dispatchDetails'] == false) {
                echo '
                            <div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                                    <div class="font-weight">No Details</div>
                                </div>
                            ';
            } else {
                echo '<div class="display-flex-row flex-wrap justify-content-between">';
                foreach ($data['dispatchDetails'] as $value) {
                    echo '<a href="' . URL_ROOT . 'managers/dispatch/' . $value->ChassisNo . '">
                        <div class="carcard">
                                <div class="cardhead">
                                    <div class="cardid">
                                        <div class="carmodel">' . $value->ModelName . '</div>
                                        <div class="chassisno">' . $value->ChassisNo . '</div>
                                    </div>
                                </div>
                                <div class="carpicbox">
                                    <img src="' . URL_ROOT . 'public/images/cars/'. $value->ModelName . ' ' . $value->Color .'.png" class="carpic" alt="' . $value->ModelName . ' ' . $value->Color . '">
                                </div>
                                <div class="carstatus green">Show Room: '.$value->ShowRoomName.'</div>
                                <div class="arrivaldate">Release Date: '. $value->ReleaseDate. '</div>
                            </div>
                            </a>';
                }

                echo '  </div>';
            }
            ?>
            </div>
        </div>
        

    </section>

    <section class="display-flex-column">

        <div id="alert" class="hideme" role="alert"></div>

    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/dispatch.js"></script>