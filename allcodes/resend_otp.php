<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Generate new OTP
$otp = rand(100000, 999999);

$_SESSION['otp'] = $otp;
$_SESSION['otp_time'] = time();

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // Your Gmail
    $mail->Username = 'YOUR_GMAIL@gmail.com';

    // Your 16-character App Password
    $mail->Password = 'YOUR_16_CHARACTER_APP_PASSWORD';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom(
        'YOUR_GMAIL@gmail.com',
        'National E-Voting System'
    );

    $mail->addAddress($_SESSION['email']);

    $mail->isHTML(true);

    $mail->Subject = "New Verification Code";

    $mail->Body = "
    <h2>National E-Voting System</h2>

    <p>Your new verification code is:</p>

    <h1 style='color:#0c2f68;'>$otp</h1>

    <p>This code will expire in 5 minutes.</p>
    ";

    $mail->send();

    $_SESSION['success'] = "A new verification code has been sent.";

} catch (Exception $e) {

    $_SESSION['error'] = "Failed to resend verification code.";

}

header("Location: verify_otp.php");
exit();
?>