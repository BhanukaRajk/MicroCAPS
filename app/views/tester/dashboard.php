<?php


    require_once APP_ROOT . '\views\includes\header.php';
 ?>
<h1>Tester Dashboard</h1>
<?php
    print_r($_SESSION);
?>
<br>
<a href="<?php echo URL_ROOT; ?>testers/logout">logout</a>

