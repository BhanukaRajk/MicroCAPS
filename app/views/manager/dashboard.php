<?php


    require_once APP_ROOT . '\views\includes\header.php';
 ?>
<h1>Manager Dashboard</h1>
<?php
    print_r($_SESSION);
?>
<br>
<a href="<?php echo URL_ROOT; ?>managers/logout">logout</a>

