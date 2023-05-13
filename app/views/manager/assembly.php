<?php require_once APP_ROOT . '\views\manager\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\manager\includes\navbar.php'; ?>

<body>

    <section class="position-absolute page-content">
        <div class="display-flex-row justify-content-between  align-items-start">
            <div class="page-heading font-weight  margin-bottom-4">
                On Assembly Vehicles
            </div>
            <div class="search-container">
                <form action="" class="search" id="search-bar">
                    
                    <div class="display-flex-row height-100 align-items-center padding-left-3">
                        
                        <div class="custom-select search-select">
                            <select name="search-type" id="search-type" class="width-100">
                                <option value="chassisNo">Chassis No</option>
                                <option value="model">Model</option>
                            </select>
                        </div>

                        <div class="text-gray padding-left-3 search-line"> | </div>

                        <input type="text" placeholder="Search" class="search-input" oninput="searchByKey('assembly')" id="searchId">
                        
                    </div>

                    <div class="search-button" id="search-button">
                        <i class="ri-search-2-line search-icon"></i>
                        <i class="ri-close-line search-close"></i>
                    </div>
                </form>
            </div>
        </div>
        
        <div  id="vehicleList">
        <!-- <div class="display-flex-column align-items-start margin-top-3"> -->
            <?php
            if ($data['assemblyDetails'] == false) {
                echo '
                            <div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                                    <div class="font-weight">No Details</div>
                                </div>
                            ';
            } else {
                echo '<div class="display-flex-row flex-wrap justify-content-between">';
                
                function stage($str) {

                    if ($str == 'S1') {
                        return 'Stage 01';
                    } else if ($str == 'S2') {
                        return 'Stage 02';
                    } else if ($str == 'S3') {
                        return 'Stage 03';
                    } else if ($str == 'S4') {
                        return 'Stage 04';
                    } else {
                        return false;
                    }

                }

                foreach ($data['assemblyDetails'] as $key => $value) {

                    $word = 'On Assembly';
                    $css = 'green';

                    $CurrentStatus = stage($value->CurrentStatus);

                    if ($CurrentStatus == false) {
                        $CurrentStatus = stage($data['holdStage'][$key]->StageNo);
                        $word = 'On Hold';
                        $css = 'red';
                    }

                    echo '<a href="' . URL_ROOT . 'managers/assembly/' . $value->ChassisNo . '">
                                <div class="carcard">
                                    <div class="cardhead">
                                        <div class="cardid">
                                            <div class="carmodel">' . $value->ModelName . '</div>
                                            <div class="chassisno">' . $value->ChassisNo . '</div>
                                        </div>
                                        <div class="toolstatuscolor">
                                            <div class="status-circle status-' . $css . '-circle"></div>
                                        </div>
                                    </div>
                                    <div class="carpicbox">
                                        <img src="' . URL_ROOT . 'public/images/cars/'. $value->ModelName . ' ' . $value->Color .'.png" class="carpic" alt="' . $value->ModelName . ' ' . $value->Color . '">
                                    </div>
                                    <div class="carstatus '.$css.'"> '.$word.' </div>
                                    <div class="arrivaldate">Stage: '. $CurrentStatus . '</div>
                                </div></a>';
                }

                echo '</div>';
            }
            ?>
        </div>

    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/managerjs/cors.js"></script>