<!-- ADD COMMON HEADER FILE FOR DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>

<!-- ADD LEFT NAVIGATION BAR AND TOP NAVIGATION BAR ON DASHBOARD PAGE -->
<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>


<section class="listsection">
  <div class="datawall">
    <div class="databoard">
      <div class="pagehead">Consumables</div>
      <div class="vehicle-detail-board">
        <div class="vehicle-data-board">

          <?php
          foreach ($data['consumableset'] as $item) {
            echo '<div class="div-ender"></div>
                            <div class="sup-leave-list-non-edit">
                                <div class="leave-value">' . $value->EmployeeId . '</div>
                                <div class="leave-value">' . $value->Firstname . '</div>
                                <div class="leave-value">' . $value->Lastname . '</div>
                                <div class="leave-value">' . $value->LeaveDate . '</div>
                                <div class="leave-value padding-right-5">' . $value->Reason . '</div>

                                <!-- <div class="leave-edit-info"><a href="' . URL_ROOT . 'supervisors/editleave?id=' . $value->EmployeeId . '&ldate=' . $value->LeaveDate . '" class="edit-button">Edit</a></div> -->
                                
                                <div class="leave-edit-info padding-left-2"><a href="' . URL_ROOT . 'supervisors/editleave?id=' . $value->Leave_Id . '" class="edit-button">Edit</a></div>
                                <div class="leave-edit-info"><a href="' . URL_ROOT . 'supervisors/removeleave?id=' . $value->Leave_Id . '" class="delete-button">Remove</a></div>
                            </div>
                            
                            
                  <div class="carcard">
                    <div class="cardhead">
                      <div class="cardid">
                        <div class="carmodel">' . $item->consumable_name . '</div>
                        <div class="chassisno">' . ($item->volume == NULL) ? 'Grease' : 'Lubricants'  . '</div>
                      </div>
                      <div class="carstatuscolor">
                        // <div class="status-circle status-green-circle"></div>
                        <div class="' .( ($item->volume == NULL) ? 'Grease' : 'Lubricants' ).'"></div>
                      </div>
                    </div>
                    <div class="carpicbox">
                      <img src="' . URL_ROOT . 'public/images/consumables/image1.png" class="carpic" alt="micro panda red">
                    </div>
                    <div class="carstatus">Available</div>
                  </div>';
          }
          ?>


          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL SAE 0W-20</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor">
                <div class="status-circle status-green-circle"></div>
              </div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image1.png" class="carpic" alt="micro panda red">
            </div>
            <div class="carstatus">Available</div>
          </div>

          <!-- <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL 300V FL 10W-40</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-orange-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image1.png" class="carpic" alt="micro panda black">
            </div>
            <div class="carstatus">Low stock</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL 3000 4T Plus</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-green-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image2.png" class="carpic" alt="micro panda red">
            </div>
            <div class="carstatus">Available</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL 4100 TL 10W-40</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-orange-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image4.png" class="carpic" alt="micro panda black">
            </div>
            <div class="carstatus lower">Low stock</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL SAE 0W-20</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-green-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image20.png" class="carpic" alt="micro panda red">
            </div>
            <div class="carstatus available">Available</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL 300V FL 10W-40</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-orange-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image1.png" class="carpic" alt="micro panda black">
            </div>
            <div class="carstatus">Low stock</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL SAE 0W-20</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-green-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image20.png" class="carpic" alt="micro panda red">
            </div>
            <div class="carstatus">Available</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL 300V FL 10W-40</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-orange-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image1.png" class="carpic" alt="micro panda black">
            </div>
            <div class="carstatus">Low stock</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL SAE 0W-20</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-green-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image20.png" class="carpic" alt="micro panda red">
            </div>
            <div class="carstatus">Available</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL 300V FL 10W-40</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-orange-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image1.png" class="carpic" alt="micro panda black">
            </div>
            <div class="carstatus">Low stock</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL SAE 0W-20</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-green-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image20.png" class="carpic" alt="micro panda red">
            </div>
            <div class="carstatus">Available</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL 300V FL 10W-40</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-orange-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image1.png" class="carpic" alt="micro panda black">
            </div>
            <div class="carstatus">Low stock</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL SAE 0W-20</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-green-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image20.png" class="carpic" alt="micro panda red">
            </div>
            <div class="carstatus">Available</div>
          </div>

          <div class="carcard">
            <div class="cardhead">
              <div class="cardid">
                <div class="carmodel">MOTUL 300V FL 10W-40</div>
                <div class="chassisno">Lubricants</div>
              </div>
              <div class="carstatuscolor"><div class="status-circle status-orange-circle"></div></div>
            </div>
            <div class="carpicbox">
              <img src="<?php echo URL_ROOT; ?>public/images/consumables/image1.png" class="carpic" alt="micro panda black">
            </div>
            <div class="carstatus">Low stock</div>
          </div> -->
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