<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/backend/vendor/autoload.php";

function sendMail($toEmail, $subject, $messageBody) {
    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host       = "smtp.gmail.com";
        $mail->SMTPAuth   = true;

        // YOUR EMAIL + APP PASSWORD
        $mail->Username   = "joyaljones60@gmail.com";
        $mail->Password   = "qtfd ztbb icmk mdrz";

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // SENDER INFO
        $mail->setFrom("joyaljones60@gmail.com", "Leave Management System");

        // RECEIVER
        $mail->addAddress($toEmail);

        // MAIL CONTENT
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($messageBody);

        $mail->send();
        return true;

    } catch (Exception $e) {
        return "Mail Error: {$mail->ErrorInfo}";
    }
}
?>
