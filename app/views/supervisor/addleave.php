<?php require_once APP_ROOT . '\views\includes\header.php'; ?>


<?php require_once APP_ROOT . '\views\supervisor\leftnavbar.php'; ?>
<?php require_once APP_ROOT . '\views\supervisor\topnavbar.php'; ?>

<section class="new position-absolute page-content">
    <div class="display-flex-column sidebox-2">

        <div class="text-center"><h3>Record employee leave</h3></div>
        <form action="<?php echo URL_ROOT; ?>Supervisors/addleave" method="post"><br>
            <div>
                <label class="">Employee Id: </label>
                <input type="text" id="employeeId" name="employeeId" class="" placeholder="Employee Id" autocomplete="off" required>
            </div><br>

            <div>
                <label class="">Leave date: </label>
                <input type="date" id="leavedate" name="leavedate" class="" placeholder="Leave Date" required>
            </div><br>

            <div>
                <label>Reason: </label><br>
                <textarea id="story" name="story" rows="10" cols="42" required>Maximum 500 characters...</textarea>
            </div><br>

                <div class="text-center">
                    <button class="btn btn-primary" type="submit" onClick={this.onSubmit}>Submit</button>
                </div><br>

        </form>

    </div>
</section>

<?php require_once APP_ROOT . '\views\includes\footer.php'; ?>