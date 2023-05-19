<?php
// COPY THE MESSAGE FROM PASSING PARAMETER TO LOCAL VARIABLE (LOCAL VARIABLES WILL BE RESETS WHEN PAGE RELOADS)
//// $message = $_SESSION['return_message'];
$success_message = $_SESSION['success_message'];
$error_message = $_SESSION['error_message'];

// CLEAR THE MESSAGE PASSING PARAMETER TO HIDE THE MESSAGE WHEN THE PAGE RELOADED
$_SESSION['success_message'] = '';
$_SESSION['error_message'] = '';

// IF THERE IS A MESSAGE AVAILABLE, DISPLAY IT WITH CORRESPONDING COLOUR
echo ($success_message == '') ? '<div id="messagebox" class="hideme error-msg">
                                    <div onclick="closeNotify()" class="closemsg"><img src="'. URL_ROOT .'public/images/icons/closeicon.png" class="closemsgicon" alt="X"></div>
                                    <div><strong>ERROR!</strong></div>
                                    <div id="error_message">'. $error_message .'</div>
                                </div>' :
                                '<div id="messagebox" class="hideme success-msg">
                                    <div onclick="closeNotify()" class="closemsg"><img src="'. URL_ROOT .'public/images/icons/closeicon.png" class="closemsgicon" alt="X"></div>
                                    <div><strong>SUCCESS!</strong></div>
                                    <div id="success_message">'. $success_message .'</div>
                                </div>';

// CHECK IF THERE IS A MESSAGE AVAILABLE, AND RUN THE NOTIFY ME() FUNCTION TO DISPLAY IT
echo ($error_message == '' and $success_message == '') ? '' : '<script type="text/javascript">notifyMe();</script>';
?>