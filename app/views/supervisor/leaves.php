<?php require_once APP_ROOT . '/views/includes/header.php'; ?>


<?php require_once APP_ROOT . '/views/supervisor/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/topnavbar.php'; ?>


<section class="new position-absolute page-content">
    <div class="display-flex-row justify-content-between">
        <div>
            <h1>Leaves</h1>
        </div>
        <div><a class="text-decoration-none" href="<?php echo URL_ROOT; ?>supervisors/addleave">
                <h3>Add new +</h3>
            </a></div>
    </div>
    <div class="display-flex-column border-radius-1 background-white paddingx-5 paddingy-5">
        <div class="paddingy-3 text-center font-weight">
            <h2>Employee leaves</h2>
        </div>
        <div class="display-flex-row justify-content-center">
            <div>
                <table class="border-1">
                    <tr>
                        <th class="col-width">Employee Id</th>
                        <th class="col-width">Leave date</th>
                        <th class="text-align-left">Reason</th>
                    </tr>
                    <?php
                    foreach ($data['LeaveDetails'] as $value) {
                        echo '<tr>
                        <td class="col-width text-black">' . $value->EmployeeId . '</td>
                        <td class="col-width text-black">' . $value->LeaveDate . '</td>
                        <td class="text-align-left text-black">' . $value->Reason . '</td>
                    </tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</section>


<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>