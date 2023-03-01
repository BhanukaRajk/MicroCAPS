<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section class="listsection">
  <div class="datawall">
    <div class="databoard">
      <div class="pagehead">
        <div>Consumables</div>
        <!-- <div>Add new</div> -->
      </div>
      <div class="vehicle-detail-board">
        <div class="vehicle-data-board">

          <?php
          foreach ($data['consumableset'] as $item) {
            echo '<div class="carcard" onclick="expandConsumable()">
                    <div class="cardhead">
                      <div class="cardid">
                        <div class="carmodel">', $item->ConsumableName, '</div>
                        <div class="chassisno">', ($item->Volume == NULL) ? 'Grease' : 'Lubricants', '</div>
                      </div>
                      <div class="carstatuscolor">
                        <div class="status-circle ', ($item->Volume == NULL) ? (($item->Weight >= 60) ? 'status-green-circle' : 'status-orange-circle') : (($item->Volume >= 60) ? 'status-green-circle' : 'status-orange-circle'), ' "></div>
                      </div>
                    </div>
                    <div class="carpicbox">
                      <img src="' . URL_ROOT . 'public/images/consumables/' . $item->Image . '" class="carpic" alt="micro panda red">
                    </div>
                    <div class="carstatus ', ($item->Volume == NULL) ? (($item->Weight >= 60) ? 'available' : 'lower') : (($item->Volume >= 60) ? 'available' : 'lower'), '">', ($item->Volume == NULL) ? (($item->Weight >= 60) ? 'Available' : 'Low in stock') : (($item->Volume >= 60) ? 'Available' : 'Low in stock'), '</div>
                    <div class="chassisno">Last update: ', $item->LastUpdate, '</div>
                  </div>';
          }


          // DISPLAY THIS IF THERE IS NO DATA IN THE TABLE
          if ($item == NULL) {
            echo '<div class="no-data horizontal-centralizer"><div class="margin-top-5">Nothing to show :(</div></div>';
          }

          ?>

        </div>





        <!-- THIS IS THE FILTER BOX -->
        <div class="thisfilter">
          <div class="filterbox">
            <div class="filterin">Filter by</div>
            <div class="line"></div>
            <div class="">
              <form method="POST" action="">
                <ul id="consume_filter">

                  <li>
                    <div class="filtertype">Consumable Type</div>
                    <div class="filters">
                      <input type="radio" id="lubricant" name="constype" value="Lubricants">
                      <label for="lubricant">Lubricants</label>
                    </div>
                    <div class="filters">
                      <input type="radio" id="grease" name="constype" value="Grease">
                      <label for="grease">Grease</label>
                    </div>
                    <div class="filters">
                      <input type="radio" id="gandl" name="constype" value="All" checked>
                      <label for="gandl">All</label>
                    </div>
                  </li>

                  <li>
                    <div class="filtertype">Status</div>
                    <div class="filters">
                      <input type="radio" id="available" name="stockstate" value="Available">
                      <label for="available">Available</label>
                    </div>
                    <div class="filters">
                      <input type="radio" id="lowst" name="stockstate" value="Low">
                      <label for="lowst">Low in stock</label>
                    </div>
                    <div class="filters">
                      <input type="radio" id="stockall" name="stockstate" value="All" checked>
                      <label for="gandl">All</label>
                    </div>
                    <div class="filters filter-btn margin-top-5">
                      <div><button type="submit" id="filtering" name="submit" class="filter-button">Search</button></div>
                    </div>
                  </li>
                </ul>
              </form>
            </div>
          </div>
        </div>




        <!-- THIS IS THE POP UP BOX FOR CONSUMABLE UPDATES AND DELETIONS -->
        <div class="background-blurer" id="popupWindow">
          <div class="consumable-detail-popup position-fixed">

            <div class="popup-left">
              <div class="horizontal-centralizer cs-popup-csname">
                <div>MOTUL 3000 4T Plus</div>
              </div>
              <div class="horizontal-centralizer">
                <div class="">
                  <img class="consumable-popup-img" src="<?php echo URL_ROOT; ?>public/images/consumables/image1.png" class="carpic" alt="Consumable">
                </div>
              </div>
              <div class="horizontal-centralizer">
                <div>Current Stock: 5 Liters</div>
              </div>
            </div>

            <div class="border-div"></div>
            <div class="popup-right">
              <div class="horizontal-centralizer">
                <div class="popup-box-heading1 margin-top-4">Update stock</div>
              </div>

              <div class="horizontal-centralizer last-update margin-top-3">
                <div>Last update: 10 February 2023 at 12.25 PM</div>
              </div>

              <div class="horizontal-centralizer margin-top-4">
                <div>

                  <input type="number" id="lastname" name="lastname" onChange="" class="form-control form-control-blue text-fontgray width-rem-15" placeholder="Lastname" />
                  <label class="form-label blue">Current stock <?php echo (NULL == NULL) ? '(Litres)' : '(Kgs)'; ?></label>

                  <!-- <?php //echo ($item['weight'] == NULL) ? 'L' : 'Kg' ;
                        ?> -->

                </div>
              </div>
              <form method="POST">
                <div class="display-flex-row justify-content-center margin-top-2">
                  <div><button type="submit" class="edit-button consume-update">Update</button></div>
                </div>
              </form>
              <form method="POST">
                <div class="display-flex-row justify-content-center marginy-3">
                  <div><button type="submit" class="delete-button consume-update">Remove item</button></div>
                </div>
              </form>
              <div class="display-flex-row justify-content-center margin-top-2">
                <div><a onclick="closePopup()" class="mouse-pointer">Close</a></div>
              </div>
            </div>
          </div>
        </div>




      </div>
    </div>
  </div>
  </div>
</section>


<!-- ADD COMMON FOOTER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>