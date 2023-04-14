<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section class="content">
  <div class="toolset-margin">

    <div class="toolset-head">
      <div class="toolset-heading">Tools</div>
      <div class="toolset-dropdown">
        <button type="" class="tool-add-btn">Add new</button>
      </div>
    </div>


    <div class="toolset-body">
      <div class="toolset-toolview">

        <?php
        foreach ($data['toolset'] as $tool) {
          echo '<div class="toolcard" onclick="expandConsumable()">
                    <div class="cardhead">
                      <div class="cardid">
                        <div class="toolname">', $tool->ToolName, '</div>
                      </div>
                      <div class="toolstatus">
                        <div class="status-circle ', ($tool->Volume == NULL) ? (($tool->Weight >= 60) ? 'status-green-circle' : 'status-orange-circle') : (($tool->Volume >= 60) ? 'status-green-circle' : 'status-orange-circle'), ' "></div>
                      </div>
                    </div>
                    <div class="toolpicbox">
                      <img src="' . URL_ROOT . 'public/images/consumables/' . $tool->Image . '" class="carpic" alt="micro panda red">
                    </div>
                    <div class="toolupdate">Last update: ', $tool->LastUpdate, '</div>
                    <div class="tool-updater ', ($tool->Volume == NULL) ? (($tool->Weight >= 60) ? 'available' : 'lower') : (($tool->Volume >= 60) ? 'available' : 'lower'), '">', ($tool->Volume == NULL) ? (($tool->Weight >= 60) ? 'Available' : 'Low in stock') : (($tool->Volume >= 60) ? 'Available' : 'Low in stock'), '</div>
                  </div>';
        }


        // DISPLAY THIS IF THERE IS NO DATA IN THE TABLE
        if ($tool == NULL) {
          echo '<div class="no-data horizontal-centralizer"><div class="margin-top-5">Nothing to show :(</div></div>';
        }

        ?>

      </div>



      <!-- THIS IS THE FILTER BOX -->
      <div class="toolset-filterbox">
        <div class="toolfilter">

          <div class="filter-head">Filter by</div>
          <div class="line"></div>
          <div class="filters">

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
      <div class="background-blurer display-none" id="popupWindow2">
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

                <input type="number" id="stock" name="stock" onChange="" class="form-control form-control-blue text-fontgray width-rem-15" placeholder="Current stock update" />
                <label class="form-label blue">Current stock update <?php echo (NULL == NULL) ? '(Litres)' : '(Kgs)'; ?></label>

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




      <!-- DELETE CONFIRMATION POPUP BOX -->
      <div class="delete-conf-blur horizontal-centralizer" id="popupWindow">
        <div class="vertical-centralizer">

          <div class="del-confirm-box">
            <div class="del-confirm-box-content">
              <div class="del-confirm-msg-box">Are you sure?</div>
              <div class="del-conf-button-set">
                <div class="del-conf-button-box">
                  <button type="submit" class="delete-button-2">Remove</button>
                </div>
                <div class="del-conf-button-box">
                  <button onclick="closePopup()" class="edit-button-2">Cancel</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>



      <!-- ADD NEW CONSUMABLE POPUP BOX -->
      <div class="delete-conf-blur horizontal-centralizer" id="popupWindow3">
        <div class="vertical-centralizer">

          <div class="add-new-con-box">
            <div class="add-new-con-box-content">
              <div class="img-grid">
                <img src="<?php echo URL_ROOT; ?>public/images/profile/<?php echo $data['userDetails']->Image; ?>" class="border-radius-11 width-rem-12p5" alt="profile picture" id="img-preview" />
                <img src="<?php echo URL_ROOT; ?>public/images/add.png" class="grid-add width-rem-2p5" alt="add button" />
              </div>
              <div>
                <label>Remove image</label>
              </div>
              <div>
                <label for="toolName">Name: </label>
                <input name="toolName" type="text" placeholder="Enter tool name" required>
              </div>
              <div>
                <label for="toolStatus">Tool status: </label>
                <select name="toolStatus" required>
              </div>
              <div>
                <label for="operativity">Operation status: </label>
                <select name="operativity" type="number" required>
              </div>
              <div class="display-flex">
                <div><button>Add</button></div>
                <div><button>Cancel</button></div>
              </div>
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