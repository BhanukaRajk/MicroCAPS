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
            echo '<div class="carcard">
                    <div class="cardhead">
                      <div class="cardid">
                        <div class="carmodel">' , $item->consumable_name , '</div>
                        <div class="chassisno">' , ($item->volume == NULL) ? 'Grease' : 'Lubricants'  , '</div>
                      </div>
                      <div class="carstatuscolor">
                        <div class="status-circle ' , ($item->volume == NULL) ? (($item->volume > 100) ? 'status-green-circle' : 'status-orange-circle') : (($item->weight > 100) ? 'status-green-circle' : 'status-orange-circle')  , ' "></div>
                      </div>
                    </div>
                    <div class="carpicbox">
                      <img src="' . URL_ROOT . 'public/images/consumables/'.$item->image.'" class="carpic" alt="micro panda red">
                    </div>
                    <div class="carstatus ' , ($item->volume == NULL) ? (($item->volume > 100) ? 'available' : 'lower') : (($item->weight > 100) ? 'available' : 'lower')  , '">' , ($item->volume == NULL) ? (($item->volume > 100) ? 'Available' : 'Low in stock') : (($item->weight > 100) ? 'Available' : 'Low in stock')  , '</div>
                    <div class="chassisno">Last update: ' , $item->last_update, '</div>
                  </div>';
            //print_r($item);
            //echo $item->consumable_id;
          }
          ?>

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
                  <div class="filtertype">Consumable Type</div>
                  <div class="filters">
                    <input type="checkbox" id="enoil" name="enoil" checked>
                    <label for="enoil">Engine Oil</label>
                  </div>
                  <div class="filters">
                    <input type="checkbox" id="coolant" name="coolant">
                    <label for="coolant">Radiator coolants</label>
                  </div>
                  <div class="filters">
                    <input type="checkbox" id="grease" name="grease">
                    <label for="mg">Grease</label>
                  </div>
                </li>

                <li>
                  <div class="filtertype">Timeline</div>
                  <div class="filters">
                    <input type="checkbox" id="all" name="all">
                    <label for="all">All</label>
                  </div>
                  <div class="filters">
                    <input type="checkbox" id="current" name="current">
                    <label for="current">Current</label>
                  </div>
                </li>
                <li>
                  <div class="filtertype">Status</div>
                  <div class="filters">
                    <input type="checkbox" id="available" name="available">
                    <label for="available">Available</label>
                  </div>
                  <div class="filters">
                    <input type="checkbox" id="lowst" name="lowst">
                    <label for="lowst">Low in stock</label>
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