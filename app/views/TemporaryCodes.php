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