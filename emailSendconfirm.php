<?php
require("DBconnected.php");
$title=$_POST["title"];
$message=$_POST["message"];
$message=nl2br($message);
$message="您好，您訂閱的內容如下:<br><br>".$message."<br><br>感謝您的訂閱!";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$SQL="SELECT email FROM mail ";
if ($result=mysqli_query($link, $SQL)){
    while($row=mysqli_fetch_assoc($result)){
        $email=$row['email'];

    //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

        try {
    //Server settings
            $mail->SMTPDebug = true;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'a1093306@mail.nuk.edu.tw';                     //SMTP username
            $mail->Password   = 'Book375679';                               //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet = 'utf-8';
    
    //Recipients
            $mail->setFrom('a1093306@mail.nuk.edu.tw', '吳瑄軒');
            $mail->addAddress($email, '使用者');     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

    //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $title;
            $mail->Body    = $message;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}

?>