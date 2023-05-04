<?php require_once APP_ROOT . '\views\admin\includes\header.php'; ?>
<?php require_once APP_ROOT . '\views\admin\includes\navbar.php'; ?>

<section class="employee-forms position-absolute display-block">
        <div class="display-flex-column align-items-center gap-2 border-radius-1 background-white paddingx-5 paddingy-5">
            <div class="section-heading font-weight"> Add Employee </div>
            <form id="add-employee">
                <div class="display-flex-row align-items-start gap-2">
                    <div>
                        <input type="text"
                            id="firstname"
                            name="firstname"
                            onChange=""
                            value=""
                            class="form-control"
                            placeholder="Firstname"
                            autocomplete="off" />
                        <label class="form-label">Firstname</label>
                    </div>
                    <div>
                        <input type="text"
                            id="lastname"
                            name="lastname"
                            onChange=""
                            value=""
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
                            value=""
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
                            value=""
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
                            value=""
                            class="form-control"
                            placeholder="Telephone"
                            autocomplete="off" />
                        <label class="form-label">Telephone</label>
                    </div>
                    <div>
                        <div class="custom-select">
                            <select name="position" class="form-control form-control-blue text-blue" id="position">
                                <option value="">Select Position</option>
                                <option value="Manager">Manager</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Tester">Tester</option>
                                <option value="Assembler">Assembler</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="display-flex-row align-items-center justify-content-center flex-wrap gap-2">
                    <div>
                        <label class="form-control-checkbox font-size text-gray padding-top-2">
                            Create an User Account
                            <input type="checkbox"
                                    id="account"
                                    name="account"
                                    value="Yes">
                            <div class="checkmark-small"></div>
                        </label>
                    </div>
                </div>
                <div class="text-center margin-top-3">
                    <button class="btn btn-primary" type="button" onclick="addEmployee()">
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </section>

    <section class="display-flex-column">

        <div id="alert" class="hideme" role="alert"></div>

    </section>

    <script type="module" src="<?php echo URL_ROOT; ?>public/javascripts/adminjs/main.js"></script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/adminjs/cors.js"></script>
</body>

</html>