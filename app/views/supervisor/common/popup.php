<?php
// $message = $_SESSION['return_message'];

// $success_message = $_SESSION['success_message'];
$error_popup = $_SESSION['error_popup'];

// $_SESSION['success_message'] = '';
$_SESSION['error_popup'] = '';


echo ($error_popup == '') ? '<div id="alertbox" class="hideme success-msg"><div><strong>ERROR!</strong></div><div>'. $error_popup .'</div></div>
                            <script type="text/javascript">notifyMe();</script>' : '';

?>
