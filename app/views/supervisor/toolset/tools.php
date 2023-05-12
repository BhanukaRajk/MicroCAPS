<!-- ADD COMMON HEADER FILE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/notification.php'; ?>


<section>
  <!-- THIS IS THE CONTENT DISPLAYING AREA -->
  <div class="content">
    <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
    <div class="toolset-margin">

      <!-- THIS SHOULD BE A FIXED CONTENT -->
      <div class="toolset-head">
        <div class="toolset-heading">Tools</div>
        <div class="toolset-adding">
          <button onclick="" class="tool-add-btn adding-button">Add new</button>
        </div>
      </div>


      <div class="toolset-body">
        <div class="toolset-toolview" id="toolBoard">

          <?php
          foreach ($data['toolset'] AS $tool) {
            echo '<div class="toolcard" onclick="expandTool(this)">
                    <div class="cardhead">
                      <div class="cardid">
                        <div class="tool-id display-none">'. $tool->ToolId .'</div>
                        <div class="toolname">'. $tool->ToolName .'</div>
                        <div class="tool-quantity">Quantity: '. $tool->quantity .'</div>
                      </div>
                      <div class="toolstatuscolor">
                        <div class="tool-status display-none">'. $tool->Status .'</div>
                        <div class="status-circle ' . (($tool->Status == "Normal") ? 'status-green-circle' : 'status-orange-circle') . ' "></div>
                      </div>
                    </div>
                    <div class="toolpicbox">
                      <img src="' . URL_ROOT . 'public/images/tools/' . (($tool->Image != NULL) ? $tool->Image : 'none.jpeg') . '" class="toolpic" alt="' . $tool->ToolName . '">
                    </div>
                    <div class="tool-card-down">
                      <div class="tool-updater ' . (($tool->Status == "Normal") ? 'available' : 'lower') . '">' . (($tool->Status == "Normal") ? 'Normal' : 'Need an attention') . '</div>
                      <div class="toolupdate last-update">Last update: ' . $tool->LastUpdate . '</div>
                    </div>
                  </div>';
          }


          // DISPLAY THIS IF THERE IS NO DATA IN THE TABLE
          if ($tool == NULL) {
            echo '<div class="no-data horizontal-centralizer"><div class="margin-top-5">Nothing to show :(</div></div>';
          }

          ?>

        </div>
      </div>



      <!-- THIS IS THE FILTER BOX -->
      <div class="toolset-filterbox">
        <div class="toolfilter">

          <div class="filter-head">Filter by</div>
          <div class="line"></div>
          <div class="filters">

              <ul id="consume_filter">

                <li>
                  <div class="filtertype">Tool Type</div>
                  <div class="filters">
                    <input type="radio" id="hand-tools" name="tool-type" value="Hand Tool">
                    <label for="hand-tools">Hand Tools</label>
                  </div>
                  <div class="filters">
                    <input type="radio" id="power-tools" name="tool-type" value="Power Tool">
                    <label for="power-tools">Power Tools</label>
                  </div>
                  <div class="filters">
                    <input type="radio" id="all-tools" name="tool-type" value="All" checked>
                    <label for="all-tools">All</label>
                  </div>
                </li>

                <li>
                  <div class="filtertype">Current Status</div>
                  <div class="filters">
                    <input type="radio" id="normal-state" name="tool-state" value="Normal">
                    <label for="normal-state">Normal</label>
                  </div>
                  <div class="filters">
                    <input type="radio" id="na-state" name="tool-state" value="NA">
                    <label for="na-state">Need Attention</label>
                  </div>
                  <div class="filters">
                    <input type="radio" id="any-state" name="tool-state" value="All" checked>
                    <label for="any-state">All</label>
                  </div>
                </li>

              </ul>

          </div>

        </div>
      </div>



      <!-- THIS IS THE POPUP BOX FOR TOOL UPDATES AND DELETIONS -->
      <div class="background-bluer display-none" id="toolUpdatePopUp">
        <div class="consumable-detail-popup position-fixed">

          <div class="popup-left">
            <div class="horizontal-centralizer cs-popup-csname">
              <div class="form-toolname">TOOL NAME</div>
            </div>
            <div class="horizontal-centralizer">
              <div class="">
                <img class="consumable-popup-img" src="<?php echo URL_ROOT; ?>public/images/tools/none.png" class="carpic" alt="Consumable" id="formToolImg">
              </div>
            </div>
            <div class="horizontal-centralizer">
              <div class="form-tool-quantity">Quantity: QUANTITY</div>
            </div>
          </div>

          <div class="border-div"></div>
          <div class="popup-right">
            <div class="horizontal-centralizer">
              <div class="popup-box-heading1 margin-top-4">Update Tool Status</div>
            </div>

            <div class="horizontal-centralizer last-update margin-top-3">
              <div class="form-tool-lastupdate">Last update: DATE AND TIME</div>
            </div>


            <form method="POST" action="<?php echo URL_ROOT; ?>Supervisors/updateThisTool">
              <div class="horizontal-centralizer margin-top-4">
                <div>

                  <select name="tool-status" id="formToolStatus" class="form-tool-status">
                    <option id="status-opt1" value="Need an attention">Need an attention</option>
                    <option id="status-opt2" value="Normal">Normal</option>
                  </select>

                  <!-- <input type="number" id="stock" name="stock" onChange="" class="form-control form-control-blue text-fontgray width-rem-15" placeholder="Current stock update" />
                  <label class="form-label blue">Current stock update</label> -->

                </div>
              </div>
              <div class="display-flex-row justify-content-center margin-top-2">
                <input type="hidden" name="tool_id_status" id="status-form-tool-id">
                <div><button type="submit" class="edit-button consume-update">Update</button></div>
              </div>
            </form>
              <div class="display-flex-row justify-content-center marginy-3">
                <div><button onclick="showToolDelConfBox()" class="delete-button consume-update">Remove item</button></div>
              </div>
            <div class="display-flex-row justify-content-center margin-top-2">
              <div><a onclick="closeToolUpdatePopup()" class="mouse-pointer">Close</a></div>
            </div>
          </div>
        </div>
      </div>




      <!-- DELETE CONFIRMATION POPUP BOX -->
      <div class="delete-conf-blur horizontal-centralizer display-none" id="toolDelConfirm">
        <div class="vertical-centralizer">

          <div class="del-confirm-box">
            <div class="del-confirm-box-content">
              <div class="del-confirm-msg-box">Are you sure?</div>
              <div class="del-conf-button-set">
                <div class="del-conf-button-box">
                  <button type="button" class="delete-button-2">Remove</button>
                </div>
                <div class="del-conf-button-box">
                  <button onclick="closeToolDelConfBox()" class="edit-button-2">Cancel</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>


        <!-- ADD NEW TOOL POPUP BOX -->
        <!-- <div class="delete-conf-blur horizontal-centralizer" id="tooladdpopupWindow">
          <div class="vertical-centralizer">

            <form>
              <div class="add-new-con-box">
                <div class="add-new-con-box-content">
                  <div class="img-grid TB">
                    <img src="<?php //echo URL_ROOT; 
                              ?>public/images/profile/<?php //echo $data['userDetails']->Image; 
                                                      ?>" class="border-radius-11 width-rem-12p5" alt="Consumable" id="img-preview" />
                    <img src="<?php //echo URL_ROOT; 
                              ?>public/images/add.png" class="grid-add width-rem-2p5" alt="add button" />
                  </div>
                  <div class="img-remover-box">
                    <a class="img-remover">Remove image</a>
                  </div>
                  <div class="new-con-name-box">
                    <label for="conName" class="display-none">Name: </label>
                    <input name="toolName" type="text" placeholder="Enter tool name" class="new-con-name" required>
                  </div>
                  <div class="new-con-type-box"> -->
                    <!-- <label for="conType" class="display-none">Type: </label>
                    <input name="conType" type="text" placeholder="Type" class="new-con-type" required> -->
                    <!-- <select name="toolStatus" id="consume-type" class="con-type-select">
                      <option class="" disabled selected value>- Select tool status -</option>
                      <option value="Normal">Normal</option>
                      <option value="NA">Need an attention</option>
                    </select>
                  </div> -->
                  <!-- <div class="new-con-status-box">
                    <label for="conStatus" class="display-none">Stock status: </label>
                    <input name="conStatus" type="number" placeholder="Stock quantity" class="new-con-status" required>
                  </div> -->
                  <!-- <div class="new-con-add-btn-box">
                    <div><button class="green-btn width-50px">Add</button></div>
                    <div><button onclick="closeAddNewToolPopup()" class="red-btn width-50px">Cancel</button></div>
                  </div>
                </div>
              </div>
            </form>

          </div>
        </div> -->




    </div>
  </div>

</section>


<!-- ADD COMMON FOOTER FILE -->
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/cfetch.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/supervisorjs/tools.js"></script>
<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>