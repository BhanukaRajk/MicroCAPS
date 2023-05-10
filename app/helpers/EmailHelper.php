 <?php

    use PHPMailer\PHPMailer\PHPMailer;
    
    function sendmail($body) {

        // Ignore from here

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer(true);

        // To Here

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'samiducooray@gmail.com';                     //SMTP username
            $mail->Password = 'bubhazcdgtxohadn';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('samiducooray@gmail.com', 'Product Manager');
            $mail->addAddress('saminducooray@gmail.com');     //Add a recipient
            //$mail->addReplyTo('info@example.com', 'Information');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML();                                  //Set email format to HTML
            $mail->Subject = 'Requesting Shells For Assembly';
            $mail->Body = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: $mail->ErrorInfo";
        }
    }

    function authCodeEmail($body,$recipient) {

        // Ignore from here

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer(true);

        // To Here

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '300967a1d4c63a';
            $mail->Password = '293b094155e1eb';                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('noreply@microcaps.com', 'MicroCAPS');
            $mail->addAddress($recipient);     //Add a recipient
            //$mail->addReplyTo('info@example.com', 'Information');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML();                                  //Set email format to HTML
            $mail->Subject = 'MicroCAPS Email Verification';
            $mail->Body = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: $mail->ErrorInfo";
        }
    }


    function warehouseEmail($array) {


        // Ignore from here

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer(true);

        // To Here

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '300967a1d4c63a';
            $mail->Password = '293b094155e1eb';                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('noreply@microcaps.com', 'MicroCAPS');
            $mail->addAddress('warehouse@microcaps.com');     //Add a recipient
            //$mail->addReplyTo('info@example.com', 'Information');

            //Attachments
            foreach ($array as $value) {
                $mail->addAttachment('../public/documents/mrf/'.$value);         //Add attachments
            }
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML();                                  //Set email format to HTML
            $mail->Subject = 'MicroCAPS Material Request Form';
            $mail->Body = file_get_contents("../app/views/templates/components.html");
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            return true;

        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: $mail->ErrorInfo";
        }
    }
