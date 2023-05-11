<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row justify-content-between  align-items-start">
            <div class="page-heading font-weight  margin-bottom-4">
                Pre Delivery Inspection
            </div>
            <div class="search-container">
                <form action="" class="search" id="search-bar">
                    
                    <div class="display-flex-row height-100 align-items-center padding-left-3">
                        
                        <div class="custom-select search-select">
                            <select name="search-type" id="search-type" class="width-100">
                                <option value="chassisNo">Chassis No</option>
                                <option value="model">Model</option>
                                <option value="tester">Tester</option>
                            </select>
                        </div>

                        <div class="text-gray padding-left-3 search-line"> | </div>

                        <input type="text" placeholder="Search" class="search-input" oninput="searchByKey('pdi')" id="searchId">
                        
                    </div>

                    <div class="search-button" id="search-button">
                        <i class="ri-search-2-line search-icon"></i>
                        <i class="ri-close-line search-close"></i>
                    </div>
                </form>
            </div>
        </div>

        <div  id="vehicleList">
            <?php
            if ($data['onPDIVehicles'] == false) {
                echo '
                            <div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                                    <div class="font-weight">No Details</div>
                                </div>
                            ';
            } else {
                echo '<div class="display-flex-row flex-wrap justify-content-between">';
                foreach ($data['onPDIVehicles'] as $value) {

                    if ($value->TesterId == 'NA') {
                        $word = 'Not Started';
                        $css = 'red';
                    } else {
                        if ($value->PDIStatus == 'NC') {
                            $word = 'In Progress';
                            $css = 'orange';
                        } else {
                            $word = 'Completed';
                            $css = 'green';
                        }
                    }

                    echo '<a href="' . URL_ROOT . 'managers/pdi/' . $value->ChassisNo . '">
                                <div class="carcard">
                                    <div class="cardhead">
                                        <div class="cardid">
                                            <div class="carmodel">' . $value->ModelName . '</div>
                                            <div class="chassisno">' . $value->ChassisNo . '</div>
                                        </div>
                                        <div class="toolstatuscolor">
                                            <div class="status-circle status-'.$css.'-circle"></div>
                                        </div>
                                    </div>
                                    <div class="carpicbox">
                                        <img src="' . URL_ROOT . 'public/images/cars/'. $value->ModelName . ' ' . $value->Color .'.png" class="carpic" alt="' . $value->ModelName . ' ' . $value->Color . '">
                                    </div>
                                    <div class="carstatus '.$css.'"> '.$word.' </div>
                                    <div class="arrivaldate">Stage: PDI </div>
                                </div>';
                }

                echo '</div>';
            }
            ?>
        </div>

    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>