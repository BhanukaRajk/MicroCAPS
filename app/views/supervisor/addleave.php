<?php require_once APP_ROOT . '\views\includes\header.php'; ?>


<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/main.js"></script>
<?php require_once APP_ROOT . '\views\supervisor\leftnavbar.php'; ?>
<?php require_once APP_ROOT . '\views\supervisor\topnavbar.php'; ?>

<section class="position-absolute page-content">
    <div class="leave_form">

        <div class="leave_form_top">Add employee leave</div>
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
                <label class="">Reason: </label>
                <input type="text" id="reason" name="reason" class="" required>
            </div><br>


            <div class="text-center">
                <button class="btn btn-primary" type="submit" onClick={this.onSubmit}>Submit</button>
            </div><br>

        </form>

    </div>
</section>


<?php require_once APP_ROOT . '\views\includes\footer.php'; ?>