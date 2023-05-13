<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<!-- GET DATA FROM CONTROLLER -->
<?php $test_data = $data['FormCarData']; ?>

<section>
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div class="paq-form-margin">


            <div class="paq-form-head">
                <div class="paq-form-heading">
                    <div class="form-title">Quality Inspection - <?php echo $test_data->ChassisNo; ?></div>
                    <div class="vehicle-model">Vehicle model : <?php echo $test_data->ModelName; ?></div>
                    <div class="chassis-no">Chassis No : <?php echo $test_data->ChassisNo; ?></div>
                    <div class="engine-no">Engine No : <?php echo $test_data->EngineNo; ?></div>    
                </div>
                <div class="paq-back-button-box">
                    <button onclick="GoBack()" type="button" class="back-button">Go back</button>
                </div>
            </div>


            <div class="paq-form-box">

                <div class="paq-input-set-1">
                    <div class="paq-input-area">
                        <div class="paq-label">
                            <label for="brake_bleeding">BRAKE BLEEDING</label>
                        </div>
                        <div>
                            <!-- <input type="text" id="brake_bleeding" name="brake_bleed" class="paq-input-field-short" placeholder="Normal" autocomplete="off" required> -->
                            <select name="brake-bleed-selection" id="brake-bleed-selection" class="paq-input-field-short">
                                <option class="" disabled selected value>- Select status -</option>
                                <option value="Normal">Normal</option>
                                <option value="NA">Need an attention</option>
                            </select>
                        </div>
                    </div>

                    <div> </div>

                    <div class="">
                        <div class="paq-label">
                            <label for="gear_oil">GEAR OIL LEVEL CHECKING</label>
                        </div>
                        <div>
                            <!-- <input type="text" id="gear_oil" name="gear_oil" class="paq-input-field-short" placeholder="Normal" autocomplete="off" required> -->
                            <select name="gear-oil-selection" id="gear-oil-selection" class="paq-input-field-short">
                                <option class="" disabled selected value>- Select status -</option>
                                <option value="Normal">Normal</option>
                                <option value="NA">Need an attention</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="paq-input-set-2">
                    <div class="paq-input-area">
                        <div class="paq-label">
                            <label for="rack_end">RACK END (ADJUSTMENT CHECKING)</label>
                        </div>
                        <div>
                            <!-- <input type="text" id="rack_end" name="rack_end" class="paq-input-field-short" placeholder="Need a special attention" autocomplete="off" required> -->
                            <select name="rack-end-selection" id="rack-end-selection" class="paq-input-field-short">
                                <option class="" disabled selected value>- Select status -</option>
                                <option value="Normal">Normal</option>
                                <option value="NA">Need an attention</option>
                            </select>
                        </div>
                    </div>

                    <div> </div>

                    <div class="display-flex-column">
                        <div class="paq-label">
                            <label for="clutch">CLUTCH ADJUSTING</label>
                        </div>
                        <div>
                            <!-- <input type="text" id="clutch" name="clutch" class="paq-input-field-short" placeholder="Normal" required> -->
                            <select name="clutch-selection" id="clutch-selection" class="paq-input-field-short">
                                <option class="" disabled selected value>- Select status -</option>
                                <option value="Normal">Normal</option>
                                <option value="NA">Need an attention</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="paq-input-set-3">
                    <div class="paq-label">
                        <label for="axel">REAR AXEL PLATE CHECKING</label>
                    </div>
                    <div>
                        <!-- <input type="text" id="axel" name="axel" class="paq-input-field-long" placeholder="Normal" required> -->
                        <select name="axel-selection" id="axel-selection" class="paq-input-field-long">
                                <option class="" disabled selected value>- Select status -</option>
                                <option value="Normal">Normal</option>
                                <option value="NA">Need an attention</option>
                        </select>
                    </div>
                </div>

                <div class="paq-input-set-4">
                    <div class="paq-label">
                        <label for="visual">VISUAL INSPECTION AND REPORTING (ALL AREAS OF VEHICLES)</label>
                    </div>
                    <div>
                        <textarea id="visual" name="visual" class="paq-input-field-long tall-input-1" placeholder="All of the visual components are in good condition" required></textarea>
                    </div>
                </div>

                <div class="paq-input-set-5">
                    <div class="paq-label vertical-centralizer">
                        <div class=""><label for="visual">FINAL RESULT</label></div>
                    </div>
                    <div>
                        <input type="radio" id="option1" name="options" value="Passed">
                        <label for="option1">Passed</label>
                    </div>
                    <div>
                        <input type="radio" id="option2" name="options" value="Failed">
                        <label for="option2">Failed</label>
                    </div>
                </div>

                <div class="paq-input-set-6">
                    <div>
                        <button type="button" class="paq-reset-button">Reset</button>
                    </div>
                    <div>
                        <button type="button" class="paq-submit-button">Submit</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<script src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/paqrecord.js"></script>

<!-- ADD COMMON FOOTER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>