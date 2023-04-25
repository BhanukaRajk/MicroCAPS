<?php
// $message = $_SESSION['return_message'];

$success_message = $_SESSION['success_message'];
$error_message = $_SESSION['error_message'];

$_SESSION['success_message'] = '';
$_SESSION['error_message'] = '';

echo ($error_message == '') ? '<div id="messagebox" class="hideme success-msg"><div><strong>SUCCESS!</strong></div><div>'. $success_message .'</div></div>' :
    '<div id="messagebox" class="hideme error-msg"><div><strong>ERROR!</strong></div><div>'. $error_message .'</div></div>';

echo ($error_message == '' and $success_message == '') ? '<div class="sup-leave-list-content">' : '<div class="sup-leave-list-content">
        <script type="text/javascript">notifyMe();</script>
        ';
?>