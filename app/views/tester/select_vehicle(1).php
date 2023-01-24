<?php require_once APP_ROOT . '\views\includes_r\header.php'; ?>
<?php require_once APP_ROOT . '\views\tester\navbar.php'; ?>

<script type="text/javascript" src="<?php echo URL_ROOT;?>public/javascripts/main.js"></script>

<style>

</style>
    
<body id="select_vehicle">
  <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="head_sv">Select Vehicle</div>
<?php


$connection = mysqli_connect('localhost', 'root', '', 'microcaps');
$records = mysqli_query($connection,"SELECT ChassisNo FROM `car`;");

while($data = mysqli_fetch_array($records))
{
?>

<div class="box_sv-3">
  <div class="btn_sv btn_sv-three" onClick="location.href='<?php echo URL_ROOT; ?>testers/defect_sheet ? ChassisNo=<?php echo $data['ChassisNo']; ?>'">
    <span><?php echo $data['ChassisNo']; ?></span>
  </div>
</div>

<?php
}
?>

</body>
</html>