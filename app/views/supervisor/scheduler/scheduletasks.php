<?php require_once APP_ROOT . '/views/supervisor/includes/header.php'; ?>


<?php require_once APP_ROOT . '/views/supervisor/common/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/common/topnavbar.php'; ?>

<section>
    <div class="task-schedule-screen">
        <div class="task-schedule-area">

            <div class="task-schedule-page-heading">Scheduled Task List</div>

            <div class="task-schedule-control-box vertical-centralizer">
                <div class="task-schedule-control-box-inner horizontal-centralizer">
                    <div class="task-name-input-box">
                        <label for="employeeId" class="display-none">Task Name</label>
                        <input type="text" id="employeeId" name="employeeId" class="task-add-form-input" placeholder="Task Name" autocomplete="off" required>
                    </div>
                    <div class="vehicle-selection-box">
                        <label for="vehicles" class="display-none">Select Vehicle</label>
                        <select name="vehicles" id="vehicles" class="task-vehicle-selection">
                            <option value="NULL">Select vehicle</option>
                            <option value="CN112150768A">CN112150768A</option>
                            <option value="CN112215000A">CN112215000A</option>
                            <option value="CN112910320A">CN112910320A</option>
                        </select>
                    </div>
                    <div class="task-add-button-box">
                        <button type="button" class="task-add-button">Add new task</button>
                    </div>
                </div>

            </div>

            <div class="task-detail-box-outer">
                <div class="task-detail-box-inner">

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: EFI Tuneup</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Naveen Dilshan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox1" />
                                    <label for="checkbox1"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: Adjust Clutch</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Janith Liyanage</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox2" />
                                    <label for="checkbox2"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="task-schedule-record">
                        <div class="task-schedule-record-inner">
                            <div class="task-vehicle">
                                <div class="task-vehicle-id">CN112910320A</div>
                                <div class="task-vehicle-date">2023-02-25</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-name vertical-centralizer">
                                <div>Task: Battery and Fuse check</div>
                            </div>
                            <div class="vline"></div>
                            <div class="task-worker vertical-centralizer">
                                <div>Assembler: Amila Madushan</div>
                            </div>
                            <div class="task-status vertical-centralizer">
                                <div class="round">
                                    <input type="checkbox" id="checkbox3" />
                                    <label for="checkbox3"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<?php require_once APP_ROOT . '/views/supervisor/includes/footer.php'; ?>