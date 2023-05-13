<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/notification.php'; ?>


<section>
  <!-- THIS IS THE CONTENT DISPLAYING AREA -->
  <div class="content">
    <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
<!--    <div class="list-view-side-margins">-->
      <div class="toolset-margin">
      <div class="databoard">

        <div class="toolset-head">
          <div class="toolset-heading">Consumables</div>
          <div class="toolset-adding"><button onclick="showConsumeAddingPopup()" class="adding-button">Add new</button></div>
        </div>

        <div class="toolset-body">
          <div class="toolset-toolview" id="consumeBoard">

            <?php
            foreach ($data['consumableset'] as $item) {
              echo '<div class="carcard" onclick="expandConsumable(this)">
                      <div class="cardhead">
                        <div class="cardid">
                          <div class="con-id display-none">', $item->ConsumableId ,'</div>
                          <div class="carmodel">', $item->ConsumableName ,'</div>
                          <div class="chassisno">', ($item->Volume == NULL) ? 'Grease' : 'Lubricants' ,'</div>
                          <div class="consumable-quantity display-none">', (($item->Volume == NULL) ? $item->Weight.' Kgs' : $item->Volume.' Liters') ,'</div>
                        </div>
                        <div class="carstatuscolor">
                          <div class="status-circle ', (($item->Volume == NULL) ? (($item->Weight >= 60) ? 'status-green-circle' : 'status-orange-circle') : (($item->Volume >= 60) ? 'status-green-circle' : 'status-orange-circle')) ,' "></div>
                        </div>
                      </div>
                      <div class="carpicbox">
                        <img src="' . URL_ROOT . 'public/images/consumables/' , $item->Image , '" class="carpic" alt="'. $item->ConsumableName .'">
                      </div>
                      <div class="carstatus ', ($item->Volume == NULL) ? (($item->Weight >= 60) ? 'available' : 'lower') : (($item->Volume >= 60) ? 'available' : 'lower'), '">', ($item->Volume == NULL) ? (($item->Weight >= 60) ? 'Available' : 'Low in stock') : (($item->Volume >= 60) ? 'Available' : 'Low in stock'), '</div>
                      <div class="chassisno con-last-update">Last update: ', $item->UDate ,' at ', substr($item->UTime, 0, 5) ,' </div>
                    </div>';
            }


            // DISPLAY THIS IF THERE IS NO DATA IN THE TABLE
            if ($item == NULL) {
              echo '<div class="no-data horizontal-centralizer">
                      <div class="margin-top-5 vertical-centralizer">
                        <div> Nothing to show :( </div>
                        <div><img src="' . URL_ROOT . 'public/images/common/no_data.png" class="no-data-icon" alt="No Data"></div>
                      </div>
                    </div>
                    ';
            }
            ?>

          </div>





          <!-- THIS IS THE FILTER BOX -->
          <div class="toolset-filterbox">
            <div class="toolfilter">

              <div class="filter-head">Filter by</div>
              <div class="line"></div>
              <div class="filters">

                  <ul id="consume_filter">

                    <li>
                      <div class="filtertype">Consumable Type</div>
                      <div class="filters">
                        <input type="radio" id="lubricants" name="cons-type" value="Lubricants">
                        <label for="lubricants">Lubricants</label>
                      </div>
                      <div class="filters">
                        <input type="radio" id="grease" name="cons-type" value="Grease">
                        <label for="grease">Grease</label>
                      </div>
                      <div class="filters">
                        <input type="radio" id="all-cons" name="cons-type" value="All" checked>
                        <label for="all-cons">All</label>
                      </div>
                    </li>

                    <li>
                      <div class="filtertype">Current Status</div>
                      <div class="filters">
                        <input type="radio" id="available" name="stock-state" value="Available">
                        <label for="available">Available</label>
                      </div>
                      <div class="filters">
                        <input type="radio" id="lowst" name="stock-state" value="Low">
                        <label for="lowst">Low in stock</label>
                      </div>
                      <div class="filters">
                        <input type="radio" id="any-state" name="stock-state" value="All" checked>
                        <label for="any-state">All</label>
                      </div>
                    </li>
                  </ul>
                  
              </div>
            </div>
          </div>




          <!-- THIS IS THE POPUP BOX FOR CONSUMABLE UPDATES AND DELETIONS -->
          <div class="background-bluer display-none" id="consumeUpdatePopUp">
            <div class="consumable-detail-popup position-fixed">

              <div class="popup-left">
                <div class="horizontal-centralizer cs-popup-csname">
                  <div class="form-conname">Consumable Name</div>
                </div>
                <div class="horizontal-centralizer">
                  <div class="">
                    <img class="consumable-popup-img" src="<?php echo URL_ROOT; ?>public/images/consumables/image1.png" class="carpic" alt="Consumable" id="formConsImg">
                  </div>
                </div>
                <div class="horizontal-centralizer">
                  <div class="form-con-quantity">Current Stock</div>
                </div>
              </div>

              <div class="border-div"></div>
              <div class="popup-right">
                <div class="horizontal-centralizer">
                  <div class="popup-box-heading1 margin-top-4">Update Stock</div>
                </div>

                <div class="horizontal-centralizer last-update margin-top-3">
                  <div class="form-con-lastupdate">Last update date and time</div>
                </div>

                <form action="<?php echo URL_ROOT; ?>Supervisors/updateThisConsumable" method="POST">

                  <div class="horizontal-centralizer margin-top-4">
                    <div>
                      <input type="number" id="stock" name="stock" class="form-control form-control-blue text-fontgray width-rem-15" placeholder="Current stock update" />
                      <label for="stock" class="form-label blue form-con-stock-label">Current stock update</label>
                    </div>
                  </div>

                  <div class="display-flex-row justify-content-center margin-top-2">
                    <div class="display-none">
                      <input class="form-conid" id="formConId" name="formConId">
                      <input class="form-con-type" id="formConType" name="formConType">
                    </div>
                    <div>
                      <button type="submit" class="action-one-button consume-update">Update</button>
                    </div>
                  </div>

                </form>

                <div class="display-flex-row justify-content-center marginy-3">
                    <div><button onclick="consumeDeleteConfirmation()" class="delete-button consume-update">Remove item</button></div>
                </div>
                <div class="display-flex-row justify-content-center margin-top-2">
                  <div><button onclick="closeDetailedConsumable()" class="cancel-button mouse-pointer">Cancel</button></div>
                </div>
              </div>
            </div>
          </div>




          <!-- DELETE CONFIRMATION POPUP BOX -->
          <div class="delete-conf-blur horizontal-centralizer display-none" id="popupWindow">
            <div class="vertical-centralizer">

              <div class="del-confirm-box">
                <div class="del-confirm-box-content">
                  <div class="del-confirm-msg-box">Are you sure?</div>
<!--                  <div class="del-confirm-msg-box">Delete consumable</div>-->
<!--                  <div class="">This will remove this consumable from the stock, and you cannot undo this operation.</div>-->
                  <div class="del-conf-button-set">
                    <div class="del-conf-button-box">
                      <form method="POST" action="<?php echo URL_ROOT; ?>Supervisors/remove#leave">
                        <input type="hidden" name="consumable_id" id="del-form-con-id">
                        <button type="submit" class="delete-button-2">Remove</button>
                      </form>
                    </div>
                    <div class="del-conf-button-box">
                      <button onclick="closeConsumeDeleteConfirmation()" class="edit-button-2">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>



          <!-- ADD NEW CONSUMABLE POPUP BOX -->
          <div class="delete-conf-blur horizontal-centralizer display-none" id="addNewConBox">
            <div class="vertical-centralizer">

              <form>
                <div class="add-new-con-box">
                  <div class="add-new-con-box-content">
                    <div class="img-grid">
                        <div style="background-image:url(<?php echo URL_ROOT; ?>public/images/placeholder.jpg)" class="border-radius-11 width-rem-12p5 height-rem-12p5 background-image" title="profilepic" id="img-previewc"></div>
                        <img src="<?php echo URL_ROOT; ?>public/images/add.png" class="grid-add width-rem-2p5"/>
                    </div>
                    <div>
                        <input type="file" id="imagec" class="display-none" name="profile" accept="image/*" />
                    </div>
                    <div class="img-remover-box">
                      <!-- <a class="img-remover" id="removec">Remove image</a> -->
                    </div>
                    <div class="new-con-name-box">
                      <label for="conName" class="display-none">Name: </label>
                      <input name="conName" type="text" placeholder="New consumable name" class="new-con-name" id="conName" required>
                    </div>
                    <div class="new-con-type-box">
                      <!-- <label for="conType" class="display-none">Type: </label>
                      <input name="conType" type="text" placeholder="Type" class="new-con-type" required> -->
                      <select name="consume-type" id="consume-type" class="con-type-select">
                        <option class="" disabled selected value>- Select consumable type -</option>
                        <option value="Lubricant">Lubricant</option>
                        <option value="Grease">Grease</option>
                      </select>
                    </div>
                    <div class="new-con-status-box">
                      <label for="conStatus" class="display-none">Stock status: </label>
                      <input name="conStatus" type="number" placeholder="Stock quantity" class="new-con-status" id="status" required>
                    </div>
                    <div class="new-con-add-btn-box">
                      <div><button type="button" class="green-btn width-50px" onclick="addConsumables()">Add</button></div>
                      <div><button onclick="closeConsumeAddingPopup()" class="red-btn width-50px">Cancel</button></div>
                    </div>
                  </div>
                </div>
              </form>

            </div>
          </div>



        </div>
      </div>
    </div>
  </div>
</section>


<!-- ADD COMMON FOOTER FILE FOR DASHBOARD PAGE -->
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/cors.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/consumable.js"></script>
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>