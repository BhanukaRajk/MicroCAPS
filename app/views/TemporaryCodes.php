<!-- HTML CODE -->
<div id="parent">
    <?php
    foreach ($data['FormCarData'] as $process) {
        echo '
        <div class="stage-control-row">
            <div class="row-data">' . $process->ProcessName . '</div>
            <div class="row-data display-none">' . $process->Status . '</div>
            <form>
                <div class="row-data">
                    <div><input type="checkbox" id="connectivity-cb" name="connectivity" value="Connected"></div>
                    <div><input type="checkbox" id="holding-cb" name="holding" value="Hold"></div>
                </div>
            </form>
        </div>';
    }
    if ($process == NULL) {
        echo '<div class="horizontal-centralizer no-leave-data">
        <div class="vertical-centralizer">
        <div>Nothing to show</div>
        </div>
        </div>';
    }
    ?>
</div>

<!-- JAVASCRIPT CODE -->
<script>
const itemsPerPage = 8;
const items = document.querySelectorAll('.stage-control-row');
const numItems = items.length;
const pagination = document.getElementById('pagination');
const numPages = Math.ceil(numItems / itemsPerPage);

let currentPage = 1;
let start = 0;
let end = itemsPerPage;

function renderItems(page) {
    start = (page - 1) * itemsPerPage;
    end = start + itemsPerPage;
    items.forEach((item, index) => {
        if (index >= start && index < end) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

function setupPagination() {
    pagination.innerHTML = '';

    const prevButton = document.createElement('button');
    prevButton.innerHTML = '&laquo;';
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderItems(currentPage);
        }
    });

    const nextButton = document.createElement('button');
    nextButton.innerHTML = '&raquo;';
    nextButton.addEventListener('click', () => {
        if (currentPage < numPages) {
            currentPage++;
            renderItems(currentPage);
        }
    });

    pagination.appendChild(prevButton);

    for (let i = 1; i <= numPages; i++) {
        const button = document.createElement('button');
        button.innerHTML = i;
        button.addEventListener('click', () => {
            currentPage = i;
            renderItems(currentPage);
        });
        pagination.appendChild(button);
    }

    pagination.appendChild(nextButton);

    renderItems(currentPage);
}

setupPagination();
</script>










<?php
                        foreach ($data['FormCarData'] as $process) {
                            echo '
                                <div class="stage-control-row">
                                    <div class="row-data">' . $process->ProcessName . '</div>
                                    <div class="row-data display-none">' . $process->Status . '</div>

                                    <form>
                                    <div class="row-data">
                                        
                                            <div><input type="checkbox" id="connectivity-cb" name="connectivity" value="Connected"></div>
                                            <div><input type="checkbox" id="holding-cb" name="holding" value="Hold"></div>
                                        
                                    </div></form>
                                    
                                </div>';
                        }

                        if ($process == NULL) {
                            echo '<div class="horizontal-centralizer no-leave-data">
                                <div class="vertical-centralizer">
                                    <div>Nothing to show</div>
                                </div>
                            </div>';
                        }

                        ?>















<?php
                        $items_per_page = 8;
                        $total_items = count($data['FormCarData']);
                        $total_pages = ceil($total_items / $items_per_page);

                        $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                        $start_index = ($current_page - 1) * $items_per_page;
                        $end_index = $start_index + $items_per_page;

                        $display_data = array_slice($data['FormCarData'], $start_index, $items_per_page);

                        foreach ($display_data as $process) {
                            echo '
                                <div class="stage-control-row">
                                    <div class="row-data">' . $process->ProcessName . '</div>
                                    <div class="row-data display-none">' . $process->Status . '</div>

                                    <form>
                                        <div class="row-data">
                                            <div><input type="checkbox" id="connectivity-cb" name="connectivity" value="Connected"></div>
                                            <div><input type="checkbox" id="holding-cb" name="holding" value="Hold"></div>
                                        </div>
                                    </form>
                                </div>';
                        }

                        if (empty($display_data)) {
                            echo '<div class="horizontal-centralizer no-leave-data">
                                <div class="vertical-centralizer">
                                    <div>Nothing to show</div>
                                </div>
                            </div>';
                        }

                        if ($total_pages > 1) {
                            echo '<div class="pagination">';
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active_class = ($i == $current_page) ? ' active' : '';
                                echo '<a href="?page=' . $i . '" class="page-link' . $active_class . '">' . $i . '</a>';
                            }
                            echo '</div>';
                        }
                        ?>










<section class="position-absolute page-content">
    <!-- THIS IS THE CONTENT DISPLAYING AREA -->
    <div class="content">
        <!-- MARGINS INCLUDED CONTENT DISPLAYING AREA -->
        <div>
            <div class="display-flex-row margin-bottom-3 align-items-center justify-content-between margin-right-6 margin-bottom-4">
                <div class="page-heading font-weight">
                    PDI Results
                </div>
                <div class="custom-select">
                    <select name="vehicles" class="background-none" id="pdiVehicles">
                        <?php
                            echo '<option value="' . URL_ROOT . 'managers/pdidetails/' . $data['ChassisNo'] .'">'.$data['ChassisNo'].'</option>';
                            foreach($data['onPDIVehicles'] as $value) {
                                if ($value->ChassisNo == $data['ChassisNo']) {
                                    continue;
                                }
                                echo '<option value="' . URL_ROOT . 'managers/pdidetails/' . $value->ChassisNo . '">'.$value->ChassisNo.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div>
                <div class="paddingy-2 font-weight">VIN : <?php echo $data['onPDIVehicle']->ChassisNo ?></div>
                <div class="paddingy-2 font-weight">Engine : <?php echo $data['onPDIVehicle']->EngineNo ?></div>
            </div>

            <div class="display-flex-row justify-content-start gap-2 margin-top-3 flex-wrap">

            <?php
                    foreach ($data['pdiCheckCategories'] as $value) {
                        echo '
                            <div class="pdi-card">
                                <div class="pdi-card-head">
                                    <div class="pdi-card-main">'.$value->Title.'</div>
                                    <div class="pdi-card-sub">'.$value->SubTitle.'</div>
                                    <div class="pdiresultbox paddingy-3">
                        ';

                        foreach ($data['pdiCheckList'] as $value2) {
                            if ($value2->CategoryId == $value->CategoryId) {

                                if ($value2->Status == 'OK') {
                                    $color = 'green-box';
                                } else if ($value2->Status == 'S/A') {
                                    $color = 'red-box';
                                } else {
                                    $color = 'yellow-box';
                                }

                                echo '
                                    <div class="paddingx-4 paddingy-2">
                                        <div class="pdi-checklist">
                                            <div class="padding-bottom-3 font-size">'.$value2->CheckName.'</div>
                                            <div class="pdi-checking-result '. $color .'">
                                                <div class="pdi-checking-result-text">'.$value2->Status.'</div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        }

                        echo '
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                ?>

            </div>
        </div>
    </div>
</section>