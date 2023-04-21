<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section>
    <div class="content">
        <div class="paq-form-margin">


            <div class="paq-form-header-box">
                <div class="paq-form-heading">
                    <div class="paq-title">Quality Inspection - CB619256612L</div>
                    <div class="paq-back-button-box">
                        <button type="button" class="paq-back-button">Go back</button>
                    </div>
                </div>
                <div>
                    <div class="paq-vehicle-model">Vehicle model : CR345298D4</div>
                    <div class="chassis-no">Chassis No : CR345298D4</div>
                    <div class="engine-no">Engine No : EN562VD59J5N37</div>
                </div>
            </div>


            <div class="paq-form-box">

                <div class="paq-input-set-1">
                    <div class="paq-input-area">
                        <div class="paq-label">
                            <label for="brake_bleeding">BRAKE BLEEDING</label>
                        </div>
                        <div>
                            <input type="text" id="brake_bleeding" name="brake_bleed" class="paq-input-field-short" placeholder="Normal" autocomplete="off" required>
                        </div>
                    </div>

                    <div class=""></div>

                    <div class="">
                        <div class="paq-label">
                            <label for="gear_oil">GEAR OIL LEVEL CHECKING</label>
                        </div>
                        <div>
                            <input type="text" id="gear_oil" name="gear_oil" class="paq-input-field-short" placeholder="Normal" autocomplete="off" required>
                        </div>
                    </div>
                </div>

                <div class="paq-input-set-2">
                    <div class="">
                        <div class="paq-label">
                            <label for="rack_end">RACK END (ADJUSTMENT CHECKING)</label>
                        </div>
                        <div>
                            <input type="text" id="rack_end" name="rack_end" class="paq-input-field-short" placeholder="Need a special attention" autocomplete="off" required>
                        </div>
                    </div>

                    <div class=""> </div>

                    <div class="display-flex-column">
                        <div class="paq-label">
                            <label for="clutch">CLUTCH ADJUSTING</label>
                        </div>
                        <div>
                            <input type="text" id="clutch" name="clutch" class="paq-input-field-short" placeholder="Normal" required>
                        </div>
                    </div>
                </div>

                <div class="paq-input-set-3">
                    <div class="paq-label">
                        <label for="axel">REAR AXEL PLATE CHECKING</label>
                    </div>
                    <div>
                        <input type="text" id="axel" name="axel" class="paq-input-field-long" placeholder="Normal" required>
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


<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>