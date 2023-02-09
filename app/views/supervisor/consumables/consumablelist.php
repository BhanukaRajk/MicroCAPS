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
                        // <div class="'. ($item->Volume == NULL) ? (($item->Weight >= 60) ? 'available' : 'lower') : (($item->Volume >= 60) ? 'available' : 'lower'). '">'. (($item->Volume == NULL) ? $item->Weight : $item->Volume). '</div>
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



        <div class="consumable-popup-window display-none">
          <div class="">
            <div><button type="">Back</button></div>
          </div>
          <div class="horizontal-centralizer">
            <div>Select Availability</div>
          </div>
          <form method="POST">
            <div class="horizontal-centralizer">
              <div><input type="text"></input></div>
            </div>
            <div class="horizontal-centralizer">
              <div><select></select></div>
            </div>
            <div class="horizontal-centralizer">
              <div><button type="submit">Update</button></div>
            </div>
          </form>
          <form method="POST">
            <div class="horizontal-centralizer display-none">
              <div><input type="text"></input></div>
            </div>
            <div class="horizontal-centralizer">
              <div><button type="submit">Remove item</button></div>
            </div>
          </form>
        </div>




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
                      <!-- <input type="checkbox" id="lubricant" name="lubricant" checked>
                      <label for="lubricant">Lubricants</label> -->
                    </div>
                    <!-- <div class="filters">
                      <input type="checkbox" id="coolant" name="coolant">
                      <label for="coolant">Radiator coolants</label>
                    </div> -->
                    <div class="filters">
                      <!-- <input type="checkbox" id="grease" name="grease">
                      <label for="mg">Grease</label> -->
                      <input type="radio" id="grease" name="constype" value="Grease">
                      <label for="grease">Grease</label>
                    </div>
                    <div class="filters">
                      <input type="radio" id="gandl" name="constype" value="All">
                      <label for="gandl">All</label>
                    </div>
                  </li>

                  <!-- <li>
                    <div class="filtertype">Timeline</div>
                    <div class="filters">
                      <input type="checkbox" id="all" name="all">
                      <label for="all">All</label>
                    </div>
                    <div class="filters">
                      <input type="checkbox" id="current" name="current" >
                      <label for="current">Current</label>
                    </div>
                  </li> -->
                  <li>
                    <div class="filtertype">Status</div>
                    <div class="filters">
                      <input type="checkbox" id="available" name="available" checked>
                      <label for="available">Available</label>
                    </div>
                    <div class="filters">
                      <input type="checkbox" id="lowst" name="lowst" checked>
                      <label for="lowst">Low in stock</label>
                    </div>
                    <div class="filters filter-btn">
                      <div><button type="submit" id="filtering" name="submit" class="filter-button">Search</button></div>
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