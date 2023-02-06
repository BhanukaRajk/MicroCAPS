<?php require_once APP_ROOT . '/views/admin/includes/header.php'; ?>
<?php require_once APP_ROOT . '/views/admin/navbar.php'; ?>

<div class="container2">
    <h3>Edit</h3>
  <form action="/action_page.php">
    <div class="row1">
        <div class="column left">
            <input type="text" id="ctry" name="lastname" placeholder="last Name">  
        </div>
        <div class="column right">
            <input type="text" id="ctry" name="firstname" placeholder="first Name">
        </div>
      </div>

      <input type="text" id="fname" name="nic" placeholder="nic">
    <input type="text" id="fname" name="contact" placeholder="contact">
    <input type="text" id="lname" name="address" placeholder="address">
    <input type="text" id="fname" name="email" placeholder="email">
    <input type="text" id="fname" name="role" placeholder="role">

    <center><input type="submit" value="Update"></center>
  </form>
  </div>
</div>
<script src="<?php echo URL_ROOT;?>public/javascripts/main.js"></script>
</body>
</html>