<?php
// $message = $_SESSION['return_message'];

// $success_message = $_SESSION['success_message'];
$error_popup = $_SESSION['error_popup'];

// $_SESSION['success_message'] = '';
$_SESSION['error_popup'] = '';

//echo ($error_popup == '') ? '<div id="messagebox" class="hideme success-msg"><div><strong>SUCCESS!</strong></div><div>'. $success_message .'</div></div>' :
//    '<div id="messagebox" class="hideme error-msg"><div><strong>ERROR!</strong></div><div>'. $error_popup .'</div></div>';
echo ($error_popup == '') ? '<div id="alertbox" class="hideme success-msg"><div><strong>ERROR!</strong></div><div>'. $error_popup .'</div></div>
                            <script type="text/javascript">notifyMe();</script>' : '';

?>
