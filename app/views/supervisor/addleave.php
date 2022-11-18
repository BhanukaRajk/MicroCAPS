<?php require_once APP_ROOT . '/views/includes/header.php'; ?>


<?php require_once APP_ROOT . '/views/supervisor/leftnavbar.php'; ?>
<?php require_once APP_ROOT . '/views/supervisor/topnavbar.php'; ?>

<section class="new position-absolute page-content">
    <div class="border-gray display-flex-column sidebox-2">

        <div class="text-center"><h3>Record employee leave</h3></div>
        <form action="<?php echo URL_ROOT; ?>Supervisors/addleave" method="post"><br>
            <div>
                <label>Employee Id: </label>
                <input type="text" id="employeeId" name="employeeId" class="form-control" placeholder="Employee Id" autocomplete="off" required>
            </div><br>

            <div>
                <label>Leave date: </label>
                <input type="date" id="leavedate" name="leavedate" class="form-control" placeholder="Leave Date" required>
            </div><br>

            <div>
                <label>Reason: </label><br>
                <input type="text" id="reason" name="reason" class="form-control" placeholder="Reason" required>
                <!-- <textarea id="reason" name="reason" rows="5" cols="40" required>Maximum 500 characters...</textarea> -->
            </div><br>

                <div class="text-center">
                    <button class="btn btn-primary" type="submit" onClick={this.onSubmit}>Submit</button>
                </div><br>

        </form>

    </div>
</section>

<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>