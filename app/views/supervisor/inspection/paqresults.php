<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section>
  <!-- THIS IS THE CONTENT DISPLAYING AREA -->
  <div class="content">
    <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
    <div class="paq-result-area">


          <div class="paq-result-header-box">
            <div class="paq-result-header-box-inner">
              <div class="paq-title">Quality Inspection - CB619256612L</div>
              <div class="paq-back-button-box">
                <button type="button" class="paq-back-button">Go back</button>
              </div>
            </div>
          </div>


          <div class="paq-result-box">
            <div class="paq-result-box-inner">

              <div class="paq-result-set-1">
                <div class="paq-result-top-area">
                  <div class="paq-result-heading">Quality Inspection results</div>
                  <div class="vertical-centralizer">
                    <div class="paq-result-checker"><b>Checked by:</b> Dinesh Perera</div>
                  </div>
                </div>

                <div class="paq-vehicle-detail-set">
                  <div class="paq-result-field">
                    <div><b>Vehicle model:</b> CR345298D4</div>
                    <div><b>Chassis No:</b> CR345298D4</div>
                    <div><b>Engine No:</b> EN562VD59J5N37</div>
                  </div>

                  <div class="paq-result-field">
                    <div><b>Checked on:</b> 2022/12/29</div>
                    <div><b>Body Colour:</b> Ruby Red</div>
                    <div><b>Colour:</b> Silver</div>
                  </div>
                </div>
              </div>



              <div class="paq-result-set-2">

                <div class="">
                  <div class="paq-results-list">
                    <div><b>Brake bleeding:</b> Normal</div>
                    <div><b>Gear Oil Level Checking:</b> Normal</div>
                    <div><b>Rack End (Adjustment Checking) :</b> Normal</div>
                    <div><b>Clutch Adjusting:</b> Need a special attention</div>
                    <div><b>Rear Axel Plate Checking:</b> Normal</div>
                    <div><b>Visual Inspection And Reporting (All Areas of Vehicles):</b> No issue founded in other areas. All the items are assembled clearly. No issues on visual components.</div>
                  </div>
                </div>

                <div class="paq-result-edit">
                  <div class="paq-results-end">
                    <div class="paq-final">Final Result: PASSED</div>
                    <div>
                      <button type="button" class="paq-result-edit-button">Edit</button>
                    </div>
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