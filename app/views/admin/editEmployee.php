<?php require_once APP_ROOT . '\views\admin\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\admin\includes\navbar.php'; ?>


<section class="employee-forms position-absolute display-block">
        <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
            <div class="section-heading font-weight"> Edit </div>
            <form id="edit-employee">
                <div class="display-flex-row align-items-start gap-2">
                    <div>
                        <input type="text"
                            id="firstname"
                            name="firstname"
                            onChange=""
                            value="<?php echo $data['employee']->Firstname?>"
                            class="form-control"
                            placeholder="Firstname"
                            autocomplete="off"/>
                        <label class="form-label">Firstname</label>
                    </div>
                    <div>
                        <input type="text"
                            id="lastname"
                            name="lastname"
                            onChange=""
                            value="<?php echo $data['employee']->Lastname?>"
                            class="form-control"
                            placeholder="Lastname"
                            autocomplete="off" />
                        <label class="form-label">Lastname</label>
                    </div>
                </div>
                <div class="display-flex-row align-items-start gap-2">
                    <div>
                        <input type="text"
                            id="nic"
                            name="nic"
                            onChange=""
                            value="<?php echo $data['employee']->NIC?>"
                            class="form-control"
                            placeholder="NIC"
                            autocomplete="off" />
                        <label class="form-label">NIC</label>
                    </div>
                    <div>
                        <input type="email"
                            id="email"
                            name="email"
                            onChange=""
                            value="<?php echo $data['employee']->Email?>"
                            class="form-control"
                            placeholder="Email"
                            autocomplete="off" />
                        <label class="form-label">Email</label>
                    </div>
                </div>
                <div class="display-flex-row align-items-start gap-2">
                    <div>
                        <input type="tel"
                            id="telephone"
                            name="telephone"
                            onChange=""
                            value="<?php echo $data['employee']->TelephoneNo?>"
                            class="form-control"
                            placeholder="Telephone"
                            autocomplete="off" />
                        <label class="form-label">Telephone</label>
                    </div>
                    <div>
                        <input type="text"
                            id="position"
                            name="position"
                            onChange=""
                            value="<?php echo $data['employee']->Position?>"
                            class="form-control"
                            placeholder="position"
                            autocomplete="off" />
                        <label class="form-label">Position</label>
                    </div>
                    
                </div>
                <div class="display-flex-row align-items-center justify-content-center flex-wrap gap-2">
                  
                </div>
                <div class="text-center margin-top-3">
                    <button class="btn btn-primary" type="button" onclick="editEmployee('<?php echo $data['employee']->EmployeeId?>')">
                        Edit
                    </button>
                </div>

            </form>
        </div>
    </section>

    <section class="display-flex-column">

        <div id="alert" class="hideme" role="alert"></div>

    </section>


<script src="<?php echo URL_ROOT;?>public/javascripts/main.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/adminjs/cors.js"></script>
</body>
</html>